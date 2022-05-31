<?php 
require '../db_connect.php';
//$date1 = "2016-08-29";
    $max_vol = 0;
 $min_vol = 0;
 $array2 = array();
 $array = array();
  $n = 0;
  mysqli_select_db($con,"bliss");
//$dat1 =  $_POST["ar_data"];
//$date1 = $dat1["date1"];
$c_name2 = $_POST["name"];


            $table_name = strtolower("all_vol_".$c_name2);
           // echo $table_name;
             $table_name = ltrim(rtrim($table_name));
            $sql = "SELECT * FROM `" . $table_name . "` where date  = (select date from `" . $table_name . "` order by entry_number desc limit 1) and   days_of_expire  = (select days_of_expire from `" . $table_name . "` order by entry_number desc limit 1) and options = 'CE' GROUP BY ATM DESC ";
            $result=mysqli_query($con,$sql);
            $n=mysqli_num_rows($result);
            $j=0;
            
                if($n>0)
                  {
                    while($row=mysqli_fetch_array($result))
                    {
                    if($row != null)
                        {
                            
                                    $array2['strike'][] = $row['ATM'];
                                   $array2['oi_ce'][] = $row['volume'];
                                // $array2['last_time'] = $row['date']." ".$row['Time'];
                                
                        }
                    }
                    
             
                }
				 $sql = "SELECT * FROM `" . $table_name . "` order BY entry_number DESC limit 1";
            $result=mysqli_query($con,$sql);
            $n=mysqli_num_rows($result);
            $j=0;
            
                if($n>0)
                  {
                    while($row=mysqli_fetch_array($result))
                    {
                    if($row != null)
                        {
				 $array2['last_time'] = $row['date']." ".$row['Time'];
						}
					}
				  }
            $sql = "SELECT * FROM `" . $table_name . "` where date  = (select date from `" . $table_name . "` order by entry_number desc limit 1) and  days_of_expire  = (select days_of_expire from `" . $table_name . "` order by entry_number desc limit 1) and options = 'PE' GROUP BY ATM DESC  ";
            $result=mysqli_query($con,$sql);
            $n=mysqli_num_rows($result);
            $j=0;
            
                if($n>0)
                  {
                    while($row=mysqli_fetch_array($result))
                    {
                    if($row != null)
                        {
                            
                                    $array3['strike'][] = $row['ATM'];
                                   $array3['oi_pe'][] = $row['volume'];
                               
                                
                        }
                    }
                    
             
                }
                $array = array_merge($array2, $array3);
              echo json_encode($array);     
        ?>
