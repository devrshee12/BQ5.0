<!doctype html>
<?php
include("header.php");
include("./db_connect.php");
error_reporting(0);
//echo $_SESSION['user_id'];
if(isset($_SESSION['user_id']))
         {
    $con_future = mysqli_connect("localhost", "root", "", "bliss_future");
     $con_bliss=mysqli_connect("127.0.0.1","root","","bliss");
//error_reporting(0);
?>
 <html>
  <head>
    <title> BlissQuants - Delta Hedging | Fund Management </title>
    
    <script src="js/jquery-ui.js"></script>    
      <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">
               
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
                   <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
      <script type="text/javascript" src="amstockchart/amcharts/amcharts.js"></script>
    <script type="text/javascript" src="amstockchart/amcharts/serial.js"></script>    
     <script type="text/javascript" src="amstockchart/amcharts/light.js"></script>    
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">    
    <script src="js/dateformat.js"></script>
   
   
    

     <style>
         span:hover{
             background-color: blue;
         }
            #chartdiv_vol,#chartdiv_vol1,#chartdiv_vol2{/*,#chartdiv_vol3,#chartdiv_vol4,#chartdiv_vol5,#chartdiv_vol6,#chartdiv_vol7,#chartdiv_vol8*/
	width		: 30%;
       position        :fixed;
      
	height		: 27%;
      border          : 0px solid;
        border-color    : white;
       
	font-size	: 11px;
        background-color: transparent;  
      
       
        }
        #chartdiv_vol3,#chartdiv_vol4,#chartdiv_vol5 {/*,#chartdiv_vol3,#chartdiv_vol4,#chartdiv_vol5,#chartdiv_vol6,#chartdiv_vol7,#chartdiv_vol8*/
	width		: 30%;
       position        :fixed;
      top:33%;
	height		: 27%;
      border          : 0px solid;
        border-color    : white;
       
	font-size	: 11px;
        background-color: transparent;  
      
       
        }
         #chartdiv_vol6,#chartdiv_vol7,#chartdiv_vol8{/*,#chartdiv_vol3,#chartdiv_vol4,#chartdiv_vol5,#chartdiv_vol6,#chartdiv_vol7,#chartdiv_vol8*/
	width		: 30%;
       position        :fixed;
      top:66%;
	height		: 27%;
      border          : 0px solid;
        border-color    : white;
       
	font-size	: 11px;
        background-color: transparent;  
      
       
        }
       .table{
             text-align: left;
         }
          .table-bordered{
             border:1px solid transparent;
         }
         .table-bordered > thead > tr > th{
    border:1px solid black;
}
table.table-bordered > tbody > tr > td{
    border:1px solid black;
}
.table-striped>thead>tr:first-child>td, 
.table-striped>thead>tr:first-child>th {
   background-color: rgb(132,194,37);
   font-size: 14px;
  
   text-align: center;
   padding: 2px;
   white-space:nowrap;/*width according to table content*/
 }
   /*css resolution setting*/
        @media (min-width: 800px) and (max-width: 1100px) 
        {                
             .nav-pills > li > a{     
                width: 100%;
                background-color:  #474545;
                margin-bottom: 3px;
              color: white!important;
                font-size: 10px;
                text-align: left;    
                -webkit-transition: all .5s ease-in-out;
                -moz-transition: all .5s ease-in-out;     
                }
                 .navbar-nav > li
                 {        
                    background-color: #474545;
                    font-family: bold;
                    margin-left: 0.25%;
                    font-size: 12px;
                 }
                .footer1
                {    
                    position: relative;
                    padding-top: 200px;
                }         
            }
 @media  (min-width: 320px) and (max-width: 800px) { 
              
             .nav-pills > li > a{     
                width: 100%;
                background-color:  #474545;
                margin-bottom: 3px;
              color: white!important;
                font-size: 10px;
                text-align: left;    
                -webkit-transition: all .5s ease-in-out;
                -moz-transition: all .5s ease-in-out;     
                }
                .navbar-nav > li{        
                    background-color: #474545;
                   font-family: bold; 
                    margin-left: 0.25%;
                    font-size: 12px;
                }
      .footer1{    
            position: relative;
            padding-top: 200px;     
      }      
}   
   
     </style>  
  </head>
    <body>   <!-- by default load 1 day data );-->  
        <div class='row wrap'>
            
            <div class='col-lg-8 col-lg-offset-2'>
      
        <table class="table table-striped">
            <thead>
                
           
            <tr>
                <td>
                    Long Gamma Scrip
                </td>
                 <td>
                    Recommended IV
                </td>
                 <td>
                    Current IV
                </td>
                 <td>
                    Entry IV Range
                </td>
                 <td>
                    Target IV Range
                </td>
            </tr>
             </thead>
             <tbody>
                 <?php
                  $sql = "SELECT * FROM `iv`   where  date = (select date from `iv` order by id desc limit 1) and time = (select time from `iv` order by id desc limit 1)  and  (((yesterday_iv - Quarter_Avg_iv ) > -5  and (yesterday_iv - Quarter_Avg_iv ) <= 5  and  yesterday_iv >= 33)) order by sector ASC";    
    
            $result_scrip=mysqli_query($con,$sql);
            $n_scrip=mysqli_num_rows($result_scrip);
                if($n_scrip>0)
                  {//if($movement[0] >= 3 && $movement[1] >= 3 && $movement[2] >= 3 )
                    while($row=mysqli_fetch_row($result_scrip))                                     //inserting all fetch value to array
                    {  // echo "hello";
                        if($row[2] != null)
                        {
                         $movement = explode(" - ", $row[4]);
                            $average_mov = array_sum($movement) / count($movement);
                            if($average_mov  >= 2.5)
                            {//echo $row[1];
                                $quarter_maxmin = explode(" - ", $row[7]);
                                if(($row[5] - $quarter_maxmin[0]) < ($quarter_maxmin[2] - $row[5]))
                              {
                                if($movement[0] >= 2.5 && $movement[1] >= 2.5 && $movement[2] >= 2.5 )
                                {
                                $row[14] = date('d M Y',strtotime($row[14]));;
                             
                               if (strpos($row[2], "NIFTY") !== FALSE) { 
                                       
                               }      
                              else{$quarter_maxmin = explode(" - ", $row[7]); 
                                     echo "<tr>
                     <td>
                          ".$row[1]." (".$row[2].")
                     </td>
                       <td>
                        
                     </td>
                     <td>
                         $row[5]
                     </td>
                       <td>
                          $row[6]
                     </td>
                        <td>
                         $quarter_maxmin[2]
                     </td>
                 </tr>";
                              }
                            }
                         }
                     }
                       
                        }
                    }
                  } 
                  
                 ?>
                 
                
                 
             </tbody>
        </table>
                <br>
               
              <table class="table table-striped">
           <thead>
                
           
            <tr>
                <td>
                    Short Gamma Scrip
                </td>
                 <td>
                    Recommended IV
                </td>
                 <td>
                    Current IV
                </td>
                 <td>
                    Entry IV Range
                </td>
                 <td>
                    Target IV Range
                </td>
            </tr>
            
             </thead>
                    <tbody>
                        <?php
            
     $sql = "SELECT * FROM `iv`   where  date = (select date from `iv` order by id desc limit 1) and time = (select time from `iv` order by id desc limit 1) and  (Quarter_Avg_iv - yesterday_iv) <= 2 and  (Quarter_Avg_iv - yesterday_iv) > 0  order by sector ASC";    
     
            //CRT VOL < q AVG vOL BY MAX 2% And average of movement ( three months avg ) should < = 2 AND (current vol - quarter lower vo) > (q high vol - c vol) 

            $result_scrip=mysqli_query($con,$sql);
            $n_scrip=mysqli_num_rows($result_scrip);
                if($n_scrip>0)
                  {
                    while($row=mysqli_fetch_row($result_scrip))                                     //inserting all fetch value to array
                    {  // echo "hello";
                        if($row[2] != null)
                        {//echo serialize($row);
                            $movement = explode(" - ", $row[4]);
                            $average_mov = array_sum($movement) / count($movement);
                            if($average_mov  <= 2.5)
                            {
                                $quarter_maxmin = explode(" - ", $row[7]);
                               if(($row[5] - $quarter_maxmin[0]) >= 4)//($quarter_maxmin[1] - $row[5])
                               {
                                $row[14] = date('d M Y', strtotime($row[14]));;
                             
                               if (strpos($row[2], "NIFTY") !== FALSE) { 
                                     $row[2] = str_replace('(NIFTY 50)', '',$row[2]);
                                     $quarter_maxmin = explode(" - ", $row[7]); 
                                     echo "<tr>
                     <td>
                          ".$row[1]." (".$row[2].")
                     </td>
                       <td>
                          
                     </td>
                     <td>
                         $row[5]
                     </td>
                       <td>
                         $row[6]
                     </td>
                        <td>
                         $quarter_maxmin[0]
                     </td>
                 </tr>";
                                     
                  }}}}}}                   
           ?>
                 
                 
             </tbody>
        </table>
                 <table class="table table-striped">
           <thead>
                
           
           
                   
                        <?php
                        echo"<tr>
                                                 <td>Caller Scrip</td>"
                                                     ."<td>Delta Neutral @</td>"
                                                        ."<td>Fix Loss</td>"
                                                         ."<td>Fix Profit</td>"
                                                         ."<td>Risk/Reward</td>"
                ."<td>Movement(10 day)</td>"
                ."</tr> <tbody>";
               include('./db_connect_vol_all.php');         
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
               //  echo $last_time;
                  }
              }
               
            }
           $time_str = strtotime($last_time);
