<?php
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
$updated_admin_data=json_decode(file_get_contents('php://input'));
$unavailable_start='';
$unavailable_stops='';
foreach($updated_admin_data as $key => $value) {
	if(strcmp($key,"unavailable_start")==0){
		$unavailable_start=str_replace('T',' ',$value);
	}else if(strcmp($key,"unavailable_stops")==0){
		$unavailable_stops=str_replace('T',' ',$value);
		$query="update calendar set is_available=false,special_day=true where block>='".$unavailable_start."' and block<'".$unavailable_stops."'";
		if($result = $conn-> query($query)){
			echo "block from ".$unavailable_start." to ".$unavailable_stops." is set unavailable";
		}
	}else if(strcmp($key,"other")==0){
		$query="update calendar set other='".$value."' where block>='".$unavailable_start."' and block<'".$unavailable_stops."'";
		if($result = $conn-> query($query)){
			echo $key." set to ".$value." ";
		}
	}else{
		$query="update admin_data set ".$key."='".$value."' where id=1";
		if($result = $conn-> query($query)){
			echo $key." set to ".$value." ";
		}
	}
}
$query="select * from admin_data where id=1";
if($result = $conn-> query($query)){
    while ($row = $result->fetch_assoc()) {
        $business_stops_at=$row["business_stops_at"];
		$business_days=$row["business_days"];
        $business_starts_at=$row["business_starts_at"];
	}
}
$query="update calendar set is_available=true,regular=false where regular=true and is_booked=false";
if($result = $conn-> query($query)){
	echo "days washed";
}$query="update calendar set is_available=false,regular=true where '".$business_days."' not LIKE CONCAT('%',weekday, '%') or (time(block)<'".$business_starts_at."' or time(block)>'".$business_stops_at."') and is_booked=false";
if($result = $conn-> query($query)){
	echo "calendar fixed";
}




$conn->close();
?>
