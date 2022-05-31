
<?php

$array_all_m = array();
;
$total_data = 0;
include("../db_connect.php");
session_start();
/*$search = $_POST['search'];
if ($search == "") {*/
    $sql = "SELECT v1.*,v2.atm_vol as atm_vol,v2.date as live_date  FROM `iv` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where v1.date = (select date from `iv` order by id desc limit 1) and v1.time = (select time from `iv` order by id desc limit 1) order by sector ASC";
/*} else {
    $sql = "SELECT v1.*,v2.atm_vol as atm_vol FROM `iv` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where v1.name like '$search%' and v1.date = (select date from `iv` order by id desc limit 1) and v1.time = (select time from `iv` order by id desc limit 1) order by sector ASC";
}*/

$today = date('Y-m-d');
$result_scrip = mysqli_query($con, $sql);
$n_scrip = mysqli_num_rows($result_scrip);
if ($n_scrip > 0) {
    while ($row = mysqli_fetch_array($result_scrip)) {                                //inserting all fetch value to array  // echo "hello";
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
            if($yes_in == 0 || $nse_close_vol == 0)
        {
         $diff =  "-";
        }
        else{
         $diff =  Round(($yes_in - $nse_close_vol)*100/$nse_close_vol, 1);
        }
          
          if($diff != "-" && $diff < -5)
          {
           
            if ($nifty == 1) {
                include("../next_day_gap_nifty_array.php");
                // $array_all_m[$total_data][17] = $total_data;
                $total_data = $total_data + 1;
            } else {
                include("../next_day_gap_array.php");
                //   $array_all_m[$total_data][17] = $total_data;
                $total_data = $total_data + 1;
            }
        }
    }
}

$curr_time = "";

echo json_encode(array("a" => $array_all_m, "b" => $curr_time));  //json code to encrypt
// }
?>
         