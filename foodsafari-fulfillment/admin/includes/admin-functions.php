<?php


add_action( 'post_submitbox_misc_actions', 'my_post_submitbox_misc_actions' );

function my_post_submitbox_misc_actions(){
    ?>
    <div class="misc-pub-section my-options">
        <label for="my_custom_post_action">Email Notifications</label><br />
        <!--<a href="<?php echo plugins_url();?>/foodsafari-fulfillment/admin/includes/emailprocess.php?id=<?php the_ID(); ?>">Send Notification</a>-->
        <a href="<?php echo get_edit_post_link($_GET["post"]); ?>&send=true">Send Notification</a>

        <?php


        if(isset($_GET["send"])){
            if($_GET["send"] == 'true'){


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
                $customdata = get_post_meta($_GET["post"], $value, false);
                foreach ($customdata as $value) {
                    $bookingdata[$key] = $value;
                    /*echo $key;
                    echo ':';
                    echo $value;
                    echo "<br/>";*/
                }
            }


            $tdate = date("F j, Y, g:i a", $bookingdata['tdate']);
            $rdate = date("F j, Y", $bookingdata['tdate']);

            // Get the children of fulfillment
            $childargs = array(
                    'post_type' => 'restaurants-to-order',
                    'numberposts' => -1,
                    'meta_query' => array(array('key' => '_wpcf_belongs_fulfillment_id', 'value' => intval($_GET['post'])))
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



                }

            //Get Transport Data
            $driver_id = wpcf_pr_post_get_belongs($_GET["post"], 'transport');
            $driver = get_post($driver_id); 
            $dname = $driver->post_title;
            $demail = get_post_meta($driver_id, 'wpcf-transport-email', true);


            //Transport Email
            //$to = "grant@g-force.net";
             $to = $demail;
            $subject = "$bookingdata[tour] - $rdate:";
            $headers = 'From: Bali Food Safari <bookings@balifoodsafari.com>' . "\r\n";

            include 'transport-email.php';
            add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
            wp_mail( $to, $subject, $message, $headers);


            //Restaurants Emails
            $restemails = array(
                '0' => '17:30<br/>',
                '1' => '19:00<br/>',
                '2' => '20:15<br/>',
                '3' => '21:30<br/>',
            ); 
            foreach($restemails as $key => $value) {
                if(isset($restnames[$key])){
                    //$to = "grant@g-force.net";
                    $to = $restemails [$key];
                    $subject = "$bookingdata[tour] - $rdate";
                    include 'restaurant-email.php';
                    wp_mail( $to, $subject, $message, $headers);
                }
            }


            //Message to User
            function my_admin_notice() {
                ?>
                <div class="updated">
                    <p>Notification Emails have been successfully sent to <?php echo $dname;?>, <?php foreach($restnames as $restname){echo $restname.", ";}?></p>
                </div>
                <?php
            }
            add_action( 'admin_notices', 'my_admin_notice' );

            update_post_meta($_GET["post"], 'wpcf-date-sent', current_time('timestamp'));    

           }
        }
    $datesent = get_post_meta($_GET["post"], 'wpcf-date-sent', true);
    if(!empty($datesent)){
        $echodatesent = date('l, F jS, Y @ g:i A', $datesent);
        echo "<p>Notifications were last sent to Transport & Hotels on ";
        echo $echodatesent;
        echo "</p>";
    }
    else {echo "<p>Notifications for this order have not been sent.</p>";}                                     
    ?></div><?php                                     
}

?>