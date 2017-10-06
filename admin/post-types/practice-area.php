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
		'supports'  => array( 'title', 'editor', 'page-attributes' ),
		'rewrite'   => array( 'slug' => 'practice-areas' ),
		'public'  => true,
		'show_ui' => true,
		'hierarchical' => true,
		'show_in_nav_menus' => true,
		'has_archive' => false,
	) );
} );

add_action( 'add_meta_boxes', function () {

	add_meta_box(
		'inosencio-practice_area-product-link',
		'Extra Meta',
		'_inosencio_metabox_practice_area_top_level',
		'practice_area',
		'side'
	);
} );

add_action( 'init', '_inosencio_practice_area_taxonomies' );
add_filter( 'manage_practice_area_posts_columns', '_inosencio_add_column_show_home' );
add_action( 'manage_practice_area_posts_custom_column', '_inosencio_column_show_home', 10, 2 );

function _inosencio_practice_area_taxonomies() {

	register_taxonomy( 'practice_area_category', 'practice_area', array(
		'hierarchical' => true,
	) );
}

/**
 * The form callback for the testimonial role.
 *ds
 *
 * @since  1.0.0
 * @access Private.
 *
 * @param object $post The current post object.
 */
function _inosencio_metabox_practice_area_top_level( $post ) {

	wp_nonce_field( __FILE__, 'practice_area_top_level_nonce' );

//	$top_level = get_post_meta( $post->ID, '_top_level', true );
	$icon      = get_post_meta( $post->ID, '_icon', true );
//	$show_home = get_post_meta( $post->ID, '_show_home', true );
	?>
<!--	<p>-->
<!--		<label>-->
<!--			Top Level --->
<!--			<input type="checkbox" value="1" name="_top_level" --><?php //checked( $top_level, '1' ); ?><!-- />-->
<!--		</label>-->
<!--	</p>-->

	<p>
		<label>
			Icon:
			<br/>
			<input type="text" class="widefat" value="<?php echo $icon; ?>" name="_icon"/>
		</label>
	</p>
<!--	<p>-->
<!--		<label>-->
<!--			Show on Home --->
<!--			<input type="checkbox" value="1" name="_show_home" --><?php //checked( $show_home, '1' ); ?><!-- />-->
<!--		</label>-->
<!--	</p>-->
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
//		'_top_level',
		'_icon',
//		'_show_home',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
} );

function _inosencio_add_column_show_home( $defaults ) {

	unset( $defaults['date'] );

//	$defaults['show_home'] = 'Show on Home';
//	$defaults['top_level'] = 'Top Level';
	$defaults['category'] = 'Category';

	return $defaults;
}

function _inosencio_column_show_home( $column_name, $post_ID ) {

	switch ( $column_name ) {
		case 'show_home':
			?>
			<span class="dashicons dashicons-<?php echo get_post_meta( $post_ID, '_show_home', true ) ? 'yes' : 'no'; ?>">
			</span>
			<?php
			break;

		case 'top_level':
			?>
			<span class="dashicons dashicons-<?php echo get_post_meta( $post_ID, '_top_level', true ) ? 'yes' : 'no'; ?>">
			</span> <?php echo get_post_meta( $post_ID, '_icon', true ); ?>
			<?php
			break;

		case 'category':

			$categories = wp_get_post_terms( $post_ID, 'practice_area_category' );

			if ( $categories ) {

				$i = 0;
				foreach ( $categories as $category ) {

					$i++;

					echo $category->name . ( $i < count( $categories ) ? ', ' : '' );
				}
			}
			break;
	}
}