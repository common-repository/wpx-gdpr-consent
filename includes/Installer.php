<?php 

namespace Wgc;


/**
 * installer handler class
 */
class Installer {
	
	public function run() {
		$this->activate_version(); 
	}


	public function activate_version() {
		$installed = get_option( 'wgc_installed' );

		if( !$installed ){
			update_option( 'wgc_installed', time() );
		}

		update_option( 'wgc_version', WGC_VERSION );

	}
 

}