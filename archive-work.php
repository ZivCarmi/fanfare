<?php if (!defined('ABSPATH')) exit;

get_header();

if (have_posts()) : ?>
    <section class="container pt-12 pb-14">
        <ul class="grid justify-items-center gap-2.5 lg:grid-cols-2 lg:gap-10">
            <?php while (have_posts()) :
                the_post();
                $thumbnails = get_field('thumbnails');
            ?>
                <li class="work-item group">
                    <a class="block relative" href="<?= get_permalink(); ?>" title="<?= the_title(); ?>">
                        <?php if ($thumbnails['hovered_video']) : ?>    
                            <img class="object-cover transition-opacity duration-500 opacity-100 group-hover:opacity-0" src="<?= $thumbnails['main_image']['url']; ?>" alt="<?= $thumbnails['main_image']['alt']; ?>">
                        <?php endif; ?>
                        <?php if ($thumbnails['hovered_video']) : ?>
                            <video class="absolute inset-0 w-full object-cover transition-opacity duration-500 opacity-0 group-hover:opacity-100" width="<?= $thumbnails['hovered_video']['width']; ?>" height="<?= $thumbnails['hovered_video']['height']; ?>" muted loop>
                                <source src="<?= $thumbnails['hovered_video']['url']; ?>" >
                                Your browser does not support HTML video.
                            </video>
                        <?php endif; ?>
                    </a>
                </li>  
            <?php endwhile; ?>
        </ul>
    </section>
<?php else : ?>
    <p>No works found.</p>
<?php endif; ?>

<?php
get_footer(null, ['border_top' => true]);