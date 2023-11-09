<?php 
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}

$result = $conn-> query("update calendar set is_available=false where block<=now()");
$year=file_get_contents('php://input');
if ($result = $conn-> query("SELECT distinct month(block) as month FROM calendar WHERE year(block)=".$year)){
    while($row = $result->fetch_assoc()){
		$month=$row['month'];
		echo "<option>".$month."</option>";
	}
}
$conn->close();
?>
