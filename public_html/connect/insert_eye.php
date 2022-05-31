<?php

session_start();
$dat1 = $_POST['ar_data'];
$eye_check = $dat1['eye_check'];
//$dates1 = "2016-11-25";
//$sort =  $dat1['sort'];
$search = $dat1['search'];
//$search =  "SBIN";
include("../db_connect.php");
$user_id = $_SESSION['user_id'];
//$user_id = "vineetjain495";
$message = "";
//$eye_check ='yes';
if ($eye_check == 'yes') {

    $result_eye = mysqli_query($con, " SELECT * FROM `blisseye` WHERE user_id = '$user_id' and INSTR(scripts, '$search') > 0");
    $n_row_eye = mysqli_num_rows($result_eye);
    if ($n_row_eye == 0) {
            
            $rs = mysqli_query($con, "INSERT INTO `blisseye` VALUES ('$user_id','$search,','') ON DUPLICATE KEY UPDATE  scripts = concat(ifnull(scripts,''), '$search,')");
            $result_eye2 = mysqli_query($con, " SELECT * FROM `blisseye` WHERE user_id = '$user_id' ");
            $row_eye2 = mysqli_fetch_array($result_eye2);
            
            $row_eye2_arr = explode(",", $row_eye2['scripts']);
            //echo sizeof($row_eye2_arr);
            if(sizeof($row_eye2_arr) > 16)
            {
                 $items = array_slice( $row_eye2_arr, -16);
                    $final_script = implode(",", $items);
            
                    $rs = mysqli_query($con, "INSERT INTO `blisseye` VALUES ('$user_id','$final_script,','') ON DUPLICATE KEY UPDATE  scripts = '$final_script' ");

            }
           
        
    } else {
        $message = "scrip already present in the chart list";
    }
} elseif ($eye_check == 'all') {
    //  echo $watch_check;
   $rs = mysqli_query($con, "delete  from `blisseye` where user_id = '$user_id'");
    // $message = "Chart List is Cleared";
} else {
   $rs = mysqli_query($con, "UPDATE `blisseye` SET scripts=REPLACE(scripts,'$search,','') where user_id = '$user_id'");
    //$message = $search." is deleted";
}


// $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");



echo json_encode(array("a" => $message));  //json code to encrypt
// }
?>
         