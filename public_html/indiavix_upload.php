<?php
$con=mysql_connect("localhost","root",""); 
//$con=mysql_connect("166.62.28.124","blissquants","bliss"); 
    if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
     else 
        {
        $sel_db =  mysql_select_db("bliss",$con);
        }
       
  $v = 0;
$iv_high = $iv_low = $iv_open = $iv_close = $iv_p_close = $nse_p_close = $nse_high = $nse_low = $nse_open = $nse_close = $iv_change = $iv_per_change = $nse_change = $nse_per_change = 0;
 

$today = date('Y-m-d',strtotime("-1 days"));
$timestamp = strtotime($today);
$day = date('D', $timestamp);

if($day == 'Sun')
{
    $today = date('Y-m-d',strtotime("-3 days"));
    $yes = date('Y-m-d',strtotime("-4 days"));
   
}
 else {
     $yes = date('Y-m-d',strtotime("-2 days"));
      echo $day;
}
  
  //echo $yes."<br>".$today;
   $quote = array("GOOG/NSE_INDIAVIX-INDIA-VIX-INDIAVIX","NSE/CNX_NIFTY");
 for($j=0;$j<2;$j++)
        {
       $file = "https://www.quandl.com/api/v3/datasets/$quote[$j]/data.csv?start_date=$yes&end_date=$today"; 

 //open file
$handle = fopen($file, "r");
        //fetch data
       
            while($data = fgetcsv($handle, 4096, ','))
            {
                    $data2[$v][] = $data;
                 
            }
             $v++;  
       //close file
        }
        
        fclose($handle);
        $iv_open = $data2[0][1][1];
        $iv_high = $data2[0][1][2];
        $iv_low = $data2[0][1][3];
        $iv_close = $data2[0][1][4];
        $iv_p_close = $data2[0][2][4];
        $iv_change = $iv_close - $iv_p_close;
        $iv_per_change = ($iv_change/$iv_p_close)*100 ;
        $nse_open = $data2[1][1][1];
        $nse_high = $data2[1][1][2];
        $nse_low = $data2[1][1][3];
        $nse_close = $data2[1][1][4];
        $nse_p_close = $data2[1][2][4];
        $nse_change = $nse_close - $nse_p_close;
        $nse_per_change = ($nse_change / $nse_p_close)*100;
        echo $iv_high." ".$nse_high;
      
        $rs =  mysql_query("INSERT INTO india_vix  VALUES (Default,'$today','$iv_open','$iv_high','$iv_low','$iv_close','$iv_p_close','$iv_change','$iv_per_change','','$nse_open','$nse_high','$nse_low','$nse_close','$nse_p_close','0','0','$nse_change','$nse_per_change') WHERE NOT EXISTS (
    SELECT date FROM india_vix WHERE date = '$today')");
        echo serialize($data2);
        ?>