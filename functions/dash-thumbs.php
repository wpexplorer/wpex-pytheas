<?php
/**
 * Create Custom Columns for the WP dashboard
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     2.0
 */

function wpex_posts_columns($defaults){
    $defaults['wpex_post_thumbs'] = __( 'Thumbnail', 'pytheas' );
    return $defaults;
}
add_filter( 'manage_posts_columns', 'wpex_posts_columns', 10);

function wpex_posts_custom_columns( $column_name, $id ){
    if ( $column_name != 'wpex_post_thumbs' ) {
        return;	
	}
	$thumbnail_id = get_post_meta( get_the_ID(), '_thumbnail_id', true );
	if ( has_post_thumbnail( $id ) ) {
		$width = (int) 80;
		$height = (int) 80;
		echo wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
	} else {
		return;
	}
}
add_action( 'manage_posts_custom_column', 'wpex_posts_custom_columns', 10, 2);