<?php if (!defined('ABSPATH')) exit; ?>

<div class="slider-gallery fixed inset-0 bg-black z-50">
    <div class="flex h-full items-center">
        <button class="close-btn absolute z-10 top-4 right-4 p-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="hoverable" width="24" height="24" viewBox="0 0 24 24"><path class="fill-white" d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg>
        </button>
        <div class="swiper max-w-full max-h-dvh">
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