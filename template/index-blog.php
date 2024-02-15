<section class="blog">
    <div class="container">
        <?php
        global $wp;
        $url=home_url( $wp->request );
        $key='en';
        if (strpos($url, $key) == false) {?>
        <div class="section-title">
            <h4>مطالب و اخبار آرمان</h4>
            <a href="<?php echo home_url(); ?>\blog" class="btn btn-outline-secondary"> همه مطالب</a>
        </div>
            <?php
        }
        else {
        ?>
        <div class="section-title">
            <h4>Articles & News</h4>
            <a href="<?php echo home_url(); ?>\blog" class="btn btn-outline-secondary"> All Articles </a>
        </div>

        <?php
        }
        ?>
        <div class="row">

            <?php query_posts(array('orderby'=>'ASC', 'post_type' => 'post','posts_per_page' => 3,)); ?>
            <?php while( have_posts()) : the_post();  ?>


            <div class="col-sm-12 col-md-6 col-lg-4">
                <a href="<?php the_permalink(); ?>" class="blog-card wow fadeInRight">
                    <div class="post-img">
                        <?php if(has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        <?php else : ?>
                            <img src="https://via.placeholder.com/300">
                        <?php endif; ?>


                    </div>
                    <div class="post-expert">
                        <h3><?php the_title(); ?></h3>
                        <p><?php the_excerpt(); ?></p>
                    </div>


                </a>
            </div>



            <?php endwhile; ?>
            <?php wp_reset_query(); ?>

        </div>
    </div>

</section>