<?php 

namespace Wgc\Admin;


/**
 * The Menu Handler Class
 */
class Menu {
    
    public $menu;
	
    /**
     * Constructor
     */
	function __construct() {

        $this->menu = new Settings();

		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
	}

    /**
     * Register the admin menu.
     *
     * @return void
     */
	public function admin_menu() {
        add_menu_page( __( 'WP GDPR', 'wpx-gdpr-consent' ), __( 'WP GDPR', 'wpx-gdpr-consent' ), 'manage_options', 'wgc_page', [ $this->menu, 'plugin_page' ], 'dashicons-unlock', 90 ); 
	}
 
}