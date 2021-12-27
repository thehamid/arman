<?php
global $wpdb;
global $verify;
global $post;
global $status;
global $pay_id;
global $error;
if (isset($_POST['pay'])) {



    $wpdb->insert("wp_projects_donors" ,
        [
            'project_id' => $_POST['project_id'],
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'value' => $_POST['value'],
            'status' => -2,
            'payment_id' =>0,
            'trans_id' =>0,
            'date_created' =>date("Y-m-d h:i:sa")
        ] );
    $pay_id=$wpdb->insert_id;



    $order_id = $_POST['project_id'];
    $price = $_POST['value'];
    $callback_url =add_query_arg(array('entry' => $pay_id),  $_POST['project_link']);

    $data = [
       // 'pin' => 'AD43F9951C17C475428B',
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
    $err = curl_error($ch);
    curl_close($ch);
    if ($result && !is_numeric($result)) {
        header('Location: https://panel.aqayepardakht.ir/startpay/' . $result);
    } else {
       $error=ppErr($result);

    }



}elseif (isset($_POST[ "transid" ])){

    global $wpdb;
    $value = $wpdb->get_var( $wpdb->prepare(
        " SELECT value FROM {$wpdb->prefix}projects_donors WHERE ID ={$_REQUEST['entry']}"

    ) );




   // $pin = 'AD43F9951C17C475428B';
    $pin = 'aqayepardakht';

    $url = 'https://panel.aqayepardakht.ir/api/verify/';
    $fields = array(
        'amount' =>$value,
        'pin' => urlencode( $pin ),
        'transid' => urlencode( $_POST[ "transid" ] ),
    );
    $fields_string = "";
    foreach ( $fields as $key => $value ) {
        $fields_string .= $key . '=' . $value . '&';
    }
    rtrim( $fields_string, '&' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, count( $fields ) );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields_string );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec( $ch );
    curl_close( $ch );

    if ( $result === "1" ) {
        $status=  '<p class="text-center" style="color:green">پرداخت شما با موفقیت انجام شد !</p></br><p class="text-center">مبلغ اهدایی:' . $value . '<p>تومان</p></p></br><p class="text-center">کد پیگیری تراکنش : ' . $_POST[ "transid" ] . '</p><hr><p class="text-center" style="color:purple">با آرزوی توفیق برای شما</p></br>
<p class="text-center" style="color:purple">امیدواریم مهر و محبت شما به فرزندان خانه آرمان مستدام باشد</p>';
        $start = get_post_meta($post->ID,'project_start',TRUE);
        $add=$start+$_POST['value'];
        update_post_meta($_POST['project_id'],'project_start',$add);

        $wpdb->update("wp_projects_donors" ,
            [
                'status' => 1,
                'trans_id' =>$_POST[ "transid" ],
                'date_created' =>date("Y-m-d h:i:sa"),
            ],
            ['id' =>$_REQUEST['entry']]
        );


    } else if ( $result === "0" ) {
        $status= '<p class="text-center" style="color:red">متاسفانه! پرداخت شما موفقیت آمیز نبود.</p></br><p class="text-center">کد پیگیری تراکنش : ' . $_POST[ "transid" ] . '</p><hr><p class="text-center" style="color:orange">درصورت کسر شدن موجودی از حسابتان ،‌مبلغ کسر شده طی ۱۵ دقیقه الی ۷۲ ساعت کاری آینده از سمت بانک برگشت داده میشود. </p>';
        $wpdb->update("wp_projects_donors" ,
            [
                'status' => 0,
                'trans_id' =>$_POST[ "transid" ],
                'date_created' =>date("Y-m-d h:i:sa"),
            ],
            ['id' =>$_REQUEST['entry']]
        );

    } else {
        $status=  '<p class="text-center" style="color:red"> خطا در پرداخت ' . $result. '</p>';
        $error=ppErr($result);
        $wpdb->update("wp_projects_donors" ,
            [
                'status' => -1,
                'trans_id' =>$_POST[ "transid" ],
                'date_created' =>date("Y-m-d h:i:sa"),
            ],
            ['id' =>$_REQUEST['entry']]
        );
    }



   $verify=true;

}

    function ppErr($res=''){
		switch($res)
		{
			case '-1' : $prompt="مبلغ نمیتواند خالی باشد."; break;
			case '-2' : $prompt="کد پین درگاه نمیتواند خالی باشد."; break;
			case '-3' : $prompt="callback نمیتواند خالی باشد."; break;
			case '-4' : $prompt="مبلغ را به صورت عددی وارد کنید."; break;
			case '-5' : $prompt="مبلغ باید بزرگتر از 100 تومان باشد."; break;
			case '-6' : $prompt="کد پین درگاه اشتباه است."; break;
			case '-7' : $prompt="آی پی درگاه اشتباه است."; break;
			case '-8' : $prompt="شماره تراکنش نمیتواند خالی باشد."; break;
			case '-9' : $prompt="تراکنش مورد نظر پیدا نشد."; break;
			case '-10': $prompt="کد پین درگاه با درگاه تراکنش مطابقت ندارد."; break;
			case '-11': $prompt="مبلغ وارد شده با مبلغ تراکنش برابری ندارد."; break;
			case '-12': $prompt="بانک وارد شده اشتباه میباشد."; break;
			case '-13': $prompt="درگاه غیر فعال است."; break;
			case '-14': $prompt="درگاه برروی سایت دیگری درحال استفاده است."; break;
			default : $prompt="خطای نامشخص!";
		}
		$err = "<meta charset=UTF-8>";
		$err .= "خطا ({$res}) : {$prompt}";
		return $err;
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
                                        <?php if($datediff>0): ?>
                                            <?php echo round($datediff / (60 * 60 * 24)) ." روز"; ?>
                                              <?php else: ?>
                                                <?php echo "تمام شد" ?>
                                            <?php endif; ?>
                                        <?php endif; ?> </span>
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
                    <?php echo $status; ?>
                    <p class="text-danger"><?php echo $error; ?></p>

                <?php } elseif($datediff>0 && $start<$target){ ?>

                    <div class="pay-form">
                        <form method="post" class="row g-3">
                            <input type="hidden" class="form-control" name="project_id" value="<?php the_ID(); ?>">
                            <input type="hidden" class="form-control" name="project_link" value="<?php the_permalink(); ?>">
                            <div class="col-12">
                                <label class="form-label">نام شما</label>
                                <input type="text" class="form-control" name="name"   required=""
                                       oninvalid="this.setCustomValidity('وارد کردن نام الزامی است')"
                                       oninput="setCustomValidity('')"/>

                            </div>
                            <div class="col-12">
                                <label  class="form-label">تلفن تماس</label>
                                <input type="text" class="form-control" name="phone"  required="" oninvalid="this.setCustomValidity('وارد کردن تلفن الزامی است')"  oninput="setCustomValidity('')">
                            </div>
                            <div class="col-12">
                                <label  class="form-label">مبلغ اهدایی به تومان </label>
                                <input type="text" class="form-control numericMask" placeholder="لطفا مبلغ را به تومان وارد کنید..." name="value" required="" oninvalid="this.setCustomValidity('وارد کردن مبلغ الزامی است')"  oninput="setCustomValidity('')">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-theme" name="pay"><i class="fal fa-heart"></i><span class="m-1">پرداخت آنلاین</span></button>
                            </div>
                        </form>
                            <p class="text-danger"><?php echo $error; ?></p>

                    </div>


                <?php }else{ ?>

                        <h3 class="text-warning text-center border border-warning p-5">با سپاس از همراهی شما<br>این پروژه پایان یافت</h3>

                 <?php }?>

            </section>





        </div>


    </div>
<?php endif; ?>


<?php get_footer(); ?>

