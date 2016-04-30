<?php
require_once('config.php'); 


$sql_query = "SELECT email,id FROM users";
$query_result = mysql_query($sql_query);
if (!$query_result) {
    echo "DB Error, could not process the query\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while($first_row_in_query_result = mysql_fetch_assoc($query_result))
{
	print_r($first_row_in_query_result);
}
 mysql_close($server_connect_response);

?>


