<?php if (!defined('ABSPATH')) exit;

define('TEMPLATE_DIRECTORY_URI', get_template_directory_uri() . '/assets');

// file versions, helps with cache busting when developing and in production
if (current_user_can('editor') || current_user_can('administrator')) {
	define('FILES_VERSION', '?v=' . time());
} else {
	define('FILES_VERSION', '?v=000002');
}

// loading all js+css files
add_action('wp_enqueue_scripts', 'fanfare_styles');
function fanfare_styles() {
	wp_enqueue_style('tw-style', TEMPLATE_DIRECTORY_URI . '/css/output.css' . FILES_VERSION);
	wp_enqueue_style('mini-cart-style', TEMPLATE_DIRECTORY_URI . '/css/mini-cart.css' . FILES_VERSION, []);
	wp_enqueue_script('mini-cart-script', TEMPLATE_DIRECTORY_URI . '/js/mini-cart.js' . FILES_VERSION, ['jquery'], null, true);
	wp_enqueue_script('wc-cart-fragments');

    if (is_front_page()) {
		wp_enqueue_script('front-page-script', TEMPLATE_DIRECTORY_URI . '/js/front-page.js' . FILES_VERSION, ['jquery'], null, true);
	} else if (is_post_type_archive('work')) {
		wp_enqueue_script('work-script', TEMPLATE_DIRECTORY_URI . '/js/work.js' . FILES_VERSION, ['jquery'], null, true);
	} else if (is_singular('work')) {
		wp_enqueue_style('swiperjs-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
		wp_enqueue_script('swiperjs-script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);
		wp_enqueue_script('single-work-script', TEMPLATE_DIRECTORY_URI . '/js/single-work.js' . FILES_VERSION, ['jquery'], null, true);
	} else if (is_shop() || (is_archive() && is_woocommerce())) {
		wp_enqueue_style('shop-style', TEMPLATE_DIRECTORY_URI . '/css/shop.css' . FILES_VERSION, []);
	} else if (is_product()) {
		wp_enqueue_style('product-style', TEMPLATE_DIRECTORY_URI . '/css/product.css' . FILES_VERSION, []);
		wp_enqueue_script('product-script', TEMPLATE_DIRECTORY_URI . '/js/product.js' . FILES_VERSION, ['jquery'], null, true);
	} else if (is_cart()) {
		wp_enqueue_style('cart-style', TEMPLATE_DIRECTORY_URI . '/css/cart.css' . FILES_VERSION, []);
		wp_enqueue_script('cart-script', TEMPLATE_DIRECTORY_URI . '/js/cart.js' . FILES_VERSION, ['jquery'], null, true);
	}

    wp_enqueue_script('fanfare-script', TEMPLATE_DIRECTORY_URI . '/js/main.js' . FILES_VERSION, ['jquery'], null, true);
}