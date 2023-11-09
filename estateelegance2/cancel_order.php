<?php
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
$order_id=$_GET['order_id'];
$query="update orders set order_status='canceled_by_admin' where order_id=".$order_id;
if($result = $conn-> query($query)){
	$query="update calendar set is_booked=false where order_ref=".$order_id;
	if($result = $conn-> query($query)){
		$query="update calendar set is_available=true where special_day=false and regular=false and order_ref=".$order_id;
		if($result = $conn-> query($query)){
			$query="update calendar set order_ref=null where order_ref=".$order_id;
			if($result = $conn-> query($query)){
				echo $order_id;
			}
		}		
	}
}
$conn->close();
?>
