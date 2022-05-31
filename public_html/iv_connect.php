<?php 
require 'db_connect.php';
//$dat1 = "2014-07-01/2014-07-31";
$dat1 =  filter_input(INPUT_POST, 'date1');
$pieces = explode("/", $dat1);
//echo "<script>alert('dfsfsdf');</script>";
        
         //  mysql_set_charset('utf8');
        // Check connection
    
            $sql = "SELECT date,close,nse_close FROM india_vix WHERE date between '$pieces[0]' and '$pieces[1]' ORDER BY date ASC";
            $result=mysqli_query($con,$sql);
            $n=mysqli_num_rows($result);
            $j=0;
                if($n>0)
                  {
                    while($row=mysqli_fetch_row($result))
                    {
                    if($row != null)
                        {
                        for($i=0;$i<3;$i++)
                            {
                            $array2[] = $row[$i];
                         /*echo $array2[$j].','; */
                         // $j++;
                            }
                        }
                     }
                echo json_encode(array("a" => $array2,"b" => $n));    
             
          } 
            else {
                   echo "No Data";
            }
        ?>