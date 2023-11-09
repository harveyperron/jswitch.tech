<?php
if(isset($_GET['date']))$this_date=$_GET['date'];
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
echo "<table>";
echo "<tr><th></th><th>Block</th><th>Status</th><th>Comments</th></tr>";
$query="select *,time_format(time(block),'%H:%i') as time from calendar where (regular=false or is_booked=true) and date(block)='".$this_date."'";
if($result = $conn-> query($query)){
    while ($row = $result->fetch_assoc()) {
		if($row['is_booked']){
			$order_id=$row['order_ref'];
			$date = new DateTime($row['block']);
			$now = new DateTime();
			if($date <= $now) {
				echo "<tr>";
				echo "<td><div class=indicator style='background-color:pink;'></div></td>";
				echo "<td>".$row['time']."</td>";
				echo "<td>booked</td>";
				echo "<td>order ".$row['order_ref']."</td>";
				echo "<td><img name=$order_id class='delete_order indicator' style='width:20px;height:20px;' src ='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-WcJpTlSpemNRZG5ripso3tM8-_gAiPfeRQ&usqp=CAU'></img></td>";
				echo "</tr>";
			}else{
				echo "<tr>";
				echo "<td><div class=indicator style='background-color:lightgreen;'></div></td>";
				echo "<td>".$row['time']."</td>";
				echo "<td>booked</td>";
				echo "<td>order ".$row['order_ref']."</td>";
				echo "<td><img name=$order_id class='delete_order indicator' style='width:20px;height:20px;' src ='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-WcJpTlSpemNRZG5ripso3tM8-_gAiPfeRQ&usqp=CAU'></img></td>";
				echo "</tr>";
			}
		}else if($row['special_day']){
			echo "<tr>";
			echo "<td><div class=indicator style='background-color:gold;'></div></td>";
			echo "<td>".$row['time']."</td>";
			echo "<td>Unavailable</td>";
			echo "<td>".$row['other']."</td>";
			echo "<td><img name='".$row['block']."' class='back_available indicator' style='width:20px;height:20px;' src ='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-WcJpTlSpemNRZG5ripso3tM8-_gAiPfeRQ&usqp=CAU'></img></td>";
			echo "</tr>";
		}else{
			echo "<tr>";
			echo "<td><div class=indicator style='background-color:white;'></div></td>";
			echo "<td>".$row['time']."</td>";
			echo "<td>empty</td>";
			echo "<td>".$row['other']."</td>";
			echo "<td></td>";
			echo "</tr>";
		}
	}
}
echo "</table>";
$conn->close();
?>
