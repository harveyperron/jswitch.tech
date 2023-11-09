<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@300&family=Zilla+Slab&display=swap" rel="stylesheet">
<?php
$n=10;

function rdm_str($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}
//admin_container
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js\"></script>";
// Main-container
echo "<div id=admin_container class='fhs w'>";
// Upcoming shootings section
echo "<div id=upcoming_container class=>";
$upcoming_orders_ids=array();
if ($result = $conn-> query("SELECT distinct order_ref FROM calendar WHERE block >=(NOW()- INTERVAL 1 MONTH) and order_ref is not null")){
    while($row = $result->fetch_assoc()){
		array_push($upcoming_orders_ids,$row["order_ref"]);
	}
}
foreach($upcoming_orders_ids as $order_id){
	if ($result = $conn-> query("SELECT * from orders where order_id=".$order_id." and date(appointment_datetime) > date(now())")){
    	while($row = $result->fetch_assoc()){
			$client_email=$row["client_email"];
			$client_firstname=$row["client_firstname"];
			$client_lastname=$row["client_lastname"];
			$requested_services=json_decode($row["requested_services"],true);
			$client_address=$row["client_address"];
			$client_address2=$row["client_address2"];
			$client_city=$row["client_city"];
			$client_postalcode=$row["client_postalcode"];
			$client_phone=$row["client_phone"];
			$appointment_datetime=$row["appointment_datetime"];
			$appointment_date = substr($appointment_datetime,0,-9);
	        echo "<div ref=".$order_id." name='".$appointment_date."' class=upcoming>";
			date_default_timezone_set("America/New_York"); 
			$from = strtotime($appointment_datetime);
			$today = time();
			$difference = $from - $today;
			$in_days=floor($difference / 86400);  // (60 * 60 * 24)

			echo "<div >coming in ".$in_days." days:</div>";
			$address_string=$client_address.", ".$client_address2.", ".$client_city.", ".$client_province.", ".$client_postalcode;
			$formatted_address_string=str_replace(" ","+",$address_string);
			$map_link="https://www.google.com/maps/place/".$formatted_address_string;
			echo "<div class='location_link fhs'>";
			echo "<a href='".$map_link."'>";
			echo "<img src='https://icons.veryicon.com/png/o/miscellaneous/icon_1/address-60.png'></img>";
			echo $client_address.", ".$client_city;
			echo "</a>";
			echo "</div>";
			echo "<div class=order details>Services:<ul>";
			foreach($requested_services as $service){
				if(isset($service['service'])){
					echo "<li>".$service['amount']."X ".$service['service']."</li>";
				}else{
					echo "</ul>";
				}
			}
			echo "<div>Contact: ".$client_firstname." ".$client_lastname. "<br><a href='mailto:".$client_email."'>".$client_email."</a><br><a href='tel:+".$client_phone."'>".$client_phone."</a></div>";
					echo "<b> $".$service['order_price']."</b>"." paid with ".$row['payment_method'];
			echo "</div></div>";
		}
	}
}
$waiting_orders_ids=array();
if ($result = $conn-> query("SELECT DISTINCT order_id FROM orders where date(appointment_datetime) <= date(NOW()) and order_status=\"ordered\"")){
    while($row = $result->fetch_assoc()){
		array_push($waiting_orders_ids,$row["order_id"]);
	}
}
foreach($waiting_orders_ids as $order_id){
	if ($result = $conn-> query("SELECT * from orders where order_id=".$order_id." and date(appointment_datetime)<=date(now())")){
		while($row = $result->fetch_assoc()){
			$client_firstname=$row["client_firstname"];
			$client_lastname=$row["client_lastname"];
			$requested_services=json_decode($row["requested_services"],true);
			$client_address=$row["client_address"];
			$client_address2=$row["client_address2"];
			$client_city=$row["client_city"];
			$client_email=$row["client_email"];
			$appointment_datetime=$row["appointment_datetime"];
			$appointment_date = substr($appointment_datetime,0,-9);
	        echo "<div ref=".$order_id." name='".$appointment_date."' class=awaiting>";
	        echo "<div class=client_name>".$client_firstname." ".$client_lastname."</div><div class=order details>Services: <ul>";
			foreach($requested_services as $service){
				if($service['service']){
					echo "<li>".$service['service']."</li> ";
				}else{
					echo "</ul>";
					echo "<b> $".$service['order_price']."</b>"." paid with ".$row['payment_method'];
					echo "<div>Address: ".$client_address." ".$client_address2.", ".$client_city."</div>";
					echo "</div><div class=fha><input class=google_drive_link_input name=\"".$order_id."\" placeholder=\"link to client's products\" type=text></input><div class=send_button>Deliver</div></div></div>";
				}
	
			}
		}
	}
}
echo "</div>";
// Calendar
echo "<div id=center_column>";
echo "<div id=cal_container class=fhc>";
echo  "<iframe id=calendar src='https://estateelegance.com/calendar.php'></iframe>";
echo "</div>";
echo "</div>";
//admin-data
if($result = $conn-> query("SELECT * from admin_data where id=1")){
	while($row = $result->fetch_assoc()){
		$buffer_before=$row["buffer_before"];
		$business_starts_at=$row["business_starts_at"];
		$business_stops_at=$row["business_stops_at"];
		$minimum_booking_days=$row["minimum_booking_days"];
		$business_days=$row["business_days"];
	}
}
echo "<div id=cal_settings class='fvs'>";
// regular business days
echo "<div class='black fvc'>";
echo "regular business days:";
echo "<div class='fhs'>
<label>
  <input type=\"checkbox\" ";
