<?php
  $today = date('Y-m-d');
 $result_date =  date('d-m-Y', strtotime($row[15]));
$name_for_link = str_replace("&", "_", $row[1]);
$array_all_m[$total_data][0] = "<a href='BlissDelta_Data.php?%20search1=$name_for_link' target='_blank' name='$row[1]' style='color: #FFF; '>" . $row[1] . "</span>";


$array_all_m[$total_data][1] = "<span >" . $row[2] . "</span>";
$array_all_m[$total_data][2] = "<span >" . $row[17] . "</span>";
$array_all_m[$total_data][3] = "<span >" . $result_date . "</span>";
$array_all_m[$total_data][4] = "<span >" . $row[13] . "</span>";
$array_all_m[$total_data][5] = "<span >" . $row[4] . "</span>";
$array_all_m[$total_data][6] = "<span >" . $row[20] . "</span>";
$array_all_m[$total_data][7] = "<span >" . $row[18] . "</span>";

if ($row[5] != 0) {
    if($today == $last_date)
    {
        $array_all_m[$total_data][8] = "<span onclick='showdata_daily_vol(\"$row[1]\");' name='$row[1]'  style='color: rgb(255,255,0); cursor: pointer '>" . Round($row[5], 1) . "</span>";
    } else {
        $array_all_m[$total_data][8] = "<span onclick='showdata_daily_vol(\"$row[1]\");' name='$row[1]'  style='color: rgb(255,255,0); '>-</span>";
    }
} else {
    $array_all_m[$total_data][8] = "<span onclick='showdata_daily_vol(\"$row[1]\");' name='$row[1]'  style='color: rgb(255,255,0); '>-</span>";
}
$array_all_m[$total_data][9] = "<span >" . $row[6] . "</span>";
$array_all_m[$total_data][10] = "<span >" . $row[21] . "</span>";
$array_all_m[$total_data][11] = "<span >" . $row[7] . "</span>";
$array_all_m[$total_data][12] = "<span >" . $row[9] . "</span>";
$array_all_m[$total_data][13] = "<span >" . $row[10] . "</span>";
$array_all_m[$total_data][14] = "<span >" . $row[11] . "</span>";
$array_all_m[$total_data][15] = "<span >" . $row[12] . "</span>";
/* $array_all_m[$total_data][16] = "<span >" . $row[8] . "</span>";
  if(date('Y', strtotime($row[16])) == '1970')
  $array_all_m[$total_data][17] = "";
  else
  $array_all_m[$total_data][17] = "<span >" .date('d M Y', strtotime($row[16])) . "</span>";

  $array_all_m[$total_data][18] = "<span ></span>"; */
?>