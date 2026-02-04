<?php if (!defined('ABSPATH')) exit;

$content = $args['content'];

$gallery_count = count($content['gallery']);
$grid_cols = $gallery_count >= 8 ? 'lg:grid-cols-4' : ($gallery_count >= 2 ? 'lg:grid-cols-2' : '');
?>

<div class="grid gap-5 justify-items-center <?= $grid_cols; ?> lg:gap-8">
    <?php foreach ($content['gallery'] as $file) :
            $is_manual_video = $file['type'] === 'video' && get_post_meta($file['ID'], '_video_manualplay', true);
            $asset_data = htmlspecialchars(json_encode(['type' => $file['type'], 'url' => $file['url'], 'manual' => $is_manual_video]), ENT_QUOTES, 'UTF-8');
            ?>
            <button class="w-full rounded-2xl overflow-hidden" data-asset="<?= $asset_data; ?>">
                <?php if ($file['type'] === 'image') : ?>
                    <img class="slider-asset w-full" src="<?= $file['url']; ?>" alt="<?= $file['alt']; ?>">
                <?php elseif ($file['type'] === 'video') : ?>
                    <video class="slider-asset w-full" src="<?= $file['url']; ?>" preload="metadata" width="<?= $file['width']; ?>" height="<?= $file['height']; ?>" data-lazy-load muted playsinline loop></video>
                <?php endif; ?>
            </button>
    <?php endforeach; ?>
    <?php if ($content['text_block']['text']) :
        $align = $content['text_block']['text_alignment'];
        $row = $content['text_block']['position']['row'];
        $column = $content['text_block']['position']['column'];
        $styles = 'align-self: ' . $align . '; grid-row: ' . $row . ';grid-column: ' . $column . ';';
        ?>
        <div class="lg:justify-self-start lg:text-22px <?= intval($row) === 1 ? 'lg:pb-10' : 'lg:pt-10'; ?> <?= intval($column) === 1 ? 'lg:pr-16' : 'lg:pl-16'; ?>" style="<?= $styles; ?>">
            <?= $content['text_block']['text']; ?>
        </div>
    <?php endif; ?>
</div>