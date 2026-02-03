<?php if (!defined('ABSPATH')) exit;
$content = $args['content'];

if (!empty($content)) :
    if ($content === 'asset' && !empty($args['asset'][0])) :
        $asset = $args['asset'][0];
    ?>
        <section class="pt-4 px-site-mobile lg:pt-0 lg:px-0 lg:-mt-header-height lg:h-[80dvh]">
            <?php if ($asset['type'] === "image") : ?>
                <img class="w-full h-full object-cover object-center" src="<?= $asset['url']; ?>" alt="<?= $asset['alt']; ?>">
            <?php elseif ($asset['type'] === "video") : ?>
                <video class="w-full h-full object-cover object-center" src="<?= $asset['url']; ?>" preload="metadata" data-lazy-load width="<?= $asset['width']; ?>" height="<?= $asset['height']; ?>" playsinline muted loop></video>
            <?php endif; ?>
        </section>
    <?php elseif ($content === 'text' && !empty($args['text'])) : ?>
        <section class="container flex items-center justify-center pt-4 lg:pt-0 lg:-mt-header-height lg:h-[80dvh]">
            <div class="py-20 relative z-10 text-3xl tracking-tight text-balance text-center lg:text-5xl/[1.2] lg:tracking-[0.5px]">
                <?= $args['text']; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>