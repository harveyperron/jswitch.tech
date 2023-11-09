<?php
$order_id=213;
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
$query="select * from orders where order_id=".$order_id;
if($result = $conn-> query($query)){
    while ($row = $result->fetch_assoc()) {
        $requested_services=json_decode($row["requested_services"]);
        $appointment_datetime=$row["appointment_datetime"];
        $client_address=$row["client_address"];
        $client_address2=$row["client_address2"];
        $client_city=$row["client_city"];
        $client_province=$row["client_province"];
        $client_postalcode=$row["client_postalcode"];
        $client_firstname=$row["client_firstname"];
        $client_lastname=$row["client_lastname"];
        $client_email=$row["client_email"];
        $client_phone=$row["client_phone"];
        $order_price=$row["order_price"];
        $filing_datetime=$row["filing_datetime"];
        $order_paid=$row["order_paid"];
		$tax_rate=$row["tax_rate"];
		$order_tax=$row["order_tax"];
		$invoice_path=$row["receipt_path"];
		$stripe_total=100*($order_price+$order_tax);
	}
$date=date_create($appointment_datetime);
$appointment_datetime=date_format($date,"l, M d at H:i");
$htmlContent= "<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='X-UA-Compatible' content='IE=edge' />
<style type='text/css'>
#msg_content{
	text-align:justify;
}
body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
img { -ms-interpolation-mode: bicubic; }

img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
table { border-collapse: collapse !important; }
body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }


a[x-apple-data-detectors] {
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}

@media screen and (max-width: 480px) {
    .mobile-hide {
        display: none !important;
    }
    .mobile-center {
        text-align: center !important;
    }
}
div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>
<body style='margin: 0 !important; padding: 0 !important; background-color: #eeeeee;' bgcolor='#eeeeee'>


<div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'>
</div>

<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td align='center' style='background-color: #eeeeee;' bgcolor='#eeeeee'>
        
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
            <tr>
                <td align='center' valign='top' style='font-size:0; padding: 35px;' bgcolor='#F44336'>
               
                <div style='display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;'>
                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                        <tr>
                            <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;' class='mobile-center'>
                                <h1 style='font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;'>Estate Elegance.com</h1>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div style='display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;' class='mobile-hide'>
                    <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                        <tr>
                            <td align='right' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;'>
                                <table cellspacing='0' cellpadding='0' border='0' align='right'>
                                    <tr>
                                        <td style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400;'>
                                            <p style='font-size: 18px; font-weight: 400; margin: 0; color: #ffffff;'><a href='#' target='_blank' style='color: #ffffff; text-decoration: none;'>Shop &nbsp;</a></p>
                                        </td>
                                        <td style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 24px;'>
                                            <a href='#' target='_blank' style='color: #ffffff; text-decoration: none;'><img src='https://img.icons8.com/color/48/000000/small-business.png' width='27' height='23' style='display: block; border: 0px;'/></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
              
                </td>
            </tr>
            <tr>
                <td align='center' style='padding: 35px 35px 20px 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                    <tr>
                        <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'>
                            <img src='https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png' width='125' height='120' style='display: block; border: 0px;' /><br>
                            <h2 style='font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;'>
                                Thank You For Your Order!
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;'>
                            <div id=msg_content style='font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;'>
						

