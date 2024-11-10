<?php if (!defined('ABSPATH')) exit;

// Template Name: Lets Fanfare

if (!current_user_can('administrator')) {
    if (!wp_is_mobile()) {
        // If not using mobile
        wp_redirect('/');
        exit;
    }
}

get_header(null, ['custom_bg' => 'bg-primary']);
?>
<section class="container pt-10 pb-12">
    <?php get_template_part('/template-parts/fanfare-form'); ?>
</section>
<?php
get_footer();