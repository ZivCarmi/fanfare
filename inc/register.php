<?php if (!defined('ABSPATH')) exit;

// register theme menus
add_action('init', 'register_theme_menus');
function register_theme_menus () {
	$args = [
		'left_menu' => __('Left Menu', 'fanfare'),
		'right_menu' => __('Right Menu', 'fanfare'),
	];

	register_nav_menus($args);
}