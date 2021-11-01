<?php
function register_navwalker(){
    if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
        // File does not exist... return an error.
        return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
    } else {
        // File exists... require it.
        require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
    }
}
add_action( 'after_setup_theme', 'register_navwalker' );

// Load the theme stylesheets
function theme_styles()
{

    // Load all of the styles that need to appear on all pages
    wp_enqueue_style( 'wc-style', get_template_directory_uri() . '/style/css/wc_custom_style.css' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/style/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/style/css/bootstrap-rtl.css' );
    wp_enqueue_style( 'fa', get_template_directory_uri() . '/style/css/fa5.css' );
    wp_enqueue_style( 'font', get_template_directory_uri() . '/style/css/font.css' );
    wp_enqueue_style( 'owl-css', get_template_directory_uri() . '/style/css/owl.carousel.min.css' );
    wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/style/css/owl.theme.default.css' );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css' );

    // Load all of the script that need to appear on all pages
    wp_enqueue_script( 'jquery-load', get_template_directory_uri() . '/style/js/jquery-3.4.1.min.js');
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/style/js/bootstrap.min.js');
    wp_enqueue_script( 'owl', get_template_directory_uri() . '/style/js/owl.carousel.min.js');
    wp_enqueue_script( 'gsap', get_template_directory_uri() . '/style/js/gsap.min.js');
    wp_enqueue_script( 'popper', get_template_directory_uri() . '/style/js/popper.min.js');
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/style/js/main.js', array( 'jquery' ), '1.0', true );

}
add_action('wp_enqueue_scripts', 'theme_styles');

//Theme Support
add_theme_support('post-thumbnails');
// Set Logo Theme at Customizer
add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 220,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
) );

//Menu Register
function register_my_menus() {
    register_nav_menus(
        array(
            'main-menu' => __( 'منوی اصلی' ),

        )
    );
}
add_action( 'init', 'register_my_menus' );

add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
    if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
        if ( array_key_exists( 'data-toggle', $atts ) ) {
            unset( $atts['data-toggle'] );
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}