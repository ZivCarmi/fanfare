<?php if (!defined('ABSPATH')) exit;

$is_light = isset($args['light']) ? true : false;
$custom_bg = isset($args['custom_bg']) ? ' ' . $args['custom_bg'] : '';
$background = $custom_bg ? $custom_bg : (!$is_light ? ' bg-background' : '');
$hoverable_logo = !isset($args['hoverable_logo']) ?? true;
?>

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

		<div id="preloader" class="loading"></div>

		<?php wp_body_open(); ?>

		<div class="main-container min-h-dvh grid grid-rows-[auto_1fr_auto]<?= $background; ?>">
			<header id="site-header" class="pt-6 h-header-height sticky top-0 z-50 w-full">
				<div class="container">
					<div id="site-navigation" class="<?= $is_light ? 'lg:text-background' : ''; ?>">
						<nav class="flex justify-between items-center pb-12 lg:p-0">
							<?php
							get_template_part('/template-parts/logo');
							
							wp_nav_menu([
									'container' => false,
									'theme_location' => 'right_menu',
								]);
							?>
						</nav>
					</div>
				</div>
			</header>

			<main>
				