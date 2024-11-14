<?php if (!defined('ABSPATH')) exit;

// Add custom meta box to the video attachment edit screen
function add_video_meta_box() {
    add_meta_box(
        'video_custom_meta',
        'Video Meta Information',
        'display_video_meta_box',
        'attachment',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_video_meta_box');

// Display the meta box content
function display_video_meta_box($post) {
    // Retrieve existing meta value (1 if checked, 0 if not)
    $manualplay = get_post_meta($post->ID, '_video_manualplay', true);
    ?>
    <label for="video_manualplay">Manual play:</label>
    <input type="checkbox" name="video_manualplay" id="video_manualplay" value="1" <?php checked($manualplay, '1'); ?> />
    <?php
}

// Save the meta field value
function save_video_meta($post_id) {
    // Save the manualplay checkbox value
    $manualplay = isset($_POST['video_manualplay']) ? '1' : '0';
    update_post_meta($post_id, '_video_manualplay', $manualplay);
}
add_action('edit_attachment', 'save_video_meta');