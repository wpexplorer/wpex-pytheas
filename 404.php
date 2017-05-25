<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area span_16 col clr-margin">
		<div id="content" class="site-content" role="main">
			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Not found', 'pytheas' ); ?></h1>
			</header><!-- .page-header -->
			<div id="error-page" class="page-wrapper">
				<div class="page-content">
					<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'pytheas' ); ?></h2>
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'pytheas' ); ?></p>
				</div><!-- .page-content -->
			</div><!-- .page-wrapper -->
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>