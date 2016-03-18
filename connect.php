<?php
$servername = "127.0.0.1:3306";
$username = "adminUbfgc62";
$password = "f_kHaNi63ccf";

// Create connection
$db = mysql_connect($servername,$username,$password);

$m = new MongoClient("mongodb://127.9.124.4:27017/");
echo $m;
 if (!$db) {
 die("Database connection failed miserably: " . mysql_error());
 }
 else
 {
 
 }

?>