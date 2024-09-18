<?php if (!defined('ABSPATH')) exit; ?>

<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>

		<header class="site-header bg-black">
				<div id="site-navigation" class="main-navigation">
					<nav class="nav-container">
						<?php wp_nav_menu(['container' => false, 'theme_location' => 'left_menu', 'menu_class' => 'menu left-menu']); ?>
						<ul class="logo">
							<li>
								<?= get_custom_logo(); ?>
							</li>
						</ul>
						<?php wp_nav_menu(['container' => false, 'theme_location' => 'right_menu', 'menu_class' => 'menu right-menu']); ?>
					</nav>
				</div>
		</header>

		<main>