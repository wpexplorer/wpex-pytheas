<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

if ( is_active_sidebar( 'sidebar' ) ) : ?>

	<div id="secondary" class="sidebar-container span_8 col" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area"><?php dynamic_sidebar( 'sidebar' ); ?></div>
		</div>
	</div><!-- #secondary -->

<?php endif; ?>