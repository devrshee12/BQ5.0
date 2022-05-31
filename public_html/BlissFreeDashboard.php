<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

    include("./db_connect.php");
    

        ?>

             

                   
        <?php
    function quarter_detail($date_for_detail) {
            //$date_for_detail = "2018-03-13";
            $quarter_num = array(01, 04, 07, 10); //start month of quarter
            $curr_month = date('m', strtotime($date_for_detail));
            $firstmonth_quarter = closestnumber($curr_month, $quarter_num); //get nearest less number in array
            $year = date('Y', strtotime($date_for_detail));
//if ($firstmonth_quarter != 01) {


            $pre_start_date = $year . "-" . ($firstmonth_quarter) . "-01";

            $pre_end_date = $year . "-" . ($firstmonth_quarter + 2) . "-30";
            $firstmonth = substr(date('F', strtotime($pre_start_date)), 0, 3);
            $secondmonth = substr(date('F', strtotime('+1 month', strtotime($pre_start_date))), 0, 3);
            $thirdmonth = substr(date('F', strtotime('+2 month', strtotime($pre_start_date))), 0, 3);

            /* } else {
              $year = $year - 1;
              $pre_start_date = $year . "-10-01";
              $firstmonth = substr(date('F', strtotime($pre_start_date)),0,1);
              $secondmonth = substr(date('F', strtotime('+1 month', strtotime($pre_start_date))),0,1);
              $thirdmonth = substr(date('F', strtotime('+2 month', strtotime($pre_start_date))),0,1);
              $pre_end_date =  $year . "-12-30";
              } */

            $quarter = $firstmonth . "-" . $secondmonth . "-" . $thirdmonth;
            $quarter_detail = array("start_date" => $pre_start_date, "last_date" => $pre_end_date, "quarter" => $quarter, "year" => $year);
            return $quarter_detail;
        }

        $quarter = quarter_detail($today);
//echo serialize($quarter);
        $quarter_pre = quarter_detail($date_pre);
        $quarter_last = quarter_detail($date_last);
     
        $arr_atm = array("Today", "Last Day", "Expiry Week", $quarter["quarter"], $quarter_pre["quarter"], $quarter_last["quarter"], "2017", "2016", "2015");
       
        foreach ($arr_atm  as $value) {




            echo "      <tr>
                                                                  <td>$value</td>
                                                                  <td>XX</td>
                                                                   <td>XX</td>
                                                                        <td>XX</td>
                                                              </tr>";
            
        }
        
        ?>     




                                </tbody>
                            </table>
                            <table  class=" table table-striped text-center col-sm-6 col-xs-6" >
                                <thead>
                                    <tr>
                                        <th>FO Movement</th>
                                        <th>High</th>
                                        <th>Low</th>
                                        <th>Diff</th>
                                        <th>Daily % avg</th>
                                    </tr>
                                </thead>
                                <tbody>
        <?php
      
        $arr_atm = array("Yesterday", "Weekly", "Monthly", $quarter["quarter"], $quarter_pre["quarter"], $quarter_last["quarter"], "52 week");
      
           
        foreach ($arr_atm  as $value) {




            echo "      <tr>
                                                                  <td>$value</td>
                                                                  <td>XX</td>
                                                                   <td>XX</td>
                                                                        <td>XX</td>
                                                                         <td>XX</td>
                                                              </tr>";
            
        }
        $sql_nse_date = "SELECT date FROM `$table_name_nse` order by date desc limit 1";
        $result_nse_date = mysqli_query($con, $sql_nse_date);
        while ($row = mysqli_fetch_row($result_nse_date)) {
            $nse_last_date = $row[0];
        }
//   WHERE date between '$this_month_first' and '$today')
      
        ?>     

