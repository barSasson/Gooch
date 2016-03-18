<?php
$servername = "127.0.0.1:3306";
$username = "adminUbfgc62";
$password = "f_kHaNi63ccf";

// Create connection
$db = mysql_connect($servername,$username,$password);
$m = new MongoClient();
$db = $m->selectDB('dizz');
echo $db;


 if (!$db) {
 die("Database connection failed miserably: ");
 }
 else
 {
 
 }

?>