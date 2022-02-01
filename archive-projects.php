<?php
/*
	Template Name: Projects
*/
?>
<?php get_header(); ?>
    <div class="archive" role="main">
        <div class="crowd-funding2">
            <div class="container">
                <div class="title-section">پروژه‌ها </div>
                <div class="row">
                    <?php query_posts(array(
                            'post_type'=>'projects',
                        'posts_per_page'=>9 ,
                        'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1)); ?>
                    <?php while( have_posts()) : the_post();  ?>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="cf-item">
                                <div class="cf-img">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail(); ?>

                                    <?php endif; ?>
                                </div>


                                <div class="cf-content">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php the_excerpt(); ?></p>
                                    <?php
                                    $start = get_post_meta($post->ID, 'project_start', TRUE);
                                    $target = get_post_meta($post->ID, 'project_target', TRUE);
                                    $remaining = get_post_meta($post->ID, 'project_remaining', TRUE);
                                    $done = get_post_meta($post->ID, 'project_done', TRUE);

                                    $now = time(); // or your date as well
                                    $your_date = strtotime($remaining);
                                    $datediff = $your_date - $now;


                                    ?>
                                    <div class="progress">
                                        <?php
                                        $percent = 0;
                                        $percent = round(($start * 100) / $target);

                                        ?>
                                        <div class="progress-bar bg-info" role="progressbar"
                                             style="width: <?php echo $percent; ?>%"
                                             aria-valuenow="<?php echo $percent; ?>"
                                             aria-valuemin="0" aria-valuemax="100"> <?php echo $percent; ?>%
                                        </div>
                                    </div>


                                    <div class="cf-content-footer">
                                <span>
                                    <div class="tit"><i class="fad fa-bullseye"></i>هدف</div>
                                    <div class="num">  <?php if (isset($target) && !empty($target)) : ?>
                                            <?php echo number_format($target); ?>
                                        <?php endif; ?> تومان</div>
                                </span>
                                        <div class="line"></div>
                                        <span>
                                    <div class="tit"><i class="fad fa-box-heart"></i>اهدایی</div>
                                    <div class="num">  <?php if (isset($start)) : ?>
                                            <?php echo number_format($start); ?>
                                        <?php endif; ?> تومان</div>
                                </span>
                                        <div class="line"></div>
                                        <span>
                                    <div class="tit"><i class="fad fa-alarm-clock"></i>زمان باقیمانده</div>
                                    <div class="num">  <?php if (isset($datediff) && !empty($datediff)) : ?>
                                            <?php if ($datediff > 0): ?>
                                                <?php echo round($datediff / (60 * 60 * 24)) . " روز"; ?>
                                            <?php else: ?>
                                                <?php echo "تمام شد" ?>
                                            <?php endif; ?>
                                        <?php endif; ?> </div>
                                </span>
                                    </div>


                                </div>

                                <?php if ($datediff > 0 && $start < $target) { ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-theme"><i
                                                class="fal fa-heart"></i>حمایت می‌کنم</a>
                                <?php } else { ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-theme"><i
                                                class="fal fa-flag"></i>پروژه پایان یافت</a>
                                <?php } ?>
                            </div>

                        </div>

                    <?php endwhile; ?>
                </div>
            </div>
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