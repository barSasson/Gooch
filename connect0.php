<?php
$servername = "127.9.124.2:3306";
$username = "adminUbfgc62";
$password = "f_kHaNi63ccf";

// Create connection
$db = mysql_connect($servername,$username,$password);




 if (!$db) {
 die("Database connection failed miserably: " . mysql_error());
 }


 $sql = "SHOW TABLES from dizz";
 $result = mysql_query($sql);



 if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
    echo "Table: {$row[0]}\n";
}

?>


