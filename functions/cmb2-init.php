<?php
// Include meta class
require_once( get_template_directory() .'/functions/CMB2/init.php' );

// Add meta
function wpex_metaboxes() {
	$prefix = 'wpex_';

	// Slides
	$slides_meta = new_cmb2_box( array(
		'id'            => 'wpex-slide-meta',
		'title'         => __( 'Slide Settings', 'pytheas' ),
		'object_types'  => array( 'slides' ),
		'context'       => 'normal',
		'priority'      => 'high',
	) );

	$slides_meta->add_field( array(
		'name'	=> __( 'oEmbed Video URL', 'pytheas' ),
		'id'	=> $prefix . 'slides_video',
		'std'	=> '',
		'type'	=> 'text_url',
	) );

	$slides_meta->add_field( array(
		'name'	=> __( 'Link URL', 'pytheas' ),
		'id'	=> $prefix . 'slides_url',
		'std'	=> '',
		'type'	=> 'text_url',
	) );

	$slides_meta->add_field( array(
		'name'	=> __( 'Link Target', 'pytheas' ),
		'id'	=> $prefix . 'slides_url_target',
		'std'	=> '',
		'type'	=> 'select',
		'options' => array(
			'self' => 'self',
			'blank' => 'blank'
		)
	) );

	// Services
	$service_meta = new_cmb2_box( array(
		'id'            => 'wpex-service-meta',
		'title'         => __( 'Services Settings', 'pytheas' ),
		'object_types'  => array( 'services' ),
		'context'       => 'normal',
		'priority'      => 'high',
	) );

	$service_meta->add_field( array(
		'name'	  => __( 'Icon', 'pytheas' ),
		'id'	  => $prefix . 'services_icon',
		'std'	  => '',
		'type'	  => 'select',
		'options' => wpex_get_awesome_icons(),
	) );

}
add_filter( 'cmb2_admin_init', 'wpex_metaboxes' );