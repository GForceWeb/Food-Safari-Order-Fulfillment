<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://g-force.net
 * @since      1.0.0
 *
 * @package    Foodsafari_Fulfilment
 * @subpackage Foodsafari_Fulfilment/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Foodsafari_Fulfilment
 * @subpackage Foodsafari_Fulfilment/includes
 * @author     Grant Derepas <grant@g-force.net>
 */
class Foodsafari_Fulfilment_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		wp_clear_scheduled_hook('ff_weekly_report');
		wp_clear_scheduled_hook('ff_monthly_report');
		wp_clear_scheduled_hook('ff_rezdy_sync');

	}

}
