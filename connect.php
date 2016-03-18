<?php
$servername = "127.0.0.1:3306";
$username = "adminUbfgc62";
$password = "f_kHaNi63ccf";

// Create connection
//$db = mysql_connect($servername,$username,$password);

$m = new MongoClient("mongodb://admin:eTbFI2KfnvTI@127.9.124.4:27017/dizz");
//$d = $m->selectCollection("bb");
 $db = $m->dizz;
$collections = $db->listCollections();
foreach ($collections as $collection) {
    echo "amount of documents in $collection: ";
    echo $collection->count(), "\n";
}


?>