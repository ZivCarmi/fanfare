<?php if (!defined('ABSPATH')) exit;

global $wp_query;


get_header();

$projects = $wp_query->posts;

if (have_posts()) : ?>
    <section class="container pt-12 pb-14">
        <ul class="grid justify-items-center gap-2.5 lg:grid-cols-2 lg:gap-10">
            <?php while (have_posts()) :
                the_post();
                $thumbnails = get_field('thumbnails');
            ?>
                <li class="work-item group">
                    <a class="h-full flex relative" href="<?= get_permalink(); ?>">
                        <?php if ($thumbnails['hovered_video']) : ?>
                            <img class="object-cover transition-opacity duration-500 opacity-100 z-10 group-[.active]:opacity-0 group-hover:lg:opacity-0" src="<?= $thumbnails['main_image']['url']; ?>" alt="<?= $thumbnails['main_image']['alt']; ?>">
                        <?php endif; ?>
                        <?php if ($thumbnails['hovered_video']) : ?>
                            <video preload="none" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500 opacity-100 lg:opacity-0 group-hover:lg:opacity-100" width="<?= $thumbnails['hovered_video']['width']; ?>" height="<?= $thumbnails['hovered_video']['height']; ?>" muted loop>
                                <source src="<?= $thumbnails['hovered_video']['url']; ?>" >
                                Your browser does not support HTML video.
                            </video>
                        <?php endif; ?>
                    </a>
                </li>  
            <?php endwhile; ?>
            <?php if (count($projects) % 2 !== 0) : ?>
                <li class="hidden lg:block">
                    <span class="text-80px font-bold transition-colors duration-500 hover:text-secondary">We’ve got more surprises up our sleeve.</span>
                </li>  
            <?php endif; ?>
        </ul>
    </section>
<?php else : ?>
    <p>No works found.</p>
<?php endif; ?>

<?php
get_footer(null, ['border_top' => true]);