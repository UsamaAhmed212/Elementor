<?php 

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// We check if the Elementor plugin has been installed / activated.
if ( defined( 'ELEMENTOR_PATH' ) && class_exists( 'Elementor\Widget_Base' ) ) {

    require_once( BOXSHADOW_THEME_DIR . 'inc/elementor/elementor-widgets/contact-section-widget/contact-section-widget.php' );
    
    require_once( BOXSHADOW_THEME_DIR . 'inc/elementor/elementor-widgets/delete-widget/delete-widget.php' );
    require_once( BOXSHADOW_THEME_DIR . 'inc/elementor/elementor-widgets/delete-widget/delete-widget-1.php' );

}