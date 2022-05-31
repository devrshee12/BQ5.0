<?php
//excel reader file for import data from excel
include 'public_html\excel_reader\excel_reader.php';       // include the class
//error_reporting( E_ALL );
//database mysql connection   
$con=mysqli_connect("www.blissquants.com:3306","blissquants","bliss"); 
    if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
     else 
        {
        $sel_db =  mysqli_select_db($con,"bliss");
        }
        
$excel = new PhpExcelReader;   
// creates object instance of the class
 
 //taking file name
$file_path = $_FILES["files"]["name"]; //only .xls is recieved
//declaration
$ex_date;
$n=0;
$market_time = "15:30:00";
$m_date1;
$m_date2;
$d1;
$m1;
$y1;
$d2;
$m2;
$y2;
$flag1;
$c_name;
$c_name1;
$c_name_BO;
$net_sale_q = 0;
$net_profit_q = 0;
$net_sale_y = 0;
$net_profit_y = 0;
//setting maximum execution time 
 ini_set('max_execution_time', 300);
 //taking file from folder
 $file_path2 = "//192.168.119.24/tempBliss_192.168.105.174_spider/result/apr_2016.xls";

 $excel->read($file_path2);
// reads and stores the excel file data

$sd = $excel->sheets[0]['cells'];
//echo serialize($excel->sheets[0]['cells']);

