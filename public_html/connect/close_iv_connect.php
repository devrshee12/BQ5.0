<?php

$array_all_m = array();
;
$total_data = 0;
include("../db_connect.php");
session_start();
$search = $_POST['search'];

$sql = "SELECT v1.*,v2.atm_vol as atm_vol,v2.date as live_date ,v2.start_iv as start_iv, v3.Sector as Sector,v3.Market_Cap as Market_Cap FROM `iv_close5`  as v1 left join `iv_live` as v2 on v1.name = v2.c_name left join `companies` as v3 on v1.name = v3.c_name  where  v1.date = (select date from `iv_close5` order by id desc limit 1) and v1.time = (select time from `iv_close5` order by id desc limit 1) order by name ASC";


$today = date('Y-m-d');
$result_scrip = mysqli_query($con, $sql);
$n_scrip = mysqli_num_rows($result_scrip);
if ($n_scrip > 0) {
    while ($row = mysqli_fetch_array($result_scrip)) {                                     //inserting all fetch value to array  // echo "hello";
        //echo serialize($row);
        $yes_in = Round($row['atm_vol'], 1);
        $stock = $row['name'];
        $diff = Round($yes_in - $row['bep'], 1);
        $Sector = $row['Sector'];
        $result_date = date('d M Y', strtotime($row['result_date']));
        if ($Sector == 'INDX') {
            $result_date = "-";
        }
        $market_cap = $row['Market_Cap'];
        $name_for_link = str_replace("&", "_", $row['name']);
        $live_date = $row['live_date'];
        $nifty = $row['nifty'];
        if ($row['name'] != null) {


            if ($_SESSION['plan'] !== "FREE") {
                if ($nifty == 1) {
                    include("../close_nifty_array.php");
                } else {
                    include("../close_array.php");
                }//echo $table_name;

                $total_data = $total_data + 1;
            } else {
                include("../IV_free_array.php");
                $total_data = $total_data + 1;
            }
            
           
        }
    }
}

$curr_time = "";


echo json_encode(array("a" => $array_all_m, "b" => $curr_time));  //json code to encrypt
?>
         