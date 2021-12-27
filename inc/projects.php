<?php
include "meta/meta.php";

function register_projects_post_type() {

    $labels = array(
        'name'               => 'پروژه‌ها',
        'singular_name'      => 'پروژه',
        'add_new'            => 'پروژه جدید',
        'add_new_item'       => 'ایجاد پروژه جدید',
        'edit_item'          => 'ویرایش پروژه',
        'new_item'           => 'پروژه جدید',
        'all_items'          => 'همه پروژه‌ها',
        'view_item'          => 'نمایش پروژه',
        'search_items'       => 'جستجو در پروژه‌ها',
        'not_found'          =>  'پروژه پیدا نشد',
        'not_found_in_trash' => 'هیچی در زباله‌ها نیست',
        'parent_item_colon'  => '',
        'menu_name'          => 'پروژه‌ها'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'       => ['slug' => 'projects'],
    );

    register_post_type( 'projects', $args );

}
add_action( 'init', 'register_projects_post_type' );



add_action('admin_menu', 'add_tutorial_cpt_submenu_example');

//admin_menu callback function

function add_tutorial_cpt_submenu_example(){

    add_submenu_page(
        'edit.php?post_type=projects', //$parent_slug
        'لیست پرداخت‌ها',  //$page_title
        'پرداخت‌ها',        //$menu_title
        'manage_options',           //$capability
        'pay_projects_list',//$menu_slug
        'pay_projects_list_page'//$function
    );

}

//add_submenu_page callback function

function pay_projects_list_page() {

   include 'pay_list.php';
}

