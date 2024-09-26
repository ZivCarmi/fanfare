<?php if (!defined('ABSPATH')) exit;

get_header();

$fields = [
    'hero' => get_field('hero'),
    'entry_content' => get_field('entry_content'),
    'content' => get_field('content'),
];
?>

<?php if ($fields['hero']) : ?>
    <section class="relative pt-4 px-site-mobile lg:pt-0 lg:px-0 lg:-mt-header-height lg:h-dvh">
        <video class="h-full object-cover" width="100%" height="100%" autoplay muted loop>
            <source src="<?= $fields['hero']['url']; ?>" >
            Your browser does not support HTML video.
        </video>
        <a class="absolute bottom-8 right-14" href="#project-details" title="Scroll to project details">
            <svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24.5346 10.959L12.9586 22.535L2.00063 11.5771" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </section>
<?php endif; ?>
<section class="container pt-5 pb-8 lg:pt-16 lg:pb-32" id="project-details">
    <div class="grid gap-4 lg:grid-cols-2">
        <div class="lg:justify-self-center">
            <h1 class="text-22px font-extrabold mb-0.5 lg:text-34px lg:font-bold lg:mb-3"><?php the_title(); ?></h1>
            <?php if ($fields['entry_content']) : ?>
                <div class="text-22px font-medium">
                    <?php if ($fields['entry_content']['vibe_sentence']) : ?>
                        <?= $fields['entry_content']['vibe_sentence']; ?>
                    <?php endif; ?>
                    <?php if ($fields['entry_content']['year']) : ?>
                        <div><?= $fields['entry_content']['year']; ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($fields['entry_content'] && $fields['entry_content']['description']) : ?>
            <div class="lg:text-22px"><?= $fields['entry_content']['description']; ?></div>
        <?php endif; ?>
    </div>
</section>
<?php if ($fields['content']) : ?>
    <section class="container">
        <div class="grid gap-5 lg:gap-8">
            <?php foreach ($fields['content'] as $content) : ?>
                <?php get_template_part('template-parts/' . $content['acf_fc_layout'], null, ['content' => $content]); ?>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>

<?php
get_footer();
