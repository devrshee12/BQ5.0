<?php
  $con=mysqli_connect("localhost","blissquants","bliss"); 
    if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
     else 
        {
            $sel_db =  mysqli_select_db($con,"bliss");
        }
error_reporting(0);                                 //mysql_num_rows is showing error so this will not display any error
ini_set('display_errors', 0);


$n=0;
$total_data = 0;
$array_all = array(array());
$array2 = (array) null;
$array3 = (array) null;

 
mysqli_set_charset($con,'utf8');
  $sql6 = "SELECT date,time FROM `sudden_movement` order by id DESC limit 1" ;                  //select db

  $result6 = mysqli_query($con,$sql6);  
            $n6=mysqli_num_rows($result6);            
            if($n6>0)
            {
              while($row=mysqli_fetch_row($result6))
              {
                  if($row != null)
                  {  $last_date1 =  $row[0];                //take last date of updation assuming that vol_acc table is updating properly
                     $datetime = $row[0]." ".$row[1];       //taking last date and time to variable
                     $last_time=$row[1];  
                 
                  }
               }
               
            }
         $time = strtotime($last_time);
$startTime = date("H:i:s", strtotime('-30 minutes', $time));
//echo $startTime;
//$endTime = date("H:i", strtotime('+30 minutes', $time));  
            $sql3 = "SELECT * FROM `sudden_movement` where date = '$last_date1' and time <= '$last_time' and time >= '$startTime' order by id desc";
        
            $result3 = mysqli_query($con,$sql3);
            $n3=mysqli_num_rows($result3);
            //echo $n3;
            if($n3>0)
            {
              while($row=mysqli_fetch_row($result3))
              {
                  if($row != null && $row[4] > 2)
                  {   // $array_all[$total_data][6] = "<img src='image/". $row[1].".jpg' alt='no img' name='$row[1]|$row[8]|$row[4]' height='15' width='20'/>";
                     /* $array_all[$total_data][3] = $row[1];
                      $array_all[$total_data][4] = */
                       $array_all[$total_data][0] = $row[1];
                         $array_all[$total_data][1] = $row[2];
                          $array_all[$total_data][2] = $row[3];
                          $array_all[$total_data][3] = $row[4];
                           $array_all[$total_data][4] = $row[5];
                      $array_all[$total_data][5] = round($row[6], 2);
                        //echo $check2;
                       //echo $array_all[$total_data][0]."  ".$array_all[$total_data][1]."  ".$array_all[$total_data][2]."  ".$array_all[$total_data][3]."<BR>";
                       $total_data = $total_data + 1;
                  }             
                }            
            }
          
     
            
       
       
       if($total_data == 0)
       {
            echo "No Data";
       }
       else
       {
       echo json_encode(array("sudden_movement" => $array_all));  //json code to encrypt
       }
  
?>

