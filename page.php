<?php
/**
 * page.php
 *
 */
?>

<?php get_header(); ?>
<div class="page container" role="main">

        <?php while (have_posts()) : the_post(); ?>


            <h1><?php the_title(); ?></h1>
            <div class="page-content">
                 <?php the_content(); ?>
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


<?php get_footer(); ?>
