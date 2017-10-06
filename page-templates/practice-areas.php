<?php
/**
 * Template Name: Practice Areas
 *
 * @since {{VERSION}}
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();

$practice_areas = new WP_Query( array(
	'post_type' => 'practice_area',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC',
) );

global $post;

?>

<div class="row">
	<section class="columns small-12 medium-8">
		
		<section class="page-content">
			<?php the_content(); ?>
		</section>
		
		<div class="practice-areas-container">

			<?php if ( $practice_areas->have_posts() ) : ?>
				<h3 class="text-uppercase">Practice Areas:</h3>

				<div class="practice-areas row small-up-1 small-collapse">
					<?php
					while ( $practice_areas->have_posts() ) : $practice_areas->the_post();
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
					<?php wp_reset_postdata(); ?>
				</div>
			<?php endif; ?>
			
		</div>
		
	</section>

	<?php get_sidebar(); ?>
</div>

<?php
get_footer();