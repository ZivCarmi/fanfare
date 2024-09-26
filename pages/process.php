<?php if (!defined('ABSPATH')) exit;

// Template Name: Process

get_header(null, ['light' => true]);

$fields = [
    'main_tab' => get_field('main_tab'),
    'tabs' => get_field('tabs'),
];
?>

<section class="container-no-padding pt-8 grid lg:grid-cols-process lg:h-full">
    <div class="w-full px-site pt-8 pb-6 bg-primary text-primary-foreground">
        <div class="max-w-[11.75rem]">
            <h1 class="text-4xl font-bold"><?= $fields['main_tab']['tab_title']; ?></h1>
            <div class="">
                <div class="text-4xl font-bold"><?= $fields['main_tab']['big_title']; ?></div>
                <div class="text-secondary mt-12"><?= $fields['main_tab']['small_text']; ?></div>
            </div>
        </div>
    </div>
    <?php if ($fields['tabs']) : ?>
        <?php foreach ($fields['tabs'] as $key => $tab) : ?>
            <div class="flex flex-col text-background border-background border-b lg:border-t lg:border-l lg:border-b-0">
                <button class="tab-trigger hidden w-full h-full justify-between px-site py-4 text-6xl font-bold lg:flex lg:flex-col lg:px-0">
                    <span>0<?= $key + 1; ?></span>
                    <div class="[writing-mode:vertical-lr] rotate-180"><?= $tab['tab_title']; ?></div>
                </button>
                <button class="tab-trigger w-full justify-between px-site py-4 text-4xl font-bold lg:hidden">
                    <?= $tab['tab_title']; ?>
                    <span>0<?= $key + 1; ?></span>
                </button>
                <div class="tab-content hidden">
                    <div class="">
                        <div class="pt-6 pb-10 px-10 text-center text-balance"><?= $tab['tab_content']; ?></div>
                        <?php if ($tab['tab_tags']) : ?>
                            <div class="bg-secondary">
                                <ul class="columns-2 px-10 py-5">
                                    <?php foreach ($tab['tab_tags'] as $tag) : ?>
                                        <li class="font-bold"><?= $tag['tag']; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

<?php
get_footer();