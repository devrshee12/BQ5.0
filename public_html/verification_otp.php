<?php
include_once('register.php'); 
$mobile = $_GET['mobile'];
$username = "vineet.jain@blissquants.com";
	$hash = "c30428cc4d7b3cd7a137f2ee767986fa53191e3a1f1a9ff037358f0d6d1d3100";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "BLISSQ"; // This is who the message appears to be from.
	$numbers = "91".$mobile; // A single number or a comma-seperated list of numbers
	$message = "Your number is verified";
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
        if($result)
        {
            echo "Message has been sent";
        }
	curl_close($ch);
 /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */       
  ?>      


