<?php

namespace Wgc\Admin;

use WeDevs_Settings_API;

/**
 * Settings Class.
 *
 * @since 1.1
 */
class Settings {

    public $settings_api;

    /**
     * Constructor
     */
    public function __construct() {
        $this->settings_api = new WeDevs_Settings_API();

        add_action( 'admin_init', [$this, 'admin_init'] ); 
    }

    /**
     * Initialize the settings.
     *
     * @return void
     */
    public function admin_init() {
        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }
 

    /**
     * Plugin settings sections.
     *
     * @return array
     */
    public function get_settings_sections() {
        $sections = [
            [
                'id'    => 'wgc_general',
                'title' => __( 'General', 'wpx-gdpr-consent' ),
            ],
            [
                'id'    => 'wgc_custom_txt',
                'title' => __( 'Custom Text', 'wpx-gdpr-consent' ),
            ],
            [
                'id'    => 'wgc_style',
                'title' => __( 'Style', 'wpx-gdpr-consent' ),
            ],
            [
                'id'    => 'wgc_privacy',
                'title' => __( 'Privacy Policy', 'wpx-gdpr-consent' ),
            ],
            [
                'id'    => 'wgc_settings',
                'title' => __( 'Settings', 'wpx-gdpr-consent' ),
            ],
        ];

        return $sections;
    }

    /**
     * Returns all the settings fields.
     *
     * @return array settings fields
     */
    public function get_settings_fields() {
        $settings_fields = [
            'wgc_general' => [
                array(
                    'name'      => 'theme_display',
                    'label'     => __( 'Display Position', 'wpx-gdpr-consent' ),
                    'desc'      => __( '', 'wpx-gdpr-consent' ),
                    'type'      => 'radio',
                    'default'   => 'no',
                    'options'   => array(
                        'fb' => __( 'Footer Bottom', 'wpx-gdpr-consent' ), 
                        'ht' => __( 'Header Top', 'wpx-gdpr-consent' ), 
                        'fl' => __( 'Footer Left', 'wpx-gdpr-consent' ), 
                        'fr' => __( 'Footer Right', 'wpx-gdpr-consent' ), 
                        'no' => __( 'Hide', 'wpx-gdpr-consent' ), 
                    )
                ),
            ],
            'wgc_custom_txt' => [
                array(
                    'name'    => 'cokie_msg',
                    'label'   => __( 'Message', 'wedevs' ),
                    'desc'    => '',
                    'type'    => 'wysiwyg',
                    'default' => __('This website uses cookies to enhance your browsing experience.','wpx-gdpr-consent')
                ),
                array(
                    'name'              => 'cokie_btn',
                    'label'             => __( 'Button Text', 'wpx-gdpr-consent' ),
                    'desc'              => '',
                    'placeholder'       => __( 'Accept', 'wpx-gdpr-consent' ),
                    'type'              => 'text',
                    'default'           => __( 'Accept', 'wpx-gdpr-consent' ),
                    'sanitize_callback' => 'sanitize_text_field'
                ),  
            ],
            'wgc_style' => [
                array(
                    'name'    => 'msg_color',
                    'label'   => __( 'Message Text Color', 'wedevs' ),
                    'desc'    => '',
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'    => 'msg_bg_color',
                    'label'   => __( 'Message Background Color', 'wedevs' ),
                    'desc'    => '',
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'    => 'btn_color',
                    'label'   => __( 'Button Text Color', 'wedevs' ),
                    'desc'    => '',
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'    => 'btn_bg_color',
                    'label'   => __( 'Button Background Color', 'wedevs' ),
                    'desc'    => '',
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'    => 'privacy_color',
                    'label'   => __( 'Privacy Link Color', 'wedevs' ),
                    'desc'    => '',
                    'type'    => 'color',
                    'default' => ''
                ),
            ],
            'wgc_privacy' => [
                array(
                    'name'              => 'privacy_page',
                    'label'             => __( 'Privacy Policy page ', 'wpx-gdpr-consent' ),
                    'desc'              => '',
                    'type'              => 'select',
                    'default'           => '',
                    'options'           => $this->get_pages()
                ),  
                array(
                    'name'              => 'privacy_text',
                    'label'             => __( 'Custom Link Text', 'wpx-gdpr-consent' ),
                    'desc'              => '',
                    'placeholder'       => __( 'Privacy Policy', 'wpx-gdpr-consent' ),
                    'type'              => 'text',
                    'default'           => __( 'Privacy Policy', 'wpx-gdpr-consent' ),
                    'sanitize_callback' => 'sanitize_text_field'
                ),  
            ],
            'wgc_settings' => [
                array(
                    'name'              => 'a_cokie_duratin',
                    'label'             => __( 'Cookie Expire (in days)', 'wpx-gdpr-consent' ),
                    'desc'              => '',
                    'placeholder'       => __( '180', 'wpx-gdpr-consent' ),
                    'type'              => 'number',
                    'default'           => __( '180', 'wpx-gdpr-consent' ),
                    'sanitize_callback' => 'floatval'
                ), 
            ],
        ];

        return $settings_fields;
    }

    /**
     * The plguin page handler.
     *
     * @return void
     */
    public function plugin_page() {
        echo '<div class="wrap">';
        echo '<h1>WP GDPR Consent</h1>';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        $this->scripts();

        echo '</div>';
    }

    /**
     * Get all the pages.
     *
     * @return array page names with key value pairs
     */
    public function get_pages() {
        $pages_options = [ '' => __( '&mdash; Select a Page &mdash;', 'wpx-gdpr-consent' ) ];
        $pages         = get_pages( [
            'numberposts' => -1,
        ] );

        if ( $pages ) {
            foreach ( $pages as $page ) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

    /**
     * JS snippets.
     *
     * @return void
     */
    public function scripts() {
        ?>
        <script type="text/javascript">
            jQuery(function($) {
                $('input[name="wgc_settigns[email]"]:checkbox').on( 'change', function() {

                    if ( $(this).is(':checked' ) ) {
                        $('tr.email_to').show();
                    } else {
                        $('tr.email_to').hide();
                    }

                }).change();
            });
        </script>
        <?php
    }
}
