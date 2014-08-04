<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   FoodSafari_Fulfillment_Admin
 * @author    Grant Derepas <grant@g-force.net>
 * @license   GPL-2.0+
 * @link      http://g-force.net
 * @copyright 2014 G-Force Web Technologies
 */
?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<!-- @TODO: Provide markup for your options page here. -->
	<form action="process.php">
		<input name="Booking Number" type="text">
	</form>

</div>
