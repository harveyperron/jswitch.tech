<?php 
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
$year=$_GET['year'];
$month=$_GET['month'];
if($result = $conn-> query("SELECT distinct DAYOFMONTH(block) as day FROM calendar WHERE year(block)=".$year." and month(block)=".$month." and is_available=true")){
    while($row = $result->fetch_assoc()){
		$day=$row['day'];
		echo "<option>".$day."</option>";
	}
}
$conn->close();
?>
