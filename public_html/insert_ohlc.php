<html>
    <head>
    </head>
    <body>
<?php

$date = $_GET['date'];;
$open = $_GET['open'];;
$high = $_GET['high'];;
$low = $_GET['low'];;
$close = $_GET['close'];;
$qty = $_GET['qty'];;
$trades = $_GET['trade'];;
$values = $_GET['value'];;
$last_price = $_GET['lastprice'];;
$scrip = $_GET['symbol'];;
echo $high;
$scrip = str_replace('"', '', $scrip);
$scrip = str_replace('_', '&', $scrip);
$table_name = $scrip;
             $table_name = rtrim($table_name);
             $table_name = ltrim($table_name);

  
   
       $servername = "localhost";
$username = "root";
$password = "";
$dbname = "Bliss_historical";
$dataArr[0][0] = $date;
$dataArr[0][1] = $open;
$dataArr[0][2] = $high;
$dataArr[0][3] = $low;
$dataArr[0][4] = $close;
$dataArr[0][5] = $qty;
$dataArr[0][6] = $values;
$dataArr[0][7] = $trades;
$dataArr[0][8] = $last_price;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
       //$con_hist=mysqli_connect("localhost","root","","historical");
      /*  for ($i = 39 ; $i < sizeof($array2); $i++)                                               //calculate last inserted value is maximum/minimum of companies or not
        {
            
            if(file_exists("//192.168.119.24/tempBliss_192.168.105.174_spider/spiderdata/Equity/".$array2[$i].".XLS"))
            {
            $objPHPExcel = PHPExcel_IOFactory::load("//192.168.119.24/tempBliss_192.168.105.174_spider/spiderdata/Equity/".$array2[$i].".XLS");
 
$dataArr = array();
 
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
     
    for ($row = 1; $row <= $highestRow; ++ $row) {
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            if($col == 0)
            {
                $UNIX_DATE = ($val - 25569) * 86400;
                $val = gmdate("Y-m-d", $UNIX_DATE);
            }
            $dataArr[$row][$col] = $val;
            
        }
    }
}*/
//echo serialize($dataArr);
unset($dataArr[1]); // since in our example the first row is the header and not the actual data

        /*    $table_name = strtolower($array2[$i]);
             $table_name = rtrim($table_name);
             $table_name = ltrim($table_name);*/
  echo $table_name;     
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo $table_name;
foreach($dataArr as $val){
    $query = $conn->query("INSERT INTO `$table_name` SET date = '" . $conn->real_escape_string($val['0']) . "', open = '" . $conn->real_escape_string($val['1']) . "', high = '" . $conn->real_escape_string($val['2']) . "', low = '" . $conn->real_escape_string($val['3']) . "', close = '" . $conn->real_escape_string($val['4']) . "', qty = '" . $conn->real_escape_string($val['5']). "', value = '" . $conn->real_escape_string($val['6']). "', trades = '" . $conn->real_escape_string($val['7']). "', extra = '" . $conn->real_escape_string($val['8']) . "' ON DUPLICATE KEY UPDATE    
 open = '" . $conn->real_escape_string($val['1']) . "', high = '" . $conn->real_escape_string($val['2']) . "', low = '" . $conn->real_escape_string($val['3']) . "', close = '" . $conn->real_escape_string($val['4']) . "', qty = '" . $conn->real_escape_string($val['5']). "', value = '" . $conn->real_escape_string($val['6']). "', trades = '" . $conn->real_escape_string($val['7']). "', extra = '" . $conn->real_escape_string($val['8']) . "'");
}
          
// sql to create table
/*$sql = "CREATE TABLE `$table_name` (
 `Date` date NOT NULL,
 `open` double NOT NULL,
 `high` double NOT NULL,
 `low` double NOT NULL,
 `close` double NOT NULL,
 `qty` varchar(15) NOT NULL,
 `value` varchar(15) NOT NULL,
 `trades` varchar(15) NOT NULL,
 `extra` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}*/

$conn->close();
  
//echo " <script type='text/javascript'> window.location = 'excel_upload.php'</script>";*/
?>