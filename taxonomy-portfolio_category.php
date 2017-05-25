<?php
/**
 * The template for displaying Portfolio Categories
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
		<?php if ( wpex_get_option( 'portfolio_archive_filter', '1' ) ) : ?>
			<?php $posttype_obj = get_post_type_object( 'portfolio' ); ?>
			<?php $portfolio_terms = get_terms( 'portfolio_category', array( 'orderby' => 'name', 'order' => 'ASC' ) ); ?>
			<?php if ( $portfolio_terms ) : ?>
				<ul class="tax-archives-filter dropdown-menu clr">
				<li class="browse"><a href="#" title="<?php _e( 'Browse', 'pytheas' ); ?>"><?php _e( 'Browse', 'pytheas' ); ?> <?php echo $posttype_obj->label; ?><i class="fa fa-caret-down"></i></a>
						<ul>
							<li><a href="<?php echo get_post_type_archive_link( 'portfolio' ); ?>" title="<?php echo $posttype_obj->label; ?>" class="active"><?php _e( 'All', 'pytheas' ); ?></a></li>
							<?php foreach( $portfolio_terms as $portfolio_term ) : ?>
								<li><a href="<?php echo esc_url( get_term_link( $portfolio_term->slug, 'portfolio_category' ) ); ?>" title="<?php echo esc_attr( $portfolio_term->name ); ?>"><?php echo esc_html( $portfolio_term->name ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</li>
				</ul><!-- .tax-archives-filter -->
			<?php endif; ?>
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
						get_template_part( 'content', 'portfolio' );
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