<?php
/**
 * @package WordPress
 * @subpackage Pytheas WordPress Theme
 * This file registers the theme's widget regions
 */


register_sidebar( array (
	'name' => __( 'Sidebar','pytheas'),
	'id' => 'sidebar',
	'description' => __( 'Widgets in this area are used in the default sidebar.','pytheas' ),
	'before_widget' => '<div class="sidebar-box %2$s clr">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading widget-title"><span>',
	'after_title' => '</span></h4>',
) );


if( wpex_get_option('widgetized_footer') ) {
	
	register_sidebar( array (
		'name' => __( 'Footer 1','pytheas'),
		'id' => 'footer-one',
		'description' => __( 'Widgets in this area are used in the first footer column','pytheas' ),
		'before_widget' => '<div class="footer-widget %2$s clr">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	
	register_sidebar( array (
		'name' => __( 'Footer 2','pytheas'),
		'id' => 'footer-two',
		'description' => __( 'Widgets in this area are used in the second footer column','pytheas' ),
		'before_widget' => '<div class="footer-widget %2$s clr">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>'
	) );
	
	register_sidebar( array (
		'name' => __( 'Footer 3','pytheas'),
		'id' => 'footer-three',
		'description' => __( 'Widgets in this area are used in the third footer column','pytheas' ),
		'before_widget' => '<div class="footer-widget %2$s clr">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	
	register_sidebar( array (
		'name' => __( 'Footer 4','pytheas'),
		'id' => 'footer-four',
		'description' => __( 'Widgets in this area are used in the fourth footer column','pytheas' ),
		'before_widget' => '<div class="footer-widget %2$s clr">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	
}