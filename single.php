<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Pytheas
 * @since Pytheas 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-header-title"><?php the_title(); ?></h1>
		<nav class="single-nav clr"> 
			<?php next_post_link('<div class="single-nav-left">%link</div>', '<span class="fa fa-chevron-left"></span>', false); ?>
			<?php previous_post_link('<div class="single-nav-right">%link</div>', '<span class="fa fa-chevron-right"></span>', false); ?>
		</nav><!-- .page-header-title --> 
	</header><!-- .page-header -->
	
	<div id="primary" class="content-area span_16 col clr clr-margin">
		<div id="content" class="site-content" role="main">

			<?php if ( ! post_password_required() ) : ?>
				
				<ul class="meta single-meta clr">
					<li><span class="fa fa-clock-o"></span><?php echo get_the_date(); ?></li>
					<li><span class="fa fa-folder-open"></span><?php the_category(' / '); ?></li>
					<?php if( comments_open() ) { ?>
						<li class="comment-scroll"><span class="fa fa-comment"></span> <?php comments_popup_link(__('Leave a comment', 'pytheas'), __('1 Comment', 'pytheas'), __('% Comments', 'pytheas'), 'comments-link', __('Comments closed', 'pytheas')); ?></li>
					<?php } ?>
					<li><span class="fa fa-user"></span><?php the_author_posts_link(); ?></li>
				</ul><!-- .meta -->

				<?php get_template_part('content', get_post_format() ); ?>

			<?php endif; ?>

			<article class="entry clr">
				<?php the_content(); ?>
			</article><!-- /entry -->

			<?php wp_link_pages( array(
				'before'      => '<div class="page-links clr">',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) ); ?>

			<?php if ( wpex_get_option( 'blog_tags', true ) ) : ?>
				<?php the_tags('<div class="post-tags clr">','','</div>'); ?>
			<?php endif; ?>

			<?php if ( wpex_get_option('blog_bio', '1' ) && get_the_author_meta( 'description' ) ) : ?>
				<?php get_template_part( 'author-bio' ); ?>
			<?php endif; ?>

			<?php if ( wpex_get_option('blog_related', '1' ) ) : ?>
				<?php get_template_part( 'content', 'related-posts' ); ?>
			<?php endif; ?>

			<?php comments_template(); ?>

		</div><!-- #content -->

	</div><!-- #primary -->

<?php endwhile; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>