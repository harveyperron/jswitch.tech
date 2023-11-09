<?php
$this_date=$_GET['date'];
echo $this_date;
echo "<script>alert('".$this_date."');</script>";
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
echo "<table>";
echo "<tr><th></th><th>time</th><th>status</th><tr>comments</tr></tr>";
$query="select *,time_format(time(block),'%H:%i') as time from calendar where (regular=false or is_booked=true) and date(block)='".$this_date."'";
if($result = $conn-> query($query)){
    while ($row = $result->fetch_assoc()) {
		if($row['is_booked']){
			$date = new DateTime($row['block']);
			$now = new DateTime();
			if($date < $now) {
				echo "<tr><td><div class=indicator style='background-color:pink;'></div></td><td>".$row['time']."</td><td>booked</td><td>order ".$row['order_ref']."</td></tr>";
			}else{
				echo "<tr><td><div class=indicator style='background-color:lightgreen;'></div><td>".$row['time']."</td><td>booked</td><td>order ".$row['order_ref']."</td></tr>";
			}
		}else if($row['special_day']){
			echo "<tr><td><div class=indicator style='background-color:gold;'></div><td><td>".$row['time']."</td><td>Unavailable</td><td>".$row['other']."</td></tr>";
		}else{
			echo "<tr><td><div class=indicator style='background-color:white;'></div></td><td>".$row['time']."</td><td>empty</td><td>".$row['other']."</td></tr>";
		}
	}
}
echo "</table>";
$conn->close();
?>
