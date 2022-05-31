<?php
$n=0;
error_reporting(0);                                 //mysql_num_rows is showing error so this will not display any error
ini_set('display_errors', 0);
$dat1 =  $_POST['date1'];
/*$date1 =  $dat1['date1'];
$sort =  $dat1['sort'];
$search = $dat1['search'];*/
//$dat1 = "2016-03-10";

 $pieces = explode("/", $dat1); // split date with /
    $date1 = $pieces[0]; //take one date
    if(count($pieces)>1) // check whether second date is there or not
    {
        $date2 = $pieces[1]; // insert second date
    }
    else
    {
        $date2 = $date1; 
    }
    
        

$sort =  "ASC";
//$search = "";
$dates1 = explode("/", $date1);
$check1 = 0;
$check2 = 0;
$check3 = 0;
$total_data = 0;
$array_all = array(array());//array for top 10 of both, max and min vol
$array_all_m = array(array()); //array for max vol data
$array_all_n = array(array());  //array for min vol data
$array2 = (array) null;         //array for companies
$array_min = (array) null;
$array_vol = (array) null;
$array_eq = (array) null;
$datetime;
$last_date1;
$last_date2;
$last_time;
$con=mysql_connect("localhost","blissquants","bliss");
mysql_set_charset('utf8');
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {            
        $sel_db =  mysql_select_db("bliss",$con);                               //select db
        
        $sql = "SELECT * FROM `companies` order by c_name $sort";                                     //FETCHING ALL company namre from db
       
        $result=mysql_query($sql,$con);
      //  echo $result."  ".$sql." ".$con;
        $n=mysql_num_rows($result);
     
       // echo "fsdf".$n;
    if($n>0)
      {
        while($row=mysql_fetch_row($result))                                     //inserting all fetch value to array
        {
            if($row != null)
            {
                $array2[] = $row[1];
                
            }
        }
            //to get last date aND time
          
            $result6 = mysql_query("SELECT date,time FROM `vol_nifty` order by entry_number DESC limit 1",$con);
            $n6=mysql_num_rows($result6);
            if($n6>0)
            {
              while($row=mysql_fetch_row($result6))
              {
                  if($row != null)
                  {  $last_date1 =  $row[0];                //take last date of updation assuming that vol_acc table is updating properly
                     $datetime = $row[0]." ".$row[1];       //taking last date and time to variable
                     $last_time=$row[1];                     
                  }
              }
            }
        for ($i = 0 ; $i < $n; $i++)                                               //calculate last inserted value is maximum/minimum of companies or not
        {
            $table_name = strtolower("vol_".$array2[$i]);
          
		  $sql3 = "SELECT date, ROUND( ATM_vol, 1 ) as current ,maxv.maxvol,maxv.minvol, Round((maxv.maxvol - ATM_vol),1), Round((ATM_vol - maxv.minvol),1) 
FROM `$table_name`,(SELECT  MAX(ATM_vol) as maxvol,MIN(ATM_vol) as minvol FROM `$table_name` where date
BETWEEN '$date1'
AND '$date2'
)maxv
WHERE date = '$last_date1'
AND Time = '$last_time'
AND (
SELECT volume
FROM `$table_name`
ORDER BY entry_number DESC
LIMIT 1
) <> (
SELECT volume
FROM `$table_name`
ORDER BY entry_number DESC
LIMIT 1 , 1 )
ORDER BY entry_number DESC
LIMIT 1";
             
                  //and ATM_vol <> '50.0'
            $result3 = mysql_query($sql3,$con);
            $n3=mysql_num_rows($result3);
             
            if($n3>0)
            {
              while($row=mysql_fetch_row($result3))
              {
                  if($row != null)
                  {  $last_date2 = $row[0]; //get last date of inserted data
                      $check2 = $row[1];        //taking last vol to variable
					  $high = $row[2];
					  $low = $row[3];
                     $ch3 = $row[4];
                      $ch4  = $row[5]; 
                      // echo $table_name." ".$row[1]." ".$row[2]." ".$row[3]." ".$row[4]." ".$row[5]."<br>";
                  }
              }
           


            if($last_date2 == $last_date1)
            {
                if($check2 > 8 && $check2 != 50)
                { 
                    //get diff to compare mininmum and maximum difference
                   
                       
                    //insert data related to max vol
                    $array_all_m[$total_data][0] = $array2[$i]; //script name
                    $array_all_m[$total_data][1] = $check2;    //last vol  
                    $array_all_m[$total_data][2] = $ch3;  //vol difference and "abs" is to remove -ve sign
					$array_all_m[$total_data][3] = $high;
					$array_all_m[$total_data][4] = $low;
                   //insert data related to min vol
                     $array_all_n[$total_data][0] = $array2[$i];
                    $array_all_n[$total_data][1] = $check2;                                      //if same then put it into array
                    $array_all_n[$total_data][2] = $ch4; 
					$array_all_n[$total_data][3] = $high;
					$array_all_n[$total_data][4] = $low;
                                        
                    
                    // echo $table_name.$ch3." ".$ch4." ".$check2." ".$check1." ".$check3."<bR>";
                   //  echo $array_all_n[$total_data][2];
                    $total_data = $total_data + 1;
                }
            } 
          }
        }
  
        $array_all_m = subval_sort($array_all_m,2); //sort according to 3rd index(difference of max vol and last vol)
        $array_all_n = subval_sort($array_all_n,2); //sort according to 3rd index(difference of min vol and last vol)
 
        //add top 20 max script in array
        for($i=0;$i<15;$i++)
        {
            $array_all[$i][0] = $array_all_m[$i][0]; // script name
            $array_all[$i][1] = $array_all_m[$i][1];    //vol
            $array_all[$i][2] = $array_all_m[$i][2];    //vol difference
			$array_all[$i][3] = $array_all_m[$i][3];    //high
			$array_all[$i][4] = $array_all_m[$i][4];    //low
                       if($array_all_m[$i][0])
                      {       $eq = $array_all_m[$i][0]; 

                           $file ="http://www.google.com/finance/info?q=NSE:$eq";
                                 //  echo $file;
                      
                       //Obtain Quote Info
                         $quote = file_get_contents($file);

                       //Remove CR's from ouput - make it one line
                         $json = str_replace("\n", "", $quote);
                         
                        //Remove //, [ and ] to build qualified string  
                          $data = substr($json, 4, strlen($json) -5);

                        //decode JSON data
                          $json_output = json_decode(utf8_decode($data));

                          $cmp = floatval(str_replace(',', '',$json_output->l));
                          $array_all[$i][5]=$cmp;
                      }
        }
     //   echo serialize($array_all_m);
        $j = 0;
        //add top 20 min acript in array
        for($i=15;$i<30;$i++)
        {
            $array_all[$i][0] = $array_all_n[$j][0];
            $array_all[$i][1] = $array_all_n[$j][1];
            $array_all[$i][2] = $array_all_n[$j][2];
			$array_all[$i][3] = $array_all_n[$j][3];    //high
			$array_all[$i][4] = $array_all_n[$j][4];    //low
                             if($array_all_n[$i][0])
                      {       $eq = $array_all_n[$i][0]; 

                           $file ="http://www.google.com/finance/info?q=NSE:$eq";
                                 //  echo $file;
                      
                       //Obtain Quote Info
                         $quote = file_get_contents($file);

                       //Remove CR's from ouput - make it one line
                         $json = str_replace("\n", "", $quote);
                         
                        //Remove //, [ and ] to build qualified string  
                          $data = substr($json, 4, strlen($json) -5);

                        //decode JSON data
                          $json_output = json_decode(utf8_decode($data));

                          $cmp = floatval(str_replace(',', '',$json_output->l));
                          $array_all[$i][5]=$cmp;
                      }
            $j = $j + 1;
        }
        
      // echo serialize($array_all_n);
       echo json_encode(array("a" => $array_all,"b" => 40 ,"c" => $datetime));  //json code to encrypt
      }
     else 
       {
       echo "No Data";
       } 
    }
    
    function subval_sort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	asort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}
?>

