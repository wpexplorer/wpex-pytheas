<?php
/**
 * Services display
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

	<div id="service-media">

		<div id="service-media-inner">

			<?php
			// Get attachments
			$attachments = wpex_get_gallery_ids();

			if ( ! $attachments ) : ?>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" title="<?php the_title_attribute(); ?>" class="prettyphoto-link"><?php the_post_thumbnail( 'wpex-service-post' ); ?></a>
					</div><!-- /post-thumbnail -->

				<?php endif; ?>

			<?php elseif ( $attachments) :

				if ( count( $attachments ) <= 1 ) :

						$attachment = $attachments[0];
						$url = wp_get_attachment_image_src( $attachment, 'wpex-service-post', false );
						$url = isset( $url[0] ) ? $url[0] : '';
						$meta = wpex_get_attachment( $attachment ); ?>

						<a href="<?php echo esc_url( wp_get_attachment_url( $attachment ) ); ?>" title="<?php echo esc_attr( $meta['title'] ); ?>" rel="prettyPhoto[service_gallery]"><img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $meta['title'] ); ?>" /></a>

				<?php else :

					wp_enqueue_script( 'wpex-slider-service' ); ?>

					<div id="service-slider" class="flexslider-container">

						<div id="service-slider-loader"><span class="fa fa-spinner fa-spin"></span></div>

						<div id="slider-<?php get_the_ID(); ?>" class="flexslider">

							<ul class="slides">

								<?php foreach ( $attachments as $attachment ) :
									$url = wp_get_attachment_image_src( $attachment, 'wpex-service-post', false );
									$url = isset( $url[0] ) ? $url[0] : '';
									if ( $url ) :
										$meta = wpex_get_attachment( $attachment ); ?>

										<li class="slide">
											<a href="<?php echo esc_url( wp_get_attachment_url( $attachment ) ); ?>" title="<?php echo esc_attr( $meta['title'] ); ?>" rel="prettyPhoto[service_gallery]"><img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $meta['title'] ); ?>" /></a>
										</li>

									<?php endif; ?>

								<?php endforeach; ?>

							</ul><!-- .slides -->

						</div><!-- /.flexslider -->

					</div><!-- .flexslider-container -->

				<?php endif; ?>

			<?php endif; ?>

		</div><!-- #single-service-media-inner -->

	</div><!-- #single-service-media -->

<?php
/******************************************************
 * Entries
*****************************************************/
else :
	
	global $wpex_count;
	$wpex_clr_margin = ( $wpex_count == 1 ) ? 'clr-margin' : NULL;

	$icon = get_post_meta(get_the_ID(), 'wpex_services_icon', TRUE ); ?>
		
	<article id="#post-<?php the_ID(); ?>" <?php post_class( 'service-entry span_8 col '. $wpex_clr_margin ); ?>>
		<?php if ( $icon && $icon !== 'Select' ) { ?>
			<div class="service-icon">
				<span class="fa fa-<?php echo esc_html( $icon ); ?>"></span>
			</div><!-- .service-icon -->
		<?php } ?>
		<div class="service-entry-details clr">
			<h3 class="service-entry-title"><a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<?php
			// Display excerpt
			if ( $post->post_excerpt ) {
				echo get_the_excerpt();
			} else {
				$length = wpex_get_option( 'services_entry_excerpt_length' );
				$length = $length ? $length : '12';
				echo wp_trim_words( strip_shortcodes( get_the_excerpt() ), $length ); 
			} ?>
		</div><!-- .service-entry-details -->
	</article><!-- .service-entry -->

<?php endif; ?>