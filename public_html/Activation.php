<?php
error_reporting(0);
include_once('header.php'); 
include_once('register.php'); 
//$passkey = $_GET['passkey'];
$email = $_GET['email'];       
       $funObj = new register(); 
        
     $user = $funObj->confirm_update_date($email);  
                if($user){ 
                    

                    // echo "<script>alert('Registration Successful comfirmation link has been sent to yout email id')</script>";  
                     
                     $to=$email;

                // Your subject
                $subject="Your Account is activated";

                // From
                $header="from: BlissQuants <blissquants@gmail.com>";

                // Your message
                $message="Dear User, \r\n Your account has been activated. \r\n  Demo facility available for 15 days only.";
                $message.="Please click on below link to login our website. \r\n";
                $message.="http://192.168.119.24/Bq4.0/public_html/";

                // send email
                $sentmail = mail($to,$subject,$message,$header);
               echo "<div class='table-bordered control_color_1 col-lg-offset-3 col-lg-6'><h3 style='text-align: center'><h2>$email</h2> has been activated.<br> </style></h3></div>";
 //header("location:BlissDelta_Data.php"); 
                    // if not found 
                }
          

