<?php if (!defined('ABSPATH')) exit;
$content = $args['content'];
?>

<div class="grid justify-items-center<?= count($content['gallery']) > 1 ? ' lg:grid-cols-2' : "" ?>">
    <?php foreach ($content['gallery'] as $file) : ?>
        <?php if ($file['type'] === 'image') : ?>
            <img src="<?= $file['url']; ?>" alt="<?= $file['alt']; ?>">
        <?php elseif ($file['type'] === 'video') :
            $manualplay = get_post_meta($file['ID'], '_video_manualplay', true);
            ?>
            <div class="video-wrapper relative group">
                <?php if ($manualplay) : ?>
                    <img class="style-svg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 opacity-100 duration-200 group-[.playing]:opacity-0" src="<?= wp_get_attachment_url(446); ?>" alt="Play video">
                <?php endif; ?>
                <video preload="metadata" width="<?= $file['width']; ?>" height="<?= $file['height']; ?>" <?= !$manualplay ? 'data-lazy-load muted' : 'data-manual-play' ?> playsinline loop>
                    <source src="<?= $file['url']; ?>" >
                    Your browser does not support HTML video.
                </video>
            </div>
        <?php endif; ?>
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