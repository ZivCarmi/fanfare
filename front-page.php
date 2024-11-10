<?php if (!defined('ABSPATH')) exit;

get_header(null, ['snap' => true]);

$fields = [
    'entry_content' => get_field('entry_content'),
    'slider' => get_field('slider'),
];
$highlighted_words = $fields['entry_content']['highlighted_words'];
$main_text = $fields['entry_content']['main_text'];

if ($highlighted_words) {
	foreach ($highlighted_words as $key => $word) {
		$actual_word = $word['replacement_word'] ? $word['replacement_word'] : $word['matched_word'];
		$word_fields = [
			'id' => $key,
			'videos' => $word['videos'],
		];
		$json_data = htmlspecialchars(json_encode($word_fields), ENT_QUOTES, 'UTF-8');
		$highlighted_word_html = '<a href="javascript:void(0)"><span class="highlighted-word font-bold transition-colors duration-200 text-primary pointer-events-none lg:pointer-events-auto" data-videos="' . $json_data . '" data-group-id="' . $key . '">' . $actual_word . '</span></a>';

		// Replace the word in the entry text with the highlighted word
        $main_text = str_replace($word['matched_word'], $highlighted_word_html, $main_text);
	}
}
?>
<section class="home-hero container h-hero-screen flex flex-col items-center pb-12 relative lg:pb-16">
	<div class="text-container mt-20 relative lg:mt-auto">
		<div class="hoverable-content relative z-10 mx-auto text-28px font-semibold text-balance max-w-80 lg:max-w-[58rem] lg:text-[4.47rem] lg:text-center">
			<?= $main_text; ?>
		</div>
	</div>
	<a href="#projects" class="mt-auto">
		<?php get_template_part('template-parts/bumpy-pixelated-arrow', null, ['alt' => 'Slide down']); ?>
	</a>
</section>
<section class="h-dvh snap-start" id="projects">
	<div class="grid">
		<div class="swiper max-w-full max-h-dvh group">
			<div class="swiper-wrapper">
				<?php foreach($fields['slider'] as $slider) : ?>
					<div class="swiper-slide">
						<a class="project-link grid [&>*]:[grid-area:1/1/2/2]" href="<?= get_the_permalink($slider['project']); ?>">
							<video preload="metadata" data-lazy-load class="w-full h-dvh object-cover" width="<?= $slider['video']['width']; ?>" height="<?= $slider['video']['height']; ?>" playsinline muted>
								<source src="<?= $slider['video']['url']; ?>" >
								Your browser does not support HTML video.
							</video>
							<div class="self-end flex flex-col text-26px p-site-mobile duration-300 transition-opacity group-hover:lg:opacity-100 lg:opacity-0 lg:items-center lg:flex-row lg:gap-48 lg:p-site-desktop">
								<h2 class="font-bold"><?= get_the_title($slider['project']); ?></h2>
								<div><?= $slider['description']; ?></div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
			<button class="slide-to-next absolute z-10 top-1/2 right-site-mobile -translate-y-1/2 -rotate-90 opacity-0 duration-300 transition-opacity group-hover:opacity-100 lg:right-site-desktop">
				<?php get_template_part('template-parts/bumpy-pixelated-arrow', null, ['alt' => 'Slide next']); ?>
			</button>
			<div class="swiper-pagination flex !w-auto !top-site-mobile !bottom-auto !left-site-mobile lg:!top-auto lg:!left-auto lg:!right-site-desktop lg:!bottom-site-desktop lg:mb-1.5"></div>
		</div>
	</div>
</section>

<?php
get_footer(null, ['snap' => true]);