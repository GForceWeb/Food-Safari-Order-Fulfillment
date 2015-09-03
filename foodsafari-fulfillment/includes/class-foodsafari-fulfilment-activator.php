<?php

/**
 * Fired during plugin activation
 *
 * @link       http://g-force.net
 * @since      1.0.0
 *
 * @package    Foodsafari_Fulfilment
 * @subpackage Foodsafari_Fulfilment/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Foodsafari_Fulfilment
 * @subpackage Foodsafari_Fulfilment/includes
 * @author     Grant Derepas <grant@g-force.net>
 */
class Foodsafari_Fulfilment_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$weeklydate = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime('Next week 12:00am')), 'F j, Y H:i:s' );
		$weeklydate = strtotime($weeklydate);

		$dailydate = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime('Tomorrow at 12:00am')), 'F j, Y H:i:s' );
		$dailydate = strtotime($dailydate);

		wp_schedule_event( strtotime('Next week 12:00am') , 'weekly', 'ff_weekly_report' );
		wp_schedule_event( strtotime('Tomorrow at 12:00am') , 'daily', 'ff_daily_cron' );
		wp_schedule_event( time(), 'hourly', 'ff_rezdy_sync' );
	}



}
