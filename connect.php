<?php
$s = new Mongo();
$m = new MongoClient();
$db = $m->selectDB('dizz');
echo $db;

?>