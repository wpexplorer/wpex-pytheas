<?php
/**
 * Adds custom CSS to the site header
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

function wpex_header_css() {

	$custom_css = '';

	// Remove background image
	$disable_background_image = wpex_get_option( 'disable_background_image' );
	if ( '1' == $disable_background_image ) {
		$custom_css .= 'body { background-image: none;';
	}

	// output css on front end
	if ( $custom_css ) {
		echo "<!-- Header CSS -->\n<style type=\"text/css\">\n" . $custom_css . "\n</style>";
	}
	
}
add_action('wp_head', 'wpex_header_css');