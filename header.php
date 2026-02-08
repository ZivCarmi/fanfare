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
			<header id="site-header" class="pt-6 h-header-height sticky top-0 w-full z-20">
				<div class="container">
					<div id="site-navigation">
						<nav class="flex justify-between items-center">
							<?php
							get_template_part('/template-parts/logo');
							
							wp_nav_menu([
								'container' => false,
								'theme_location' => 'right_menu',
							]);
							?>
						</nav>

						<div id="mini-cart-dropdown" class="mini-cart-dropdown">
							<div class="widget_shopping_cart_content">
								<?php woocommerce_mini_cart(); ?>
							</div>
						</div>
					</div>
				</div>
			</header>

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
				