<?php if (!defined('ABSPATH')) exit;

// Unused

$slider = get_field('slider');
?>

<section class="h-dvh" id="projects">
	<div class="grid">
		<div class="swiper max-w-full max-h-dvh group">
			<div class="swiper-wrapper">
				<?php foreach($slider as $slide) : ?>
					<div class="swiper-slide">
						<a class="project-link grid [&>*]:[grid-area:1/1/2/2]" href="<?= get_the_permalink($slide['project']); ?>">
							<video preload="metadata" data-lazy-load class="w-full h-dvh object-cover" width="<?= $slide['video']['width']; ?>" height="<?= $slide['video']['height']; ?>" playsinline muted>
								<source src="<?= $slide['video']['url']; ?>" >
								Your browser does not support HTML video.
							</video>
							<div class="self-end flex flex-col text-26px p-site-mobile duration-300 transition-opacity group-hover:lg:opacity-100 lg:opacity-0 lg:items-center lg:flex-row lg:gap-48 lg:p-site-desktop">
								<h2 class="font-bold"><?= get_the_title($slide['project']); ?></h2>
								<div><?= $slide['description']; ?></div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
			<button class="slide-to-next absolute z-10 top-1/2 right-site-mobile -translate-y-1/2 -rotate-90 opacity-0 duration-300 transition-opacity group-hover:opacity-100 lg:right-site-desktop">
				<?php get_template_part('template-parts/bumpy-pixelated-arrow', null, ['class' => 'w-12', 'alt' => 'Slide next']); ?>
			</button>
			<div class="swiper-pagination flex !w-auto !top-site-mobile !bottom-auto !left-site-mobile lg:!top-auto lg:!left-auto lg:!right-site-desktop lg:!bottom-site-desktop lg:mb-1.5"></div>
		</div>
	</div>
</section>