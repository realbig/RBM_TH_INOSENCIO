<?php
/**
 * Home extra meta.
 *
 * @since   1.0.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', '_inosencio_add_metaboxes_home' );
add_action( 'save_post', '_inosencio_save_metaboxes_home' );

function _inosencio_add_metaboxes_home() {

	global $post;

	if ( $post->post_name != 'home' ) {
		return;
	}

	// Disable editor
	remove_post_type_support( 'page', 'editor' );

	add_meta_box(
		'inosencio_mb_home_extra',
		'Home Information',
		'_inosencio_mb_home_extra_callback',
		'page'
	);
}

function _inosencio_mb_home_extra_callback() {

	global $post;

	wp_nonce_field( __FILE__, 'inosencio_mb_home_extra_nonce' );

	$about_sub_head = get_post_meta( $post->ID, '_inosencio_home_about_sub_head', true );
	$about_copy = get_post_meta( $post->ID, '_inosencio_home_about_copy', true );
	$about_image = get_post_meta( $post->ID, '_inosencio_home_about_image', true );
	$about_image_preview = $about_image ? wp_get_attachment_image_src( $about_image, 'medium' ) : '';

	$about_2_title = get_post_meta( $post->ID, '_inosencio_home_about_2_title', true );
	$about_2_sub_head = get_post_meta( $post->ID, '_inosencio_home_about_2_sub_head', true );
	$about_2_copy = get_post_meta( $post->ID, '_inosencio_home_about_2_copy', true );
	$about_2_image = get_post_meta( $post->ID, '_inosencio_home_about_2_image', true );
	$about_2_image_preview = $about_2_image ? wp_get_attachment_image_src( $about_2_image, 'medium' ) : '';
	$about_2_form = get_post_meta( $post->ID, '_inosencio_home_about_2_form', true );

	// Deal with missing images
	if ( ! $about_image_preview ) {
		delete_post_meta( $post->ID, '_inosencio_home_about_image' );
	}
	if ( ! $about_2_image_preview ) {
		delete_post_meta( $post->ID, '_inosencio_home_about_2_image' );
	}
	?>

	<p>
		<label>
			About Us Sub-Head:
			<br/>
			<input type="text" class="widefat" name="_inosencio_home_about_sub_head"
			       value="<?php echo $about_sub_head; ?>"/>
		</label>
	</p>

	<p>
		<label>
			About Us Copy:
			<br/>
			<textarea class="widefat" name="_inosencio_home_about_copy"><?php echo $about_copy; ?></textarea>
		</label>
	</p>

	<p>
		<label>
			About Us Image:
			<br/>
			<img src="<?php echo $about_image_preview[0]; ?>" class="image-preview" style="max-width: 100%; width: 300px;" />
			<br/>
			<input type="hidden" class="image-id" name="_inosencio_home_about_image"
			       value="<?php echo $about_image; ?>"/>
			<a class="image-button button">Upload / Choose Image</a>
		</label>
	</p>

	<h2>About Us 2</h2>

	<p>
		<label>
			About Us 2 Title:
			<br/>
			<input type="text" class="widefat" name="_inosencio_home_about_2_title"
			       value="<?php echo $about_2_title; ?>"/>
		</label>
	</p>

	<p>
		<label>
			About Us 2 Sub-Head:
			<br/>
			<input type="text" class="widefat" name="_inosencio_home_about_2_sub_head"
			       value="<?php echo $about_2_sub_head; ?>"/>
		</label>
	</p>

	<p>
		<label>
			About Us 2 Copy:
			<br/>
			<textarea class="widefat" name="_inosencio_home_about_2_copy"><?php echo $about_2_copy; ?></textarea>
		</label>
	</p>

	<p>
		<label>
			About Us 2 Image:
			<br/>
			<img src="<?php echo $about_2_image_preview[0]; ?>" class="image-preview" style="max-width: 100%; width: 300px;" />
			<br/>
			<input type="hidden" class="image-id" name="_inosencio_home_about_2_image"
			       value="<?php echo $about_2_image; ?>"/>
			<a class="image-button button">Upload / Choose Image</a>
		</label>
	</p>

	<p>
		<label>
			About Us 2 Form ID:
			<br/>
			<input type="text" name="_inosencio_home_about_2_form"
			       value="<?php echo $about_2_form; ?>"/>
		</label>
	</p>
<?php
}

function _inosencio_save_metaboxes_home( $post_ID ) {

	if ( ! isset( $_POST['inosencio_mb_home_extra_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['inosencio_mb_home_extra_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_inosencio_home_about_sub_head',
		'_inosencio_home_about_copy',
		'_inosencio_home_about_image',
		'_inosencio_home_about_2_title',
		'_inosencio_home_about_2_sub_head',
		'_inosencio_home_about_2_copy',
		'_inosencio_home_about_2_image',
		'_inosencio_home_about_2_form',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}