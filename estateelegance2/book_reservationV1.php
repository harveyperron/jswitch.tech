<?php
date_default_timezone_set("America/New_York"); 
$order_infos=json_decode(file_get_contents('php://input'));
$order_id=$order_infos->order_id;
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
foreach($order_infos as $key => $value) {
	if($key!="order_id"){
		$query="update orders set ".$key."='".$value."' where order_id=".$order_infos->order_id;
		if($result = $conn-> query($query)){
			echo $key.":".$value."|";
			//$result->free();
		}
	}
}
$dt_now=date("Y-m-d H:i:s");
$query="update orders set filing_datetime='".$dt_now."' where order_id=".$order_infos->order_id;
if($result = $conn-> query($query)){
	echo "timestamp added";
	//$result->free();
}
$query="select tax_rate,order_price from orders where order_id=".$order_id;
if($result = $conn-> query($query)){
    while ($row = $result->fetch_assoc()) {
        $tax_rate=$row["tax_rate"];
		$order_price=$row["order_price"];
		echo "rate: ".$tax_rate;
		echo "op: ".$order_price;
	}
	//$result->free();
}
$order_tax=$order_price*$tax_rate/100;
$query="update orders set order_tax=".$order_tax." where order_id=".$order_infos->order_id;
if($result = $conn-> query($query)){
	echo "tax filed ".$order_tax;
	//$result->free();
}
$conn -> close();
include "confirmation.php";
?>
