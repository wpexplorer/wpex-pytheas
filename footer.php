<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the #main element
 *
 * @package   Pytheas WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */ ?>


	</div><!-- #main -->

		<?php if ( wpex_get_option( 'widgetized_footer' ) ) : ?>

			<footer id="footer" class="site-footer">

				<div id="footer-widgets" class="row clr">

					<div class="footer-box span_6 col clr-margin">
						<?php dynamic_sidebar( 'footer-one' ); ?>
					</div><!-- .footer-box -->

					<div class="footer-box span_6 col">
						<?php dynamic_sidebar( 'footer-two' ); ?>
					</div><!-- .footer-box -->

					<div class="footer-box span_6 col">
						<?php dynamic_sidebar( 'footer-three' ); ?>
					</div><!-- .footer-box -->

					<div class="footer-box span_6 col">
						<?php dynamic_sidebar( 'footer-four' ); ?>
					</div><!-- .footer-box -->

				</div><!-- #footer-widgets -->

			</footer><!-- #footer -->

		<?php endif; ?>

		<div id="footer-bottom" class="row clr">

			<div id="copyright" class="span_12 col clr-margin" role="contentinfo">
				<?php if ( wpex_get_option( 'custom_copyright' ) ) : ?>
					<?php echo do_shortcode( wpex_get_option( 'custom_copyright' ) ); ?>
				<?php else : ?>
					<a href="http://www.wpexplorer.com/pytheas-free-wordpress-theme/" target="_blank" title="Pytheas WordPress Theme">Pytheas</a> Theme by <a href="http://themeforest.net/user/wpexplorer?ref=WPExplorer" target="_blank" title="WPExplorer Themes">WPExplorer</a> Powered by <a href="https://wordpress.org/" title="WordPress" target="_blank">WordPress</a>
				<?php endif; ?>
			</div><!-- #copyright -->

			<?php wp_nav_menu( array(
				'container'       => 'div',
				'container_id'    => 'footer-menu',
				'container_class' => 'span_12 col',
				'theme_location'  => 'footer_menu',
				'sort_column'     => 'menu_order',
				'fallback_cb'     => '',
			) ); ?>

		</div><!-- #footer-bottom -->

	</div><!-- #wrap -->

<?php wp_footer(); ?>

</body>
</html>