$time_str = $time_str - (30 * 60);
$before_time =  date("H:i:s", $time_str);;

             echo " <div class='col-lg-9 col-md-9 col-sm-9' >
                  <span  class='small_font pull-right'  style='color:white'> Last Update Time : ".$last_date1."   ".$last_time_12h."</span>
   
     ";
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
        if (isset($_GET['selection'])) {
    $a = $_GET['selection'];
    $selection = $a;
//            if($search == 'nifty' || $search == 'NIFTY')
//            {
//                $search='^nsei';
//            }
} else {
    $selection = "disable";
}
$yesterday = date('y-m-d');
        $week_before = date('y-m-d', strtotime('-10 days', strtotime($yesterday)));
       $m = 0;
        for ($i = 0 ; $i < $n; $i++)                                               //calculate last inserted value is maximum of particular or not
        {  // $sel_db =  mysql_select_db("",$con);
            
            $table_name = strtolower("vol_".$array2[$i]);
        //    echo $table_name." ".$before_time.' '.$last_time."<br>";
                            //   $sql3 = "SELECT entry_number FROM `$table_name` WHERE Time = (SELECT Time FROM `$table_name` ORDER BY entry_number DESC LIMIT 1 )  order by abs(spot - ATM) limit 1";
                          $sql3 = "select ctable.s,ctable.a,ctable.p,ctable.v,ctable.o,ctable.d, ptable.a,ptable.p,ptable.v,ptable.o,ptable.d,ctable.g,ptable.g,ctable.de,ctable.veg from "
                                  . "(select spot as s,ATM as a ,ATM_price as p,ATM_vol as v,Options as o,delta as d,gamma as g,days_of_expire as de,vega as veg from `$table_name` "
                                  . "where date = '$last_date1' and time between '$before_time' and '$last_time' and options='CE' and delta between '0.15' and '0.23' order by delta desc limit 1) as ctable,"
                                  . "(select ATM as a ,ATM_price as p,ATM_vol as v,Options as o,delta as d,gamma as g from `$table_name` "
                                  . "where date = '$last_date1' and time between '$before_time' and '$last_time' and options='PE' "
                                  . "and delta between '0.2' and '0.51' order by delta desc limit 1) as ptable ";

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
                                            { $date = date_create($last_date1);
                                            //echo $row[13];
                                                $expiry_day = date_format(date_add($date, date_interval_create_from_date_string($row[13].' days')), 'Y-m-d');;
                                           //echo serialize($expiry_day)." ".$last_date1;
                                              $sql_earning = "SELECT * FROM `earning2` WHERE name = '$array2[$i]' and date >= '$yesterday' and date < '$expiry_day' ";                                     //FETCHING ALL company namre from db
        
                                                $result_earning=mysqli_query($con_bliss,$sql_earning);
                                                if($result_earning)
                                                {
                                                    $row_of_result =  mysqli_num_rows($result_earning);
                                                }
                                             if( $row_of_result == 0 )//&& $max_time < $min_time && $max_time2 < $min_time2'
                                             {          
                                            $spot =  $collar_all_script[$k][0] = $row[0];
                                         $call_strike =    $collar_all_script[$k][1] = $row[1];
                                          $call_price =       $collar_all_script[$k][2] = $row[2];
                                         $collar_all_script[$k][3] = $row[3];
                                             $collar_all_script[$k][4] = $row[4];
                                          $delta =    $collar_all_script[$k][5] = $row[5];
                                          $put_strike =   $collar_all_script[$k][6] = $row[6];
                                         $put_price =    $collar_all_script[$k][7] = $row[7];
                                             $collar_all_script[$k][8] = $row[8];
                                             $collar_all_script[$k][9] = $row[9];
                                             $collar_all_script[$k][10] = Round($row[10],2);
                                             $collar_all_script[$k][11] = $table_name;
                                          $lot =   $collar_all_script[$k][12] = $lot_size[$i];
                                       $gamma =  $collar_all_script[$k][13] = $row[11];
                                         $collar_all_script[$k][14] = $row[12];
                                          $collar_all_script[$k][15] = $row[13];
                                       $vega =   $collar_all_script[$k][16] = $row[14]; //vega
                                          
                                          
                                          
                                          $qty = 3 ;
                                         $scrip_name = str_replace("vol_","",$collar_all_script[$k][11]);
                                             if($delta > 0.39 )
                                             {$qty = 2;}
                                             $fix_loss = (($call_price  * $qty)  - (($spot - $put_strike)) - ($put_price)) *  $lot;
                                             $fix_profit = (($call_strike - $spot)  - ($put_price ) + ($call_price  * $qty)) * $lot;
                                             if($fix_loss == 0)
                                             {
                                                 $fix_loss = 1;
                                             }
                                             $profit_ratio =  ABS(Round($fix_profit/$fix_loss));
                                          $margins=Round(($spot * $lot * $qty * 16) / (100 * 1000));//16 % margin of script
                                             /*if($fix_loss<0)
                                                {
                                                    $rr = "1:".Round($profit_ratio);
                                                }
                                                else {
                                                    $rr = "No Risk:".Round($fix_profit);
                                                }*/
                                                if($fix_loss<0)
                                                {$profit_ratio =  ABS(Round($fix_profit/$fix_loss));
                                                    $rr = "1:".Round($profit_ratio);
                                                    $profit_sort = $profit_ratio;
                                                }
                                                else {$profit_ratio =  ABS(Round($fix_profit/100));
                                                    $rr = "0:".Round($profit_ratio);
                                                     $profit_sort = $profit_ratio;
                                                }
                                                $margin_profit_rr = "yes";
                                                $one_vega = round($vega * $lot * $qty);
                                                $one_gamma = round($gamma * $lot * $qty);
                                                
                                                $one_gamma2 = round($spot * 0.01 * $one_gamma);
                                                 $delta_val = $delta *  ( $lot * $qty);
                                                $delta_neutral = $lot - $delta_val;
                                                if($one_gamma != 0);
                                                $delta_clear = Round(($delta_neutral / $one_gamma) + $collar_all_script[$k][0],1);
                                              $delta_neu_diff = Round(($delta_clear - $collar_all_script[$k][0])*100/$collar_all_script[$k][0],1);
                                                //echo $margins."  ".$fix_profit."";
                                                if($margins>200 && $fix_profit<  10000)
                                                {
                                                    $margin_profit_rr = "no";
                                                }
                                               // echo $selection;
                                              if($selection == 'enable')
                                              {
                                               $get_hl = get_high_low($scrip_name);
                                              }
                                              else{
                                                  $get_hl = 0;
                                              }
                                            //   echo $scrip_name;
                                               if ($profit_ratio > 3 && $fix_profit > 0 && $margin_profit_rr == "yes" && $fix_loss > -6000 && $fix_profit > 25000)
                                                {
                                                  
                                                    $sql_current = "SELECT ((high-low)*100/low) FROM `$array2[$i]` WHERE date between '$week_before' and '$yesterday'";
                                                    $result_current = mysqli_query($con_future, $sql_current);
                                                    while ($row_mov = mysqli_fetch_row($result_current)) {
                                                      // echo $row_mov[0];
                                                      $movement_collar = Round($row_mov[0],1);
                                                    }
                                                     $call_collar_arr[$m][0] =  "". strtoupper($scrip_name) ."<bR>   " . $call_strike. "&nbsp;   CE    &nbsp;". "<span style='color:red'>-" .$qty * $lot ." </span> &nbsp;@ " . Round($call_price,1) ."&nbsp; <BR>". $put_strike. "&nbsp;  PE  &nbsp;   "."<span style='color:Yellow'>  +" .$lot. " </span> &nbsp;@ ". Round($put_price,1) ." <br>FO  &nbsp; <span style='color:Yellow'> +".$lot."</span>&nbsp;@  " .Round($collar_all_script[$k][0],1)."";
                                                    
                                                     $call_collar_arr[$m][1] =  Round($delta_clear,1)." (" .$delta_neu_diff." % )";
                                                     $call_collar_arr[$m][2] =  Round($fix_loss);
                                                     $call_collar_arr[$m][3] = Round($fix_profit);
                                                     $call_collar_arr[$m][4] =  $rr;
                                                     $call_collar_arr[$m][5] =  Round($margins/100,1);
                                                     $call_collar_arr[$m][6] =  $get_hl[0][0].":<br>".$get_hl[0][1] ."<br>diff : ".$get_hl[0][2] ;
                                                     $call_collar_arr[$m][7] =  $get_hl[1][0].":<br>".$get_hl[1][1] ."<br>diff : ".$get_hl[1][2]  ;
                                                     $call_collar_arr[$m][8] =  $get_hl[2][0].":<br>".$get_hl[2][1]  ."<br>diff : ".$get_hl[2][2] ;
                                                      $call_collar_arr[$m][9] = $get_hl[3][0].":<br>".$get_hl[3][1]  ."<br>diff : ".$get_hl[3][2] ;
                                                       $call_collar_arr[$m][10] = $get_hl[4][0].":<br>".$get_hl[4][1] ."<br>diff : ".$get_hl[4][2]  ;
                                                      $call_collar_arr[$m][11] =  $movement_collar;
                                             
                                                      $m++;
                                          
                                                     
                                                }    
                                                    
                                           
                                             $k++;
                                             
                                            }     
                                            }

                                        }

                                      }
                   
                            }
                                                       
        }
       //  $call_collar_arr = subval_sort($call_collar_arr,11); 
        array_multisort( array_column($call_collar_arr, 11),      SORT_ASC,
              /*  array_column($call_collar_arr, 3), SORT_DESC,*/
               
                $call_collar_arr);
        for($i=0;$i<sizeof($call_collar_arr);$i++)
        {
            echo "<tr>
                <td>".$call_collar_arr[$i][0]." </td>"

              ."<td>~". $call_collar_arr[$i][1] ."</td>"
             ."<td>". $call_collar_arr[$i][2] ."</td>"
             ."<td>". $call_collar_arr[$i][3] ."</td>"
             ."<td>". $call_collar_arr[$i][4] ."</td>"
                ."<td>". $call_collar_arr[$i][11] ."</td>"
           /*  ."<td>". $one_gamma ."</td>"
             ."<td>". $one_vega ."</td>"
              ."<td>". $one_gamma2 ."</td>"*/
              

          ."</tr>";
        }

 
      }
  
     

                        ?>
                
                 <tr>
                      <td>
                         
                     </td>
                     <td>
                         
                     </td>
                       <td>
                         
                     </td>
                       <td>
                         
                     </td>
                 </tr>
             </tbody>
        </table>
                <?php
        

