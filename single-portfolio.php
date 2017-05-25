<?php
/**
 * Single portfolio output
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post();
	
		// Get portfolio terms
		$terms = get_the_term_list( get_the_ID(), 'portfolio_category' );?>
		
		<header class="page-header clr">
			<h1 class="page-header-title"><?php the_title(); ?></h1>
			<nav class="single-nav clr">
				<?php next_post_link( '<div class="single-nav-left">%link</div>', '<span class="inner"><span class="fa fa-chevron-left"></span></span>', false ); ?>
				<?php previous_post_link( '<div class="single-nav-right">%link</div>', '<span class="inner"><span class="fa fa-chevron-right"></span></span>', false ); ?>
			</nav><!-- .single-nav -->
		</header><!-- .page-heading -->
		
		<div id="primary" class="content-area span_16 col clr clr-margin">

			<div id="content" class="site-content" role="main">

				<?php if (  ! post_password_required() ) : ?>

					<?php if ( wpex_get_option( 'portfolio_post_meta', true ) ) : ?>

						<ul class="meta portfolio-meta clr">
							<li><span class="fa fa-clock-o"></span><?php echo get_the_date(); ?></li>
							<?php if( $terms ) { ?>
								<li><span class="fa fa-folder-open"></span><?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', ' ') ?></li>
							<?php } $terms = NULL; ?>
							<?php if ( comments_open() && wpex_get_option( 'portfolio_comments' ) ) : ?>
								<li i="comment-scroll"><span class="fa fa-comment"></span> <?php comments_popup_link(__('Leave a comment', 'pytheas'), __('1 Comment', 'pytheas'), __('% Comments', 'pytheas'), 'comments-link', __('Comments closed', 'pytheas')); ?></li>
							<?php endif; ?>
						</ul><!-- .meta -->

					<?php endif; ?>

					<?php get_template_part( 'content', 'portfolio' ); ?>

				<?php endif; ?>

				<article class="entry clr">
					<?php the_content(); ?>
				</article><!-- .entry clr -->

				<?php if ( wpex_get_option( 'portfolio_post_tags', '1' ) ) : ?>
					<?php echo get_the_term_list( get_the_ID(), 'portfolio_tag', '<div class="portfolio-tags clr">', ' ', '</div>' ); ?> 
				<?php endif; ?>

				<footer class="entry-footer">
					<?php edit_post_link( __( 'Edit Page', 'pytheas' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-footer -->

				<?php if ( wpex_get_option( 'portfolio_related', '1' ) ) : ?>
					<?php get_template_part( 'content', 'portfolio-related' ); ?>
				<?php endif; ?>

				<?php if ( wpex_get_option( 'portfolio_comments', '1' ) ) : ?>
					<?php comments_template(); ?>
				<?php endif; ?>

			</div><!-- #content -->

		</div><!-- #primary -->

	<?php endwhile; ?>
	
<?php get_sidebar(); ?>
<?php get_footer();?>