<?php
/**
 * Inosencio Settings page HTML.
 *
 * @since   1.0.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<div class="wrap">

	<h2>Inosencio Settings</h2>

	<form method="post" action="options.php">

		<?php settings_fields( 'Inosencio-settings' ); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="_Inosencio_phone">
						Phone
					</label>
				</th>
				<td>
					<input type="text" name="_Inosencio_phone" id="_Inosencio_phone"
					       value="<?php echo esc_attr( get_option('_Inosencio_phone') ); ?>" />

					<p class="description">
						<strong>Preferred Format:</strong> 555.555.5555
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_Inosencio_fax">
						Fax
					</label>
				</th>
				<td>
					<input type="text" name="_Inosencio_fax" id="_Inosencio_fax"
					       value="<?php echo esc_attr( get_option('_Inosencio_fax') ); ?>" />

					<p class="description">
						<strong>Preferred Format:</strong> 555.555.5555
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_Inosencio_email">
						Email
					</label>
				</th>
				<td>
					<input type="text" name="_Inosencio_email" id="_Inosencio_email"
					       value="<?php echo esc_attr( get_option('_Inosencio_email') ); ?>" />
				</td>
			</tr>


			<tr valign="top">
				<th scope="row">
					<label for="_Inosencio_hours_condensed">
						Hours (condensed)
					</label>
				</th>
				<td>
					<input type="text" name="_Inosencio_hours_condensed" id="_Inosencio_hours_condensed"
					       style="max-width: 100%; width: 500px;"
					       value="<?php echo get_option('_Inosencio_hours_condensed'); ?>" />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_Inosencio_hours_office">
						Office Hours
					</label>
				</th>
				<td>
					<div style="max-width: 100%; width:400px;">
						<?php
						wp_editor( get_option('_Inosencio_hours_office'), '_Inosencio_hours_office', array(
							'teeny' => true,
							'media_buttons' => false,
							'textarea_rows' => 6,
							'textarea_name' => '_Inosencio_hours_office',
						));
						?>
					</div>
				</td>
			</tr>

		</table>

		<?php submit_button(); ?>

	</form>

</div>