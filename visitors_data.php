<?php
include 'js_db.php';
date_default_timezone_set("America/New_York");
$ip = $_SERVER['REMOTE_ADDR'];
$datetime = date('Y-m-d H:i:s');
$query = "INSERT INTO visitors (ip, date_time) VALUES ('$ip', '$datetime')";
$result = $conn->query($query);
$conn->close();
?>
