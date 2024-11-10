<?php if (!defined('ABSPATH')) exit;

// Template Name: About

get_header();

$fields = [
    'text' => get_field('text'),
    'personal_note' => get_field('personal_note'),
    'our_vibe' => get_field('our_vibe'),
];
?>

<section class="max-w-[16.25rem] w-full mx-auto pt-[4.5rem] lg:max-w-[53rem]">
    <div class="flex justify-center items-start lg:pb-14">
        <img class="w-12 rounded-3px lg:hidden" src="<?= $fields['personal_note']['image']['url']; ?>" alt="<?= $fields['personal_note']['image']['alt']; ?>">
        <h1 class="pl-[1.375rem] font-bold lg:pl-0 lg:text-center lg:text-56px lg:font-semibold"><?= $fields['text']; ?></h1>
    </div>
    <div class="flex justify-center items-start lg:max-w-[43.125rem] lg:mx-auto">
        <img class="hidden w-12 rounded-10px lg:w-[9.375rem] lg:block" src="<?= $fields['personal_note']['image']['url']; ?>" alt="<?= $fields['personal_note']['image']['alt']; ?>">
        <div class="flex flex-col mt-4 text-sm/4 lg:text-22px lg:mt-0 lg:ml-10 lg:justify-between">
            <div><?= $fields['personal_note']['note']; ?></div>
            <div class="self-end mt-8 lg:mt-4">
                <img class="w-24 lg:w-48" src="<?= $fields['personal_note']['signature']['url']; ?>" alt="<?= $fields['personal_note']['signature']['alt']; ?>">
                <div class="mt-1 text-right text-secondary">Sagi Carmi</div>
            </div>
        </div>
    </div>
</section>
<section class="container py-20 lg:py-32">
    <div class="text-center mb-12">
        <h2 class="font-bold text-36px lg:text-80px"><?= $fields['our_vibe']['title']; ?></h2>
        <div class="mt-1 lg:text-22px"><?= $fields['our_vibe']['description']; ?></div>
    </div>
    <div class="cards grid gap-2.5 lg:justify-center">
        <?php foreach ($fields['our_vibe']['cards'] as $key => $card) : ?>
            <div class="card flex items-start justify-between rounded-10px border p-4 duration-300 hover:bg-primary lg:px-10 lg:py-8 lg:even:flex-row-reverse lg:max-w-[52.6875rem]">
                <div class="flex gap-2 text-12px lg:text-22px lg:gap-7">
                    <span class="text-secondary">0<?= $key + 1; ?></span>
                    <div class="description">
                        <div class="title text-secondary"><?= $card['title']; ?></div>
                        <div class="mt-2.5 text-balance lg:mt-1.5"><?= $card['description']; ?></div>
                    </div>
                </div>
                <img class="self-center w-24 lg:w-32" src="<?= $card['icon']['url']; ?>" alt="<?= $card['icon']['alt']; ?>">   
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
get_footer();