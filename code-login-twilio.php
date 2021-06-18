<?php
/**
 * Plugin Name: code-login-twilio
 * Plugin URI: http://www.laligad.com
 * Description: code login connector for twilio
 * Version: 0.0.4
 * Author: lld
 * Author URI: http:/www.laligad.com
 * License: GPL2
 * Text Domain: code-login-twilio
 * Domain Path: /languages
 */

namespace codelogintwilio;

use Mustache_Autoloader;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

if ( ! defined( 'ABSPATH' ) )	exit;

define( 'CODE_LOGIN_TWILIO_URI', dirname(__FILE__).'/' );
define( 'CODE_LOGIN_TWILIO_URL', plugins_url( '', __FILE__ ) );
define( 'CODE_LOGIN_TWILIO_PATH', plugin_dir_path( __FILE__ ) );

class Code_Login_Twilio {
	public function __construct() {
		if ( !class_exists( 'Mustache_Autoloader' ) ) {
			include_once( CODE_LOGIN_TWILIO_PATH . 'vendor/mustache/mustache/src/Mustache/Autoloader.php' );
			include_once( CODE_LOGIN_TWILIO_PATH . 'helpers/Mustache_helper.php' );
			Mustache_Autoloader::register();
		}

		if ( class_exists( '\lld\helpers\Mustache_helper' ) ) {
			\lld\helpers\Mustache_helper::get_instance()->init(new Mustache_Engine([
				'partials_loader' => new Mustache_Loader_FilesystemLoader( CODE_LOGIN_TWILIO_URI . 'components' )
			]));
		}

		include_once( CODE_LOGIN_TWILIO_PATH . 'vendor/Twilio/autoload.php' );
		include_once( CODE_LOGIN_TWILIO_PATH . 'includes/admin.php' );
		include_once( CODE_LOGIN_TWILIO_PATH . 'includes/twilio.php' );

	}
}

$code_login_twilio = new Code_Login_Twilio();
