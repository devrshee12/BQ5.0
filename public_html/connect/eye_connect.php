<?php
session_start();
$array_all_m  = array();;
$total_data = 0;
include("../db_connect.php");
$user_id = $_SESSION['user_id'];
   
     $sql = "SELECT scripts FROM `blisseye` where user_id = '$user_id'";    
       
            $result_scrip=mysqli_query($con,$sql);
            $n_scrip=mysqli_num_rows($result_scrip);
                if($n_scrip>0)
                  {
                    while($row=mysqli_fetch_row($result_scrip))                                     //inserting all fetch value to array
                    {  // echo "hello";
                        if($row != null)
                        {
                            $scripts = explode(",", $row[0]);
                          
                               }
                    }
                  }
 // $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");
  
  

      echo json_encode(array("a" =>  $scripts));  //json code to encrypt
     
 
?>
         