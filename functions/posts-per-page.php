<?php
/**
 * This file filters the default WP pagination where needed
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

function wpex_pre_get_posts( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {

		if ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) || is_post_type_archive( 'portfolio' ) ) {
			$count = intval( wpex_get_option('portfolio_pagination', '12' ) );
			$count = $count ? $count : 12;
			$query->set( 'posts_per_page', $count );
		}

		if ( is_tax('services_category') || is_tax('services_tag') || is_post_type_archive('services') ) {
			$count = intval( wpex_get_option('services_pagination', '12' ) );
			$count = $count ? $count : 12;
			$query->set( 'posts_per_page', $count );
		}

		if ( is_search() ) {
			$query->set( 'posts_per_page', 10 );
		}

	}

}
add_filter( 'pre_get_posts', 'wpex_pre_get_posts' );