<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

get_header(); ?>

	<header class="page-header clr"><h1 class="page-header-title"><?php the_title(); ?></h1></header>

	<div id="primary" class="content-area span_16 col clr clr-margin">

		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article>

					<div class="entry-content entry clr">

						<?php the_content(); ?>

						<?php wp_link_pages( array(
							'before'      => '<div class="page-links clr">',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php edit_post_link( __( 'Edit Page', 'pytheas' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-footer -->

				</article>

				<?php comments_template(); ?>

			<?php endwhile; ?>

		</div><!-- #content -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>