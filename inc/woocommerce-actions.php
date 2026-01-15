<?php if (!defined('ABSPATH')) exit;

// remove breadcrumbs
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// remove 'showing all x products'
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// remove 'showing all x products'
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// remove woocommerce's default wrapper
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// remove shop sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// remove add to cart for product loop
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// add custom wrapper to the listing pages
add_action('woocommerce_before_main_content', function () {
    $is_listing_page = is_shop() || is_product_category() || is_product_tag();
    
    echo '<section class="container' . ($is_listing_page ? ' listing-container' : '' ) . '">';
}, 5);
add_action('woocommerce_after_main_content', function () {
    echo '</section>';
}, 10);

// remove archive headers
remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);

// add hero to listing pages
add_action('woocommerce_before_main_content', function () {
    $hero_field = null;

    if (is_shop()) {
        $shop_page_id = wc_get_page_id('shop');
        $hero_field = get_field('hero_image_or_video', $shop_page_id);
    } elseif (is_product_category() || is_product_tag()) {
        $term = get_queried_object();
        $hero_field = get_field('hero_image_or_video', $term);
    }

    if (!empty($hero_field[0])) {
        get_template_part('template-parts/hero-image-or-video', null, ['content' => $hero_field[0]]);
    }
}, 0);

// add wrapper for image and sale flash in product loop
add_action('woocommerce_before_shop_loop_item_title', function () {
    echo '<div class="featured-image">';
}, 5);
add_action('woocommerce_before_shop_loop_item_title', function () {
    echo '</div>';
}, 10);

// add wrapper for product name in product loop
add_action('woocommerce_before_shop_loop_item_title', function () {
    echo '<div class="heading">';
}, 15);
add_action('woocommerce_after_shop_loop_item_title', function () {
    echo '</div>';
}, 11);

// add wrapper for product thumbnails in single product page
add_action('woocommerce_before_single_product_summary', function () {
    echo '<div class="product-thumbnails-wrapper">';
}, 15);
add_action('woocommerce_before_single_product_summary', function () {
    echo '</div>';
}, 40);

// repositioned sale flash in single product page
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 15);

// remove single product excerpt
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

// add single product description instead of excerpt
add_action('woocommerce_single_product_summary', function () {
    global $product;

    echo '<p class="description">';
    echo apply_filters('get_the_content', $product->get_description());
    echo '</p>';
}, 10);

// add plus and minus buttons for quantity
add_action('woocommerce_before_quantity_input_field', function () {
    if (is_product()) {
        echo '<p class="label">Quantity</p>';
    }

    echo '<div class="quantity-wrapper"><button type="button" class="qty-minus">−</button>';
});
add_action('woocommerce_after_quantity_input_field', function () {
    echo '<button type="button" class="qty-plus">+</button></div>';
});

// remove default related products
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// add related products in single product page
add_action('woocommerce_after_single_product', function () {
    woocommerce_output_related_products();
}, 5);

// remove single product meta
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// mini cart shipping line
add_action('woocommerce_widget_shopping_cart_before_buttons', 'add_shipping_info_to_mini_cart');
function add_shipping_info_to_mini_cart() {
    echo '<div class="mini-cart-shipping"><span>SHIPPING</span><span>Free</span></div>';
}

// update mini cart after quantity change
add_action('wp_ajax_update_mini_cart_quantity', 'update_mini_cart_quantity');
add_action('wp_ajax_nopriv_update_mini_cart_quantity', 'update_mini_cart_quantity');
function update_mini_cart_quantity() {
    check_ajax_referer('mini-cart-nonce', 'security');
    
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);
    
    if ($quantity > 0) {
        WC()->cart->set_quantity($cart_item_key, $quantity, true);
    } else {
        WC()->cart->remove_cart_item($cart_item_key);
    }
    
    WC()->cart->calculate_totals();
    
    wp_send_json_success(array(
        'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array()),
    ));
}

// mini cart ajax nonce
add_action('wp_footer', 'add_mini_cart_nonce');
function add_mini_cart_nonce() {
    echo '<script>document.body.setAttribute("data-mini-cart-nonce", "' . wp_create_nonce('mini-cart-nonce') . '");</script>';
}

// -----------------------------------------
// Cart Page
// -----------------------------------------
// add wrapper for cart content
add_action('woocommerce_before_cart', function () {
    echo '<div class="container">';
}, 5);
add_action('woocommerce_after_cart', function () {
    echo '</div>';
}, 10);

// -----------------------------------------
// Checkout Page
// -----------------------------------------
// Wrap checkout content with .container (inside .woocommerce)
add_action('woocommerce_before_checkout_form', function () {
    echo '<div class="container">';
}, 5);

add_action('woocommerce_after_checkout_form', function () {
    echo '</div>';
}, 50);

// add wrapper for order review
add_action('woocommerce_checkout_before_order_review_heading', function () {
    echo '<div class="order-review"><div class="order-review-wrapper">';
}, 10);
add_action('woocommerce_checkout_after_order_review', function () {
    echo '</div></div>';
}, 10);

// Add coupon to subtotal
add_action( 'woocommerce_review_order_after_cart_contents', 'woocommerce_checkout_coupon_form_custom' );
function woocommerce_checkout_coupon_form_custom() {
    echo '<tr class="coupon-row"><td class="coupon-form" colspan="2">
        <p class="form-row input-wrapper woocommerce-validated">
            <input type="text" name="coupon_code" class="input-text" placeholder="' . __("Coupon code") . '" id="coupon_code" value="">
            <button type="button" class="button" name="apply_coupon" value="' . __("Apply coupon") . '">' . __("Apply") . '</button>
        </p>
    </tr></td>';
}

