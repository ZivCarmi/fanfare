<?php if (!defined('ABSPATH')) exit;

get_header();

$fields = [
    'entry_content' => get_field('entry_content'),
    'main_video' => get_field('main_video'),
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
		$highlighted_word_html = '<span class="highlighted-word font-bold transition-colors duration-200 cursor-pointer text-primary" data-videos="' . $json_data . '" data-word-id="' . $key . '">' . $actual_word . '</span>';

		// Replace the word in the entry text with the highlighted word
        $main_text = str_replace($word['matched_word'], $highlighted_word_html, $main_text);
	}
}
?>

<section class="container h-hero-screen flex flex-col items-center pb-16">
	<div class="text-container mt-auto relative">
		<div class="relative z-10 mx-auto text-28px font-semibold text-balance max-w-80 lg:max-w-[58rem] lg:text-[4.47rem] lg:text-center">
			<?= $main_text; ?>
		</div>
	</div>
    <a href="#home-video" class="mt-auto">
       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="6 1 23 55" width="23" height="55">
            <path fill="white" d="M19.5 3C19.5 2.17157 18.8284 1.5 18 1.5C17.1716 1.5 16.5 2.17157 16.5 3H19.5ZM16.9393 56.0607C17.5251 56.6464 18.4749 56.6464 19.0607 56.0607L28.6066 46.5147C29.1924 45.9289 29.1924 44.9792 28.6066 44.3934C28.0208 43.8076 27.0711 43.8076 26.4853 44.3934L18 52.8787L9.51472 44.3934C8.92893 43.8076 7.97919 43.8076 7.3934 44.3934C6.80761 44.9792 6.80761 45.9289 7.3934 46.5147L16.9393 56.0607ZM16.5 3V55H19.5V3H16.5Z"/>
        </svg>
    </a>
</section>
<section class="h-dvh" id="home-video">
    <video class="h-full object-cover" width="<?= $fields['main_video']['width']; ?>" height="<?= $fields['main_video']['height']; ?>" autoplay muted loop>
        <source src="<?= $fields['main_video']['url']; ?>" >
        Your browser does not support HTML video.
    </video>
</section>

<?php
get_footer();