$sql6 = "SELECT ATM,ATM_price,options,date,time FROM `vol_nifty` WHERE  date = (SELECT date
FROM `vol_nifty` ORDER BY entry_number DESC  LIMIT 0, 1) and Time = (SELECT Time
FROM `vol_nifty` ORDER BY entry_number DESC  LIMIT 0, 1) and delta between 0.25 and 0.80 and options = 'CE'";                  //select db

  $result6 = mysqli_query($con,$sql6);  
            $n6=mysqli_num_rows($result6);     
            
            if($n6>0)
            {$i = 0;
            
              while($row=mysqli_fetch_row($result6))
              {
                  if($row != null)
                  {  
                     $data_arr[$i][0] =  $row[0];       /*strike*/
                     $data_arr[$i][1] =  $row[1];  /*premium*/
                     $data_arr[$i][2] =  $row[2];  /*options*/
                     $i++; 
                       $last_date1 = $row[3];   
                         $last_time = $row[4];
   $last_time_12h = date("g:i a", strtotime("$last_time"));
                  }
              }
              // echo serialize($data_arr); 
            }
            /*TAKING  all strike,premium and options in $data_arr*/
   $k = 0;   
   $strike_diff = array(50,100,150,200,250,300); /*strike difference that we have to check in butterfly*/
   $lot_size1 = 75;
   $lot_size2 = 150;
   $size_data = sizeof($data_arr);
