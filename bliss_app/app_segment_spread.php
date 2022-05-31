<?php
$array_spread = array("adanipower_adaniports", "axisbank_icicibank", "hdfcbank_kotakbank", "hdfc_hdfcbank","nifty_banknifty","ongc_gail","pfc_recltd","powergrid_ntpc","relcapital_relinfra","tatamotors_tatamtrdvr");
$array_spread_name = array("Adani Power - Adani Ports", "Axis Bank - Icici Bank", "HDFC Bank - Kotak Bank", "HDFC - HDFC Bank","Nifty - Bank Nifty","ONGC - GAIL","PFC - REC Limited","PowerGrid - NTPC","Reliance capital- Reliance Infra","Tata Motors-Tata Motors (DVR)");
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
  $sql6 = "SELECT date,time FROM `vol_nifty` order by entry_number DESC limit 1" ;                  //select db

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
            
           for($i=0;$i<sizeof($array_spread);$i++)
           {
               $table_name = "spread_".$array_spread[$i];
            $sql3 = "SELECT *,(select ROUND(MAX(abs(vol_difference)),1) from `$table_name` where date = '$last_date1'),(select ROUND(MIN(abs(vol_difference)),1) from `$table_name` where date = '$last_date1') FROM `$table_name` order by id DESC limit 1";
        
            $result3 = mysqli_query($con,$sql3);
            $n3=mysqli_num_rows($result3);
            //echo $n3;
            if($n3>0)
            {
              while($row=mysqli_fetch_row($result3))
              {
                  if($row != null)
                  {   // $array_all[$total_data][6] = "<img src='image/". $row[1].".jpg' alt='no img' name='$row[1]|$row[8]|$row[4]' height='15' width='20'/>";
                     /* $array_all[$total_data][3] = $row[1];
                      $array_all[$total_data][4] = */
                    
                        //echo $check2;                       
                      $array_all[$total_data][0] = $row[1]; //name
                       $date = new DateTime($row[2]);
                        $date = $date->format('d M Y');
                       $array_all[$total_data][1] = $date;  //date
                       $array_all[$total_data][2]   = $row[3]; //time
                      $array_all[$total_data][3] = $row[4]; //vol1
                        $array_all[$total_data][4] = $row[5];      //  vol2              
                      $array_all[$total_data][5] = abs($row[6]); //diff
                       $array_all[$total_data][6] = $row[7]; // max vol diff
                       $array_all[$total_data][7] = $row[8]; // min vol diff
                      // echo $array_all[$total_data][0]."  ".$array_all[$total_data][1]."  ".$array_all[$total_data][2]."  ".$array_all[$total_data][3]."<BR>";
                       $total_data = $total_data + 1;
                  }             
                }            
            }
           }
          
       if($total_data == 0)
       {
            echo "No Data";
       }
       else
       {
            echo json_encode(array("segment_spread" => $array_all));  //json code to encrypt
       }
       
       ?>


