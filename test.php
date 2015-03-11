<?php

    $xml = simplexml_load_file('./waiters.xml') or die ("Error: failed to open xml") ;
session_start();

foreach($xml->waiter as $i){
if(isset($i->pass[0]))
unset($i->pass[0]); 
//if(isset($i['pass3']))
//unset($i['pass3']);
//$i->addAttribute('pass', $i[0]);

}
echo $xml->asXML('./waiters.xml'); 

//foreach( hash_algos() as $b)
//{echo $b; echo "<br>";}
?>
<script  type="text/javascript">
var size=<?php echo $xml['size'];?>;
var day = <?php echo json_encode($xml->waiter);?> ;
for(var i=0;i<size;i++){
        document.write(day[i]+"<br>");
    }
</script>

