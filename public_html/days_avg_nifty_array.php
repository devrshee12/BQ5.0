<?php

  $array_all_m[$total_data][] = "<span onclick='show_dashboard(\"$stock\");' name='$stock'  style='color: rgb(132,194,37); cursor: pointer '>" . $stock . "</span>";
   
if ($yes_in != 0  && $today == $live_date) {
   // if ($today == $last_date) {
        
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
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . $lquarter_avg_iv . "</span>";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . $cq_minmax_avg_iv. "</span>";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . $nse_close_vol . "</span>";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . $Sector . "<b style='display:none;'> NIFTY50</b></span>";
$array_all_m[$total_data][] =  $result_date ;
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37); '>" . $market_cap . "</span>";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . $cq_movement . "</span>";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . $lq_movement . "</span>";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . $previous_close . "</span>";
?>