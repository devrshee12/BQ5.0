<html>
    <head>
    </head>
    <body>
<?php

include('PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
//error_reporting(0);
  /** Include PHPExcel and MySQLi db */
//require_once dirname(__FILE__) . '/PHPExcel-1.8/Classes/DB.php';
require_once dirname(__FILE__) . '/PHPExcel-1.8/Classes/PHPExcel.php';

$con=mysqli_connect("localhost","root","");
mysqli_set_charset($con,'utf8');
      
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
     else 
        {
            $sel_db =  mysqli_select_db($con,"bliss_vol");
                  
        
   
            $sql = "SELECT * FROM `companies` order by c_name ASC";                                     //FETCHING ALL company namre from db
        
       
        $result=mysqli_query($con,$sql);
      //  echo $result."  ".$sql." ".$con;
        $n=mysqli_num_rows($result);
     
       // echo "fsdf".$n;
            if($n>0)
              {
                while($row=mysqli_fetch_row($result))                                     //inserting all fetch value to array
                {
                    if($row != null)
                    {
                       $array2[] = $row[1];
                          $array3[] = $row[2];
                    }
                }
                    //to get last date aND time
              }
             else 
               {
                 echo "No Data";
               } 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Bliss_future";
//$dbname = "Bliss_Historical";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 for ($i = 0; $i < sizeof($array2); $i++)                                               //calculate last inserted value is maximum/minimum of companies or not
        {
            $table_name = strtolower($array2[$i]);
             $table_name = rtrim($table_name);
             $table_name = ltrim($table_name); 
/*$array2=array("CANFINHOME","CAPF","CGPOWER","CHENNPETRO","CHOLAFIN","DALMIABHA","EQUITAS","GMRINFRA","GODFRYPHLP","GRANULES","GSFC","HAVELLS","HINDUNILVR","IBREALEST","IBULHSGFIN","ICIL","IDFCBANK","INFIBEAM","JETAIRWAYS","JPASSOCIAT","JSWENERGY"
,"L&TFH","M&M","M&MFIN","MFSL","NBCC","NHPC","NIITTECH","RBLBANK","REPCOHOME","RNAVAL","RPOWER","SHREECEM","SOUTHBANK","SUZLON","TATAGLOBAL","UJJIVAN","VGUARD"); 
     
       //$con_hist=mysqli_connect("localhost","root","","historical");
       
          if(file_exists("//192.168.119.24/tempBliss_192.168.105.174_spider/spiderdata/Equity/".$table_name.".XLS"))
            {
            $objPHPExcel = PHPExcel_IOFactory::load("//192.168.119.24/tempBliss_192.168.105.174_spider/spiderdata/Equity/".$table_name.".XLS");
 
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
}
//echo serialize($dataArr);
unset($dataArr[1]); // since in our example the first row is the header and not the actual data

            $table_name = strtolower($array2[$i]);
             $table_name = rtrim($table_name);
             $table_name = ltrim($table_name);
       
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
                echo $table_name;
                foreach($dataArr as $val){
                 
                    $query = $conn->query("INSERT INTO `$table_name` SET date = '" . $conn->real_escape_string($val['0']) . "', open = '" . $conn->real_escape_string($val['1']) . "', high = '" . $conn->real_escape_string($val['2']) . "', low = '" . $conn->real_escape_string($val['3']) . "', close = '" . $conn->real_escape_string($val['4']) . "', qty = '" . $conn->real_escape_string($val['5']). "', value = '" . $conn->real_escape_string($val['6']). "', trades = '" . $conn->real_escape_string($val['7']). "', extra = '" . $conn->real_escape_string($val['8']) . "'");
                }
            }
        }
        }*/
 
             echo $table_name;
 //sql to create table
$sql = "CREATE TABLE `$table_name` (
 `Date` date NOT NULL,  
 `exp_date` date NOT NULL,
 `open` double NOT NULL,
 `high` double NOT NULL,
 `low` double NOT NULL,
 `close` double NOT NULL,
 `open_int` varchar(15) NOT NULL,
 `trade_val` varchar(15) NOT NULL,
 `trade_qty` varchar(15) NOT NULL,
 `no_of_contract` varchar(15) NOT NULL,
 `no_of_trade` varchar(15) NOT NULL,
 `day_left` varchar(5) NOT NULL,
 primary key (Date)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


}
        }
$conn->close();
//echo " <script type='text/javascript'> window.location = 'excel_upload.php'</script>";*/

/*include('PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

require_once dirname(__FILE__) . '/PHPExcel-1.8/Classes/PHPExcel.php';

$con=mysqli_connect("localhost","root","");
mysqli_set_charset($con,'utf8');
      
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
     else 
        {
            $sel_db =  mysqli_select_db($con,"bliss_vol");
                  
        
   
            $sql = "SELECT * FROM `companies` order by c_name ASC";                                     //FETCHING ALL company namre from db
        
       
        $result=mysqli_query($con,$sql);
      //  echo $result."  ".$sql." ".$con;
        $n=mysqli_num_rows($result);
     
       // echo "fsdf".$n;
    if($n>0)
      {
        while($row=mysqli_fetch_row($result))                                     //inserting all fetch value to array
        {
            if($row != null)
            {
             //   $array2[] = $row[1];
              //      $array3[] = $row[2];
            }
        }
            //to get last date aND time
        
          
      }
     else 
       {
         echo "No Data";
       } 
       
$array2=array("CANFINHOME","CAPF","CGPOWER","CHENNPETRO","CHOLAFIN","DALMIABHA","EQUITAS","GMRINFRA","GODFRYPHLP","GRANULES","GSFC","HAVELLS","HINDUNILVR","IBREALEST","IBULHSGFIN","ICIL","IDFCBANK","INFIBEAM","JETAIRWAYS","JPASSOCIAT","JSWENERGY"
,"L&TFH","M&M","M&MFIN","MFSL","NBCC","NHPC","NIITTECH","RBLBANK","REPCOHOME","RNAVAL","RPOWER","SHREECEM","SOUTHBANK","SUZLON","TATAGLOBAL","UJJIVAN","VGUARD"); 
       $servername = "localhost";
$username = "root";
$password = "";
//$dbname = "Bliss_option";
$dbname = "Bliss_Historical";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
       //$con_hist=mysqli_connect("localhost","root","","historical");
        for ($i = 0; $i < sizeof($array2); $i++)                                               //calculate last inserted value is maximum/minimum of companies or not
        {
            $table_name = strtolower($array2[$i]);
             $table_name = rtrim($table_name);
             $table_name = ltrim($table_name); 
          if(file_exists("//192.168.119.24/tempBliss_192.168.105.174_spider/spiderdata/Equity/".$table_name.".XLS"))
            {
            $objPHPExcel = PHPExcel_IOFactory::load("//192.168.119.24/tempBliss_192.168.105.174_spider/spiderdata/Equity/".$table_name.".XLS");
 
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
}
//echo serialize($dataArr);
unset($dataArr[1]); // since in our example the first row is the header and not the actual data

            $table_name = strtolower($array2[$i]);
             $table_name = rtrim($table_name);
             $table_name = ltrim($table_name);
       
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
                echo $table_name;
                foreach($dataArr as $val){
                 
                    $query = $conn->query("INSERT INTO `$table_name` SET date = '" . $conn->real_escape_string($val['0']) . "', open = '" . $conn->real_escape_string($val['1']) . "', high = '" . $conn->real_escape_string($val['2']) . "', low = '" . $conn->real_escape_string($val['3']) . "', close = '" . $conn->real_escape_string($val['4']) . "', qty = '" . $conn->real_escape_string($val['5']). "', value = '" . $conn->real_escape_string($val['6']). "', trades = '" . $conn->real_escape_string($val['7']). "', extra = '" . $conn->real_escape_string($val['8']) . "'");
                }
            }
        }
        }
        /*     echo $table_name;
 //sql to create table
$sql = "CREATE TABLE `$table_name` (
 `Date` date NOT NULL, 
 `spot` varchar(15) NOT NULL,
 `strike` varchar(15) NOT NULL,
 `op_type` varchar(15) NOT NULL,
 `exp_date` date NOT NULL,
 `open` double NOT NULL,
 `high` double NOT NULL,
 `low` double NOT NULL,
 `close` double NOT NULL,
 `open_int` varchar(15) NOT NULL,
 `qty` varchar(15) NOT NULL,
 `No_of_cont` varchar(15) NOT NULL,
 `trades` varchar(15) NOT NULL,
 `Notion_value` varchar(15) NOT NULL,
 `PR_value` varchar(15) NOT NULL,
 `day_left` varchar(5) NOT NULL,
 primary key (Date, strike,op_type)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


    }
        }
$conn->close();
//echo " <script type='text/javascript'> window.location = 'excel_upload.php'</script>";*/
?>