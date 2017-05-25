<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

get_header(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Search Results for', 'pytheas' ); ?>: <?php echo get_search_query(); ?></h1>
	</header>

	<div id="primary" class="content-area span_16 col clr clr-margin">

		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php wpex_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div><!-- #content -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>