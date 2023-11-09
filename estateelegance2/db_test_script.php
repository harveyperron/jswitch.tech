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
$ordered_services = array();
$service_count=0;
foreach($requested_services as $service){
	if($service_count<count($requested_services)-1){
		$new_content=array(
	      'price_data' => array(
	        'currency' => 'cad',
	        'unit_amount' => $service->price*100,
	        'product_data' => array(
		    	'name' => $service->service,
 	       ),
 	     ),
 	     'quantity' => $service->amount,
    	);
	    array_push($ordered_services,$new_content);
		$service_count++;
	}
}
var_dump(json_encode($ordered_services));
?>
