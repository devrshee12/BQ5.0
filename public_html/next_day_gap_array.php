<?php

$array_all_m[$total_data][] = "<span onclick='show_dashboard(\"$stock\");' name='$stock'  style='color: #FFF; cursor: pointer '>" . $stock . "</span>";
//echo $last_date;
if ($yes_in != 0  && $today == $live_date) {
  //  if ($today == $last_date) {
        
        $array_all_m[$total_data][] = "<span onclick='showdata_daily_vol(\"$stock\");' name='$stock'  style='color: rgb(255,255,0); cursor: pointer '>" . $yes_in . "</span>";
    if($yes_in == 0 || $nse_close_vol == 0)
        {
         $array_all_m[$total_data][] = "-";
        }
        else{
        $array_all_m[$total_data][] = "<span style='color: rgb(0,255,255); '>" . Round(($yes_in - $nse_close_vol)*100/$nse_close_vol, 1) . "</span>";
        }
        
  /*  } else {
        $array_all_m[$total_data][] = "-";
        $array_all_m[$total_data][] = "-";
    }*/
} else {
    $array_all_m[$total_data][] = "-";
    $array_all_m[$total_data][] = "-";
}


$array_all_m[$total_data][] = $nse_close_vol;
$array_all_m[$total_data][] = $Sector;
$array_all_m[$total_data][] = $result_date;
$array_all_m[$total_data][] = $market_cap;
$array_all_m[$total_data][] = $cq_movement;
$array_all_m[$total_data][] = $lq_movement;
$array_all_m[$total_data][] = $previous_close;
?>