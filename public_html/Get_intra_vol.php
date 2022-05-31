<html>
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
   <script src="js/jquery-ui.js"></script>
    
    <script src="js/script.js"></script>
   
     
    
      <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css"> 
      <body>
            <div class="row">
           
      <div class="col-lg-2 col-md-2 col-sm-2">
           <div class="navbar-header">
                        <button type="button" class="navbar-toggle  btn-lg" data-toggle="collapse" data-target=".bliss-data-menu">
                            <span class="title_all">Data-Menu</span><span class="glyphicon glyphicon-th"></span>
                        </button>
                    </div> 
           <div class="bliss-data-menu">
             <ul class="nav nav-stacked nav-pills">
                       <li><a  href="BlissDelta_Data.php" >Delta DashBoard</a></li>
                    <li><a  href="BlissIVHighLow.php" >Implied Volatality</a></li> 
                       
                        <li><a  href="BlissIVSpread.php" >Spread</a></li>                        
                        
                        <li><a  href="BlissSuddenMovement.php">Stock Movement</a></li>
                        <li><a  href="BlissMarginCalculator.php">Margin Calculator</a></li> 
                        <li><a  href="Bliss_Daily_Data_Display.php">Daily M2M</a></li>
                          <li><a href="Blisslivestrategy.php"  >Strategy Advisor&nbsp;<img src="images/new.GIF" height="20px" width="40px"></a></li>
                              <li><a href="trend_news.php">BlissTrends</a></li>
                      <li><a href="BlissGetButterfly.php" >Live Butterfly</a></li>
                       <li><a href="get_collar.php" class="active">Live Collar&nbsp;<img src="images/new.GIF" height="20px" width="40px"></a></li>
             </ul>  
           </div>
      </div>
      

           
      </body>
</html>
<?php
include("header.php");
   include("db_connect_vol.php");
   

 /*$today = date("Y-m-d");
 
mysqli_set_charset($con,'utf8');*/
  $sql6 = "SELECT date,time FROM `vol_nifty` order by entry_number DESC limit 1" ;                  //select db

  $result6 = mysqli_query($con,$sql6);  
            $n6=mysqli_num_rows($result6);            
            if($n6>0)
            {
              while($row=mysqli_fetch_row($result6))
              {
                  if($row != null)
                  {  
                     $last_date1 =  $row[0];                //take last date of updation assuming that vol_acc table is updating properly
                     $datetime = $row[0]." ".$row[1];       //taking last date and time to variable
                     $last_time=$row[1]; 
                     $last_time_12h = date("g:i a", strtotime("$last_time"));
              //    echo $last_time;
                  }
              }
               
            }
           
