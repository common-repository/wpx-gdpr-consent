<?php
/**
 * Plugin Name: WPX GDPR Consent
 * Description: A Light-Weight, Simple and Complete GDPR Consent Plugin for WordPress.
 * Plugin URI: http://sajib.me/plugins/wpx-gdpr-consent
 * Author: Sajib Talukder
 * Author URI: http://sajib.me
 * Version: 1.0.3
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wpx-gdpr-consent 
 */


defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Wpx_Gdpr_Consent {

	/**
	 * plugin version
	 * @var string
	 */
	const version = '1.0.3';
	
	/**
	 * class constructor
	 */
	function __construct(){
		$this->define_constants();		

		register_activation_hook( __FILE__ , [ $this, 'activate' ] ); 

		add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
	}

    /**
     * Initializes a singletone instance 
     * @return \Tbr_core
     */
	public static function init () {
		static $instance = false;

		if( ! $instance ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * Define the required plugin constants
	 * @return void
	 */
	public function define_constants() {
		define( 'WGC_VERSION', self::version );    
		define( 'WGC_FILE', __FILE__ );    
		define( 'WGC_PATH', __DIR__ );    
		define( 'WGC_URL', plugins_url( '', WGC_FILE ) );    
		define( 'WGC_ASSETS', WGC_URL . '/assets' );    
	}


	public function init_plugin() {

		new Wgc\Assets(); 

		if( is_admin() ){
			new Wgc\Admin();	
		} else {
			new Wgc\Frontend();	
		}
	}

	/**
	 * Do stuff uplon plugin activation
	 * @return void
	 */
	public function activate() {
		$installer = new Wgc\Installer();
		$installer->run();
	}
}

/**
 * Initializes the main plugin
 * @return \Wpx_Gdpr_Consent
 */
function wpx_gdpr_consent() {
	return Wpx_Gdpr_Consent::init();
}

// kick-off the plugin
wpx_gdpr_consent();
