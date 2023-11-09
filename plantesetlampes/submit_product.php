<?php include "../lib/jmhp.php";?>
<center>
<div class=fvs>
	<label for=file><input id=file type=file accept="image/*"/><div id=take_photo_button class=fvc></div></label>
	<input type=text name=product_name id=product_name placeholder="Product Name" autofocus></input>
</div>
</center>
<style>
input{
	height:5vh;
	border-radius:18px;
	outline:0;
	font-size:3vh;
	text-align:center;
	max-width:500px;
	background-color:rgba(223, 225, 240,.8);
}
div,input{
	
}
:root{
	background:url('https://images.squarespace-cdn.com/content/v1/58b3be1bbe65940cc4869dfe/1643221898811-41OC13SDL43JFNM1BXHU/Victorian%2BLampshades%2BElegance%2BLamps%2BCrystal%2BHayes.jpeg?format=2500w');
	background-size:cover;
}
input[type=file]{
    display:none;
}
#take_photo_button{
	background-color:rgba(223, 225, 240,.8);
	background:url('https://free-icons-download.net/images/camera-icon-43654.png');
	background-position:center;
	background-size:90%;
	border-radius:100%;
	width:12vh;	
	height:12vh;
	font-size:2vh;
	text-align:center;
}
</style>
