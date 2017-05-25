<?php
/**
 * Customizer settings
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

// Options name to use in database
function wpex_options_db_name() {
	return apply_filters( 'wpex_options_db_name', 'options_wpex_themes' );
}

// Get options function
if ( ! function_exists( 'wpex_get_option' ) ) {
	function wpex_get_option( $name, $default = false ) {

		$option_name = '';

		// Gets option name as defined in the theme
		if ( wpex_options_db_name() ) {
			$option_name = wpex_options_db_name();
		}

		// Fallback option name
		if ( ! $option_name ) {
			$option_name = get_option( 'stylesheet' );
			$option_name = preg_replace( "/\W/", "_", strtolower( $option_name ) );
		}

		// Get option settings from database
		$options = get_option( $option_name );

		// Return specific option
		if ( isset( $options[$name] ) ) {
			return $options[$name];
		} else {
			return $default;
		}
		
	}
}

// Array of options to register
function wpex_options_array() {

	//prettyPhoto themes
	$lightbox_themes = array(
		'pp_default' => __( 'Default','pytheas' ),
		'light_rounded' => __( 'Light Rounded','pytheas' ),
		'dark_rounded' => __( 'Dark Rounded','pytheas' ),
		'light_square' => __( 'Light Square','pytheas' ),
		'dark_square' => __( 'Dark Square','pytheas' ),
		'facebook' => __( 'Facebook','pytheas' ),
	);

	// Begin options array
	$options = array();
	
	//GENERAL
	$options['general'] = array(
		'name' => __( 'General', 'pytheas' ),
		'type' => 'heading'
	);
		
	$options['custom_logo'] = array(
		'name' => __( 'Custom Logo', 'pytheas' ),
		'desc' => __( 'Upload your custom logo.', 'pytheas' ),
		'id' => 'custom_logo',
		'type' => 'upload',
		'section' => 'general',
	);
			
	$options['headerimg_front_page_exclude'] = array(
		'name' => __( 'Exclude Header Image From Homepage?', 'pytheas' ),
		'desc' => __( 'Check box to exclude the header image from the homepage.', 'pytheas' ),
		'id' => 'headerimg_front_page_exclude',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'general',
	);

	$options['disable_background_image'] = array(
		'name' => __( 'Disable the background image?', 'pytheas' ),
		'desc' => __( 'Check box to disable the main background image.', 'pytheas' ),
		'id' => 'disable_background_image',
		'std' => '',
		'type' => 'checkbox',
		'section' => 'general',
	);
		
	$options['widgetized_footer'] = array(
		'name' => __( 'Widgetized Footer?', 'pytheas' ),
		'desc' => __( 'Check box to enable the widgetized footer area.', 'pytheas' ),
		'id' => 'widgetized_footer',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'general',
	);
		
	$options['lightbox_theme'] = array(
		'name' => __( 'PrettyPhoto Theme', 'pytheas' ),
		'desc' => __( 'Choose your PrettyPhoto theme.', 'pytheas' ),
		'id' => 'lightbox_theme',
		'std' => 'default',
		'type' => 'select',
		'options' => $lightbox_themes,
		'section' => 'general',
	);
	
	$options['masterhead_right'] = array(
		'name' => __( 'Header Right Content', 'pytheas' ),
		'desc' => __( 'Enter your custom content for the header top right section above the searchbox.', 'pytheas' ),
		'id' => 'masterhead_right',
		'std' => '<i class="icon-phone"></i>Call us: 999-99-99',
		'type' => 'textarea',
		'section' => 'general',
	);
		
	$options['custom_copyright'] = array(
		'name' => __( 'Custom Copyright', 'pytheas' ),
		'desc' => __( 'Enter your custom copyright infor for the footer.', 'pytheas' ),
		'id' => 'custom_copyright',
		'std' => '<a href="http://wordpress.org" title="WordPress">WordPress</a>'. __( 'Theme by','pytheas' ) .'<a href="http://wpexplorer.me" title="WPExplorer">WPExplorer</a>',
		'type' => 'textarea',
		'section' => 'general',
	);

	//SOCIAL
	if ( function_exists( 'wpex_social_links' ) ) {
		
		$options['header_social'] = array(
			'name' => __( 'Social', 'pytheas' ),
			'type' => 'heading'
		);
			
		$options['social'] = array(
			'name' => __( 'Social?', 'pytheas' ),
			'desc' => __( 'Check box to enable the social section in the main menu.', 'pytheas' ),
			'id' => 'social',
			'std' => '1',
			'type' => 'checkbox',
			'section' => 'header_social',
		);
		
		$social_links = wpex_social_links();
		foreach( $social_links as $social_link ) {
			$options[$social_link] = array( "name" => ucfirst($social_link),
				'desc' => ' '. __( 'Enter your ','pytheas' ) . $social_link . __( ' url','pytheas' ) .' <br />'. __( 'Include http:// at the front of the url.', 'pytheas' ),
				'id' => $social_link,
				'std' => '',
				'type' => 'text',
				'section' => 'header_social',
			);
		}
	}
		
	
	//HOMEPAGE	
	$options['home'] = array(
		'name' => __( 'Homepage', 'pytheas' ),
		'type' => 'heading'
	);

	$options['home_tagline'] = array(
		'name' => __( 'Homepage Tagline', 'pytheas' ),
		'desc' => '',
		'id' => 'home_tagline',
		'std' => __( 'Homepage Tagline Sample','pytheas' ),
		'type' => 'textarea',
		'section' => 'home',
	);

	$options['home_services'] = array(
		'name' => __( 'Show Services?', 'pytheas' ),
		'id' => 'home_services',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'home',
	);
		
	$options['home_services_title'] = array(
		'name' => __( 'Homepage Services Title', 'pytheas' ),
		'id' => 'home_services_title',
		'std' => __( 'What We Do','pytheas' ),
		'class' => 'mini',
		'type' => 'text',
		'section' => 'home',
	);
		
	$options['home_services_count'] = array(
		'name' => __( 'How Many Services Posts', 'pytheas' ),
		'id' => 'home_services_count',
		'std' => '6',
		'type' => 'text',
		'section' => 'home',
	);
		
	$options['home_portfolio'] = array(
		'name' => __( 'Show Recent Work?', 'pytheas' ),
		'id' => 'home_portfolio',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'home',
	);

	$options['home_portfolio_title'] = array(
		'name' => __( 'Recent Work Title', 'pytheas' ),
		'id' => 'home_portfolio_title',
		'std' => __( 'Recent Work','pytheas' ),
		'type' => 'text',
		'section' => 'home',
	);
		
	$options['home_portfolio_count'] = array(
		'name' => __( 'Home Many Portfolio Posts?', 'pytheas' ),
		'id' => 'home_portfolio_count',
		'std' => __( '4','pytheas' ),
		'type' => 'text',
		'section' => 'home',
	);
		
	$options['home_blog'] = array(
		'name' => __( 'Show Recent Blog Posts?', 'pytheas' ),
		'id' => 'home_blog',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'home',
	);
		
	$options['home_blog_title'] = array(
		'name' => __( 'Recent Blog Posts Title', 'pytheas' ),
		'id' => 'home_blog_title',
		'std' => __( 'Recent News','pytheas' ),
		'class' => 'mini',
		'type' => 'text',
		'section' => 'home',
	);
		
	$options['home_blog_count'] = array(
		'name' => __( 'Home Many Blog Posts?', 'pytheas' ),
		'id' => 'home_blog_count',
		'std' => __( '4','pytheas' ),
		'class' => 'mini',
		'type' => 'text',
		'section' => 'home',
	);

	// Slider
	$options['slides'] = array(
		'name' => __( 'Homepage Slider', 'pytheas' ),
		'type' => 'heading' );
			
		if ( class_exists( 'Symple_Slides_Post_Type' ) ) {
				
			$options['slides_slideshow'] = array(
				"name" => __( 'Auto Slideshow', 'pytheas' ),
				"desc" => __( 'Check this box to enable automatic slideshow for your slides.', 'pytheas' ),
				"id" => "slides_slideshow",
				"std" => "true",
				"type" => "select",
				"options" => array(
					'true' => 'true',
					'false' => 'false'
				),
				'section' => 'slides',
			);
				
			$options['slides_randomize'] = array(
				"name" => __( 'Randomize', 'pytheas' ),
				"desc" => __( 'Check this box to enable the randomize feature for your slides.', 'pytheas' ),
				"id" => "slides_randomize",
				"std" => "false",
				"type" => "select",
				"options" => array(
					'true' => 'true',
					'false' => 'false'
				),
				'section' => 'slides',
			);

			$options['slideshow_speed'] = array(
				"name" => __( 'SlideShow Speed', 'pytheas' ),
				"desc" => __( 'Enter your preferred slideshow speed in milliseconds.', 'pytheas' ),
				"id" => "slideshow_speed",
				"std" => "7000",
				"type" => "text",
				'section' => 'slides',
			);
				
			$options['animation_speed'] = array(
				"name" => __( 'Animation Speed', 'pytheas' ),
				"desc" => __( 'Enter your preferred animation speed in milliseconds.', 'pytheas' ),
				"id" => "animation_speed",
				"std" => "600",
				"type" => "text",
				'section' => 'slides',
			);
		}
			
		$options['slides_alt'] = array(
				"name" => __( 'Slider Alternative', 'pytheas' ),
				"desc" => __( 'If you prefer to use another slider you can enter the <strong>shortcode</strong> here.', 'pytheas' ),
				"id" => "slides_alt",
				"std" => "",
				"type" => "textarea",
				'section' => 'slides',
			);

	// Portfolio	
	$options['portfolio'] = array(
		'name' => __( 'Portfolio', 'pytheas' ),
		'type' => 'heading'
	);
		
	$options['portfolio_pagination'] = array(
		'name' => __( 'Portfolio Posts Per Page', 'pytheas' ),
		'id' => 'portfolio_pagination',
		'std' => '12',
		'type' => 'text',
		'section' => 'portfolio',
	);

	$options['portfolio_post_meta'] = array(
		'name' => __( 'Portfolio Post Meta', 'pytheas' ),
		'id' => 'portfolio_post_meta',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'portfolio',
	);

	$options['portfolio_post_tags'] = array(
		'name' => __( 'Portfolio Post Tags', 'pytheas' ),
		'id' => 'portfolio_post_tags',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'portfolio',
	);

	$options['portfolio_related'] = array(
		'name' => __( 'Portfolio Related', 'pytheas' ),
		'id' => 'portfolio_related',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'portfolio',
	);

	$options['portfolio_comments'] = array(
		'name' => __( 'Portfolio Comments', 'pytheas' ),
		'id' => 'portfolio_comments',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'portfolio',
	);

	// SERVICES	
	$options['services'] = array(
		'name' => __( 'Services', 'pytheas' ),
		'type' => 'heading'
	);
		
	$options['services_pagination'] = array(
		'name' => __( 'Services Posts Per Page', 'pytheas' ),
		'id' => 'services_pagination',
		'std' => '12',
		'type' => 'text',
		'section' => 'services',
	);

	$options['services_comments'] = array(
		'name' => __( 'Services Comments', 'pytheas' ),
		'id' => 'services_comments',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'services',
	);
		
	//BLOG	
	$options['blog'] = array(
		'name' => __( 'Blog', 'pytheas' ),
		'type' => 'heading'
	);
		
	$options['blog_excerpt'] = array(
		'name' => __( 'Entry Excerpts?', 'pytheas' ),
		'desc' => __( 'Check box to show excerpts rather then full posts on standard entries.', 'pytheas' ),
		'id' => 'blog_excerpt',
		'std' => '1',
		'type' =>'checkbox',
		'section' => 'blog',
	);

	$options['blog_single_thumbnail'] = array(
		'name' => __( 'Featured Images On Single Posts?', 'pytheas' ),
		'desc' => __( 'Check box to enable featured images on single blog posts.', 'pytheas' ),
		'id' => 'blog_single_thumbnail',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'blog',
	);
		
	$options['blog_bio'] = array(
		'name' => __( 'Author Bio?', 'pytheas' ),
		'desc' => __( 'Check box to enable featured images on single blog posts.', 'pytheas' ),
		'id' => 'blog_bio',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'blog',
	);
			
	$options['blog_tags'] = array(
		'name' => __( 'Tags?', 'pytheas' ),
		'desc' => __( 'Check box to enable featured images on single blog posts.', 'pytheas' ),
		'id' => 'blog_tags',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'blog',
	);
		
	$options['blog_related'] = array(
		'name' => __( 'Related Posts?', 'pytheas' ),
		'desc' => __( 'Check box to enable featured images on single blog posts.', 'pytheas' ),
		'id' => 'blog_related',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'blog',
	);

	return $options;
}

// Add customizer settings
function wpex_customize_register( $wp_customize ) {
	 
	// Get options array
	$options = wpex_options_array();

	if ( ! $options ) return;

	// Add theme section
	$wp_customize->add_panel( 'wpex_theme_settings', array(
		'title'    => __( 'Theme Settings', 'pytheas' ),
		'priority' => 999,
	) );

	// Add all options to customizer
	foreach ( $options as $key => $val ) {

		$type        = isset( $val['type'] ) ? $val['type'] : '';
		$name        = isset( $val['name'] ) ? $val['name'] : '';
		$section     = isset( $val['section'] ) ? $val['section'] : '';
		$description = isset( $val['description'] ) ? $val['description'] : '';
		$default     = isset( $val['std'] ) ? $val['std'] : '';
		$option_id   = 'options_wpex_themes['. $key .']';
		$control_id  = 'wpex_'. $key;
		$choices     = isset( $val['options'] ) ? $val['options'] : '';

		// Add sections
		if ( 'heading' == $type ) {

			$wp_customize->add_section( 'wpex_'. $key, array(
				'title' => $name,
				'panel' => 'wpex_theme_settings',
				'description' => $description,
			) );

		}

		// Uploads
		elseif ( 'upload' == $type && $section ) {

			$wp_customize->add_setting( $option_id, array(
				'default'           => $default,
				'type'              => 'option',
				'sanitize_callback' => false,
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $control_id, array(
				'label'       => $name,
				'section'     => 'wpex_'. $section,
				'settings'    => $option_id,
				'description' => $description,
			) ) );

		}

		// Other
		elseif ( $section ) {

			$wp_customize->add_setting( $option_id, array(
				'default'           => $default,
				'type'              => 'option',
				'sanitize_callback' => false,
			) );
			$wp_customize->add_control( $control_id, array(
				'label'       => $name,
				'section'     => 'wpex_'. $section,
				'settings'    => $option_id,
				'type'        => $type,
				'choices'     => $choices,
				'description' => $description,
			) );

		}

	}

}
add_action( 'customize_register', 'wpex_customize_register' );