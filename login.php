<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["userName"]=="bar" && $_POST["Password"]=="2565121024") {
$_SESSION["id"]=5;
header("Location: ./calc.php");
}
else{
$_SESSION["LogInError"]=1;
header("Location: ./index.php");
}
exit;
?>