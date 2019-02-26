<?php
/**
 * Pytheas functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Store template directory as var
$dir = get_template_directory();

/*--------------------------------------*/
/* Include functions & classes
/*--------------------------------------*/
	require_once( $dir .'/functions/updates.php' );
	require_once( $dir .'/functions/social.php' );
	require_once( $dir .'/functions/theme-customizer.php' );
	require_once( $dir .'/functions/styling.php' );
	require_once( $dir .'/functions/theme-setup.php' );
	require_once( $dir .'/functions/add-image-sizes.php' );
	require_once( $dir .'/functions/scripts.php' );
	require_once( $dir .'/functions/core.php' );
	require_once( $dir .'/functions/post-types/portfolio.php' );
	require_once( $dir .'/functions/post-types/services.php' );
	require_once( $dir .'/functions/post-types/slides.php' );
	require_once( $dir .'/functions/header-css.php' );
	require_once( $dir .'/functions/widgets/widget-areas.php' );
	require_once( $dir .'/functions/widgets/widget-posts-thumbs.php' );
	require_once( $dir .'/functions/widgets/widget-portfolio-posts-thumbs.php' );
if ( is_admin() ) {
	require_once( $dir .'/functions/cmb2-init.php' );
	require_once( $dir .'/functions/dash-thumbs.php' );
} else {
	require_once( $dir .'/functions/posts-per-page.php' );
	require_once( $dir .'/functions/comments-callback.php' );
	require_once( $dir .'/functions/menu-walker.php' );
}
require_once( $dir .'/functions/gallery-metabox/gallery-metabox.php' );

/*--------------------------------------*/
/* Theme stuff
/*--------------------------------------*/
if ( is_admin() ) {
	if ( ! defined( 'WPEX_DISABLE_THEME_ABOUT_PAGE' ) ) {
		require_once( $dir .'/functions/dashboard-feed.php' );
	}
	if ( ! defined( 'WPEX_DISABLE_THEME_DASHBOARD_FEEDS' ) ) {
		require_once( $dir .'/functions/welcome.php' );
	}
}