<?php if (!defined('ABSPATH')) exit;
$content = $args['content'];
?>

<div class="flex flex-col gap-4 <?= $content['inversed'] ? 'lg:flex-row-reverse' : 'lg:flex-row'; ?>">
    <div class="flex-1">
        <?php if ($content['selection'] === "image") : ?>
            <img class="w-full" src="<?= $content['image']['url']; ?>" alt="<?= $content['image']['alt']; ?>">
        <?php elseif ($content['selection'] === "video") : ?>
            <video class="w-full h-full object-cover" width="<?= $content['video']['width']; ?>" height="<?= $content['video']['height']; ?>" autoplay muted loop>
                <source src="<?= $content['video']['url']; ?>" >
                Your browser does not support HTML video.
            </video>
        <?php endif; ?>
    </div>
    <div class="flex-1" style="align-self: <?= $content['content']['running_text']['text_alignment']; ?>">
        <h2 class="text-34px font-bold mb-3"><?= $content['content']['title']; ?></h2>
        <div><?= $content['content']['running_text']['text']; ?></div>
    </div>
</div>