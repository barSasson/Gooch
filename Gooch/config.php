<?php
$servername = "localhost";
$server_login_username = "root";
$server_login_password = "";
$database_name = "dizz";
// Create connection
$server_connect_response = mysql_connect($servername, $server_login_username, $server_login_password);

if (!$server_connect_response) {
 die("Database connection failed " . mysql_error());
 }
 
mysql_select_db($database_name);
mysql_query("SET NAMES 'utf8'");

?>


