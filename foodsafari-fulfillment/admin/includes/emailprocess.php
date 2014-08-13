<?php

$post_id = $_GET["id"];
$thepost = get_post($post_id);



echo get_post_meta($post_id, 'wpcf-booking-reference', true);
/*echo $thepost->$wpcf-tour

wpcf-booking-reference 	RGJRT1D
	Edit Edit 	Copy Copy 	Delete Delete 	2415 	1524 	wpcf-tour 	Seminyak-4
	Edit Edit 	Copy Copy 	Delete Delete 	2416 	1524 	wpcf-num-courses 	4
	Edit Edit 	Copy Copy 	Delete Delete 	2417 	1524 	wpcf-tour-date 	1408389600
	Edit Edit 	Copy Copy 	Delete Delete 	2418 	1524 	wpcf-tour-price 	297
	Edit Edit 	Copy Copy 	Delete Delete 	2419 	1524 	wpcf-customer-name 	Stephen Wynn
	Edit Edit 	Copy Copy 	Delete Delete 	2420 	1524 	wpcf-customer-name 	Siobhan Wynn
	Edit Edit 	Copy Copy 	Delete Delete 	2421 	1524 	_wpcf-customer-email-sort-order 	a:2:{i:0;i:2422;i:1;i:2423;}
	Edit Edit 	Copy Copy 	Delete Delete 	2422 	1524 	wpcf-customer-email 	wynn@iinet.net.au
	Edit Edit 	Copy Copy 	Delete Delete 	2423 	1524 	wpcf-customer-email 	shev6163@hotmail.com
	Edit Edit 	Copy Copy 	Delete Delete 	2424 	1524 	wpcf-customer-phone 	0413871956
	Edit Edit 	Copy Copy 	Delete Delete 	2425 	1524 	wpcf-special-requirements 	
	Edit Edit 	Copy Copy 	Delete Delete 	2426 	1524 	wpcf-hotel-name 	Kuta Seaview Hotel
	Edit Edit 	Copy Copy 	Delete Delete 	2427 	1524 	wpcf-hotel-area 	Kuta
	Edit Edit 	Copy Copy 	Delete Delete 	2428 	1524 	wpcf-open-to-join 	Yes
	Edit Edit 	Copy Copy 	Delete Delete 	2429 	1524 	wpcf-hotel-booking-name







$child_order_posts = types_child_posts('order-fulfillment');
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
*/

?>