<?php
date_default_timezone_set("America/New_York"); 
$order_infos=json_decode(file_get_contents('php://input'));
$order_id=$order_infos->order_id;

$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
foreach($order_infos as $key => $value) {
	if($key!="order_id"){
		$query="update orders set ".$key."='".$value."' where order_id=".$order_infos->order_id;
		if($result = $conn-> query($query)){
			//$result->free();
		}
	}
}
$dt_now=date("Y-m-d H:i:s");
$query="update orders set filing_datetime='".$dt_now."' where order_id=".$order_infos->order_id;
if($result = $conn-> query($query)){
	//$result->free();
}
$query="select tax_rate,order_price from orders where order_id=".$order_id;
if($result = $conn-> query($query)){
    while ($row = $result->fetch_assoc()) {
        $tax_rate=$row["tax_rate"];
		$order_price=$row["order_price"];
	}
	//$result->free();
}
$order_tax=$order_price*$tax_rate/100;
$query="update orders set order_tax=".$order_tax." where order_id=".$order_infos->order_id;
if($result = $conn-> query($query)){
	//$result->free();
}
$total_to_pay=$order_price+$order_tax;
//$conn -> close();


 // For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = false;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'email' => 'iosypenko9@gmail.com',
    'return_url' => 'https://estateelegance.com/index.php/thankyou/',
    'cancel_url' => 'https://estateelegance.com/index.php/thankyou/',
    'notify_url' => 'https://estateelegance.com/payment.php'
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Product being purchased.
$itemAmount = $total_to_pay;

// Include Functions
//require 'functions.php';

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {
	$order_id = $order_infos->order_id;
	if(!isset($order_id) || $order_id == '')
	{
		header('Location: '.$newURL);
	}
	if(!$conn){die("Connection failed:".mysqli_connect_error());}
	if ($result = $conn-> query("SELECT * FROM orders where order_id=".$order_id)) {
		while ($row = $result->fetch_assoc()) {
			$requested_services=$row["requested_services"];
		}
		//echo $requested_services;
	}
	$conn->close();
	
	//echo "<pre>";
	$pdata = json_decode($requested_services);
	if(count($pdata) > 0) 
	{
		//echo "<pre>";
		//print_r($pdata );
	
    // Grab the post data so that we can set up the query string for PayPal.
    // Ideally we'd use a whitelist here to check nothing is being injected into
    // our post data.
	$i = 0;
    foreach ($pdata as $key => $value) {
		if(!isset($value->order_price))
		{
			$data['item_number_' . ($i+1)] = $i;
        	$data['item_name_' . ($i+1)] = $value->amount.'X'.$value->service;
        	$data['quantity_' . ($i+1)] = 1;
        	$data['amount_' . ($i+1)] = $value->price;
			$i++;
		}
    }

    // Set the PayPal account.
    $data['business'] = $paypalConfig['email'];
	$data['first_name'] = $order_infos->client_firstname;
	$data['last_name'] = $order_infos->client_lastname;
	$data['payer_email'] = $order_infos->client_email;
   	$data['address1'] = $order_infos->client_address;
	$data['address2'] = $order_infos->client_address2;
	$data['zip'] = $order_infos->client_postalcode;
	$data['city'] = $order_infos->client_city;
	$data['state'] = $order_infos->client_province;
	//$data['add'] = 1;
	// Set the PayPal return addresses.
    $data['return'] = stripslashes($paypalConfig['return_url']);
    $data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
    $data['notify_url'] = stripslashes($paypalConfig['notify_url']);
	$data['cmd'] = '_cart';
	$data['upload'] = 1;
	$data['tax_cart'] = $order_tax;

	
    // Set the details about the product being purchased, including the amount
    // and currency so that these aren't overridden by the form data.
    $data['amount'] = $itemAmount;
    $data['currency_code'] = 'CAD';

    // Add any custom fields for the query string.
    //$data['custom'] = USERID;

    // Build the query string from the data.
    $queryString = http_build_query($data);

    // Redirect to paypal IPN
    	$redirect = $paypalUrl . '?' . $queryString;
	//exit;
		$return = array();
		$return['success'] = "1";
		$return['payment_url'] = $redirect;
	}
	else
	{
		$return = array();
		$return['success'] = "0";
		$return['payment_url'] = '';

	}
		echo json_encode($return);
    die();

} else {
    // Handle the PayPal response.
}
