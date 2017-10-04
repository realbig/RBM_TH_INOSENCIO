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

	<div class="row">
		<section class="columns small-12 medium-8">
			
			<div class="row">

				<div class="page-content small-12 columns">

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="thumbnail">
							<?php the_post_thumbnail( 'medium', array(
								'class' => 'attachment-medium size-medium wp-post-image alignleft',
							) ); ?>
						</div>
					<?php endif; ?>

					<?php the_content(); ?>

				</div>

				<div class="small-12 columns">

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
					else {
						
						$theme_locations = get_nav_menu_locations();
						$theme_location = 'primary';
						
						$menu_obj = get_term( $theme_locations[$theme_location], 'nav_menu' );
						
						$menu_items = wp_get_nav_menu_items( $menu_obj->name );
						
						$menu_item_parent_id = 0;
						$practice_areas = array();
						foreach ( $menu_items as $menu_item ) {
							
							if ( $menu_item->type == 'post_type_archive' && 
							   $menu_item->object == 'practice_area' ) {
								
								// Use this later to grab our items
								$menu_item_parent_id = $menu_item->ID;
								break;
								
							}
							
						}
						
						// We unfortunately have to loop twice to ensure we grabbed the Menu Item Parent ID in time
						foreach ( $menu_items as $menu_item ) {
							
							if ( $menu_item->menu_item_parent == $menu_item_parent_id ) {
								
								// We need to modify the object a little to make it look like what the code originally meant for get_posts() expects
								
								$menu_item->post_title = $menu_item->title;
								
								$post_name = rtrim( $menu_item->url, '/' );
								$post_name = substr( $post_name, strrpos( $post_name, '/' ) + 1 );
								
								$menu_item->post_name = $post_name;
								
								$practice_areas[] = $menu_item;
								
							}
							
						}
						
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

				</div>
				
			</div>
				
		</section>

		<?php get_sidebar( 'attorney' ); ?>
	</div>

<?php
get_footer();