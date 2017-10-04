<?php
/**
 * The theme's functions file that loads on EVERY page, used for uniform functionality.
 *
 * @since   0.1.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Make sure PHP version is correct
if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
	wp_die( 'ERROR in Inosencio theme: PHP version 5.3 or greater is required.' );
}

// Make sure no theme constants are already defined (realistically, there should be no conflicts)
if ( defined( 'THEME_VERSION' ) || defined( 'THEME_ID' ) || isset( $inosencio_fonts ) ) {
	wp_die( 'ERROR in Inosencio theme: There is a conflicting constant. Please either find the conflict or rename the constant.' );
}

/**
 * The theme's current version (make sure to keep this up to date!)
 */
define( 'THEME_VERSION', '0.1.0' );

/**
 * The theme's ID (used in handlers).
 */
define( 'THEME_ID', 'inosencio' );

/**
 * Fonts for the theme. Must be hosted font (Google fonts for example).
 */
$inosencio_fonts = array(
	'Open Sans' => 'http://fonts.googleapis.com/css?family=Open+Sans:700,800,300',
	'Font Awesome' => '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
);

// Extra image sizes
$inosencio_image_sizes = array(
	 'attorney' => array(
	 	'title' => 'Attorney',
	 	'width' => 1000,
	 	'height' => 400,
	 	'crop' => array( 'center', 'top' ),
	 ),
);

/**
 * Setup theme properties and stuff.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function() {

	global $inosencio_image_sizes;

	// Image sizes
	if ( ! empty( $inosencio_image_sizes ) ) {

		foreach ( $inosencio_image_sizes as $ID => $size ) {
			add_image_size( $ID, $size['width'], $size['height'], $size['crop'] );
		}

		add_filter( 'image_size_names_choose', '_inosencio_add_image_sizes' );
	}

	// Add theme support
	require_once __DIR__ . '/includes/theme-support.php';

	// Allow shortcodes in text widget
	add_filter('widget_text', 'do_shortcode');
});

/**
 * Adds support for custom image sizes.
 *
 * @since 0.1.0
 *
 * @param $sizes array The existing image sizes.
 *
 * @return array The new image sizes.
 */
function _inosencio_add_image_sizes( $sizes ) {

	global $inosencio_image_sizes;

	$new_sizes = array();
 	foreach ( $inosencio_image_sizes as $ID => $size ) {
	    $new_sizes[ $ID ] = $size['title'];
	}

	return array_merge( $sizes, $new_sizes );
}

/**
 * Register theme files.
 *
 * @since 0.1.0
 */
add_action( 'init', function () {

	global $inosencio_fonts;

	// Theme styles
	wp_register_style(
		THEME_ID,
		get_template_directory_uri() . '/style.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);

	// Theme script
	wp_register_script(
		THEME_ID,
		get_template_directory_uri() . '/script.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

	// Theme fonts
	if ( ! empty( $inosencio_fonts ) ) {
		foreach ( $inosencio_fonts as $ID => $link ) {
			wp_register_style(
				THEME_ID . "-font-$ID",
				$link
			);
		}
	}

	// Admin script
	wp_register_script(
		THEME_ID . '-admin',
		get_template_directory_uri() . '/admin.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

	// Animate CSS
	wp_register_style(
		THEME_ID . '-animate-css',
		get_template_directory_uri() . '/assets/css/animate.css',
		array( THEME_ID ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);

	// Lettering
	wp_register_script(
		THEME_ID . '-lettering',
		get_template_directory_uri() . '/assets/js/jquery.lettering.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : '0.7.0',
		true
	);

	// Chosen
	wp_register_script(
		THEME_ID . '-chosen',
		get_template_directory_uri() . '/lib/chosen/chosen.jquery.min.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

	// Chosen
	wp_register_style(
		THEME_ID . '-chosen',
		get_template_directory_uri() . '/lib/chosen/chosen.min.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);
} );

/**
 * Enqueue theme files.
 *
 * @since 0.1.0
 */
add_action( 'wp_enqueue_scripts', function () {

	global $inosencio_fonts;

	// Home page
	if ( is_front_page() ) {
		wp_enqueue_style( THEME_ID . '-animate-css' );
		wp_enqueue_script( THEME_ID . '-lettering' );
	}

	// Theme styles
	wp_enqueue_style( THEME_ID );

	// Theme script
	wp_enqueue_script( THEME_ID );

	// Theme fonts
	if ( ! empty( $inosencio_fonts ) ) {
		foreach ( $inosencio_fonts as $ID => $link ) {
			wp_enqueue_style( THEME_ID . "-font-$ID" );
		}
	}
} );

/**
 * Enqueue admin files.
 *
 * @since 0.1.0
 */
add_action( 'admin_enqueue_scripts', function () {

	// Admin script
	wp_enqueue_script( THEME_ID . '-admin' );

	// Chosen
	wp_enqueue_script( THEME_ID . '-chosen' );
	wp_enqueue_style( THEME_ID . '-chosen' );
} );

/**
 * Register nav menus.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function () {
	
	// Add Customer Controls
	require_once __DIR__ . '/includes/customizer.php';
	
	// Nav Walker for Foundation
    require_once __DIR__ . '/includes/class-foundation-nav-walker.php';

	register_nav_menu( 'primary', 'Primary Menu' );
	register_nav_menu( 'footer-a', 'Footer A' );
	register_nav_menu( 'footer-b', 'Footer B' );
	
} );

/**
 * Register sidebars.
 *
 * @since 0.1.0
 */
add_action( 'widgets_init', function () {

	// Page
	register_sidebar( array(
		'name' => 'Page',
		'id' => 'page',
		'description' => 'Displays on all pages.',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
	// Social
    $social_columns = get_theme_mod( 'inosencio_social_columns', 3 );
    for ( $index = 0; $index < $social_columns; $index++ ) {
        register_sidebar(
            array(
                'name'          =>  'Social ' . ( $index + 1 ),
                'id'            =>  'social-' . ( $index + 1 ),
                'description'   =>  sprintf( 'This is Social Widget Area %d', ( $index + 1 ) ),
                'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  =>  '</aside>',
                'before_title'  =>  '<h3 class="widget-title">',
                'after_title'   =>  '</h3>',
            )
        );
    }

	// Footer Left
	register_sidebar( array(
		'name' => 'Footer',
		'id' => 'footer-left',
		'description' => 'Displays in the footer',
		'before_widget' => '<div class="columns small-12">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
} );

require_once __DIR__ . '/includes/theme-functions.php';
require_once __DIR__ . '/admin/admin.php';

// Include shortcodes
require_once __DIR__ . '/includes/shortcodes/social.php';
require_once __DIR__ . '/includes/shortcodes/button.php';
require_once __DIR__ . '/includes/shortcodes/contact.php';

// Include widgets
require_once __DIR__ . '/includes/widgets/image.php';
require_once __DIR__ . '/includes/widgets/text-icon.php';
require_once __DIR__ . '/includes/widgets/social-stream.php';