<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@300&family=Zilla+Slab&display=swap" rel="stylesheet">
<?php
echo "<script src='https://estateelegance.com/interact_with_calendar.js'></script>";//admin_container
echo "<!DOCTYPE html><link rel=\"stylesheet\" href=\"https://estateelegance.com/admin.css\">";
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js\"></script>";
echo "<div id=admin_container class='fhs w'>
<div class=admin_bubble class='fhc w'>";
// calendar:
echo "<div class='fvs w admin_bubble'>
<section_title>

</section_title>";
echo "<div id=cal_container class=fhc>";
echo  "<iframe id=calendar src='https://estateelegance.com/calendar.php'></iframe>";
echo "</div>";
echo "</div>";
echo "<script>var iFrameContent = document.getElementById('calendar').contentWindow.document.body.innerHTML;
				console.log(iFrameContent);</script>";

// regular business hours:
echo "<div class='fvs admin_bubble'>";
echo "<section_title>regular business hours</section_title>
<div class=fhc>
<label>
  <input type=\"time\" value=\"08:00:00\">
</label>
&nbsp To &nbsp
<label>
  <input type=\"time\" value=\"17:00:00\">
</label>
</div>";
echo "</div>";
// regular business days
echo "<div class='fvs admin_bubble'>
<center>
<section_title>regular business days</section_title>
<div class=fhc>
<label>
  <input type=\"checkbox\" value=\"Sunday\">
  Sun
</label>
<label>
  <input type=\"checkbox\" checked value=\"Monday\">
  Mon
</label>
<label>
  <input type=\"checkbox\" checked value=\"Tuesday\">
  Tues
</label>
<label>
  <input type=\"checkbox\" checked value=\"Wednesday\">
  Wed
</label>
<label>
  <input type=\"checkbox\" checked value=\"Thursday\">
  Thu
</label>
<label>
  <input type=\"checkbox\" checked value=\"Friday\">
  Fri
</label>
<label>
  <input type=\"checkbox\" value=\"Saturday\">
  Sat
</label></div></div></div>";
// Upcoming shootings section
echo "<div class='admin_bubble widget'><div class=fhc><section_title>Upcoming shootings</section_title></div>";
$upcoming_orders_ids=array();
if ($result = $conn-> query("SELECT distinct order_ref FROM calendar WHERE block >=(NOW()- INTERVAL 1 MONTH) and order_ref is not null")){
    while($row = $result->fetch_assoc()){
		array_push($upcoming_orders_ids,$row["order_ref"]);
	}
}
foreach($upcoming_orders_ids as $order_id){
	if ($result = $conn-> query("SELECT * from orders where order_id=".$order_id." and date(appointment_datetime) >= date(now())")){
    	while($row = $result->fetch_assoc()){
			$client_email=$row["client_email"];
			$client_firstname=$row["client_firstname"];
			$client_lastname=$row["client_lastname"];
			$requested_services=json_decode($row["requested_services"],true);
			$client_address=$row["client_address"];
			$client_address2=$row["client_address2"];
			$client_city=$row["client_city"];
			$client_phone=$row["client_phone"];
			$appointment_datetime=$row["appointment_datetime"];
			$appointment_date = substr($appointment_datetime,0,-9);
			echo "<div id=upcoming_container>";
	        echo "<div ref=".$order_id." name='".$appointment_date."' class=upcoming>";
			echo "<div>Address: ".$client_address." ".$client_address2.", ".$client_city."</div>";
			echo "<div class=order details>Order details:<ul>";
			foreach($requested_services as $service){
				if(isset($service['service'])){
					echo "<li>".$service['amount']."X ".$service['service']."</li>";
				}else{
					echo "</ul>";
					echo "Total price:<b> $".$service['order_price']."</b>";
				}
			}
			echo "<div class=fhs>Contact:<br>".$client_firstname." ".$client_lastname. "|".$client_email."|".$client_phone."</div>";
			echo "<div >Shooting date: ".$appointment_datetime."</div>";
			echo "</div></div>";
		}
	}
}
echo "</div></div>";
// Awaiting section
echo "<div class='admin_bubble fvs w'><div class=fhc><section_title>Awaiting delivery</section_title></div>";

$waiting_orders_ids=array();
if ($result = $conn-> query("SELECT DISTINCT order_id FROM orders where date(appointment_datetime) < date(NOW()) and order_status=\"ordered\"")){
    while($row = $result->fetch_assoc()){
		array_push($waiting_orders_ids,$row["order_id"]);
	}
}
foreach($waiting_orders_ids as $order_id){
	if ($result = $conn-> query("SELECT * from orders where order_id=".$order_id." and date(appointment_datetime)<date(now())")){
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
			echo "<div id=awaiting_container>";
	        echo "<div ref=".$order_id." name='".$appointment_date."' class=awaiting>";
	        echo "<div class=client_name>".$client_firstname." ".$client_lastname."</div><div class=order details>Order details: <ul>";
			foreach($requested_services as $service){
				if($service['service']){
					echo "<li>".$service['service']."</li> ";
				}else{
					echo "</ul>";
					echo "Amount paid:<b> $".$service['order_price']."</b>";
					echo "<div>Address: ".$client_address." ".$client_address2.", ".$client_city."</div>";
					echo "</div><div class=fha><input class=google_drive_link_input name=\"".$order_id."\" placeholder=\"link to client's products\" type=text></input><div class=send_button>Deliver</div></div></div>";
				}
	
			}
		}
	}
}
echo "</div></div>";
echo "</div></body>";
/*
  var x = document.getElementById('calendar');
  var cal = x.contentDocument;

console.log(cal);
var tds=cal.getElementsByClassName('day');
for(i=0;i<tds.length;i++){
	tds[i].onclick=function(){
		$.ajax({
	   		type: 'POST',
			dataType: 'text',
			data: '2023-04-07',
   			url: 'https://estateelegance.com/whatsonthisdate.php',
   			success: function(response){
				alert(response);
			}
		});
	}
}
});
</script>";
*/
$conn->close();
?>
<style>
section_title{
	font-size:23px;	
	z-index:20;
}
iframe{
	border:solid 1px black;
	border-radius:8px;
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
	background:#00bfa5;
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
	min-height:325px;
}
.admin_bubble{
	flex:1;
	height:min-content;
	flex-wrap:wrap;
font-family: 'Zilla Slab', serif;
}
:invalid{
	background:black;
}
.admin_bubble{
	border-radius:9px;
	border:solid 1px black;
	background:beige;
	padding:1vw;
	text-align:center;
}
.awaiting:hover{
	background-color:#337ab7;
	color:white;
}
.upcoming:hover{
	background-color:#337ab7;
}
.upcoming{
transition:.1s;
	border:solid 1px white;	
	text-align:left;
	color:black;
	margin:5px;
	border:solid 1px black;
	background:lightgreen;
	padding:5px;
	border-radius:9px;
}
.awaiting{
	margin:5px;
	border:solid 1px black;
	padding:5px;
	border-radius:9px;
	background:pink;
	border:solid 1px black;	
	color:black;
	text-align:left;
}
#admin_container{
	border-radius:9px;
	diplay:flex;
	justify-content:space-around;
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
#cal_container{
	height:300px;
}
</style>
