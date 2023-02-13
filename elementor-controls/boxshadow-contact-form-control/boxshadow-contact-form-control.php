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
class boxshadow_contact_form_Control extends Base_Data_Control {

	// Control Dependencies Styles Enqueue
	public function enqueue() {
        // Styles
		wp_register_style( 'boxshadow-contact-form-control', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/elementor-controls/boxshadow-contact-form-control/assets/css/boxshadow-contact-form-control.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'boxshadow-contact-form-control' );
		
        // Scripts
		wp_register_script( 'boxshadow-contact-form-control', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/elementor-controls/boxshadow-contact-form-control/assets/js/boxshadow-contact-form-control.js', array(), '1.0.0', 'all' );
		wp_enqueue_script( 'boxshadow-contact-form-control' );
	}

	// Get Boxshadow Contact Form Control type
	public function get_type() {
		return 'BOXSHADOW_CONTACT_FORM';
	}

	// Get Boxshadow Contact Form Control Default Settings
	protected function get_default_settings() {
		return [
			'label_block' => true,
		];
	}
	
	public function get_default_value() {
		return [
			'label' => 'true',
			'name' => 'true',
			'email' => 'true',
			'phone' => 'true',
			'message' => 'true',
		];
	}

	// Render Contact Form 7 Control Output in the Editor
	public function content_template() { ?>
		<div class="elementor-control-field">

			<# if ( data.label ) {#>
			<label class="elementor-control-title">{{{ data.label }}}</label>
			<# } #>

			<div class="elementor-control-input-wrapper">
				
                <div class="boxshadow-checkbox-wrapper-7">
                    <span class="title"><?php echo esc_html__( 'Label Show/Hide', 'boxshadow' ); ?></span>
                    <span>
						<# if ( data.controlValue.label === 'false' ) { #>
							<input id="cb-7" class="boxshadow-contact-form" type="checkbox" name="label"/>
						<# } else { #>
							<input id="cb-7" class="boxshadow-contact-form" type="checkbox" name="label" checked/>
						<# } #>
                        <label for="cb-7"></label>
                    </span>
                </div>

                <div class="boxshadow-checkbox-wrapper-55">
                    <span class="title"><?php echo esc_html__( 'Name Visible', 'boxshadow' ); ?></span>
                    <label>
						<# if ( data.controlValue.name === 'false' ) {#>
							<input class="boxshadow-contact-form" type="checkbox" name="name">
						<# } else { #>
							<input class="boxshadow-contact-form" type="checkbox" name="name" checked>
						<# } #>
                        <span class="switch-left"><?php echo esc_html__( 'No', 'boxshadow' ); ?></span>
                        <span class="switch-right"><?php echo esc_html__( 'Yes', 'boxshadow' ); ?></span>
                    </label>
                </div>

                <div class="boxshadow-checkbox-wrapper-55">
                    <span class="title"><?php echo esc_html__( 'Email Visible', 'boxshadow' ); ?></span>
                    <label>
						<# if ( data.controlValue.email === 'false' ) {#>
							<input class="boxshadow-contact-form" type="checkbox" name="email">
						<# } else { #>
							<input class="boxshadow-contact-form" type="checkbox" name="email" checked>
						<# } #>
                        <span class="switch-left"><?php echo esc_html__( 'No', 'boxshadow' ); ?></span>
                        <span class="switch-right"><?php echo esc_html__( 'Yes', 'boxshadow' ); ?></span>
                    </label>
                </div>

                <div class="boxshadow-checkbox-wrapper-55">
                    <span class="title"><?php echo esc_html__( 'Phone Visible', 'boxshadow' ); ?></span>
                    <label>
						<# if ( data.controlValue.phone === 'false' ) {#>
							<input class="boxshadow-contact-form" type="checkbox" name="phone">
						<# } else { #>
							<input class="boxshadow-contact-form" type="checkbox" name="phone" checked>
						<# } #>
                        <span class="switch-left"><?php echo esc_html__( 'No', 'boxshadow' ); ?></span>
                        <span class="switch-right"><?php echo esc_html__( 'Yes', 'boxshadow' ); ?></span>
                    </label>
                </div>
				
                <div class="boxshadow-checkbox-wrapper-55">
                    <span class="title"><?php echo esc_html__( 'Message Visible', 'boxshadow' ); ?></span>
                    <label>
						<# if ( data.controlValue.message === 'false' ) {#>
							<input class="boxshadow-contact-form" type="checkbox" name="message">
						<# } else { #>
							<input class="boxshadow-contact-form" type="checkbox" name="message" checked>
						<# } #>
                        <span class="switch-left"><?php echo esc_html__( 'No', 'boxshadow' ); ?></span>
                        <span class="switch-right"><?php echo esc_html__( 'Yes', 'boxshadow' ); ?></span>
                    </label>
                </div>

			</div>

		</div>

		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
	<?php
	}

}
Plugin::instance()->controls_manager->register_control( 'BOXSHADOW_CONTACT_FORM', new boxshadow_contact_form_Control() );