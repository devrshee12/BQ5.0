<?php

     session_start();  
  
    if(isset($_POST['name'])){  
       
        $email = $_POST['em'];  
       
       $name = $_POST['name'];  
        $mobile = $_POST['mobile'];  
       
        $college= $_POST['college']; 
        $message = $_POST['message']; 
        $parts = explode("@", $email);

							  //Email information
                                                         $headers  = "MIME-Version: 1.0\n"; 
                                                        $headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
                                                        $headers .= "From: ".$email; 
							  $admin_email = "inquiry@blissquants.com,vineet.Jain@blissquants.com";
							  $f_name= $name;
							  $email = $f_name.'<'.$email .'>';      
							 
							 
							  $comment = 'Name:-'.$f_name.',    <br /> <br />  Email:-'.$email.', <br /> <br /> company:-'.$college.',  <br />  <br />    <br />   Message:-'.$message;
							  $mail = mail($admin_email, "Program Invitation", $comment, "From:" . $headers );
                                                          if($mail){
                                                              $_SESSION['success'] = 'Thank You For Contacting Us! <br> We Will Contact You Soon';
                                                            //  echo  $_SESSION['success'];
							    // echo "Thank You For Contacting Us! <br> We Will Contact You Soon <br><a href=\"index.php\" >Click Here To Continue</a>"; 
                                                          }
                                                          else{
                                                             $_SESSION['error'] = "Message not able to send";
                                                          }
                                                                
        }
       header('location: Associate.php');
        
    

