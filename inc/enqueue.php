<?php if (!defined('ABSPATH')) exit;

define('TEMPLATE_DIRECTORY_URI', get_template_directory_uri());

// file versions, helps with cache busting when developing and in production
// if (current_user_can('editor') || current_user_can('administrator')) {
	define('FILES_VERSION', '?v=' . time());
// } else {
// 	define('FILES_VERSION', '?v=000000');
// }

// loading all css files
add_action('wp_enqueue_scripts', 'fanfare_styles');
function fanfare_styles() {
	wp_enqueue_style('fanfare-style', TEMPLATE_DIRECTORY_URI . '/assets/css/style.css' . FILES_VERSION);

    if (is_front_page()) {
		wp_enqueue_script('front-page-script', TEMPLATE_DIRECTORY_URI . '/assets/js/front-page.js' . FILES_VERSION, ['jquery'], null, true);
	} else if (is_post_type_archive('work')) {
		wp_enqueue_script('work-script', TEMPLATE_DIRECTORY_URI . '/assets/js/work.js' . FILES_VERSION, ['jquery'], null, true);
	}

    wp_enqueue_script('fanfare-script', TEMPLATE_DIRECTORY_URI . '/assets/js/main.js' . FILES_VERSION, ['jquery'], null, true);
}