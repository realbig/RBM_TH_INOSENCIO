<?php
/**
 * Show's list of attorneys.
 *
 * @since   0.1.0
 * @package Inosencio
 *
 * @global $wp_query
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_filter( 'inosencio_page_title', '_inosencio_page_title_attorneys' );

function _inosencio_page_title_attorneys() {
	return 'Attorneys';
}

get_header();
?>

<div class="row">

	<?php if ( have_posts() ) : ?>
	
		<?php while ( have_posts() ) : the_post(); ?>
	
			<div <?php post_class( array(
				'small-12',
				'medium-3',
				'columns',
				'text-center',
			) ); ?>>

				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php echo wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'medium' ); ?>
				</a>

				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<h4><?php the_title(); ?></h4>
					<?php echo get_post_meta( get_the_ID(), '_attorney_title', true ); ?>
				</a>

			</div>
	
		<?php endwhile; ?>

	<?php else: ?>
		No Attorneys!
	<?php endif; ?>
	
</div>


<?php
get_footer();