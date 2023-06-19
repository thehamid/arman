
<section class="crowd-funding2">
    <div class="container">

        <div class="section-title">
            <h4>پروژه‌های حمایتی</h4>
            <a href="<?php echo home_url(); ?>\projects" class="btn btn-outline-secondary"> همه پروژه‌ها</a>
        </div>


        <div class="row">
            <?php

            $args = array('post_type' => 'projects','posts_per_page' => 3,);
            $posts = get_posts($args);
            foreach ($posts as $post) : setup_postdata($post); ?>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="cf-item">
                        <div class="cf-img">
                            <?php if(has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail(); ?>

                            <?php endif; ?>
                        </div>


                        <div class="cf-content">
                            <h3><?php the_title(); ?></h3>
                            <p><?php the_excerpt(); ?></p>
                            <?php
                            $start = get_post_meta($post->ID,'project_start',TRUE);
                            $target = get_post_meta($post->ID,'project_target',TRUE);
                            $remaining = get_post_meta($post->ID,'project_remaining',TRUE);
                            $done = get_post_meta($post->ID,'project_done',TRUE);

                            $now = time(); // or your date as well
                            $your_date = strtotime($remaining);
                            $datediff = $your_date - $now;


                            ?>


                            <div class="cf-content-index">


                             <div class="cf-content-footer">

                                <span>
                                    <div class="tit"><i class="fad fa-bullseye"></i>هدف</div>
                                    <div class="num">  <?php if(isset($target) && !empty($target)) : ?>
                                            <?php echo number_format($target); ?>
                                        <?php endif; ?></div>
                                    <div class="currency">تومان</div>
                                </span>
                                            <div class="line"></div>
                                 <span>
                                    <div class="tit"><i class="fad fa-box-heart"></i>اهدایی</div>
                                    <div class="num">  <?php if(isset($start)) : ?>
                                            <?php echo number_format($start); ?>
                                        <?php endif; ?></div>
                                     <div class="currency">تومان</div>
                                </span>

                             </div>

                             <div class="cf-content-footer">

                                    <span>
                                        <?php
                                        $percent = 0;
                                        $percent = round(($start * 100) / $target);

                                        ?>
                                        <div class="percent">
                                            <svg>
                                              <defs>
                                                <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                                  <stop offset="0%" stop-color="#8523ff" />
                                                  <stop offset="100%" stop-color="#5eaefd" />
                                                </linearGradient>
                                              </defs>
                                              <circle cx="55" cy="55" r="50" fill="none" stroke="#f0f0f0"></circle>
                                              <circle cx="55" cy="55" r="50" stroke="url(#gradient)"  fill="none"  style="--percent:<?php echo $percent ?>" ></circle>
                                            </svg>
                                            <div class="number">
                                              <h3><?php echo $percent.'%' ?></h3>
                                            </div>
                                        </div>
                                 </span>

                                       <div class="line"></div>

                                 <span>
                                    <div class="tit"><i class="fad fa-alarm-clock"></i>زمان باقیمانده</div>
                                    <div class="num">  <?php if(isset($datediff) && !empty($datediff)) : ?>
                                            <?php if($datediff>0): ?>
                                                <?php echo round($datediff / (60 * 60 * 24)) ." روز"; ?>
                                            <?php else: ?>
                                                <?php echo "تمام شد" ?>
                                            <?php endif; ?>
                                        <?php endif; ?> </div>
                                </span>



                             </div>






                            </div>






                        </div>

                            <?php if($datediff>0 && $start<$target){ ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-theme">حمایت می‌کنم<i class="fal fa-heart fa-beat"></i></a>
                            <?php }else{ ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-theme">پروژه پایان یافت<i class="fal fa-flag"></i></a>
                             <?php } ?>
                    </div>

                </div>

            <?php endforeach; ?>
            <?php wp_reset_query(); ?>
        </div>

    </div>
</section>