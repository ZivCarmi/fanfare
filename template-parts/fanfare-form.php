<?php if (!defined('ABSPATH')) exit; ?>

<div class="w-full flex justify-between">
    <img class="w-5 h-5 -scale-x-100 rotate-180" src="<?= wp_get_attachment_url(221); ?>" alt="Sunrise">
    <img class="w-5 h-5 rotate-180" src="<?= wp_get_attachment_url(221); ?>" alt="Sunrise">
</div>
<div class="mt-4 mb-9 lg:mb-14 text-center">
    <h3 class="text-36px font-bold lg:text-200px">Lets Fanfare</h3>
    <!-- <span class="lg:text-22px">And bring you to the next</span> -->
</div>
<?= do_shortcode('[contact-form-7 id="8d73650" title="Let\'s Fanfare Form"]'); ?>