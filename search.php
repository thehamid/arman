<?php get_header(); ?>

<div class="post-area">

    <div class="container">

        <div class="title-section">نتیجه جستجو برای : <?php the_search_query(); ?>
        </div>

        <?php while(have_posts()) : the_post(); ?>

            <article id="post" <?php post_class(); ?>>

                <div class="Postimg">
                    <a href="<?php the_permalink(); ?>">
                        <?php if(has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail(); ?>

                        <?php endif; ?>
                    </a>
                </div>
                <div class="postcontent">
                    <p><?php the_date('d  F  Y'); ?></p>
                    <a href="<?php the_permalink(); ?>"> <h3><?php the_title(); ?></h3></a>
                    <?php the_excerpt(); ?>
                </div>




            </article>

        <?php endwhile; ?>





    </div>

</div>
<!-- End Content -->
<?php get_footer(); ?>






