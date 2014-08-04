<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Foodsafari_Fulfillment
 * @author    Grant Derepas <grant@g-force.net
 * @license   GPL-2.0+
 * @link      http://g-force.net
 * @copyright 2014 G-Force Web Technologies
 *
 * @wordpress-plugin
 * Plugin Name:       Food Safari Order Fulfillment
 * Plugin URI:        http://g-force.net/plugins/foodsafari-fulfillment/
 * Description:       Order Fulfillment plugin for the Food Safari Network
 * Version:           1.0.0
 * Author:            Grant Derepas
 * Author URI:        http://g-force.net
 * Text Domain:       foodsafari-fulfillment
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/<owner>/<repo>
 * WordPress-Plugin-Boilerplate: v2.6.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-foodsafari-fulfillment.php' );


register_activation_hook( __FILE__, array( 'FoodSafari_Fulfillment', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'FoodSafari_Fulfillment', 'deactivate' ) );


add_action( 'plugins_loaded', array( 'FoodSafari_Fulfillment', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-foodsafari-fulfillment-admin.php' );
	add_action( 'plugins_loaded', array( 'FoodSafari_Fulfillment_Admin', 'get_instance' ) );

}
