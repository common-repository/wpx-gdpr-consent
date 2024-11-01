<?php 

namespace Tbr\Core;


/**
 * Ajax handler class
 */
class Ajax {
	
	function __construct() {
		add_action( 'wp_ajax_wgc_enquery', [ $this, 'enquery_submit' ] );
	}

	public function enquery_submit() {

		// check_ajax_referer( 'tbr-core-enquery-form' );
		
		if( ! wp_verify_nonce( $_POST['_wpnonce'], 'tbr-core-enquery-form' ) ){ 
			wp_send_json_error( [
				'message' => 'Nonce verification failed.'
			] );
		}


		// wp_send_json_success( [
		// 	'message' => 'Enquery has been sent successfully.'
		// ] );
		// 
		wp_send_json_error( [
			'message' => 'Something went wrong.'
		] );
	}
}