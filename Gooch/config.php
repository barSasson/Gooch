<?php
$servername = "127.7.203.2:3306";
$server_login_username = "adminGeMF3HG";
$server_login_password = "_kTYqdlwMtE9";
$database_name = "tips";
// Create connection
$server_connect_response = mysql_connect($servername, $server_login_username, $server_login_password);
if (!$server_connect_response) {
 die("Database connection failed " . mysql_error());
 }
 
mysql_select_db($database_name);
mysql_query("SET NAMES 'utf8'");
?>

