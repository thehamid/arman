<?php
/*
archive.php
*/
?>

<?php get_header(); ?>

<div class="archive container">
    <div class="row mt-4">
        <section class="col-lg-9">
            <div class="title-section">بایگانی : <?php the_archive_title(); ?></div>
            <div class="row">
                <?php while(have_posts()) : the_post(); ?>

                    <div class="col-12">
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




        </section>
        <section class="col-lg-3">

            <aside class="sidebar">

                <?php if (is_active_sidebar('sidebar-widget')) : ?>
                    <?php dynamic_sidebar('sidebar-widget'); ?>
                <?php endif; ?>
            </aside>

        </section>

    </div>


</div>




<!-- End Content -->
<?php get_footer(); ?>






