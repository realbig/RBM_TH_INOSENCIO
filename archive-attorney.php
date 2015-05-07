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


<?php if ( have_posts() ) : ?>

	<ul class="attorney-select text-center">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<li>
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</li>
		<?php endwhile; ?>
	</ul>

	<ul class="attorneys">
		<?php
		while ( have_posts() ) :
			the_post();
			$image_ID = get_post_thumbnail_id( get_the_ID() );
			$image    = wp_get_attachment_image_src( $image_ID, 'full' );
			?>
			<li style="background-image: url('<?php echo $image[0]; ?>');height: <?php echo min( $image[2], 500 ); ?>px;">
				<div class="container">
					<h2>
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>

					<?php if ( $attorney_title = get_post_meta( get_the_ID(), '_attorney_title', true ) ) : ?>
						<p class="attorney-title">
							<?php echo $attorney_title; ?>
						</p>
					<?php endif; ?>

					<p class="attorney-read-more">
						Read more about <a href="<?php the_permalink(); ?>" class="button light">
							<?php
							$arr = explode( ' ', trim( get_the_title() ) );
							echo $arr[0];
							?>
						</a>
					</p>
				</div>
			</li>
		<?php endwhile; ?>
	</ul>

<?php else: ?>
	No Attorneys!
<?php endif; ?>


<?php
get_footer();