<?php
/**
 * Related Posts
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

$category = get_the_category();
if ( isset( $category[0] ) ) {
	$wpex_related_cat = $category[0]->cat_ID;
} else {
	$wpex_related_cat = NULL;
}
$wpex_query = NULL;
$wpex_query = new WP_Query(
	array(
		'post_type'			=> 'post',
		'posts_per_page'	=> '3',
		'category'			=> $wpex_related_cat,
		'post__not_in'		=> array( get_the_ID() ),
		'orderby'			=> 'rand',
		'no_found_rows'		=> true,
	)
);
		
if ( $wpex_query->posts ) : ?>

	<section class="related-posts row clr">
		<h4 class="heading"><span><?php _e( 'Related Articles', 'pytheas' ); ?></span></h4>
		<?php while( $wpex_query->have_posts() ) : $wpex_query->the_post(); ?>
			<article id="post-<?php the_ID(); ?>" class="related-entry clr row">
				<?php if( has_post_thumbnail() ) { ?>
					<div class="related-entry-img span_6 col clr-margin">
						 <a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark"><?php the_post_thumbnail( 'wpex-post-related' ); ?></a>
					 </div><!-- .related-entry-img -->
				<?php } ?>
				<div class="related-entry-content span_18 col <?php if ( ! has_post_thumbnail() ) echo 'full-width clr-margin'; ?>">
					<h5 class="related-entry-title"><a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark"><?php the_title()?></a></h5>
					<p><?php echo wp_trim_words( get_the_content(), 30, '...' ); ?></p>
				</div><!-- .related-entry-content -->
			</article><!-- .related-entry -->
		<?php endwhile; ?>
	</section><!-- #related-posts --> 
		
<?php endif; ?>

<?php wp_reset_postdata(); ?>