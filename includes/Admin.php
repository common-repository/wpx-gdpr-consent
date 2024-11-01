<?php 

namespace Wgc;

/**
 * The Admin Class
 */
class Admin {
	
	function __construct() { 
		new Admin\Menu(); 
		new Admin\Settings(); 
	}
}