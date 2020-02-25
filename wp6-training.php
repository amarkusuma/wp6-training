<?php
/*
Plugin Name: Autocomplite
Description: Input Autocomplite with Ajax
Author: Ammar
*/

require_once('form-wp6-training.php');

add_action('wp_enqueue_scripts', 'my_enqueue');

function my_enqueue()
{
    $my_css_ver = date("ymd-Gis", filemtime(plugin_dir_path(__FILE__) . 'assets/jquery.css'));
    wp_register_style('my_css',    plugins_url('assets/jquery.css',    __FILE__), false,   $my_css_ver);
    wp_enqueue_style('my_css');
    wp_enqueue_script('ajax-script', plugins_url('/assets/autocomplite.js', __FILE__), array('jquery', 'jquery-ui-core', 'jquery-ui-autocomplete'));
    wp_localize_script('ajax-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_ajax_nopriv_myautocomplete', 'my_action');
add_action('wp_ajax_myautocomplete', 'my_action');

function my_action()
{
    global $wpdb;
    $search = $wpdb->esc_like($_REQUEST['data']);

    $loop = new WP_Query('s=' . $search);

    while ($loop->have_posts()) {
        $loop->the_post();
        $items[] = get_the_title();
    }
    wp_reset_query();
    echo json_encode($items);
    wp_die();
}
