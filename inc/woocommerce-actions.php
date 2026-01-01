<?php if (!defined('ABSPATH')) exit;

// disable shop sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );