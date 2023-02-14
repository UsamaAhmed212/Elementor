<?php 

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Define constants
 */
// Elementor Templates Library path/URI.
$elementor_directory_end_path = str_replace( '\\', '/', str_replace( str_replace( '/', '\\', get_template_directory() ), '', __DIR__ ) );

define( 'ELEMENTOR_TEMPLATES_LIBRARY_DIR', get_template_directory() . $elementor_directory_end_path );
define( 'ELEMENTOR_TEMPLATES_LIBRARY_DIR_URI', get_template_directory_uri() . $elementor_directory_end_path );

/**
 * Define Project Name constants
 */
// Remove Space Special Characters.
$PROJECT_NAME = trim( preg_replace( '/\s+/', '-',  preg_replace( '/[^A-Za-z0-9]/', ' ', strtolower( wp_get_theme() ) ) ), '-' );

define( 'PROJECT_NAME', $PROJECT_NAME );

// Elementor Initialize Class
class ElementorInitialization {

	private static $instance = null;

	public static function instance() {
        if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {

		add_action( 'elementor/controls/controls_registered', array( $this, 'controls_registered' ) );
		
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
		
		add_action( 'elementor/elements/categories_registered', array( $this, 'elementor_custom_categories' ) );
		
		add_action( 'elementor/editor/before_enqueue_styles', array( $this, 'elementor_editor_styles' ) );
		
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'elementor_editor_scripts' ) );

		$this->elementor_templates_library();
		
	}

	// Elementor Controls Register
	public function controls_registered() {
 
        /* We look for any theme overrides for this custom Elementor element.
		If no theme overrides are found we use the default one in this plugin. */

		$widget_file = ELEMENTOR_TEMPLATES_LIBRARY_DIR . '/elementor-controls-register.php';
		$template_file = locate_template( $widget_file );

		if ( !$template_file || !is_readable( $template_file ) ) {
			$template_file = ELEMENTOR_TEMPLATES_LIBRARY_DIR . '/elementor-controls-register.php';
		}

		if ( $template_file && is_readable( $template_file  ) ) {
			require_once $template_file;
		}

	}

	// Elementor Widgets Register
	public function widgets_registered() {
 
		/* We look for any theme overrides for this custom Elementor element.
		If no theme overrides are found we use the default one in this plugin. */

		$widget_file = ELEMENTOR_TEMPLATES_LIBRARY_DIR . '/elementor-widgets-register.php';
		$template_file = locate_template( $widget_file );

		if ( !$template_file || !is_readable( $template_file ) ) {
			$template_file = ELEMENTOR_TEMPLATES_LIBRARY_DIR . '/elementor-widgets-register.php';
		}

		if ( $template_file && is_readable( $template_file  ) ) {
			require_once $template_file;
		}

	}

	// Elementor Custom Categories
	public function elementor_custom_categories( $elements_manager ) {

		// Elementor Custom ( box-Shadow ) Categorie
		$elements_manager->add_category( 'box-Shadow', array(
			'title' => esc_html__( 'Box Shadow', 'boxshadow' )
		) );
		
	}

	// Elementor Editor Styles Enqueue
	public function elementor_editor_styles() {

		// Font Awesome V6.1.2 Enqueue
		wp_register_style( 'font-awesome-free', '//use.fontawesome.com/releases/v6.1.2/css/all.css', array(), '6.1.2', 'all' );
		wp_enqueue_style( 'font-awesome-free' );
		
		// Boxshadow Elementor Editor Css Enqueue
		wp_register_style( 'boxshadow-elementor-editor', BOXSHADOW_THEME_DIR_URI . 'inc/elementor/assets/css/elementor-editor.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'boxshadow-elementor-editor' );
		
	}

	// Elementor Editor Scripts Enqueue
	public function elementor_editor_scripts() {

		// Svg Loader Js Enqueue
		wp_register_script( 'boxshadow-svg-loader', BOXSHADOW_THEME_DIR_URI . 'assets/js/svg-loader.js', array(), '1.0.0', true );
		wp_enqueue_script( 'boxshadow-svg-loader' );

	}

	/**
	 * Elementor Templates Library Main Function
	 *
	 */
	public function elementor_templates_library() {
	
		// Elementor Templates Library Class
		require __DIR__ . '/templates-library/templates-library.php';
		
	}

}

ElementorInitialization::instance();