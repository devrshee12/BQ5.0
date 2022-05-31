<?php

$today = date('Y-m-d');

$result_date = date('d M Y', strtotime($row[15]));

$name_for_link = str_replace("&", "_", $row[1]);

if ($row[23] != 1) { 

$array_all_m[$total_data][0] = "<a href='BlissDelta_Data.php?%20search1=$name_for_link' target='_blank' name='$row[1]' style='color: #FFF; '>" . $row[1] . "</span>";


$array_all_m[$total_data][1] = "<span >" . $row[2] . "</span>";
$array_all_m[$total_data][2] = "<span >" . $row[17] . "</span>";
$array_all_m[$total_data][3] = "XX";
$array_all_m[$total_data][4] = "XX";
$array_all_m[$total_data][5] = "XX";
$array_all_m[$total_data][6] = "XX";
$array_all_m[$total_data][7] = "XX";


        $array_all_m[$total_data][8] = "XX";
    
$array_all_m[$total_data][9] ="XX";
$array_all_m[$total_data][10] = "XX";
$array_all_m[$total_data][11] = "XX";
$array_all_m[$total_data][12] = "XX";
$array_all_m[$total_data][13] = "XX";
$array_all_m[$total_data][14] = "XX";
$array_all_m[$total_data][15] = "XX";
}
else{
$array_all_m[$total_data][0] = "<a href='BlissDelta_Data.php?%20search1=$name_for_link' target='_blank' name='$row[1]'>" . $row[1] . "</span>";


$array_all_m[$total_data][1] = "<span style='color: rgb(132,194,37);'>" . $row[2] . "</span>";
$array_all_m[$total_data][2] = "<span style='color: rgb(132,194,37);'>"  . $row[17] . "</span>";
$array_all_m[$total_data][3] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";
$array_all_m[$total_data][4] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";
$array_all_m[$total_data][5] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";
$array_all_m[$total_data][6] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";
$array_all_m[$total_data][7] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";


        $array_all_m[$total_data][8] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";
    
$array_all_m[$total_data][9] = "<span style='color: rgb(132,194,37);'>" . "XX". "</span>";
$array_all_m[$total_data][10] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";
$array_all_m[$total_data][11] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";
$array_all_m[$total_data][12] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";
$array_all_m[$total_data][13] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";
$array_all_m[$total_data][14] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";
$array_all_m[$total_data][15] = "<span style='color: rgb(132,194,37);'>" .  "XX". "</span>";
}
/* $array_all_m[$total_data][16] = "<span >" . $row[8] . "</span>";
  if(date('Y', strtotime($row[16])) == '1970')
  $array_all_m[$total_data][17] = "";
  else
  $array_all_m[$total_data][17] = "<span >" .date('d M Y', strtotime($row[16])) . "</span>";

  $array_all_m[$total_data][18] = "<span ></span>"; */
?>