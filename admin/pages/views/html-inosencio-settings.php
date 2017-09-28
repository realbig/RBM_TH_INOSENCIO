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

		<?php settings_fields( 'inosencio-settings' ); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="_inosencio_phone">
						Phone
					</label>
				</th>
				<td>
					<input type="text" name="_inosencio_phone" id="_inosencio_phone"
					       value="<?php echo esc_attr( get_option('_inosencio_phone') ); ?>" />

					<p class="description">
						<strong>Preferred Format:</strong> 555.555.5555
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_inosencio_fax">
						Fax
					</label>
				</th>
				<td>
					<input type="text" name="_inosencio_fax" id="_inosencio_fax"
					       value="<?php echo esc_attr( get_option('_inosencio_fax') ); ?>" />

					<p class="description">
						<strong>Preferred Format:</strong> 555.555.5555
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_inosencio_email">
						Email
					</label>
				</th>
				<td>
					<input type="text" name="_inosencio_email" id="_inosencio_email"
					       value="<?php echo esc_attr( get_option('_inosencio_email') ); ?>" />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_inosencio_address">
						Address
					</label>
				</th>
				<td>
					<div style="max-width: 500px;">
						<?php
						wp_editor( get_option( '_inosencio_address' ), '_inosencio_address', array(
							'textarea_name' => '_inosencio_address',
							'textarea_rows' => '10',
						));
						?>
					</div>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row">
					<label for="_inosencio_hours">
						Hours
					</label>
				</th>
				<td>
					<div style="max-width: 500px;">
						<?php
						wp_editor( get_option( '_inosencio_hours' ), '_inosencio_hours', array(
							'textarea_name' => '_inosencio_hours',
							'textarea_rows' => '10',
						));
						?>
					</div>
				</td>
			</tr>

		</table>

		<?php submit_button(); ?>

	</form>

</div>