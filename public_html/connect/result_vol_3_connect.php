
<?php

$array_all_m = array();
;
$total_data = 0;
include("../db_connect.php");
session_start();
/*$search = $_POST['search'];
if ($search == "") {*/
    $sql = "SELECT v1.*,v2.atm_vol as atm_vol,v2.date as live_date  FROM `iv2` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where v1.date = (select date from `iv2` order by id desc limit 1) and v1.time = (select time from `iv2` order by id desc limit 1) order by sector ASC";
/*} else {
    if ($search == "NIFTY50") {
        $sql = "SELECT v1.*,v2.atm_vol as atm_vol FROM `iv2` as v1 left join `iv_live` as v2 on v1.name = v2.c_name  where v1.nifty = 1 and v1.date = (select date from `iv2` order by id desc limit 1) and v1.time = (select time from `iv2` order by id desc limit 1) order by sector ASC";
    } else {
        $sql = "SELECT v1.*,v2.atm_vol as atm_vol FROM `iv2` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where (v1.name like '$search%' or v1.Sector like '$search%') and v1.date = (select date from `iv2` order by id desc limit 1) and v1.time = (select time from `iv2` order by id desc limit 1) order by sector ASC";
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


        $cq_minmax_avg_iv = $row['Quarter_Min_Max_IV'];
        $long_iv = $row['long_iv'];
        $short_iv = $row['short_iv'];

        $nse_close_vol = $row['nse_close_vol'];
        $name_for_link = str_replace("&", "_", $stock);
        $Sector = $row['Sector'];
        $result_date = date('d M Y', strtotime($row['result_date']));
        if ($Sector == 'INDX') {
            $result_date = "-";
        }
        $market_cap = $row['market_cap'];
$live_date = $row['live_date'];
        $cq_movement = $row['cq_movement'];
        $lq_movement = $row['lq_movement'];
        $previous_close = $row['previous_close'];
        $last_date = $row['Time'];
        $nifty = $row['nifty'];
        if ($row['name'] != null) {                    //inserting all fetch value to array  // echo "hello";
       
        $result_month = date('m', strtotime($row['result_date']));
        $quarter_month = array("03", "06", "09", "12");
        if (in_array($result_month, $quarter_month)) {
           
            if ($_SESSION['plan'] !== "FREE") {
                if ($nifty == 1) {
                    include("../IV2_nifty_array.php");
                } else {
                    include("../IV2_array.php");
                }//echo $table_name;

                $total_data = $total_data + 1;
            } else {
                include("../IV_free_array.php");
                $total_data = $total_data + 1;
            }
        }
    }
}
}

$curr_time = "";


echo json_encode(array("a" => $array_all_m, "b" => $curr_time));  //json code to encrypt
?>
         