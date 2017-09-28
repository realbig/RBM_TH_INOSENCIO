<?php
/**
 * Attorney post type.
 *
 * @since   1.0.0
 * @package MyTheme
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'attorney', 'Attorney', 'Attorneys', array(
		'menu_icon' => 'dashicons-businessman',
		'supports'  => array( 'title', 'editor', 'thumbnail' ),
		'rewrite'   => array( 'slug' => 'attorneys' ),
		'public'    => false,
		'show_ui'   => true,
	) );
} );

add_action( 'add_meta_boxes', function () {

	add_meta_box(
		'inosencio-attorney-extra-meta',
		'Extra Meta',
		'_inosencio_metabox_attorney_extra_meta',
		'attorney'
	);
	
	add_meta_box(
		'inosencio-attorney-header-image',
		'Image With Backdrop',
		'_inosencio_metabox_attorney_header_image',
		'attorney',
		'side'
	);
	
} );

/**
 * The form callback for the testimonial role.
 *ds
 *
 * @since  1.0.0
 * @access Private.
 *
 * @param object $post The current post object.
 */
function _inosencio_metabox_attorney_extra_meta( $post ) {

	wp_nonce_field( __FILE__, 'attorney_extra_meta_nonce' );

	$attorney_title          = get_post_meta( $post->ID, '_attorney_title', true );
	$selected_practice_areas = get_post_meta( $post->ID, '_practice_areas', true );
	$sidebar                 = get_post_meta( $post->ID, '_sidebar', true );

	$practice_areas = get_posts( array(
		'post_type'   => 'practice_area',
		'numberposts' => - 1,
	) );
	?>
	<p>
		<label>
			Attorney Title -
			<input type="text" class="widefat" value="<?php echo esc_attr( $attorney_title ); ?>"
			       name="_attorney_title"/>
		</label>
	</p>

	<p>
		<label>
			Practice Areas
			<br/>
			<?php
			if ( ! empty( $practice_areas ) ) {
				?>
				<select name="_practice_areas[]" multiple data-placeholder="Select all practice areas"
				        class="widefat chosen">
					<option></option>
					<?php
					foreach ( $practice_areas as $practice_area ) {
						?>
						<option value="<?php echo $practice_area->ID; ?>"
							<?php echo in_array( $practice_area->ID, (array) $selected_practice_areas ) ? 'selected' : ''; ?>>
							<?php echo $practice_area->post_title; ?>
						</option>
					<?php
					}
					?>
				</select>
			<?php
			}
			?>
		</label>
	</p>

	<p>
		Sidebar
		<br/>
		<?php
		wp_editor( $sidebar, '_sidebar', array(
			'textarea_name' => '_sidebar',
		));
		?>
	</p>
<?php
}

function _inosencio_metabox_attorney_header_image( $post ) {
	
	rbm_do_field_media(
        'attorney_header_image',
        'Image With Backdrop',
        false,
        array(
			'description' => 'This is used for the Individual Attorney Pages',
            'type' => 'image',
            'button_text' => 'Upload/Choose Image',
            'button_remove_text' => 'Remove Image',
            'window_title' => 'Choose Image',
            'window_button_text' => 'Use Image',
        )
    );
	
}

add_action( 'save_post', function ( $post_ID ) {

	if ( ! isset( $_POST['attorney_extra_meta_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['attorney_extra_meta_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_attorney_title',
		'_practice_areas',
		'_sidebar',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
} );