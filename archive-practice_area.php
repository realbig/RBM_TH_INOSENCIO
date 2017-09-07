<?php
/**
 * Show's list of attorneys.
 *
 * @since   0.1.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_filter( 'inosencio_page_title', '_inosencio_page_title_practice_areas' );

function _inosencio_page_title_practice_areas() {
	return 'Practice Areas';
}

get_header();
?>

	<div class="row">
		<section class="columns small-12 medium-8">

			<?php if ( have_posts() ) : ?>
				<h3 class="text-uppercase">Practice Areas:</h3>

				<div class="practice-areas row small-up-1 small-collapse">
					<?php
					while ( have_posts() ) :
						the_post();
						global $post;
						?>
						<div class="column column-block">
							<div id="<?php echo $post->post_name; ?>" class="practice-area">
								<a href="#<?php echo $post->post_name; ?>">
									<h4 class="practice-area-title">
										<?php the_title(); ?>
									</h4>
								</a>
							</div>

							<div class="practice-area-content">
								<?php the_content(); ?>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</section>

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();