<?php $message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Bali Food Safari Restaurant Booking Notification</title>
  </head>
  <body bgcolor="#f6f6f6" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; margin: 0; padding: 0;">


<table style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; width: 100%; margin: 0; padding: 20px;"><tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"><td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"></td>
		<td bgcolor="#FFFFFF" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; display: block !important; max-width: 600px !important; clear: both !important; margin: 0; padding: 20px; border: 1px solid #f0f0f0;">


			<div style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; max-width: 600px; display: block; margin: 0 auto; padding: 0;">
			<table style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; width: 100%; margin: 0; padding: 0;"><tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"><td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">
						<img src="http://www.balifoodsafari.com/weblogo.jpg" style="height: 250px; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; max-width: 100%; margin: 0 0 40px; padding: 0;" height="250" />

                        <p style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;"><b style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">Salamat '.$restnames[$key].',</b></p>

                        <p style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 0;">You have a booking for our '.$bookingdata['tour'].'</p>';

                        if($ftype == "update"){
                          $message .= '</td></tr><tr><td style="color: #FF0000; font-size:16px; font-weight: bold"><p>***This booking has been UPDATED. Please check the updated details below:***</p></td></tr><tr><td>';
                        }
                        elseif($ftype == "cancel"){
                          $message .= '</td></tr><tr><td style="color: #FF0000; font-size:16px; font-weight: bold"><p>***This booking has been CANCELLED***</p></td></tr><tr><td>';
                        }


                        $message .= '<p style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
                            <b style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">Guest Booking Name: </b>'.$bookingdata['cname'].'<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" /><b style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">Date: </b>'.$rdate.'<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" /><b style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">Number of Guests: </b>'.$bookingdata['nguests'].'<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" /><b style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">Time Allocation: </b>'.$resttimes[$key].'<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" /><b style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">Special Requirements: </b>'.$bookingdata['requirements'].'<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" /></p>

						<h3>Course Type Guide</h3>
						<table width="300px" style="border: 2px solid #000; border-collapse: collapse;">
						   <tbody>
							  <tr style="background: #DDEBF7;">
								 <td colspan="3" style="text-align: center; border: 1px bottom #000; font-weight: 700;">
									4 Venue Bali Food Safari
								 </td>
							  </tr>
							  <tr>
								 <td style="border-bottom: 1px solid #000;">
									1st Venue:
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									17:30 - 18:45
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									Savoury
								 </td>
							  </tr>
							  <tr>
								 <td style="border-bottom: 1px solid #000;">
									2nd Venue:
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									19:00 - 20:00
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									Savoury
								 </td>
							  </tr>
							  <tr>
								 <td style="border-bottom: 1px solid #000;">
									3rd Venue:
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									20:15 - 21:15
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									Savoury
								 </td>
							  </tr>
							  <tr>
								 <td style="border-bottom: 1px solid #000;">
									4th Venue:
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									21:30 - 22:30
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									Dessert
								 </td>
							  </tr>
						   </tbody>
						</table>


						<p></p><table width="300px" style="border: 2px solid #000; border-collapse: collapse;">
						   <tbody>
							  <tr style="background: #DDEBF7;">
								 <td colspan="3" style="text-align: center; border: 1px bottom #000; font-weight: 700;">
									3 Venue Bali Food Safari
								 </td>
							  </tr>
							  <tr>
								 <td style="border-bottom: 1px solid #000;">
									1st Venue:
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									17:30 - 18:45
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									Savoury
								 </td>
							  </tr>
							  <tr>
								 <td style="border-bottom: 1px solid #000;">
									2nd Venue:
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									19:00 - 20:00
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									Savoury
								 </td>
							  </tr>
							  <tr>
								 <td style="border-bottom: 1px solid #000;">
									3rd Venue:
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									20:15 - 21:15
								 </td>
								 <td style="border-bottom: 1px solid #000;">
									Dessert
								 </td>
							  </tr>

						   </tbody>
						</table>


                       <p style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">*Times are Approximate <br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" /><br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" />*Pouring Water is included</p>


                        <p style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
                            This booking confirmation is deemed accepted by the recipient unless otherwise informed.<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" />
                            Queries should be made directly to:<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" /><br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" /></p>

                        <p style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
                            <b style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">Melky Schelling</b><br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" />
                            Bali Food Safari <br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" />
                            Indonesian Operations Manager.<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" />
                            +62 89 605 293 637
                        </p>

                        <p style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
                            DO NOT RESPOND <br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;" />
                            This is an automated email.
                        </p>


		          </td>
		<td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"></td>
	</tr></table><table style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; width: 100%; clear: both !important; margin: 0; padding: 0;"><tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"><td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"></td>
		<td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; display: block !important; max-width: 600px !important; clear: both !important; margin: 0; padding: 20px; border: 1px solid #f0f0f0;">


			<div style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; max-width: 600px; display: block; margin: 0 auto; padding: 0;">
				<table style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; width: 100%; margin: 0; padding: 0;"><tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"><td align="center" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">

						</td>
					</tr></table></div>


		</td>
		<td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"></td>
	</tr></table></div></td></tr></table></body>
</html>';
