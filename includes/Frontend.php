<?php 

namespace Wgc;
/**
 * The Frontend Class
 */
class Frontend {
	
	/**
	 * Initilaize the class
	 */
	function __construct() {

		add_action( 'wp_footer', [ $this, 'gdprNotice' ] );
	}

	/**
	 * Shortcode handler class
	 * @param  array $atts
	 * @param  string $content 
	 * @return string
	 */
	public function gdprNotice() {
		if ( is_admin() ) {
			return;
		}
		
		$hasCookie = wgc_gdpr_is_accepted();
		 
		if ( $hasCookie ) {
			return;
		}

		$theme_display = wgc_get_option('theme_display','wgc_general','');  
  		if ( ! $theme_display || $theme_display == 'no' ) {
			return;
		}

		$cokie_msg     = wgc_get_option('cokie_msg','wgc_custom_txt',__('This website uses cookies to enhance your browsing experience.','wpx-gdpr-consent'));
		$cokie_btn     = wgc_get_option('cokie_btn','wgc_custom_txt',__('Accept','wpx-gdpr-consent'));

		$privacy_page     = wgc_get_option('privacy_page','wgc_privacy','');
		$privacy_text     = wgc_get_option('privacy_text','wgc_privacy','');
		 	 
		ob_start();

		include __DIR__ . '/views/gdpr_frontend.php';

		$content = ob_get_clean();
		echo html_entity_decode( $content );

	}
}