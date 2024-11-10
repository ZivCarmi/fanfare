<?php if (!defined('ABSPATH')) exit;

// Remove p tags in contact form
add_filter('wpcf7_autop_or_not', '__return_false');