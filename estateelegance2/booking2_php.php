<?php
$order_id=$_GET["order_id"];
echo "<script>var order_id=".$order_id.";</script>";
echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js\"></script>";
echo "<script src='https://js.stripe.com/v3/'></script>";

$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
if ($result = $conn-> query("SELECT * FROM orders where order_id=".$order_id)) {
    while ($row = $result->fetch_assoc()) {
        $requested_services=$row["requested_services"];
	}
	//echo $requested_services;
}
$query="select tax_rate,order_price from orders where order_id=".$order_id;
if($result = $conn-> query($query)){
    while ($row = $result->fetch_assoc()) {
        $tax_rate=$row["tax_rate"];
	}
	//$result->free();
}
$conn->close();

echo "<script>var requested_services='".$requested_services."';</script>";
echo "<script>var tax_rate='".$tax_rate."';</script>";
//echo "<br>";

echo "<div class=>";
//include "https://estateelegance.com/datetime_picker.php";
?>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
	Select shooting time:<br>
<div id=datetime_picker class=fhs>
<select id=year_selection><option>2023</option><option>2024</option><option>2025</option><option>2026</option><option>2027</option><option>2028</option><option>2029</option><option>2030</option><option>2031</option><option>2032</option><option>2033</option><option>2034</option><option>2035</option><option>2036</option><option>2037</option><option>2038</option><option>2039</option><option>2040</option><option>2041</option><option>2042</option><option>2043</option><option>2044</option><option>2045</option><option>2046</option><option>2047</option><option>2048</option><option>2049</option><option>2050</option><option>2051</option><option>2052</option><option>2053</option><option>2054</option><option>2055</option><option>2056</option><option>2057</option><option>2058</option><option>2059</option><option>2060</option><option>2061</option><option>2062</option><option>2063</option><option>2064</option><option>2065</option><option>2066</option><option>2067</option><option>2068</option><option>2069</option><option>2070</option><option>2071</option><option>2072</option><option>2073</option><option>2074</option><option>2075</option><option>2076</option><option>2077</option><option>2078</option><option>2079</option><option>2080</option><option>2081</option><option>2082</option><option>2083</option><option>2084</option><option>2085</option><option>2086</option><option>2087</option><option>2088</option><option>2089</option><option>2090</option><option>2091</option><option>2092</option><option>2093</option><option>2094</option><option>2095</option><option>2096</option><option>2097</option><option>2098</option><option>2099</option><option>2100</option></select>
<select name=month_selection id=month_selection></select>
<select id=day_selection></select>
<select id=time_selection></select>
</div>
<script>
$(document).ready(function(){
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
$.ajax({
	type: 'POST',
	dataType: 'text',
	url: 'https://estateelegance.com/month_selection.php',
	data: document.getElementById('year_selection').value,
	success: function(response){
		$('#month_selection').html(response
								   .replace('10','October')
								  .replace('11','November')
								  .replace('12','December')
								  .replace('9','September')
								  .replace('8','August')
								  .replace('7','July')
								  .replace('6','June')
								  .replace('5','May')
								  .replace('4','April')
								  .replace('3','March')
								  .replace('2','February')
								  .replace('1','January')
								  );
$.ajax({
	type: 'get',
	dataType: 'text',
	url: 'https://estateelegance.com/day_selection.php',
	data:{year:document.getElementById('year_selection').value,
			month:getMonthNumberFromName(document.getElementById('month_selection').value)},
	success: function(response){
		$('#day_selection').html(response);
	$.ajax({
	type: 'get',
	dataType: 'text',
	url: 'https://estateelegance.com/time_selection.php',
	data:{
			year:document.getElementById('year_selection').value,
			month:getMonthNumberFromName(document.getElementById('month_selection').value),
			day:document.getElementById('day_selection').value
	},
	success: function(response){
		$('#time_selection').html(response);
	}});
	}});
	}});
document.getElementById('year_selection').onchange=function(){
$.ajax({
	type: 'POST',
	dataType: 'text',
	url: 'https://estateelegance.com/month_selection.php',
	data: document.getElementById('year_selection').value,
	success: function(response){
				$('#month_selection').html(response
								   .replace('10','october')
								  .replace('11','november')
								  .replace('12','december')
								  .replace('9','september')
								  .replace('8','august')
								  .replace('7','july')
								  .replace('6','june')
								  .replace('5','may')
								  .replace('4','april')
								  .replace('3','march')
								  .replace('2','february')
								  .replace('1','january')
								  );

	}
});
}
document.getElementById('month_selection').onchange=function(){
$.ajax({
	type: 'get',
	dataType: 'text',
	url: 'https://estateelegance.com/day_selection.php',
	data:{year:document.getElementById('year_selection').value,
			month:getMonthNumberFromName(document.getElementById('month_selection').value)},
	success: function(response){
		$('#day_selection').html(response);
	}
});
}
document.getElementById('day_selection').onchange=function(){
	$.ajax({
	type: 'get',
	dataType: 'text',
	url: 'https://estateelegance.com/time_selection.php',
	data:{year:document.getElementById('year_selection').value,
			month:getMonthNumberFromName(document.getElementById('month_selection').value),
		  day:document.getElementById('day_selection').value},
	success: function(response){
		$('#time_selection').html(response);
	}
});
}
});
</script>
<style>
	select, option, #year_selection, #month_selection, #day_selection, #time_selection{
		margin:1vw;width:120px !important;overflow:hidden;text-align:center;
	}
