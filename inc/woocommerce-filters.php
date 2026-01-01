<?php if (!defined('ABSPATH')) exit;

// remove woocommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// remove tabs in single product 
add_filter( 'woocommerce_product_tabs', '__return_empty_array', 98 );
