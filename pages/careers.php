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
    <video width="40" playsinline autoplay muted loop>
        <source src="<?= wp_get_attachment_url(57); ?>" type="video/mp4">
        Your browser does not support HTML video.
    </video>
    <h1 class="text-4xl font-bold my-3 lg:text-80px lg:mt-4 lg:mb-6"><?= $fields['entry']['title']; ?></h1>
    <h3 class="lg:text-22px"><?= $fields['entry']['subtitle']; ?></h3>
</section>
<section class="container bg-primary pt-24 pb-36 text-background">
    <div class="text-center font-bold text-[2.5rem] leading-[2.75rem] text-balance lg:text-6xl"><?= $fields['main']['running_text']; ?></div>
    <div class="text-center mt-8 lg:mt-10">
        <?php if ($fields['main']['contact']['mini_title']) : ?>
            <div class="lg:text-22px"><?= $fields['main']['contact']['mini_title']; ?></div>
        <?php endif; ?>
        <a class="boxed-button" href="mailto:<?= $fields['fanfare_email']; ?>?subject=Freelance Position">
            <svg width="36" height="23" viewBox="0 0 36 23" fill="white" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_2366_1154)">
                    <path d="M4.06216 5.43457H0.046875V9.35752H4.06216V5.43457Z" />
                    <path d="M4.70083 8.50391H0.685547V12.4269H4.70083V8.50391Z" />
                    <path d="M5.33755 11.5723H1.32227V15.4952H5.33755V11.5723Z" />
                    <path d="M5.97818 14.6416H1.96289V18.5645H5.97818V14.6416Z" />
                    <path d="M6.61685 17.71H2.60156V21.6329H6.61685V17.71Z" />
                    <path d="M33.0036 3.81738H28.9883V7.74033H33.0036V3.81738Z" />
                    <path d="M33.7536 6.65625H29.7383V10.5792H33.7536V6.65625Z" />
                    <path d="M34.5016 9.49609H30.4863V13.419H34.5016V9.49609Z" />
                    <path d="M35.2516 12.3379H31.2363V16.2608H35.2516V12.3379Z" />
                    <path d="M36.0016 15.1768H31.9863V19.0997H36.0016V15.1768Z" />
                    <path d="M18.1379 0H0.046875V3.9002H18.1379V0Z" />
                    <path d="M33.0004 0.951172H14.2871V4.85137H33.0004V0.951172Z" />
                    <path d="M36.0007 19.0996H6.61523V22.9998H36.0007V19.0996Z" />
                    <path d="M4.01529 1.87598H0V5.79892H4.01529V1.87598Z" />
                    <path d="M7.24185 3.81543H3.22656V7.73837H7.24185V3.81543Z" />
                    <path d="M10.4665 5.75586H6.45117V9.6788H10.4665V5.75586Z" />
                    <path d="M13.695 7.69531H9.67969V11.6183H13.695V7.69531Z" />
                    <path d="M16.9196 9.63477H12.9043V13.5577H16.9196V9.63477Z" />
                    <path d="M20.1461 11.5723H16.1309V15.4952H20.1461V11.5723Z" />
                    <path d="M33.0036 3.81738H28.9883V7.74033H33.0036V3.81738Z" />
                    <path d="M30.4313 5.36816H26.416V9.29111H30.4313V5.36816Z" />
                    <path d="M27.859 6.91895H23.8438V10.8419H27.859V6.91895Z" />
                    <path d="M25.2887 8.4707H21.2734V12.3936H25.2887V8.4707Z" />
                    <path d="M22.7184 10.0215H18.7031V13.9444H22.7184V10.0215Z" />
                    <path d="M20.1461 11.5723H16.1309V15.4952H20.1461V11.5723Z" />
                </g>
                <defs>
                    <clipPath id="clip0_2366_1154">
                        <rect width="36" height="23" />
                    </clipPath>
                </defs>
            </svg>
            Mail Us
        </a>
    </div>
</section>

<?php
get_footer();