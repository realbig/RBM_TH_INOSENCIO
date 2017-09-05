<?php
/**
 * Shows the sidebar.
 *
 * @since   0.1.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<aside id="site-sidebar" class="columns small-12 medium-4">
	<?php
	if ( $sidebar = get_post_meta( get_the_ID(), '_sidebar', true ) ) {
		echo wpautop( do_shortcode( $sidebar ) );
	}
	?>
</aside>