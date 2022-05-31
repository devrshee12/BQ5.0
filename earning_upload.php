<?php

//excel reader file for import data from excel
include 'public_html\excel_reader\excel_reader.php';       // include the class
//error_reporting( E_ALL );
//database mysql connection   

include('public_html/db_connect.php');
        include('public_html/db_connect_server.php');    
$excel = new PhpExcelReader;
// creates object instance of the class
//taking file name
//$file_path = $_FILES["files"]["name"]; //only .xls is recieved
//declaration
$ex_date;
$n = 0;

$c_name;
$c_name1;

//setting maximum execution time 
ini_set('max_execution_time', 300);
//taking file from folder
$file_path2 = "//192.168.119.24/tempBliss_192.168.105.174_spider/result/Result_original.xls";

$excel->read($file_path2);
// reads and stores the excel file data

$sd = $excel->sheets[0]['cells'];
//echo serialize($excel->sheets[0]['cells']);

$total_row = $excel->sheets[0]['numRows'];
//taking total no. of rows
echo serialize($sd);
for ($i = 1; $i <= $total_row; $i++) {

    if (isset($sd[$i][2])) {

        $c_name1 = $sd[$i][2]; //equity code
        $name = $sd[$i][3]; // taking original name
    }
    if (isset($sd[$i][4])) {
        echo $sd[$i][4];
        //if date come in different format
        if (preg_match("@([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})@", $sd[$i][4], $regs)) {

            $from_unix_time = mktime(0, 0, 0, $regs[2], $regs[1], $regs[3]);
            $day_before = strtotime("yesterday", $from_unix_time);
            $formatted = date('Y-m-d', $day_before);
            //echo $formatted . "   dasd ";
        } else if (preg_match("@([0-9]{1,2}) ([0-9]{1,2}) ([0-9]{4})@", $sd[$i][4], $regs)) {
            $from_unix_time = mktime(0, 0, 0, $regs[2], $regs[1], $regs[3]);
            $day_before = strtotime("yesterday", $from_unix_time);
            $formatted = date('Y-m-d', $day_before);
           // echo $formatted . "dfdfsd";
        } else {
            $date3 = strtotime($sd[$i][4]);
            $formatted = date('Y-m-d', $date3);
          //  echo $formatted;
            //$formatted = "";
        }
        //formatting date because date we get from excel is one day ahead
    } else {
        $formatted = "";
    }
 
       
   
    
// insert value only if date and time is available
    if (isset($sd[$i][4])) {
                echo $name." ".$formatted;

    $result1 = mysqli_query($con, "SELECT * FROM earning2 WHERE name = '$c_name1'  And time = '00:00:00' And date = '$formatted'"); //here date  may also get change till result come
    if (mysqli_num_rows($result1) < 1) {
        $rs = mysqli_query($con, "INSERT INTO `earning2`  VALUES (Default,'$c_name1','$name','$formatted','00:00:00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0') ON DUPLICATE KEY UPDATE time = '00:00:00'");
       // $rs = mysqli_query($con_server, "INSERT INTO `earning2`  VALUES (Default,'$c_name1','$name','$formatted','00:00:00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0') ON DUPLICATE KEY UPDATE time = '00:00:00'");
    } else {
        $rs = mysqli_query($con, "UPDATE earning2 SET d_name = '$name', date = '$formatted' WHERE name = '$c_name1' And time = '00:00:00'");
        //$rs = mysqli_query($con_server, "UPDATE earning2 SET d_name = '$name', date = '$formatted' WHERE name = '$c_name1' And time = '00:00:00'");  //  $rs =  mysql_query("INSERT INTO earning2 VALUES (DEFAULT,'$c_name1','$name','$formatted','$time','$net_sale_q','$net_profit_q','$net_sale_y','$net_profit_y','','$ch','$o','$h','$l','$c','$p','')");
    }
    if ($rs) {
        echo " succesfull";
    } else {
        echo " error";
    }
     echo "<br>";
    }
   
}
$rs1 = mysqli_query($con, "UPDATE earning2,
(
SELECT name, Max( Abs( changes ) ) AS maxDateForUser
FROM earning2
GROUP BY name
)t
SET max_change = t.maxDateForUser WHERE earning2.name = t.name");

$rs2 = mysqli_query($con, "UPDATE earning2,
(
SELECT name, Min( Abs( movement ) ) AS minmovForUser
FROM earning2  where movement <> 0
GROUP BY name
)t
SET min_Movement = ROUND(t.minmovForUser,1) WHERE earning2.name = t.name");

$rs3 = mysqli_query($con, "UPDATE earning2,
(
SELECT name, Max( Abs( movement ) ) AS maxmovForUser
FROM earning2  where movement <> 0
GROUP BY name
)t
SET max_Movement = ROUND(t.maxmovForUser,1) WHERE earning2.name = t.name");
if ($rs1 || $rs2 || $rs3) {
    echo "succesfull";
} else {
    echo " error";
}


?>