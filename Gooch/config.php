<?php
$servername = "127.7.203.2:3306";
$server_login_username = "adminGeMF3HG";
$server_login_password = "_kTYqdlwMtE9";
$database_name = "tips";
// Create connection
$mysqli = mysqli_connect($servername, $server_login_username, $server_login_password, $database_name);

if (!$mysqli) {
 die("Database connection failed " . mysqli_error());
 }
mysqli_query($mysqli, "SET NAMES 'utf8'");

?>


