<?php if (!defined('ABSPATH')) exit;

get_header();

$fields = [
	'404_image' => get_field('404_image', 'option'),
]
?>

<section class="flex flex-col items-center gap-6 text-center pt-32 px-site-mobile lg:px-site-desktop">
	<?php if ($fields['404_image']) : ?>
		<img class="w-full max-w-[33.9375rem]" src="<?= $fields['404_image']['url']; ?>" alt="<?= $fields['404_image']['alt']; ?>">
	<?php endif; ?>
	<h1 class="text-34px font-bold text-background">Oh, we don't have this page</h1>
	<a href="/" class="boxed-button">Home</a>
</section>

<?php
get_footer();