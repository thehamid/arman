<section class="hero container wow fadeIn">
<!--    <img src="--><?php //echo get_template_directory_uri(); ?><!--/img/slider1.jpg" alt="">-->
    <article id="owl-demo" class="owl-carousel owl-theme">
        <?php

        $args = array('post_type' => 'hero','posts_per_page' => 5,);
        $posts = get_posts($args);
        foreach ($posts as $post) : setup_postdata($post); ?>
            <div class="item">
                <?php
                $link = get_the_content(); ?>

                <a  href="<?php echo $link; ?>">
                    <?php if(has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('slider'); ?>

                    <?php endif; ?>

                </a>
            </div>


        <?php endforeach; ?>
    <?php wp_reset_query(); ?>
    </article>

</section>
