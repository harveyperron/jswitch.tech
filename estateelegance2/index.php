<?php
$servername = "mysql.jswitch.tech";$username ="jswitch_admin";$password = "after8choco";$database="jswitch_db";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
$categories=array();
$thumbnails=array();
if ($result = $conn-> query("SELECT * FROM services")) {
    while ($row = $result->fetch_assoc()) {
        $category = $row["category"];
		$thumbnail=$row["thumbnail"];
		if(in_array($category,$categories)==FALSE){
			array_push($categories,$category);
			array_push($thumbnails,$thumbnail);
		}
    }
    $result->free();
}
$catnumber=count($categories);
$imgnumber=count($thumbnails);

echo "<script>console.log('php counted " . $imgnumber . " different image thumbnails');</script>";
echo "<script>console.log('php counted " . $catnumber . " services categories');</script>";

echo "<div class=categories_container>";
$category_index=0;
foreach($categories as $category){
	echo "<div class=category_container><img src=\"" . $thumbnails[$category_index] . "\"></img><h5 class=category_title>" . $category . "</h5><form class=items_container>";
	if($result = $conn-> query("SELECT * FROM services where category=\"$category\" order by price asc")) {
      	while($row=$result->fetch_assoc()){
        	$product_name = $row["name"];
        	$product_description = $row["description"];
        	$product_price = $row["price"];
        	$product_duration = $row["duration"];
        	$product_category = $row["category"];
        	$product_id = $row["id"];				
				if(strcmp($product_name,"Custom amount")==0){
					echo "<label class=name_and_price><input class=\"$product_category\" type=\"checkbox\" name=\"$product_name\"><span class=product_name>Custom amount &nbsp </span><select name=\"$product_name\">";
					for($i=12;$i<100;$i++){echo "<option value=" . $i . ">" . $i . "</option>";}
					echo "</select><span class=price>$ </span></label>";
				}elseif(strcmp($product_name,"Choose Number of Rooms")==0){
					echo "<label class=name_and_price><input class=\"$product_category\" type=\"checkbox\" name=\"$product_name\"><span class=product_name>$product_name &nbsp </span><select name=\"$product_name\">";
					for($i=1;$i<200;$i++){echo "<option value=" . $i . ">" . $i . "</option>";}
					echo "</select><span class=price>$ </span></label>";
				}else{
					echo "<label class=name_and_price><input class=\"$product_category\" type=\"checkbox\" name=\"$product_name\" value=\"$product_name\"><span class=product_name>$product_name</span><span class=price>$ $product_price</span></label>";
				}
	  	}
		echo "</form>";
		$result->free();
	}
	$category_index++;
	echo "</div>";
}
$conn -> close();
echo "</div><center><br><br><div id=cart_widget><div id=cart_summary></div><div id=order_price></div><button id=finish_booking>Next</button></div><br><br><br></center>";
echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js\"></script>";
?>
<script>
// JavaScript Document
function docReady(fn){if(document.readyState==="complete"||document.readyState==="interactive"){setTimeout(fn,1);}else{document.addEventListener("DOMContentLoaded",fn);}} 
docReady(function(){
	var checkboxes=document.querySelectorAll('input[type="checkbox"]');
	//var radioboxes =document.querySelectorAll('input[type="radio"]');
	var cart_total=0.00;
	var n_selected=0;
	setInterval(function(){
		var photo_custom_amount_container=document.querySelectorAll('input[name="Custom amount"]')[0].parentElement;
		var n_desired_photos= photo_custom_amount_container.querySelector('select').value;
		var number_of_rooms_container=document.querySelectorAll('input[name="Choose Number of Rooms"]')[0].parentElement;
		var n_rooms=number_of_rooms_container.querySelector('select').value;
		number_of_rooms_container.querySelector('.price').innerHTML="$ "+(n_rooms*40).toFixed(2);
		photo_custom_amount_container.querySelector('.price').innerHTML="$ "+(n_desired_photos*4.4).toFixed(2);
		
		cart_total=0.00;
		n_selected=0;
		for(i=0;i<checkboxes.length;i++){
			if(checkboxes[i].checked){
				n_selected++;
				cart_total+=parseFloat(checkboxes[i].parentElement.querySelector('.price').innerHTML.replace("$ ",""));
			}
		}
		document.getElementById('order_price').innerHTML=n_selected+" Items<br>Total $ "+cart_total.toFixed(2);
		/*var elDistanceToTop = window.pageYOffset + document.getElementById('page-12397').getBoundingClientRect().top;
		
		console.log(elDistanceToTop);
		console.log(window.pageYOffset+ " "+);

		document.getElementById('cart_widget').style.position="fixed";
		document.getElementById('cart_widget').style.bottom="3vh";
				document.getElementById('cart_widget').style.left="50%";
				document.getElementById('cart_widget').style.backgroundColor="black";
				document.getElementById('cart_widget').style.color="white";
				document.getElementById('cart_widget').style.padding="1vh";*/
	},300);
	document.getElementById('finish_booking').onclick=function(){
		var requested_services='[';
		var service_option="";
		var price=0.00;
		var x=0;
		for(i=0;i<checkboxes.length;i++){
			if(checkboxes[i].checked){
				x++;
				if(typeof(checkboxes[i].parentElement.querySelector('select')) != 'undefined' && checkboxes[i].parentElement.querySelector('select') != null){
					service_option=checkboxes[i].parentElement.querySelector('select').value;
				}else{
					service_option=1;
				}
				price=checkboxes[i].parentElement.querySelector('.price').innerHTML.replace("$ ","");
				requested_services+='{"service":"'+checkboxes[i].name + '","amount":"'+service_option+'","price":"'+price+'"},';
			}
		}
		var price = document.getElementById('order_price').innerHTML.split("<br>")[1].replace("Total $ ","");
		if(price == "0.00")
		{
			alert("Please select at least one option");
			return false;
		}
		requested_services+='{"order_price":"'+document.getElementById('order_price').innerHTML.split("<br>")[1].replace("Total $ ","")+'"}]';
		console.log('sending through ajax'+requested_services);
		$.ajax({
            type: "POST",
			dataType: "text",
            url: 'https://estateelegance.com/service_request.php',
            data: requested_services,
            success: function(response){
				console.log(response);
				window.location.href = 'https://estateelegance.com/index.php/booking2/?order_id='+response;
            }
       });
	}
});
</script>
<style>
.price{
	font-weight:bold !important;
	white-space: nowrap;
	margin-left: auto; 
}
select{
	width:min-content !important;
	margin:0 !important;
	border-radius:37px;
}
.category_container{
	//border:solid 1px black;
	//border-radius:5px;
	//box-shadow: 0 0 7px black;
	flex:1;
	margin:1vw;
	padding:0vh;
	min-width:300px;
	width: 0;
}
.product_name{
	margin-left:1vh;
	margin-top: auto;
	margin-bottom:auto;

}
input{
	display:inline-block;
	vertical-align:top;
}
.categories_container{
	display:flex !important;
	flex-direction:row !important;
	justify-content:space-around !important;
	flex-wrap:wrap;
	width:100%;
}
.name_and_price{
	display:flex !important;
	//flex-direction:row !important;
	//justify-content:space-between !important;
	//flex-wrap:nowrap;
	//align-items: center; /* Align the baselines of the flex items */
}
.name_and_price:hover{
background-color: #fdffcd;
}
#finish_booking{
	
}
#grve-feature-section{
	transition:1s !important;
	display:none !important;
}
</style>