</style>
	<?php
echo "</div>";
echo "<br>";
echo "<form id='payment_form' name='payment_form' action='javascript:void(0);' method='post'>";
echo "<input type='hidden' name='order_id' value='".$order_id."' />";

echo "<h5>Personal Information</h5>";

echo "<div class=question>";
echo "<label for=\"client_firstname\">First name: *&nbsp</label>";
echo "<input type=\"text\" id=\"client_firstname\" name=\"client_firstname\">";
echo "</div>";

echo "<div class=question>";
echo "<label for=\"client_lastname\">Last name: *&nbsp</label>";
echo "<input type=\"text\" id=\"client_lastname\" name=\"client_lastname\" required>";
echo "</div>";

echo "<div class=question>";
echo "<label for=\"client_email\">Email: *&nbsp</label>";
echo "<input type=\"text\" id=\"client_email\" name=\"client_email\" required>";
echo "</div>";

echo "<div class=question>";
echo "<label for=\"client_phone\">Phone Number: *&nbsp</label>";
echo "<input type=\"text\" id=\"client_phone\" name=\"client_phone\" required>";
echo "</div>";

echo "<h5>Property Information</h5>";

echo "<div class=question>";
echo "<label for=\"client_address\">Address line 1: *&nbsp</label>";
echo "<input type=\"text\" id=\"client_address\" name=\"client_address\" required>";
echo "</div>";

echo "<div class=question>";
echo "<label for=\"client_address2\">Address line 2: *&nbsp</label>";
echo "<input type=\"text\" id=\"client_address2\" name=\"client_address2\">";
echo "</div>";

echo "<div class=question>";
echo "<label for=\"client_city\">City: *&nbsp</label>";
echo "<input type=\"text\" id=\"client_city\" name=\"client_city\" required>";
echo "</div>";

echo "<div class=question>";
echo "<label for=\"client_province\">Province: *&nbsp</label>";
echo "<input type=\"text\" id=\"client_province\" name=\"client_province\">";
echo "</div>";

echo "<div class=question>";
echo "<label for=\"client_postalcode\">Postal Code: *&nbsp</label>";
echo "<input type=\"text\" id=\"client_postalcode\" name=\"client_postalcode\" required>";
echo "</div>";

echo "<label for=\"on_site\">Will The Agent or Homeowner Meet Us On Site? *&nbsp</label>";
echo "<div class=question><input type=\"radio\" class=on_site checked value=\"yes\">Yes</input></div>";
echo "<div class=question><input type=\"radio\" class=on_site value=\"no\">No</input></div>";
echo "<br>";
echo "<br>";

echo "<label for=\"anytime_on_date\">Can the photographer go anytime on the scheduled date? *&nbsp</label>";
echo "<div class=question><input type=\"radio\" class=\"anytime_on_date\" checked value=\"yes\">Yes</input></div>";
echo "<div class=question><input type=\"radio\" class=\"anytime_on_date\" value=\"no\">No</input></div>";
echo "<br>";
echo "<br>";

echo "<div class=question>";
echo "<label for=\"additional_info\">Please enter anything else we may need to know (i.e. gate code, special feature of the home to make sure we get, etc.)</label>";
echo "<input type=\"text\" id=\"additional_info\" name=\"additional_info\">";
echo "</div>";
echo "<br>";

echo "<br><h5>Summary:</h5><div id=requested_services></div>";

echo "<center>Complete order with:";
echo "<br>";

echo "<button id=stripe_gateway>Card Payment</button>";
echo "&nbsp&nbsp";
echo "<button id=paypal_gateway>Paypal</button></center>";

echo "</form>";
?>
