<?php 
/*$dat1 =  $_POST['ar_data'];
$date =  $dat1['date1'];
$search = $dat1['c_name2'];*/
//
//$search = "sbin";
//$date = "2018-03-22";
 include_once('Intraday_IV.php');  
       
 $intraday_obj = new Intraday_IV(); 

echo  json_encode($intraday_obj->get_fii_data("")) ;

?>