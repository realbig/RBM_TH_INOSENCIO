<?php
/**
 * Adds Customizer Functionality
 * 
 * @since   {{VERSION}}
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Adds custom Customizer Controls.
 *
 * @since {{VERSION}}
 */
add_action( 'customize_register', function( $wp_customize ) {

	// General Theme Options
	$wp_customize->add_section( 'inosencio_customizer_section' , array(
			'title'      => 'Inosencio &amp; Fisk Settings',
			'priority'   => 30,
		) 
	);

	$wp_customize->add_setting( 'inosencio_social_columns', array(
			'default'     => 3,
			'transport'   => 'refresh',
		)
	);
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'inosencio_social_columns', array(
		'type' => 'number',
		'label'      => 'Number of Social Columns/Widget Areas',
		'section'    => 'inosencio_customizer_section',
		'settings'   => 'inosencio_social_columns',
		'active_callback' => 'is_front_page',
	) ) );
	
} );