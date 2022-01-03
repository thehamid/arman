<?php
/**
 * single-product.php
 *
 * The template for displaying single product.
 */
?>

<?php get_header(); ?>

<div class="main__single__product container" role="main">

    <?php while( have_posts() ) : the_post(); ?>
        <div class="main__product">

            <div class="thumbnail__product">
                <img src="<?php the_post_thumbnail_url(); ?>">
            </div>

            <div class="title__product">
                <div class="content__product">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                    <p><?php echo $product->get_price_html(); ?></p>

                    <?php woocommerce_template_loop_add_to_cart( $loop->post );?>
                </div>
            </div>

        </div>


    <?php endwhile; ?>


    <div class="related-posts">
        <!-- begin custom related loop, isa -->
        <h5><?php echo $related; ?></h5>
        <div class="main__products">
            <?php

            // get the custom post type's taxonomy terms

            $custom_taxterms = wp_get_object_terms( $post->ID, 'your_taxonomy', array('fields' => 'ids') );
            // arguments
            $args = array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'posts_per_page' => 3, // you may edit this number
                'orderby' => 'rand',
                'post__not_in' => array ($post->ID),
            );
            $related_items = new WP_Query( $args );
            // loop over query
            if ($related_items->have_posts()) :

                while ( $related_items->have_posts() ) : $related_items->the_post();?>

                    <article class="item" >
                        <a href="<?php the_permalink(); ?>">
                            <div class="item__bg" style="background-image:
                                url(<?php if(has_post_thumbnail()) : ?>
                             '<?php the_post_thumbnail_url(); ?>'
                         <?php else : ?>
                            '<?php echo get_template_directory_uri(); ?>/img/logo.jpg'
                         <?php endif; ?> )">

                            </div>
                            <div class="item__name">
                                <h6><?php the_title(); ?></h6>
                                <p><?php echo $product->get_price_html(); ?></p>
                            </div>
                        </a>
                    </article>

                <?php
                endwhile;

            endif;
            // Reset Post Data
            wp_reset_postdata();
            ?>
        </div>

        <!-- end custom related loop, isa -->



    </div>
</div> <!-- end main-content -->



<?php get_footer(); ?>

