<?php 

// Custom widgets must be defined in the Elementor namespace
namespace Elementor; 

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Contact_Section_Widget extends Widget_Base {

	// Widget Dependencies Styles Enqueue
	public function get_style_depends() {

		// Font Awesome V6.1.2 Enqueue
		wp_register_style( 'font-awesome-free', '//use.fontawesome.com/releases/v6.1.2/css/all.css', array(), '6.1.2', 'all' );
		
		// Contact Section Widget Enqueue
		wp_register_style( 'contact-section-widget', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/elementor-widgets/contact-section-widget/assets/css/contact-section-widget.css', array(), '1.0.0', 'all' );
		
		// International Telephone Input Enqueue
		wp_register_style( 'international-telephone-input', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/elementor-widgets/contact-section-widget/assets/plugins/international-telephone-input/international-telephone-input.css', array(), '1.0.0', 'all' );
		
		// Contact Form 7 Widget Enqueue
		wp_register_style( 'contact-form-7-widget', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/elementor-widgets/contact-section-widget/assets/css/contact-form-7-widget.css', array(), '1.0.0', 'all' );

		return array( 
			'font-awesome-free',
			'contact-section-widget',
			'international-telephone-input',
			
			'contact-form-7-widget',
		);
	}
	
	// Widget Dependencies Scripts Enqueue
	public function get_script_depends() {
		
    	// SVG Loader Js Enqueue
		wp_register_script( 'boxshadow-svg-loader', BOXSHADOW_THEME_DIR_URI . 'assets/js/svg-loader.js', array(), '1.0.0', true );
		
		// International Telephone Input Enqueue
		wp_register_script( 'international-telephone-input', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/elementor-widgets/contact-section-widget/assets/plugins/international-telephone-input/international-telephone-input.js', array(), '1.0.0', true );
		
		// Contact Form Enqueue
		wp_register_script( 'contact-form', BOXSHADOW_THEME_DIR_URI . 'assets/js/contact-form.js', array(), '1.0.0', true );

		// Contact Form 7 Widget Enqueue
		wp_register_script( 'contact-form-7-widget', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/elementor-widgets/contact-section-widget/assets/js/contact-form-7-widget.js', array(), '1.0.0', true );

		return array( 
			'boxshadow-svg-loader',
			'international-telephone-input',
			'contact-form',

			'contact-form-7-widget',
		 );
	}
 

	// Machine Name or "handle" For the Widget
	public function get_name() {
		return __( 'contact-section-widget', 'boxshadow' );
	}

	// Widget Title Which is Displayed in the Elementor Editor's "widget gallery"
	public function get_title() {
		return __( 'Contact Section', 'boxshadow' );
	}

	// Icon Which is Sisplayed Next to Title in "widget gallery"
	public function get_icon() {
		return 'boxshadow-icon fa-solid fa-address-card';
	}

	// Put Widget in a Specific Category.
	public function get_categories() {
		return [ 'box-Shadow' ];
	}

	// Returns the help link in the Widget
	public function get_help_url() {
		return '';
	}

	// Widgets Can be Found on the Dashboard with this Keywords.
	public function get_keywords() {
		return [ ' bx ', ' custom ', ' boxShadow ', ' box Shadow ', ' box-Shadow ', ' box_Shadow ', ' contact ' ];
	}

	// Register the Widget Controls (data fields) in this Function.
	protected function register_controls() {

		//  Controls Section Start
		$this->start_controls_section( 'contact_heading', array (
			'label'		=> esc_html__( 'Contact Heading', 'boxshadow' ),
			'type' 		=> Controls_Manager::SECTION, 
			'tab' 		=> Controls_Manager::TAB_CONTENT,
		) );

		$this->add_control( 'subtitle_title', array(
			'label' 		=> esc_html__( 'Contact Subtitle Title', 'boxshadow' ),
			'type'			=> Controls_Manager::TEXT,
			'label_block' 	=> true,
			'default' 		=> esc_html__( 'contact', 'boxshadow' ),
		) );

		$this->add_control( 'title', array(
			'label' 		=> esc_html__( 'Contact Title', 'boxshadow' ),
			'type' 			=> Controls_Manager::TEXTAREA,
			'label_block' 	=> true,
			'rows' 			=> 3,
			'default' 		=> __( 'Have You Any Project?<br/>Please Drop a Message', 'boxshadow' ),
		) );
		
		$this->add_control( 'description', array(
			'label' 		=> esc_html__( 'Contact Description', 'boxshadow' ),
			'type' 			=> Controls_Manager::TEXTAREA,
			'label_block' 	=> true,
			'rows' 			=> 4,
			'default' 		=> __( 'Get in touch and let me know how i can help. Fill out the form and i’ll be in touch as soon as possible.', 'boxshadow' ),
		) );

		//  Controls Section End
		$this->end_controls_section();
		
		//  Controls Section Start
		$this->start_controls_section( 'contact_info', array (
			'label' 	=> esc_html__( 'Contact Info', 'boxshadow' ),
			'type' 		=> Controls_Manager::SECTION, 
			'tab' 		=> Controls_Manager::TAB_CONTENT,
		) );

		$this->add_control( 'contact_info_switcher', array(
			'label' 		=> esc_html__( 'Contact Info Show/Hide', 'boxshadow' ),
			'type' 			=> Controls_Manager::SWITCHER,
			'label_on' 		=> esc_html__( 'Show', 'boxshadow' ),
			'label_off' 	=> esc_html__( 'Hide', 'boxshadow' ),
			'return_value' 	=> 'yes',
			'default' 		=> 'yes',
		) );

		$repeater = new Repeater();

		$repeater->add_control( 'contact_info_icon', array( 
			'label' 	=> esc_html__( 'Contact Info Icon', 'boxshadow' ),
			'type' 		=> Controls_Manager::ICONS,
		) );

		$repeater->add_control( 'contact_info_title', array(
			'label' 		=> esc_html__( 'Contact Info Title', 'boxshadow' ),
			'type' 			=> Controls_Manager::TEXT,
			'label_block' 	=> true,
			'default' 		=> esc_html__( 'Contact Info Title', 'boxshadow' ),
		) );

		$repeater->add_control( 'contact_info_description', array(
			'label' 		=> esc_html__( 'Contact Info Description', 'boxshadow' ),
			'type' 			=> Controls_Manager::WYSIWYG,
		) );

		$this->add_control( 'contact_info_repeater', array(
			'label' 		=> esc_html__( 'Contact Info', 'boxshadow' ),
			'type' 			=> Controls_Manager::REPEATER,
			'fields' 		=> $repeater->get_controls(),
			'default' 		=> array(
				array(
					'contact_info_icon'			=> array(
						'value'   =>  array( 
							'url' 	=> BOXSHADOW_THEME_DIR_URI . 'images/svg/location-dot.svg',
						 ),
						'library' => 'svg',
					),
					'contact_info_title'		=> esc_html__( 'Address:', 'boxshadow' ),
					'contact_info_description'	=> __( '644 N Lake Shore Dr, Chicago, Indiana, 47602-7594', 'boxshadow' )
				),
				array(
					'contact_info_icon'			=> array(
						'value'   =>  array( 
							'url'	=> BOXSHADOW_THEME_DIR_URI . 'images/svg/phone.svg',
						 ),
						'library' => 'svg',
					),
					'contact_info_title'		=> esc_html__( 'Phone:', 'boxshadow' ),
					'contact_info_description'	=> __( '<ul><li><a href="tel:02966920290">(02) 966 920 290</a></li><li><a href="tel:02966212851">(02) 966 212 851</a></li></ul>', 'boxshadow' )
				),
				array(
					'contact_info_icon'			=> array(
						'value'   =>  array( 
							'url'	=> BOXSHADOW_THEME_DIR_URI . 'images/svg/envelope-o.svg',
						 ),
						'library' => 'svg',
					),
					'contact_info_title'		=> esc_html__( 'Email:', 'boxshadow' ),
					'contact_info_description'	=> __( '<ul><li><a href="mailto:info@gmail.com">info@gmail.com</a></li><li><a href="mailto:support@gmail.com">support@gmail.com</a></li></ul>', 'boxshadow' )
				),
			),
			'title_field' 	=> '{{{ elementor.helpers.renderIcon( this, contact_info_icon, {}, "i", "panel" ) }}} {{{ contact_info_title }}}',
			'condition' 	=> array( 
				'contact_info_switcher' => 'yes'
			 ),
		) );
			
		//  Controls Section End
		$this->end_controls_section();

		//  Controls Section Start
		$this->start_controls_section( 'social_icons', array (
			'label' 	=> esc_html__( 'Social Icons', 'boxshadow' ),
			'type' 		=> Controls_Manager::SECTION, 
			'tab' 		=> Controls_Manager::TAB_CONTENT,
		) );

		$this->add_control( 'social_icons_switcher', array(
			'label'	 		=> esc_html__( 'Social Icons Show/Hide', 'boxshadow' ),
			'type' 			=> Controls_Manager::SWITCHER,
			'label_on' 		=> esc_html__( 'Show', 'boxshadow' ),
			'label_off' 	=> esc_html__( 'Hide', 'boxshadow' ),
			'return_value' 	=> 'yes',
			'default' 		=> 'yes',
		) );

		$repeater = new Repeater();

		$repeater->add_control( 'social_icon_link', array( 
			'label' 		=> esc_html__( 'Social Link', 'boxshadow' ),
			'type' 			=> Controls_Manager::URL,
			'options' 		=> array( 'url', 'is_external', 'nofollow' ),
		) );

		$repeater->add_control( 'social_icon', array(
			'label' 	=> esc_html__( 'Social Icon', 'boxshadow' ),
			'type' 		=> Controls_Manager::ICONS,
		) );

		$this->add_control( 'social_icons_repeater', array(
			'label' 		=> esc_html__( 'Socia Icons', 'boxshadow' ),
			'type' 			=> Controls_Manager::REPEATER,
			'fields' 		=> $repeater->get_controls(),
			'default' 		=> array(
				array(
					'social_icon_link' 			=> array(
						'url' 				=> 'https://twitter.com/',
						'is_external'		=> true,
						'nofollow' 			=> true,
					),
					'social_icon'				=> array(
						'value'   =>  array( 
							'url' 	=> BOXSHADOW_THEME_DIR_URI . 'images/svg/twitter.svg',
						 ),
						'library' => 'svg',
					),
				),
				array(
					'social_icon_link' 			=> array(
						'url' 				=> 'https://www.facebook.com/',
						'is_external'		=> true,
						'nofollow' 			=> true,
					),
					'social_icon'				=> array(
						'value'   =>  array( 
							'url' 	=> BOXSHADOW_THEME_DIR_URI . 'images/svg/facebook-f.svg',
						 ),
						'library' => 'svg',
					),
				),
				array(
					'social_icon_link' 			=> array(
						'url' 				=> 'https://www.instagram.com/',
						'is_external'		=> true,
						'nofollow' 			=> true,
					),
					'social_icon'				=> array(
						'value'   =>  array( 
							'url' 	=> BOXSHADOW_THEME_DIR_URI . 'images/svg/instagram.svg',
						 ),
						'library' => 'svg',
					),
				),
				array(
					'social_icon_link' 			=> array(
						'url' 				=> 'https://www.linkedin.com/',
						'is_external'		=> true,
						'nofollow' 			=> true,
					),
					'social_icon'				=> array(
						'value'   =>  array( 
							'url' 	=> BOXSHADOW_THEME_DIR_URI . 'images/svg/linkedin-in.svg',
						 ),
						'library' => 'svg',
					),
				),
				array(
					'social_icon_link' 			=> array(
						'url' 				=> 'https://dribbble.com/',
						'is_external'		=> true,
						'nofollow' 			=> true,
					),
					'social_icon'				=> array(
						'value'   =>  array( 
							'url' 	=> BOXSHADOW_THEME_DIR_URI . 'images/svg/dribbble.svg',
						 ),
						'library' => 'svg',
					),
				),
			),
			'title_field'	=> '{{{ elementor.helpers.renderIcon( this, social_icon, {}, "i", "panel" ) }}}',
			'condition'		=> array( 
				'social_icons_switcher' => 'yes'
			 ),
		) );
			
		//  Controls Section End
		$this->end_controls_section();

		//  Controls Section Start
		$this->start_controls_section( 'contact_form', array (
			'label'		=> esc_html__( 'Contact Form', 'boxshadow' ),
			'type' 		=> Controls_Manager::SECTION, 
			'tab' 		=> Controls_Manager::TAB_CONTENT,
		) );

		$this->add_control( 'boxshadow_contact_form_switcher', array(
			'label'	 		=> esc_html__( 'Boxshadow Contact Form Show/Hide', 'boxshadow' ),
			'type' 			=> Controls_Manager::SWITCHER,
			'label_on' 		=> esc_html__( 'Show', 'boxshadow' ),
			'label_off' 	=> esc_html__( 'Hide', 'boxshadow' ),
			'return_value' 	=> 'yes',
			'default' 		=> 'yes',
		) );
		
		$this->add_control( 'boxshadow_contact_form', array(
			'label'   	  => esc_html__( 'Boxshadow Contact Form', 'boxshadow' ),
			'description' => esc_html__( 'Boxshadow Contact Form Label & Fields Enable/Disable', 'boxshadow' ),
			'type'		  => 'BOXSHADOW_CONTACT_FORM',
			'condition'	  => array(
				'boxshadow_contact_form_switcher' => 'yes',
			),
		) );

		$this->add_control( 'contact_form_7_switcher', array(
			'label'	 		=> esc_html__( 'Contact Form 7 Show/Hide', 'boxshadow' ),
			'type' 			=> Controls_Manager::SWITCHER,
			'label_on' 		=> esc_html__( 'Show', 'boxshadow' ),
			'label_off' 	=> esc_html__( 'Hide', 'boxshadow' ),
			'return_value' 	=> 'yes',
			'default' 		=> 'yes',
		) );

		$this->add_control( 'contact_form_7', array(
			'label'   	  => esc_html__( 'Contact Form 7', 'boxshadow' ),
			'description' => esc_html__( 'Select Contact Form 7', 'boxshadow' ),
			'type'		  => 'BOXSHADOW_CONTACT_FORM_7',
			'condition'	  => array(
				'contact_form_7_switcher' => 'yes',
			),
		) );

		//  Controls Section End
		$this->end_controls_section();

	}

	// The Render the Widget Output on the Front End.
	protected function render() {
		// Get  Input From the Widget Settings.
        $settings = $this->get_settings_for_display();
		
		$this->add_inline_editing_attributes( 'subtitle_title', 'basic' );
		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_inline_editing_attributes( 'description', 'basic' );

		?>
		<!-- Contact Section -->
		<section id="contact-section-wrapper">
			<div class="container-md">
				<div class="row m-0 contact-section">
					<div class="col-lg-6 p-0">
						<div class="contact-text">
							<div class="text-box-inline">
								<span data-aos="zoom-in" <?php echo $this->get_render_attribute_string( 'subtitle_title' ); ?>><?php echo $settings['subtitle_title']; ?></span>
								<h2 data-aos="fade-up" <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title'] ?></h2>
								<p data-aos="fade-up" data-aos-delay="100" <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo $settings['description']; ?></p>
							</div>
							
							<?php
							if ( $settings['contact_info_switcher'] === 'yes' ) {
								if ( $settings['contact_info_repeater'] ) {
							?>
								<ul class="contact-info">
									<?php 
									foreach ( $settings['contact_info_repeater'] as $item ) { ?>
									
									<li data-aos="fade-up">
										<span>
										<?php 
										if ( is_array( $item['contact_info_icon']['value'] ) && !empty( $item['contact_info_icon']['value']['url'] ) ) {
										
											echo '<img class="svg" src="' . $item['contact_info_icon']['value']['url'] . '" />';
											
										} elseif ( !is_array( $item['contact_info_icon']['value'] ) && !empty( $item['contact_info_icon']['value'] ) ) {
											
											Icons_Manager::render_icon( $item['contact_info_icon'], [ 'aria-hidden' => 'true' ] );
		
										}
										?>
										</span>
										<div><strong><?php echo $item['contact_info_title']; ?></strong><?php echo $item['contact_info_description']; ?></div>
									</li>
									
									<?php
									}
									?>
								</ul>
							<?php
								}
							}

							if ( $settings['social_icons_switcher'] === 'yes' ) {
								if ( $settings['social_icons_repeater'] ) {
							?>
								<ul class="social">
									<?php
									foreach ( $settings['social_icons_repeater'] as $item ) { ?>
									<li data-aos="zoom-in-up" data-aos-delay="100">
										<?php 
										$url =  ( ! empty( $item['social_icon_link']['url'] ) ) ? 'href="' . $item['social_icon_link']['url'] . '"' : '';	// href
										$is_external =  ( $item['social_icon_link']['is_external'] === true ) ? 'target="_blank"' : '';	// target
										$nofollow =  ( $item['social_icon_link']['nofollow'] === true ) ? 'rel="nofollow"' : '';	// rel
										?>
										<a <?php echo $url; echo $is_external; echo $nofollow; ?> >
											<span>
											<?php 
											if ( is_array( $item['social_icon']['value'] ) && !empty( $item['social_icon']['value']['url'] ) ) {
											
												echo '<img class="svg" src="' . $item['social_icon']['value']['url'] . '" />';
												
											} elseif ( !is_array( $item['social_icon']['value'] ) && !empty( $item['social_icon']['value'] ) ) {
												
												Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] );
			
											}
											?>
											</span>
										</a>
									</li>
									<?php 
									}
									?>
								</ul>
							<?php 
								}
							}
							?>
						</div>
					</div>
					<div class="col-lg-6 p-0">
						<?php 
						if ( $settings['boxshadow_contact_form_switcher'] === 'yes' ) { 
							if ( $settings['boxshadow_contact_form']['name'] === 'true' || $settings['boxshadow_contact_form']['email'] === 'true' || $settings['boxshadow_contact_form']['phone'] === 'true' || $settings['boxshadow_contact_form']['message'] === 'true' ) { 
							?>
							<form id="contact-form" class="contact-info-contact-form" data-aos="zoom-in">
								<?php if ( $settings['boxshadow_contact_form']['name'] === 'true' ) { ?>
								<div class="group name">
									<?php if ( $settings['boxshadow_contact_form']['label'] === 'true' ) { ?>
									<label>Name</label>
									<?php } ?>
									<div class="control">
										<input type="text" name="name" placeholder="e.g. John Doe" minlength="3">
										<span><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/circle-user.svg" alt="SVG" class="svg"/></span>
									</div>
								</div>
								<?php } ?>

								<?php if ( $settings['boxshadow_contact_form']['email'] === 'true' ) { ?>
								<div class="group email">
									<?php if ( $settings['boxshadow_contact_form']['label'] === 'true' ) { ?>
									<label>Email</label>
									<?php } ?>
									<div class="control">
										<input type="email" inputmode="email" name="email" placeholder="e.g. john.doe@gmail.com">
										<span><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/envelope.svg" alt="SVG" class="svg"/></span>
									</div>
								</div>
								<?php } ?>

								<?php if ( $settings['boxshadow_contact_form']['phone'] === 'true' ) { ?>
								<div class="group phone">
									<?php if ( $settings['boxshadow_contact_form']['label'] === 'true' ) { ?>
									<label>Phone <span class="optional">(Optional)</span></label>
									<?php } ?>
									<div class="control">
										<input type="tel" inputmode="tel" name="phone" placeholder="Phone Number">
										<span><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/phone.svg" alt="SVG" class="svg"/></span>
									</div>
								</div>
								<?php } ?>

								<?php if ( $settings['boxshadow_contact_form']['message'] === 'true' ) { ?>
								<div class="group message">
									<?php if ( $settings['boxshadow_contact_form']['label'] === 'true' ) { ?>
									<label>Message</label>
									<?php } ?>
									<div class="control">
										<textarea name="message" placeholder="Write message..." ></textarea>
										<span><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/comments.svg" alt="SVG" class="svg"/></span>
									</div>
								</div>
								<?php } ?>

								<div class="group">
									<div class="control">
										<button class="send-btn btn-dark" type="submit">
											<span class="submit">Send Message</span>
											<span class="loading"><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/arrows-rotate.svg" alt="SVG" class="svg"></span>
											<span class="check"><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/check.svg" alt="SVG" class="svg"></span>
										</button>
									</div>
								</div>
							</form>
							<script>
								window.addEventListener('load', function (event) {
									var rootPath = "<?php echo BOXSHADOW_THEME_DIR_URI; ?>";
									root_path(rootPath);
								});
							</script>
						<?php 
							} 
						}
						
						if ( $settings['contact_form_7_switcher'] === 'yes' ) { 
							$contactFormSeven = do_shortcode( '[contact-form-7 id="'.$settings['contact_form_7'].'"]' );

							if( $contactFormSeven == '[contact-form-7 404 "Not Found"]' || $contactFormSeven == "[contact-form-7 404 'Not Found']" ) { ?>
								<div class="contact-form-7-no-select">Please Select Contact Form</div>
							<?php
							} else {
								echo $contactFormSeven;
							}
						}
						?>
					</div>
				</div>
			</div>
    	</section>
		<script type="text/javascript" class="svg-loader">
			if ( typeof svgLoader == 'function' ) {
				svgLoader();
			}
		</script>
	<?php
	}

	// Elementor Editor When Something Causes the Preview to be Reloaded
	protected function content_template() { ?>
		<# 
		view.addInlineEditingAttributes( 'subtitle_title', 'basic' );
		view.addInlineEditingAttributes( 'title', 'basic' );
		view.addInlineEditingAttributes( 'description', 'basic' );
		#>
		
		<!-- Contact Section -->
		<section id="contact-section-wrapper">
			<div class="container-md">
				<div class="row m-0 contact-section">
					<div class="col-lg-6 p-0">
						<div class="contact-text">
							<div class="text-box-inline">
								<span {{{ view.getRenderAttributeString( 'subtitle_title' ) }}}>{{{ settings.subtitle_title }}}</span>
								<h2 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h2>
								<p {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</p>
							</div>
							<# 
							if ( settings.contact_info_switcher === 'yes' ) {

								if ( settings.contact_info_repeater.length ) { #>
									<ul class="contact-info">
										<# _.each( settings.contact_info_repeater, function( item ) { #>

										<li>
										<# if ( _.isObject( item.contact_info_icon.value ) && item.contact_info_icon.value.url.length ) { #>
                                            
                                            <span><img class="svg" src="{{{ item.contact_info_icon.value.url }}}" /></span>
                                        
                                        <#  } else {

                                                if ( item.contact_info_icon.value.length ) { #>
                                                
                                                    <span>{{{ elementor.helpers.renderIcon( view, item.contact_info_icon, { 'aria-hidden': true }, 'i' , 'object' ).value }}}</span>
                                            
                                                <# }

                                        } #>
                                            <div><strong>{{{ item.contact_info_title }}}</strong>{{{ item.contact_info_description }}}</div>
                                        </li>
											
										<# } ); #>
									</ul>
							<#  }

							}

							if ( settings.social_icons_switcher === 'yes' ) {  
								if ( settings.social_icons_repeater.length ) { #>
									<ul class="social">
										<# _.each( settings.social_icons_repeater, function( item ) { #>
										<li>
											<#
											var url = ( item.social_icon_link.url.length ) ? 'href="'+item.social_icon_link.url+'"' : '';	<!-- href -->
											var is_external = ( item.social_icon_link.is_external === true ) ? 'target="_blank"' : '';	<!-- target -->
											var nofollow = ( item.social_icon_link.nofollow === true ) ? 'rel="nofollow"' : '';	<!-- rel -->
											#>
											<a {{{ url }}} {{{ is_external }}} {{{ nofollow }}} >
												<# if ( _.isObject( item.social_icon.value ) && item.social_icon.value.url.length ) { #>

													<span><img class="svg" src="{{{ item.social_icon.value.url }}}" /></span>

												<#  } else {

													if ( item.social_icon.value.length ) { #>

														<span>{{{ elementor.helpers.renderIcon( view, item.social_icon, { 'aria-hidden': true }, 'i' , 'object' ).value }}}</span>

													<# }

												} #>
											</a>
										</li>
										<#
										} ); #>
									</ul>
							<#	}
							} #>
						</div>
					</div>
					<div class="col-lg-6 p-0">
						<# 
						if ( settings.boxshadow_contact_form_switcher === 'yes' ) {
							if ( settings.boxshadow_contact_form.name === 'true' || settings.boxshadow_contact_form.email === 'true' || settings.boxshadow_contact_form.phone === 'true' || settings.boxshadow_contact_form.message === 'true') { #>
							<form id="contact-form" class="contact-info-contact-form" data-aos="zoom-in">
								
								<# if ( settings.boxshadow_contact_form.name === 'true' ) { #>
								<div class="group name">
									<# if ( settings.boxshadow_contact_form.label === 'true' ) { #>
									<label>Name</label>
									<# } #>
									<div class="control">
										<input type="text" name="name" placeholder="e.g. John Doe" minlength="3">
										<span><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/circle-user.svg" alt="SVG" class="svg"/></span>
									</div>
								</div>
								<# } #>

								<# if ( settings.boxshadow_contact_form.email === 'true' ) { #>
								<div class="group email">
									<# if ( settings.boxshadow_contact_form.label === 'true' ) { #>
									<label>Email</label>
									<# } #>
									<div class="control">
										<input type="email" inputmode="email" name="email" placeholder="e.g. john.doe@gmail.com">
										<span><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/envelope.svg" alt="SVG" class="svg"/></span>
									</div>
								</div>
								<# } #>

								<# if ( settings.boxshadow_contact_form.phone === 'true' ) { #>
								<div class="group phone">
									<# if ( settings.boxshadow_contact_form.label === 'true' ) { #>
									<label>Phone <span class="optional">(Optional)</span></label>
									<# } #>
									<div class="control">
										<input type="tel" inputmode="tel" name="phone" placeholder="Phone Number">
										<span><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/phone.svg" alt="SVG" class="svg"/></span>
									</div>
								</div>
								<# } #>

								<# if ( settings.boxshadow_contact_form.message === 'true' ) { #>
								<div class="group message">
									<# if ( settings.boxshadow_contact_form.label === 'true' ) { #>
									<label>Message</label>
									<# } #>
									<div class="control">
										<textarea name="message" placeholder="Write message..." ></textarea>
										<span><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/comments.svg" alt="SVG" class="svg"/></span>
									</div>
								</div>
								<# } #>

								<div class="group">
									<div class="control">
										<button class="send-btn btn-dark" type="submit">
											<span class="submit">Send Message</span>
											<span class="loading"><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/arrows-rotate.svg" alt="SVG" class="svg"></span>
											<span class="check"><img src="<?php echo BOXSHADOW_THEME_DIR_URI; ?>images/svg/check.svg" alt="SVG" class="svg"></span>
										</button>
									</div>
								</div>
							</form>
						<# 
							} 
						} #>
						

						<#
						if ( settings.contact_form_7_switcher === 'yes' ) {
							if ( _.isEmpty( settings.contact_form_7 ) ) { #>
								<div class="contact-form-7-no-select">Please Select Contact Form</div>
							<# 
							} else {

							#>
							<?php 
								$id = "{{{settings.contact_form_7}}}";
								echo do_shortcode( '[contact-form-7 id="'.$id.'"]' );
							?>
						<#	} 
						} #>
					</div>
				</div>
			</div>
		</section>
		<script type="text/javascript">
			if ( typeof svgLoader == 'function' ) {
				svgLoader();
			}
		</script>
	<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Contact_Section_Widget() );