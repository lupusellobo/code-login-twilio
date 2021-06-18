<?php

namespace codelogintwilio\includes;

class Admin_Page {
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'create_menu' ] );
	}

	public function create_menu() {
		add_menu_page('Code Login Twilio settings', 'Code Login Twilio Settings', 'administrator', __FILE__, [ $this, 'settings_page' ] , 'dashicons-archive' );
		add_action( 'admin_init', [ $this, 'settings' ] );
	}

	public function settings() {
		register_setting( 'codelogin-settings-twilio-group', 'codelogin_twilio_account_sid' );
		register_setting( 'codelogin-settings-twilio-group', 'codelogin_twilio_auth_token' );
		register_setting( 'codelogin-settings-twilio-group', 'codelogin_twilio_from' );
		register_setting( 'codelogin-settings-twilio-group', 'codelogin_twilio_message' );

	}

	public function settings_page() {
		?>
		<div class="wrap">
		<h1><?php _e( 'Code Login Settings', 'code-login-twilio' ) ?></h1>

		<form method="post" action="options.php">
		<?php settings_fields( 'codelogin-settings-twilio-group' ); ?>
		<?php do_settings_sections( 'codelogin-settings-twilio-group' ); ?>
		<table class="form-table">
			<tbody>
			<tr>
				<td colspan="2"><h2><?php _e( 'Request Code', 'code-login-twilio' ) ?></h2></td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'Twilio Account SID', 'code-login-twilio' ) ?></th>
				<td>
					<input type="text" id="codelogin_twilio_account_sid" name="codelogin_twilio_account_sid" value="<?php echo get_option( 'codelogin_twilio_account_sid' ) ?>" >
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'Twilio Auth Token', 'code-login-twilio' ) ?></th>
				<td>
					<input type="text" id="codelogin_twilio_auth_token" name="codelogin_twilio_auth_token" value="<?php echo get_option( 'codelogin_twilio_auth_token' ) ?>" >
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'From', 'code-login-twilio' ) ?></th>
				<td>
					<input type="text" id="codelogin_twilio_from" name="codelogin_twilio_from" value="<?php echo get_option( 'codelogin_twilio_from' ) ?>" >
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'Code Form Text', 'code-login-twilio' ) ?></th>
				<td>
					<h4><?php _e( 'Codes', 'code-login' ) ?></h4>
					<p><?php _e( 'name {{name}}', 'code-login' ) ?></p>
					<p><?php _e( 'code {{code}}', 'code-login' ) ?></p>
					<p><?php _e( 'timeout {{timeout}} *in minutes', 'code-login' ) ?></p>
					<textarea id="codelogin_twilio_message" name="codelogin_twilio_message" rows="5" cols="80"><?php echo get_option('codelogin_twilio_message'); ?></textarea>
				</td>
			</tr>

			</tbody>
		</table>

		<?php submit_button(); ?>
		<?php
	}
}
$admin_page = new Admin_Page();
