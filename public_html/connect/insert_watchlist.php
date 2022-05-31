<?php

session_start();
$dat1 = $_POST['ar_data'];
$watch_check = $dat1['watch_check'];
//$dates1 = "2016-11-25";
//$sort =  $dat1['sort'];
$search = $dat1['search'];
//$search =  "";
include("../db_connect.php");
$user_id = $_SESSION['user_id'];
//$user_id = "falguniv";
$SQL = mysqli_query($con, "SELECT * FROM `watchlist` WHERE user_id = '$user_id' and `scripts` LIKE '%{$search}%'");
$n = mysqli_num_rows($SQL);
//echo $n;



    if ($watch_check == 'yes') {
       if ($n == 0 && $search !=  "") {
        $rs = mysqli_query($con, "INSERT INTO `watchlist` VALUES ('$user_id','$search,','') ON DUPLICATE KEY UPDATE  scripts = concat(ifnull(scripts,''), '$search,')");
       }
    } elseif ($watch_check == 'all') {
       // echo $watch_check;
        $rs = mysqli_query($con, "delete  from `watchlist` where user_id = '$user_id'");
    } else {//echo " no ".$search;
        $rs = mysqli_query($con, "UPDATE `watchlist` SET scripts=REPLACE(scripts,'$search,','') where user_id = '$user_id'");
    }

// $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");



echo json_encode(array("a" => $search));  //json code to encrypt
?>
         