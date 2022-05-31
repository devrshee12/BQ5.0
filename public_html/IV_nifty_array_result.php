<?php
  $today = date('Y-m-d');
  $result_date =  date('d-m-Y', strtotime($row[15]));
$row[2] = str_replace('(NIFTY 50)', '', $row[2]);
//$name = $row[1];
$name_for_link = str_replace("&","_",$row[1]);
   $array_all_m[$total_data][0] = "<a href='BlissDelta_Data.php?%20search1=$name_for_link' target='_blank' name='$row[1]' >".$row[1]."</span>";
                                      
$array_all_m[$total_data][1] = "<span style='color: rgb(132,194,37);'>" . $row[2] . "</span>";
$array_all_m[$total_data][2] = "<span style='color: rgb(132,194,37);'>" . $row[17] . "</span>";
$array_all_m[$total_data][3] = "<span style='color: rgb(132,194,37);'>" . $result_date . "</span>";
$array_all_m[$total_data][4] = "<span style='color: rgb(132,194,37);'>" . $row[13] . "</span>";
$array_all_m[$total_data][5] = "<span style='color: rgb(132,194,37);'>" . $row[4] . "</span>";
$array_all_m[$total_data][6] = "<span style='color: rgb(132,194,37);'>" . $row[20] . "</span>";
$array_all_m[$total_data][7] = "<span style='color: rgb(132,194,37); '>" . $row[18] . "</span>";
if($row[5] != 0)
{
    if($today == $last_date)
    {
$array_all_m[$total_data][8] = "<span onclick='showdata_daily_vol(\"$row[1]\");' name='$row[1]'  style='color: rgb(255,255,0); cursor: pointer'>" . Round($row[5], 1) . "</span>";
    }
    else {
$array_all_m[$total_data][8] = "<span onclick='showdata_daily_vol(\"$row[1]\");' name='$row[1]'  style='color: rgb(255,255,0); '>-</span>";
}
}
else {
$array_all_m[$total_data][8] = "<span onclick='showdata_daily_vol(\"$row[1]\");' name='$row[1]'  style='color: rgb(255,255,0); '>-</span>";
}
$array_all_m[$total_data][9] = "<span style='color: rgb(132,194,37);'>" . $row[6] . "</span>";
$array_all_m[$total_data][10] = "<span style='color: rgb(132,194,37);'>" . $row[21] . "</span>";
$array_all_m[$total_data][11] = "<span style='color: rgb(132,194,37);'>" . $row[7] . "</span>";
$array_all_m[$total_data][12] = "<span style='color: rgb(132,194,37);'>" . $row[9] . "</span>";
$array_all_m[$total_data][13] = "<span style='color: rgb(132,194,37);'>" . $row[10] . "</span>";
$array_all_m[$total_data][14] = "<span style='color: rgb(132,194,37);'>" . $row[11] . "</span>";
$array_all_m[$total_data][15] = "<span style='color: rgb(132,194,37);'>" . $row[12] . "</span>";
/*$array_all_m[$total_data][16] = "<span style='color: rgb(132,194,37);'>" . $row[8] . "</span>";
if(date('Y', strtotime($row[16])) == '1970')
        $array_all_m[$total_data][17] = "";
else
$array_all_m[$total_data][17] = "<span style='color: rgb(132,194,37);'>" .date('d M Y', strtotime($row[16])) . "</span>";

$array_all_m[$total_data][18] = "<span style='color: rgb(132,194,37);'></span>";**/
?>