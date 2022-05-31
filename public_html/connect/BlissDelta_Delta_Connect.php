<?php

$total_data = 0;
$array_all = array(array());
$data = $_POST['ar_data'];
$search = $data['c_name2'];
$date1 = $data['date1'];

include("../db_connect.php");
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