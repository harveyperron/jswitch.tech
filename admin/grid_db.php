<?php 
$servername = "mysql.jswitch.tech";$username ="jswitch_admin";$password = "after8choco";$database="jswitch_db";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
if(isset($_GET['query'])){
	$query=$_GET['query'];
	if($result = $conn-> query($query)){
		while($row = $result->fetch_assoc()) {
    		$data[] = $row;
		}
  		$colNames = array_keys(reset($data));
		echo "<table><tr>";
    	foreach($colNames as $colName)
    	{
    	   echo "<th>$colName</th>";
    	}
 		echo "</tr>";
    	foreach($data as $row)
    	{
    	   echo "<tr>";
    	   foreach($colNames as $colName)
    	   {
    	      echo "<td>".$row[$colName]."</td>";
    	   }
    	   echo "</tr>";
    	}
 		echo "</table>";
		$conn->close();
	}
}else{
	include '../lib/jmhp.php';
	echo "
		<style>th,td{text-align:center;padding:.6vw;border:solid 1px white;color:white;}input{outline:0;background:black;color:white;font-size:3vh;padding:2vh;text-align:center;}*{color:white;}:root{background:black;color:white;}</style>
		<center>
			<input type=text id=sql autofocus placeholder='Query'></input>
			<br>
			<br>
			<div id=result style='color:lime'></div>
		</center>
		<script>
		docReady(function(){
			var query='';
			var result=document.getElementById('result');
			setInterval(function(){
				query=document.getElementById('sql').value;
				$.ajax({
					type:'GET',
					url:'https://jswitch.tech/".$_SERVER['REQUEST_URI']."?random=".rand(0,1000000)."',
					data:{query:query},
					success:function(response){
						result.innerHTML=response;
					}
				});
			},1000);
		});
		</script>
	";
}
?>
