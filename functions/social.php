<?php
/**
 * Array of social sites and HTML output
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     2.0.0
 */

// Create Social Array
if ( ! function_exists( 'wpex_social_links' ) ) {
	function wpex_social_links() {
		$social_icons = array('twitter','google','facebook','linkedin','flickr','pinterest','github','behance','dribbble','forrst','youtube','vimeo','skype','paypal','envato','gowalla','icloud','evernote','quora','wordpress','rss');
		return apply_filters('wpex_social_links', $social_icons);
	}
}

// Display Social Icons
if ( ! function_exists( 'wpex_display_social' ) ) {
	function wpex_display_social() {
		$wpex_social_links = wpex_social_links();
		if ( !$wpex_social_links ) return;
		$output = '<ul id="social" class="clr">';
				foreach ( $wpex_social_links as $social_link ) {
					if ( $url = wpex_get_option( $social_link ) ) {
						$output .= '<li><a href="'. esc_url( $url ) .'" title="'. esc_attr( $social_link ) .'" target="_blank"><img src="'. get_template_directory_uri() .'/images/social/'. esc_attr( $social_link ) .'.png" alt="'. esc_attr( $social_link ) .'" /></a></li>';
					}
				}
		$output .= '</ul><!-- #social -->';
		echo apply_filters( 'wpex_display_social', $output );
	}
}