for($q=0;$q<sizeof($strike_diff);$q++)/* check for every strike diff*/
{
for($j=0;$j<$size_data;$j++)/*check for every strike*/
{  $key1 = $key2 = 0;
$val = $data_arr[$j][0]; //strike
    $val1 = $val + $strike_diff[$q]; /*second strike*/
    $val1= $val1."";
    $val2 = $val1 + $strike_diff[$q];/*third strike*/
    $val2 = $val2."";
   
        if($val2 < $data_arr[$size_data - 1])
        {
            $key1 = recursive_array_search($val1, $data_arr); /*give index value of second strike*/
            $key2 = recursive_array_search($val2, $data_arr); /*give index value of third strike*/
            
           if($key1 != 0 && $key2 != 0)
            {
                //echo $key2."fs";
                $arr_index[$k][0] = $j; /* first strike */
                $arr_index[$k][1] = $key1; /* second strike */
                $arr_index[$k][2] = $key2; /* third strike */
                $k++;
            }
        }
            
}
}


//echo serialize($arr_index);

for($i=0;$i<sizeof($arr_index);$i++)
{/*get index value for butterfly pair*/
    $b1 = $arr_index[$i][0]; 
    $b2 = $arr_index[$i][1];
    $b3 = $arr_index[$i][2];
    /**/
    $profit[$i] = (2 * $data_arr[$b2][1]) - ($data_arr[$b1][1] + $data_arr[$b3][1]); /*get fix loss by 2Short - (Long + Long)*/
    $profit[$i] = round($profit[$i]);
    //echo $i;
}
//echo serialize($profit);
 arsort($profit); /*short by minimum loss*/
 
    $h = 0;
   /*get index value as arrange by sorting*/
    foreach($profit as $key=>$value) {
        /*get index of butterfly pair in variables*/
      $f1 =  $arr_index[$key][0];
      $f2 =  $arr_index[$key][1];
      $f3 =  $arr_index[$key][2];
     // echo $data_arr[$f1][0]." ".$data_arr[$f2][0]." ".$data_arr[$f3][0]."<br>";
      /*get diff between first 2 strike for ahead calculation*/
      $diff = $data_arr[$f2][0] - $data_arr[$f1][0];
      /*get max profit by (diff - first strike)*$lot_size1 + (150 * second strike premimum) - ($lot_size1* third strike premium) */
      $max_gain =round((($diff - $data_arr[$f1][1]) *$lot_size1 ) + ($lot_size2 * $data_arr[$f2][1]) - ($data_arr[$f3][1] * $lot_size1));
     // echo $data_arr[$f1][1]." ".$data_arr[$f2][1]." ".$data_arr[$f3][1]." ".($profit[$key]*$lot_size1)." ".$max_gain."<br><br>";
   $butterfly[$h][0]= $data_arr[$f1][0]."&nbsp;   CE    &nbsp;". "<span style='color:yellow'>+ 75  </span> &nbsp;@ ".$data_arr[$f1][1];/*first strike and its premium*/
    $butterfly[$h][1]= $data_arr[$f2][0]."&nbsp;   CE    &nbsp;". "<span style='color:red'>- 150  </span> &nbsp;@ ".$data_arr[$f2][1];/*second strike and its premium*/
     $butterfly[$h][2]= $data_arr[$f3][0]."&nbsp;   CE    &nbsp;". "<span style='color:yellow'>+ 75  </span> &nbsp;@ ".$data_arr[$f3][1];/*third strike and its premium*/
   $butterfly[$h][3]= $profit[$key]*$lot_size1;/*profit * lot size*/
   $butterfly[$h][4]= $max_gain;
   $butterfly[$h][5]= $data_arr[$f3][0]." - ".$data_arr[$f1][0]; /*strike range*/
   $butterfly[$h][5]= $butterfly[$h][5]."(".($data_arr[$f3][0] - $data_arr[$f1][0]).")";/*strike range and its difference)*/
   
   if($butterfly[$h][3] >= 0)
   {
      
      $butterfly[$h][6]= "0:".$max_gain; 
       $profit_sort = ABS($max_gain / $butterfly[$h][3]);
   }
       else
       {     if(round(ABS($max_gain / $butterfly[$h][3]))>6)
            {
            $butterfly[$h][6]= "1:".round(ABS($max_gain / $butterfly[$h][3]));
            $profit_sort = ABS($max_gain / $butterfly[$h][3]);
            }
       }
            $butterfly[$h][7]= $data_arr[$f3][2];
              $butterfly_bn[$h][8]=  $profit_sort;
            $h++;
      }
     unset($data_arr); 
       unset($arr_index);
         unset($profit);
    $sql6 = "SELECT ATM,ATM_price,options FROM `vol_nifty` WHERE  date = (SELECT date
