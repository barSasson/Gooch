<?php
  if(isset($_POST['shiftdata'])) {
    $json = $_POST['shiftdata'];
    var_dump(json_decode($json, true));
  } else {
    echo "Noooooooob";
  }
?>