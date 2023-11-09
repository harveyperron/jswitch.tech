<?php
$servername="mysql.jswitch.tech";$username ="jswitch_admin";$password="after8choco";$database="jswitch_db";$conn=mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
/*
$sql="select now() as now;";
$result=$conn->query($sql);
while($row=$result->fetch_assoc()){
	echo $row['now'];
}	
$conn->close();
*/
?>
