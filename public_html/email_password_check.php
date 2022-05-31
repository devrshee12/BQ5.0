<?php
include_once('register.php');  
       
    $funObj = new register();  
    if(!isset($_POST['pw2'])){  
        $email = $_POST['em'];  
        $password = $_POST['pw1'];  
        $user = $funObj->Login($email, $password); 
        if(isset( $_SESSION['plan']))
        {
        $r_date = $_SESSION['plan'];
        }
        else{
            $r_date ="";
        }
        $user_data=array("a"=>$user,"b"=>$r_date);
        echo json_encode($user_data);
    }  
    /*if(isset($_POST['pw2'])){  
       
        $email = $_POST['em'];  
        $password = $_POST['pw1'];  
        $confirmPassword = $_POST['pw2']; 
    
 
        if($password == $confirmPassword){
           
            $email_existence = $funObj->isUserExist($email);  
         echo $email_existence;
          
        }  
        
    }  */

