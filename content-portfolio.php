<?php
/**
 * Portfolio entry
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

global $wpex_query;

/******************************************************
 * Single Posts
*****************************************************/
if ( is_singular() && ! $wpex_query ) : ?>

	<div id="portfolio-media">

		<div id="portfolio-media-inner">

			<?php
			// Get attachments
			$attachments = wpex_get_gallery_ids();

			if ( ! $attachments ) : ?>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" title="<?php the_title_attribute(); ?>" class="prettyphoto-link"><?php the_post_thumbnail( 'wpex-portfolio-post' ); ?></a>
					</div><!-- /post-thumbnail -->

				<?php endif; ?>

			<?php elseif ( $attachments) :

				if ( count( $attachments ) <= 1 ) :

						$attachment = $attachments[0];
						$url = wp_get_attachment_image_src( $attachment, 'wpex-portfolio-post', false );
						$url = isset( $url[0] ) ? $url[0] : '';
						$meta = wpex_get_attachment( $attachment ); ?>

					<a href="<?php echo esc_url( wp_get_attachment_url( $attachment ) ); ?>" title="<?php echo esc_attr( $meta['title'] ); ?>" rel="prettyPhoto[portfolio_gallery]"><img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $meta['title'] ); ?>" /></a>

				<?php else :

					wp_enqueue_script( 'wpex-slider-portfolio' ); ?>

					<div id="portfolio-slider" class="flexslider-container">

						<div id="portfolio-slider-loader"><span class="fa fa-spinner fa-spin"></span></div>

						<div id="slider-<?php get_the_ID(); ?>" class="flexslider">

							<ul class="slides">

								<?php foreach ( $attachments as $attachment ) :
									$url = wp_get_attachment_image_src( $attachment, 'wpex-portfolio-post', false );
									$url = isset( $url[0] ) ? $url[0] : '';
									if ( $url ) :
										$meta = wpex_get_attachment( $attachment ); ?>

										<li class="slide">
											<a href="<?php echo esc_url( wp_get_attachment_url( $attachment ) ); ?>" title="<?php echo esc_attr( $meta['title'] ); ?>" rel="prettyPhoto[portfolio_gallery]"><img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $meta['title'] ); ?>" /></a>
										</li>

									<?php endif; ?>

								<?php endforeach; ?>

							</ul><!-- .slides -->

						</div><!-- /.flexslider -->

					</div><!-- .flexslider-container -->

				<?php endif; ?>

			<?php endif; ?>

		</div><!-- #single-portfolio-media-inner -->

	</div><!-- #single-portfolio-media -->

<?php
/******************************************************
 * Entries
*****************************************************/
else :
	
	global $wpex_count;

	$wpex_clr_margin = ( $wpex_count == 1 ) ? 'clr-margin' : NULL; ?>

	<article id="#post-<?php the_ID(); ?>" <?php post_class( 'portfolio-entry col span_6 '. $wpex_clr_margin ); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark" class="portfolio-entry-img-link"><?php the_post_thumbnail( 'wpex-portfolio-entry' ); ?></a>
		<?php endif; ?>
		<div class="portfolio-entry-description">
			<h2><a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="portfolio-entry-excerpt">
				<?php
				$length = wpex_get_option( 'portfolio_entry_excerpt_length' );
				$length = $length ? $length : '12';
				echo ( ! empty( $post->post_excerpt) ) ? get_the_excerpt() : wp_trim_words( get_the_content(), $length ); ?>
			</div><!-- .portfolio-entry-excerpt -->
		</div><!-- .portfolio-entry-description -->
	</article><!-- .portfolio-entry -->

<?php endif; ?>