<?php if (!defined('ABSPATH')) exit;

get_header();

$fields = [
    'entry_content' => get_field('entry_content'),
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
		$highlighted_word_html = '<a href="javascript:void(0)" class="highlighted-word hoverable underline underline-offset-4 decoration-2 transition-colors duration-200 text-primary lg:underline-offset-[6px]" data-videos="' . $json_data . '" data-group-id="' . $key . '">' . $actual_word . '</a>';

		// Replace the word in the entry text with the highlighted word
        $main_text = str_replace($word['matched_word'], $highlighted_word_html, $main_text);
	}
}

$projects = get_posts([
	'post_type'   => 'work',
	'post_status' => 'publish',
	'numberposts' => -1,
]);
$divided_projects = array_chunk($projects, ceil(count($projects) / 2));
?>
<section class="home-hero container h-hero-screen flex flex-col items-center pb-12 relative z-0 lg:pb-16">
	<div class="text-container mt-auto relative">
		<div class="hero-text max-w-md relative z-10 mx-auto text-3xl tracking-tight text-balance text-center lg:max-w-2xl lg:text-5xl/[1.2] lg:tracking-[0.5px]">
			<?= $main_text; ?>
		</div>
	</div>
	<a href="#work" class="mt-auto relative z-10">
		<?php get_template_part('template-parts/bumpy-pixelated-arrow', null, ['class' => 'w-12', 'alt' => 'Slide down']); ?>
	</a>
</section>
<?php if ($projects) : ?>
    <section class="container pt-12 pb-14" id="work">
         <ul class="lg:columns-4">
            <?php foreach ($projects as $project) :
                $thumbnails = get_field('thumbnails', $project->ID);
                ?>
                <li class="work-item group mb-4">
                    <a class="h-full rounded-2xl overflow-hidden flex relative z-0" href="<?= get_permalink($project->ID); ?>" data-cursor-project="<?= $project->post_title; ?>">
                        <?php if ($thumbnails['main_image'] && $thumbnails['hovered_video']) : ?>
                            <img class="w-full object-cover transition-opacity duration-500 opacity-100 z-10 group-[.active]:opacity-0 group-hover:lg:opacity-0" src="<?= $thumbnails['main_image']['url']; ?>" alt="<?= $thumbnails['main_image']['alt']; ?>">
                            <video preload="none" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500 opacity-100 lg:opacity-0 group-hover:lg:opacity-100" width="<?= $thumbnails['hovered_video']['width']; ?>" height="<?= $thumbnails['hovered_video']['height']; ?>" playsinline muted loop>
                                <source src="<?= $thumbnails['hovered_video']['url']; ?>" >
                                Your browser does not support HTML video.
                            </video>
                        <?php elseif ($thumbnails['main_image']): ?>
                            <div class="w-full h-full absolute inset-0 bg-primary/70 z-20 opacity-0 duration-500 group-[.active]:opacity-100 group-hover:opacity-100"></div>
                            <img class="w-full object-cover transition-opacity duration-500 opacity-100 z-10" src="<?= $thumbnails['main_image']['url']; ?>" alt="<?= $thumbnails['main_image']['alt']; ?>">
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php else : ?>
    <p>No works found.</p>
<?php endif; ?>

<?php
get_footer();