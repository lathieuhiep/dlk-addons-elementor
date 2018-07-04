<?php
/*
Plugin Name: DLK Addons for Elementor
Plugin URI: https://www.facebook.com/lathieuhiep
Description: The ultimate elements library for Elementor page builder plugin for WordPress.
Version: 1.0.0
Author: La Thiếu Hiệp
Author URI: https://www.facebook.com/lathieuhiep
License: MIT License
Text Domain: dlk-addons-elementor
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( !class_exists( 'dlk_addons_elementor' ) ) :

    class dlk_addons_elementor {

        /*
        * This method loads other methods of the class.
        */
        function __construct() {

            /* Load define */
            $this->dlk_addons_elementor_define();

            /* Load check Elementor installed and activated */
            add_action( 'plugins_loaded', [ $this, 'dlk_addons_elementor_loaded' ] );

            /*Load script*/
            $this->dlk_addons_elementor_script();

        }

        /* Load define */
        function dlk_addons_elementor_define() {

            define('DLK_VERSION', '1.0.0');

            define( 'dlk_addons_elementor_path', plugins_url( '/', __FILE__ ) );

            define( 'dlk_addons_elementor_server_path', dirname( __FILE__ ) );

        }

        function dlk_addons_elementor_loaded() {

            /* Load languages */
            $this->dlk_addons_elementor_i18n();

            /* Load check Elementor installed and activated */
            if ( ! did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', [ $this, 'dlk_addons_elementor_admin_notice' ] );
                return;
            }

            /* Load includes */
            $this->dlk_addons_elementor_includes();

        }

        /* Load languages */
        function dlk_addons_elementor_i18n() {

            load_plugin_textdomain( 'dlk-addons-elementor', false, dlk_addons_elementor_path . 'languages' );

        }

        /* admin notice */
        function dlk_addons_elementor_admin_notice() {

            if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

            $dlk_addons_elementor_message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
                esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'dlk-addons-elementor' ),
                '<strong>' . esc_html__( 'DLK Addons for Elementor', 'dlk-addons-elementor' ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', 'dlk-addons-elementor' ) . '</strong>'
            );

            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $dlk_addons_elementor_message );

        }

        /* Load includes */
        function dlk_addons_elementor_includes() {

            require_once ( dlk_addons_elementor_server_path . '/includes/addons-elementor.php' );

        }

        /* Load script */
        function dlk_addons_elementor_script() {

            add_action( 'wp_enqueue_scripts', [ $this, 'dlk_addons_elementor_frontend_scripts' ] );

        }

        /* Frontend scripts */
        function dlk_addons_elementor_frontend_scripts() {

            wp_enqueue_style( 'dlk-addons-elementor', wp_recent_posts_thumbs_path. 'assets/css/dlk-addons-elementor.css', array(), DLK_VERSION );

        }

    }

    new dlk_addons_elementor();

endif;