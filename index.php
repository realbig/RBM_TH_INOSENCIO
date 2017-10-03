<?php
/**
 * The theme's index file used for displaying an archive of blog posts.
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
	return 'Blog';
}

get_header();
?>

<?php get_template_part( 'partials/loop/loop', get_post_type() ); ?>

<?php
get_footer();