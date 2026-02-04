<?php if (!defined('ABSPATH')) exit; ?>

<div class="slider-gallery lightbox-modal">
    <div class="lightbox-overlay"></div>
    <div class="lightbox-container">
        <button class="close-btn lightbox-close">&times;</button>
        <div class="swiper lightbox-swiper">
            <div class="swiper-wrapper"></div>
            <button class="slide-to-next mix-blend-difference absolute z-10 top-1/2 right-site-mobile -translate-y-1/2 -rotate-90 duration-300 transition-opacity lg:right-site-desktop">
                <?php get_template_part('template-parts/bumpy-pixelated-arrow', null, ['class' => 'w-4 lg:w-12', 'alt' => 'Slide next']); ?>
            </button>
            <button class="slide-to-prev mix-blend-difference absolute z-10 top-1/2 left-site-mobile -translate-y-1/2 rotate-90 duration-300 transition-opacity lg:left-site-desktop">
                <?php get_template_part('template-parts/bumpy-pixelated-arrow', null, ['class' => 'w-4 lg:w-12', 'alt' => 'Slide next']); ?>
            </button>
        </div>
    </div>
</div>