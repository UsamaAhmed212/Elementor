<?php

// Custom widgets must be defined in the Elementor namespace
namespace Elementor; 


/**
 * Elementor currency control.
 *
 * A control for displaying a select field with the ability to choose currencies.
 *
 * @since 1.0.0
 */
class Contact_Form_7_Control extends Base_Data_Control {

	// Control Dependencies Styles Enqueue
	public function enqueue() {
        // Styles
		wp_register_style( 'contact-form-7-control', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/elementor-controls/contact-form-7-control/assets/css/contact-form-7-control.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'contact-form-7-control' );
		
		// Scripts
		wp_register_script( 'contact-form-7-control', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/elementor-controls/contact-form-7-control/assets/js/contact-form-7-control.js', array(), '1.0.0', 'all' );
		// wp_enqueue_script( 'contact-form-7-control' );
	}

	// Get Contact Form 7 Control type
	public function get_type() {
		return 'BOXSHADOW_CONTACT_FORM_7';
	}

	// Get BoxShadow Contact Form ( 7 ) Seven
	public function boxshadow_contact_form_seven () {

		$countactform = array();
		$boxshadow_forms_args = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
		$boxshadow_forms = get_posts( $boxshadow_forms_args );

		if( $boxshadow_forms ) {

			foreach ( $boxshadow_forms as $boxshadow_form ) {

				$countactform[$boxshadow_form->ID] = $boxshadow_form->post_title;

			}

		} else {

			$countactform = array();

		}

		return $countactform;

	}
	
	// Get Contact Form 7 Control Default Settings
	protected function get_default_settings() {
		return [
			'label_block' => true,
			'contact_form' => self::boxshadow_contact_form_seven(),
		];
	}

	// Render Contact Form 7 Control Output in the Editor
	public function content_template() {
		// Get  Control Uid From the Control Settings.
		$control_uid = $this->get_control_uid(); 
		?>
		<div class="elementor-control-field">

			<# if ( data.label ) {#>
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<# } #>

			<div class="elementor-control-input-wrapper">

			<?php 
			if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) { ?>
			
				<# 
				if ( _.isEmpty( data.contact_form ) ) { #>
					<a href="<?php echo admin_url('admin.php?page=wpcf7-new'); ?>" class="create-contact-form">Create a New Contact Form</a>
				<# 
				} else { #>
					<select id="<?php echo $control_uid; ?>" class="boxshadow-contact-form-seven" data-setting="{{ data.name }}">
						<option value="" selected disabled><?php echo esc_html__( 'Select Contact Form', 'boxshadow' ); ?></option>
						<# _.each( data.contact_form, function( value, key ) { #>
						<option value="{{{ key }}}">{{{ value }}}</option>
						<# } ); #>
					</select>
				<# } #>

			<?php
			} else {
				
				if( array_key_exists( 'contact-form-7/wp-contact-form-7.php', get_plugins() ) ) { 
					
					$action = 'activate-plugin';
					$slug = 'contact-form-7/wp-contact-form-7.php';
					$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $slug . '&amp;plugin_status=all&amp;paged=1&amp;s', $action . '_' . $slug );
				?>
				
					<a href="<?php echo $activation_url; ?>" class="activate-contact-form">Activate Contact Form 7 Plugin</a>
				
				<?php
				} else {

					$action = 'install-plugin';
					$slug = 'contact-form-7';
					$install_url = wp_nonce_url(
						add_query_arg(
							array(
								'action' => $action,
								'plugin' => $slug
							),
							admin_url( 'update.php' )
						),
						$action . '_' . $slug
					);

				?>
					
					<a href="<?php echo $install_url; ?>" class="create-contact-form">Install Contact Form 7 Plugin</a>
			<?php
				}
			
			} ?>

			</div>

		</div>

		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
	<?php
	}

}
Plugin::instance()->controls_manager->register_control( 'BOXSHADOW_CONTACT_FORM_7', new Contact_Form_7_Control() );