FROM `vol_nifty` ORDER BY entry_number DESC  LIMIT 0, 1) and Time = (SELECT Time
FROM `vol_nifty` ORDER BY entry_number DESC  LIMIT 0, 1) and delta between 0.25 and 0.75 and options = 'PE'";                  //select db

  $result6 = mysqli_query($con,$sql6);  
            $n6=mysqli_num_rows($result6);     
           
            if($n6>0)
            {$i = 0;
              while($row=mysqli_fetch_row($result6))
              {
                  if($row != null)
                  {  //echo "fds";
                     $data_arr[$i][0] =  $row[0];                //take last date of updation assuming that vol_acc table is updating properly
                     $data_arr[$i][1] =  $row[1];  
                     $data_arr[$i][2] =  $row[2];  
                     $i++;          
                  }
               }
             //  echo serialize($data_arr); 
            }
   $k = 0;   
   $strike_diff = array(50,100,150,200,250,300);
   $size_data = sizeof($data_arr);
for($q=0;$q<sizeof($strike_diff);$q++)
{
for($j=0;$j<$size_data;$j++)
{  $key1 = $key2 = 0;
$val = $data_arr[$j][0];
    $val1 = $val + $strike_diff[$q];
    $val1= $val1."";
    $val2 = $val1 + $strike_diff[$q];
    $val2 = $val2."";
   
        if($val2 < $data_arr[$size_data - 1])
        {
            $key1 = recursive_array_search($val1, $data_arr);
            $key2 = recursive_array_search($val2, $data_arr);
            
           if($key1 != 0 && $key2 != 0)
            {
                //echo $key2."fs";
                $arr_index[$k][0] = $j;
                $arr_index[$k][1] = $key1;
                $arr_index[$k][2] = $key2   ;
                $k++;
            }
        }
            
}
}  
    for($i=0;$i<sizeof($arr_index);$i++)
{
    $b1 = $arr_index[$i][0];
    $b2 = $arr_index[$i][1];
    $b3 = $arr_index[$i][2];
    $profit[$i] = (2 * $data_arr[$b2][1]) - ($data_arr[$b1][1] + $data_arr[$b3][1]);
    $profit[$i] = round($profit[$i]);
    //echo $i;
}
//echo serialize($profit);
 arsort($profit);
    $final =  array_keys($profit, max($profit));
  //  echo serialize($profit);
   // echo $final[0];
   
   
    foreach($profit as $key=>$value) {
        
      $f1 =  $arr_index[$key][0];
      $f2 =  $arr_index[$key][1];
      $f3 =  $arr_index[$key][2];
     // echo $data_arr[$f1][0]." ".$data_arr[$f2][0]." ".$data_arr[$f3][0]."<br>";
      $diff = $data_arr[$f2][0] - $data_arr[$f1][0];
      $max_gain = round((($diff - $data_arr[$f1][1]) * $lot_size1 ) + ($lot_size2 * $data_arr[$f2][1]) - ($data_arr[$f3][1] * $lot_size1));
     // echo $data_arr[$f1][1]." ".$data_arr[$f2][1]." ".$data_arr[$f3][1]." ".($profit[$key]*$lot_size1)." ".$max_gain."<br><br>";
   $butterfly[$h][0]= $data_arr[$f1][0]."&nbsp;   PE    &nbsp;". "<span style='color:yellow'>+ 75  </span> &nbsp;@ ".$data_arr[$f1][1];
    $butterfly[$h][1]= $data_arr[$f2][0]."&nbsp;   PE    &nbsp;". "<span style='color:red'>- 150  </span> &nbsp;@ ".$data_arr[$f2][1];
     $butterfly[$h][2]= $data_arr[$f3][0]."&nbsp;   PE    &nbsp;". "<span style='color:yellow'>+ 75  </span> &nbsp;@ ".$data_arr[$f3][1];
   $butterfly[$h][3]= $profit[$key]*$lot_size1;
   $butterfly[$h][4]= $max_gain;
   $butterfly[$h][5]= $data_arr[$f3][0]." - ".$data_arr[$f1][0];
   $butterfly[$h][5]= $butterfly[$h][5]."(".($data_arr[$f3][0] - $data_arr[$f1][0]).")";
   if($butterfly[$h][3] != 0) {
        if($butterfly[$h][3] > 0)
        {
           $butterfly[$h][6]= "0:".$max_gain; 
            $profit_sort = ABS($max_gain / $butterfly[$h][3]);
        }
       else
       {    
           if(round(ABS($max_gain / $butterfly[$h][3]))>6)
                {    
            $butterfly[$h][6]= "1:".round(ABS($max_gain / $butterfly[$h][3]));
            $profit_sort = ABS($max_gain / $butterfly[$h][3]);
            }
           
       }
       $butterfly[$h][7]= $data_arr[$f3][2];
       $butterfly_bn[$h][8]=  $profit_sort;
   $h++;
   }
      }
     // echo serialize($butterfly);
    //  array_multisort(/* array_column($butterfly_bn, 6),      SORT_ASC,*/
      //          array_column($butterfly, 8), SORT_DESC,
               
        //        $butterfly);
      unset($data_arr); 
       unset($arr_index); 
        unset($profit);
      // include("banknifty_butterfly.php"); 
        //    echo $key;
            

 $result6 = mysqli_query($con,"SELECT date,time FROM `vol_nifty` order by entry_number DESC limit 1");
            $n6=mysqli_num_rows($result6);
            if($n6>0)
            {
              while($row=mysqli_fetch_row($result6))
              {
                  if($row != null)
                  {  //$last_date1 =  $row[0];                //take last date of updation assuming that vol_acc table is updating properly
                        $datetime = $row[0]." ".$row[1];       //taking last date and time to variable
                        $last_date1 = $row[0];                //take last date of updation assuming that vol_acc table is updating properly
                        $datetime = $row[0] . " " . $row[1];       //taking last date and time to variable
                        $last_time = $row[1];
                        $last_time_12h = date("g:i a", strtotime("$last_time"));
                  }
              }
            }
