<?php
$servername = "127.9.124.2:3306";
$server_login_username = "adminUbfgc62";
$server_login_password = "f_kHaNi63ccf";
$temp_pass= "2565121024";
$id =1;

// Create connection
$db = mysql_connect($servername,$server_login_username,$server_login_password);




 if (!$db) {
 die("Database connection failed miserably: " . mysql_error());
 }
mysql_select_db('dizz');

 $sql = "SELECT password FROM users where id=".$id;
 $result = mysql_query($sql);

$row = mysql_fetch_assoc($result);

if(hash("sha256", $temp_pass) == $row['password'])
{
   echo "login successful";
}
else
{
	echo "login failed";
}


 if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

?>


