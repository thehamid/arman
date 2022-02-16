<?php
/**
 * archive-product.php
 *
 * The template for displaying archive products.
 */
?>
<?php get_header(); ?>
    <div class="products__page container" role="main">
        <div class="row">
            <?php $loop = new WP_Query(array('post_type' => 'product', 'posts_per_page' => '9', 'paged' => get_query_var('paged') ? get_query_var('paged') : 1)
            ); ?>
            <?php while ($loop->have_posts()) : $loop->the_post();
                global $product; ?>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <article class="product-item">
                    <a href="<?php echo $product->get_permalink(); ?>">
                        <div class="image">
                            <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>"/>
                        </div>

                        <div class="title">
                            <?php echo $product->get_title(); ?>
                            <p><?php echo $product->get_price_html(); ?></p>
                        </div>
                    </a>
                </article>
            </div>
            <?php endwhile; ?>

        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php

                $big = 999999999; // need an unlikely integer
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $loop->max_num_pages
                ));
                ?>
            </ul>
        </nav>


    </div>
<?php get_footer(); ?>