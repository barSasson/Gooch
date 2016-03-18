<?php

$m = new MongoClient();
$db = $m->selectDB('dizz');
echo $db;

?>