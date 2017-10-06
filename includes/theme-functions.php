<?php
/**
 * Adds theme functions.
 *
 * @since   0.1.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_filter( 'gform_field_content', '_inosencio_gform_column_splits', 10, 5 );
add_filter( 'gform_get_form_filter', '_inosencio_gform_do_shortcode' );

function inosencio_get_menu_by_location( $location ) {

	if ( empty( $location ) ) {
		return false;
	}

	$locations = get_nav_menu_locations();
	if ( ! isset( $locations[ $location ] ) ) {
		return false;
	}

	$menu_obj = get_term( $locations[ $location ], 'nav_menu' );

	return $menu_obj;
}

function _inosencio_gform_column_splits( $content, $field, $value, $lead_id, $form_id ) {

	if ( ! IS_ADMIN ) { // only perform on the front end

		// target section breaks
		if ( $field['type'] == 'section' ) {
			$form = RGFormsModel::get_form_meta( $form_id, true );

			// check for the presence of multi-column form classes
			$form_class         = explode( ' ', $form['cssClass'] );
			$form_class_matches = array_intersect( $form_class, array( 'gform_columns' ) );

			// check for the presence of section break column classes
			$field_class         = explode( ' ', $field['cssClass'] );
			$field_class_matches = array_intersect( $field_class, array( 'gform_column_split' ) );

			// if field is a column break in a multi-column form, perform the list split
			if ( ! empty( $form_class_matches ) && ! empty( $field_class_matches ) ) { // make sure to target only multi-column forms

				// retrieve the form's field list classes for consistency
				$form              = RGFormsModel::add_default_properties( $form );
				$description_class = rgar( $form, 'descriptionPlacement' ) == 'above' ? 'description_above' : 'description_below';

				// close current field's li and ul and begin a new list with the same form field list classes
				return '</li></ul><ul class="gform_fields ' . $form['labelPlacement'] . ' ' . $description_class . ' ' . $field['cssClass'] . '"><li class="gfield gsection empty">';

			}
		}
	}

	return $content;
}

function _inosencio_gform_do_shortcode( $form_string ) {
	return do_shortcode( $form_string );
}