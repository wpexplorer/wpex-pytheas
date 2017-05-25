<?php
/**
 * This class adds styling (color) options to the WordPress
 * Theme Customizer and outputs the needed CSS to the header
 * 
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     2.0.0
 */

if ( ! class_exists( 'WPEX_Theme_Customizer_Styling' ) ) :
	class WPEX_Theme_Customizer_Styling {

		public static function register ( $wp_customize ) {

			// Theme Design Section
			$wp_customize->add_section( 'wpex_styling' , array(
				'title'		=> __( 'Styling', 'pytheas' ),
				'priority'	=> 9999,
			) );

			// Get Color Options
			$color_options = self::wpex_color_options();

			// Loop through color options and add a theme customizer setting for it
			$count='2';
			foreach( $color_options as $option ) {
				$count++;
				$default = isset($option['default']) ? $option['default'] : '';
				$type = isset($option['type']) ? $option['type'] : '';
				$wp_customize->add_setting( 'wpex_'. $option['id'] .'', array(
					'type'		=> 'theme_mod',
					'default'	=> $default,
					'transport'	=> 'refresh',
				) );
				if ( 'text' == $type ) {
					$wp_customize->add_control( 'wpex_'. $option['id'] .'', array(
						'label'		=> $option['label'],
						'section'	=> 'wpex_styling',
						'settings'	=> 'wpex_'. $option['id'] .'',
						'priority'	=> $count,
						'type'		=> 'text',
					) );
				} else {
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpex_'. $option['id'] .'', array(
						'label'		=> $option['label'],
						'section'	=> 'wpex_styling',
						'settings'	=> 'wpex_'. $option['id'] .'',
						'priority'	=> $count,
					) ) );
				}
			} // End foreach

		} // End register

		public static function header_output() {
			$color_options = self::wpex_color_options();
			$css ='';
			foreach( $color_options as $option ) {
				$theme_mod = get_theme_mod('wpex_'. $option['id'] .'');
				if ( '' != $theme_mod ) {
					if ( !empty($option['media_query']) ) {

						$css .= $option['media_query'] .'{'. $option['element'] .'{ '. $option['style'] .':'. $theme_mod.' !important; } }';
					} else {
						$css .= $option['element'] .'{ '. $option['style'] .':'. $theme_mod.' !important; }';
					}
				}
			}
			$css =  preg_replace( '/\s+/', ' ', $css );
			$css = "<!-- Theme Customizer Styling Options -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
			if ( !empty( $css ) ) {
				echo $css;
			}
		} // End header_output function

		public static function wpex_color_options() {

			$array = array();

			$array[] = array(
				'label'		=> __( 'Header Top Padding', 'pytheas' ),
				'id'		=> 'header_top_pad',
				'element'	=> '#masthead',
				'style'		=> 'padding-top',
				'type'		=> 'text',
				'default'	=> '',
			);

			$array[] = array(
				'label'		=> __( 'Header Bottom Padding', 'pytheas' ),
				'id'		=> 'header_bottom_pad',
				'element'	=> '#masthead',
				'style'		=> 'padding-bottom',
				'type'		=> 'text',
				'default'	=> '',
			);

			$array[] = array(
				'label'		=> __( 'Logo Text Color', 'pytheas' ),
				'id'		=> 'logo_color',
				'element'	=> '.logo h1 a, .logo h2 a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Site Subtitle Color', 'pytheas' ),
				'id'		=> 'subtitle_color',
				'element'	=> 'p.site-description',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Menu Background', 'pytheas' ),
				'id'		=> 'nav_bg',
				'element'	=> '#site-navigation, .slicknav_btn',
				'style'		=> 'background-color',
			);

			$array[] = array(
				'label'		=> __( 'Menu Link Color', 'pytheas' ),
				'id'		=> 'nav_link_color',
				'element'	=> '.nav-menu > li > a, .slicknav_btn',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Menu Link Hover Color', 'pytheas' ),
				'id'		=> 'nav_link_hover_color',
				'element'	=> '.nav-menu > li > a:hover,',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Active Menu Link Color', 'pytheas' ),
				'id'		=> 'nav_link_active_color',
				'element'	=> '.nav-menu > .current-menu-item > a, .navigation .current-menu-parent > a, .navigation .current-menu-parent > a:hover, .nav-menu > .current-menu-item > a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Active Menu Link Background', 'pytheas' ),
				'id'		=> 'nav_link_active_bg',
				'element'	=> '.nav-menu .dropdown-menu > li > a:hover,.nav-menu > li.sfHover > a,.nav-menu > .current-menu-item > a,.nav-menu > .current-menu-item > a:hover ',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=> __( 'Sub-Menu Background', 'pytheas' ),
				'id'		=> 'nav_drop_bg',
				'element'	=> '.nav-menu ul',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=> __( 'Sub-Menu Link Bottom Border', 'pytheas' ),
				'id'		=> 'nav_drop_link_border',
				'element'	=> '.nav-menu ul li',
				'style'		=> 'border-color',
			);

			$array[] = array(
				'label'		=> __( 'Sub-Menu Link Color', 'pytheas' ),
				'id'		=> 'nav_drop_link_color',
				'element'	=> '.nav-menu ul > li > a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Sub-Menu Link Hover Color', 'pytheas' ),
				'id'		=> 'nav_drop_link_hover_color',
				'element'	=> '.nav-menu ul > li > a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Sub-Menu Link Hover Background', 'pytheas' ),
				'id'		=> 'nav_drop_link_hover_bg',
				'element'	=> '.nav-menu ul > li > a:hover',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Background', 'pytheas' ),
				'id'		=> 'footer_widgets_bg',
				'element'	=> '#footer',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Color', 'pytheas' ),
				'id'		=> 'footer_widgets_color',
				'element'	=> '#footer, #footer p',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Heading', 'pytheas' ),
				'id'		=> 'footer_widgets_headings',
				'element'	=> '#footer h2, #footer h3, #footer h4, #footer h5,  #footer h6, #footer-widgets .widget-title',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Links', 'pytheas' ),
				'id'		=> 'footer_widgets_links_color',
				'element'	=> '#footer a, #footer-widgets .widget_nav_menu ul > li li a:before',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Links Hover', 'pytheas' ),
				'id'		=> 'footer_widgets_links_hover_color',
				'element'	=> '#footer a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Widgets Borders', 'pytheas' ),
				'id'		=> 'footer_widgets_borders',
				'element'	=> '#footer-widgets .widget_nav_menu ul > li, #footer-widgets .widget_nav_menu ul > li a, .footer-widget > ul > li:first-child, .footer-widget > ul > li, .footer-widget h6, #footer-bottom',
				'style'		=> 'border-color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Bottom Backgorund', 'pytheas' ),
				'id'		=> 'footer_botbg',
				'element'	=> '#footer-bottom',
				'style'		=> 'background-color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Bottom Color', 'pytheas' ),
				'id'		=> 'footer_botcolor',
				'element'	=> '#footer-bottom, #footer-bottom p',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Bottom Link Color', 'pytheas' ),
				'id'		=> 'footer_botlink_color',
				'element'	=> '#footer-bottom a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Footer Bottom Link Color Hover', 'pytheas' ),
				'id'		=> 'footer_botlink_color',
				'element'	=> '#footer-bottom a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Heading Title Hover Color', 'pytheas' ),
				'id'		=> 'heading_title_hover_color',
				'element'	=> 'h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Link Color', 'pytheas' ),
				'id'		=> 'link_color',
				'element'	=> '.single .entry a, #sidebar a, .comment-meta a.url, .logged-in-as a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Link Hover Color', 'pytheas' ),
				'id'		=> 'link_hover_color',
				'element'	=> '.single .entry a:hover, #sidebar a:hover, .comment-meta a.url:hover, .logged-in-as a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Sidebar Link Color', 'pytheas' ),
				'id'		=> 'sidebar_link_color',
				'element'	=> '.sidebar-container a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Sidebar Link Hover Color', 'pytheas' ),
				'id'		=> 'sidebar_link_hover_color',
				'element'	=> '.sidebar-container a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=> __( 'Services Icons', 'pytheas' ),
				'id'		=> 'services_icons_bg',
				'element'	=> '.service-icon',
				'style'		=> 'background',
			);

			// Apply filters for child theming magic
			return apply_filters( 'wpex_color_options_array', $array );
		}

	}

	add_action( 'customize_register' , array( 'WPEX_Theme_Customizer_Styling' , 'register' ) );
	
	add_action( 'wp_head' , array( 'WPEX_Theme_Customizer_Styling' , 'header_output' ) );

endif;