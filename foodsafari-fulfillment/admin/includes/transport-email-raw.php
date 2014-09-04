<?php $message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Really Simple HTML Email Template</title>
<style>
/* -------------------------------------
		GLOBAL
------------------------------------- */
* {
	margin: 0;
	padding: 0;
	font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
	font-size: 100%;
	line-height: 1.6;
}

img {
	max-width: 100%;
}

body {
	-webkit-font-smoothing: antialiased;
	-webkit-text-size-adjust: none;
	width: 100%!important;
	height: 100%;
}


/* -------------------------------------
		ELEMENTS
------------------------------------- */
a {
	color: #348eda;
}

.btn-primary {
	text-decoration: none;
	color: #FFF;
	background-color: #348eda;
	border: solid #348eda;
	border-width: 10px 20px;
	line-height: 2;
	font-weight: bold;
	margin-right: 10px;
	text-align: left;
	cursor: pointer;
	display: inline-block;
	border-radius: 25px;
}

.btn-secondary {
	text-decoration: none;
	color: #FFF;
	background-color: #aaa;
	border: solid #aaa;
	border-width: 10px 20px;
	line-height: 2;
	font-weight: bold;
	margin-right: 10px;
	text-align: left;
	cursor: pointer;
	display: inline-block;
	border-radius: 25px;
}

.last {
	margin-bottom: 0;
}

.first {
	margin-top: 0;
}

.padding {
	padding: 10px 0;
}


/* -------------------------------------
		BODY
------------------------------------- */
table.body-wrap {
	width: 100%;
	padding: 20px;
}

table.body-wrap .container {
	border: 1px solid #f0f0f0;
}


/* -------------------------------------
		FOOTER
------------------------------------- */
table.footer-wrap {
	width: 100%;	
	clear: both!important;
}

.footer-wrap .container p {
	font-size: 14px;
	color: #666;
	
}

table.footer-wrap a {
	color: #999;
}


/* -------------------------------------
		TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
	font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	line-height: 1.1;
	margin-bottom: 15px;
	color: #000;
	margin: 40px 0 10px;
	line-height: 1.2;
	font-weight: 200;
}

h1 {
	font-size: 36px;
}
h2 {
	font-size: 30px;
}
h3 {
	font-size: 24px;
}

p, ul, ol {
	margin-bottom: 10px;
	font-weight: normal;
	font-size: 14px;
}

ul li, ol li {
	margin-left: 5px;
	list-style-position: inside;
}

.emphasis {
    font-size: 16px;
    font-weight: bold;
}
/* ---------------------------------------------------
		RESPONSIVENESS
		Nuke it from orbit. Its the only way to be sure.
------------------------------------------------------ */

/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
	display: block!important;
	max-width: 600px!important;
	/*margin: 0 auto!important; /* makes it centered */
	clear: both!important;
}

/* Set the padding on the td rather than the div for Outlook compatibility */
.body-wrap .container {
	padding: 20px;
}

/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	max-width: 600px;
	margin: 0 auto;
	display: block;
}

/* Lets make sure tables in the content area are 100% wide */
.content table {
	width: 100%;
}

</style>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">

			<!-- content -->
			<div class="content">
			<table>
				<tr>
					<td>
						<img src="http://www.balifoodsafari.com/weblogo.jpg" style="height: 250px; margin: 0 0 40px;" height: 250px>
                        
                        <p><b>Salamat '.$dname.',</b></p>
                        
                        <p class="emphasis">You have a booking for our '.$bookingdata['tour'].' Tour</p>
                        
                        <p>
                            <b>Customer Name: </b>'.$bookingdata['cname'].'<br/>
                            <b>Hotel Name: </b>'.$bookingdata['hname'].'<br/>
                            <b>Hotel Area: </b>'.$bookingdata['harea'].'<br/>
                            <b>Date: </b>'.$tdate.'<br/>
                            <b>Number of Guests: </b>'.$bookingdata['nguests'].'<br/>
                            <b>Special Requirements: </b>'.$bookingdata['requirements'].'<br/>';
                            if(isset($bookingdata['hbname'])){
                                if($bookingdata['hbname'] == 'Yes'){
                                    $message .='<b>Hotel Booking Name: </b>'.$bookingdata['cname'];
                                }
                                else {
                                    $message .='<b>Hotel Booking Name: </b>'.$bookingdata['hbname'];
                                }
                            }

                        $message .='</p>
                        
                        <h3>VENUE ARRANGEMENTS</h3>
                        ____________________________________________________________
                        <p>
                            <b>FIRST VENUE</b> - 17:30 to 18:45<br/>
                            '.$restnames[0].'<br/>
                            '.$restlocations[0].'<br/>
                            '.$restphones[0].'<br/>
                        </p>
                        
                        <p>
                           <b>SECOND VENUE</b> - 19:00 to 20:00<br/>
                            '.$restnames[1].'<br/>
                            '.$restlocations[1].'<br/>
                            '.$restphones[1].'<br/>
                        </p>
                        <p>
                            <b>THIRD VENUE</b> - 20:15 to 21:15<br/>
                            '.$restnames[2].'<br/>
                            '.$restlocations[2].'<br/>
                            '.$restphones[2].'<br/>
                        </p>
                        ';
                        if(isset($restnames[3])) {$message .='
                            <p>
                                <b>FOURTH VENUE</b> - 20:15 to 21:15<br/>
                                '.$restnames[3].'<br/>
                                '.$restlocations[3].'<br/>
                                '.$restphones[3].'<br/>
                            </p>
                        ';}
                        $message .='<br/>____________________________________________________________
                        
                        <p>
                            <b>IMPORTANT NOTE:</b><br/>
                            <b>GUIDES:</b> Communicate with all venues if the Food Safari if delayed in anyway.<br/><br/>
                        </p>
                        <p>
                            This booking confirmation is deemed accepted by the recipient unless otherwise informed.<br/>
                            Queries should be made directly to:<br/><br/>
                        </p>

                        <p>
                            <b>Melky Schelling</b><br/>
                            Bali Food Safari <br/>
                            Indonesian Operations Manager.<br/>
                            + 89 605 293 637
                        </p>

			
		          </td>
		<td></td>
	</tr>
</table>
<!-- /body -->

<!-- footer -->
<table class="footer-wrap">
	<tr>
		<td></td>
		<td class="container">
			
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td align="center">
							
						</td>
					</tr>
				</table>
			</div>
			<!-- /content -->
			
		</td>
		<td></td>
	</tr>
</table>
<!-- /footer -->

</body>
</html>';