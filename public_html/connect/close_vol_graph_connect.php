<?php

//require 'db_connect_vol.php';
//$date1 = "2016-08-29";
require '../db_connect.php';
$dat1 = $_POST["ar_data"];
//$date1 = $dat1["date1"];
$c_name2 = $dat1["c_name2"];
$today_date = date("Y-m-d");
//$today_date = '2018-04-13';
$result_date[] = 0;
//$c_name2 = "SBIN";
$curr_month = date('m', strtotime($today_date));
;
$quarter_num = array(01, 04, 07, 10); //start month of quarter
$date_last = date('Y-m-d', strtotime('-6 months', strtotime($today_date)));
$quarter_last = quarter_detail($date_last);
$firstmonth_quarter = closestnumber($curr_month, $quarter_num); //get nearest less number in array
$year =   date('Y', strtotime($today_date));

    $pre_start_date = $quarter_last['start_date'];

  

$quarter = "Last 3 Quarter  ";
$table_name = strtolower("nse_vol_" . $c_name2);
$table_name = ltrim(rtrim($table_name));
/*  $sql = "SELECT entry_number,date,ATM_vol,Time,days_of_expire,ROUND(delta,2),ATM,ATM_price,spot,t2.xs, t2.ns,volume from `$table_name` t1 JOIN (SELECT MAX(entry_number) as mx_et,MAX(SPOT) as xs,MIN(SPOT) as ns FROM `$table_name` GROUP BY date) t2 ON t1.entry_number = t2.mx_et "
  . "WHERE date between '2017-01-01' and '$today_date' and ATM_vol > 0 and ABS(delta) > 0.0001 and delta < 1 and  days_of_expire > 4 group by date ORDER BY `t1`.`date` ASC";
 */
/*Average vol */
//echo $pre_start_date . " " . $pre_end_date;
$sql_result_vol = "SELECT AVG(ATM_vol) FROM `$table_name` WHERE date > '$pre_start_date' and date < '$today_date' and days_of_expire > 3";

$result_result_vol = mysqli_query($con, $sql_result_vol);
$n_result_vol = mysqli_num_rows($result_result_vol);
/* if there is no search value in highlow_vol table then search in bliss_vol database */
if ($n_result_vol > 0) {
    while ($row_avg = mysqli_fetch_row($result_result_vol)) {                                     //inserting all fetch value to array
        if ($row_avg != null) {
           $avg_qtr =  Round($row_avg[0], 1);;
        }
    }
} else {
    $array2[] = 0;
}
 $sql = "SELECT date FROM `earning2` WHERE  name = '$c_name2' ORDER BY date ";
        $result = mysqli_query($con, $sql); //excute query        
        $n = mysqli_num_rows($result); // give number of rows        
        if ($n > 0) {
            while ($row1 = mysqli_fetch_row($result)) { //fetch row one by one in loop
                $result_date[] = $row1[0];     //last vol  

        }}

$sql = "SELECT entry_number,date,ATM_vol,Time,days_of_expire,ROUND(delta,2),ATM,ATM_price,spot,volume from `$table_name` t1 "
        . "WHERE date between '2017-01-01' and '$today_date' and ATM_vol > 0 and ABS(delta - 0) > 0.0001 and delta < 1 and  days_of_expire > 0  ORDER BY `date` ASC";
$result = mysqli_query($con, $sql);
$n = mysqli_num_rows($result);
$j = 0;
/*date, vol, voloume data*/
if ($n > 0) {
    while ($row = mysqli_fetch_row($result)) {
        if ($row != null) {
            if ($row[1] > 5 && $row[1] != "50.0") {
                
                $array2[] = $row[1];

                if ($row[1]) {
                    
                    $array2[] = Round($row[2], 1);
                     $array2[] = $avg_qtr;

                   // $array_avg[] = Round($row_avg[0], 1);
                    
                    $array2[] = Round($row[9], 1);
                     $array2[] = $row[4];
                    if (in_array($row[1], $result_date))
                    {
                        $array2[] = "Result";
                        
                    }
                    else{
                         $array2[] = "";
                    }
                }
            }
        }
    }
   /* $array_avg = array_unique($array_avg);

    mysqli_close($con);
    foreach ($array_avg as $value) {
        $array_avg_unique[] = $value;
    }
    $size_array = sizeof($array_avg_unique);
    $quarter_avg = Round(($array_avg_unique[$size_array - 1] + $array_avg_unique[$size_array - 2]) / 2, 1);*/
    echo json_encode(array("a" => $array2, "b" => $n, "c" => $avg_qtr,"quarter" => $quarter  , "result_date" =>  $result_date));
}

function closestnumber($number, $candidates) {
    $last = null;
    foreach ($candidates as $cand) {
        if ($cand < $number) {
            $last = $cand;
        } else if ($cand == $number) {
            return $number;
        } else if ($cand > $number) {
            return $last;
        }
    }
    return $last;
}

 function quarter_detail($date_for_detail) {
            //$date_for_detail = "2018-03-13";
            $quarter_num = array(01, 04, 07, 10); //start month of quarter
            $curr_month = date('m', strtotime($date_for_detail));
            $firstmonth_quarter = closestnumber($curr_month, $quarter_num); //get nearest less number in array
            $year = date('Y', strtotime($date_for_detail));
//if ($firstmonth_quarter != 01) {


            $pre_start_date = $year . "-" . ($firstmonth_quarter) . "-01";

            $pre_end_date = $year . "-" . ($firstmonth_quarter + 2) . "-30";
            $firstmonth = substr(date('F', strtotime($pre_start_date)), 0, 3);
            $secondmonth = substr(date('F', strtotime('+1 month', strtotime($pre_start_date))), 0, 3);
            $thirdmonth = substr(date('F', strtotime('+2 month', strtotime($pre_start_date))), 0, 3);

            /* } else {
              $year = $year - 1;
              $pre_start_date = $year . "-10-01";
              $firstmonth = substr(date('F', strtotime($pre_start_date)),0,1);
              $secondmonth = substr(date('F', strtotime('+1 month', strtotime($pre_start_date))),0,1);
              $thirdmonth = substr(date('F', strtotime('+2 month', strtotime($pre_start_date))),0,1);
              $pre_end_date =  $year . "-12-30";
              } */

            $quarter = $firstmonth . "-" . $secondmonth . "-" . $thirdmonth;
            $quarter_detail = array("start_date" => $pre_start_date, "last_date" => $pre_end_date, "quarter" => $quarter, "year" => $year );
            return $quarter_detail;
        }

?>
