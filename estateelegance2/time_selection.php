<?php 
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
$year=$_GET['year'];
$month=$_GET['month'];
$day=$_GET['day'];
if($result = $conn-> query("SELECT time(block) as time_block FROM calendar WHERE year(block)=".$year." and month(block)=".$month." and dayofmonth(block)=".$day." and is_available=true")){
    while($row = $result->fetch_assoc()){
		$block=$row['time_block'];
		echo "<option>".$block."</option>";
	}
}
$conn->close();
?>