?>
<table class="table table-striped">
           <thead>
                
           
            <tr>
                <td>
                    Butterfly Scrip
                </td>
                 <td>
                    Recommended Entry days to expiry
                </td>
                 <td>
                    BEP
                </td>
                 <td>
                    Target
                </td>
            </tr>
             </thead>
            <?php
            for($i=0;$i<sizeof($butterfly);$i++)
            {  if(isset($butterfly[$i][6]) && $butterfly[$i][6]!= "")
                 {
               /* echo "<tr>".
                        "<td>".$butterfly[$i][7]."</td>".
                    "<td>".$butterfly[$i][0]."</td>".
                         "<td>".$butterfly[$i][1]."</td>".
                         "<td>".$butterfly[$i][2]."</td>".
                         "<td>".$butterfly[$i][3]."</td>".
                         "<td>".$butterfly[$i][4]."</td>".
                        "<td>".$butterfly[$i][5]."</td>".
                          "<td>".$butterfly[$i][6]."</td>".
                         
                        "</tr>";*/
                // Above code commented and Below code written by Jignesh
                echo "<tr>".
                         
                        "<td>NIFTY :".$butterfly[$i][0]."<br>".$butterfly[$i][1]."<br>".$butterfly[$i][2]."</td>".
                        //  "<td> Bank Nifty <br>".$butterfly_bn[$i][0]."<br>".$butterfly_bn[$i][1]."<br>".$butterfly_bn[$i][2]."</td>".
                        /*  "<td>".$butterfly_bn[$i][1]."</td>".
                        "<td>".$butterfly_bn[$i][2]."</td>".*/
                        "<td>".$butterfly[$i][3]."</td>".//fix loss
                        "<td>".$butterfly[$i][4]."</td>".//max gain
                        "<td>".$butterfly[$i][5]." ".$butterfly[$i][6]."</td>".//range
                     
                          //"<td>".$butterfly_bn[$i][7]."</td>".//option type
                        "</tr>";
                 }
                
            }
            ?>
        </table>
                   
         
       

                 
            </div>
       </div>
         
       <?php
        }
      else
      {
         echo " <div class='panel-heading'> You have no acccess
                
                    </div>";
      }
include("html/footer.html");    
 function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }
    }
    return false;
}
?>
    </body>
</html>