<?php get_header(); ?>

<?php if (have_posts()) : the_post(); ?>
    <div class="container">
        <div class="row mt-4">
            <section class="col-lg-9">
                <section class="single-hero">
                    <div class="single-title">
                        <h6><?php the_category(' '); ?></h6>
                        <h3><?php the_title(); ?> </h3>
                    </div>

                    <div class="single-img">
                        <?php if(has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        <?php else : ?>
                            <img src="https://via.placeholder.com/600">
                        <?php endif; ?>

                    </div>

                </section>

                <section class="single-content">


                    <div class="main-content">
                        <?php the_content(); ?>

                    </div>


                    <div class="footnote">
                        <span><i class="fa fa-tags" aria-hidden="true"></i><?php the_tags(''); ?></span>


                    </div>


                    <div class="comments">
                        <div class="area">
                            <?php comments_template(); ?>
                        </div>
                    </div>


                </section>




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
<?php endif; ?>


<?php get_footer(); ?>

