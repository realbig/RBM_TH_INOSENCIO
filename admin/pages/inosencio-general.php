<?php
/**
 * Provides an options page for the theme.
 *
 * @since   1.0.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'admin_menu', function() {
	add_options_page(
		'Inosencio Settings',
		'Inosencio Settings',
		'manage_options',
		'inosencio-settings',
		'_inosencio_page_inosencio_settings_output'
	);
});

function _inosencio_page_inosencio_settings_output() {

	// Include template
	include_once __DIR__ . '/views/html-inosencio-settings.php';
}

// Register settings
add_action( 'admin_init', function() {

	register_setting( 'inosencio-settings', '_inosencio_phone' );
	register_setting( 'inosencio-settings', '_inosencio_fax' );
	register_setting( 'inosencio-settings', '_inosencio_email' );
	register_setting( 'inosencio-settings', '_inosencio_address' );
});