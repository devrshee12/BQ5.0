<?php

$array_all_m = array();
;
$total_data = 0;
include("../db_connect.php");
session_start();
$search = $_POST['search'];
//$search = "NIFTY 50";

if ($search == "") {

    $sql = "SELECT * FROM `iv`   where date = (select date from `iv` order by id desc limit 1) and time = (select time from `iv` order by id desc limit 1) order by sector ASC";
} else {
    if ($search == "NIFTY50") {
      $sql = "SELECT * FROM `iv`   where nifty = 1 and date = (select date from `iv` order by id desc limit 1) and time = (select time from `iv` order by id desc limit 1) order by sector ASC";
   } else {
        $sql = "SELECT * FROM `iv`   where sector like '$search%' and date = (select date from `iv` order by id desc limit 1) and time = (select time from `iv` order by id desc limit 1) order by sector ASC";
    }
}


$result_scrip = mysqli_query($con, $sql);
//echo mysqli_errno($con);
$n_scrip = mysqli_num_rows($result_scrip);

if ($n_scrip > 0) { //echo "cfdzs";
    while ($row = mysqli_fetch_row($result_scrip)) {                                     //inserting all fetch value to array  // echo "hello";
        if ($row[2] != null) {//echo serialize($row);
            $table_name = "vol_" . $row[1];
            $last_date = $row[16];
            //echo $row[23];
            $row[14] = date('d M Y', strtotime('-3 days', strtotime($row[14])));
            ;
            if ($_SESSION['plan'] !== "FREE") {
                if ($row[23] == 1) {
                    include("../IV_nifty_array.php");
                } else {
                    include("../IV_array.php");
                }//echo $table_name;

                $total_data = $total_data + 1;
                //   echo "<tr><td>". $row[1]."</td><td>". $row[2]."</td><td>". $row[11]."</td><td>". $row[3]."</td><td>".$row[4]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td><td>".$row[10]."</td></tr>";
            } else {
                include("../IV_free_array.php");
                $total_data = $total_data + 1;
            }
        }
        $curr_time = $row[16];
    }
}
$curr_time = date("g:i a", strtotime($curr_time));
// $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");



echo json_encode(array("a" => $array_all_m, "b" => $curr_time));  //json code to encrypt
?>
         