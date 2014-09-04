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
	<form name="order-fulfillment" action="<?php echo plugins_url(); ?>/foodsafari-fulfillment/admin/order-process.php" method="post" id="order-fulfillment">
		<div id="normal-sortables" class="meta-box-sortables ui-sortable">
			<div id="wpcf-group-restaurant-info" class="postbox ">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span>Booking Info</span></h3>
				<div class="inside">
					<div id="wpcf-group-metabox-id-restaurant-info">
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Booking Reference</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Tour</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Tour Date</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Tour Time</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Tour Price</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Customer Name</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Customer Email</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Customer Phone</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Special Reqs</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Hotel Name</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Hotel Area</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Open to Join</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
						<div class="wpcf-wrap wpcf-meta-form">
							<div class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
								<label class="wpcf-form-label wpcf-form-textfield-label" for="">Hotel Booking Name</label>
								<input type="text" id="" name="" value="" class="wpcf-form-textfield form-textfield textfield">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
