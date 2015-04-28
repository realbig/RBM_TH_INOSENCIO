<?php
/**
 * Shortcodes: Facebook, Twitter, GooglePlus, YouTube.
 *
 * Social link shortcodes
 *
 * @since   1.0.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'init', function () {

	add_shortcode( 'facebook', '_inosencio_sc_facebook' );
	add_shortcode( 'twitter', '_inosencio_sc_twitter' );
	add_shortcode( 'googleplus', '_inosencio_sc_googleplus' );
	add_shortcode( 'youtube', '_inosencio_sc_youtube' );
	add_shortcode( 'linkedin', '_inosencio_sc_linkedin' );
} );

function _inosencio_sc_facebook( $atts = array() ) {

	$atts = shortcode_atts( array(
		'show_text' => 'no',
	), $atts );

	$html = "<span class=\"social-icon-facebook fa fa-facebook-square\"></span>";
	$html .= $atts['show_text'] == 'yes' ? '&nbsp;&nbsp;facebook' : '';

	return $html;
}

function _inosencio_sc_twitter( $atts = array() ) {

	$atts = shortcode_atts( array(
		'show_text' => 'no',
	), $atts );

	$html = "<span class=\"social-icon-twitter fa fa-twitter-square\"></span>";
	$html .= $atts['show_text'] == 'yes' ? '&nbsp;&nbsp;twitter' : '';

	return $html;
}

function _inosencio_sc_googleplus( $atts = array() ) {

	$atts = shortcode_atts( array(
		'show_text' => 'no',
	), $atts );

	$html = "<span class=\"social-icon-googleplus fa fa-google-square\"></span>";
	$html .= $atts['show_text'] == 'yes' ? '&nbsp;&nbsp;google' : '';

	return $html;
}

function _inosencio_sc_youtube( $atts = array() ) {

	$atts = shortcode_atts( array(
		'show_text' => 'no',
	), $atts );

	$html = "<span class=\"social-icon-youtube fa fa-youtube-square\"></span>";
	$html .= $atts['show_text'] == 'yes' ? '&nbsp;&nbsp;youtube' : '';

	return $html;
}

function _inosencio_sc_linkedin( $atts = array() ) {

	$atts = shortcode_atts( array(
		'show_text' => 'no',
	), $atts );

	$html = "<span class=\"social-icon-linkedin fa fa-linkedin-square\"></span>";
	$html .= $atts['show_text'] == 'yes' ? '&nbsp;&nbsp;linkedin' : '';

	return $html;
}