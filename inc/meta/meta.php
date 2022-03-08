<?php

function projects_init($hook)
{

    wp_enqueue_style('my_meta_css', get_template_directory_uri() . '/inc/meta/meta.css');
    wp_enqueue_style('date_picker_css', get_template_directory_uri() . '/inc/meta/persianDatepicker-default.css');
    //wp_enqueue_script( 'jq-load', get_template_directory_uri() . '/inc/meta/jquery-3.3.1.js',array( 'jquery' ));
    wp_enqueue_script('date_picker_js', get_template_directory_uri() . '/inc/meta/persianDatepicker.min.js');
    wp_enqueue_script('my_meta_js', get_template_directory_uri() . '/inc/meta/meta.js', array( 'jquery' ), '1.0', true );
    if( 'edit.php' != $hook )
        return;
    wp_enqueue_script( 'jq-load', get_template_directory_uri() . '/inc/meta/jquery-3.3.1.js');
}
add_action('admin_enqueue_scripts','projects_init');



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
            <input type="number" name="p_start" value="<?php if(isset($start)) echo $start; ?>">
        </p>
        <label>مبلغ هدف پروژه</label>
        <p>
            <input type="number" name="p_target" value="<?php if(!empty($target)) echo $target; ?>">
        </p>
        <label>تاریخ پایان پروژه</label>
        <p>
            <input id="jdate"  type="text" name="p_remaining" value="<?php if(!empty($remaining)) echo $remaining; ?>">
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