<?php
/**
 * The theme's single file use for displaying single posts.
 *
 * @since   0.1.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();
?>

	<?php the_post_thumbnail( 'attorney' ); ?>

	<div class="row">
		<section class="columns small-12 medium-8">

			<div class="page-content">
				<?php the_content(); ?>
			</div>

			<?php
			$included_areas = get_post_meta( get_the_ID(), '_practice_areas', true );
			$practice_areas = array();
			if ( ! empty( $included_areas ) ) {
				$practice_areas = get_posts( array(
					'post_type'   => 'practice_area',
					'numberposts' => - 1,
					'include'     => $included_areas,
				) );
			}

			if ( ! empty( $practice_areas ) ) :
				?>
				<h3 class="text-uppercase">Practice Areas:</h3>

				<div class="practice-areas row small-up-1 small-collapse">
					<?php foreach ( $practice_areas as $practice_area ) : ?>
						<div class="column column-block">
							<div class="practice-area">
								<a href="<?php echo get_post_type_archive_link( 'practice_area' ) . "#{$practice_area->post_name}"; ?>">
									<h4 class="practice-area-title">
										<?php echo $practice_area->post_title; ?>
									</h4>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</section>

		<?php get_sidebar( 'attorney' ); ?>
	</div>

<?php
get_footer();