<?php
/**
 * The theme's single file use for displaying single posts.
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
		<section class="columns small-12 medium-8">
			<div class="page-content">
				<?php the_content(); ?>
			</div>

			<?php comments_template(); ?>
		</section>

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();