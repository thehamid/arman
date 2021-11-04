<?php
/**
 * page.php
 *
 */
?>

<?php get_header(); ?>

<div class="page container" role="main">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>

            <div class="page-content">
                <h1><?php the_title(); ?></h1>
                <p> <?php the_content(); ?></p>

            </div>

            <div class="comments">
                <div class="area">
                    <?php comments_template(); ?>
                </div>
            </div>

        <?php endwhile; ?>

    </div>
</div>


<?php get_footer(); ?>
