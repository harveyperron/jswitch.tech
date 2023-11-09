<?php
$msg = "Subject: Order Confirmation - EstateElegance.comdownload detailed invoice from ";
if(mail("jmhperron@gmail.com","EstateElegance",$msg)){
	echo "ok";
}else{
	echo "no";
}
?>
