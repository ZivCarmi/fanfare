<?php if (!defined('ABSPATH')) exit;
$content = $args['content'];
?>

<div class="flex flex-col gap-5 lg:gap-9 <?= $content['inversed'] ? 'lg:flex-row-reverse' : 'lg:flex-row'; ?>">
    <div class="flex-1">
        <?php if ($content['selection'] === "image") : ?>
            <button class="w-full rounded-2xl overflow-hidden" data-asset="<?= htmlspecialchars(json_encode(['type' => 'image', 'url' => $content['image']['url']]), ENT_QUOTES, 'UTF-8'); ?>">
                <img class="slider-asset w-full" src="<?= $content['image']['url']; ?>" alt="<?= $content['image']['alt']; ?>">
            </button>
        <?php elseif ($content['selection'] === "video") : ?>
            <button class="w-full rounded-2xl overflow-hidden" data-asset="<?= htmlspecialchars(json_encode(['type' => 'video', 'url' => $content['video']['url']]), ENT_QUOTES, 'UTF-8'); ?>">
                <video class="slider-asset w-full" src="<?= $content['video']['url']; ?>" preload="metadata" data-lazy-load width="<?= $content['video']['width']; ?>" height="<?= $content['video']['height']; ?>" playsinline muted loop></video>
            </button>
        <?php endif; ?>
    </div>
    <div class="textfield flex-1" style="align-self: <?= $content['content']['running_text']['text_alignment']; ?>">
        <h2 class="text-34px font-bold mb-3"><?= $content['content']['title']; ?></h2>
        <div class="lg:text-22px"><?= $content['content']['running_text']['text']; ?></div>
    </div>
</div>