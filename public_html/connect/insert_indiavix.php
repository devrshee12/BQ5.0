<html>
    <head>
    </head>
    <body>
<?php
date_default_timezone_set('Asia/Calcutta'); 
$atm_vol = $_GET['vol'];;
   include("../db_connect.php");
       
$date = date("Y-m-d");
$time1  = date("H:i:s");


// Create connection

//echo $table_name;
//foreach($dataArr as $val){
  $rs =  mysqli_query($con,"INSERT INTO `vol_indiavix` VALUES (DEFAULT,'$date','$time1','','','','','','','','','','','','$atm_vol','','','0.45','','','')");
              //       }
 
$con->close();
  
//echo " <script type='text/javascript'> window.location = 'excel_upload.php'</script>";*/
?>