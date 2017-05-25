<?php
/**
 * Modify WP menu for dropdown styles
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

class WPEX_Dropdown_Walker_Nav_Menu extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( ! empty( $children_elements[$element->$id_field] ) && ( $depth == 0 ) ) {
            $element->classes[] = 'dropdown';
            $element->title .= ' <span class="fa fa-angle-down"></span>';
        }
		if ( !empty( $children_elements[$element->$id_field] ) && ( $depth > 0 ) ) {
            $element->classes[] = 'dropdown';
            $element->title .= ' <span class="fa fa-angle-right"></span>';
        }	
        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}