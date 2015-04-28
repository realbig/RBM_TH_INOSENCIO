<?php
/**
 * Firm Overview extra meta.
 *
 * @since   1.0.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', '_inosencio_add_metaboxes_firm_overview' );
add_action( 'save_post', '_inosencio_save_metaboxes_firm_overview' );

function _inosencio_add_metaboxes_firm_overview() {

	global $post;

	if ( get_post_meta( $post->ID, '_wp_page_template', true ) != 'page-templates/firm-overview.php' ) {
		return;
	}

	add_meta_box(
		'inosencio_mb_firm_overview_extra',
		'Home Information',
		'_inosencio_mb_firm_overview_extra_callback',
		'page'
	);
}

function _inosencio_mb_firm_overview_extra_callback() {

	global $post;

	wp_nonce_field( __FILE__, 'inosencio_mb_firm_overview_extra_nonce' );

	$quote = get_post_meta( $post->ID, '_inosencio_firm_overview_quote', true );
	?>

	<p>
		<label>
			Highlight Quote:
			<br/>
			<textarea class="widefat" name="_inosencio_firm_overview_quote"
			       ><?php echo $quote; ?></textarea>
		</label>
	</p>
<?php
}

function _inosencio_save_metaboxes_firm_overview( $post_ID ) {

	if ( ! isset( $_POST['inosencio_mb_firm_overview_extra_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['inosencio_mb_firm_overview_extra_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_inosencio_firm_overview_quote',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}