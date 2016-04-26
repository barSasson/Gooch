<?php
$servername = "127.9.124.2:3306";
$username = "adminUbfgc62";
$password = "f_kHaNi63ccf";
$id = 1;
$pass = "2565121024";
// Create connection
$db = mysql_connect($servername,$username,$password);




 if (!$db) {
 die("Database connection failed miserably: " . mysql_error());
 }

mysql_select_db('dizz');

 $sql = "SELECT * FROM users WHERE id=1";
 $result = mysql_query($sql);

$row = mysql_fetch_assoc($result);
echo $row;
$hashed = hash('sha256', $pass); 


 if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

?>


