<?php
error_reporting(0);
include_once('header.php'); 
include_once('register.php'); 

$passkey = $_GET['passkey'];
$email = $_GET['email'];       
       $funObj = new register(); 
        
     $user = $funObj->confirm_update($passkey,$email);  
        if ($user) {  
            // Registration Success  
               $user_detail=  $funObj->User_detail($email);  
            
                    // echo "<script>alert('Registration Successful comfirmation link has been sent to yout email id')</script>";  
                 if($user_detail['register_date'] == "1991-09-30")
                 {
                $to ="Falguni Vahora <falguni.vahora@blissquants.com>,Vineet Jain <vineet.jain@blissquants.com>";

                // Your subject
                $subject="Activate user please";

                // From
                  $headers  = "MIME-Version: 1.0\n"; 
                $headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
                $headers .= "From: BlissQuants <blissquants@gmail.com>";
              //  $header="from: BlissQuants <blissquants@gmail.com>";

                // Your message
                $message="Your Comfirmation link <br/> <br/>";
                $message.="Click on this link to activate your account <br/> <br/> Username = ".$user_detail['user_id']. " <br/> <br/> Name  = ".$user_detail['name']. " <br/> <br/> Mobile  = ".$user_detail['mobile']. " <br/> <br/> Email  = ".$user_detail['email']. " <br/> <br/> Company  = ".$user_detail['company']. " <br/> <br/> Interest In = ".$user_detail['interest']. " <br/> <br/> Birth Year = ".$user_detail['birthyear']. " <br/> <br/> Pin Code = ".$user_detail['pincode']. " <br/> <br/> Country = ".$user_detail['country']. " <br/> <br/>  ";
                $message.="http://24localbliss/bq5.0/public_html/Activation.php?email=$email";

                // send email
                $sentmail = mail($to,$subject,$message,$headers);
                echo "<div class='table-bordered control_color_1 col-lg-offset-3 col-lg-6'><h2>Thank You For confirming your Email <br> <h5>Your Account will be activated within 24 hour</h5></h2></div>";
                 }
                 else{
                      echo "<div class='table-bordered control_color_1 col-lg-offset-3 col-lg-6'><h3>You already confirmed the link. <br> your account has been already activated.</h3></div>";
               
                 }
//   header("location:BlissDelta_Data.php"); 
        }    
        
        
 /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */       
  ?>      


