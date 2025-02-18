<?php if (!defined('ABSPATH')) exit; 

$fields = [
    'half_sunrise' => get_field('half_sunrise', 'option'),
];
?>

<?php if ($fields['half_sunrise']) : ?>
    <div class="w-full flex justify-between">
        <img class="w-5 h-5 -scale-x-100 rotate-180" src="<?= $fields['half_sunrise']['url']; ?>" alt="Sunrise">
        <img class="w-5 h-5 rotate-180" src="<?= $fields['half_sunrise']['url']; ?>" alt="Sunrise">
    </div>
<?php endif; ?>
<div class="mt-4 mb-9 lg:mb-14 text-center">
    <h3 class="text-[13vw]/[13vw] font-bold tracking-tighter 1.5xl:text-[10rem]/[1]">New Buddies?</h3>
</div>
<?= do_shortcode('[contact-form-7 id="8d73650" title="Contact Form"]'); ?>