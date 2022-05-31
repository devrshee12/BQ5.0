<?php
include("header.php");

// include("db_connect_vol_all.php");
$con = mysqli_connect("24localbliss", "root", "", "bliss");
//error_reporting(0);
?>

<html>
    <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>

    <script src="js/script.js"></script>



    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css"> 
    <script>
        $(document).ready(function () {
            $("input[name$='selection']").click(function () {
                selection_value = document.querySelector('input[name="selection"]:checked').value;

                location.href = "get_collar.php? selection=" + selection_value;
                // location.reload();
            });
        });
    </script>
    <body>

        <div class="row">

            <div class="col-lg-2 col-md-2 col-sm-2">

            </div>


            <?php
            $call_collar_arr = array();
            $sql6 = "SELECT date,time FROM `vol_nifty` order by entry_number DESC limit 1";                  //select db

            $result6 = mysqli_query($con, $sql6);
            $n6 = mysqli_num_rows($result6);
            if ($n6 > 0) {
                while ($row = mysqli_fetch_row($result6)) {
                    if ($row != null) {
                        $last_date1 = $row[0];                //take last date of updation assuming that vol_acc table is updating properly
                        $datetime = $row[0] . " " . $row[1];       //taking last date and time to variable
                        $last_time = $row[1];
                        $last_time_12h = date("g:i a", strtotime("$last_time"));
                        //  echo $last_time;
                    }
                }
            }
            $time_str = strtotime($last_time);
            $time_str = $time_str - (30 * 60);
            $before_time = date("H:i:s", $time_str);
            ;

            echo " <div class='col-lg-9 col-md-9 col-sm-9' >
                  <span  class='small_font pull-right'  style='color:white'> Last Update Time : " . $last_date1 . "   " . $last_time_12h . "</span>
   
     ";
            //echo $n6."FGsd".$result6;
            $k = 0;

            $sql = "SELECT * FROM `companies` order by c_name ASC";                                     //FETCHING ALL company namre from db

            $result = mysqli_query($con, $sql);
            $n = mysqli_num_rows($result);

            if ($n > 0) {
                while ($row = mysqli_fetch_row($result)) {                                     //inserting all fetch value to array
                    if ($row != null) {
                        $array2[] = $row[0];
                        $array3[] = $row[1];
                        $lot_size[] = $row[2];
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
                echo"
            <ul class='nav nav-tabs'>
                <li class='active'><a href='get_collar.php'>Stock Collar</a></li>
               
            </ul>
<table class='table table-striped '><thead><tr>
                                                 <td>Strategy</td>"
                . "<td>Delta Neutral @</td>"
                . "<td>Fix Loss</td>"
                . "<td>Fix Profit</td>"
                . "<td>Risk/Reward</td>"
                . "<td>Margin</td>"

                /*   ."<td>vega</td>"
                  ."<td>1%gamma</td>" */
                . ""
                . "</tr></thead><tbody>";
                $m = 0;
                for ($i = 0; $i < $n; $i++) {                                               //calculate last inserted value is maximum of particular or not  // $sel_db =  mysql_select_db("",$con);
                    $table_name = strtolower("all_vol_" . $array2[$i]);
                    //  echo $table_name." ".$last_date1." ".$before_time.' '.$last_time."<br>";
                    //   $sql3 = "SELECT entry_number FROM `$table_name` WHERE Time = (SELECT Time FROM `$table_name` ORDER BY entry_number DESC LIMIT 1 )  order by abs(spot - ATM) limit 1";
                    $sql3 = "select ctable.s,ctable.a,ctable.p,ctable.v,ctable.o,ctable.d, ptable.a,ptable.p,ptable.v,ptable.o,ptable.d,ctable.g,ptable.g,ctable.de,ctable.veg from "
                            . "(select spot as s,ATM as a ,ATM_price as p,ATM_vol as v,Options as o,delta as d,gamma as g,days_of_expire as de,vega as veg from `$table_name` "
                            . "where date = '$last_date1' and time between '$before_time' and '$last_time' and options='CE' and delta between '0.15' and '0.25' order by delta desc limit 1) as ctable,"
                            . "(select ATM as a ,ATM_price as p,ATM_vol as v,Options as o,delta as d,gamma as g from `$table_name` "
                            . "where date = '$last_date1' and time between '14:10:00' and '$last_time' and options='PE' "
                            . "and delta between '-0.45' and '-0.2' order by time,delta asc limit 1) as ptable ";

                    $result3 = mysqli_query($con, $sql3);
                    if ($result3) {
                        $n3 = mysqli_num_rows($result3);
                        // echo mysqli_error($con);

                        if ($n3 > 0) {//echo"<table>";
                            while ($row = mysqli_fetch_row($result3)) {
                                if ($row != null) {
                                    $date = date_create($last_date1);
                                    //echo $row[13];
                                    $expiry_day = date_format(date_add($date, date_interval_create_from_date_string($row[13] . ' days')), 'Y-m-d');
                                    ;
                                    //echo serialize($expiry_day)." ".$last_date1;
                                    $sql_earning = "SELECT * FROM `earning2` WHERE name = '$array2[$i]' and date >= '$last_date1' and date < '$expiry_day' ";                                     //FETCHING ALL company namre from db

                                    $result_earning = mysqli_query($con, $sql_earning);
                                    if ($result_earning) {
                                        $row_of_result = mysqli_num_rows($result_earning);
                                    }
                                    if ($row_of_result == 0) {//&& $max_time < $min_time && $max_time2 < $min_time2'
                                        $spot = $collar_all_script[$k][0] = $row[0];
                                        $call_strike = $collar_all_script[$k][1] = $row[1];
                                        $call_price = $collar_all_script[$k][2] = $row[2];
                                        $collar_all_script[$k][3] = $row[3];
                                        $collar_all_script[$k][4] = $row[4];
                                        $delta = $collar_all_script[$k][5] = $row[5];
                                        $put_strike = $collar_all_script[$k][6] = $row[6];
                                        $put_price = $collar_all_script[$k][7] = $row[7];
                                        $collar_all_script[$k][8] = $row[8];
                                        $collar_all_script[$k][9] = $row[9];
                                        $collar_all_script[$k][10] = Round($row[10], 2);
                                        $collar_all_script[$k][11] = $table_name;
                                        $lot = $collar_all_script[$k][12] = $lot_size[$i];
                                        $gamma = $collar_all_script[$k][13] = $row[11];
                                        $collar_all_script[$k][14] = $row[12];
                                        $collar_all_script[$k][15] = $row[13];
                                        $vega = $collar_all_script[$k][16] = $row[14]; //vega



                                        $qty = 3;
                                        $scrip_name = str_replace("vol_", "", $collar_all_script[$k][11]);
                                        if ($delta > 0.35) {
                                            $qty = 2;
                                        }
                                        $fix_loss = (($call_price * $qty) - (($spot - $put_strike)) - ($put_price)) * $lot;
                                        $fix_profit = (($call_strike - $spot) - ($put_price ) + ($call_price * $qty)) * $lot;
                                        if ($fix_loss == 0) {
                                            $fix_loss = 1;
                                        }
                                        $profit_ratio = ABS(Round($fix_profit / $fix_loss));
                                        $margins = Round(($spot * $lot * $qty * 16) / (100 * 1000)); //16 % margin of script
                                        /* if($fix_loss<0)
                                          {
                                          $rr = "1:".Round($profit_ratio);
                                          }
                                          else {
                                          $rr = "No Risk:".Round($fix_profit);
                                          } */
                                        if ($fix_loss < 0) {
                                            $profit_ratio = ABS(Round($fix_profit / $fix_loss));
                                            $rr = "1:" . Round($profit_ratio);
                                            $profit_sort = $profit_ratio;
                                        } else {
                                            $profit_ratio = ABS(Round($fix_profit / 100));
                                            $rr = "0:" . Round($profit_ratio);
                                            $profit_sort = $profit_ratio;
                                        }
                                        $margin_profit_rr = "yes";
                                        $one_vega = round($vega * $lot * $qty);
                                        $one_gamma = round($gamma * $lot * $qty);

                                        $one_gamma2 = round($spot * 0.01 * $one_gamma);
                                        $delta_val = $delta * ( $lot * $qty);
                                        $delta_neutral = $lot - $delta_val;
                                        if ($one_gamma != 0)
                                            $delta_clear = Round(($delta_neutral / $one_gamma) + $collar_all_script[$k][0], 1);

                                        //echo $margins."  ".$fix_profit."";
                                        if ($margins > 200 && $fix_profit < 10000) {
                                            $margin_profit_rr = "no";
                                        }
                                        // echo $selection;
                                        if ($selection == 'enable') {
                                            $get_hl = get_high_low($scrip_name);
                                        } else {
                                            $get_hl = 0;
                                        }
                                        //   echo $scrip_name;
                                        if ($profit_ratio > 3 && $fix_profit > 0 && $margin_profit_rr == "yes" && $fix_loss > -6000 && $fix_profit > 25000) {
                                            $call_collar_arr[$m][0] = "" . strtoupper($scrip_name) . "<bR>" . $call_strike . "&nbsp;   CE    &nbsp;" . "<span style='color:red'>-" . $qty * $lot . " </span> &nbsp;@ " . Round($call_price, 1) . "&nbsp; &Delta;" . Round($delta, 1) . " <BR>" . $put_strike . "&nbsp;  PE  &nbsp;   " . "<span style='color:Yellow'>  +" . $lot . " </span> &nbsp;@ " . Round($put_price, 1) . " <br>FO  &nbsp; <span style='color:Yellow'> +" . $lot . "</span>&nbsp;@  " . Round($collar_all_script[$k][0], 1) . "";

                                            $call_collar_arr[$m][1] = Round($delta_clear, 1);
                                            $call_collar_arr[$m][2] = Round($fix_loss);
                                            $call_collar_arr[$m][3] = Round($fix_profit);
                                            $call_collar_arr[$m][4] = $rr;
                                            $call_collar_arr[$m][5] = Round($margins / 100, 1);
                                            $call_collar_arr[$m][6] = $get_hl[0][0] . ":<br>" . $get_hl[0][1] . "<br>diff : " . $get_hl[0][2];
                                            $call_collar_arr[$m][7] = $get_hl[1][0] . ":<br>" . $get_hl[1][1] . "<br>diff : " . $get_hl[1][2];
                                            $call_collar_arr[$m][8] = $get_hl[2][0] . ":<br>" . $get_hl[2][1] . "<br>diff : " . $get_hl[2][2];
                                            $call_collar_arr[$m][9] = $get_hl[3][0] . ":<br>" . $get_hl[3][1] . "<br>diff : " . $get_hl[3][2];
                                            $call_collar_arr[$m][10] = $get_hl[4][0] . ":<br>" . $get_hl[4][1] . "<br>diff : " . $get_hl[4][2];
                                            $call_collar_arr[$m][11] = $profit_sort;

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
                array_multisort(array_column($call_collar_arr, 11), SORT_DESC,
                        /*  array_column($call_collar_arr, 3), SORT_DESC, */ $call_collar_arr);
                for ($i = 0; $i < sizeof($call_collar_arr); $i++) {
                    echo "<tr>
                <td>" . $call_collar_arr[$i][0] . " </td>"
                    . "<td>~" . $call_collar_arr[$i][1] . "</td>"
                    . "<td>" . $call_collar_arr[$i][2] . "</td>"
                    . "<td>" . $call_collar_arr[$i][3] . "</td>"
                    . "<td>" . $call_collar_arr[$i][4] . "</td>"
                    . "<td>" . $call_collar_arr[$i][5] . "L</td>"
                    /*  ."<td>". $one_gamma ."</td>"
                      ."<td>". $one_vega ."</td>"
                      ."<td>". $one_gamma2 ."</td>" */
                    
                    . "</tr>";
                }
                echo"</tbody></table></div></div>";
            }
            //echo serialize($collar_all_script);
            mysqli_close($con);

            function get_high_low($search) {
                $search = strtoupper($search);
                $total_data = 0;
                $array_all = array(array());
                $date1 = date('Y-m-d');
                /* if($search == 'nifty' || $search == 'NIFTY')
                  {
                  $search='^NSEI';
                  $c_name = $search;//".NS";
                  }
                  elseif ($search == 'BANKNIFTY') {
                  $search='^NSEBANK';
                  $c_name = $search;//".NS";
                  }
                  else {
                  $c_name = $search;
                  } */
                if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $search)) {

                    $search = preg_replace('/[^A-Za-z0-9\-]/', '', $search); // Removes special chars.
                    //echo $search."999";
                }
                if ($search == 'nifty' || $search == 'NIFTY') {
                    // $search='^NSEI';
                    $search = "CNX_NIFTY";
                    $c_name = $search; //".NS";
                } else if ($search == 'banknifty' || $search == 'BANKNIFTY') {
                    // $search='^NSEI';
                    $search = "NIFTY_BANK";
                    $c_name = $search; //".NS";
                } else {
                    //  $c_name = $search.".NS";
                    $c_name = $search;
                }


                //$date1="2016-0-26";

                $date2 = date('Y-m-d', strtotime('-10 day', strtotime($date1)));
                - 6;
                //echo $date2;
                $pieces2 = explode("-", $date1);
                $pieces1 = explode("-", $date2);
                $d1 = $pieces1[2];
                $d2 = $pieces2[2];
                $y1 = $pieces1[0];
                $y2 = $pieces2[0];
                $m1 = $pieces1[1] - 1;
                $m2 = $pieces2[1] - 1;
                /*   if (($handle = fopen("http://ichart.finance.yahoo.com/table.csv?s=$c_name&d=$m2&e=$d2&f=$y2&g=d&a=$m1&b=$d1&c=$y1&ignore=.csv", "r")) !==FALSE) // a,b,c  == start date,month, year, g = d means day,w=week,m==month,y=year, d,e,f = last date,month, year            
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
                  } */
                $csvFile = "https://www.quandl.com/api/v3/datasets/NSE/$c_name.csv?&start_date=$date2&end_date=$date1&api_key=Y7iNs1yEoNkuGaVLyEz4";

                $csv = readCSV($csvFile);
                /* echo '<pre>';
                  print_r($csv);
                  echo '</pre>'; */
                for ($i = 1; $i < sizeof($csv); $i++) {
                    if ($csv[$i]) {
                        $date = new DateTime($csv[$i][0]);
                        $date_hl = $date->format('d M');

                        $array_all[$total_data][0] = $date_hl;
                        $array_all[$total_data][1] = round($csv[$i][2], 1) . "-" . round($csv[$i][3], 1);
                        $array_all[$total_data][2] = round(($csv[$i][2] - $csv[$i][3]), 1);
                        $total_data = $total_data + 1;
                    }
                }
                Return $array_all;
            }

            /* function newtime($time,$minute=30){
              $time=strtotime($time);
              $m=date("i",$time)*1;
              $h=date("H",$time)*1;
              if($m<$minute){
              $h=$h-1;
              }
              return date("H:i:s",strtotime($h.":".$minute.":00"));
              } */

            function newtime($time, $offset) {
                // First, calculate the offset in seconds:
                $offset_sec = $offset * 60;

                // Next, fetch unix timestamp from $time
                $unix_time = strtotime($time);

                // Then calculate the modulo
                $modulo = $unix_time % $offset_sec;

                // Calculate latest timestamp
                $last_time = $unix_time - $modulo;

                // Display latest timestamp
                return date('H:i', $last_time);
            }

            function readCSV($csvFile) {
                $file_handle = fopen($csvFile, 'r');
                while (!feof($file_handle)) {
                    $line_of_text[] = fgetcsv($file_handle);
                }
                fclose($file_handle);
                return $line_of_text;
            }

            function subval_sort($a, $subkey) {
                foreach ($a as $k => $v) {
                    $b[$k] = strtolower($v[$subkey]);
                }
                asort($b);
                foreach ($b as $key => $val) {
                    $c[] = $a[$key];
                }
                return $c;
            }
            ?>
            <!--<h1>Coming Soon..</h1>-->
            <p></p>
            <hr>

            </body>

            </html>