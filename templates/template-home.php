<?php
/**
 * Template Name: Home
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

get_header(); ?>

<?php get_template_part( 'content', 'slider' ); ?>

<div id="home-wrap" class="clr">

	<?php the_content(); ?>

	<?php
	/*--------------------------------------*/
	/* Tagline
	/*--------------------------------------*/
	if ( wpex_get_option( 'home_tagline' ) ) { ?>
	
		<div id="home-tagline" class="clr home-block">
			<?php echo wp_kses_post( wpex_get_option( 'home_tagline', 'Home Tagline Sample' ) ); ?>
		</div><!-- #home-tagline -->
		
	<?php }
	
	/*--------------------------------------*/
	/* Recent Services
	/*--------------------------------------*/
	if ( wpex_get_option( 'home_services', '1' ) ) : ?>
		
		<?php
		// Query services
		$wpex_query = new WP_Query( array(
			'post_type'		=> 'services',
			'showposts'		=> wpex_get_option( 'home_services_count', '6' ),
			'no_found_rows'	=> true,
		) );
			
		// Display services if some exist
		if ( $wpex_query->posts ) : ?>
		
			<div id="home-services" class="clr home-block">

				<?php if ( $title = wpex_get_option( 'home_services_title', __( 'Services', 'pytheas' ) ) ) : ?>
					<h2 class="heading"><span><?php echo wp_kses_post( $title ); ?></span></h2>
				<?php endif; ?>

				<div class="row clr">
					<?php
					$wpex_count=0;
					foreach( $wpex_query->posts as $post ) : setup_postdata( $post );
						$wpex_count++;
						get_template_part( 'content', 'services' );
						if ( $wpex_count==3 ) {
							echo '<div class="clr"></div>';
							$wpex_count=0;
						}
					endforeach; ?>

				 </div><!-- .row -->

			</div><!-- #home-services -->

		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
		
	<?php endif; ?>

	<?php
	/*--------------------------------------*/
	/* Recent Portfolio
	/*--------------------------------------*/
	if ( wpex_get_option( 'home_portfolio', '1' ) ) :
		
		$wpex_query = new WP_Query( array(
			'post_type'		=> 'portfolio',
			'showposts'		=> wpex_get_option( 'home_portfolio_count','4' ),
			'no_found_rows'	=> true,
		) );
		
		if ( $wpex_query->posts ) : ?>

			<div id="home-portfolio" class="clr home-block">

				<?php if ( $title = wpex_get_option( 'home_portfolio_title', __( 'Portfolio', 'pytheas' ) ) ) : ?>
					<h2 class="heading"><span><?php echo wp_kses_post( $title ); ?></span></h2>
				<?php endif; ?>

				<div class="row clr">
					<?php
					// Begin Loop
					$wpex_count=0;
					foreach( $wpex_query->posts as $post ) : setup_postdata( $post );
						$wpex_count++;
						get_template_part( 'content','portfolio' );
						if ( $wpex_count == 4 ) {
							echo '<div class="clr"></div>';
							$wpex_count=0;
						}
					endforeach; ?>
				</div><!-- .row -->

			</div><!-- #home-portfolio -->

		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
		
	<?php endif; ?>
	
	<?php
	/*--------------------------------------*/
	/* Recent Standard Posts
	/*--------------------------------------*/
	if ( wpex_get_option( 'home_blog', '1' ) ) :
		
		$wpex_query = new WP_Query( array(
			'post_type'     => 'post',
			'showposts'     => wpex_get_option( 'home_blog_count','4' ),
			'no_found_rows' => true,
		) );
		
		if ( $wpex_query->posts ) : ?>

			<div id="home-blog" class="row clr home-block">

				<?php if ( $title = wpex_get_option( 'home_blog_title' ) ) : ?>
					<h2 class="heading"><span><?php echo wp_kses_post( $title ); ?></span></h2>
				<?php endif; ?>

				<div class="row clr">

					<?php
					// Begin Loop
					$wpex_count=0;

					foreach( $wpex_query->posts as $post ) : setup_postdata( $post );

						$wpex_count++;
						$wpex_clr_margin = ( $wpex_count == 1 ) ? 'clr-margin' : NULL; ?>

						<div <?php post_class( 'home-blog-entry span_6 col '. $wpex_clr_margin); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="home-blog-entry-img-link"><?php the_post_thumbnail( 'wpex-blog-home-entry' ); ?></a>
							<?php endif; ?>
							<h2><a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>"><?php the_title(); ?></a></h2>
							<div class="home-blog-entry-excerpt">
								<?php 
								// Display excerpt
								if ( $post->post_excerpt ) {
									echo get_the_excerpt();
								} else {
									echo wp_trim_words( strip_shortcodes( get_the_excerpt() ), wpex_get_option( 'home_blog_entry_excerpt_length', '12' ) );
								} ?>
							</div><!-- .home-blog-entry-excerpt -->
						</div><!-- .home-blog-entry -->

					<?php endforeach; ?>

				</div><!-- .row -->

			</div><!-- #home-blog -->

		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
		
	<?php endif; ?>

</div><!-- #home-wrap -->
 
<?php get_footer();?>