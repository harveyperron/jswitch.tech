<?php
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
$order_id=$_GET['order_id'];
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
		$stripe_total=100*($order_price+$order_tax);
	}
}
$conn->close();

require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51MoIdhJO5OCfeChiVE1Ua91vFQWumGwLfCnvf2E6PCAd0gapqv4yBl0X2iRVL9xhD5rRs3DT3qXt9JFPsQY0UoLV00gJ9q4bRT');
header('Content-Type: application/json');

$checkout_session = \Stripe\Checkout\Session::create([
  'success_url' => 'https://estateelegance.com/confirmation.php?order_id='.$order_id,
  'cancel_url' => 'https://estateelegance.com',
  'payment_method_types' => ['card'],
  'mode'=>'payment',
  'line_items' => [
    [
      'price_data' => [
        'currency' => 'cad',
        'unit_amount' => 1000,
        'product_data' => [
	    	'name' => 'Test Product',
        ],
      ],
      'quantity' => 1,
    ],
  ],
]);
echo json_encode(['sessionId' => $checkout_session->id]);
?>
