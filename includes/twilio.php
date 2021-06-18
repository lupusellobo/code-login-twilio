<?php

namespace codelogintwilio\includes;

use lld\helpers\Mustache_helper;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class Twilio_sender {
	public function __construct() {
		add_action( 'code_login_send_code', [ $this, 'send_code' ], 10, 2 );
	}

	public function send_code( $user, $code ) {
		$body = Mustache_helper::get_instance()->render_str( get_option('codelogin_twilio_message'), [
			'name' => $user->first_name,
			'code' => $code,
			'timeout' => number_format( (int) get_option( 'codelogin_timeout' ) / 60, 0 ),
		], false  );


		try {
			$client = new Client(get_option('codelogin_twilio_account_sid'), get_option('codelogin_twilio_auth_token'));
			$response = $client->messages->create(
				'+'. ( get_user_meta( $user->ID, 'country_code', true ) ?? '57' ) . $user->user_login,
				[
					'from' => get_option('codelogin_twilio_from'),
					'body' => $body
				]
			);
			if ( function_exists("SimpleLogger") ) SimpleLogger()->info( "SMS sent", [ 'response' => $response->status ] );
			print_r( $response );
		} catch ( TwilioException $e ) {
//			print_r( $e );
			if ( function_exists("SimpleLogger") ) SimpleLogger()->alert( "SMS error", [ 'error' => $e->getMessage() ] );

		}
	}
}
$twilio = new Twilio_sender();
