<?php
$search = $_POST['search'];
//
//$search = "sbin";
//$date = "2018-04-10/2018-05-10";
 include_once('Intraday_IV.php');  
       
 $intraday_obj = new Intraday_IV(); 

echo json_encode($intraday_obj->get_event_dashboard($search)) ;

?>
