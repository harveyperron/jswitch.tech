<?php
header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<div class='col-md-6'>
<div class="form-group">
<label class="control-label"></label>
<div class='input-group date' id='datetimepicker1'>
<input type='text' class="form-control" />
<span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div></div></div>

<?php 
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
echo "
<script>
$(function(){
	var partially_unavailable_dates=["; 
	//$query="SELECT distinct date(block) as shooting_day from calendar where is_booked=true";
	$query="SELECT date(appointment_datetime) as shooting_day from orders where order_status='ordered'";
	if($result = $conn-> query($query)){
		$n_row=mysqli_num_rows($result);
		$i_row=0;
	    while ($row = $result->fetch_assoc()){
			echo "'".$row['shooting_day']."'"; 
			if($i_row<($n_row-1)){
				echo ",";
			}
			$i_row++;
		}
	}
echo "];";
echo "
	$('#datetimepicker1').datetimepicker({
 		format: 'YYYY-MM-DD hh:mm:ss',
    	daysOfWeekDisabled: [],
  		disabledTimeIntervals: [";

	//$query="SELECT MIN(block) AS period_start, MAX(block) AS period_end FROM calendar where is_available=false";
$query="SELECT MIN(block) AS period_start, MAX(block) AS period_end  FROM (SELECT block,is_available,ROW_NUMBER() OVER (ORDER BY block) - ROW_NUMBER() OVER (PARTITION BY is_available ORDER BY block) AS grp FROM calendar) t WHERE is_available = false GROUP BY grp";
	if($result = $conn-> query($query)){
		$n_appointments=mysqli_num_rows($result);
		$appointment_index=0;
	    while ($row = $result->fetch_assoc()) {
    		echo "[moment('".$row['period_start']."'), moment('".$row['period_end']."')]";
			if($appointment_index<$n_appointments-1){	
				echo ",";
			}
			$appointment_index++;
		}
	}
  		echo "]";
	echo "});
var months = [
  	'January',
	'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
  ];

function getMonthNumberFromName(monthName){
	if(months.indexOf(monthName)<10){
		return '0'+(months.indexOf(monthName)+1);
	}else{
		return months.indexOf(monthName)+1;
	}
}
function getLastMonthNumberFromName(monthName){
	var lastmonthnumber;
	if(months.indexOf(monthName)<10){
	lastmonthnumber='0'+months.indexOf(monthName);
	}else{
		lastmonthnumber=months.indexOf(monthName);
	}

	if(lastmonthnumber==0)lastmonthnumber=12;
	return lastmonthnumber;
}
function getNextMonthNumberFromName(monthName){
	var nextmonthnumber;
	if(months.indexOf(monthName)<10){
	nextmonthnumber='0'+(months.indexOf(monthName)+2);
	}else{
		nextmonthnumber=months.indexOf(monthName)+2;
	}
	if(nextmonthnumber==13)nextmonthnumber=1;
	return nextmonthnumber;
}
var day_num;
$('td.day.today').css('border','solid 3px red');
$('td.day.today').css('color','black');
$('td.day.disabled').css('background-color','red');
$('td.day.disabled').css('color','black');
document.querySelectorAll('.bootstrap-datetimepicker-widget')[0].className+='picker-open';
document.querySelectorAll('.bootstrap-datetimepicker-widget')[0].style.width='350px';
$('td.day.active').css('background-color','white');
setInterval(function(){
	$('td.day.today').css('border','dotted 3px black');
	$('td.day.disabled').css('background-color','red');
	$('td.day.active').css('background-color','#337ab7');
	$('td.day.disabled').css('color','black');

	var display_year=$('.picker-switch').html().split(' ')[1];
	var display_month=$('.picker-switch').html().split(' ')[0];
	var month_number=getMonthNumberFromName(display_month);

	var tds=document.querySelectorAll('td.day.old');
	for(i=0;i<tds.length;i++){
		day_num=tds[i].innerHTML;
		var date_last_month=display_year+'-'+getLastMonthNumberFromName(display_month)+'-'+day_num;
		if(partially_unavailable_dates.indexOf(date_last_month)>-1){
			if(new Date() > new Date(date_last_month))tds[i].style.backgroundColor='pink';
			else if(new Date() <= new Date(date_last_month))tds[i].style.backgroundColor='lightgreen';
		}
	}
	tds=document.querySelectorAll('td.day:not(.old):not(.new)');
	for(i=0;i<tds.length;i++){
		day_num=tds[i].innerHTML;
		if(day_num<10){day_num='0'+day_num;};
		var date_this_month=display_year+'-'+getMonthNumberFromName(display_month)+'-'+day_num;
		if(partially_unavailable_dates.indexOf(date_this_month)>-1){
			if(parseInt(day_num)>=$('td.today').html())tds[i].style.backgroundColor='lightgreen';
			else if(parseInt(day_num)<$('td.today').html())tds[i].style.backgroundColor='pink';
		}
	}
	tds=document.querySelectorAll('td.day.new');
	for(i=0;i<tds.length;i++){
		day_num=tds[i].innerHTML;
		if(day_num<10){day_num='0'+day_num;};
		var date_next_month=display_year+'-'+getNextMonthNumberFromName(display_month)+'-'+day_num;
		if(partially_unavailable_dates.indexOf(date_next_month)>-1){
			if(new Date() <= new Date(date_next_month))tds[i].style.backgroundColor='lightgreen';
			else if(new Date() > new Date(date_next_month))tds[i].style.backgroundColor='pink';
		}
	}
	$('td.day.active').css('background-color','#337ab7');
},200);
document.getElementById('datetimepicker1').querySelector('input').style.display='none';
$('.input-group-addon').css('display','none');
});
</script>";
$conn->close();
?>
