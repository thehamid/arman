<?php
/**
 * Register meta box for projects post type.
 */
function projects_meta_box()
{
    add_meta_box(
        'project-meta-box',
        'اطلاعات پروژه',
        'project_meta_box_handler',
        'projects',
        'normal',
        'high'
    );
}

add_action('add_meta_boxes', 'projects_meta_box', 10, 2);


function project_meta_box_handler($post)
{
    $start = get_post_meta($post->ID,'project_start',TRUE);
    $target = get_post_meta($post->ID,'project_target',TRUE);
    $remaining = get_post_meta($post->ID,'project_remaining',TRUE);
    $done = get_post_meta($post->ID,'project_done',TRUE);

    ?>
    <div class="my_meta_control">

        <label>مبلغ شروع پروژه</label>
        <p>
            <input type="text" name="p_start" value="<?php if(!empty($start)) echo $start; ?>">
        </p>
        <label>مبلغ هدف پروژه</label>
        <p>
            <input type="number" name="p_target" value="<?php if(!empty($target)) echo $target; ?>">
        </p>
        <label>زمان باقیمانده (روز)</label>
        <p>
            <input type="number" name="p_remaining" value="<?php if(!empty($remaining)) echo $remaining; ?>">
        </p>
        <label>تکمیل شده
            <input name="p_done" type="checkbox" value="تکمیل شده" <?php if(!empty($done)) echo 'checked="checked"'; ?>"></label>

    </div>


    <?php

}


/**
 * Save meta box content.
 */
function projects_save_meta_box( $post_id ) {

    if (isset($_POST['p_start']))
    {
        update_post_meta($post_id,'project_start',$_POST['p_start']);
    }
    if (isset($_POST['p_target']))
    {
        update_post_meta($post_id,'project_target',$_POST['p_target']);
    }
    if (isset($_POST['p_remaining']))
    {
        update_post_meta($post_id,'project_remaining',$_POST['p_remaining']);
    }
    if (isset($_POST['p_done']))
    {
        update_post_meta($post_id,'project_done',$_POST['p_done']);
    }


}
add_action( 'save_post', 'projects_save_meta_box' );