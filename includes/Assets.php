<?php 

namespace Wgc;
 
/**
 * Scripts and Styles Class
 */
class Assets {

    function __construct() {

        if ( is_admin() ) {
            add_action( 'admin_enqueue_scripts', [ $this, 'register' ], 5 );
        } else {
            add_action( 'wp_enqueue_scripts', [ $this, 'register' ], 5 );
            // add_action( 'wp_head', [ $this, 'custom_css' ] );
        }
    }

    public function custom_css() {
 

        ?>
            <style>
                 
            </style>
        <?php
    }

    /**
     * Register scripts and styles
     *
     * @return void
     */
    public function register() {
        $this->register_scripts( $this->get_scripts() );
        $this->register_styles( $this->get_styles() );
        $this->enqueue_assets();
        $this->register_localize();
    }

    /**
     * Register scripts
     *
     * @param  array $scripts
     *
     * @return void
     */
    private function register_scripts( $scripts ) { 
        foreach ( $scripts as $handle => $script ) {
            $deps      = isset( $script['deps'] ) ? $script['deps'] : false;
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : true;
            $version   = isset( $script['version'] ) ? $script['version'] : CRM_VERSION;

            wp_register_script( $handle, $script['src'], $deps, $version, $in_footer );
        }
    }

    /**
     * Register styles
     *
     * @param  array $styles
     *
     * @return void
     */
    public function register_styles( $styles ) {
        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;
            $version   = isset( $style['version'] ) ? $style['version'] : CRM_VERSION;

            wp_register_style( $handle, $style['src'], $deps, $version );
        }
    }

    /**
     * Get all registered scripts
     *
     * @return array
     */
	public function get_scripts() {
		return [
			'wgc-scripts' => [
				'src'     => WGC_ASSETS . '/js/frontend.js',
				'version' => filemtime( WGC_PATH . '/assets/js/frontend.js' ), 
				'deps'    => ['jquery']
			],  
			'wgc-admin-scripts' => [
				'src'     => WGC_ASSETS . '/js/admin-scripts.js',
				'version' => filemtime( WGC_PATH . '/assets/js/admin-scripts.js' ), 
				'deps'    => ['jquery']
			],  
		]; 
	}

    /**
     * Get all registered styles
     *
     * @return array
     */
	public function get_styles() {
		return [ 
			'wgc-style' => [
				'src'     => WGC_ASSETS . '/css/frontend.css',
				'version' => filemtime( WGC_PATH . '/assets/css/frontend.css' ),
			],  
			'wgc-admin-style' => [
				'src'     => WGC_ASSETS . '/css/admin.css',
				'version' => filemtime( WGC_PATH . '/assets/css/admin.css' ),
			],  
		];
	}

    /**
     * Enqueue assets
     *
     * @return void
     */
    public function enqueue_assets() {
    	// Enqueue to Frontend
        if ( ! is_admin() ) { 

            wp_enqueue_style( 'wgc-style' );   
            wp_enqueue_script( 'wgc-scripts' );     
        }

        // Enqueue to Backend
        if ( is_admin() ) { 
 
            wp_enqueue_style( 'wgc-admin-style' ); 
            wp_enqueue_script( 'wgc-admin-scripts' );  

        }
    }

    /**
     * Set localize script data
     * 
     * @return void
     */
	public function register_localize() {
 		
 		$localize_data = [
			'ajaxurl' => admin_url( 'admin-ajax.php' ), 
            'template' => wgc_get_option('theme_display','wgc_general','')
		];

		wp_localize_script( 'wgc-scripts', 'wgcData', $localize_data );
		
	}
}
 