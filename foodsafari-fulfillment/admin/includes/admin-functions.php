<?php


add_action( 'post_submitbox_misc_actions', 'my_post_submitbox_misc_actions' );

function my_post_submitbox_misc_actions(){
?>
<div class="misc-pub-section my-options">
	<label for="my_custom_post_action">Email Notifications</label><br />
	<a href="<?php echo plugins_url();?>/foodsafari-fulfillment/admin/includes/emailprocess.php?id=<?php the_ID(); ?>">Send Notification</a>

	<?php 

	if(isset($_GET["send"])){
		if($_GET["send"] == 'true'){


		$postvars = array(
			'wpcf-booking-reference' => 'wpcf-booking-reference',
		    'wpcf-tour' => 'wpcf-tour',
		    'wpcf-num-courses' => 'wpcf-num-courses',
		    'wpcf-tour-date' => 'wpcf-tour-date',
		    'wpcf-tour-price' => 'wpcf-tour-price',
			'wpcf-customer-name' => 'wpcf-customer-name',
		    'wpcf-customer-email' => 'wpcf-customer-email',
		    'wpcf-customer-phone' => 'wpcf-customer-phone',
		    'wpcf-special-requirements' => 'wpcf-special-requirements',
		    'wpcf-hotel-name' => 'wpcf-hotel-name',
		    'wpcf-hotel-area' => 'wpcf-hotel-area',
		    'wpcf-open-to-join' => 'wpcf-open-to-join',
		    'wpcf-hotel-booking-name' => 'wpcf-hotel-booking-name'
		);

		foreach ($postvars as $key => $value) {
			$customdata = get_post_meta($_GET["post"], $value, false);
			foreach ($customdata as $value) {
				echo $key;
				echo ':';
				echo $value;
			}
		}

		$child_order_posts = types_child_posts('fulfillment');
		foreach ($child_order_posts as $child_order_post) {
			$child_posts = types_child_posts('restaurants-to-orders');
			foreach($child_posts as $child_post){
				$rest_id = wpcf_pr_post_get_belongs($child_post->ID, 'restaurant');
				$rest = get_post($rest_id);
				echo $rest->post_title;
				echo $rest->wpcf-restaurant-phone;
				echo $rest->wpcf-restaurant-email;
			}
		}
		
		
		//EMAIL TO Restaurants
		//wp_mail( $to, $subject, $message, $headers, $attachments );



		//EMAIL TO Restaurants
		//wp_mail( $to, $subject, $message, $headers, $attachments );
	}
}

	?>
	<!--<select id="my_custom_post_action" name="my_custom_post_action">
		<option value="1">First Option goes here</option>
		<option value="2">Second Option goes here</option>
	</select>-->
</div>
<?php
}



?>