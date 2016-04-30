<?php
require_once('config.php'); 

$safe_username_input = mysql_real_escape_string($_POST["username-input"]);
$safe_password_input = $_POST["password-input"];
$input_was_given = isset($_POST["password-input"]) && isset($_POST["username-input"]);


$sql_query = "SELECT email FROM users";
$query_result = mysql_query($sql_query);
echo mysql_num_rows($query_result);
var_dump($query_result);
$row = mysql_fetch_assoc($result);
print_r($row);
var_dump($row);


 mysql_close($server_connect_response);

?>


