<?php if (!defined('ABSPATH')) exit;

get_header();

$fields = [
    'hero' => get_field('hero'),
    'entry_content' => get_field('entry_content'),
    'content' => get_field('content'),
];

$prev_post = get_looping_adjacent_post(true);
$next_post = get_looping_adjacent_post(false);
?>

<?php if ($fields['hero']) : ?>
    <section class="relative pt-4 px-site-mobile lg:pt-0 lg:px-0 lg:-mt-header-height lg:h-dvh">
        <video class="h-full object-cover" width="100%" height="100%" playsinline autoplay muted loop>
            <source src="<?= $fields['hero']['url']; ?>" >
            Your browser does not support HTML video.
        </video>
        <a class="absolute bottom-3 right-8 lg:bottom-8 lg:right-14" href="#project-details" title="Scroll to project details">
            <svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24.5346 10.959L12.9586 22.535L2.00063 11.5771" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </section>
<?php endif; ?>
<section class="container px-site-mobile py-5 lg:pt-16 lg:px-site-desktop lg:pb-[3.125rem]" id="project-details">
    <div class="pb-5 border-b-2 lg:flex lg:gap-[4.375rem] lg:pb-10">
        <div class="lg:flex lg:gap-[4.375rem]">
            <h1 class="text-22px font-extrabold lg:w-[10.3125rem] lg:text-34px lg:font-bold"><?php the_title(); ?></h1>
            <?php if ($fields['entry_content']) : ?>
                <div class="text-22px font-medium lg:w-[25rem] lg:mt-3">
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
            <div class="mt-[1.875rem] lg:mt-3 lg:text-22px"><?= $fields['entry_content']['description']; ?></div>
        <?php endif; ?>
    </div>
</section>
<?php if ($fields['content']) : ?>
    <section class="container px-site-mobile lg:px-site-desktop">
        <div class="grid gap-5 lg:gap-8">
            <?php foreach ($fields['content'] as $content) : ?>
                <?php get_template_part('template-parts/' . $content['acf_fc_layout'], null, ['content' => $content]); ?>
            <?php endforeach; ?>
        </div>
        <div class="flex gap-4 border-t py-8 mt-5 lg:mt-12 lg:py-24">
            <?php if (!empty($next_post)) : ?>
                <a class="flex flex-row-reverse gap-4 lg:gap-7" href="<?= get_permalink($next_post->ID); ?>">
                    <div class="text-22px self-center lg:text-56px lg:font-semibold"><?= $next_post->post_title; ?></div>
                    <div class="flex items-center justify-center -ms-1.5 lg:-ms-3">
                        <?php get_template_part('template-parts/bumpy-pixelated-arrow', null, ['class' => 'rotate-90 w-4 lg:w-12', 'alt' => 'Previous project']); ?>
                    </div>
                </a>
            <?php endif; ?>
            <?php if (!empty($prev_post)) : ?>
                <a class="flex gap-4 ml-auto lg:gap-7" href="<?= get_permalink($prev_post->ID); ?>">
                    <div class="text-22px self-center lg:text-56px lg:font-semibold"><?= $prev_post->post_title; ?></div>
                    <div class="flex items-center justify-center -me-1.5 lg:-me-3">
                        <?php get_template_part('template-parts/bumpy-pixelated-arrow', null, ['class' => '-rotate-90 w-4 lg:w-12', 'alt' => 'Next project']); ?>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php
get_footer(null, ["border_top" => true]);
