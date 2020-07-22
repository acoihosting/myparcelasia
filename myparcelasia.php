<?php
/**
 * Plugin Name: MyParcelAsia Woocommerce Shipping
 * Plugin URI: https://acoi.my/
 * Description: Plugin for Woocommerce MyParcelAsia Integration.
 * Version: 1.0.0
 * Author: Acoi
 * Author URI: https://acoi.my/
 * Developer: Acoi
 * Developer URIs: http://acoi.my/
 * Text Domain: myparcelasia
 * Domain Path: /en-us
 *
 * WC requires at least: 2.2
 * WC tested up to: 2.3
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    if ( ! class_exists( 'WC_Integration_Myparcelasia' ) ) :

        class WC_Integration_Myparcelasia {
        
            /**
            * Construct the plugin.
            */
            public function __construct() {
                 add_action( 'woocommerce_shipping_init', array( $this, 'init' ) );
            }

            /**
            * Initialize the plugin.
            */
            public function init() {
                // start a session


                // Checks if WooCommerce is installed.
                if ( class_exists( 'WC_Integration' ) ) {
                    // Include our integration class.
                    include_once 'include/myparcelasia_shipping.php';

                   // Register the integration.
                    add_filter( 'woocommerce_shipping_methods', array( $this, 'add_integration' ) );
                } else {
                    // throw an admin error if you like
                }
            }

            /**
             * Add a new integration to WooCommerce.
             */
            public function add_integration( $integrations ) {
                $integrations[] = 'WC_Myparcelasia_Shipping_Method';
                return $integrations;
            }

        }

        $WC_Integration_Myparcelasia = new WC_Integration_Myparcelasia( __FILE__ );

     endif;


}
function your_shipping_method_init() {
    // Your class will go here
}

add_action( 'woocommerce_shipping_init', 'your_shipping_method_init' );
?>
