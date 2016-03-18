<?php
$servername = "127.0.0.1:3306";
$username = "adminUbfgc62";
$password = "f_kHaNi63ccf";

// Create connection
//$db = mysql_connect($servername,$username,$password);

$m = new MongoClient("127.9.124.4:27017");
$d=$m->bb;
echo $d;
 

?>