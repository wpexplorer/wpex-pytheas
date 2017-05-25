<?php
if ( ! class_exists( 'Symple_Services_Post_Type' ) ) :

	class Symple_Services_Post_Type {

		public function __construct() {

			// Adds the services post type and taxonomies
			add_action( 'init', array( &$this, 'services_init' ), 0 );

			// Thumbnail support for services posts
			add_theme_support( 'post-thumbnails', array( 'services' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-services_columns', array( &$this, 'services_edit_columns' ) );
			add_action( 'manage_services_posts_custom_column', array( &$this, 'services_column_display' ), 10, 2 );

			// Allows filtering of posts by taxonomy in the admin view
			add_action( 'restrict_manage_posts', array( &$this, 'services_add_taxonomy_filters' ) );
			
		}
		
		public function services_init() {
			$labels = array(
				'name' => __( 'Services', 'pytheas' ),
				'singular_name' => __( 'Services Item', 'pytheas' ),
				'add_new' => __( 'Add New Item', 'pytheas' ),
				'add_new_item' => __( 'Add New Services Item', 'pytheas' ),
				'edit_item' => __( 'Edit Services Item', 'pytheas' ),
				'new_item' => __( 'Add New Services Item', 'pytheas' ),
				'view_item' => __( 'View Item', 'pytheas' ),
				'search_items' => __( 'Search Services', 'pytheas' ),
				'not_found' => __( 'No services items found', 'pytheas' ),
				'not_found_in_trash' => __( 'No services items found in trash', 'pytheas' )
			);
			
			$args = array(
				'labels' => $labels,
				'public' => true,
				'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'revisions', 'post-formats' ),
				'capability_type' => 'post',
				'rewrite' => array("slug"	=> "services"), // Permalinks format
				'has_archive' => true,
				'menu_icon' => 'dashicons-hammer',
			); 
			
			$args = apply_filters('symple_services_args', $args);
			
			register_post_type( 'services', $args );

			/**
			 * Register a taxonomy for Services Tags
			 * http://codex.wordpress.org/Function_Reference/register_taxonomy
			 */

			$taxonomy_services_tag_labels = array(
				'name' => __( 'Services Tags', 'pytheas' ),
				'singular_name' => __( 'Services Tag', 'pytheas' ),
				'search_items' => __( 'Search Services Tags', 'pytheas' ),
				'popular_items' => __( 'Popular Services Tags', 'pytheas' ),
				'all_items' => __( 'All Services Tags', 'pytheas' ),
				'parent_item' => __( 'Parent Services Tag', 'pytheas' ),
				'parent_item_colon' => __( 'Parent Services Tag:', 'pytheas' ),
				'edit_item' => __( 'Edit Services Tag', 'pytheas' ),
				'update_item' => __( 'Update Services Tag', 'pytheas' ),
				'add_new_item' => __( 'Add New Services Tag', 'pytheas' ),
				'new_item_name' => __( 'New Services Tag Name', 'pytheas' ),
				'separate_items_with_commas' => __( 'Separate services tags with commas', 'pytheas' ),
				'add_or_remove_items' => __( 'Add or remove services tags', 'pytheas' ),
				'choose_from_most_used' => __( 'Choose from the most used services tags', 'pytheas' ),
				'menu_name' => __( 'Services Tags', 'pytheas' )
			);

			$taxonomy_services_tag_args = array(
				'labels' => $taxonomy_services_tag_labels,
				'public' => true,
				'show_in_nav_menus'	=> true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'hierarchical' => false,
				'rewrite' => array( 'slug' => 'services-tag' ),
				'query_var' => true
			);

			$taxonomy_services_tag_args = apply_filters('symple_taxonomy_services_tag_args', $taxonomy_services_tag_args);
			
			register_taxonomy( 'services_tag', array( 'services' ), $taxonomy_services_tag_args );

			/**
			 * Register a taxonomy for Services Categories
			 * http://codex.wordpress.org/Function_Reference/register_taxonomy
			 */

			$taxonomy_services_category_labels = array(
				'name' => __( 'Services Categories', 'pytheas' ),
				'singular_name' => __( 'Services Category', 'pytheas' ),
				'search_items' => __( 'Search Services Categories', 'pytheas' ),
				'popular_items' => __( 'Popular Services Categories', 'pytheas' ),
				'all_items' => __( 'All Services Categories', 'pytheas' ),
				'parent_item' => __( 'Parent Services Category', 'pytheas' ),
				'parent_item_colon' => __( 'Parent Services Category:', 'pytheas' ),
				'edit_item' => __( 'Edit Services Category', 'pytheas' ),
				'update_item' => __( 'Update Services Category', 'pytheas' ),
				'add_new_item' => __( 'Add New Services Category', 'pytheas' ),
				'new_item_name' => __( 'New Services Category Name', 'pytheas' ),
				'separate_items_with_commas' => __( 'Separate services categories with commas', 'pytheas' ),
				'add_or_remove_items' => __( 'Add or remove services categories', 'pytheas' ),
				'choose_from_most_used' => __( 'Choose from the most used services categories', 'pytheas' ),
				'menu_name' => __( 'Services Categories', 'pytheas' ),
			);

			$taxonomy_services_category_args = array(
				'labels' => $taxonomy_services_category_labels,
				'public' => true,
				'show_in_nav_menus'	=> true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'hierarchical' => true,
				'rewrite' => array( 'slug'	=> 'services-category' ),
				'query_var' => true
			);

			$taxonomy_services_category_args = apply_filters('symple_taxonomy_services_category_args', $taxonomy_services_category_args);
			
			register_taxonomy( 'services_category', array( 'services' ), $taxonomy_services_category_args );

		}

		/**
		 * Add Columns to Services Edit Screen
		 * http://wptheming.com/2010/07/column-edit-pages/
		 */

		public function services_edit_columns( $columns ) {
			$columns['services_category'] = __( 'Category', 'pytheas' );
			$columns['services_tag'] = __( 'Tags', 'pytheas' );
			return $columns;
		}

		public function services_column_display( $column, $post_id ) {

			// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview

			switch ( $column ) {

				// Display the services tags in the column view
				case "services_category":

				if ( $category_list = get_the_term_list( $post_id, 'services_category', '', ', ', '' ) ) {
					echo $category_list;
				} else {
					echo __('None', 'pytheas');
				}
				break;	

				// Display the services tags in the column view
				case "services_tag":

				if ( $tag_list = get_the_term_list( $post_id, 'services_tag', '', ', ', '' ) ) {
					echo $tag_list;
				} else {
					echo __('None', 'pytheas');
				}
				break;			
			}
		}

		public function services_add_taxonomy_filters() {
			global $typenow;

			// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
			$taxonomies = array( 'services_category', 'services_tag' );

			// must set this to the post type you want the filter(s) displayed on
			if ( $typenow == 'services' ) {

				foreach ( $taxonomies as $tax_slug ) {
					$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
					$tax_obj = get_taxonomy( $tax_slug );
					$tax_name = $tax_obj->labels->name;
					$terms = get_terms($tax_slug);
					if ( count( $terms ) > 0) {
						echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
						echo "<option value=''>$tax_name</option>";
						foreach ( $terms as $term ) {
							echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
						}
						echo "</select>";
					}
				}
			}
		}

	}

	new Symple_Services_Post_Type;

endif;