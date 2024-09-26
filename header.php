<?php if (!defined('ABSPATH')) exit;

$is_light = $args && $args['light'];
?>

<!doctype html>
<html <?php language_attributes(); ?> class="dark">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class('text-primary-foreground'); ?>>

		<?php wp_body_open(); ?>

		<div class="min-h-dvh grid grid-rows-[auto_1fr_auto]<?= !$is_light ? ' bg-background' : ''; ?>">
			<header id="site-header" class="pt-6 h-header-height sticky top-0 z-50 w-full">
				<div class="container">
					<div id="site-navigation" class="fixed z-50 inset-0 bg-primary text-primary-foreground hidden lg:block lg:relative lg:bg-transparent<?= $is_light ? ' lg:text-background' : ''; ?>">
						<nav class="flex flex-col px-site-mobile pb-12 h-full justify-end lg:grid lg:grid-cols-[1fr_auto_1fr] lg:flex-row lg:p-0 lg:justify-normal">
							<?php
								wp_nav_menu([
									'container' => false,
									'theme_location' => 'left_menu',
									'menu_class' => 'menu [&>*]:border-b-2 [&>*]:py-1 lg:flex lg:items-center lg:gap-[3.75rem] lg:[&>*]:border-b-0'
								]);
							?>					
							<span class="hidden lg:block">
								<?php get_template_part('/template-parts/logo'); ?>
							</span>
							<?php
								wp_nav_menu([
									'container' => false,
									'theme_location' => 'right_menu',
									'menu_class' => 'menu divide-y-2 [&>*]:py-1 lg:flex lg:items-center lg:gap-[3.75rem] lg:divide-y-0 lg:justify-self-end'
								]);
							?>
						</nav>
					</div>
					<div class="mobile-menu relative z-[51] lg:hidden">
						<div class="flex items-center justify-between">
							<?php get_template_part('/template-parts/logo'); ?>
							<button class="hamburger">
								<svg class="lines" width="33" height="22" viewBox="0 0 33 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M2 2H31" stroke="<?= $is_light ? 'black' : 'white'; ?>" stroke-width="3" stroke-linecap="round"/>
									<path d="M2 11H31" stroke="<?= $is_light ? 'black' : 'white'; ?>" stroke-width="3" stroke-linecap="round"/>
									<path d="M2 20H31" stroke="<?= $is_light ? 'black' : 'white'; ?>" stroke-width="3" stroke-linecap="round"/>
								</svg>
								<svg class="arrow hidden" width="33" height="38" viewBox="0 0 33 38" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7 2L30.7554 18.6337" stroke="white" stroke-width="3" stroke-linecap="round"/>
									<path d="M2 19H31" stroke="white" stroke-width="3" stroke-linecap="round"/>
									<path d="M7 36L30.7554 19.3663" stroke="white" stroke-width="3" stroke-linecap="round"/>
								</svg>
							</button>
						</div>
					</div>
				</div>
			</header>

			<main>
				