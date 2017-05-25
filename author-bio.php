<?php
/**
 * The template for displaying Author bios.
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */ ?>

<div class="author-info row clr">
	<h4 class="heading"><span><?php _e( 'Post by', 'pytheas' ); ?> <?php echo get_the_author(); ?></span></h4>
	<div class="author-avatar col span_4 clr-margin">
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 74 ) ); ?></a>
	</div><!-- .author-avatar -->
	<div class="author-description col span_18 clr-margin">
		<?php the_author_meta( 'description' ); ?>
	</div><!-- .author-description -->
</div><!-- .author-info -->