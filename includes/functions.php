<?php 

/**
* Get the value of a settings field
*
* @param string $option settings field name
* @param string $section the section name this field belongs to
* @param string $default default text if it's not found
* @return mixed
*/
function wgc_get_option( $option, $section, $default = '' ) {
 
    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
    	return $options[$option];
    }
 
    return $default;
}


if(!function_exists('wgc_gdpr_is_accepted')) {
	function wgc_gdpr_is_accepted() {
		$currentState = \Wgc\ArrayHelper::get($_COOKIE, 'wgc_gdpr_permission', false);
		$status = false;
		if($currentState == 'accepted') {
			$status = true;
		}
		return apply_filters('wgc_gdpr_is_accepted', $status);
	}
}
 