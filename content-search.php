<?php
/**
 * Search entry
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

$class = array( 'search-entry', 'clr' );
if ( has_post_thumbnail() ) {
	$class[] = 'has-thumbnail';
} ?>  

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="search-entry-img-link"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
	<?php endif; ?>
	<div class="search-entry-text clr">
		<header>
			<h2><a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>"><?php the_title(); ?></a><span>(<?php echo get_post_type(); ?>)</span></h2>
		</header>
		<?php
		if ( wpex_get_option( 'blog_exceprt', '1' ) ) {
			the_excerpt();
		} else {
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pytheas' ) );
		} ?>
	</div><!-- .search-entry-text -->
</article><!-- .entry -->