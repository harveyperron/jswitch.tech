<?php
include "js_db.php";
$client_name=$_POST['client_name'];
$amount=$_POST['amount'];
$project_name=$_POST['project_name'];
$sql="insert into transactions (project_name,client_name,amount) values('$project_name','$client_name',$amount);";
if($result=$conn->query($sql)){
	echo "transaction updated.";
}
$htmlContent= "<html>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='X-UA-Compatible' content='IE=edge' />
Bonjour!
<br>
$client_name vient d'envoyer $amount$ à Jswitch pour $project_name. Merci.
<br>
<style>
</style>
</html>
";

	$headers = "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
	$headers .= "From: jswitch.tech admin@jswitch.tech> \r\n";
	$headers .= "Reply-To:admin@jswitch.tech\r\n" ."X-Mailer: PHP/" . phpversion();
	 
	$to="jmhperron@gmail.com";
	$subject = "Jswitch got paid!"; 
	if(mail($to, $subject, $htmlContent, $headers)){ 
		echo "notification sent.";
	}else{ 
		echo "email couldn't be sent!";
	}

$conn->close();
?>
