<?php
require '../db_connect.php';
$n=0;
 $name =  $_POST["c_name"];
 // $name = "Castrol India";

mysqli_set_charset($con,'utf8');
        
            
            $sql = "SELECT d_name,date,changes,open,high,low,close,p_close FROM `earning2` WHERE name= '$name' ORDER BY date ASC"; //asc bcoz it will create ohlc properly otherwise it will create problem
            $result=mysqli_query($con,$sql);
           // $row=mysql_fetch_array($result);
            $n=mysqli_num_rows($result);
        if($n>0)
          {
            while($row=  mysqli_fetch_row($result))
            {
            if($row != null)
                {
                for($i=0;$i<8;$i++)
                    {
                    $array2[] = $row[$i];
                     //   echo $i."  - ".$row[$i];
                   
                    }
                     $d_name = $row[0];
                }
            }
           echo json_encode(array("a" => $array2,"b" => $n,"c" => $d_name ));
           // echo "helo";
          }
         else 
            {
           echo "No Data";
           } 
           // echo $dat1."".$date1."".$date2;
          
       
?>
