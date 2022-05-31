
<?php
include("../db_connect.php");

$array3 = (array) null;
$n=0;
$n1=0;
 $dat1 =  $_POST["date1"];
 // $dat1 = '2014-05-01';


mysqli_set_charset($con,'utf8');

        // Check connection
        
            
            $sql = "SELECT id,name,d_name,date,time,max_change FROM `earning2`";
            $result=mysqli_query($con,$sql);
           
           // $row=mysql_fetch_array($result);
            $n=mysqli_num_rows($result);
             $sql1 = "SELECT * FROM `economic_data`";
            $result1=mysqli_query($con,$sql1);
             $n1=mysqli_num_rows($result1);
        if($n>0 || $n1>0)
          {
            if($n>0)
            {
            while($row=mysqli_fetch_row($result))
            {
            if($row != null)
                {
                for($i=0;$i<6;$i++)
                    {
                    $array2[] = $row[$i];
                     //   echo $i."  - ".$row[$i];
                    }
                }
            }
          
          }
          if($n1>0)
            {
          while($row=mysqli_fetch_row($result1))
            {
                if($row != null)
                    {
                    for($i=0;$i<7;$i++)
                        {
                        $array3[] = $row[$i];
                         //   echo $i."  - ".$row[$i];
                        }
                    }
                }
               
            }
            echo json_encode(array("a" => $array2,"b" => $n,"c" => $array3,"d" => $n1));
          }
         else 
                 {
                echo "No Data";
                } 
           // echo $dat1."".$date1."".$date2;
         
       
?>