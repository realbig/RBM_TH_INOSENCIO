<?php
/**
 * The theme's front-page file use for displaying the home page.
 *
 * @since   0.1.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_filter( 'inosencio_page_title', '__return_false' );

get_header();
the_post();

$practice_areas = get_posts( array(
	'post_type'   => 'practice_area',
	'numberposts' => 5,
	'orderby'     => 'menu_order',
	'order'       => 'ASC',
	'tax_query' => array(
		array(
			'taxonomy' => 'practice_area_category',
			'field' => 'slug',
			'terms' => 'home-banner',
		),
	),
) );

if ( ! empty( $practice_areas ) ) :

	$style = '';
	if ( has_post_thumbnail() ) {

		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

		$style = 'style="background-image: url(\'';
		$style .= $image_src[0];
		$style .= '\');"';
	}
	?>

	<section class="home-cta" <?php echo $style; ?>>

		<div class="container">

			<?php if ( $home_title = get_post_meta( get_the_ID(), '_inosencio_home_title', true ) ) : ?>
				<p>
					<?php echo $home_title; ?>
				</p>
			<?php endif; ?>

			<div class="practice-areas textillate text-center">
				<ul class="texts">

					<?php foreach ( $practice_areas as $practice_area ) : ?>
						<li><?php echo $practice_area->post_title; ?></li>
					<?php endforeach; ?>

				</ul>
			</div>

			<p class="call-to-action">
				Learn more <a href="/firm-overview/" class="button">about us</a>
			</p>

		</div>

	</section>

<?php endif; ?>

	<section class="home-about section green">

		<h1><?php the_title(); ?></h1>

		<?php if ( $sub_head = get_post_meta( get_the_ID(), '_inosencio_home_about_sub_head', true ) ) : ?>
			<p class="home-about-sub-head">
				<?php echo do_shortcode( $sub_head ); ?>
			</p>
		<?php endif; ?>

		<?php
		if ( $about_image = get_post_meta( get_the_ID(), '_inosencio_home_about_image', true ) ) :
			$about_image_src = wp_get_attachment_image_src( $about_image, 'full' );
			?>
			<div style="background-image: url('<?php echo $about_image_src[0]; ?>');
				height:<?php echo $about_image_src[2]; ?>px;"
			     class="image-container">
				<div class="container bottom">
					<?php echo do_shortcode( get_post_meta( get_the_ID(), '_inosencio_home_about_copy', true ) ); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php
		$practice_areas = get_posts( array(
			'post_type'   => 'practice_area',
			'orderby'     => 'menu_order',
			'order'       => 'ASC',
			'numberposts' => - 1,

		) );

		if ( ! empty( $practice_areas ) ) :
			?>
			<h3 class="practice-areas-heading">
				The areas in which we practice include:
			</h3>

			<ul class="practice-areas top-level small-block-grid-1 medium-block-grid-2">
				<?php
				foreach ( $practice_areas as $practice_area ) :

					if ( ! has_term( 'top-level', 'practice_area_category', $practice_area ) ) {
						continue;
					}
					?>
					<li>
						<div class="practice-area">
							<a href="<?php bloginfo( 'url' ); ?>/practice-areas/#<?php echo $practice_area->post_name; ?>">
								<?php if ( $icon = get_post_meta( $practice_area->ID, '_icon', true ) ) : ?>
									<p class="practice-area-icon fa fa-<?php echo $icon; ?>"></p>
								<?php endif; ?>

								<h4 class="practice-area-title">
									<?php echo $practice_area->post_title; ?>
								</h4>
							</a>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>

			<h3 class="practice-areas-heading">
				We’ve also represented clients concerning:
			</h3>

			<ul class="practice-areas small-block-grid-1 medium-block-grid-2">
				<?php
				foreach ( $practice_areas as $practice_area ) :
					if ( get_post_meta( $practice_area->ID, '_top_level', true ) ) {
						continue;
					}
					?>
					<li>
						<div class="practice-area">
							<a href="<?php bloginfo( 'url' ); ?>/practice-areas/#<?php echo $practice_area->post_name; ?>">
								<h4 class="practice-area-title">
									<?php echo $practice_area->post_title; ?>
								</h4>
							</a>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>

		<?php endif; ?>

	</section>

	<section class="home-about-2 section white">

		<h1><?php echo get_post_meta( get_the_ID(), '_inosencio_home_about_2_title', true ); ?></h1>

		<?php if ( $sub_head = get_post_meta( get_the_ID(), '_inosencio_home_about_2_sub_head', true ) ) : ?>
			<p class="home-about-sub-head">
				<?php echo do_shortcode( $sub_head ); ?>
			</p>
		<?php endif; ?>

		<?php
		if ( $about_2_image = get_post_meta( get_the_ID(), '_inosencio_home_about_2_image', true ) ) :
			$about_2_image_src = wp_get_attachment_image_src( $about_2_image, 'full' );
			?>
			<div style="background-image: url('<?php echo $about_2_image_src[0]; ?>');
				height:<?php echo $about_2_image_src[2]; ?>px;"
			     class="image-container">
				<div class="container">
					<?php echo do_shortcode( get_post_meta( get_the_ID(), '_inosencio_home_about_2_copy', true ) ); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($about_form = get_post_meta( get_the_ID(), '_inosencio_home_about_2_form', true ) && function_exists( 'gravity_form' )) : ?>

		<div class="row">
			<div class="columns small-12">

				<h2 class="text-left">
					Find out how we can help you with your case.
				</h2>

				<?php
				gravity_form(
					$about_form,
					$display_title = false,
					$display_description = false,
					$display_inactive = false,
					$field_values = null,
					$ajax = false
				);
				?>
				<?php endif; ?>

			</div>
		</div>
	</section>

<?php
get_footer();