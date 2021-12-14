<?php
global $wpdb;
if (isset($_POST['pay'])){
//        $wpdb->insert("wp_doners_projects" ,
//        [
//                'project_id' => $_POST['project_id'],
//                'name' => $_POST['name'],
//                'phone' => $_POST['phone'],
//                'value' => $_POST['value'],
//        ]);

    $order_id = $_POST['project_id'];
    $price =$_POST['value'];
    $callback_url = home_url()."/verify";

    $data = [
        'pin' => 'aqayepardakht',
        'amount' => $price,
        'callback' => $callback_url,
        'invoice_id' => $order_id,
        'description' => 'پرداخت از طریق افزونه پرداخت دلخواه'
    ];

    $data = json_encode($data);
    $ch = curl_init('https://panel.aqayepardakht.ir/api/create');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    $result = curl_exec($ch);
    $err=curl_error($ch);
    curl_close($ch);
    if ($result && !is_numeric($result)) {
        header('Location: https://panel.aqayepardakht.ir/startpay/' . $result);
    } else {
        echo "خطا".$result;
        var_dump($result);
        echo "curl_error:".$err;
    }







//        $start = get_post_meta($post->ID,'project_start',TRUE);
//        $add=$start+$_POST['value'];
//
//         update_post_meta($_POST['project_id'],'project_start',$add);



}



?>
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


                    <div class="cf-content">
                        <h3><?php the_title(); ?></h3>
                        <p><?php the_excerpt(); ?></p>
                        <?php
                        $start = get_post_meta($post->ID,'project_start',TRUE);
                        $target = get_post_meta($post->ID,'project_target',TRUE);
                        $remaining = get_post_meta($post->ID,'project_remaining',TRUE);
                        $done = get_post_meta($post->ID,'project_done',TRUE);


                        ?>
                        <div class="progress">
                            <?php
                            $percent=0;
                            $percent=(($start*100)/$target);

                            ?>
                            <div class="progress-bar bg-info" role="progressbar"
                                 style="width: <?php echo $percent; ?>%"
                                 aria-valuenow="<?php echo $percent; ?>"
                                 aria-valuemin="0" aria-valuemax="100"> <?php echo $percent; ?>%</div>
                        </div>



                        <div class="cf-content-footer">
                                <span>
                                    <div class="tit">هدف</div>
                                    <div class="num">  <?php if(isset($target) && !empty($target)) : ?>
                                            <?php echo $target; ?>
                                        <?php endif; ?> تومان</div>
                                </span>
                            <div class="line"></div>
                            <span>
                                    <div class="tit">اهدایی</div>
                                    <div class="num">  <?php if(isset($start) && !empty($start)) : ?>
                                            <?php echo $start; ?>
                                        <?php endif; ?> تومان</div>
                                </span>
                            <div class="line"></div>
                            <span>
                                    <div class="tit">زمان باقیمانده</div>
                                    <div class="num">  <?php if(isset($remaining) && !empty($remaining)) : ?>
                                            <?php echo $remaining; ?>
                                        <?php endif; ?> روز</div>
                                </span>
                        </div>


                    </div>

                    <div class="pay-form">
                        <form method="post" class="row g-3">
                            <input type="hidden" class="form-control" name="project_id" value="<?php the_ID();?>">
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">نام شما</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">تلفن تماس</label>
                                <input type="text" class="form-control"  name="phone">
                            </div>
                            <div class="col-6">
                                <label for="inputAddress" class="form-label">مبلغ اهدایی به تومان </label>
                                <input type="number" class="form-control"  placeholder="" name="value">
                            </div>

                            <div class="col-6">
                                <button type="submit" class="btn btn-primary" name="pay">پرداخت</button>
                            </div>
                        </form>




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

