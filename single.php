<?php
/**
 * The theme's single file use for displaying single posts.
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

	<div class="row">
		<section class="columns small-12 medium-8">
			
			<div class="page-content">
				
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="thumbnail">
						<?php the_post_thumbnail( 'medium', array(
							'class' => 'attachment-medium size-medium wp-post-image alignleft',
						) ); ?>
					</div>
				<?php endif; ?>
				
				<?php the_content(); ?>
			</div>

			<?php comments_template(); ?>
		</section>

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();