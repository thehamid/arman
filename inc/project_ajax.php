<?php
global $wpdb;
global $verify;
global $post;
global $status;
global $pay_id;
global $error;
global $table;
global $donors_count;

add_action( 'wp_ajax_nopriv_project_pay', 'do_project_pay' );
add_action( 'wp_ajax_project_pay', 'do_project_pay' );
function do_project_pay()
{
//    date_default_timezone_set("Asia/Tehran");
//    global $wpdb;
//    $table=$wpdb->prefix . 'projects_donors';
//    $insert_row =$wpdb->insert($table ,
//        [
//            'project_id' => sanitize_text_field($_POST['project_id']),
//            'name' => sanitize_text_field($_POST['name']),
//            'phone' => sanitize_text_field($_POST['phone']),
//            'value' => toEnNumber($_POST['value']),
//            'status' => sanitize_text_field($_POST['status']),
//            'trans_id' => sanitize_text_field($_POST['trans_id']),
//            'date_created' =>date("Y-m-d h:i:sa")
//        ] );
//    $pay_id=$wpdb->insert_id;
    //    if(is_wp_error($insert_row)){
//       wp_send_json(
//           [
//               'success'=>false,
//               'message'=> 'خطایی رخ داده است'
//
//           ],500
//       );
//    }
//    wp_send_json(
//        [
//            'success'=>true,
//            'message'=> 'با موفقیت ثبت شد'
//
//        ],200
//    );
  //  wp_die();

    // Send Parameter

    $url = $_SERVER[ 'REQUEST_URI' ]; // آدرس سایت شما را برمی گرداند
    $parts = explode( '/', $url );
    $callback = $_SERVER[ 'SERVER_NAME' ];
    for ( $i = 0; $i < count( $parts ) - 1; $i++ ) {
        $callback .= $parts[ $i ] . "/";
    }
    $callback .= "verify.php";



    $data = [
        'pin'    => 'sandbox',
        'amount'    => 20000,
        'callback' => $callback,
        'card_number' => '1111222233334444',
        'mobile' => '09123456789',
        'email' => 'test@test.com',
        'invoice_id' => '123456',
        'description' => 'Description'
    ];

    $data = json_encode($data);
    $ch = curl_init('https://panel.aqayepardakht.ir/api/v2/create');
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
    curl_close($ch);
    $result = json_decode($result);
    if ($result->status == "success") {
        header('Location: https://panel.aqayepardakht.ir/startpay/' . $result->transid);
    } else {
        echo "خطا";
    }

// verify Transaction

    $data = [
        'pin'    => 'sandbox',
        'amount'    => 20000,
        'transid' => $_POST['transid']
    ];

    $data = json_encode($data);
    $ch = curl_init('https://panel.aqayepardakht.ir/api/v2/verify');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result);
    if ($result->code == "1") {
// تراکنش موفق
    } else {
// تراکنش ناموفق
    }


}


function toEnNumber($input) {
    $replace_pairs = array(
        '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
        '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'
    );

    return strtr( $input, $replace_pairs );
}


function gateWay(){
   // $order_id = $_POST['project_id'];
    $price =10000;
    //$callback_url =add_query_arg(array('entry' => $pay_id),  $_POST['project_link']);

    $data = [
        // 'pin' => 'AD43F9951C17C475428B',
        'pin' => 'sandbox',
        'amount' => $price,
        'callback' => 111,
        'invoice_id' => 111,
        'description' => 'پروژه حمایتی'
    ];

    $data = json_encode($data);
    $ch = curl_init('https://panel.aqayepardakht.ir/api/v2/create');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result);
    if ($result->status == "success") {
        header('Location: https://panel.aqayepardakht.ir/startpay/' . $result->transid);
    } else {
        echo "خطا";
    }
}
