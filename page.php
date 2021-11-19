<?php
/**
 * page.php
 *
 */
?>

<?php get_header(); ?>
<div class="page" role="main">
     <div class="container">
        <?php if(function_exists('web_breadcrumb')) web_breadcrumb(); ?>

        <?php while (have_posts()) : the_post(); ?>

            <div class="page-content">
                <h1><?php the_title(); ?></h1>
                <p> <?php the_content(); ?></p>

            </div>

        <?php if(comments_open() || get_comments_number()):?>
            <div class="comments">
                <div class="area">
                    <?php comments_template(); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php endwhile; ?>

    </div>
</div>


<?php get_footer(); ?>
