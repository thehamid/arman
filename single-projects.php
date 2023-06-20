<?php
global $wpdb;
global $verify;
global $post;
global $status;
global $pay_id;
global $error;
global $table;
global $donors_count;

?>
<?php get_header(); ?>

<?php if (have_posts()) : the_post(); ?>
    <div class="container">
        <div class="row mt-4">
            <section class="col-lg-6">
                <section class="single-hero">
                    <div class="single-title">
                        <h3><?php the_title(); ?> </h3>
                    </div>

                    <div class="single-img">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        <?php else : ?>
                            <img src="https://via.placeholder.com/600" alt="placeholder">
                        <?php endif; ?>

                    </div>

                </section>
            </section>


            <section class="col-lg-6">

                <aside class="project-info">
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
                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar"
                                 style="width: <?php echo $percent; ?>%"
                                 aria-valuenow="<?php echo $percent; ?>"
                                 aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-value"><?php echo $percent; ?>%</div>
                            </div>
                        </div>


                        <div class="cf-content-footer">
                                <span>
                                    <span class="tit"><i class="fad fa-bullseye"></i>هدف</span>
                                    <span class="num">  <?php if (isset($target) && !empty($target)) : ?>
                                            <?php echo number_format($target); ?>
                                        <?php endif; ?> تومان</span>
                                </span>
                            <div class="line"></div>
                            <span>
                                    <span class="tit"><i class="fad fa-box-heart"></i>اهدایی</span>
                                    <span class="num">  <?php if (isset($start)) : ?>
                                            <?php echo number_format($start); ?>
                                        <?php endif; ?> تومان</span>
                                </span>
                            <div class="line"></div>
                            <span>
                                    <span class="tit"><i class="fad fa-alarm-clock"></i>زمان باقیمانده</span>
                                    <span class="num"> <?php if(isset($datediff) && !empty($datediff)) : ?>
                                            <?php if($datediff>0): ?>
                                                <?php echo round($datediff / (60 * 60 * 24)) ." روز"; ?>
                                            <?php else: ?>
                                                <?php echo "تمام شد" ?>
                                            <?php endif; ?>
                                        <?php endif; ?> </span>
                                </span>
                        </div>


                    </div>
                        <?php
                        $donors_count = $wpdb->get_var( $wpdb->prepare(
                            "SELECT COUNT(*) AS id FROM {$wpdb->prefix}projects_donors WHERE status=1 AND project_id={$post->ID}"

                        ) );

                        ?>
                    <h6> <i class="fad fa-hands-heart"></i><span><?php echo $donors_count; ?> </span>  نفر حامی ما در تکمیل این پروژه بوده‌اند</h6>


                </aside>

            </section>


            <section class="single-content col-lg-6">
                <h4>توضیحات</h4>
                <?php the_content(); ?>

            </section>

            <section class="project-pay col-lg-6">

                <?php if($verify){ ?>
                    <?php echo $status; ?>
                    <p class="text-danger"><?php echo $error; ?></p>

                <?php } elseif($datediff>0 && $start<$target){ ?>

                    <div class="pay-form">
                        <form method="post" class="row g-3" id="projectForm">
                            <input type="hidden" class="form-control" id="projectId" name="project_id" value="<?php the_ID(); ?>">
                            <input type="hidden" class="form-control" id="projectLink" name="project_link" value="<?php the_permalink(); ?>">
                            <div class="col-12">
                                <label class="form-label">نام شما</label>
                                <input type="text" class="form-control" id="Name" name="name"   required=""
                                       oninvalid="this.setCustomValidity('وارد کردن نام الزامی است')"
                                       oninput="setCustomValidity('')"/>

                            </div>
                            <div class="col-12">
                                <label  class="form-label">تلفن تماس</label>
                                <input type="text" class="form-control" id="Phone" name="phone"  required="" oninvalid="this.setCustomValidity('وارد کردن تلفن الزامی است')"  oninput="setCustomValidity('')">
                            </div>
                            <div class="col-12 d-flex flex-column">
                                <label  class="form-label">انتخاب مبلغ اهدایی</label>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="project-option" id="btnradio1" autocomplete="off" value="50000" >
                                    <label class="btn btn-outline-primary" for="btnradio1">50,000 تومان</label>

                                    <input type="radio" class="btn-check" name="project-option" id="btnradio2" autocomplete="off" value="100000">
                                    <label class="btn btn-outline-primary" for="btnradio2">100,000 تومان</label>

                                    <input type="radio" class="btn-check" name="project-option" id="btnradio3" autocomplete="off" value="200000">
                                    <label class="btn btn-outline-primary" for="btnradio3">200,000 تومان</label>

                                    <input type="radio" class="btn-check" name="project-option" id="btnradio4" autocomplete="off" value="500000">
                                    <label class="btn btn-outline-primary" for="btnradio4">500,000 تومان</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label  class="form-label">مبلغ اهدایی به تومان </label>
                                <input id="input_number" type="text" class="form-control" placeholder="لطفا مبلغ را به تومان وارد کنید..." id="Value" name="value" required="" oninvalid="this.setCustomValidity('وارد کردن مبلغ الزامی است')"  oninput="setCustomValidity('')">
                                <span id="farsi">.</span>
                            </div>



                            <div class="col-12">
                                <button type="submit" class="btn btn-theme" name="pay"><i class="fal fa-heart"></i><span class="m-1">پرداخت آنلاین</span></button>
                            </div>
                        </form>
                        <p class="text-danger"><?php echo $error; ?></p>

                    </div>


                <?php }else{ ?>

                    <h3 class="text-success text-center border border-warning p-5">
                        با سپاس از همراهی شما<br>
                        این پروژه پایان یافت
                    </h3>
                    <h3 class="text-warning text-center border border-warning p-5">
                        در صورت تمایل به همراهی بیشتر با ما <br>
                        از طریق صفحه زیر اقدام نماید
                        <a href="<?php echo home_url(); ?>/donation" class="btn btn-theme"><i class="fal fa-heart"></i>کمک آرمانی</a>
                    </h3>

                <?php }?>

            </section>





        </div>


    </div>
<?php endif; ?>


<?php get_footer(); ?>

