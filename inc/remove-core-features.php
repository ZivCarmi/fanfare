<?php if (!defined('ABSPATH')) exit;

// remove dns prefetch
add_filter('emoji_svg_url', '__return_false');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Remove Gutenberg Block Library CSS from loading on the frontend
add_action('wp_enqueue_scripts', 'remove_wp_block_library_css');
function remove_wp_block_library_css(){
	wp_dequeue_style('global-styles');
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
}

// Remove add new content link from top toolbar
add_action('admin_bar_menu', 'remove_wp_nodes', 999);
function remove_wp_nodes () {
	global $wp_admin_bar;
	
	$wp_admin_bar->remove_node('new-content');
}