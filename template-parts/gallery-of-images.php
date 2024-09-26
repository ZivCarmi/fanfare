<?php if (!defined('ABSPATH')) exit;
$content = $args['content'];
?>

<div class="grid justify-items-center<?= count($content['gallery']) > 1 ? ' lg:grid-cols-2' : "" ?>">
    <?php foreach ($content['gallery'] as $file) : ?>
        <?php if ($file['type'] === 'image') : ?>
            <img class="w-full" src="<?= $file['url']; ?>" alt="<?= $file['alt']; ?>">
        <?php elseif ($file['type'] === 'video') : ?>
            <video class="w-full h-full object-cover" width="<?= $file['width']; ?>" height="<?= $file['height']; ?>" autoplay muted loop>
                <source src="<?= $file['url']; ?>" >
                Your browser does not support HTML video.
            </video>
        <?php endif; ?>
    <?php endforeach; ?>
</div>