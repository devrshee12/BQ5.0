<?php   
include("db_connect.php");
session_start(); //to ensure you are using same session

  $result = mysqli_query($con,"update `bliss_register` set session_id = '' WHERE email = '" . $_SESSION['email'] . "'");
                     


session_destroy(); //destroy the session
header("location:index.php"); 
?>