<?php
$servername = "127.9.124.2:3306";
$server_login_username = "adminUbfgc62";
$server_login_password = "f_kHaNi63ccf";
$database_name = "dizz";
// Create connection
$mysqli = mysqli_connect($servername, $server_login_username, $server_login_password, $database_name);

if (!$mysqli) {
 die("Database connection failed " . mysqli_error());
 }
mysqli_query($mysqli, "SET NAMES 'utf8'");

?>


