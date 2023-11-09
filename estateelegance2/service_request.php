<?php
$selected_services=file_get_contents('php://input');
//$json_array=json_decode($selected_services,true);
//echo $json_array[1]['service'];
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
if($result = $conn-> multi_query("insert into orders (requested_services,order_status) value ('$selected_services','incomplete');SELECT LAST_INSERT_ID();")) {
	do {
		if ($result = $conn->store_result()) {
            $row = $result->fetch_row();
            $last_insert_id = $row[0];
            $result->free();
        }
    }while ($conn->more_results() && $conn->next_result());

}
//$result->free();
$conn -> close();
echo $last_insert_id;
?>
