<?php
$n=0;
//error_reporting(0);                                 //mysql_num_rows is showing error so this will not display any error
//ini_set('display_errors', 0);
$dat1 =  $_POST['date1'];
/*$date1 =  $dat1['date1'];
$sort =  $dat1['sort'];
$search = $dat1['search'];*/
//$dat1 = "2016-08-03/2016-08-03";
//$sort ="ASC";
//$dat1 = "2019-01-02/2019-01-02";

 $pieces = explode("/", $dat1); // split date with /
    $date1 = $pieces[0]; //take one date
   
    
        

$sort =  "ASC";
//$search = "";
//$dates1 = explode("/", $date1);
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
$con=mysqli_connect("localhost","root","","bliss");
mysqli_set_charset($con,'utf8');
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {            
      //  $sel_db =  mysqli_select_db($con,);                               //select db
        
        $sql = "SELECT * FROM `companies` order by c_name $sort";                                     //FETCHING ALL company namre from db
       
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
                $array2[] = $row[0];
                
            }
        }
            //to get last date aND time
          
            $result6 = mysqli_query($con,"SELECT date,time FROM `vol_nifty` order by entry_number DESC limit 1");
            $n6=mysqli_num_rows($result6);
            if($n6>0)
            {
              while($row=mysqli_fetch_row($result6))
              {
                  if($row != null)
                  {  $last_date1 =  $row[0];                //take last date of updation assuming that vol_acc table is updating properly
                     $datetime = $row[0]." ".$row[1];       //taking last date and time to variable
                     $last_time=$row[1]; 
                  //   echo $last_date1;
                   //  echo $last_time;
                  }
              }
            }
            /*if there is single date(todays_date/todays_date) only then take date of nifty which is proper for on market and off market days also*/
    if($pieces[0] != $pieces[1]) // check whether second date is there or not
    {//echo "cd";
        $date2 = $pieces[0]; // insert second date
    }
    else
    {//echo "fd";
        $date2 = $date1 = $last_date1; 
    }
   // echo $date2."gf".$date1;
        for ($i = 0 ; $i < $n; $i++)                                               //calculate last inserted value is maximum/minimum of companies or not
        {
            $table_name = strtolower("vol_".$array2[$i]);
           //give last vol
           // $sql3 = "SELECT date, ROUND( ATM_vol, 1 ) FROM `$table_name` WHERE date = '$last_date1' AND volume <> (SELECT volume FROM `$table_name` ORDER BY entry_number DESC LIMIT 1 , 1 ) ORDER BY entry_number DESC LIMIT 1";
          // $sql3 = "SELECT date,ROUND(ATM_vol,1) FROM `$table_name` where date = '$last_date1' order by entry_number DESC limit 1";
            
     //   $sql3 = "SELECT date,ROUND(ATM_vol,1) FROM `$table_name` WHERE date = '$last_date1' and Time = '$last_time'  and (SELECT volume FROM `$table_name` ORDER BY entry_number DESC LIMIT 1 ) <> (SELECT volume FROM `$table_name` ORDER BY entry_number DESC LIMIT 1 , 1 ) ORDER BY entry_number DESC LIMIT 1"; //select todays data and last time of nifty only and whose volume is changed from last data
       
        //echo $table_name." ".$date1." ".$date2." ".$last_date1." ".$last_time;    
            
            $sql3 = "SELECT date, ROUND( ATM_vol, 1 ) as current ,maxv.maxvol,maxv.minvol 
FROM `$table_name`,(SELECT  ROUND( MAX(ATM_vol) ,1 ) as maxvol,ROUND( MIN(ATM_vol),1 ) as minvol FROM `$table_name` where date
BETWEEN '$date1'
AND '$date2'
)maxv
WHERE date = '$last_date1'

AND (
SELECT volume
FROM `$table_name`
ORDER BY entry_number DESC
LIMIT 1
) <> (
SELECT volume
FROM `$table_name`
ORDER BY entry_number DESC
LIMIT 1 , 1 ) and (select count(date) FROM `$table_name` where date = '$last_date1') > 2  
ORDER BY entry_number DESC
LIMIT 1";
          // AND Time = '$last_time'
   /* to check number data in particular date is > 2  select count(date) FROM `$table_name` where date = '$last_date1'*/          
                  //and ATM_vol <> '50.0'
            $result3 = mysqli_query($con,$sql3);
            $n3=mysqli_num_rows($result3);
             
            if($n3>0)
            {
              while($row=mysqli_fetch_row($result3))
              {
                  if($row != null)
                  {  $last_date2 = $row[0]; //get last date of inserted data
                      $check2 = $row[1];        //taking last vol to variable
                     $ch3 = $row[2] - $row[1];//, Round((maxv.maxvol - ATM_vol),1), Round((ATM_vol - maxv.minvol),1)
                      $ch4  = $row[1] - $row[3]; 
                    // echo $table_name." ".$row[1]." ".$row[2]." ".$row[3]." ".$ch3." ".$ch4."<br>";
                  }
              }
           

// $sql2 = "SELECT ROUND(MAX(ATM_vol),1) FROM `$table_name` WHERE date between '$dates1[0]' and '$dates1[1]'";
            //give max vol
      /*  if($date2 == 0)
        {
            $sql2 = "select ROUND(MAX(ATM_vol),1) FROM `$table_name` WHERE date = '$date1' "; //order by abs(ATM_vol - $check2) limit 1
        }
        else
        {
            $sql2 = "select ROUND(MAX(ATM_vol),1) FROM `$table_name` WHERE date between '$date1' and '$date2'"; //order by abs(ATM_vol - $check2) limit 1
        }
            $result2 = mysqli_query($sql2,$con);
            $n2=mysqli_num_rows($result2);
            if($n2>0)
            {
              while($row = mysqli_fetch_row($result2))
              {
                  if($row != null)
                  {  
                     // $array_all[$i][0] = $array2[$i];
                    $check1 = $row[0];
                    //echo $check1;
                  }
              }
            }

        if($date2 == 0)
        {
           $sql4 = "SELECT ROUND(MIN(ATM_vol),1) FROM `$table_name` WHERE date = '$date1' ";
        }
        else{
            $sql4 = "SELECT ROUND(MIN(ATM_vol),1) FROM `$table_name` WHERE date between '$date1' and '$date2' ";
        }
            $result4 = mysqli_query($sql4,$con);
            $n4=mysqli_num_rows($result4);
            if($n4>0)
            {
              while($row=mysqli_fetch_row($result4))
              {
                  if($row != null)
                  {  
                     // $array_all[$i][0] = $array2[$i];
                    $check3 = $row[0]; 
                    //echo $check1;
                  }
              }
            }
            /*if ($check1 == $check2)                                             //check last and maximum value is same or not
            {*/
            if($last_date2 == $last_date1)
            {
                if($check2 > 8 && $check2 != 50)
                { 
                    //get diff to compare mininmum and maximum difference
                   
                       
                    //insert data related to max vol
                    $array_all_m[$total_data][0] = $array2[$i]; //script name
                    $array_all_m[$total_data][1] = $check2;    //last vol  
                    $array_all_m[$total_data][2] = $ch3;  //vol difference and "abs" is to remove -ve sign
                   //insert data related to min vol
                     $array_all_n[$total_data][0] = $array2[$i];
                    $array_all_n[$total_data][1] = $check2;                                      //if same then put it into array
                    $array_all_n[$total_data][2] = $ch4; 
                    // echo $table_name.$ch3." ".$ch4." ".$check2." ".$check1." ".$check3."<bR>";
                   //  echo $array_all_n[$total_data][2];
                    $total_data = $total_data + 1;
                }
            } 
          }
        }
  
        $array_all_m = subval_sort($array_all_m,2); //sort according to 3rd index(difference of max vol and last vol)
        $array_all_n = subval_sort($array_all_n,2); //sort according to 3rd index(difference of min vol and last vol)
 //echo serialize($array_all_m);
        //add top 20 max script in array
        for($i=0;$i<20;$i++)
        {
            $array_all[$i][0] = $array_all_m[$i][0]; // script name
            $array_all[$i][1] = $array_all_m[$i][1];    //vol
            $array_all[$i][2] = $array_all_m[$i][2];    //vol difference
        }
        $j = 19;
        //add top 20 min acript in array
        for($i=20;$i<40;$i++)
        {
            $array_all[$i][0] = $array_all_n[$j][0];
            $array_all[$i][1] = $array_all_n[$j][1];
            $array_all[$i][2] = $array_all_n[$j][2];
            $j = $j - 1;
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

