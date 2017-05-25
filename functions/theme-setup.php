<?php
/**
 * Lets setup our theme!
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

function wpex_theme_setup() {

	// Width
	if ( ! isset( $content_width ) ) $content_width = 650;
	
	// Localization support
	load_theme_textdomain( 'pytheas', get_template_directory() .'/languages' );

	// Register navigation menus
	register_nav_menus ( array(
		'main_menu'   => __( 'Main', 'pytheas' ),
		'footer_menu' => __( 'Footer', 'pytheas' )
	) );
		
	// Add theme support
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );

	//custom header
	add_theme_support( 'custom-header', array(
		'default-image' => '',
		'random-default' => false,
		'width' => '1040',
		'height' => 150,
		'flex-height' => true,
		'flex-width' => false,
		'default-text-color' => '',
		'header-text' => true,
		'uploads' => true,
		'wp-head-callback' => '',
		'admin-head-callback' => '',
		'admin-preview-callback' => '',
	) );

}
add_action( 'after_setup_theme', 'wpex_theme_setup' );