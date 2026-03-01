<?php if (!defined('ABSPATH')) exit; ?>

<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">

		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z51X9DXNKP"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-Z51X9DXNKP');
		</script>

		<?php wp_head(); ?>
	</head>

	<body <?php body_class('text-primary-foreground'); ?>>

		<div id="preloader" class="loading"></div>

		<?php wp_body_open(); ?>

		<div class="main-container min-h-dvh grid grid-rows-[auto_1fr_auto] bg-background">
			<header id="site-header" class="fixed top-0 w-full z-20">
				<div class="mobile-menu-wrapper">
					<div class="container pt-6">
						<div id="site-navigation">
							<nav class="flex justify-between items-center">
								<?php get_template_part('/template-parts/logo'); ?>

								<div class="desktop-menu hidden lg:flex lg:gap-8">
									<?php
									wp_nav_menu([
										'container' => false,
										'theme_location' => 'right_menu',
									]);
									?>
								</div>

								<button
									type="button"
									id="mobile-menu-toggle"
									class="mobile-menu-toggle-btn lg:hidden relative w-10 h-10 z-50 rounded transition-opacity hover:opacity-80 focus:outline-none"
									aria-expanded="false"
									aria-controls="mobile-menu-panel"
									aria-label="<?php esc_attr_e( 'Open menu', 'sagicarmi' ); ?>"
								>
									<span class="mobile-menu-icon-line absolute left-1/2 w-6 h-0.5 bg-primary rounded top-[9px] -translate-x-1/2 transition-all duration-300 origin-center"></span>
									<span class="mobile-menu-icon-line absolute left-1/2 w-6 h-0.5 bg-primary rounded top-1/2 -translate-x-1/2 -translate-y-1/2 transition-all duration-300 origin-center"></span>
									<span class="mobile-menu-icon-line absolute left-1/2 w-6 h-0.5 bg-primary rounded bottom-[9px] -translate-x-1/2 transition-all duration-300 origin-center"></span>
								</button>
							</nav>

							<div id="mini-cart-dropdown" class="mini-cart-dropdown">
								<div class="widget_shopping_cart_content">
									<?php woocommerce_mini_cart(); ?>
								</div>
							</div>
						</div>

						<div
							id="mobile-menu-panel"
							class="mobile-menu-panel lg:hidden w-full overflow-hidden transition-[max-height,opacity] duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] max-h-0 opacity-0"
							role="dialog"
							aria-modal="true"
							aria-label="<?php esc_attr_e( 'Mobile menu', 'sagicarmi' ); ?>"
						>
							<div class="py-6">
								<?php
								wp_nav_menu([
									'container' => false,
									'theme_location' => 'right_menu',
									'menu_class' => 'mobile-menu flex flex-col gap-6 text-22px font-bold',
								]);
								?>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div id="mobile-menu-scrim" class="mobile-menu-scrim fixed inset-0 bg-black/40 z-10 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden" aria-hidden="true"></div>

			<div class="select-none pointer-events-none h-[180px] fixed z-10 top-0 left-0 right-0">
				<div class="absolute inset-0 overflow-hidden">
					<div style="opacity: 1; position: absolute; inset: 0px; z-index: 1; mask-image: linear-gradient(to top, rgba(0, 0, 0, 0) 0%, rgb(0, 0, 0) 12.5%, rgb(0, 0, 0) 25%, rgba(0, 0, 0, 0) 37.5%); border-radius: 0px; pointer-events: none; backdrop-filter: blur(0.046875px); will-change: auto;"></div>
					<div style="opacity: 1; position: absolute; inset: 0px; z-index: 2; mask-image: linear-gradient(to top, rgba(0, 0, 0, 0) 12.5%, rgb(0, 0, 0) 25%, rgb(0, 0, 0) 37.5%, rgba(0, 0, 0, 0) 50%); border-radius: 0px; pointer-events: none; backdrop-filter: blur(0.09375px); will-change: auto;"></div>
					<div style="opacity: 1; position: absolute; inset: 0px; z-index: 3; mask-image: linear-gradient(to top, rgba(0, 0, 0, 0) 25%, rgb(0, 0, 0) 37.5%, rgb(0, 0, 0) 50%, rgba(0, 0, 0, 0) 62.5%); border-radius: 0px; pointer-events: none; backdrop-filter: blur(0.1875px); will-change: auto;"></div>
					<div style="opacity: 1; position: absolute; inset: 0px; z-index: 4; mask-image: linear-gradient(to top, rgba(0, 0, 0, 0) 37.5%, rgb(0, 0, 0) 50%, rgb(0, 0, 0) 62.5%, rgba(0, 0, 0, 0) 75%); border-radius: 0px; pointer-events: none; backdrop-filter: blur(0.375px); will-change: auto;"></div>
					<div style="opacity: 1; position: absolute; inset: 0px; z-index: 5; mask-image: linear-gradient(to top, rgba(0, 0, 0, 0) 50%, rgb(0, 0, 0) 62.5%, rgb(0, 0, 0) 75%, rgba(0, 0, 0, 0) 87.5%); border-radius: 0px; pointer-events: none; backdrop-filter: blur(0.75px); will-change: auto;"></div>
					<div style="opacity: 1; position: absolute; inset: 0px; z-index: 6; mask-image: linear-gradient(to top, rgba(0, 0, 0, 0) 62.5%, rgb(0, 0, 0) 75%, rgb(0, 0, 0) 87.5%, rgba(0, 0, 0, 0) 100%); border-radius: 0px; pointer-events: none; backdrop-filter: blur(1.5px); will-change: auto;"></div>
					<div style="opacity: 1; position: absolute; inset: 0px; z-index: 7; mask-image: linear-gradient(to top, rgba(0, 0, 0, 0) 75%, rgb(0, 0, 0) 87.5%, rgb(0, 0, 0) 100%); border-radius: 0px; pointer-events: none; backdrop-filter: blur(3px); will-change: auto;"></div>
					<div style="opacity: 1; position: absolute; inset: 0px; z-index: 8; mask-image: linear-gradient(to top, rgba(0, 0, 0, 0) 87.5%, rgb(0, 0, 0) 100%); border-radius: 0px; pointer-events: none; backdrop-filter: blur(6px); will-change: auto;"></div>
				</div>
			</div>
			
			<main>
				