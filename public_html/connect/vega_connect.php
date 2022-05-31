
<?php

$array_all_m = array();
;
$total_data = 0;
include("../db_connect.php");
session_start();

$sql = "SELECT v1.*,v2.atm_vol as atm_vol,v2.date as live_date  FROM `iv2` as v1 left join `iv_live` as v2 on v1.name = v2.c_name where v1.date = (select date from `iv2` order by id desc limit 1) and v1.time = (select time from `iv2` order by id desc limit 1) order by sector ASC";


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

     
   if ($long_iv != 0 && $short_iv != 0 && $yes_in != 0 ) {
    
     
            if (($row[5] - $long_iv) <= 2 && ($row[5] - $long_iv) > -8) {
      $array_all_m[$total_data][] =  "<span onclick='show_dashboard(\"$stock\");' name='$stock'  style='color: rgb(132,194,37); cursor: pointer '>" . $stock . "</span>";;
//echo $last_date;
        if ($yes_in != 0 && $today == $live_date) {
            //if ($today == $last_date) {

            $array_all_m[$total_data][] = "<span onclick='showdata_daily_vol(\"$stock\");' name='$stock'  style='color: rgb(255,255,0); cursor: pointer '>" . $yes_in . "</span>";
            /*   } else {
              $array_all_m[$total_data][] = "-";
              } */
        } else {
            $array_all_m[$total_data][] = "-";
        }
        $array_all_m[$total_data][] = $long_iv;
        $array_all_m[$total_data][] = $short_iv;
        $array_all_m[$total_data][] = $cq_minmax_avg_iv;
        $array_all_m[$total_data][] = $nse_close_vol;
        $array_all_m[$total_data][] = $Sector;
        $array_all_m[$total_data][] = $result_date;
        $array_all_m[$total_data][] = $market_cap;
        $array_all_m[$total_data][] = $cq_movement;


                $array_all_m[$total_data][] = "long";

 $total_data = $total_data + 1;
                //   echo "<tr><td>". $row[1]."</td><td>". $row[2]."</td><td>". $row[11]."</td><td>". $row[3]."</td><td>".$row[4]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td><td>".$row[10]."</td></tr>";
            }
      
            if (abs($yes_in - $short_iv) < 1) {
      $array_all_m[$total_data][] =  $stock ;
//echo $last_date;
        if ($yes_in != 0 && $today == $live_date) {
            //if ($today == $last_date) {

            $array_all_m[$total_data][] = "<span onclick='showdata_daily_vol(\"$stock\");' name='$stock'  style='color: rgb(255,255,0); cursor: pointer '>" . $yes_in . "</span>";
            /*   } else {
              $array_all_m[$total_data][] = "-";
              } */
        } else {
            $array_all_m[$total_data][] = "-";
        }
        $array_all_m[$total_data][] = $long_iv;
        $array_all_m[$total_data][] = $short_iv;
        $array_all_m[$total_data][] = $cq_minmax_avg_iv;
        $array_all_m[$total_data][] = $nse_close_vol;
        $array_all_m[$total_data][] = $Sector;
        $array_all_m[$total_data][] = $result_date;
        $array_all_m[$total_data][] = $market_cap;
        $array_all_m[$total_data][] = $cq_movement;

                $array_all_m[$total_data][] = "short";
 $total_data = $total_data + 1;
                //    $total_data = $total_data + 1;
                //   echo "<tr><td>". $row[1]."</td><td>". $row[2]."</td><td>". $row[11]."</td><td>". $row[3]."</td><td>".$row[4]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td><td>".$row[10]."</td></tr>";
            }
             
        }
        //  }
      
    }
}

$curr_time = "";
// $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");
echo json_encode(array("a" => $array_all_m, "b" => $curr_time));  //json code to encrypt
// }
?>
         