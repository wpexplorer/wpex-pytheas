<?php
/**
 * The template for displaying Portfolio Tags
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

get_header(); ?>

	<header class="page-header clr">
		<h1 class="page-header-title"><?php echo single_term_title(); ?></h1>
		<?php if ( category_description() ) : ?>
			<div class="archive-meta"><?php echo term_description(); ?></div>
		<?php endif; ?>
	</header><!-- .page-heading -->

	<?php if ( have_posts( ) ) : ?>
		<div id="primary" class="content-area span_24 row clr">
			<div id="content" class="site-content" role="main">
				<div class="portfolio-content row clr">
					<?php
					$wpex_count=0;
					while ( have_posts() ) : the_post();
						$wpex_count++;
						get_template_part('content','portfolio');
						if ( $wpex_count == 4 ) {
							echo '<div class="clr"></div>';
							$wpex_count=0;
					}
					endwhile; ?>
				</div><!-- .portfolio-content -->
				<?php wpex_pagination(); ?>
			</div><!-- #content -->
		</div><!-- #primary -->
	<?php endif; ?>

<?php get_footer(); ?>