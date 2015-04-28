<?php
/**
 * Template Name: Contact
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

<?php if ( has_post_thumbnail() ) : ?>
	<?php
	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	?>
	<div style="background-image: url('<?php echo $image[0]; ?>');
		height:<?php echo $image[2]; ?>px;"
	     class="image-container">

		<div class="container">
			<div class="address">
				<?php echo wpautop( get_option( '_inosencio_address', '' ) ); ?>
			</div>

			<p class="meta">
				<?php echo get_option( '_inosencio_phone', '' ); ?>
				<br/>
				<a href="mailto:<?php echo $email = get_option( '_inosencio_email', '' ); ?>"><?php echo $email; ?></a>
			</p>
		</div>
	</div>
<?php endif; ?>

	<div class="row">
		<section class="columns small-12">
			<div class="page-content">
				<?php the_content(); ?>
			</div>

			<?php
			if ( function_exists( 'gravity_form' ) && $form_ID = get_post_meta( get_the_ID(), '_inosencio_form', true ) ) {
				gravity_form(
					$form_ID,
					$display_title = false,
					$display_description = false,
					$display_inactive = false,
					$field_values = null,
					$ajax = false
				);
			}
			?>
		</section>
	</div>

<?php
get_footer();