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

	$style = '';
	if ( has_post_thumbnail() ) {

		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		$cta_height = get_post_meta( get_the_ID(), '_inosencio_home_cta_height', true );

		$style = 'style="background-image: url(\'';
		$style .= $image_src[0];
		$style .= '\');';
		$style .= 'height: ' . ( ( $cta_height ) ? $cta_height : '550' ) . 'px;';
		$style .= '"';
	}
	?>

	<section class="home-cta" <?php echo $style; ?>>

		<div class="container">

			<?php if ( $home_title = get_post_meta( get_the_ID(), '_inosencio_home_title', true ) ) : ?>
				<p>
					<?php echo $home_title; ?>
				</p>
			<?php endif; ?>

			<p class="call-to-action">
				Learn more <a href="/firm-overview/" class="button primary hollow white-border">about us</a>
			</p>

		</div>

	</section>

	<section class="home-about section green">
		
		<div class="row expanded small-collapse">
			
 			<div class="columns small-12 medium-6 text-container">
				
				<div class="row small-uncollapse vertical-align">
					<div class="columns small-12">
				
						<h1><?php the_title(); ?></h1>

						<?php if ( $sub_head = get_post_meta( get_the_ID(), '_inosencio_home_about_sub_head', true ) ) : ?>
							<p class="home-about-sub-head">
								<?php echo do_shortcode( $sub_head ); ?>
							</p>
						<?php endif; ?>
						
					</div>
				</div>
				
			</div>
			
			<div class="columns small-12 medium-6">
				
				<div class="row small-collapse">
					
					<?php 
					
						$attorneys = new WP_Query( array(
							'post_type' => 'attorney',
							'posts_per_page' => 4,
						) );
					
						if ( $attorneys->have_posts() ) : 
					
							while ( $attorneys->have_posts() ) : $attorneys->the_post(); ?>
					
								<div class="small-6 medium-3 columns">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php echo wp_get_attachment_image( rbm_get_field( 'attorney_small_image' ), 'medium', false, array( 'title' => get_the_title(), 'alt' => get_the_title() ) ); ?>
									</a>
								</div>
					
							<?php endwhile;
					
							wp_reset_postdata();
					
						endif;
					
					?>
					
				</div>
				
			</div>
			
		</div>
		
	</section>

	<section class="home-about-2 section white">

		<h1><?php echo get_post_meta( get_the_ID(), '_inosencio_home_about_2_title', true ); ?></h1>
		
		<div class="row">
 			<div class="columns small-12">

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
				
			</div>
		</div>

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

	<section class="home-social-stream section white">
		
		<div class="row">
			
			<?php
            $social_columns = get_theme_mod( 'inosencio_social_columns', 3 );
            for ( $index = 0; $index < $social_columns; $index++ ) {
                ?>

                    <div class="small-12 medium-<?php echo ( 12 / $social_columns ); ?> columns">
                        <?php dynamic_sidebar( 'social-' . ( $index + 1 ) ); ?>
                    </div>

                <?php
            }
            ?>
			
		</div>
		
	</section>

<?php
get_footer();