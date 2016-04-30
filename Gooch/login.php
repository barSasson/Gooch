<?php
$servername = "127.9.124.2:3306";
$server_login_username = "adminUbfgc62";
$server_login_password = "f_kHaNi63ccf";
$database_name = "dizz";
// Create connection
$server_connect_response = mysql_connect($servername, $server_login_username, $server_login_password);

if (!$server_connect_response) {
 die("Database connection failed " . mysql_error());
 }
 
mysql_select_db($database_name);



$safe_username_input = mysql_real_escape_string($_POST["username-input"]);
$safe_password_input = $_POST["password-input"];
$input_was_given = isset($_POST["password-input"]) && isset($_POST["username-input"]);


$sql_query = "SELECT password,id FROM users WHERE username='".$safe_username_input."'";
$query_result = mysql_query($sql_query);
if (!$query_result) {
    echo "DB Error, could not process the query\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

$first_row_in_query_result = mysql_fetch_assoc($query_result);
$password_is_matching = hash("sha256", $safe_password_input) == $first_row_in_query_result['password'];

if($input_was_given && $password_is_matching)
{
   session_start();
   $_SESSION['loggedin'] = true;
   $_SESSION['user_id'] = $first_row_in_query_result['id'];
   header("Location: ./addshift.php");
}
else
{
header("Location: ./index.php?login_failed");
}


 mysql_close($server_connect_response);

?>


