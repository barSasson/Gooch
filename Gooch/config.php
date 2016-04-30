<?php
$servername = "127.9.124.2:3306";
$server_login_username = "adminUbfgc62";
$server_login_password = "f_kHaNi63ccf";
$database_name = "dizz";
// Create connection
$server_connect_response = mysql_connect($servername, $server_login_username, $server_login_password);

if (!$server_connect_response) {
 die("Database connection failed " . mysql_error());
 }
 
mysql_select_db($database_name);

?>


