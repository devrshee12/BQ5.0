<?php
/*
* iTech Empires:  Export Data from MySQL to CSV Script
* Version: 1.0.0
* Page: Export
*/
 
// Database Connection
require("./db_connect.php");
$array = json_decode($_GET['array_header']);
//$array =  array('name', 'Sector', 'Daily_movement', 'yesterday_iv','name', 'Sector', '	Quarter_Avg_IV', 'yesterday_iv','name', 'Sector', 'Daily_movement', 'yesterday_iv');;
// get Users
$query = "SELECT `name`, `Sector`, `market_cap`, `result_date`, `Previous_Close`,`Daily_movement`, `qtr1_mov`, `nse_close_vol`, `yesterday_iv`, `Quarter_Avg_IV`, `Quarter_Min_Max_IV`,  `Previous_Quarter_Avg_IV`, `qtr1_vol` , `All_Avg_IV`, `Avg_pre_year`, `avg_vol_last`,`Time` FROM `iv`   where  Time = (select Time from `iv` group by date order by id asc limit 1)  order by sector ASC";
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}
 
$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}
 //fputcsv($output, $array);
 //echo $array;
//header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=BlissData_Dated' . $users[2]['Time'] . '.csv');
$output = fopen('php://output', 'w');
 fputcsv($output, $array);
//fputcsv($output, array('name', 'Sector', 'Daily_movement', 'yesterday_iv','name', 'Sector', '	Quarter_Avg_IV', 'yesterday_iv','name', 'Sector', 'Daily_movement', 'yesterday_iv'));
 
if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
