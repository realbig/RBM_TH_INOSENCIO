<?php
/**
 * The theme's footer file that appears on EVERY page.
 *
 * @since 0.1.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<?php // #site-content ?>
</section>

</div> <?php // .off-canvas-content ?>

<footer id="site-footer">

	<div class="row">

		<section class="footer-left columns small-12">
			<div class="row">

				<div class="logo columns small-12">
					<a href="<?php bloginfo( 'url' ); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer-logo.png"
						     alt="inosencio fisk"/>
					</a>
				</div>

				<?php dynamic_sidebar( 'footer-left' ); ?>

			</div>
		</section>

	</div>

	<p class="footer-copyright text-center">
		&copy; <?php echo date( 'Y' ); ?> Inosencio Fisk &bull; Site by <a href="http://realbigmarketing.com" rel="nofollow">Real Big Marketing</a> &bull; <a href="<?php bloginfo( 'url' ); ?>/about-this-site/">About this site</a>
	</p>

</footer>

<?php // #wrapper ?>
</div>

<?php wp_footer(); ?>

</body>
</html>