<?php if (!defined('ABSPATH')) exit;

if (!function_exists('dd')) {
	function dd ($value) {
		echo '<div dir="ltr"><pre>';
		print_r($value);
		echo '</pre></div>';
	}
}

if (!function_exists('get_looping_adjacent_post')) {
	function get_looping_adjacent_post($previous = true) {
		$post = get_adjacent_post(false, '', $previous);
		$posts = get_posts([
			'post_type' => get_post_type(),
			'orderby'   => 'menu_order',
		]);

		// If no previous post, get the last post (for looping effect)
		if (!$post && $previous) {
			$post = !empty($posts) ? $posts[0] : null;
		}
		
		// If no next post, get the first post (for looping effect)
		if (!$post && !$previous) {
			$post = !empty($posts) ? $posts[array_key_last($posts)] : null;
		}
		
		return $post;
	}
}