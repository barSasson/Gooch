<?php
$servername = "127.9.124.2:3306";
$username = "adminUbfgc62";
$password = "f_kHaNi63ccf";
$id =1;
// Create connection
$db = mysql_connect($servername,$username,$password);




 if (!$db) {
 die("Database connection failed miserably: " . mysql_error());
 }
mysql_select_db('dizz');

 $sql = "SELECT password FROM users where id=".$id;
 $result = mysql_query($sql);

while($row = mysql_fetch_assoc($result))
{
   print_r($row);
   echo $row['password'];
}


 if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

?>


