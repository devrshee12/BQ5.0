<?php

$total_data = 0;
$array_all = array(array());
$data = $_POST['ar_data'];
$search = $data['c_name2'];
$date1 = $data['date1'];
session_start();
/* $search="SBIN";
  $date1="2018-04-03"; */
$today = date("Y-m-d");
include("../db_connect.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
// $con=mysqli_connect("localhost","blissquants","bliss");
if (!$con) {
    die('could not connect to databaSe:' . mysqli_error());
}
$sel_db = mysqli_select_db($con, "bliss");

$table_name_fut = strtolower("fut_" . $search);
$c_name = $search;

$date2 = date('Y-m-d', strtotime('-10 day', strtotime($date1)));
;

$sql_current = "SELECT Date,high,low FROM `$table_name_fut` WHERE Date between '$date2' and '$date1' order by date desc limit 7";
$result_current = mysqli_query($con, $sql_current);
while ($row = mysqli_fetch_row($result_current)) {
    $array_all[$total_data][0] = date("d M Y", strtotime($row[0]));
    if ($_SESSION['plan'] !== "FREE") {
        $array_all[$total_data][1] = round($row[1], 1) . "  -  " . round($row[2], 1);
        $array_all[$total_data][2] = Round($row[1] - $row[2], 1);
        $array_all[$total_data][3] = Round($array_all[$total_data][2] * 100 / $row[2], 1);
    } else {
        $array_all[$total_data][1] = "XX";
        $array_all[$total_data][2] = "XX";
        $array_all[$total_data][3] = "XX";
    }
    $total_data = $total_data + 1;
}


// include("../db_connect.php");
$sql = "SELECT c_name FROM `companies`";
$result = mysqli_query($con, $sql);
$n = mysqli_num_rows($result);
if ($n > 0) {
    while ($row = mysqli_fetch_row($result)) {                                     //inserting all fetch value to array
        if ($row != null) {
            $company_name[] = $row[0];
        }
    }
}
echo json_encode(array("a" => $array_all, "b" => $company_name));
?>