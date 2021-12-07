<?php
/**
 * 404.php
 *
 * The template for displaying 404 pages (Not Found).
 */
?>

<?php get_header(); ?>


    <div class="page" role="main">
        <div class="container">


            <h1><?php _e( 'Error 404', 'armanhome' ); ?></h1>

            <div class="page-404">
              <img src="<?php echo get_template_directory_uri(); ?>/img/404.png" >
               <h3><?php _e( 'صفحه مورد نظر موجود نمی‌باشد', 'armanhome' ); ?></h3>
               <a class="btn btn-theme" href="<?php echo home_url(); ?>">بازگشت &raquo; </a>
            </div>


    </div> <!-- end container-404 -->
    </div>
<?php get_footer(); ?>