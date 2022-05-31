<?php
session_start();
$array_all  = array();
$scripts = array();
$total_data = 0;
include("../db_connect.php");
$user_id = $_SESSION['user_id'];
   
     $sql = "SELECT scripts FROM `blisseye` where user_id = '$user_id'";    
       
            $result_scrip=mysqli_query($con,$sql);
            $n_scrip=mysqli_num_rows($result_scrip);
                if($n_scrip>0)
                  {
                    while($row=mysqli_fetch_row($result_scrip))                                     //inserting all fetch value to array
                    {  // echo "hello";
                        if($row != null)
                        {
                            $scripts = explode(",", $row[0]);
                          
                               }
                    }
                  }
 // $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");
  
  

  //    echo json_encode(array("a" =>  $scripts));  //json code to encrypt
     
 $c_name2 = $scripts;
 $array2 = array();
$today_date = date("Y-m-d");
$current_time = strtotime(date("h:i:sa"));
//$c_name2 = array("ACC");
//$date1 = "2019-01-10/2019-01-10";
$pieces = explode("/", $today_date);
//echo "<script>alert('dfsfsdf');</script>";
      if(!isset($pieces[1]))
{
    $pieces[1] = $pieces[0];
}   

for($k=0;$k < sizeof($c_name2); $k++)
{$array2 = array();
$max_vol = $min_vol = 0;
//echo $i;
    if($c_name2[$k] != "")
    {
            $table_name = strtolower("vol_".$c_name2[$k]);
          // echo $table_name." ";
             $table_name = ltrim(rtrim($table_name));
            $sql = "SELECT date,Round(ATM_vol,1),Time,days_of_expire,ROUND(delta,2),ATM,ATM_price,spot from `$table_name` WHERE date between '$pieces[0]' and '$pieces[1]' and ATM_vol > 0 and ABS(delta - 0) > 0.0001 and delta < 1 order by date,Time ASC ";
            $result=mysqli_query($con,$sql);
            $n=mysqli_num_rows($result);
            $j=0;
            
                if($n>0)
                  {
                    while($row=mysqli_fetch_row($result))
                    {
                    if($row != null)
                        {
                            if($row[1] > 5 && $row[1] != "50.0")
                            {
                                for($i=0;$i<8;$i++)
                                {
                                    $array2[] = $row[$i];
                                     if($i==1)
                                    {
                                        $vol[] = Round($row[$i],1);
                                    }
                                }
                            }
                        }
                    }
                    $max_vol = max($vol);
                                $min_vol = min($vol);
                   $array_all[] = array("data" => $array2,"b" => $n,"max"=>$max_vol,"min"=>$min_vol,"name"=>$c_name2[$k]);     
                } 
            else 
                {// when holiday is there, single day data are not fetching as we are retrieving that from date
                    $result6 = mysqli_query($con,"SELECT date,time FROM `vol_nifty` order by entry_number DESC limit 1");
                    $n6=mysqli_num_rows($result6);
                    if($n6>0)
                    {
                      while($row=mysqli_fetch_row($result6))
                      {
                          if($row != null)
                          {  
                             $last_date1 =  $row[0];                //take last date of updation assuming that vol_acc table is updating properly
                                // $datetime = $row[0]." ".$row[1];       //taking last date and time to variable
                             $last_time=$row[1];    
                             
                          }
                      }
                    }
                    $sql1 = "SELECT date,Round(ATM_vol,1),Time,days_of_expire,ROUND(delta,2),ATM,ATM_price,spot from `$table_name` WHERE date = '$last_date1' and ATM_vol > 0 and ABS(delta - 0) > 0.0001 and delta < 1 order by date,Time ASC ";
                        $result1=mysqli_query($con,$sql1);
                        $n1=mysqli_num_rows($result1);
                        $j=0;
                            if($n1>0)
                              {
                                while($row1=mysqli_fetch_row($result1))
                                {
                                if($row1 != null)
                                    {
                                        if($row1[1] > 10 && $row1[1] != "50.0")
                                        {
                                            for($i=0;$i<8;$i++)
                                            {
                                                $array2[] = $row1[$i];
                                                $n = $n1;
                                                if($i==1)
                                                {
                                                    $vol[] = Round($row1[$i],1);
                                                }
                                            }
                                        }
                                    }
                                }
                                $max_vol = max($vol);
                                $min_vol = min($vol);
                                
                              $array_all[] = array("data" => $array2,"b" => $n,"max"=>$max_vol,"min"=>$min_vol,"name"=>$c_name2[$k]);  
                            } 
                            else{
                            $array_all[] = array("data" => $array2,"b" => $n,"max"=>$max_vol,"min"=>$min_vol,"name"=>$c_name2[$k]);  
                            }
                }
    }
}
echo json_encode($array_all);
?>
         