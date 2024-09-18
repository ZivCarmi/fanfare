<?php if (!defined('ABSPATH')) exit;

if (!function_exists('dd')) {
	function dd ($value) {
		echo '<div dir="ltr"><pre>';
		print_r($value);
		echo '</pre></div>';
	}
}