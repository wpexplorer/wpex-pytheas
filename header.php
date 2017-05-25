<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
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
} ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script><![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<!--[if IE 8]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" media="screen"><![endif]-->
</head>

<body <?php body_class(); ?>>

	<div id="wrap" class="container clr">

		<?php
		// Define some vars
		$home_url  = home_url( '/' );
		$blog_name = get_bloginfo( 'name', 'display' ); ?>

		<header id="masthead" class="site-header clr" role="banner">

			<div class="logo">

				<?php if ( $logo = wpex_get_option( 'custom_logo' ) ) : ?>

					<a href="<?php echo esc_url( $home_url ); ?>" title="<?php echo esc_attr( $blog_name ); ?>" rel="home"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $blog_name ); ?>" /></a>

				<?php else : ?>

					<?php if ( is_front_page() ) : ?>
						<h1><a href="<?php echo esc_url( $home_url ); ?>" title="<?php echo esc_attr( $blog_name ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<h2><a href="<?php echo esc_url( $home_url ); ?>" title="<?php echo esc_attr( $blog_name ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a></h2>
					<?php endif; ?>

					<?php if ( $description = get_bloginfo('description') ) : ?>
						<?php echo '<p class="site-description">'. wp_kses_post( $description ) .'</p>'; ?>
					<?php endif; ?>

				<?php endif; ?>

			</div><!-- .logo -->

			<div class="masthead-right">

				<?php if ( $aside = wpex_get_option( 'masterhead_right', '<span class="fa fa-phone"></i>Call us: 999-99-99' ) ) : ?>
					<div class="masthead-right-content"><?php echo wp_kses_post( $aside ); ?></div>
				<?php endif; ?>

				<?php if ( wpex_get_option( 'masthead_search', '1' ) ) : ?>

					<div class="masthead-search clr">
						<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( $home_url ); ?>" role="search">
							<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php _e( 'Search', 'pytheas' ); ?>&hellip;" />
							<button type="submit" class="submit" id="searchsubmit"><span class="fa fa-search"></span></button>
						</form>
					</div><!-- /masthead-search -->

				<?php endif; ?>

			</div><!-- .masthead-right -->

		</header><!-- .header -->

		<?php
		// Show header image
		if ( get_header_image()
			&& is_front_page()
			&& ! wpex_get_option( 'headerimg_front_page_exclude', '1' )
		) : ?>
			<img src="<?php header_image(); ?>" alt="<?php get_bloginfo( 'name' ); ?>" id="header-image" />
		<?php endif; ?>

		<div id="navbar" class="navbar clr">

			<nav id="site-navigation" class="navigation main-navigation clr" role="navigation">
				<?php wp_nav_menu( array(
					'theme_location' => 'main_menu',
					'sort_column'    => 'menu_order',
					'menu_class'     => 'nav-menu dropdown-menu',
					'fallback_cb'    => false,
					'walker'         => new WPEX_Dropdown_Walker_Nav_Menu()
				) ); ?>
			</nav><!-- #site-navigation -->

			<?php if ( wpex_get_option( 'social','1' ) ) : ?>
				<?php wpex_display_social(); ?>
			<?php endif; ?>

		</div><!-- #navbar -->
		
	<div id="main" class="site-main row clr fitvids">

		<?php if ( is_singular( 'page' ) && has_post_thumbnail() ) : ?>
			<div id="page-featured-img"><?php the_post_thumbnail(); ?></div>
		<?php endif; ?>

		<?php if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() && ! is_404() ) : ?>
			<?php yoast_breadcrumb('<nav id="breadcrumbs">','</nav>'); ?>
		<?php endif; ?>