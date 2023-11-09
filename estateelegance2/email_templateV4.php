<?php
$order_id=$_GET['order_id'];
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
//$date=date_create($appointment_datetime);
//$appointment_datetime=date_format($date,"l, M d, H:i");
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
body, table, td, a {-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
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
Thank you for choosing Estate Elegance. We value your business and look forward to serving you.
<br>
<br>
Best regards,
<br>
<br>
The Estate Elegance team
<br>
<br>
<a href='".$invoice_path."'>Detailed receipt here</a> 
<br>
<br>
<a href='https://estateelegance.com/index.php/pre-shoot-check-list/'>Check How To Prepare Your Home Before Shooting</a>
<br>
<br>
            <tr>
                <td align='center' style=' padding: 35px; background-color: #000000;' bgcolor='#00000'>
                <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                    <tr>
                        <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'>
                            <h2 style='font-size: 24px; font-weight: 800; line-height: 30px; color: #ffffff; margin: 0;'>
								Thanks for doing business with us!
                            </h2>
                        </td>
                    </tr>
/table>
    
</body>
</html>";

	$headers = "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
	$headers .= "From: estateelegance.com <noreply@estateelegance.com> \r\n";
	$headers .= "Reply-To:help@estateelegance.com\r\n" ."X-Mailer: PHP/" . phpversion();
	 
	//$to=$client_email;
	$to="jmhperron@gmail.com";
	$subject = "Order confirmation"; 
	if(mail($to, $subject, $htmlContent, $headers)){ 
		echo 'Email has sent successfully.'; 
	}else{ 
		echo 'Email sending failed.'; 
	}
}
$conn->close();
?>
