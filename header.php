<?php if (!defined('ABSPATH')) exit; ?>

<!doctype html>
<html <?php language_attributes(); ?> class="dark">
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

		<!-- <div id="preloader" class="loading"></div> -->

		<?php wp_body_open(); ?>

		<div class="main-container min-h-dvh grid grid-rows-[auto_1fr_auto] bg-background">
			<header id="site-header" class="pt-6 h-header-height sticky top-0 w-full z-10">
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

			<main>
				