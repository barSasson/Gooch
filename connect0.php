<?php
$servername = "127.9.124.2:3306";
$server_login_username = "adminUbfgc62";
$server_login_password = "f_kHaNi63ccf";



// Create connection
$db = mysql_connect($servername, $server_login_username, $server_login_password);

$safe_username_input = $_POST["username-input"];
$safe_password_input = $_POST["password-input"];
$password_input_was_given = isset($_POST["password-input"]);


 if (!$db) {
 die("Database connection failed miserably: " . mysql_error());
 }
mysql_select_db('dizz');

 $sql = "SELECT password FROM users WHERE username='".$safe_username_input."'";
 $result = mysql_query($sql);

$row = mysql_fetch_assoc($result);
$password_is_matching = hash("sha256", $safe_password_input) == $row['password'];

if($password_input_was_given && $password_is_matching)
{
   echo "login successful";
}
else
{
	echo $row['password'].'|';
	echo $_POST["password-input"].'|';
	echo $_POST["username-input"].'|';
}


 if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

?>