if(str_contains($business_days,7)){echo "checked ";}
echo "value=7>
  Sun
</label>
<label>
  <input type=\"checkbox\" ";
if(str_contains($business_days,1)){echo "checked ";}
 echo "value=1>
  Mon
</label>
<label>
  <input type=\"checkbox\" ";
if(str_contains($business_days,2)){echo "checked ";}
echo "value=2>
  Tues
</label>
<label>
  <input type=\"checkbox\" ";
if(str_contains($business_days,3)){echo "checked ";}
echo "value=3>;
  Wed
</label>
<label>
  <input type=\"checkbox\" ";
if(str_contains($business_days,4)){echo "checked ";}
echo " value=4>;
  Thu
</label>
<label>
  <input type=\"checkbox\" ";
if(str_contains($business_days,5)){echo "checked ";}
echo "value=5>;
  Fri
</label>
<label>
  <input type=\"checkbox\" ";
if(str_contains($business_days,6)){echo "checked ";}
echo "value=6>
  Sat
</label>";
echo "</div>";
echo "</div>";
// business hours:
echo "<div class='fsc black'>
regular business hours
<br>
<label>
  <input type=\"time\" class=question name=business_starts_at value='".$business_starts_at."'>
</label>
&nbsp To &nbsp
<label>
  <input class=question name=business_stops_at type=\"time\" value='".$business_stops_at."'>
</label>";
echo "</div>";
//unavailable block
echo "<div class='fsc black'>
add unavailable block:
<br>
<label>
  <input class=question name=unavailable_start type=\"datetime-local\" value=\"\">
</label>
&nbsp To &nbsp
<label>
  <input class=question type=\"datetime-local\" name=unavailable_stops value=\"\">
</label>";
echo "</div>";
// Buffer Time
echo "<div class='fsc black'>
Transit time
<br>
<label>
  <input id=transit_input class=question name=buffer_before type='text' value='";
echo $buffer_before;
echo "'> 
</label>Hours
</div>";
//Save-button
echo "<div id=save_button class=send_button>Save</div>";


//closes main
echo "</div>";
echo "</div>";
echo "</div>";
echo "<br>";

$conn->close();
?>
<style>
input{
	max-width:300px;
}
label{
	color:white;
}
section_title{
	color:white;
	font-size:23px;	
	z-index:20;
}
iframe{
	height:100%;
	width:100%;
	border:none;
}
b{
	font-weight:bold;
}
.client_name{
	text-decoration:underline;
}
.google_drive_link_input{
	flex:2;
}
.send_button:hover{
	background:black;
	color:white;
	box-shadow:0 0 4px white;
}
.send_button{
	background:lightgrey;
	margin:4px;
	color:black;
	width:min-content;
	height:min-content;
	border-radius:5px;
	border:solid 1px black;
	padding:1vh;
}
#special_days{
}
.admin_bubble{
	flex:1;
	height:min-content;
	flex-wrap:wrap;
font-family: 'Zilla Slab', serif;
}
:invalid{
}
.admin_bubble{
	border-radius:9px;
	border:solid 1px black;
	background:beige;
	padding:1vw;
	text-align:center;
	min-width:260px;
	border:solid 1px black;
}
#awaiting_container{
	min-width:30px;
	border:solid 1px black;
}
#upcoming_container{
	padding:2vw;
	padding-top:0;
	min-width:300px;
	border:solid 1px black;
}
.upcoming{
	transition:.1s;
	border:solid 1px white;	
	text-align:left;
	color:black;
	margin:5px;
	border:solid 1px black;
	background:lightgreen;
	padding:17px;
}
.awaiting{
	margin:5px;
	border:solid 1px black;
	padding:17px;
	background:pink;
	border:solid 1px black;	
	color:black;
	text-align:left;
}
#admin_container{
	border-radius:9px;
	display:flex;
	flex-direction:row;
	flex-wrap:wrap;
	justify-content:center;
	border:solid 1px black;
}
img{
	width:30px;
}
#grve-content{
	background:black !important;
	background-size:100px;
	background-position:center;
	font-family: 'Zilla Slab', serif;
}
#center_column{
}
#cal_container{
	height:350px;
	width:100%;
	min-width:360px;
	border-radius:8px;
	display:flex;
	flex-direction:row;
	justify-content:center;
	padding-top:7px;
}
.black{
	color:white;
padding:2vw;
padding-top:0;
padding-bottom:0;
}
#save_button{
	margin-top:0;
	margin-left:2vw;
}	
#transit_input{
	max-width:50px;
}
</style>
