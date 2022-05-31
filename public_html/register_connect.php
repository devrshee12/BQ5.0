<?php

include_once('register.php');

$funObj = new register();
if (!isset($_POST['pw2'])) {
    $email = $_POST['em'];
    $password = $_POST['pw1'];
    $user = $funObj->Login($email, $password);

    if ($user == "TRUE") {
        // Registration Success  
        if ($email == "sfalguni.v@gmail.com") {
            header("location:BlissDelta_Data.php");
        } else {
            header("location:BlissDelta_Data.php");
        }
    } else {
        // Registration Failed  

        echo "<script>alert('$user');"
        . " window.location.href='index.php';"
        . "</script>";

        //header("location:index.php"); 
    }
}
if (isset($_POST['pw2'])) {

    $email = $_POST['em'];
    $password = $_POST['pw1'];
    $confirmPassword = $_POST['pw2'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $pincode = $_POST['pc'];
    $birthyear = $_POST['birthyear'];
    $country = $_POST['countries'];
    $company = $_POST['company'];
    $parts = explode("@", $email);
    $user_id = $parts[0];

    $interest = $_POST['interest'];
    $role = 'client';
    if ($password == $confirmPassword) {

        $email_existence = $funObj->isUserExist($email);
        if (!$email_existence) {
            $confirm_code = md5(uniqid(rand()));

            $register = $funObj->UserRegister($user_id, $confirm_code, $password, $country, $pincode, $birthyear, $interest, $role, $name, $mobile, $company, $email);
            if ($register) {


                // echo "<script>alert('Registration Successful comfirmation link has been sent to yout email id')</script>";  

                $to = $email;

                // Your subject
                $subject = "Your confirmation link here";

                // From
                $header = "from: BlissQuants <blissquants@gmail.com>";

                // Your message
                $message = "Hello " . $name . ", \r\n \r\n"
                        . "your username is " . $user_id . " \r\n"
                        . " Your Confirmation link \r\n";
                $message.="Click on this link to activate your account \r\n";
                //$message.="http://192.168.119.24/bQ4.0/public_html/confirmation.php?email=$email&passkey=$confirm_code";
                $message.="http://24localbliss/bq5.0/public_html/confirmation.php?email=$email&passkey=$confirm_code";
                // send email
                $sentmail = mail($to, $subject, $message, $header);


                // if not found 
                if ($sentmail) {
                    echo "<script>confirm('Registration Successful!. Confirmation link has been sent to your email id. Please confirm.')</script>";
                    header("location:email_confirm.php");
                    // echo "Your Confirmation link Has Been Sent To Your Email Address.";
                } else {
                    echo "Cannot send Confirmation link to your e-mail address";
                }

                // if your email succesfully sent
                //  header("location:email_confirm.php"); 
            } else {
                echo "<script>alert('Registration Not Successful')</script>";
            }
        } else {
            echo "<script>alert('Email Already Exist');"
            . "window.location = 'index.php';"
            . "</script></script>";
        }
    } else {
        echo "<script>alert('Password Not Match')</script>";
    }
}  

