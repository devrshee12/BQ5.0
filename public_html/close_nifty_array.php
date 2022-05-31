<?php

$array_all_m[$total_data][] = "<span onclick='show_dashboard(\"$stock\");' name='$stock'  style='color: rgb(132,194,37); cursor: pointer '>" . $stock . "</span>";
if ($yes_in != 0  && $today == $live_date) {
   
    //if ($today == $last_date) {
       
        $array_all_m[$total_data][] =  "<span onclick='showdata_daily_vol(\"$stock\");' name='$stock'  style='color: rgb(255,255,0); cursor: pointer '>" . $yes_in . "</span>";
  /*  } else {
        $array_all_m[$total_data][] = "-";
    }*/
} else {
    $array_all_m[$total_data][] = "-";
}

$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . Round($row['bep'], 1) . "</span>";
$array_all_m[$total_data][] =  Round($diff, 1) ;
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . Round($row['start_iv'], 1) . "</span>";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . Round($row['nse_close_vol'], 1) . "</span>";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . Round($row['nse_close_vol2'], 1) . "</span> ";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'> " . Round($row['nse_close_vol3'], 1) . "</span>";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'>" . Round($row['nse_close_vol4'], 1) . "</span>";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37);'> " . Round($row['nse_close_vol5'], 1) . "</span>";
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37); '>" . $Sector . "<b style='display:none;'> NIFTY50</b></span>";
$array_all_m[$total_data][] = $result_date ;
$array_all_m[$total_data][] = "<span style='color: rgb(132,194,37); '>" . $market_cap . "</span>";

?>