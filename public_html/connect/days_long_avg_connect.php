
<?php

$array_all_m = array();
$total_data = 0;
include("../db_connect.php");
//$search = $_POST['search'];
$search = "";
/*$search =  $_POST['search'];

$curr_time = 0;
if ($search == "")*/
    $sql = "SELECT v1.*,v2.atm_vol as atm_vol,v2.date as live_date  FROM `iv_user` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where  v1.date = (select date from `iv_user` order by id desc limit 1) and v1.time = (select time from `iv_user` order by id desc limit 1) order by sector ASC";
/*else {
    if ($search == "NIFTY50") {
      $sql = "SELECT v1.*,v2.atm_vol as atm_vol FROM `iv_user` as v1 left join `iv_live` as v2 on v1.name = v2.c_name  where v1.nifty = 1 and v1.date = (select date from `iv_user` order by id desc limit 1) and v1.time = (select time from `iv_user` order by id desc limit 1) order by sector ASC";
   } else {
    $sql = "SELECT v1.*,v2.atm_vol as atm_vol FROM `iv_user` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where  v1.date = (select date from `iv_user` order by id desc limit 1) and v1.time = (select time from `iv_user` order by id desc limit 1) and (name like '$search%' or Sector like '$search%')  order by sector ASC";
   }
    
   }*/// q AVG VOL >= 33 AND Crt VOL > Q avg VOL by max 5% AND (Qhigh Vol - crt vol)> (crtvol- Q low vol) AND mov >=2.5
$today = date('Y-m-d');
$result_scrip = mysqli_query($con, $sql);
$n_scrip = mysqli_num_rows($result_scrip);
if ($n_scrip > 0) {
    while ($row = mysqli_fetch_array($result_scrip)) {                                     //inserting all fetch value to array  // echo "hello";
      $yes_in = Round($row['atm_vol'], 1);
        $stock = $row['name'];
        $lquarter_avg_iv = $row['lquarter_avg_iv'];
        //$lq_minmax_avg_iv = $row['lq_minmax_avg_iv'];
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
        
             if($lquarter_avg_iv == 0 || $yes_in == 0)
        {
         $diff =  "-";
        }
        else{
         $diff =  ($lquarter_avg_iv - $yes_in);
        }
             if($diff != "-" && $diff > 5)
          {    
            if ($nifty == 1) {
                include("../days_avg_nifty_array.php");
                // $array_all_m[$total_data][17] = $total_data;
                $total_data = $total_data + 1;
            } else {
                include("../days_avg_array.php");
                //   $array_all_m[$total_data][17] = $total_data;
                $total_data = $total_data + 1;
            }
          }
           // $curr_time = $row[16];
    //    }//}
       // }
        //  }
    }
}

$curr_time = "";
// $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");



echo json_encode(array("a" => $array_all_m, "b" => $curr_time));  //json code to encrypt
// }
?>
         