<?php
/*
	Template Name: Blog
*/
?>
<?php get_header(); ?>
    <div class="blog container" role="main">
        <div class="row">
            <?php
            $temp = $wp_query;
            $wp_query = null;
            $wp_query = new WP_Query();
            $wp_query->query('posts_per_page=10' . '&paged=' . $paged);
            while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                <div class="col-md-6 col-sm-12">
                    <a href="<?php the_permalink(); ?>" class="blog-card">
                        <div class="post-img">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        </div>
                        <div class="post-expert">
                            <h3><?php the_title(); ?></h3>
                            <p><?php the_excerpt(); ?></p>
                        </div>


                    </a>
                </div>

            <?php endwhile; ?>
        </div>


        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php global $wp_query;
                $total_pages = $wp_query->max_num_pages;

                if ($total_pages > 1) {

                    $current_page = max(1, get_query_var('paged'));

                    echo paginate_links(array(
                        'base' => get_pagenum_link(1) . '%_%',
                        'format' => '/page/%#%',
                        'current' => $current_page,
                        'total' => $total_pages,
                    ));
                } ?>
            </ul>
        </nav>
    </div>
<?php get_footer(); ?>