$total_row = $excel->sheets[0]['numRows'];
//taking total no. of rows
echo serialize($sd);
for($i=1;$i<=$total_row;$i++)
{
   
    if(isset($sd[$i][2]))
        {
            if (strpos($sd[$i][2], '-EQ') !== false)
            {
                
               $c_name_BO = str_replace("-EQ","",$sd[$i][2]);
                $c_name = $c_name_BO.".BO" ;
               $c_name1 = $c_name_BO ; //equity code
               
            }
            else
            {
            
                $c_name = $sd[$i][2].".NS"; //taking only first nine letter of equity code because we have to pass first nine letter of code and .NS in API
                $c_name1 = $sd[$i][2]; //equity code
            }
        }
    if(isset($sd[$i][4]))
    {echo $sd[$i][4];
    //if date come in different format
        if (preg_match("@([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})@", $sd[$i][4], $regs)) { 

            $from_unix_time = mktime(0, 0, 0, $regs[2], $regs[1], $regs[3]);
            $day_before = strtotime("yesterday", $from_unix_time);
            $formatted = date('Y-m-d', $day_before);
            echo $formatted."   dasd ";
            } 
        else if (preg_match("@([0-9]{1,2}) ([0-9]{1,2}) ([0-9]{4})@", $sd[$i][4], $regs)) {  
            $from_unix_time = mktime(0, 0, 0, $regs[2], $regs[1], $regs[3]);
            $day_before = strtotime("yesterday", $from_unix_time);
            $formatted = date('Y-m-d', $day_before);
            echo $formatted."dfdfsd";
                } 
     else   { 
        $date3 = strtotime($sd[$i][4]);
     $formatted = date('Y-m-d', $date3);
      echo $formatted;
            //$formatted = "";
         }
            //formatting date because date we get from excel is one day ahead
     }
    else   {
            $formatted = "";
         }
    if(isset($sd[$i][5]))
    {
        $time =  $sd[$i][5]; //taking time
    }
    else {
      $time = "00:00:00";  
    }
if(isset($sd[$i][4]))
  {
    if(isset($sd[$i][7]))
        {
        $net_sale_q = $sd[$i][6];
        $net_profit_q = $sd[$i][7];
        $net_sale_y = $sd[$i][8];
        $net_profit_y = $sd[$i][9];
        }
 else {
     $net_sale_q = "";
        $net_profit_q = "";
        $net_sale_y = "";
        $net_profit_y = "";
 }
    echo serialize($sd[$i])." --->".$formatted;
    
    $name = $sd[$i][3]; // taking original name
    

                    $pieces1 = explode("-", $formatted);
                    $d1 = $d2 = $pieces1[2];
                    $y1 = $y2 = $pieces1[0];
                    $m1 = $m2 = $pieces1[1] - 1;
                    // for checking result came after or before market
                    if(strtotime($time) < strtotime($market_time))
                        {
                        echo "<br>today</br>";
                       // echo "time. <br>";
                        $flag1 = 1; 
                        $m1 = $pieces1[1] - 2;
                            if ($m1<0) // as here month that we are going to pass is one less number so it will give month that we want
                            {
                                $m1 = 11;
                                $y1 = $pieces1[0] - 1;
                            }
                        }
                    else 
                        {
                         echo "<br>tomorrow</br>";
                         $flag1 = 2;
                         $m2 = $pieces1[1];
                            if ($m2>11)
                            {
                                $m2 = 0;
                                $y2 = $pieces1[0] + 1;
                            }
                        }
///now pass equity code and duration for getting O,h,l,c,pre.close
                   if (($handle = fopen("http://ichart.finance.yahoo.com/table.csv?s=$c_name&d=$m2&e=$d2&f=$y2&g=d&a=$m1&b=$d1&c=$y1&ignore=.csv", "r")) !==FALSE) // a,b,c  == start date,month, year, g = d means day,w=week,m==month,y=year, d,e,f = last date,month, year            
                            {
                            // Set the parent array key to 0
                            $key = 0;
                            // While there is data available loop through unlimited times (0) using separator (,)
                            while (($data = fgetcsv($handle, 0, ",")) !==FALSE) {
                                // Count the total keys in each row
                                $c = count($data);
                              //  print  $c . "<BR>"; 
                                //Populate the array
                                If ($key != 0) {
                                    $arrCSV[$key-1][0] = $data[0]; //Time
                                    $arrCSV[$key-1][1] = $data[1];            //Open
                                    $arrCSV[$key-1][2] = $data[2];            //High
                                    $arrCSV[$key-1][3] = $data[3];            //Low
                                    $arrCSV[$key-1][4] = $data[6];            //Adj Close
                                    $arrCSV[$key-1][5] = $data[5];            //Volume
                                    $arrCSV[$key-1][6] = $data[4];             //close
                                }
                                $key++;
                                //passing value to array
                            } // end while
                          
$ch;
$o;
$h;
$l;
$c;
$p;
                    $keymax = $key;
                    if($flag1 == 1) //before market end
                    {
                        
                        if($arrCSV[0][1] ==  $arrCSV[0][2] &&  $arrCSV[0][3] ==  $arrCSV[0][6])
                                {                           
                                    $pieces2 = explode("-", $formatted);
                                    echo serialize($pieces2);
                                    $d1 = $d2 = $pieces2[2];
                                    $y1 = $y2 = $pieces2[0];
                                    $m1 =  $pieces2[1] - 1;
                                    $m2 =  $pieces2[1];
                                   
                                     if ($m2>11)
                                        {
                                            $m2 = 0;
                                            $y2 = $pieces1[0] + 1;
                                        }
                                   $arrCSV2 = array();  
                                        if (($handle = fopen("http://ichart.finance.yahoo.com/table.csv?s=$c_name&d=$m2&e=$d2&f=$y2&g=d&a=$m1&b=$d1&c=$y1&ignore=.csv", "r")) !==FALSE) // a,b,c  == start date,month, year, g = d means day,w=week,m==month,y=year, d,e,f = last date,month, year            
                                        {
                                        // Set the parent array key to 0
                                        $key = 0;
                                        // While there is data available loop through unlimited times (0) using separator (,)
                                        while (($data = fgetcsv($handle, 0, ",")) !==FALSE) {
                                            // Count the total keys in each row
                                            $c = count($data);
                                          //  print  $c . "<BR>"; 
                                            //Populate the array
                                            If ($key != 0) {
                                                $arrCSV2[$key-1][0] = $data[0]; //Time
                                                $arrCSV2[$key-1][1] = $data[1];            //Open
                                                $arrCSV2[$key-1][2] = $data[2];            //High
                                                $arrCSV2[$key-1][3] = $data[3];            //Low
                                                $arrCSV2[$key-1][4] = $data[6];            //Adj Close
                                                $arrCSV2[$key-1][5] = $data[5];            //Volume
                                                $arrCSV2[$key-1][6] = $data[4];             //close
                                            }
                                            $key++;
                                            //passing value to array
                                        } // end while
                                        }        
                            echo json_encode($arrCSV2,JSON_NUMERIC_CHECK);
                                    $ch = ($arrCSV2[$key-3][6] - $arrCSV[1][6])*100/$arrCSV[1][6]; //%change = (close - pre. close) * 100/ pre. close
                                    $ch = round($ch,1);
                                    $o = $arrCSV2[$key-3][1];
                                    $h = $arrCSV2[$key-3][2];
                                    $l = $arrCSV2[$key-3][3];
                                    $c = $arrCSV2[$key-3][6];
                                    $p = $arrCSV[1][6];
                                }
                                else
                                {
                                    $ch = ($arrCSV[0][6] - $arrCSV[1][6])*100/$arrCSV[1][6]; //%change = (close - pre. close) * 100/ pre. close
                                    $ch = round($ch,1);
                                    $o = $arrCSV[0][1];
                                    $h = $arrCSV[0][2];
                                    $l = $arrCSV[0][3];
                                    $c = $arrCSV[0][6];
                                    $p = $arrCSV[1][6];
                                }
                    }
                    else
                    {
                        if( $arrCSV[$key-3][1] ==  $arrCSV[$key-3][2] &&  $arrCSV[$key-3][3] ==  $arrCSV[$key-3][6])
                                {
                                $ch = ($arrCSV[$key-4][6] - $arrCSV[$key-3][6])*100/$arrCSV[$key-3][6];
                                $ch = round($ch,1);
                                $o = $arrCSV[$key-4][1];
                                $h = $arrCSV[$key-4][2];
                                $l = $arrCSV[$key-4][3];
                                $c = $arrCSV[$key-4][6];
                                $p = $arrCSV[$key-3][6];
                                }
                        else
                                { 
                                $ch = ($arrCSV[$key-3][6] - $arrCSV[$key-2][6])*100/$arrCSV[$key-2][6];
                                $ch = round($ch,1);
                                $o = $arrCSV[$key-3][1];
                                $h = $arrCSV[$key-3][2];
                                $l = $arrCSV[$key-3][3];
                                $c = $arrCSV[$key-3][6];
                                $p = $arrCSV[$key-2][6];
                                }
                    }
                    // Close the CSV file
                fclose($handle);
                } // end if
   }
// insert value only if date and time is available
   $movement = (($h-$l)/$l)*100;
   
  
if(isset($sd[$i][4]) && isset($sd[$i][5]))
    {                      
        echo $ch.''.$o.''.$h.''.$l.''.$c.''.$p;
        $result1 = mysql_query("SELECT * FROM earning2 WHERE name = '$c_name1' And date = '$formatted'"); //here date  may also get change till result come
        if( mysql_num_rows($result1) < 1) 
        {
            $rs =  mysql_query("INSERT INTO earning2 VALUES (DEFAULT,'$c_name1','$name','$formatted','$time','$net_sale_q','$net_profit_q','$net_sale_y','$net_profit_y','','$ch','$o','$h','$l','$c','$p','','$movement','','')");
        }
        else
        {
            echo " <br> old <br>";
            $rs =  mysql_query("UPDATE earning2 SET time = '$time',changes = '$ch', open = '$o', high = '$h', low = '$l', close = '$c',p_close = '$p',movement = '$movement' WHERE name='$c_name1' AND date='$formatted'");
          //  $rs =  mysql_query("INSERT INTO earning2 VALUES (DEFAULT,'$c_name1','$name','$formatted','$time','$net_sale_q','$net_profit_q','$net_sale_y','$net_profit_y','','$ch','$o','$h','$l','$c','$p','')");
        }                      
        if($rs)
        {
            echo "succesfull";
        }
        else
        {
          echo " error";
        } 
    }
    elseif (isset($sd[$i][4]))
    {
        echo "new data upload";
         $result1 = mysqli_query($con,"SELECT * FROM earning2 WHERE name = '$c_name1' And time = '00:00:00'");
        if( mysqli_num_rows($result1) < 1) 
        {         //0 is inserted bcoz it not taking blank value   
            $rs =  mysqli_query($con,"INSERT INTO earning2  VALUES (Default,'$c_name1','$name','$formatted','00:00:00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0')");
            echo "inserted";            
        }
        else
        {
           $rs =  mysqli_query($con,"UPDATE earning2 SET d_name = '$name', date = '$formatted' WHERE name = '$c_name1' And time = '00:00:00'");
           echo "updated";
        }            
    }
echo "<br>";
}
   $rs1 =  mysqli_query($con,"UPDATE earning2,
(
SELECT name, Max( Abs( changes ) ) AS maxDateForUser
FROM earning2
GROUP BY name
)t
SET max_change = t.maxDateForUser WHERE earning2.name = t.name");
   
   $rs2 = mysqli_query($con,"UPDATE earning2,
(
SELECT name, Min( Abs( movement ) ) AS minmovForUser
FROM earning2  where movement <> 0
GROUP BY name
)t
SET min_Movement = ROUND(t.minmovForUser,1) WHERE earning2.name = t.name") ;

	$rs3 = mysqli_query($con,"UPDATE earning2,
(
SELECT name, Max( Abs( movement ) ) AS maxmovForUser
FROM earning2  where movement <> 0
GROUP BY name
)t
SET max_Movement = ROUND(t.maxmovForUser,1) WHERE earning2.name = t.name");
    if($rs1 || $rs2 || $rs3 )
        {
         echo "succesfull";
        }
        else
        {
          echo " error";
        } 
		
		
/*function convertTime($dec)
{
    // we're given hours, so let's get those the easy way
    $hr = $dec * 24;
    $hours = floor($hr);
    $mt = $hr - $hours;
    $mt1 = $mt * 60;
    $minutes = floor($mt1);
    $sd = $mt1 - $minutes;
    $seconds = floor($sd * 60);
    
   /* // since we've "calculated" hours, let's remove them from the seconds variable
    $seconds -= $hours * 3600;
    // calculate minutes left
    $minutes = floor($seconds / 60);
    // remove those from seconds as well
    $seconds -= $minutes * 60;
    // return the time formatted HH:MM:SS
    return $hours.":".$minutes.":".$seconds;
}*/

?>