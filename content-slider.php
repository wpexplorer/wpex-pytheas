<?php
/**
 * Homepage Slider
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

if ( wpex_get_option( 'slides_alt' ) ) :
	
	echo do_shortcode( wpex_get_option( 'slides_alt' ) );
	
else :

	// Get slides
	$wpex_query = new WP_Query(
		array(
			'post_type'      => 'slides',
			'posts_per_page' => '-1',
			'no_found_rows'  => true,
		)
	);
	// Display Slides
	if ( $wpex_query->posts ) :

		// Load slider js
		wp_enqueue_script( 'wpex-slider-home' ); ?>

		<div id="home-slider-wrap" class="clr flexslider-container">

			<div id="home-slider" class="flexslider">

				<div id="home-slider-loader"><i class="fa fa-spinner fa-spin"></i></div>
				
				<ul class="slides">

					<?php foreach ( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>
						
						<?php if ( has_post_thumbnail() || get_post_meta( get_the_ID(), 'wpex_slides_video', true ) ) : ?>
							
							<li>
								<div class="slide-inner">

									<?php if ( $video = get_post_meta( get_the_ID(), 'wpex_slides_video', true ) ) : ?>

										<div class="fitvids"><?php echo wp_oembed_get( $video ); ?></div>

									<?php else : ?>

										<?php if ( $url = get_post_meta( get_the_ID(), 'wpex_slides_url', true ) ) : ?>

											<a href="<?php echo esc_url( $url ); ?>" title="<?php wpex_esc_title(); ?>" target="_<?php echo get_post_meta( get_the_ID(), 'wpex_slides_url_target', true ); ?>">
												<?php the_post_thumbnail( 'wpex-home-slider' ); ?>
											</a>

										<?php else : ?>

											<?php the_post_thumbnail( 'wpex-home-slider' ); ?>

										<?php endif; ?>

									<?php endif; ?>
									
									<?php if ( $post->post_content ) { ?>
										<div class="flex-caption"><?php the_content(); ?></div>
									<?php } ?>

								</div><!-- .slide-inner -->

							</li>

						<?php endif; ?>

					<?php endforeach; ?>

				</ul><!-- .slides -->

			</div><!-- .home-slider -->

		</div><!-- #home-slider-wrap -->

	<?php endif; ?>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>