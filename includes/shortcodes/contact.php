<?php
/**
 * Shortcodes: Phone, Email, Address.
 *
 * Displays company phone number.
 *
 * @since   1.0.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'init', function () {

	add_shortcode( 'phone', '_inosencio_sc_phone' );
	add_shortcode( 'email', '_inosencio_sc_email' );
	add_shortcode( 'address', '_inosencio_sc_address' );
} );

function _inosencio_sc_phone( $atts = array() ) {

	$atts = shortcode_atts( array(
		'icon' => 'no',
	), $atts );

	$phone = get_option( '_inosencio_phone', '555-555-5555' );

	$html = '';
	$html .= $atts['icon'] == 'yes' ? '<span class="fa fa-mobile"></span>&nbsp;&nbsp;' : '';
	$html .= wp_is_mobile() ? "<a href=\"tel:$phone\">$phone</a>" : $phone;

	return $html;
}

function _inosencio_sc_email( $atts = array() ) {

	$atts = shortcode_atts( array(
		'icon' => 'yes',
	), $atts );

	$email = get_option( '_inosencio_email', 'email@example.com' );

	$html = '';
	$html .= $atts['icon'] == 'yes' ? '<span class="fa fa-envelope"></span>&nbsp;&nbsp;' : '';
	$html .= "<a href=\"mailto:$email\">$email</a>";

	return $html;
}

function _inosencio_sc_address() {

	$address = get_option( '_inosencio_address', "1 Example St\nCity, ST 55555" );
	return wpautop( do_shortcode( $address ) );
}