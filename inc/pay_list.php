<?php

global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}doners_projects");

?>

    <div class="wrap">
        <h2> لیست پرداخت‌ها </h2>

        <table class="widefat" >
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th>تلفن</th>
                <th>مبلغ</th>
                <th>پروژه</th>
                <th>وضعیت</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $result): ?>
                <tr>
                    <th><?php echo $result->id?></th>
                    <th><?php echo $result->name?></th>
                    <th><?php echo $result->phone?></th>
                    <th><?php echo $result->value?></th>
                    <th><?php echo get_the_title($result->project_id); ?></th>
                    <th><?php echo $result->status?></th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>


    </div>
