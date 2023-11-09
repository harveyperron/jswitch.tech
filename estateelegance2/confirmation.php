<?php
$payment_method=$_GET['payment_method'];
$order_id=$_GET['order_id'];
require_once('vendor/autoload.php');
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
		$balance_paid=$order_price+$order_tax;
	}
	//$result->free();
}
// Calendar funtionalities
$buffer_before=0;
$buffer_after=0;
$query="select buffer_after,buffer_before from admin_data where id=1";
if($result = $conn-> query($query)){
    while ($row = $result->fetch_assoc()) {
        $buffer_after=$row["buffer_after"];
        $buffer_before=$row["buffer_before"];
	}
	echo " buffers collected ";
	//$result->free();
}
$query="update calendar set order_ref=".$order_id." WHERE block BETWEEN DATE_SUB('".$appointment_datetime."', INTERVAL 5 HOUR) AND DATE_ADD('".$appointment_datetime."', INTERVAL 5 HOUR)";
if($result = $conn-> query($query)){
	echo " event added to calendar";
	//$result->free();
}
$query="update calendar set is_booked=true WHERE order_ref=".$order_id;if($result = $conn-> query($query)){echo " block booked ";}
$query="update calendar set is_available=false WHERE order_ref=".$order_id;if($result = $conn-> query($query)){echo " block set unavailable ";}
$query="update orders set order_paid=true WHERE order_id=".$order_id;if($result = $conn-> query($query)){echo " payment confirmed in database";}
$query="update orders set order_status='ordered' WHERE order_id=$order_id";if($result = $conn-> query($query)){echo " updating status ";}
$query="update orders set balance_paid=".$balance_paid." WHERE order_id=$order_id";if($result = $conn-> query($query)){echo " updating balance ";}
$query="update orders set payment_method='".$payment_method."' WHERE order_id=$order_id";if($result = $conn-> query($query)){echo " method saved ";}
$conn->close();

require_once('/home/u853804124/public_html/TCPDF/tcpdf.php');
$pdf = new TCPDF('P', 'mm', array(210, 297), true, 'UTF-8', false);
$pdf->setCellHeightRatio(1);
// set document information
$pdf->SetCreator('Estate Elegance');
$pdf->SetAuthor('Estate Elegance booking');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Order #'.$order_id);

// set default font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// set some content
//estateelegance.com help@estateelegance.com
//1514 237 5206

$pdf->Cell(0, 5, 'estateelegance.com', 0, 1);
$pdf->Cell(0, 5, '4165 Croissant Olivier, Brossard, QC J4Y 2LE', 0, 1);
$pdf->Cell(0, 5, 'Toronto, Ontario, M1S1V2', 0, 1);
$pdf->Ln();
$pdf->Cell(0, 5, $client_firstname.' '.$client_lastname, 0, 1, 'L');
$pdf->Cell(0, 5, $client_address, 0, 1, 'L');
//$pdf->Cell(0, 10, $client_address2, 0, 1, 'L');
$pdf->Cell(0, 5, $client_phone, 0, 1, 'L');
$pdf->Cell(0, 5, $client_email, 0, 1, 'L');
$pdf->Cell(0, 5, 'Receipt #INV'.$order_id, 0, 1, 'R');
$pdf->Cell(0, 5, 'Payment Date:'.$filing_datetime, 0, 1, 'R');
$pdf->Ln();
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(100, 10, 'Description', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Quantity', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Unit Price', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Total', 1, 1, 'C', 1);
$pdf->SetFillColor(255, 255, 255);
$hunt_dog=0;
forEach($requested_services as $requested_service){
	if($hunt_dog<count($requested_services)-1){
		$pdf->Cell(100, 10, $requested_service->service, 1, 0);
		$pdf->Cell(30, 10, $requested_service->amount, 1, 0, 'R');
		$service_price=$requested_service->price;
		$service_amount=$requested_service->amount;
		$unit_price=fdiv((float)$service_price,(float)$service_amount);
		$pdf->Cell(30, 10, '$'.$unit_price, 1, 0, 'R');
		$pdf->Cell(30, 10, '$'.$service_price, 1, 1, 'R');
	}
	$hunt_dog++;
}

$pdf->Ln();
$pdf->Cell(100, 10, '', 0, 0);
$pdf->Cell(30, 10, '', 0, 0);
$pdf->Cell(30, 5, 'Subtotal', 0, 0, 'R', 1);
$pdf->Cell(30, 5, '$ '.$order_price, 0, 1, 'R');
$pdf->Cell(100,5, '', 0, 0);
$pdf->Cell(30, 5, '', 0, 0);
$pdf->Cell(30, 5, 'Discount', 0, 0, 'R', 1);
$pdf->Cell(30, 5, '$ 0.00', 0, 1, 'R');
$pdf->Cell(100,5, '', 0, 0);
$pdf->Cell(30, 5, '', 0, 0);
$pdf->Cell(30, 5, 'Tax Rate', 0, 0, 'R', 1);
$pdf->Cell(30, 5, $tax_rate.' %', 0, 1, 'R');
$pdf->Cell(100,5, '', 0, 0);
$pdf->Cell(30, 5, '', 0, 0);
$pdf->Cell(30, 5, 'Tax (HST)', 0, 0, 'R', 1);
$pdf->Cell(30, 5, '$ '.$order_tax, 0, 1, 'R');
$pdf->Cell(100,5, '', 0, 0);
$pdf->Cell(30, 5, '', 0, 0);
$pdf->Cell(30, 5, 'Balance Paid', 0, 0, 'R', 1);
$pdf->Cell(30, 5, '$ '.$balance_paid, 0, 1, 'R');
$pdf->Ln();
$pdf->Cell(0, 10, 'Thank you for your business!', 0, 1, 'L', 1);
$pdf->Output('/home/u853804124/domains/estateelegance.com/public_html/invoices/pdf/order'.$order_id.'.pdf', 'F');
$invoice_path="https://estateelegance.com/invoices/pdf/order".$order_id.".pdf";

// Email


$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
$query="update orders set receipt_path='".$invoice_path."' where order_id=".$order_id;
$conn-> query($query);
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
Appointment time: $appointment_datetime;
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
	 
	$to=$client_email;
	//$to="jmhperron@gmail.com";
	$subject = "Order confirmation"; 
	if(mail($to, $subject, $htmlContent, $headers)){ 
		echo 'Email has sent successfully.'; 
	}else{ 
		echo 'Email sending failed.'; 
	}
}
$conn->close();
header('Location: https://estateelegance.com/index.php/Thankyou');
?>
