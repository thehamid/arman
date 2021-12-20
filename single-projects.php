<?php
global $wpdb;
global $verify;
if (isset($_POST['pay'])) {
//        $wpdb->insert("wp_doners_projects" ,
//        [
//                'project_id' => $_POST['project_id'],
//                'name' => $_POST['name'],
//                'phone' => $_POST['phone'],
//                'value' => $_POST['value'],
//        ]);

    $order_id = $_POST['project_id'];
    $price = $_POST['value'];
    $callback_url = $_POST['project_link'];

    $data = [
        'pin' => 'aqayepardakht',
        'amount' => $price,
        'callback' => $callback_url,
        'invoice_id' => $order_id,
        'description' => 'پرداخت از طریق افزونه پرداخت دلخواه'
    ];

    $data = json_encode($data);
    $ch = curl_init('https://panel.aqayepardakht.ir/api/create');
    var_dump($ch);
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
    $err = curl_error($ch);
    curl_close($ch);
    if ($result && !is_numeric($result)) {
        header('Location: https://panel.aqayepardakht.ir/startpay/' . $result);
    } else {
        echo "خطا" . $result;
        var_dump($result);
        echo "curl_error:" . $err;
    }


//        $start = get_post_meta($post->ID,'project_start',TRUE);
//        $add=$start+$_POST['value'];
//
//         update_post_meta($_POST['project_id'],'project_start',$add);


}elseif (isset($_POST[ "transid" ])){

   $verify=true;

}


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
                        global $post;
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
                                 aria-valuemin="0" aria-valuemax="100"><span class="text-dark"> <?php echo $percent; ?>%</span>
                            </div>
                        </div>


                        <div class="cf-content-footer">
                                <span>
                                    <span class="tit"><i class="fad fa-bullseye"></i>هدف</span>
                                    <span class="num">  <?php if (isset($target) && !empty($target)) : ?>
                                            <?php echo $target; ?>
                                        <?php endif; ?> تومان</span>
                                </span>
                            <div class="line"></div>
                            <span>
                                    <span class="tit"><i class="fad fa-box-heart"></i>اهدایی</span>
                                    <span class="num">  <?php if (isset($start)) : ?>
                                            <?php echo $start; ?>
                                        <?php endif; ?> تومان</span>
                                </span>
                            <div class="line"></div>
                            <span>
                                    <span class="tit"><i class="fad fa-alarm-clock"></i>زمان باقیمانده</span>
                                    <span class="num"> <?php if(isset($datediff) && !empty($datediff)) : ?>
                                            <?php echo round($datediff / (60 * 60 * 24)); ?>
                                        <?php endif; ?> روز</span>
                                </span>
                        </div>


                    </div>
                </aside>

            </section>


          <section class="single-content col-lg-6">
              <h4>توضیحات</h4>
                <?php the_content(); ?>

            </section>

            <section class="project-pay col-lg-6">

                <?php if($verify){ ?>
                    <h3>OK</h3>

                <?php }else{ ?>

                    <div class="pay-form">
                        <form method="post" class="row g-3">
                            <input type="hidden" class="form-control" name="project_id" value="<?php the_ID(); ?>">
                            <input type="hidden" class="form-control" name="project_link" value="<?php the_permalink(); ?>">
                            <div class="col-12">
                                <label class="form-label">نام شما</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="col-12">
                                <label  class="form-label">تلفن تماس</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                            <div class="col-12">
                                <label  class="form-label">مبلغ اهدایی به تومان </label>
                                <input type="number" class="form-control" placeholder="" name="value">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-theme" name="pay"><i class="fal fa-heart"></i><span class="m-1">پرداخت آنلاین</span></button>
                            </div>
                        </form>


                    </div>


                <?php } ?>





            </section>





        </div>


    </div>
<?php endif; ?>


<?php get_footer(); ?>

