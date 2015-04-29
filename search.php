<?php
/**
 * Search page
 *
 * @since 0.1.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_filter( 'inosencio_page_title', '_inosencio_page_title_blog' );

function _inosencio_page_title_blog() {
	return 'Search';
}

get_header();
?>

<?php if ( have_posts() ) : ?>
	<section class="blog-posts row">

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'columns', 'small-12' ) ); ?>>
			<h2 class="post-title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>

			<div class="post-excerpt">
				<?php the_excerpt(); ?>
			</div>

			<a href="<?php the_permalink(); ?>" class="button">
				Read More
			</a>
		</article>

	<?php endwhile; ?>

	</section>
<?php endif; ?>

<?php
get_footer();