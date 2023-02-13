<?php 

// Custom widgets must be defined in the Elementor namespace
namespace Elementor; 

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Delete_Section_Widget extends Widget_Base {
    // Widget Dependencies Styles Enqueue
	public function get_style_depends() {

		// International Telephone Input Enqueue
		wp_register_style( 'international-telephone-input', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/elementor-widgets/contact-section-widget/assets/plugins/international-telephone-input/international-telephone-input.css', array(), '1.0.0', 'all' );
		
		return array(
			// 'international-telephone-input',
		);
	}
	
	// Widget Dependencies Scripts Enqueue
	public function get_script_depends() {
		
		// International Telephone Input Enqueue
		wp_register_script( 'international-telephone-input', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/elementor-widgets/contact-section-widget/assets/plugins/international-telephone-input/international-telephone-input.js', array(), '1.0.0', true );
		
		return array(
			// 'international-telephone-input', id="editor"
		 );
	}
 

	// Machine Name or "handle" For the Widget
	public function get_name() {
		return __( 'delete-section-widget', 'boxshadow' );
	}

	// Widget Title Which is Displayed in the Elementor Editor's "widget gallery"
	public function get_title() {
		return __( 'Delete Section', 'boxshadow' );
	}

	// Icon Which is Sisplayed Next to Title in "widget gallery"
	public function get_icon() {
		return 'boxshadow-icon fa-solid fa-trash';
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
		return [ ' bx ', ' custom ', ' boxShadow ', ' box Shadow ', ' box-Shadow ', ' box_Shadow ', ' delete ' ];
	}

	// Register the Widget Controls (data fields) in this Function.
	protected function register_controls() {
        //  Controls Section Start
		$this->start_controls_section( 'delete_heading', array (
			'label'		=> esc_html__( 'Delete Heading', 'boxshadow' ),
			'type' 		=> Controls_Manager::SECTION, 
			'tab' 		=> Controls_Manager::TAB_CONTENT,
		) );

		$this->add_control( 'title', array(
			'label' 		=> esc_html__( 'Contact Title', 'boxshadow' ),
			'type' 			=> Controls_Manager::TEXT,
			'label_block' 	=> true,
			'rows' 			=> 3,
			'default' 		=> __( 'This is Delete Widget Title', 'boxshadow' ),
		) );

		//  Controls Section End
		$this->end_controls_section();
    }
    
    // The Render the Widget Output on the Front End.
	protected function render() {
		// Get  Input From the Widget Settings.
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'none' );
		
		?>
        <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?> id="editor" style="color: peru; text-align:center"><?php echo $settings['title'] ?></h2>
	<?php
	}

	// Elementor Editor When Something Causes the Preview to be Reloaded
	protected function content_template() { ?>
		<# view.addInlineEditingAttributes( 'text', 'none' ); #>
		
	    <h2 {{{ view.getRenderAttributeString( 'text' ) }}} id="editor" style="color: peru; text-align:center">{{{ settings.title }}}</h2>
    <?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Delete_Section_Widget() );