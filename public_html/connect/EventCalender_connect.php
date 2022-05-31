<?php
$date = $_POST['data1'];
//$date = "2018-04-01/2018-05-01";
 include_once('Intraday_IV.php');  
       
 $intraday_obj = new Intraday_IV(); 

echo json_encode($intraday_obj->get_event($date) );
?>
