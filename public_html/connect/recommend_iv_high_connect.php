
<?php

$array_all_m = array();
;
$total_data = 0;
include("../db_connect.php");
session_start();
//$search = $_POST['search'];
//if ($search == "") {
    $sql = "SELECT v1.*,v2.atm_vol as atm_vol,v2.date as live_date  FROM `iv` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where v1.date = (select date from `iv` order by id desc limit 1) and v1.time = (select time from `iv` order by id desc limit 1) order by sector ASC";
/*} else {
    if ($search == "NIFTY50") {
        $sql = "SELECT v1.*,v2.atm_vol as atm_vol FROM `iv` as v1 left join `iv_live` as v2 on v1.name = v2.c_name  where v1.nifty = 1 and v1.date = (select date from `iv` order by id desc limit 1) and v1.time = (select time from `iv` order by id desc limit 1) order by sector ASC";
    } else {
        $sql = "SELECT v1.*,v2.atm_vol as atm_vol FROM `iv` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where (v1.name like '$search%' or v1.Sector like '$search%') and v1.date = (select date from `iv` order by id desc limit 1) and v1.time = (select time from `iv` order by id desc limit 1) order by sector ASC";
    }
}*/

$today = date('Y-m-d');
$result_scrip = mysqli_query($con, $sql);
$n_scrip = mysqli_num_rows($result_scrip);
if ($n_scrip > 0) {
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
        if ($row['name'] != null) {                                  //inserting all fetch value to array  // echo "hello";
            $recommend_iv = $row['recommend_iv'];
            if ($recommend_iv != 0 && $yes_in != 0) {
            if(abs($yes_in) > $recommend_iv + 5 )
            {
            if ($_SESSION['plan'] !== "FREE") {
                        if ($nifty == 1) {
                            include("../Hedger_nifty_array.php");
                        } else {
                            include("../Hedger_array.php");
                        }
                        $total_data = $total_data + 1;
                    } else {
                        include("../IV_free_array.php");
                        $total_data = $total_data + 1;
                    }
                
            }
            //  }
        }
    }
}
}
$curr_time = "";
// $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");
echo json_encode(array("a" => $array_all_m, "b" => $curr_time));  //json code to encrypt
// }
?>
         