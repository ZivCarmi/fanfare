<?php if (!defined('ABSPATH')) exit;

add_action('init', function() {
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
    remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

	$wstyles = ['wc-blocks-style', 'wc-blocks-style-active-filters', 'wc-blocks-style-checkout', 'wc-blocks-style-cart'];
    foreach ($wstyles as $wstyle) {
        wp_deregister_style($wstyle);
    }
});

// remove dns prefetch
add_filter('emoji_svg_url', '__return_false');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Remove Gutenberg Block Library CSS from loading on the frontend
add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 999);
function remove_wp_block_library_css(){
	wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
}