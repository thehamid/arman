<?php

add_action( 'wp_ajax_nopriv_project_pay', 'do_project_pay' );
add_action( 'wp_ajax_project_pay', 'do_project_pay' );
function do_project_pay()
{
    global $wpdb;
    $table=$wpdb->prefix . 'projects_donors';
    $insert_row =$wpdb->insert($table ,
        [
            'project_id' => sanitize_text_field($_POST['project_id']),
            'name' => sanitize_text_field($_POST['name']),
            'phone' => sanitize_text_field($_POST['phone']),
            'value' => sanitize_text_field($_POST['value']),
            'status' => sanitize_text_field($_POST['status']),
            'trans_id' => sanitize_text_field($_POST['trans_id']),
            'date_created' =>date("Y-m-d h:i:sa")
        ] );

    if($insert_row){
        echo json_encode(array('res'=>true, 'message'=>__('New row has been inserted.')));
    }else{
        echo json_encode(array('res'=>false, 'message'=>__('Something went wrong. Please try again later.')));
    }
    wp_die();
}
