<?php 

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// We check if the Elementor plugin has been installed / activated.
if ( defined( 'ELEMENTOR_PATH' ) && class_exists( 'Elementor\Base_Data_Control' ) ) {

    require_once( BOXSHADOW_THEME_DIR . 'inc/elementor/elementor-controls/boxshadow-contact-form-control/boxshadow-contact-form-control.php' );

    require_once( BOXSHADOW_THEME_DIR . 'inc/elementor/elementor-controls/contact-form-7-control/contact-form-7-control.php' );
    
}