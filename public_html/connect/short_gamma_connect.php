<?php

$array_all_m = array();
;
$total_data = 0;
include("../db_connect.php");
session_start();
$search = $_POST['search'];
//$search = "IRB";
//if ($search == "") {//echo "fvsd";
    $sql = "SELECT v1.*,v2.atm_vol as atm_vol,v2.date as live_date  FROM `iv` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where  v1.date = (select date from `iv` order by id desc limit 1) and v1.time = (select time from `iv` order by id desc limit 1) and  (v1.lquarter_avg_iv - v2.atm_vol) <= 5 and  (v1.lquarter_avg_iv - v2.atm_vol) > 0  order by sector ASC";
/*} else {
    $sql = "SELECT v1.*,v2.atm_vol as atm_vol FROM `iv` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where v1.name like '$search%' and  v1.date = (select date from `iv` order by id desc limit 1) and v1.time = (select time from `iv` order by id desc limit 1) and  (v1.lquarter_avg_iv - v2.atm_vol) <= 5 and  (v1.lquarter_avg_iv - v2.atm_vol) > 0  order by sector ASC";
}*/
//CRT VOL < q AVG vOL BY MAX 2% And average of movement ( three months avg ) should < = 2 AND (current vol - quarter lower vo) > (q high vol - c vol) 
$today = date('Y-m-d');
$result_scrip = mysqli_query($con, $sql);
$n_scrip = mysqli_num_rows($result_scrip);
//echo "dasd";
if ($n_scrip > 0) {
    
    while ($row = mysqli_fetch_array($result_scrip)) {                                     //inserting all fetch value to array  //echo "hello";
        
        if ($row['name'] != null) {//echo serialize($row);
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

            $movement = explode(" - ", $lq_movement);
            $average_mov = array_sum($movement) / count($movement);
            //echo $average_mov;
            if ($average_mov <= 3) {
                
                $quarter_maxmin = explode(" - ", $lq_minmax_avg_iv);
                if (($yes_in - $quarter_maxmin[0]) >= 5) {//($quarter_maxmin[1] - $row[5])//echo serialize($row);
                    /* $row[14] = date('d M Y', strtotime($row[14]));
                      ; */

                    if ($nifty == 1) {
                        if ($_SESSION['plan'] !== "FREE") {  //inserting all fetch value to array  // echo "hello";
                            include("../IV_nifty_array.php");
                            //$array_all_m[$total_data][17] =   $total_data;
                            $total_data = $total_data + 1;
                        } else {
                            include("../IV_free_array.php");
                            $total_data = $total_data + 1;
                        }
                    }
                }
            }
            //   echo "<tr><td>". $row[1]."</td><td>". $row[2]."</td><td>". $row[11]."</td><td>". $row[3]."</td><td>".$row[4]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td><td>".$row[10]."</td></tr>";
        }
    }
}

$curr_time = "";
// $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");



echo json_encode(array("a" => $array_all_m, "b" => $curr_time));  //json code to encrypt
?>
         