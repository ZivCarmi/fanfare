<?php if (!defined('ABSPATH')) exit;

// Template Name: Process

get_header(null, ['light' => true, 'hoverable_logo' => false]);

$fields = [
    'main_tab' => get_field('main_tab'),
    'tabs' => get_field('tabs'),
];
?>

<section class="tabs-container pt-8 grid lg:grid-cols-process lg:h-full lg:transition-[grid-template-columns] lg:duration-500">
    <div class="group w-full relative overflow-hidden bg-primary text-primary-foreground" data-tab="0">
        <div class="w-full h-full flex flex-col justify-between items-start relative z-10 text-left px-site-mobile pt-8 pb-5 lg:px-[2vw] lg:pt-[3vh] lg:pb-[5vh]">
            <h1 class="text-4xl font-bold lg:text-60px"><?= $fields['main_tab']['tab_title']; ?></h1>
            <div class="tab-content flex w-full transition-opacity duration-500 lg:group-[.hidden-content]:opacity-0">
                <div class="w-full flex justify-between flex-col">
                    <div class="text-4xl font-bold lg:text-[clamp(6.5rem,10vw,8.75rem)]/[0.85] lg:font-extrabold">
                        <div><?= $fields['main_tab']['big_title']['first_half']; ?></div>
                        <div class="lg:flex lg:gap-4">
                            <div class="text-nowrap"><?= $fields['main_tab']['big_title']['second_half']; ?></div>
                            <div class="flex">
                                <div class="main-description duration-300 text-secondary text-nowrap mt-12 text-base font-normal lg:text-[clamp(0.9rem,1.4vw,1.3rem)]/[1.08] lg:mb-2 lg:mt-0 lg:self-end"><?= $fields['main_tab']['small_text']; ?></div>
                                <svg class="w-[29px] h-[21px] mt-2.5 ml-auto relative -top-1.5 self-end rotate-90 lg:absolute lg:right-6 lg:top-8 lg:w-auto lg:h-auto lg:rotate-0 lg:self-start" width="59" height="42" viewBox="0 0 59 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M43.3218 0H33.9258V10.5462H38.3507V13.8595H42.7754V16.5557H32.4501V18.209H26.5503H25.0758H23.5999V16.5557H19.175H19.1749H10.3251V18.209H10.325H8.84985H5.90002H2.94987H1.47497L1.47497 19.8663H0V26.4885H5.89999V24.8312H5.90002V26.4868H14.75V24.8334H17.7003V26.4868H25.0758H26.5503H33.9258V24.8334H42.2429V26.4882H39.8251V31.457H33.9245V42.0032H43.3206V37.0344H49.2212V33.0325H51.6389V27.8558H56.2484V26.4885H59.0001V19.8663H56.2484V17.3096H52.1714V11.5879H47.7467V3.31328H43.3218V0Z" fill="black"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <video preload="none" class="hidden absolute inset-0 w-full h-full object-cover mix-blend-overlay" playsinline muted loop>
            Your browser does not support HTML video.
        </video>
    </div>
    <?php if ($fields['tabs']) : ?>
        <?php foreach ($fields['tabs'] as $key => $tab) : ?>
            <div class="tab-container group flex flex-col text-background duration-500 overflow-hidden border-background [&:not(:last-child)]:border-b lg:border-t-2 lg:border-l-2 lg:[&:not(:last-child)]:border-b-0" data-tab-video="<?= htmlspecialchars(json_encode($tab['tab_video']), ENT_QUOTES, 'UTF-8'); ?>" data-tab="<?= $key + 1; ?>">
                <button class="tab-trigger w-full justify-between flex-col grow items-start">
                    <div class="hoverable tab-titles w-full flex justify-between items-center py-4 px-site-mobile duration-500 text-4xl font-bold lg:h-full lg:flex-col-reverse lg:gap-24 lg:px-site-desktop lg:text-6xl">
                        <div class="lg:[writing-mode:vertical-lr] lg:rotate-180"><?= $tab['tab_title']; ?></div>
                        <div>0<?= $key + 1; ?></div>
                    </div>
                    <div class="tab-content hidden h-full flex-col text-center lg:group-[.active]:flex lg:text-left lg:text-22px">
                        <div class="hidden px-7 py-4 text-6xl font-bold lg:block">
                            <div class="tab-number inline-flex">
                                <div>0</div>
                                <?= $key + 1; ?>
                            </div>
                            <div><?= $tab['tab_title']; ?></div>
                        </div>
                        <div class="pt-6 pb-10 px-10 text-balance grow lg:group-[.active]:px-7 lg:text-wrap"><?= $tab['tab_content']; ?></div>
                        <?php if ($tab['tab_tags']) : ?>
                            <div class="bg-secondary">
                                <ul class="columns-2 px-10 py-5">
                                    <?php foreach ($tab['tab_tags'] as $tag) : ?>
                                        <li class="font-bold text-left lg:p-0.5"><?= $tag['tag']; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

<?php
get_footer();