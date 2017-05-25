<?php
if ( ! class_exists( 'Symple_Slides_Post_Type' ) ) :
	class Symple_Slides_Post_Type {

		public function __construct() {

			// Adds the slides post type and taxonomies
			add_action( 'init', array( &$this, 'slides_init' ), 0 );

			// Thumbnail support for slides posts
			add_theme_support( 'post-thumbnails', array( 'slides' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-slides_columns', array( &$this, 'slides_edit_columns' ) );
			add_action( 'manage_posts_custom_column', array( &$this, 'slides_column_display' ), 10, 2 );
			
		}
		
		public function slides_init() {

			$labels = array(
				'name' => __( 'Slides', 'pytheas' ),
				'singular_name' => __( 'Slides Item', 'pytheas' ),
				'add_new' => __( 'Add New Item', 'pytheas' ),
				'add_new_item' => __( 'Add New Slides Item', 'pytheas' ),
				'edit_item' => __( 'Edit Slides Item', 'pytheas' ),
				'new_item' => __( 'Add New Slides Item', 'pytheas' ),
				'view_item' => __( 'View Item', 'pytheas' ),
				'search_items' => __( 'Search Slides', 'pytheas' ),
				'not_found' => __( 'No slides items found', 'pytheas' ),
				'not_found_in_trash' => __( 'No slides items found in trash', 'pytheas' )
			);
			
			$args = array(
				'labels' => $labels,
				'public' => true,
				'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
				'capability_type' => 'post',
				'rewrite' => array("slug" => "slides"), // Permalinks format
				'has_archive' => false,
				'menu_icon' => 'dashicons-images-alt2',
			); 
			
			$args = apply_filters('symple_slides_args', $args);
			
			register_post_type( 'slides', $args );
		}

		public function slides_edit_columns( $slides_columns ) {
			$slides_columns = array(
				"cb" => "<input type=\"checkbox\" />",
				"title" => __('Title', 'column name'),
				"slides_thumbnail" => __('Thumbnail', 'pytheas')
			);
			return $slides_columns;
		}

		public function slides_column_display( $slides_columns, $post_id ) {
			
			switch ( $slides_columns ) {

				// Display the thumbnail in the column view
				case "slides_thumbnail":
					$width = (int) 80;
					$height = (int) 80;
					$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

					// Display the featured image in the column view if possible
					if ( $thumbnail_id ) {
						$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
					}
					if ( isset( $thumb ) ) {
						echo $thumb;
					} else {
						echo __('None', 'pytheas');
					}
					break;
				
			}
		}

	}

	new Symple_Slides_Post_Type;

endif;