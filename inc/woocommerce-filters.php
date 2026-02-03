<?php if (!defined('ABSPATH')) exit;

add_filter('wp_img_tag_add_auto_sizes', '__return_false');

// remove woocommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// remove tabs in single product 
add_filter( 'woocommerce_product_tabs', '__return_empty_array', 98 );

add_filter('body_class', 'woo_all_pages_body_class');
function woo_all_pages_body_class ($classes) {
    if (is_woocommerce_page()) {
        $classes[] = 'light';
    }
    return $classes;
}

// add boxed-button class to add to cart button
add_filter('woocommerce_loop_add_to_cart_link', function ($html) {
    return str_replace(
        'class="',
        'class="boxed-button ',
        $html
    );
});

// display single product thumbnails in full size
add_filter('woocommerce_gallery_thumbnail_size', function($size) {
    return 'full';
});

// remove trailing zeros from product price
add_filter('woocommerce_price_trim_zeros', '__return_true');

// disable related products header
add_filter( 'woocommerce_product_related_products_heading', '__return_false' );

// display the lowest variation price in single product page
add_filter('woocommerce_variable_price_html', function ($price, $product) {
    $min_price = wc_price($product->get_variation_price('min', true));
    return 'FROM ' . $min_price;
}, 10, 2);

// remove reset variation link
add_filter('woocommerce_reset_variations_link', '__return_empty_string');

// change default text for variation select
add_filter('woocommerce_dropdown_variation_attribute_options_args', 'custom_variation_select_text', 10, 1);
function custom_variation_select_text($args) {
    $args['show_option_none'] = 'Select';
    return $args;
}

// add plus and minus buttons to control quantity for mini cart items
add_filter('woocommerce_widget_cart_item_quantity', 'custom_mini_cart_quantity', 10, 3);
function custom_mini_cart_quantity($html, $cart_item, $cart_item_key) {
    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
    $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
    $product_max_qty = $_product->get_max_purchase_quantity();

    if ($_product && $_product->exists() && $cart_item['quantity'] > 0) {
        return sprintf(
            '<div class="mini-cart-item-details">
                <div class="quantity mini-cart-qty" data-cart-item-key="%s">
                    <button type="button" class="minus">−</button>
                    <input type="number" class="qty" value="%s" min="1" max="%s" step="1" readonly />
                    <button type="button" class="plus">+</button>
                </div>
                <span class="amount">%s</span>
            </div>',
            esc_attr($cart_item_key),
            esc_attr($cart_item['quantity']),
            esc_attr($product_max_qty === -1 ? '' : $product_max_qty),
            $product_price
        );
    }
    
    return $html;
}

add_filter('woocommerce_show_page_title', 'remove_title_from_product_archive');
function remove_title_from_product_archive($title) {
    return false;
}

// Change "Free shipping" label to "Free"
add_filter('woocommerce_cart_shipping_method_full_label', function ($label, $method) {
    if ($method->method_id === 'free_shipping') {
        return __('Free', 'woocommerce');
    }
    return $label;
}, 10, 2);

// Remove "Shipping options will be updated during checkout" notice
add_filter('woocommerce_shipping_may_be_available_html', '__return_empty_string');

// Move WooCommerce checkout field errors under each input
add_filter('woocommerce_checkout_fields', function ($fields) {
    foreach ($fields as &$group) {
        foreach ($group as &$field) {
            $field['class'][] = 'wc-inline-error';
        }
    }
    return $fields;
});

add_filter('woocommerce_form_field', function ($field_html, $key, $args, $value) {
    if (!empty($args['errors'])) {
        $field_html .= '<div class="field-error">' . esc_html($args['errors'][0]) . '</div>';
    }
    return $field_html;
}, 10, 4);

// Remove "Billing"/"Shipping" prefix from checkout error messages (keep original text)
add_filter('woocommerce_checkout_required_field_notice', function ($message, $field_label) {
    return str_replace(
        [$field_label . ' ', 'Billing ', 'Shipping '],
        '',
        $message
    );
}, 10, 2);

// Change thankyou order recieved text
add_filter('woocommerce_thankyou_order_received_text', 'custom_order_received_text', 10, 2);
function custom_order_received_text($text, $order) {
    return esc_html(__('Your order has been received.',));
}

add_filter('woocommerce_order_get_formatted_billing_address', function ($address, $raw_address, $order) {
    if (!$raw_address || !is_array($raw_address)) return $address;

    $lines = [];

    foreach ($raw_address as $key => $value) {
        if (!empty($value)) {
            // מאחדים first_name + last_name
            if ($key === 'first_name' && !empty($raw_address['last_name'])) {
                $value = trim($raw_address['first_name'] . ' ' . $raw_address['last_name']);
                $label = 'Name';
            }
            // לדלג על last_name כי כבר מאוחד
            elseif ($key === 'last_name') {
                continue;
            }
            else {
                // יצירת label אוטומטי מה־key
                $label = ucwords(str_replace('_', ' ', $key));
            }

            $lines[] = '<div class="order-address-line"><strong>' . esc_html($label) . ':</strong> ' . esc_html($value) . '</div>';
        }
    }

    return implode('', $lines);
}, 10, 3);