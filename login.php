<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["userName"]=="bar") {
$_SESSION["id"]=5;

}
header("Location: ./index.php");

exit;
?>