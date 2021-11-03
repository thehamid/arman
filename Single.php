<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
    <section class="hero">
        <div class="single-title">
            <h6><?php the_category( ' ' ); ?></h6>
            <h3><?php the_title(); ?> </h3>
            <h5> <?php echo the_date('d,F,Y'); ?> | <?php the_author(); ?> | <span class="fab fa-clock"></span>
                <?php echo do_shortcode('[rt_reading_time]'); ?> </h5>

        </div>

        <div class="single-img">
            <?php if(has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url(); ?>">
            <?php endif; ?>

        </div>

    </section>

    <section class="single-content">

        <div class="container">

            <div class="main-content">
                <?php the_content(); ?>

            </div>




            <div class="footnote">
                <span><i class="fa fa-tags" aria-hidden="true"></i><?php the_tags(''); ?></span>


            </div>


            <div class="comments" >
                <div class="area">
                    <?php comments_template(); ?>
                </div>
            </div>

        </div><!-- End Container -->
    </section>





    <section class="pagination" >

        <?php $nextPost = get_next_post(true);
        if($nextPost) { ?>
            <div class="next" style="background-image: url('<?php  echo get_the_post_thumbnail_url($nextPost->ID); ?>')">

                <a href="<?php echo get_permalink($nextPost->ID) ?>">  <div class="content">
                        <span>مطلب بعدی</span>
                        <h3><?php echo get_the_title($nextPost->ID)?></h3>
                    </div></a>
            </div>
        <?php } ?>

        <?php $prevPost = get_previous_post(true);
        if($prevPost) {?>
            <div class="previous" style="background-image: url('<?php  echo get_the_post_thumbnail_url($prevPost->ID); ?>')">
                <a href="<?php echo get_permalink($prevPost->ID) ?>"> <div class="content">
                        <span>مطلب قبلی</span>
                        <h3><?php echo get_the_title($prevPost->ID)?></h3>
                    </div></a>

            </div>
        <?php } ?>



    </section>

<?php endif; ?>


<?php get_footer(); ?>