$before_time =  newtime($last_time);
             echo " <div class='col-lg-9 col-md-9 col-sm-9' >
                  <div class='title_all text-center '  <span style='padding-right: 30px'> Live Collar </span> <span  class='small_font pull-right'  style='color:white'> Last Update Time : ".$last_date1."   ".$last_time_12h."</span>
   
     </div> ";
            //echo $n6."FGsd".$result6;
   $k = 0;                 

            $sql = "SELECT * FROM `companies` order by c_name ASC";                                     //FETCHING ALL company namre from db
        
        $result=mysqli_query($con,$sql);
        $n=mysqli_num_rows($result);
    
    if($n>0)
      {
        while($row=mysqli_fetch_row($result))                                     //inserting all fetch value to array
        {
            if($row != null)
            {
                $array2[] = $row[1];
                $array3[] = $row[2];
                $lot_size[] = $row[3];
            }
        }
        echo"<div class = 'col-lg-5 col-md-5 col-sm-5'><table class='table table-striped '><thead><tr>
                                                 <td>Scrip</td>"
                                                     
                                                        ."<td>date</td>"
                                                         ."<td>time</td>"
                                                         ."<td>vol</td>"
                ."<td>Margin</td>"
                
                                                   ."</tr></thead><tbody>";
     // $arr_max[][];
      $k = 0;
      $arr_max[0][0]="";
       $arr_max[0][1]="";
        $arr_max[0][2]="";
         $arr_max[0][3]="";
         $arr_min[0][0]="";
       $arr_min[0][1]="";
        $arr_min[0][2]="";
         $arr_min[0][3]="";
        for ($i = 0 ; $i < $n; $i++)                                               //calculate last inserted value is maximum of particular or not
        {  // $sel_db =  mysql_select_db("",$con);
            $table_name = strtolower("vol_".$array2[$i]);
            
                            //   $sql3 = "SELECT entry_number FROM `$table_name` WHERE Time = (SELECT Time FROM `$table_name` ORDER BY entry_number DESC LIMIT 1 )  order by abs(spot - ATM) limit 1";
                          $sql3 = "SELECT t.date ,t.time, t.ATM_vol FROM `$table_name` as t Inner JOIN (select date AS daygroup,time,MAX(ATM_vol) AS max_value from `$table_name` WHERE date >= (CURDATE() - INTERVAL 7 DAY) GROUP BY daygroup) AS p ON t.ATM_vol = p.max_value and t.date = p.daygroup ";

                                      $result3 = mysqli_query($con,$sql3);
                                     if($result3)
                                      {
                                        $n3=mysqli_num_rows($result3);
                                       // echo $n3;

                                        if($n3>0)
                                        {//echo"<table>";
                                          while($row=mysqli_fetch_row($result3))
                                          {
                                              if($row != null)
                                              {  
                                                  if($k == 0)
                                                  {
                                                       $arr_max[$k][0] = $table_name;
                                                         $arr_max[$k][1] = $row[0];
                                                         $arr_max[$k][2] = $row[1];
                                                         $arr_max[$k][3] = $row[2];
                                                         
                                                          echo "<tr>
                                                         <td>".$table_name." </td>"


                                                         ."<td>". $row[0]."</td>"
                                                         ."<td>". $row[1] ."</td>"
                                                         ."<td>". $row[2] ."</td>"
                                                           ."</tr>";
                                                          $k++;
                                                  }
                                                  else
                                                  {
                                                    if(($arr_max[$k - 1][1] !== $row[0]))
                                                    {
                                                         $arr_max[$k][0] = $table_name;
                                                         $arr_max[$k][1] = $row[0];
                                                         $arr_max[$k][2] = $row[1];
                                                         $arr_max[$k][3] = $row[2];
                                                         
                                                          echo "<tr>
                                                         <td>".$table_name." </td>"


                                                         ."<td>". $row[0]."</td>"
                                                         ."<td>". $row[1] ."</td>"
                                                         ."<td>". $row[2] ."</td>"
                                                           ."</tr>";
                                                         $k++;    
                                                    }
                                                  }
                                              }
                                          }
                                        }
                                      }
                                  
                                      
                                                     
                                                }    
                                                    
                                           
                                            
                                             
                                                 
                   
                                  
       
echo"</tbody></table></div>";
echo"<div class = 'col-lg-5 col-md-5 col-sm-5'><table class='table table-striped '><thead><tr>
                                                 <td>Strategy</td>"
                                                     
                                                        ."<td>Fix Loss</td>"
                                                         ."<td>Fix Profit</td>"
                                                         ."<td>Risk/Reward</td>"
                ."<td>Margin</td>"
                
                                                   ."</tr></thead><tbody>";
$k = 0 ;
  for ($i = 0 ; $i < $n; $i++)                                               //calculate last inserted value is maximum of particular or not
        {  // $sel_db =  mysql_select_db("",$con);
            $table_name = strtolower("vol_".$array2[$i]);
            
                            //   $sql3 = "SELECT entry_number FROM `$table_name` WHERE Time = (SELECT Time FROM `$table_name` ORDER BY entry_number DESC LIMIT 1 )  order by abs(spot - ATM) limit 1";
                          $sql3 = "SELECT t.date ,t.time, t.ATM_vol FROM `$table_name` as t Inner JOIN (select date AS daygroup,time,MIN(ATM_vol) AS min_value from `$table_name` WHERE date >= (CURDATE() - INTERVAL 7 DAY) GROUP BY daygroup) AS p ON t.ATM_vol = p.min_value and t.date = p.daygroup";

                                      $result3 = mysqli_query($con,$sql3);
                                     if($result3)
                                      {
                                      $n3=mysqli_num_rows($result3);
                                     // echo $n3;
                                      
                                      if($n3>0)
                                      {//echo"<table>";
                                        while($row=mysqli_fetch_row($result3))
                                        {
                                            if($row != null)
                                            {  
                                              /*echo "<tr>
                                                     <td>".$table_name." </td>"
                                                      
                                                     
                                                     ."<td>". $row[0]."</td>"
                                                     ."<td>". $row[1] ."</td>"
                                                     ."<td>". $row[2] ."</td>"
                                                     ."</tr>";*/
                                                if($k == 0)
                                                  {
                                                       $arr_max[$k][0] = $table_name;
                                                         $arr_max[$k][1] = $row[0];
                                                         $arr_max[$k][2] = $row[1];
                                                         $arr_max[$k][3] = $row[2];
                                                         
                                                          echo "<tr>
                                                         <td>".$table_name." </td>"


                                                         ."<td>". $row[0]."</td>"
                                                         ."<td>". $row[1] ."</td>"
                                                         ."<td>". $row[2] ."</td>"
                                                           ."</tr>";
                                                          $k++;
                                                  }
                                                  else
                                                  {
                                                        if($arr_min[$k - 1][1] !== $row[0])
                                                         {
                                                                   $arr_min[$k][0] = $table_name;
                                                                 $arr_min[$k][1] = $row[0];
                                                                 $arr_min[$k][2] = $row[1];
                                                                 $arr_min[$k][3] = $row[2];
                                                                 echo "<tr>
                                                               <td>".$table_name." </td>"


                                                               ."<td>". $row[0]."</td>"
                                                               ."<td>". $row[1] ."</td>"
                                                               ."<td>". $row[2] ."</td>"
                                                               ."</tr>";
                                                                 $k++;
                                                         }
                                                  }
                                            }
                                        }
                                      }
                                      }
                                
                                     
                                       
                                                     
                                                }  
                                                echo"</tbody></table></div></div>";
      }
  //echo serialize($collar_all_script);
                          mysqli_close($con);
                         // echo serialize($arr_min);
                        //  echo serialize($arr_max);
         function get_high_low($search){
             $search = strtoupper($search);
             $total_data = 0;
             $array_all = array(array());
             $date1 = date('Y-m-d');
             if($search == 'nifty' || $search == 'NIFTY')
            {
                $search='^NSEI';
                 $c_name = $search;//".NS";
            }
            elseif ($search == 'BANKNIFTY') {
              $search='^NSEBANK';
                 $c_name = $search;//".NS";
        }
 else {
        $c_name = $search.".NS";
 }          
                                            //$date1="2016-0-26";
                                                         
                                                       $date2 = date('Y-m-d', strtotime('-10 day', strtotime($date1))); - 6;
                                                       //echo $date2;
                                                        $pieces2 = explode("-", $date1);
                                                        $pieces1 = explode("-", $date2);
                                                                    $d1 = $pieces1[2];
                                                                    $d2 = $pieces2[2];
                                                                    $y1 = $pieces1[0];
                                                                    $y2 = $pieces2[0];
                                                                    $m1 =  $pieces1[1] - 1;
                                                                    $m2 = $pieces2[1] - 1;
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
                                                                      $date = new DateTime($data[0]);
                                                                    $date_hl = $date->format('d M');
                                                                    
                                                                   $array_all[$total_data][0] = $date_hl;
                                                                     $array_all[$total_data][1] = round( $data[2] , 1)." - ".round( $data[3] , 1);
                                                                      $array_all[$total_data][2] = round( ($data[2] - $data[3]) , 1);
                                                                       $total_data = $total_data + 1;
                                                                      }
                                                                                                $key++;
                                                                                              
                                                                                                //passing value to array
                                                                                            } // end while
                                                                                          //  echo serialize($arrCSV);

                                                                                         //  echo json_encode($arrCSV,JSON_NUMERIC_CHECK);
                                                                $ch;
                                                                $o;
                                                                $h;
                                                                $l;
                                                                $c;
                                                                $p;


                                                                                    // Close the CSV file
                                                                                fclose($handle);
                                                                                } 
                                                                                Return $array_all;
         }         

 function newtime($time,$minute=30){
    $time=strtotime($time);
    $m=date("i",$time)*1;
    $h=date("H",$time)*1;
    if($m<$minute){
        $h=$h-1;
    }
    return date("H:i:s",strtotime($h.":".$minute.":00"));
}
         
?>