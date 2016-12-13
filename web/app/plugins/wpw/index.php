<?php
/*
Plugin Name: WP Wedding
Plugin URI: https://rafagnin.com
Version: 0.0.1
Author: Lucas Rafagnin
Author uri: https://rafagnin.com
Description: Adds custom capability to WordPress
Text Domain: wpw
Domain Path: /wpw
*/

remove_action('admin_init', '_maybe_update_core');
remove_action('admin_init', '_maybe_update_plugins');
remove_action('admin_init', '_maybe_update_themes');

add_action('admin_init', 'wpw_posts_order');
function wpw_posts_order()
{
	add_post_type_support('post', 'page-attributes');
}

add_filter('automatic_updater_disabled', '__return_true');
add_filter('auto_update_core', '__return_false');
add_filter('allow_dev_auto_core_updates', '__return_false');
add_filter('allow_minor_auto_core_updates', '__return_false');
add_filter('allow_major_auto_core_updates', '__return_false');
add_filter('auto_update_plugin', '__return_false');
add_filter('auto_update_theme', '__return_false');
//add_filter('auto_update_translation', '__return_false');
add_filter('auto_core_update_send_email', '__return_false');
