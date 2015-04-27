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

	add_shortcode( 'facebook', '_Inosencio_sc_facebook' );
	add_shortcode( 'twitter', '_Inosencio_sc_twitter' );
	add_shortcode( 'googleplus', '_Inosencio_sc_googleplus' );
	add_shortcode( 'youtube', '_Inosencio_sc_youtube' );
} );

function _Inosencio_sc_facebook( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-facebook-$atts[size] icon-facebook\"></span>";
}

function _Inosencio_sc_twitter( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-twitter-$atts[size] icon-twitter\"></span>";
}

function _Inosencio_sc_googleplus( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-googleplus-$atts[size] icon-google-plus\"></span>";
}

function _Inosencio_sc_youtube( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-youtube-$atts[size] icon-youtube\"></span>";
}