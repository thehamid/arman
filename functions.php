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
    wp_enqueue_script( 'jquery-load', get_template_directory_uri() . '/style/js/jquery-3.3.1.js');
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/style/js/bootstrap.min.js');
    wp_enqueue_script( 'owl', get_template_directory_uri() . '/style/js/owl.carousel.min.js');
    wp_enqueue_script( 'gsap', get_template_directory_uri() . '/style/js/gsap.min.js');
    wp_enqueue_script( 'popper', get_template_directory_uri() . '/style/js/popper.min.js');
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/style/js/main.js', array( 'jquery' ), '1.0', true );

}
add_action('wp_enqueue_scripts', 'theme_styles');

//Theme Support
function arman_setup_theme(){
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_image_size('slider','1100','500','true');



    add_theme_support('post-thumbnails');
    // Set Logo Theme at Customizer
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 220,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );
}
add_action('after_setup_theme','arman_setup_theme');

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

//rahnamaye safahat
function web_breadcrumb(){
    if(!is_home()){
        echo '<nav class="breadcrumb">';
        echo '<a href="'.home_url('/').'">خانه</a><span class="divider"> / </span>';
        if(is_category() || is_single()){
            the_category(' <span class="divider"> / </span> ');
            if(is_single()){
                echo '<span class="divider"> / </span>';
                the_title();
            }
        } else if(is_page()){
            echo the_title();
        }
        echo '</nav>';
    }
}


// Add Post Type Hero
function my_hero(){

    $label = array(
        'name'			=> 'hero',
        'singular_name' => 'hero',
        'menu_name'		=> 'اسلایدر',
        'add_new'		=> 'افزودن اسلاید تازه',
        'add_new_item'  => 'افزودن تصویر تازه',
        'edit_item'		=> 'ویرایش',
        'all_item'		=> 'نمایش همه',
        'veiw_item'		=> 'نمایش',
        'search_items'  => 'جستجو',
        'not_found'		=> 'پستی ثبت نشده است'
    );

    $args = array(
        'labels'		=> $label,
        'description'   => 'پست تایپ شاخص',
        'public'        => true,
        'query_var'     => true,
        'capability_type'    => 'page',
        'menu_position' => 30,
        'has_archive'   => true,
        'supports'      => array('title','editor','thumbnail',),
    );

    register_post_type( 'hero', $args );
}
add_action('init', 'my_hero');


//widget footer
function my_widget_footer(){
    register_sidebar( array(
            'name'			=> 'ابزارک پاورقی راست',
            'id'			=> 'footer-right',
            'description'	=> 'ابزارک شخصی سایت',
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => ''
        )
    );

    register_sidebar( array(
            'name'			=> 'ابزارک پاورقی چپ',
            'id'			=> 'footer-left',
            'description'	=> 'ابزارک شخصی سایت',
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => ''
        )
    );

    register_sidebar( array(
            'name'			=> 'ابزارک پاورقی وسط',
            'id'			=> 'footer-center',
            'description'	=> 'ابزارک شخصی سایت',
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => ''
        )
    );

    register_sidebar( array(
            'name'			=> 'ابزارک سایدبار',
            'id'			=> 'sidebar-widget',
            'description'	=> 'ابزارک شخصی سایت',
            'before_widget' => '<div class="inner">',
            'after_widget'  => '</div>',
            'before_title'  => '',
            'after_title'   => ''
        )
    );

}
add_action('widgets_init', 'my_widget_footer');