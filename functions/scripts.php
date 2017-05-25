<?php
/**
 * Registers and enqueues theme scripts
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

function wpex_scripts() {

	// Directories
	$dir     = get_template_directory_uri();
	$css_dir = $dir .'/css/';
	$js_dir  = $dir .'/js/';
	
	// Main CSS
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'FontAwesome', $css_dir .'font-awesome.min.css', array(), '4.5.0' );
	wp_enqueue_style( 'prettyPhoto', $css_dir .'prettyPhoto.css', array(), '3.1.6' );
	wp_enqueue_style( 'wpex-responsive', $css_dir .'responsive.css', array(), '2.0' );

	// Threaded comments JS
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Slicknav
	wp_enqueue_script( 'slicknav', $js_dir .'jquery.slicknav.js', array( 'jquery' ), '2.1.2', true );

	// Flexslider
	wp_register_script( 'flexslider', $js_dir .'jquery.flexslider.js', array( 'jquery' ), '2.6.0', true );
	wp_register_script( 'wpex-slider-home', $js_dir .'slider-home.js', array( 'jquery', 'flexslider' ), '2.0', true );
	wp_localize_script( 'wpex-slider-home', 'flexLocalize', array(
		'slideshow'      => wpex_get_option( 'slides_slideshow', '0' ),
		'randomize'      => wpex_get_option( 'slides_randomize', '0' ),
		'slideshowSpeed' => wpex_get_option( 'slideshow_speed', '7000' ),
		'animationSpeed' => wpex_get_option( 'animation_speed', '600' )
	) );
	wp_register_script( 'wpex-slider-portfolio', $js_dir .'slider-portfolio.js', array( 'jquery', 'flexslider' ), '2.0', true );
	wp_register_script( 'wpex-slider-service', $js_dir .'slider-service.js', array( 'jquery', 'flexslider' ), '2.0', true );
		
	// Lightbox JS
	wp_enqueue_script( 'prettyPhoto', $js_dir .'jquery.prettyPhoto.js', array( 'jquery' ), '3.1.6', true );
	wp_enqueue_script( 'wpex-prettyPhoto-init', $js_dir .'prettyPhoto-init.js', array( 'jquery', 'prettyPhoto' ), '1.0', true );
	wp_localize_script( 'wpex-prettyPhoto-init', 'lightboxLocalize', array(
		'theme' => wpex_get_option( 'lightbox_theme' )
	) );
	
	// Core functions
	wp_enqueue_script( 'wpex-global', $js_dir .'global.js', array( 'jquery' ), '2.0', true );
	wp_localize_script( 'wpex-global', 'wpexvars', array(
		'mobileMenuLabel' => __( 'Menu', 'pytheas' ),
	) );
	
}
add_action( 'wp_enqueue_scripts', 'wpex_scripts' );