<?php
require_once('config.php'); 
$safe_username_input = mysql_real_escape_string($_POST["username-input"]);
$safe_password_input = $_POST["password-input"];
$input_was_given = isset($_POST["password-input"]) && isset($_POST["username-input"]);


$sql_query = "SELECT password,id,username_heb FROM users WHERE username='".$safe_username_input."'";
$query_result = mysqli_query($mysqli, $sql_query);
if (!$query_result) {
    echo "DB Error, could not process the query\n";
    echo 'MySQL Error: ' . mysqli_error($mysqli);
    exit;
}

$first_row_in_query_result = mysqli_fetch_assoc($query_result);
$password_is_matching = hash("sha256", $safe_password_input) == $first_row_in_query_result['password'];

if($input_was_given && $password_is_matching)
{
   session_start();
   $_SESSION['loggedin'] = true;
   $_SESSION['user_id'] = $first_row_in_query_result['id'];
   $_SESSION['name'] = $first_row_in_query_result['username_heb'];
   header("Location: ./addshift.php");
}
else
{
header("Location: ./index.php?login_failed");
}


 mysqli_close($server_connect_response);

?>


