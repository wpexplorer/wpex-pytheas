<?php
if ( ! class_exists( 'Symple_Portfolio_Post_Type' ) ) :
	class Symple_Portfolio_Post_Type {

		public function __construct() {

			// Adds the portfolio post type and taxonomies
			add_action( 'init', array( &$this, 'portfolio_init' ), 0 );

			// Thumbnail support for portfolio posts
			add_theme_support( 'post-thumbnails', array( 'portfolio' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-portfolio_columns', array( &$this, 'portfolio_edit_columns' ) );
			add_action( 'manage_portfolio_posts_custom_column', array( &$this, 'portfolio_column_display' ), 10, 2 );

			// Allows filtering of posts by taxonomy in the admin view
			add_action( 'restrict_manage_posts', array( &$this, 'portfolio_add_taxonomy_filters' ) );

		}

		public function portfolio_init() {
			$labels = array(
				'name'					=> __( 'Portfolio', 'pytheas' ),
				'singular_name'			=> __( 'Portfolio Item', 'pytheas' ),
				'add_new'				=> __( 'Add New Item', 'pytheas' ),
				'add_new_item'			=> __( 'Add New Portfolio Item', 'pytheas' ),
				'edit_item'				=> __( 'Edit Portfolio Item', 'pytheas' ),
				'new_item'				=> __( 'Add New Portfolio Item', 'pytheas' ),
				'view_item'				=> __( 'View Item', 'pytheas' ),
				'search_items'			=> __( 'Search Portfolio', 'pytheas' ),
				'not_found'				=> __( 'No portfolio items found', 'pytheas' ),
				'not_found_in_trash'	=> __( 'No portfolio items found in trash', 'pytheas' )
			);
			
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'supports'			=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields', 'revisions', 'post-formats' ),
				'capability_type'	=> 'post',
				'rewrite'			=> array( "slug" => "portfolio" ), // Permalinks format
				'has_archive'		=> true,
				'menu_icon'			=> 'dashicons-portfolio',
			); 
			
			$args = apply_filters('symple_portfolio_args', $args);
			
			register_post_type( 'portfolio', $args );

			$taxonomy_portfolio_tag_labels = array(
				'name'							=> __( 'Portfolio Tags', 'pytheas' ),
				'singular_name'					=> __( 'Portfolio Tag', 'pytheas' ),
				'search_items'					=> __( 'Search Portfolio Tags', 'pytheas' ),
				'popular_items'					=> __( 'Popular Portfolio Tags', 'pytheas' ),
				'all_items'						=> __( 'All Portfolio Tags', 'pytheas' ),
				'parent_item'					=> __( 'Parent Portfolio Tag', 'pytheas' ),
				'parent_item_colon'				=> __( 'Parent Portfolio Tag:', 'pytheas' ),
				'edit_item'						=> __( 'Edit Portfolio Tag', 'pytheas' ),
				'update_item'					=> __( 'Update Portfolio Tag', 'pytheas' ),
				'add_new_item'					=> __( 'Add New Portfolio Tag', 'pytheas' ),
				'new_item_name'					=> __( 'New Portfolio Tag Name', 'pytheas' ),
				'separate_items_with_commas'	=> __( 'Separate portfolio tags with commas', 'pytheas' ),
				'add_or_remove_items'			=> __( 'Add or remove portfolio tags', 'pytheas' ),
				'choose_from_most_used'			=> __( 'Choose from the most used portfolio tags', 'pytheas' ),
				'menu_name'						=> __( 'Portfolio Tags', 'pytheas' )
			);

			$taxonomy_portfolio_tag_args = array(
				'labels'				=> $taxonomy_portfolio_tag_labels,
				'public'				=> true,
				'show_in_nav_menus'		=> true,
				'show_ui'				=> true,
				'show_tagcloud'			=> true,
				'hierarchical'			=> false,
				'rewrite'				=> array( 'slug'	=> 'portfolio-tag' ),
				'query_var'				=> true
			);

			$taxonomy_portfolio_tag_args = apply_filters('symple_taxonomy_portfolio_tag_args', $taxonomy_portfolio_tag_args);
			
			register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $taxonomy_portfolio_tag_args );

			$taxonomy_portfolio_category_labels = array(
				'name'							=> __( 'Portfolio Categories', 'pytheas' ),
				'singular_name'					> __( 'Portfolio Category', 'pytheas' ),
				'search_items'					=> __( 'Search Portfolio Categories', 'pytheas' ),
				'popular_items'					=> __( 'Popular Portfolio Categories', 'pytheas' ),
				'all_items'						=> __( 'All Portfolio Categories', 'pytheas' ),
				'parent_item'					=> __( 'Parent Portfolio Category', 'pytheas' ),
				'parent_item_colon'				=> __( 'Parent Portfolio Category:', 'pytheas' ),
				'edit_item'						=> __( 'Edit Portfolio Category', 'pytheas' ),
				'update_item'					=> __( 'Update Portfolio Category', 'pytheas' ),
				'add_new_item'					=> __( 'Add New Portfolio Category', 'pytheas' ),
				'new_item_name'					=> __( 'New Portfolio Category Name', 'pytheas' ),
				'separate_items_with_commas'	=> __( 'Separate portfolio categories with commas', 'pytheas' ),
				'add_or_remove_items'			=> __( 'Add or remove portfolio categories', 'pytheas' ),
				'choose_from_most_used'			=> __( 'Choose from the most used portfolio categories', 'pytheas' ),
				'menu_name'						=> __( 'Portfolio Categories', 'pytheas' ),
			);

			$taxonomy_portfolio_category_args = array(
				'labels'				=> $taxonomy_portfolio_category_labels,
				'public'				=> true,
				'show_in_nav_menus'		=> true,
				'show_ui'				=> true,
				'show_tagcloud'			=> true,
				'hierarchical'			=> true,
				'rewrite'				=> array( 'slug'	=> 'portfolio-category' ),
				'query_var'				=> true,
			);

			$taxonomy_portfolio_category_args = apply_filters('symple_taxonomy_portfolio_category_args', $taxonomy_portfolio_category_args);
			
			register_taxonomy( 'portfolio_category', array( 'portfolio' ), $taxonomy_portfolio_category_args );

		}

		public function portfolio_edit_columns( $columns ) {
			$columns['portfolio_category'] = __( 'Category', 'pytheas' );
			$columns['portfolio_tag'] = __( 'Tags', 'pytheas' );
			return $columns;
		}

		public function portfolio_column_display( $column, $post_id ) {

			// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview

			switch ( $column ) {

				// Display the thumbnail in the column view
				case "portfolio_thumbnail":
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

				// Display the portfolio tags in the column view
				case "portfolio_category":

				if ( $category_list = get_the_term_list( $post_id, 'portfolio_category', '', ', ', '' ) ) {
					echo $category_list;
				} else {
					echo __('None', 'pytheas');
				}
				break;	

				// Display the portfolio tags in the column view
				case "portfolio_tag":

				if ( $tag_list = get_the_term_list( $post_id, 'portfolio_tag', '', ', ', '' ) ) {
					echo $tag_list;
				} else {
					echo __('None', 'pytheas');
				}
				break;
			}
		}

		public function portfolio_add_taxonomy_filters() {
			global $typenow;

			// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
			$taxonomies = array( 'portfolio_category', 'portfolio_tag' );

			// must set this to the post type you want the filter(s) displayed on
			if ( $typenow == 'portfolio' ) {

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

	new Symple_Portfolio_Post_Type;

endif;