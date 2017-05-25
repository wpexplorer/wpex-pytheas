<?php
/**
 * Related portfolio items
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

// Query args
$args = array(
	'post_type'      => 'portfolio',
	'posts_per_page' => '3',
	'post__not_in'   => array( get_the_ID() ),
	'no_found_rows'  => true,
	'orderby'        => 'rand',
);

// Query by category
$terms = wp_get_post_terms( get_the_ID(), 'portfolio_category' );
if ( isset ( $terms[0] ) ) {
	$args['tax_query'] = array( array(
		'taxonomy' => 'portfolio_category',
		'field'    => 'id',
		'terms'    => $terms[0]->term_id,
	) );
}

// Get posts
$wpex_query = new WP_Query( $args );

// Display posts if we have some
if ( $wpex_query->posts ) : ?>

	<section class="related-posts row clr">

		<h4 class="heading"><span><?php _e( 'Related Projects', 'pytheas' ); ?></span></h4>

		<?php
		$wpex_count=0;
		while( $wpex_query->have_posts() ) : $wpex_query->the_post();
		$wpex_count++;
		$wpex_clr_margin = ( $wpex_count == 1 ) ? 'clr-margin' : NULL; ?>

			<article <?php post_class( 'portfolio-entry col span_8 '. $wpex_clr_margin); ?>>

				<?php
				// Display featured image
				if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="portfolio-entry-img-link"><?php the_post_thumbnail( 'wpex-portfolio-related' ); ?></a>
				<?php endif; ?>

				<div class="portfolio-entry-description">

					<h2><a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>"><?php the_title(); ?></a></h2>

					<div class="portfolio-entry-excerpt">
						<?php
						//show trimmed excerpt if default excerpt is empty
						echo ( ! empty( $post->post_excerpt) ) ? get_the_excerpt() : wp_trim_words( get_the_content(), 15 ); ?>
					</div><!-- .portfolio-entry-excerpt -->

				</div><!-- .portfolio-entry-description -->

			</article><!-- .portfolio-entry -->

		<?php if ( $wpex_count == 3 ) echo '<div class="clr"></div>'; $wpex_count=0; ?>

		<?php endwhile; ?>

		
	</section><!-- #related-posts -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>