<br>
Dear $client_firstname,
<br>
<br>
Thank you for placing your order with EstateElegance.com
<br>
We received your order, and we are working diligently to complete it within 24 hours after the shoot.
<br>
<br>
Rest assured, all services you ordered will be delivered to this email address once they are ready. If we require any additional details or information, we will be sure to contact you promptly.
<br>
<br>
If you have any questions or concerns about your order, please don't hesitate to contact us at help@estateelegance.com or by using our Live Chat feature on our website.
<br>
<br>
<a href='https://estateelegance.com/index.php/pre-shoot-check-list/'>Check How To Prepare Your Home Before Shooting</a>
<br>
<br>
Thank you for choosing Estate Elegance. We value your business and look forward to serving you.
<br>
<br>
Best regards,
<br>
<br>
Estate Elegance Team
<br>
<br>
EstateElegance.com
<br>
<br>
download detailed invoice from $invoice_path





                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align='left' style='padding-top: 20px;'>
                            <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                <tr>
                                    <td width='75%' align='left' bgcolor='#eeeeee' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;'>
                                        Order Confirmation #
                                    </td>
                                    <td width='25%' align='left' bgcolor='#eeeeee' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;'>
                                        $order_id
                                    </td>
                                </tr>
                                <tr>
                                    <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'>
                                        Purchased Item (1)
                                    </td>
                                    <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'>
                                        $100.00
                                    </td>
                                </tr>
                                <tr>
                                    <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;'>
                                        Shipping + Handling
                                    </td>
                                    <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;'>
                                        $10.00
                                    </td>
                                </tr>
                                <tr>
                                    <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;'>
                                        Sales Tax
                                    </td>
                                    <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;'>
                                        $5.00
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align='left' style='padding-top: 20px;'>
                            <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                <tr>
                                    <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;'>
                                        TOTAL
                                    </td>
                                    <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;'>
                                        $115.00
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                
                </td>
            </tr>
             <tr>
                <td align='center' height='100%' valign='top' width='100%' style='padding: 0 35px 35px 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:660px;'>
                    <tr>
                        <td align='center' valign='top' style='font-size:0;'>
                            <div style='display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;'>

                                <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                    <tr>
                                        <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                            <p style='font-weight: 800;'>Address</p>
                                            <p>$client_address<br>$client_address2<br>$client_city, $client_province $client_postalcode</p>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div style='display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;'>
                                <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                    <tr>
                                        <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                            <p style='font-weight: 800;'>Shooting Date</p>
                                            <p>$appointment_datetime</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
            <tr>
                <td align='center' style=' padding: 35px; background-color: #ff7361;' bgcolor='#1b9ba3'>
                <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                    <tr>
                        <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'>
                            <h2 style='font-size: 24px; font-weight: 800; line-height: 30px; color: #ffffff; margin: 0;'>
								Thanks for doing business with us!
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td align='center' style='padding: 25px 0 15px 0;'>
                            <table border='0' cellspacing='0' cellpadding='0'>
                                <tr>
                                    <td align='center' style='border-radius: 5px;' bgcolor='#66b3b7'>
                                      <a href='https://estateelegance.com' target='_blank' style='font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #FFFFFF; padding: 15px 30px; border: 1px solid #F44336; display: block;'>Estate Elegance</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
            <tr>
                <td align='center' style='padding: 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                    <tr>
                        <td align='center'>
                            <img src='logo-footer.png' width='37' height='37' style='display: block; border: 0px;'/>
                        </td>
                    </tr>
                    <tr>
                        <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;'>
                            <p style='font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;'>
                                675 Parko Avenue<br>
                                LA, CA 02232
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;'>
                            <p style='font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;'>
                                If you didn't create an account using this email address, please ignore this email or <a href='#' target='_blank' style='color: #777777;'>unsusbscribe</a>.
                            </p>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
        </table>
        </td>
    </tr>
</table>
    
</body>
</html>";

	$headers = "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
	$headers .= "From: estateelegance.com <booking@estateelegance.com> \r\n";
	$headers .= "Reply-To:" . $from . "\r\n" ."X-Mailer: PHP/" . phpversion();
	 
	//$to=$client_email;
	$to="jmhperron@gmail.com";
	$subject = "Thank you for ordering with estateelegance.com"; 
	if(mail($to, $subject, $htmlContent, $headers)){ 
		echo 'Email has sent successfully.'; 
	}else{ 
		echo 'Email sending failed.'; 
	}
}
$conn->close();
?>
