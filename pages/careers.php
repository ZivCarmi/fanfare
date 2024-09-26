<?php if (!defined('ABSPATH')) exit;

// Template Name: Careers

get_header();

$fields = [
    'entry' => get_field('entry_content'),
    'main' => get_field('main_content'),
    'fanfare_email' => get_field('footer_email', 'option'),
];
?>

<section class="container text-center pb-24 flex flex-col items-center pt-24">
    <video width="40" autoplay muted loop>
        <source src="https://fanfare.local/wp-content/uploads/2024/09/Sunrise-1.mp4" type="video/mp4">
        Your browser does not support HTML video.
    </video>
    <h1 class="text-4xl font-bold my-3 lg:text-80px lg:mt-4 lg:mb-6"><?= $fields['entry']['title']; ?></h1>
    <h3 class="lg:text-22px"><?= $fields['entry']['subtitle']; ?></h3>
</section>
<section class="container bg-primary pt-24 pb-36 text-background">
    <div class="text-center font-bold text-[2.5rem] leading-[2.75rem] text-balance lg:text-6xl"><?= $fields['main']['running_text']; ?></div>
    <div class="text-center mt-8 lg:mt-10 lg:text-22px">
        <div><?= $fields['main']['contact']['mini_title']; ?></div>
        <a class="text-secondary" href="mailto:<?= $fields['fanfare_email']; ?>"><?= $fields['fanfare_email']; ?></a>
    </div>
</section>

<?php
get_footer();