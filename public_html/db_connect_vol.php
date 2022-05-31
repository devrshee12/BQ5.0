<?php
   $con=mysqli_connect("localhost","root","");
   if(!$con)
   {
       die('could not connect to databace:'.mysqli_error());       
   }
  $sel_db =  mysqli_select_db($con,"bliss_vol");
?>
