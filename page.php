<?php
/**
 * The theme's page file use for displaying pages.
 *
 * @since 0.1.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();
?>

	<div class="row">
		<section class="page-content columns small-12 medium-8 medium-push-4">
			<?php the_content(); ?>
		</section>

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();