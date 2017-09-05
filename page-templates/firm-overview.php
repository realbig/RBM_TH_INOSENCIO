<?php
/**
 * Template Name: Firm Overview
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

<?php if ( has_post_thumbnail() ) : ?>
	<?php
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		?>
		<div style="background-image: url('<?php echo $image[0]; ?>');
			height:<?php echo min( $image[2], 500 ); ?>px;"
		     class="image-container">

			<?php if ( $quote = get_post_meta( get_the_ID(), '_inosencio_firm_overview_quote', true ) ) : ?>
				<div class="container">
					<?php echo $quote; ?>
				</div>
			<?php endif; ?>
		</div>
<?php endif; ?>

	<div class="row">
		<section class="page-content columns small-12 medium-8">
			<?php the_content(); ?>
		</section>

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();