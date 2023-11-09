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
	var highlightedDates=["; 
	$query="SELECT distinct date(block) as shooting_day from calendar where is_booked=true";
	if($result = $conn-> query($query)){
	    while ($row = $result->fetch_assoc()){
			echo "new Date('".$row['shooting_day']."'),"; 
		}
	}
echo "];";
echo "
	$('#datetimepicker1').datetimepicker({
 		format: 'YYYY-MM-DD hh:mm:ss',
    	daysOfWeekDisabled: [0,6],
  		disabledTimeIntervals: [";

	$query="SELECT MIN(block) AS period_start, MAX(block) AS period_end,order_ref FROM calendar where is_booked=true GROUP BY order_ref";
	if($result = $conn-> query($query)){
	    while ($row = $result->fetch_assoc()) {
	        
    		echo "[moment('".$row['period_start']."'), moment('".$row['period_end']."')],";
		}
	}
    		echo "[moment('2023-04-29 17:00:00'), moment('2023-04-29 19:00:00')]
  		],";
    	echo "beforeShowDay: function(date) {
        	var dateStr=moment(date).format('YYYY-MM-DD');
        	if (highlightedDates.indexOf(dateStr) >= 0) {
        	    return {
        	        classes: 'highlighted-date'
        	    };
        	}
        	return [true, '', ''];
    	}
	});
});
</script>";
$conn->close();
?>
<style>
.ui-datepicker-unselectable {
  background-color: grey;
}
.highlighted-date {
    background-color: yellow;
}
</style>
<script>
function getMonthNumberFromName(monthName) {
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
	return months.indexOf(monthName)+1;
}
setInterval(function(){
var display_year=$('.picker-switch').html().split(" ")[1];
var display_month=$('.picker-switch').html().split(" ")[0];
var month_number=getMonthNumberFromName(display_month);
console.log(month_number);
},1000);
</script>
