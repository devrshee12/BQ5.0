<?php
include("header.php");
$start = microtime(true);
include 'excel_reader\excel_reader.php';       // include the class
$excel = new PhpExcelReader;

$ex_date;
ini_set('max_execution_time', 300);
$file_path3 = "//192.168.119.24/tempBliss_192.168.105.174_spider/companies";
$files1 = scandir($file_path3);
$file_path2 = "//192.168.119.24/tempBliss_192.168.105.174_spider/companies/" . $files1[2];
print_r($files1);
$excel->read($file_path2);
// reads and stores the excel file data
//$sheet_name = serialize($file_path);
$count = 0;
$i = 0;
$affected_row = 0; 
 $affected_row_server = 0;
 
if (isset($excel->sheets[0]))
    $arr1 = $excel->sheets[0]['cells'];
else
    $arr1 = $excel->sheets[1]['cells'];

echo serialize($arr1);
//echo serialize(sizeof($arr1[2]));
$comp_number = 0;
include("db_connect.php");
include("db_connect_server.php");
echo sizeof($arr1);        
$rs = mysqli_query($con,"DELETE FROM `companies` where 1");
$rs = mysqli_query($con_server,"DELETE FROM `companies` where 1");
for ($i = 2; $i < sizeof($arr1) + 1; $i++) {
    $c_name = $arr1[$i][1];
    $d_name = $arr1[$i][2];
    $lot = $arr1[$i][3];
    $sector = $arr1[$i][4];
    $market_cap = $arr1[$i][5];
   // $beta = $arr1[$i][6];
$beta = "";

    if ($arr1[$i][1] != "") { // if vol is not zero
        echo $c_name." ".$sector."<br>";
        $rs = mysqli_query($con, "INSERT INTO `companies` VALUES ('$c_name','$d_name','$lot','$sector','$market_cap','$beta') ON DUPLICATE KEY UPDATE d_name = '$d_name',lot_size='$lot',sector='$sector',Market_Cap='$market_cap',beta='$beta'");
    $rs = mysqli_query($con_server, "INSERT INTO `companies` VALUES ('$c_name','$d_name','$lot','$sector','$market_cap','$beta') ON DUPLICATE KEY UPDATE d_name = '$d_name',lot_size='$lot',sector='$sector',Market_Cap='$market_cap',beta='$beta'");
      $affected_row = $affected_row +   mysqli_affected_rows($con); 
 $affected_row_server = $affected_row_server +   mysqli_affected_rows($con_server);    
    }

    if (!$rs) {
        echo mysqli_error($con);
    }
}

 
        if($affected_row == 0)
            {
                $status = "unchanged";
            }
            else{
                $status = "changed";
            }
            if($affected_row_server == 0)
            {
                $status_server = "unchanged";
            }
            else{
                $status_server = "changed";
            }
            $date_stamp = date('Y-m-d H:i:s');
              $rs = mysqli_query($con, "UPDATE `bliss_upload_status` SET status = '$status',num_row_change = '$affected_row',date = '$date_stamp' where table_name = 'companies_local'");
              $rs = mysqli_query($con, "UPDATE `bliss_upload_status` SET status = '$status_server',num_row_change = '$affected_row_server',date = '$date_stamp' where table_name = 'companies_server'");
         

$time_elapsed_secs = microtime(true) - $start;
echo "<br>" . $time_elapsed_secs;
//echo " <script type='text/javascript'> window.location = 'excel_upload.php'</script>";*/
?>