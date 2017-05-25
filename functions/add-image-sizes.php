<?php
/**
 * Registers image sizes
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

function wpex_add_image_sizes() {

	add_image_size( 'wpex-home-slider', 1040, 400, true );
	add_image_size( 'wpex-blog-home-entry', 700, 350, true );

	add_image_size( 'wpex-entry', 700, 350, true );
	add_image_size( 'wpex-post', 700, 350, true );

	add_image_size( 'wpex-post-related', 700, 350, true );

	add_image_size( 'wpex-portfolio-entry', 700, 350, true );
	add_image_size( 'wpex-portfolio-post', 700, 350, true );
	add_image_size( 'wpex-portfolio-related', 700, 350, true );

	add_image_size( 'wpex-service-post', 700, 350, true );
	
}
add_action( 'after_setup_theme', 'wpex_add_image_sizes' );