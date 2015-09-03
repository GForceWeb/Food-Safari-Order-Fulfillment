<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://g-force.net
 * @since      1.0.0
 *
 * @package    Foodsafari_Fulfilment
 * @subpackage Foodsafari_Fulfilment/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Foodsafari_Fulfilment
 * @subpackage Foodsafari_Fulfilment/public
 * @author     Grant Derepas <grant@g-force.net>
 */
class Foodsafari_Fulfilment_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Foodsafari_Fulfilment_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Foodsafari_Fulfilment_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/foodsafari-fulfilment-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Foodsafari_Fulfilment_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Foodsafari_Fulfilment_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/foodsafari-fulfilment-public.js', array( 'jquery' ), $this->version, false );

	}

	public function ff_cron_schedules($schedules){
		$schedules['weekly'] = array(
			'interval' => 604800,
			'display'=> 'Weekly'
		);
		return $schedules;
	}

	public function ff_report_generator($sdate, $edate, $freq){

		//Prepare subject line
		if($freq == "weekly"){
			$subject = "Bali Food Safari Weekly Report - ".date("dS", $sdate)." -> ".date("dS", $edate);
		}
		elseif($freq == "monthly"){
			$subject = "Bali Food Safari Monthly Report - ".date("F", $sdate);
		}

		//Get List of Fulfillments within range
		$args = array(
			'post_type'    => 'fulfillment',
			'nopaging'	   => true,
			'meta_key'     => 'wpcf-tour-date',
			'meta_value'   => array($sdate, $edate),
			'meta_compare' => 'BETWEEN'
		);

		$query1 = new WP_Query( $args );
		$fulfillments = $query1->get_posts();

		//Create Array of Post IDs
		$fullfillid = array();
		foreach($fulfillments as $post){
				$postid = $post->ID;
				$fullfillid[$postid] = array();
		}

		//Extract required information
		$drivers = array();
		$restaurants = array();

		foreach($fullfillid as $id => $value){
			//Get Driver ID
			$host_id = get_post_meta( $id, '_wpcf_belongs_host_id', true );

			//Get Number of Guests
			$fullfillid[$id]['guests'] = get_post_meta( $id, 'wpcf-number-of-guests', true );

			//Store driver ID in array
			$fullfillid[$id]['host'] = $host_id;
			$tlist[] = $host_id;


			//Get Restaurant-Order ID
			$childargs = array(
			'post_type' => 'restaurants-to-order',
			'meta_query' => array(array('key' => '_wpcf_belongs_fulfillment_id', 'value' => $id))
			);
			$child_posts = get_posts($childargs);


			//Compile List of Restaurant IDs
			foreach($child_posts as $post){
				$fullfillid[$id]['restaurant'][] = get_post_meta($post->ID, '_wpcf_belongs_restaurant_id', true );
				$rlist[] = get_post_meta($post->ID, '_wpcf_belongs_restaurant_id', true );
			}
		}

		//Count Number of Tours for each Restaurant / host
		$hcounted = array_count_values($tlist);
		$rcounted = array_count_values($rlist);

		//Calculate Number Restaurant / Host / Guest Numbers
		$hosts = array();
		$tguests = 0;

		foreach ($fullfillid as $key => $value){
			//Host Calculations
			$tid = $value['host'];
			if(isset($hosts[$tid])){
				$hosts[$tid] += $value['guests'];
			}
			else{$hosts[$tid] = $value['guests'];}

			//Restautant Calculations
			foreach ($value['restaurant'] as $value2){
				if(isset($restaurants[$value2])){
					$restaurants[$value2] += $value['guests'];
				}
				else {$restaurants[$value2] = $value['guests'];}
			}

			//Guest Calculations
			$tguests += $value['guests'];
		}

		//Build Email content
		$content = '<br/><b>Total Tours:</b> ';
		$content .= count($fullfillid);
		$content .= '<br/><b>Total Guests:</b> ';
		$content .= $tguests;

		$content .= '<br/><br/><table style="font-family: "Helvetica Neue; line-height: 1.6; width: 100%;"><tr><td  style="font-family: "Helvetica Neue; line-height: 1.6; font-weight: bold;">Host Name</td><td style="font-family: "Helvetica Neue; line-height: 1.6; font-weight: bold;"># Tours</td><td style="font-family: "Helvetica Neue; line-height: 1.6; font-weight: bold;"># People</td></tr>';
		foreach ($hosts as $key => $value){
			$content .= '<tr><td>'.get_the_title($key).'</td><td>'.$hcounted[$key].'</td><td>'.$value.'</td></tr>';
		}
		$content .= '</table><br/><br/>';

		$content .= '<table style="font-family: "Helvetica Neue; line-height: 1.6; width: 100%;"><tr><td style="font-family: "Helvetica Neue; line-height: 1.6; font-weight: bold;">Restaurant Name</td><td style="font-family: "Helvetica Neue; line-height: 1.6; font-weight: bold;"># Tours</td><td style="font-family: "Helvetica Neue; line-height: 1.6; font-weight: bold;"># People</td></tr>';
		foreach ($restaurants as $key => $value){
			$content .= '<tr><td>'.get_the_title($key).'</td><td>'.$rcounted[$key].'</td><td>'.$value.'</td></tr>';
		}
		$content .= '</table><br/>';


		$to = 'simon@balifoodsafari.com';
		//Subject already set
		$headers = array('Content-Type: text/html; charset=UTF-8');
		wp_mail( $to, $subject, $content, $headers );

	}

	public function ff_weeklyReport(){
		$sdate = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime('last week 12:00am')), 'F j, Y H:i:s' );
		$sdate = strtotime($sdate);
		$edate = strtotime('+7 day', $sdate);
		ff_report_generator($sdate, $edate, 'weekly');
	}

	public function ff_monthlyReport(){
		if(current_time('d') == '01'){
			$sdate = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime('first day of last month 12:00am')), 'F j, Y H:i:s' );
			$sdate = strtotime('first day of last month 12:00am');
			$edate = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime('last day of last month 11:59pm')), 'F j, Y H:i:s' );
			$edate = strtotime('last day of last month 11:59pm');
			ff_report_generator($sdate, $edate, 'monthly');
		}
	}

	public function ff_rezdySync(){
		$service_url = 'https://api.rezdy.com/latest/bookings/?apiKey=dd7252a6c7e6426ba9e0cc03fb67d691';
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		    die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($curl);
		$decoded = json_decode($curl_response);
		if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		    die('error occured: ' . $decoded->response->errormessage);
		}

		//Grab list of booking IDS
		$bookingIDs = array();
		foreach($decoded->bookings as $booking){
		    if($booking->status == "CONFIRMED" && isset($booking->items[0]->startTime)){
		      $bookingIDs[] = $booking->orderNumber;
		    }
		}

		//Compare to WP Posts
		$args = array(
			'posts_per_page' => -1,
		  'post_type'  => 'fulfillment',
		  'meta_query' => array(
				array(
					'key'     => 'wpcf-booking-reference',
					'value'   => $bookingIDs,
					'compare' => 'IN',
				),
			),
		);
		$query = new WP_Query( $args );
		$fulfilments = $query->get_posts();
		$fulfilmentIDs = array();
		foreach($fulfilments as $fulfilment){
		  $fulfilmentIDs[] = get_post_meta( $fulfilment->ID, 'wpcf-booking-reference', true );
		}

		error_log(print_r($bookingIDs, true));
		error_log(print_r($fulfilmentIDs, true));
		if(empty( $fulfilmentIDs ) ){
		  $newBookings = $bookingIDs;
		}
		else {
		  $newBookings = array_diff($bookingIDs, $fulfilmentIDs);
		  $newBookings = array_values($newBookings);
		}

		//error_log(print_r($newBookings, true));
		//foreach new booking create a fulfillment post
		foreach ($newBookings as $newBooking){

		  //Find the relevant data from original rezdy API call
		  foreach($decoded->bookings as $booking){
		    if($booking->orderNumber == $newBooking){
		      $bookingData = $booking;
		      break;
		    }
		  }

		  //Build the new fulfillment post
		  $new_post = array(
		    'post_name'   =>  $newBooking,
		    'post_title'  =>  $newBooking,
		    'post_status' =>  'publish',
		    'post_type'   =>  'fulfillment',
		    'post_author' =>  '1'
		  );
		  $fulfilment = wp_insert_post($new_post);

		  //Get custom fields data
		  $custname = $bookingData->customer->firstName." ".$bookingData->customer->lastName;
		  $tourdate = $bookingData->items[0]->startTime;
		  $tourdate = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime($tourdate) ), 'F j, Y H:i:s' );
			$tourdate = strtotime($tourdate);

		  foreach($bookingData->fields as $field){
		      if($field->label == "Name of Hotel / Accommodation"){$hotelname = $field->value;}
		      elseif($field->label == "Area of your Hotel / Accommodation eg Seminyak"){$hotelarea = $field->value;}
		      elseif($field->label == 'Is your Accommodation Booked under the Same Name? If NOT please confirm the names.'){$hotelbooking = $field->value;}
		      elseif($field->label == "Is your party open to joining another group on the same evening?"){$bookingopen = $field->value;}
		  }

		  foreach($bookingData->payments as $payment){
		      if($payment->type == "PROMO_CODE"){$promo = $payment->label;}
		  }

		  //Set custom field values
		  $fdata = array(
		    'wpcf-booking-reference'         => $bookingData->orderNumber,
		    'wpcf-tour'                      => $bookingData->items[0]->productName,
		    'wpcf-tour-date'                 => $tourdate,
		    'wpcf-customer-name'             => $custname,
		    'wpcf-customer-email'            => $bookingData->customer->email,
		    'wpcf-customer-phone'            => $bookingData->customer->mobile,
		    'wpcf-special-requirements'      => $bookingData->comments,
		    'wpcf-hotel-name'                => $hotelname,
		    'wpcf-hotel-area'                => $hotelarea,
		    'wpcf-hotel-booking-name'        => $hotelbooking,
		    'wpcf-number-of-guests'          => $bookingData->items[0]->totalQuantity,
		    'wpcf-promo-code'                => $promo,
		    'wpcf-agent'                     => '',
		    'wpcf-wpcf-open-to-join'         => $bookingopen,
		  );

		  //Save values from created array into db
		  foreach($fdata as $meta_key=>$meta_value) {
		     update_post_meta($fulfilment, $meta_key, $meta_value);
		  }
		}
	}

	public function ff_manualrezdysync() {

	   if ( !wp_verify_nonce( $_REQUEST['nonce'], "send_fulfillment_nonce")) {
	      exit("No naughty business please");
	   }

		  $ID = $_REQUEST['post'];
	    $orderno = get_the_title( $ID );
	    $service_url = 'https://api.rezdy.com/latest/bookings/'.$orderno.'?apiKey=dd7252a6c7e6426ba9e0cc03fb67d691';
	    $curl = curl_init($service_url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    $curl_response = curl_exec($curl);
	    if ($curl_response === false) {
	        $info = curl_getinfo($curl);
	        curl_close($curl);
	        die('error occured during curl exec. Additioanl info: ' . var_export($info));
	    }
	    curl_close($curl);
	    $decoded = json_decode($curl_response);
	    if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
	        die('error occured: ' . $decoded->response->errormessage);
	    }

			$bookingData = $decoded->booking;
			//Get custom fields data
		  $custname = $bookingData->customer->firstName." ".$bookingData->customer->lastName;
		  $tourdate = $bookingData->items[0]->startTime;
			$tourdate = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime($tourdate)), 'F j, Y H:i:s' );
			$tourdate = strtotime($tourdate);

			foreach($bookingData->fields as $field){
		      if($field->label == "Name of Hotel / Accommodation"){$hotelname = $field->value;}
		      elseif($field->label == "Area of your Hotel / Accommodation eg Seminyak"){$hotelarea = $field->value;}
		      elseif($field->label == 'Is your Accommodation Booked under the Same Name? If NOT please confirm the names.'){$hotelbooking = $field->value;}
		      elseif($field->label == "Is your party open to joining another group on the same evening?"){$bookingopen = $field->value;}
		  }

		  foreach($bookingData->payments as $payment){
		      if($payment->type == "PROMO_CODE"){$promo = $payment->label;}
		  }

			//Set custom field values
		  $fdata = array(
		    'wpcf-booking-reference'         => $bookingData->orderNumber,
		    'wpcf-tour'                      => $bookingData->items[0]->productName,
		    'wpcf-tour-date'                 => $tourdate,
		    'wpcf-customer-name'             => $custname,
		    'wpcf-customer-email'            => $bookingData->customer->email,
		    'wpcf-customer-phone'            => $bookingData->customer->mobile,
		    'wpcf-special-requirements'      => $bookingData->comments,
		    'wpcf-hotel-name'                => $hotelname,
		    'wpcf-hotel-area'                => $hotelarea,
		    'wpcf-hotel-booking-name'        => $hotelbooking,
		    'wpcf-number-of-guests'          => $bookingData->items[0]->totalQuantity,
		    'wpcf-promo-code'                => $promo,
		    'wpcf-agent'                     => '',
		    'wpcf-wpcf-open-to-join'         => $bookingopen,
		  );

			error_log(print_r($bookingData, true));

			error_log(print_r($fdata, true));
		  //Save values from created array into db
		  foreach($fdata as $meta_key=>$meta_value) {
		     update_post_meta($ID, $meta_key, $meta_value);
		  }

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

		}
		else {
	      header("Location: ".$_SERVER["HTTP_REFERER"]);
		}

		die();

	}

	public function ff_fulfilmentCron(){
		$args = array(
			'posts_per_page' => -1,
		  'post_type'  => 'fulfillment',
		  'meta_query' => array(
				array(
					'key'     => 'wpcf-tour-date',
					'value'   => array(current_time('timestamp'),strtotime('+48 hours')),
					'compare' => 'BETWEEN',
					'type' => 'NUMERIC'
				),
				array(
					'key'     => 'wpcf-fulfillment-status',
					'value'   => 'complete'
				),
			),
		);
		$query = new WP_Query( $args );
		$fulfilments = $query->get_posts();
		error_log(print_r($fulfilments, true));
		foreach($fulfilments as $fulfilment){
			$ID = $fulfilment->ID;
			$nonce = wp_create_nonce("send_fulfillment_nonce");
			$ftype = 'send';
			error_log($ID);
			$this->send_fulfillment($nonce, $ID, $ftype);
			update_post_meta($ID, 'wpcf-fulfillment-status', 'done');
		}
	}

	public function send_fulfillment($nonce, $ID, $ftype) {

		if(isset($_REQUEST['nonce'])){
			$nonce = $_REQUEST['nonce'];
		}
		if(isset($_REQUEST['post'])){
			$ID = $_REQUEST['post'];
		}
		if(isset($_REQUEST['type'])){
			$ftype = $_REQUEST['type'];
		}


		if ( !wp_verify_nonce( $nonce, "send_fulfillment_nonce")) {
	      exit("No naughty business please");
	  }


		$postvars = array(
	      'reference' => 'wpcf-booking-reference',
	      'tour' => 'wpcf-tour',
	      'courses' => 'wpcf-num-courses',
	      'tdate' => 'wpcf-tour-date',
	      'price' => 'wpcf-tour-price',
	      'nguests' => 'wpcf-number-of-guests',
	      'cname' => 'wpcf-customer-name',
	      'cemail' => 'wpcf-customer-email',
	      'cphone' => 'wpcf-customer-phone',
	      'requirements' => 'wpcf-special-requirements',
	      'hname' => 'wpcf-hotel-name',
	      'harea' => 'wpcf-hotel-area',
	      'ojoin' => 'wpcf-open-to-join',
	      'hbname' => 'wpcf-hotel-booking-name'
	  );

	  //Get Main Booking Data
	  $bookingdata = array();
	  foreach ($postvars as $key => $value) {
	      $customdata = get_post_meta($ID, $value, false);
	      foreach ($customdata as $value) {
	          $bookingdata[$key] = $value;
	      }
	  }

	  $tdate = date("F j, Y, g:i a", $bookingdata['tdate']);
	  $rdate = date("F j, Y", $bookingdata['tdate']);

	  // Get the children of fulfillment
	  $childargs = array(
	          'post_type' => 'restaurants-to-order',
	          'numberposts' => -1,
	          'meta_query' => array(array('key' => '_wpcf_belongs_fulfillment_id', 'value' => intval($ID)))
	  );
	  $restnames = array();
	  $restphones = array();
	  $restlocations = array();
	  $child_posts = get_posts($childargs);

	  //Add Restaurant Order to array
	  $unordered_child_posts = array();
	  foreach($child_posts as $child_post){
	      $child_post->order = get_post_meta($child_post->ID, 'wpcf-restaurant-order', true);
	      $unordered_child_posts[] = $child_post;
	  }
		//Sort Array by Order
	  function build_sorter($key) {
	      return function ($a, $b) use ($key) {
	          return strnatcmp($a->$key, $b->$key);
	      };
	  }
	  usort($unordered_child_posts, build_sorter('order'));
	  $ordered_child_posts = $unordered_child_posts;

	  //Get Restaurant Data
	  foreach($ordered_child_posts as $child_post){
	  // Display each parent of "restaurants-to-order"
	      $rest_id = wpcf_pr_post_get_belongs($child_post->ID, 'restaurant');
	      $rest = get_post($rest_id);
	      $restnames[] = $rest->post_title;
	      $restphones[] = get_post_meta($rest->ID, 'wpcf-restaurant-phone', true);
	      $restemails[] = get_post_meta($rest->ID, 'wpcf-restaurant-email', true);
	      $restlocations[] = get_post_meta($rest->ID, 'wpcf-restaurant-address', true);
				$restcourse[] = get_post_meta($child_post->ID, 'wpcf-course-type', true);
	  }

	  //Get Transport Data
	  $driver_id = wpcf_pr_post_get_belongs($ID, 'transport');
	  $driver = get_post($driver_id);
	  $dname = $driver->post_title;
	  $demail = get_post_meta($driver_id, 'wpcf-transport-email', true);

	  //Transport Email
	  $to = $demail;
		$headers = 'From: Bali Food Safari <bookings@balifoodsafari.com>' . "\r\n";
		add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

		if($ftype == 'send'){
			$subject = "$bookingdata[tour] - $rdate:";
		  include 'partials/transport-email.php';
			$logstring = 'Fulfillment Notifications sent to Host & Restaurants on '.current_time('F j, Y, g:i a');
		}
		elseif($ftype == 'update'){
			$subject = "[Update] $bookingdata[tour] - $rdate:";
		  include 'partials/transport-email.php';
			$logstring = 'Updated Fulfillment Notifications sent to Host & Restaurants on '.current_time('F j, Y, g:i a');
		}
		elseif($ftype == 'cancel'){
			$subject = "[Cancelation] $bookingdata[tour] - $rdate:";
		  include 'partials/transport-email.php';
			$logstring = 'Cancellation Notifications sent to Host & Restaurants on '.current_time('F j, Y, g:i a');
		}

	  wp_mail( $to, $subject, $message, $headers);


	  //Restaurants Emails
	  $resttimes = array(
	      '0' => '17:30<br/>',
	      '1' => '19:00<br/>',
	      '2' => '20:15<br/>',
	      '3' => '21:30<br/>',
	  );
	  foreach($restemails as $key => $value) {
	      if(isset($restnames[$key])){
	          //$to = "grant@g-force.net";
	          $to = $restemails[$key];


						if($ftype == 'send'){
							$subject = "$bookingdata[tour] - $rdate";
		          include 'partials/restaurant-email.php';
						}
						elseif($ftype == 'update'){
							$subject = "[Update] $bookingdata[tour] - $rdate";
		          include 'partials/restaurant-email.php';
						}
						elseif($ftype == 'cancel'){
							$subject = "[Cancellation] $bookingdata[tour] - $rdate";
		          include 'partials/restaurant-email.php';
						}

	          wp_mail( $to, $subject, $message, $headers);
	      }
	  }

	  update_post_meta($ID, 'wpcf-date-sent', current_time('timestamp'));
		add_post_meta($ID, 'wpcf-fulfilment-logs', $logstring, false);


	   if($ftype == 'update' || $ftype == 'cancel') {
	      header("Location: ".$_SERVER["HTTP_REFERER"]);
	   }

	}

	public function my_must_login() {
	   echo "You must be logged in to send fulfullments";
	   die();
	}

	public function ff_markFulfilment(){
		$nonce = $_REQUEST['nonce'];
		$id = $_REQUEST['id'];
		$value = $_REQUEST['value'];
		$redirect = $_REQUEST['redirect'];


		if ( !wp_verify_nonce( $_REQUEST['nonce'], "ff_markFulfilment_nonce")) {
			 exit("No naughty business please");
		}

		update_post_meta($id, 'wpcf-fulfillment-status', $value);

		if($redirect == true) {
			 header("Location: ".$_SERVER["HTTP_REFERER"]);
		}

	}

	public function ff_register_shortcodes(){
		function ff_create_links($atts){
			extract( shortcode_atts(
				array(
						'type'	=> 'send',
				), $atts)
			);
			$postID = get_the_ID();
			$nonce = wp_create_nonce("send_fulfillment_nonce");
			$link = admin_url('admin-ajax.php?action=send_fulfillment&type='.$type.'&post='.$postID.'&nonce='.$nonce);
			if($type == 'update'){
				return'<a class="fulfilButton" data-nonce="' . $nonce . '" data-post_id="' . $postID . '" href="' . $link . '">Update Host/Restaurants</a>';
			}
			elseif($type == 'cancel'){
				return'<a class="fulfilButton" data-nonce="' . $nonce . '" data-post_id="' . $postID . '" href="' . $link . '">Send Cancellation Email</a>';
			}
			elseif($type == 'send'){
				return'<a class="fulfilButton" data-nonce="' . $nonce . '" data-post_id="' . $postID . '" href="' . $link . '">Send Fulfilment</a>';
			}
		}
		add_shortcode( 'ff_links', 'ff_create_links' );

		function ff_markFulfilShortcode($atts){
			extract( shortcode_atts(
				array(
						'text'	=> 'Mark as Complete',
				), $atts)
			);
			$postID = get_the_ID();
			$value = get_post_meta($postID, 'wpcf-fulfillment-status', true);
			$nonce = wp_create_nonce("ff_markFulfilment_nonce");
			$link = admin_url('admin-ajax.php?action=ff_markFulfilment&id='.$postID.'&redirect=true&nonce='.$nonce);

			if($value == 'incomplete' || $value == '' || !isset($value)){
				return'<a class="fulfilButton" data-nonce="' . $nonce . '" data-post_id="' . $postID . '" href="' . $link . '&value=complete">Mark Completed</a>';
			}
			elseif($value == 'complete'){
				return'<a class="fulfilButton" data-nonce="' . $nonce . '" data-post_id="' . $postID . '" href="' . $link . '&value=incomplete">Mark Incomplete</a>';
			}
			elseif($value == 'done'){
				return'<a class="fulfilButton" data-nonce="' . $nonce . '" data-post_id="' . $postID . '" href="#">Done, See Email Log</a>';
			}
		}
		add_shortcode( 'ff_markFulfil', 'ff_markFulfilShortcode' );

		function ff_resync_link() {
			$postID = get_the_ID();
			$nonce = wp_create_nonce("send_fulfillment_nonce");
			$link = admin_url('admin-ajax.php?action=rezdysync&post='.$postID.'&nonce='.$nonce);
			return'<a class="button rezdysync" data-nonce="' . $nonce . '" data-post_id="' . $postID . '" href="' . $link . '">Manual Sync</a>';
		}
		add_shortcode( 'syncLink', 'ff_resync_link' );
	}

}
