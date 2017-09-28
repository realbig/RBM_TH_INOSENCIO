<?php
/**
 * Shortcodes: Phone, Email, Address, Fax.
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
	add_shortcode( 'fax', '_inosencio_sc_fax' );
	add_shortcode( 'hours', '_inosencio_sc_hours' );
} );

function _inosencio_sc_phone( $atts = array() ) {

	$atts = shortcode_atts( array(
		'icon' => 'no',
		'link' => 'yes',
	), $atts );

	$phone = get_option( '_inosencio_phone', '555-555-5555' );

	$html = '';
	$html .= $atts['icon'] == 'yes' ? '<span class="fa fa-mobile"></span>&nbsp;&nbsp;' : '';
	$html .= wp_is_mobile() && $atts['link'] == 'yes' ? "<a class=\"mobile-link\" href=\"tel:$phone\">$phone</a>" : $phone;

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

function _inosencio_sc_hours() {

	$hours = get_option( '_inosencio_hours', "Monday - Thursday 8:00am - 5:00pm\nFriday 8:00am - 4:00pm" );
	return wpautop( do_shortcode( $hours ) );
}

function _inosencio_sc_fax( $atts = array() ) {

	$atts = shortcode_atts( array(
		'icon' => 'no',
		'link' => 'yes',
	), $atts );

	$fax = get_option( '_inosencio_fax', '555-555-5555' );

	$html = '';
	$html .= $atts['icon'] == 'yes' ? '<span class="fa fa-fax"></span>&nbsp;&nbsp;' : '';
	$html .= wp_is_mobile() && $atts['link'] == 'yes' ? "<a class=\"mobile-link\" href=\"tel:$fax\">$fax</a>" : $fax;

	return $html;
}