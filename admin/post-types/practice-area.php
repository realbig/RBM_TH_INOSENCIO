<?php
/**
 * Practice Area post type.
 *
 * @since   1.0.0
 * @package MyTheme
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'practice_area', 'Practice Area', 'Practice Areas', array(
		'menu_icon' => 'dashicons-book',
		'supports'  => array( 'title', 'editor' ),
		'rewrite'   => array( 'slug' => 'practice-areas' ),
		'public' => false,
		'show_ui' => true,
	) );
} );

add_action( 'add_meta_boxes', function () {

	add_meta_box(
		'inosencio-practice_area-product-link',
		'Product Link',
		'_inosencio_metabox_practice_area_top_level',
		'practice_area',
		'side'
	);
} );

/**
 * The form callback for the testimonial role.
 *ds
 * @since  1.0.0
 * @access Private.
 *
 * @param object $post The current post object.
 */
function _inosencio_metabox_practice_area_top_level( $post ) {

	wp_nonce_field( __FILE__, 'practice_area_top_level_nonce' );

	$top_level = get_post_meta( $post->ID, '_top_level', true );
	$icon = get_post_meta( $post->ID, '_icon', true );
	?>
	<p>
		<label>
			Top Level -
			<input type="checkbox" value="1" name="_top_level" <?php checked( $top_level, '1' ); ?> />
		</label>
	</p>

	<p>
		<label>
			Icon:
			<br/>
			<input type="text" class="widefat" value="<?php echo $icon; ?>" name="_icon" />
		</label>
	</p>
<?php
}

add_action( 'save_post', function ( $post_ID ) {

	if ( ! isset( $_POST['practice_area_top_level_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['practice_area_top_level_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_top_level',
		'_icon',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
} );