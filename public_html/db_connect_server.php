<?php
   $con_server=mysqli_connect("www.blissquants.com:3306","blissquants","bliss");
   if(!$con)
   {
       die('could not connect to databaSe:'.mysqli_error());       
   }
  $sel_db =  mysqli_select_db($con_server,"bliss");
?>
