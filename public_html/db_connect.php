<?php
   $con=mysqli_connect("127.0.0.1","root","");
   if(!$con)
   {
       die('could not connect to databaSe:'.mysqli_error());       
   }
  $sel_db =  mysqli_select_db($con,"bliss");
?>
