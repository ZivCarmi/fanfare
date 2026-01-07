<?php if (!defined('ABSPATH')) exit;
$content = $args['content'];
?>

<section class="pt-4 px-site-mobile lg:pt-0 lg:px-0 lg:-mt-header-height lg:h-[80dvh]">
    <?php if ($content['type'] === "image") : ?>
        <img class="w-full h-full object-cover object-center" src="<?= $content['url']; ?>" alt="<?= $content['alt']; ?>">
    <?php elseif ($content['type'] === "video") : ?>
        <video class="w-full h-full object-cover object-center" src="<?= $content['url']; ?>" preload="metadata" data-lazy-load width="<?= $content['width']; ?>" height="<?= $content['height']; ?>" playsinline muted loop></video>
    <?php endif; ?>
</section>