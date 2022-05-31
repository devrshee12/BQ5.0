<?php

session_start();
$array_all_m = array();
;
$total_data = 0;
include("../db_connect.php");
$user_id = $_SESSION['user_id'];

$sql = "SELECT scripts FROM `watchlist` where user_id = '$user_id'";

$result_scrip = mysqli_query($con, $sql);
$n_scrip = mysqli_num_rows($result_scrip);
if ($n_scrip > 0) {
    while ($row = mysqli_fetch_row($result_scrip)) {                                     //inserting all fetch value to array  // echo "hello";
        if ($row != null) {
            $scripts = explode(",", $row[0]);
        }
    }
}
// $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");
//echo serialize($scripts);

$array_all_m = array();
;
$total_data = 0;
$today = date('Y-m-d');
for ($i = 0; $i < sizeof($scripts); $i++) {
   
        $sql = "SELECT v1.*,v2.atm_vol as atm_vol,v2.date as live_date  FROM `iv` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where (v1.name like '$scripts[$i]') and v1.date = (select date from `iv` order by id desc limit 1) and v1.time = (select time from `iv` order by id desc limit 1) order by sector ASC";
    

    $result_scrip = mysqli_query($con, $sql);
    $n_scrip = mysqli_num_rows($result_scrip);
    if ($n_scrip > 0) {//if($movement[0] >= 3 && $movement[1] >= 3 && $movement[2] >= 3 )
        while ($row = mysqli_fetch_array($result_scrip)) {                                     //inserting all fetch value to array  // echo "hello";
          //echo serialize($row);
        $yes_in = Round($row['atm_vol'], 1);
        $stock = $row['name'];
        $lquarter_avg_iv = $row['lquarter_avg_iv'];
        $lq_minmax_avg_iv = $row['lq_minmax_avg_iv'];
        $cq_minmax_avg_iv = $row['cq_minmax_avg_iv'];
$live_date = $row['live_date'];

        $nse_close_vol = $row['nse_close_vol'];
        $name_for_link = str_replace("&", "_", $stock);
        $Sector = $row['Sector'];
        $result_date = date('d M Y', strtotime($row['result_date']));
        if ($Sector == 'INDX') {
            $result_date = "-";
        }
        $market_cap = $row['market_cap'];

        $cq_movement = $row['cq_movement'];
        $lq_movement = $row['lq_movement'];
        $previous_close = $row['previous_close'];
        $last_date = $row['Time'];
        $nifty = $row['nifty'];
        if ($row['name'] != null) {

            $table_name = "vol_" . $stock;

            /* $row[14] = date('d M Y', strtotime('-3 days', strtotime($row[14])));
              ; */
            if ($_SESSION['plan'] !== "FREE") {
                if ($nifty == 1) {
                                include("../IV_nifty_array.php");
                                // $array_all_m[$total_data][17] = $total_data;
                                $total_data = $total_data + 1;
                            } else {
                                include("../IV_array.php");
                                //   $array_all_m[$total_data][17] = $total_data;

                                $total_data = $total_data + 1;
                            }
                      
           
            }
        }
    }
}
}

$curr_time = "";
// $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");



echo json_encode(array("a" => $array_all_m, "b" => $curr_time));  //json code to encrypt
?>

