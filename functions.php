<?php
/**
 * Fanfare functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fanfare
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

// set the base root directory path
define('BDIR', __DIR__);

// the template directory
define('TEMPLATE_DIRECTORY', get_template_directory());

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fanfare_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Fanfare, use a find and replace
		* to change 'fanfare' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'fanfare', TEMPLATE_DIRECTORY . '/languages' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	/**
	 * Add Woocommerce support.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support('woocommerce');
}
add_action( 'after_setup_theme', 'fanfare_setup' );

// theme helper functions
require TEMPLATE_DIRECTORY . '/inc/helpers.php';

// Loading theme styles and scripts
require TEMPLATE_DIRECTORY . '/inc/enqueue.php';

// registering content
require TEMPLATE_DIRECTORY . '/inc/register.php';

// remove wordpress core features
require TEMPLATE_DIRECTORY . '/inc/remove-core-features.php';

// Theme filters
require TEMPLATE_DIRECTORY . '/inc/actions.php';

// Theme filters
require TEMPLATE_DIRECTORY . '/inc/filters.php';

if (class_exists('woocommerce')) {
	// Theme woocommerce actions
	require TEMPLATE_DIRECTORY . '/inc/woocommerce-actions.php';

	// Theme woocommerce filters
	require TEMPLATE_DIRECTORY . '/inc/woocommerce-filters.php';
}