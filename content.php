<?php
/**
 * The default template for displaying content. Used for both single and index/archive.
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/******************************************************
 * Single Posts
*****************************************************/

if ( is_singular() && is_main_query() ) :
	 
	if ( wpex_get_option( 'blog_single_thumbnail' ) == '1' && has_post_thumbnail() ) : ?>

		<a href="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>" title="<?php wpex_esc_title(); ?>" class="prettyphoto-link" id="post-thumbnail"><?php the_post_thumbnail( 'wpex-post' ); ?></a>

	<?php endif; ?>

<?php
/******************************************************
 * Entries
*****************************************************/
else :
	
	global $wpex_count;
	$wpex_clr_margin = ( $wpex_count == 1 ) ? 'clr-margin' : NULL; ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry clr '. $wpex_clr_margin); ?>>

		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="blog-entry-img-link"><?php the_post_thumbnail( 'wpex-entry' ); ?></a>
		<?php endif; ?>

		<div class="blog-entry-details">

			<header><h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2></header>

			<ul class="meta clr">
				<li><span class="fa fa-clock-o"></span><?php echo get_the_date(); ?></li>
				<li><span class="fa fa-folder-open"></span><?php the_category(' / '); ?></li>
				<?php if ( comments_open() ) : ?>
					<li><span class="fa fa-comment"></span><?php comments_popup_link(__('Leave a comment', 'pytheas'), __('1 Comment', 'pytheas'), __('% Comments', 'pytheas'), 'comments-link', __('Comments closed', 'pytheas')); ?></li>
				<?php endif; ?>
				<li><span class="fa fa-user"></span><?php the_author_posts_link(); ?></li>
			</ul><!-- .meta -->

			<div class="blog-entry-content">
				<?php
				if ( wpex_get_option( 'blog_excerpt', '1' ) ) {
					the_excerpt();
				} else {
					the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pytheas' ) );
				} ?>
			</div><!-- .entry-content -->

		</div><!-- .blog-entry-details -->

	</article><!-- .blog-entry-entry -->

<?php endif; ?>