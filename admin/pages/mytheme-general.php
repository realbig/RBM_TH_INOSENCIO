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
		'Inosencio-settings',
		'_Inosencio_page_Inosencio_settings_output'
	);
});

function _Inosencio_page_Inosencio_settings_output() {

	// Include template
	include_once __DIR__ . '/views/html-Inosencio-settings.php';
}

// Register settings
add_action( 'admin_init', function() {

	register_setting( 'Inosencio-settings', '_Inosencio_phone' );
	register_setting( 'Inosencio-settings', '_Inosencio_fax' );
	register_setting( 'Inosencio-settings', '_Inosencio_email' );
	register_setting( 'Inosencio-settings', '_Inosencio_hours_office' );
	register_setting( 'Inosencio-settings', '_Inosencio_hours_condensed' );
});