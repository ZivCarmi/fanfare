<?php if (!defined('ABSPATH')) exit;

$is_light = isset($args['light']) ? true : false;
$custom_bg = isset($args['custom_bg']) ? ' ' . $args['custom_bg'] : '';
$background = $custom_bg ? $custom_bg : (!$is_light ? ' bg-background' : '');
$hoverable_logo = !isset($args['hoverable_logo']) ?? true;
?>

<!doctype html>
<html <?php language_attributes(); ?> class="dark snap-y snap-proximity">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">

		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-NM68X9MKFN"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-NM68X9MKFN');
		</script>

		<?php wp_head(); ?>
	</head>

	<body <?php body_class('text-primary-foreground'); ?>>

		<div id="preloader" class="loading">
			<div class="grid place-items-center">
				<img class="h-11 lg:h-56" src="<?= wp_get_attachment_url(431);?>" alt="Loading" />
				<div id="loading-bar-container" class="relative w-[85px] h-[7px] -mb-[10vh] lg:-mb-[15vh]">
					<div id="loading-bar" class="absolute top-0 left-0 w-full h-full bg-background"></div>
					<div id="loading-bar-tracker" class="absolute top-0 left-0 h-full bg-secondary"></div>
				</div>
			</div>
		</div>

		<?php wp_body_open(); ?>

		<div class="main-container min-h-dvh grid grid-rows-[auto_1fr_auto]<?= $background; ?>">
			<header id="site-header" class="pt-6 h-header-height sticky top-0 z-50 w-full">
				<div class="container">
					<div id="site-navigation" class="text-primary-foreground bg-primary lg:bg-transparent<?= $is_light ? ' lg:text-background' : ''; ?>">
						<nav class="flex flex-col px-site-mobile pb-12 h-full justify-end lg:grid lg:grid-cols-[1fr_auto_1fr] lg:flex-row lg:p-0 lg:justify-normal">
							<?php
								wp_nav_menu([
									'container' => false,
									'theme_location' => 'left_menu',
									'menu_class' => 'menu [&>*]:border-b-2 [&>*]:py-1 lg:flex lg:items-center lg:gap-[3.75rem] lg:[&>*]:border-b-0'
								]);
							?>					
							<span class="hidden lg:block<?= $hoverable_logo ? ' hoverable-content' : ''; ?>">
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
								<svg class="lines" width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g clip-path="url(#clip0_1564_1545)">
										<path d="M29.4264 3.67753L18.5 2.33594L17.8475 7.64995L28.7739 8.99154L29.4264 3.67753Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
										<path d="M22.486 3.72525L13.4297 2.61328L12.7772 7.92729L21.8335 9.03926L22.486 3.72525Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
										<path d="M15.5494 3.77102L8.36328 2.88867L7.7108 8.20268L14.8969 9.08503L15.5494 3.77102Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
										<path d="M8.61178 3.81908L3.29297 3.16602L2.64049 8.48003L7.9593 9.13309L8.61178 3.81908Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
										<path d="M28.3932 12.0994L17.4668 10.7578L16.8143 16.0718L27.7407 17.4134L28.3932 12.0994Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
										<path d="M21.4528 12.1471L12.3965 11.0352L11.744 16.3492L20.8003 17.4611L21.4528 12.1471Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
										<path d="M14.5143 12.1968L7.32812 11.3145L6.67565 16.6285L13.8618 17.5108L14.5143 12.1968Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
										<path d="M7.57858 12.2429L2.25977 11.5898L1.60729 16.9039L6.9261 17.5569L7.57858 12.2429Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
										<path d="M27.3581 20.5213L16.4316 19.1797L15.7792 24.4937L26.7056 25.8353L27.3581 20.5213Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
										<path d="M20.4176 20.569L11.3613 19.457L10.7088 24.771L19.7651 25.883L20.4176 20.569Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
										<path d="M13.4811 20.6148L6.29492 19.7324L5.64244 25.0464L12.8286 25.9288L13.4811 20.6148Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
										<path d="M6.54342 20.6628L1.22461 20.0098L0.572131 25.3238L5.89094 25.9768L6.54342 20.6628Z" fill="<?= $is_light ? 'black' : 'white'; ?>"/>
									</g>
									<defs>
										<clipPath id="clip0_1564_1545">
											<rect width="26" height="25" fill="white" transform="translate(3.61914 0.509766) rotate(7)"/>
										</clipPath>
									</defs>
								</svg>
								<svg class="arrow hidden" width="18" height="25" viewBox="0 0 18 25" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g clip-path="url(#clip0_2365_2051)">
										<path d="M18.0031 12.2051H13.7188V16.5032H18.0031V12.2051Z" fill="white"/>
										<path d="M15.2589 13.9043H10.9746V18.2024H15.2589V13.9043Z" fill="white"/>
										<path d="M12.5148 15.6035H8.23047V19.9016H12.5148V15.6035Z" fill="white"/>
										<path d="M9.7726 17.3027H5.48828V21.6008H9.7726V17.3027Z" fill="white"/>
										<path d="M7.02846 19.0039H2.74414V23.302H7.02846V19.0039Z" fill="white"/>
										<path d="M4.28432 20.7031H0V25.0012H4.28432V20.7031Z" fill="white"/>
										<path d="M4.28432 0H0V4.29808H4.28432V0Z" fill="white"/>
										<path d="M7.02846 1.69922H2.74414V5.9973H7.02846V1.69922Z" fill="white"/>
										<path d="M9.7726 3.39844H5.48828V7.69652H9.7726V3.39844Z" fill="white"/>
										<path d="M12.5148 5.09766H8.23047V9.39574H12.5148V5.09766Z" fill="white"/>
										<path d="M15.2589 6.79688H10.9746V11.095H15.2589V6.79688Z" fill="white"/>
										<path d="M18.0031 8.49609H13.7188V12.7942H18.0031V8.49609Z" fill="white"/>
									</g>
									<defs>
										<clipPath id="clip0_2365_2051">
											<rect width="18" height="25" fill="white"/>
										</clipPath>
									</defs>
								</svg>
							</button>
						</div>
					</div>
				</div>
			</header>

			<main>
				