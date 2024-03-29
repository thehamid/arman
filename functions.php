<?php

include "inc/projects.php";
include "woocommerce/woo-func.php";


function aspnetcdn_jquery() {
    if(!is_admin()) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.min.js', '1.9.0');
        wp_enqueue_script('jquery');
    }
}
add_action( 'wp_enqueue_scripts', 'aspnetcdn_jquery' );

// Load the theme stylesheets
function theme_styles()
{

    // Load all of the styles that need to appear on all pages
   wp_enqueue_style( 'wc-style', get_template_directory_uri() . '/style/css/wc_custom_style.css' );
   wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/style/css/bootstrap.min.css' );
   wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/style/css/bootstrap-rtl.css' );
    wp_enqueue_style( 'fa', get_template_directory_uri() . '/style/css/fa6.css' );
    wp_enqueue_style( 'font', get_template_directory_uri() . '/style/css/font.css' );
    wp_enqueue_style( 'owl-css', get_template_directory_uri() . '/style/css/owl.carousel.min.css');
    wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/style/css/owl.theme.default.css');
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/style/css/animate.min.css');
    wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css' );

    // Load all of the script that need to appear on all pages
    wp_enqueue_script( 'jquery-load', get_template_directory_uri() . '/style/js/jquery-3.7.1.min.js');
    wp_enqueue_script( 'popper', get_template_directory_uri() . '/style/js/popper.min.js');
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/style/js/bootstrap.min.js');
    wp_enqueue_script( 'owl', get_template_directory_uri() . '/style/js/owl.carousel.min.js');
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/style/js/wow.min.js');
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/style/js/fa6.js');
    wp_enqueue_script( 'wordifyfa', get_template_directory_uri() . '/style/js/wordifyfa.js');
    wp_enqueue_script( 'project-ajax', get_template_directory_uri() . '/style/js/project-ajax.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/style/js/main.js', array( 'jquery' ), '1.0', true );

}
add_action('wp_enqueue_scripts', 'theme_styles');

function mytheme_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'mytheme_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'mytheme_customize_partial_blogdescription',
            )
        );
    }



    $wp_customize->add_setting('logo_English');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_English', array(
        'label' => 'English Logo',
        'section' => 'title_tagline',
        'settings' => 'logo_English',
        'priority' => 9
    )));
}
add_action( 'customize_register', 'mytheme_customize_register' );



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
            'lang-menu' => __( 'منوی زبان' ),
        )
    );

}
add_action( 'init', 'register_my_menus' );

//excerpt length
function mytheme_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );

//Hide Login Errors in WordPress
function no_wordpress_errors(){
    return 'username or password is wrong';
}
add_filter( 'login_errors', 'no_wordpress_errors' );

//Hide Version WordPress
function wpb_remove_version() {
    return '';
}
add_filter('the_generator', 'wpb_remove_version');


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
        'name'          => __( 'فوتر 1' ),
        'id'            => 'arman_footer_one',

        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'فوتر 2' ),
        'id'            => 'arman_footer_two',

        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'فوتر 3' ),
        'id'            => 'arman_footer_three',

        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );



    register_sidebar( array(
            'name'			=> 'ناحیه کناری بلاگ',
            'id'			=> 'sidebar-widget',
            'before_widget' => '<div class="inner">',
            'after_widget'  => '</div>',
            'before_title'  => '',
            'after_title'   => ''
        )
    );

    register_sidebar( array(
            'name'			=> 'منوی کناری موبایل',
            'id'			=> 'header-mobile-menu',
            'before_widget' => '<div class="inner">',
            'after_widget'  => '</div>',
            'before_title'  => '',
            'after_title'   => ''
        )
    );


}
add_action('widgets_init', 'my_widget_footer');

function calb_comment($comment, $args, $depth)
{

    ?>
    <li class="comment ">
        <article class="comment-body">
            <footer class="comment-meta">
                <div class="comment-author ">
                    <?php echo get_avatar($comment, '128');  ?>
                    <?php printf(__('<b class="fn">%s</b> <span class="says">گفت:</span>'), get_comment_author_link()); ?>
                </div><!-- .comment-author -->

                <div class="comment-metadata">
                    <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                        <?php
                        /* translators: 1: date, 2: time */
                        printf(
                            __('%1$s'),
                            get_comment_date('l,Y,m')
                        ); ?>
                    </a>
                </div><!-- .comment-metadata -->

            </footer><!-- .comment-meta -->

            <div class="comment-content">
                <?php comment_text(); ?>
            </div><!-- .comment-content -->

            <div class="reply">
                <?php
                comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'add_below' => 'comment',
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth']
                        )
                    )
                ); ?>
            </div>
        </article><!-- .comment-body -->
    </li><!-- #comment-## -->
    <?php

}


