<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include './header.php';
//error_reporting(0);
//echo $_SESSION['sess_id']." ".session_id() ;
include_once('register.php');
$funObj = new register();

/*if (isset($_SESSION['email'])) {//echo $_SESSION['email'];
    $user_active = $funObj->re_authenticate($_SESSION['email']);
    if (!$user_active) {
        echo "<script>alert('You are logged in to other computer. Please relogin.');  "
        . "window.location = 'index.php';"
        . "</script>";
    }
}*/
?> 
<html>
    <head>
        <title>Bliss Delta Data</title>   
        <script src="js/jquery-ui.js"></script>    
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">

        <script src="implied-volatility-master/implied-volatility.js"></script>
        <script>
            function upgrade_message() {

                $('#upgrade_modal').modal('show');

            }
            function copyToClipboard() {


                var copyText = document.getElementById("search2");
                copyText.setAttribute("id", "dummy_id");
                document.getElementById("dummy_id").value = "hello";
                copyText.select();
                //alert("Fsd");
                document.execCommand("Copy");
                document.getElementById("search2").value = "";
                //alert(copyText.value);
            }


            $(document).ready(function () {
                $(window).keyup(function (e) {
                    if (e.keyCode === 44) {
                        copyToClipboard();
                        // $("body").hide();

                    }

                });
            });
        </script>
        <?php if (isset($_SESSION['plan']) && $_SESSION['plan'] == "FREE") { ?>
            <style>


                .hovereffect .overlay {
                    width:100%;
                    height:100%;
                    position:absolute;
                    overflow:hidden;
                    top:0;
                    left:0;
                    opacity:0;
                    background-color:rgba(0,0,0,0.8);
                    -webkit-transition:all .4s ease-in-out;
                    transition:all .4s ease-in-out; 


                }

                .hovereffect h2 {
                    text-transform:uppercase;
                    color:#fff;
                    text-align:center;
                    position:relative;
                    font-size:17px;
                    background:rgba(0,0,0,0.6);
                    -webkit-transform:translatey(-100px);
                    -ms-transform:translatey(-100px);
                    transform:translatey(-100px);
                    -webkit-transition:all .2s ease-in-out;
                    transition:all .2s ease-in-out;
                    padding:10px;

                }



                .hovereffect:hover .overlay {
                    opacity:1;
                    filter:alpha(opacity=100);

                }

                .hovereffect:hover h2,.hovereffect:hover a.info {
                    opacity:1;
                    filter:alpha(opacity=100);
                    -ms-transform:translatey(0);
                    -webkit-transform:translatey(0);
                    transform:translatey(0);
                }

            </style>
        <?php } else {
            ?>
            <style>


                .hovereffect .overlay {
                    display:none;


                }

            </style>
        <?php } ?>

        <style>
            .amcharts-period-selector-div{
                display:none;
            }
            .form-inline{
                background-color: rgb(132,194,37);
            }
            .nopadding {
                padding: 0 !important;
                margin: 0 !important;
            }


            #chartdiv_vol_delta {
                width		: 100%;
                border:10px;
                border-style: solid;
                border-width: 2px;
                border-color: black;
                height		: 500px;;            
                top             : 80px;
                /*box-shadow: 10px 10px 20px  #000000;*/

            }

            @media (min-width: 1600px) and (max-width: 3500px) { 
                #chartdiv_vol_delta {
                    width		: 100%;


                    height		: 500px;;                

                }   

            }

            @media (min-width: 800px) and (max-width: 1100px) { 
                #chartdiv_vol_delta {
                    width		: 100%;

                    height		: 500px;;                


                }   

            }
            @media  (min-width: 320px) and (max-width: 800px) { 
                #chartdiv_vol_delta {
                    width		: 100%;


                    height		: 500px;;                


                }  
                /*   td,th{
                       font-size: 10px;
                   }*/


            }

        </style>       

    </head>
    <body>  
        <div class="row wrap ">


            <?php
            if (isset($_SESSION['user_id'])) {
                /* if there is no search or first time page run then it will show nifty data */
                if (isset($_GET['search1']) && $_GET['search1'] != "") {

                    $a = $_GET['search1'];
                    $a = str_replace("_", "&", $a);
//echo $a;
                    $search = $a;
//            if($search == 'nifty' || $search == 'NIFTY')
//            {
//                $search='^nsei';
//            }
                } else {
                    $search = "SBIN";
                }
                $user_id = $_SESSION['user_id'];
                include("./db_connect.php");
                /* $con_vol = mysqli_connect("localhost", "root", "", "bliss_vol");
                  $con_nse = mysqli_connect("localhost", "root", "", "bliss_vol_nse");
                  $con_future = mysqli_connect("localhost", "root", "", "bliss_future"); */
                /* get market price from bliss defined function get_cmp */
//$cmp = get_cmp($search);
                $cmp = "";
                /* bliss defined function get_cmp to get market price from google api */


                $today = date('Y-m-d');
                //$today = "2018-04-13";
                $yesterday = date('Y-m-d', strtotime('-1 days', strtotime($today)));
                $date_pre = date('Y-m-d', strtotime('-3 months', strtotime($today)));
                $date_last = date('Y-m-d', strtotime('-6 months', strtotime($today)));

                $search = rtrim(ltrim(strtolower($search)));
                $table_name = "vol_" . $search;
                $table_name_nse = "nse_vol_" . $search;
                $table_name_fut = "fut_" . $search;
                $sql_check_eye = "SELECT * FROM `blisseye` WHERE user_id = '$user_id' and scripts like '%$search%' ";

                $result_check_eye = mysqli_query($con, $sql_check_eye);
                $n3 = mysqli_num_rows($result_check_eye);
                if ($n3 > 0) {

                    $checked_script = "checked";
                    $add = "Added";
                } else {
                    $checked_script = "";
                    $add = "Add";
                }
                $sql_check_watch = "SELECT * FROM `watchlist` WHERE user_id = '$user_id' and scripts like '%$search%' ";

                $result_check_watch = mysqli_query($con, $sql_check_watch);
                $n3 = mysqli_num_rows($result_check_watch);
                if ($n3 > 0) {

                    $watched_script = "checked";
                    $add_watch = "Added";
                } else {
                    $watched_script = "";
                    $add_watch = "Add";
                }
                $spot = "";
                $sql_companies = "SELECT d_name FROM `companies` WHERE c_name like '$search%' ";
                $result_companies = mysqli_query($con, $sql_companies);
                $company = mysqli_fetch_array($result_companies);

                $n3 = mysqli_num_rows($result_companies);
                if ($n3 > 0) {
                    $sql_spot = "SELECT spot FROM `$table_name` order by entry_number desc limit 1 ";

                    $result_spot = mysqli_query($con, $sql_spot);
                    while ($row = mysqli_fetch_row($result_spot)) {

                        $spot = $row[0];
                    }
                    ?>

                    <div class="row">


                        <div class="col-lg-3 col-md-4 col-sm-3">

                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 text-center"> 
                            <div class="row">
                                <div class="col-lg-2 col-md-0 col-sm-0">

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <h5 id="company_name" style="font-size: 16px;"><?php echo "<span>" . $company['d_name'] . "</span> Implied Volatility "; ?> </h5>
                                </div>



                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                  <!--  <input id="search2" name="search2"  class="form-control control_color_1"  placeholder="Search Scrip" VALUE="<?php echo $search; ?>" >-->
                                    <input id="search1" name="search1" type="hidden" class="form-control control_color_1"  placeholder="Search Scrip" VALUE="<?php echo $search; ?>" >
                                    <?php if ($_SESSION['plan'] !== "FREE") { ?>
                                        <select id="search2" name="search2" class="form-control control_color_1 selectpicker " placeholder="Search Scrip" onchange="reload_data()" data-live-search="true">
                                        <?php } else {
                                            ?>
                                            <select id="search2" name="search2" class="form-control control_color_1 selectpicker " placeholder="Search Scrip" onchange="upgrade_message()" data-live-search="true">

                                            <?php } ?>
                                            <option placeholder="Search Scrip" value = ""> Select Stock</option>  
                                            <?php
                                            $sql_all_companies = "SELECT c_name FROM `companies`";
                                            $result_all_companies = mysqli_query($con, $sql_all_companies);
                                            //$all_company = mysqli_fetch_array($result_companies);
                                            while ($row = mysqli_fetch_array($result_all_companies)) {

                                                echo "<option data-tokens='" . $row['c_name'] . "'>" . $row['c_name'] . "</option>";
                                            }
                                            ?>


                                        </select>

                                </div>

                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                    <?php if ($_SESSION['plan'] !== "FREE") { ?>
                                        <select name="chart_type" onchange="range_sel_delta();" class="form-control control_color_1" id="chart_type"> 
                                            <option selected="selected" value="intraday" >Intraday Chart</option>
                                            <option value="daily" >Daily Chart</option>
                                            <option value="indiavix" >IndiaVIX Chart</option>
                                            <option value="movement" >Movement</option>
                                            <option value="election" >2014 Chart</option>
                                        </select> 
                                    <?php } else {
                                        ?>
                                        <select name="chart_type" onchange="upgrade_message();" class="form-control control_color_1" id="chart_type"> 
                                            <option  value="intraday" >Intraday Chart</option>
                                            <option  value="daily" >Daily Chart</option>
                                            <option value="indiavix" >IndiaVIX Chart</option>
                                            <option selected="selected" value="movement" >Movement</option
                                            <option value="election" >2014 Chart</option>
                                        </select> 
                                    <?php } ?>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
                                    <span class='pull-left add_list'><input id='eye_check' onclick = "add_to_eye()" type="checkbox" value="" <?php echo $checked_script; ?>> <span id="add_toggle"> <?php echo $add; ?> </span>  to   <a href="BlissEye.php" target="T">Chart Watchlist  </a></span>
                                    <span class='pull-left  add_list' ><input id='watch_check' onclick = "add_to_watchlist()" type="checkbox" value="" <?php echo $watched_script; ?>> <span id="add_watch"> <?php echo $add_watch; ?> </span>  to   <a href="Watchlist.php" target="T">Watchlist  </a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                            <table  class=" table table-striped text-center col-sm-6 col-xs-6" >
                                <thead>
                                    <tr>
                                        <th>ATM IV</th>
                                        <th>Min</th>
                                        <th>Avg</th>
                                        <th>Max</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if ($_SESSION['plan'] !== "FREE") {  //inserting all fetch value to array  // echo "hello";

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



                                            $quarter = $firstmonth . "-" . $secondmonth . "-" . $thirdmonth;
                                            $quarter_detail = array("start_date" => $pre_start_date, "last_date" => $pre_end_date, "quarter" => $quarter, "year" => $year);
                                            return $quarter_detail;
                                        }

                                        $quarter = quarter_detail($today);
//echo serialize($quarter);
                                        $quarter_pre = quarter_detail($date_pre);
                                        $quarter_last = quarter_detail($date_last);
                                        $today_avg_vol;
                                        $arr_atm = array("Today", "Last Day", "Expiry Week-Last Q", $quarter["quarter"], $quarter_pre["quarter"], $quarter_last["quarter"], "2020", "2019", "2018", "2017", "2016", "2015");

                                        $sql_current = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol),MIN(NULLIF(ATM_vol, 0)) FROM `$table_name` WHERE date = '$today'";
                                        $result_current = mysqli_query($con, $sql_current);
                                        while ($row = mysqli_fetch_row($result_current)) {

                                            echo "      <tr>
                                                                  <td>$arr_atm[0]</td>
                                                                  <td>" . Round($row[3], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                        <td>" . Round($row[2], 1), "</td>
                                                              </tr>";
                                            $today_avg_vol = $row[0];
                                        }
                                        if ($today_avg_vol != 0)/* if todays vol data is not available then take yesterday vol as yesterday and today vol 0 and if yesterday vol is not available then fetch vol of one day before last date */ {//echo "yes";
                                            $sql_yesterday = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol),MIN(NULLIF(ATM_vol, 0)) FROM `$table_name` WHERE date = (Select date FROM `$table_name` Group by date order by  entry_number desc limit 1,1)";
                                        } else {
                                            $sql_yesterday = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol),MIN(NULLIF(ATM_vol, 0)) FROM `$table_name` WHERE date = (Select date FROM `$table_name` Group by date order by  entry_number desc limit 1)";
                                        }
                                        $result_yesterday = mysqli_query($con, $sql_yesterday);
                                        while ($row = mysqli_fetch_row($result_yesterday)) {

                                            echo "      <tr>
                                                                  <td>$arr_atm[1]</td>
                                                                  <td>" . Round($row[3], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                        <td>" . Round($row[2], 1), "</td>
                                                              </tr>";
                                        }

                                        $sql_expiry = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE (date between '" . $quarter_pre['start_date'] . "' and '" . $quarter_pre['last_date'] . "') and days_of_expire < 4";
                                        $result_expiry = mysqli_query($con, $sql_expiry);
                                        while ($row = mysqli_fetch_row($result_expiry)) {

                                            echo "      <tr>
                                                                  <td>$arr_atm[2]</td>
                                                                  <td>" . Round($row[1], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                <td>" . Round($row[2], 1), "</td>
                                                              </tr>";
                                            //$nse_last_date = $row[3];
                                        }
                                        $sql_nse_date = "SELECT date FROM `$table_name_nse` order by date desc limit 1";
                                        $result_nse_date = mysqli_query($con, $sql_nse_date);
                                        while ($row = mysqli_fetch_row($result_nse_date)) {
                                            $nse_last_date = $row[0];
                                        }
                                        $sql_this = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE (date between '" . $quarter['start_date'] . "' and '" . $today . "') and days_of_expire > 4";
                                        $result_this = mysqli_query($con, $sql_this);
                                        while ($row = mysqli_fetch_row($result_this)) {

                                            echo "      <tr>
                                                                  <td>$arr_atm[3]</td>
                                                                  <td>" . Round($row[1], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                <td>" . Round($row[2], 1), "</td>
                                                              </tr>";
                                        }
                                        $sql_this = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE (date between '" . $quarter_pre['start_date'] . "' and '" . $quarter_pre['last_date'] . "') and days_of_expire > 4";
                                        $result_this = mysqli_query($con, $sql_this);
                                        while ($row = mysqli_fetch_row($result_this)) {

                                            echo "    <tr>
                                                                    <td style='color:rgb(132,194,37)'>$arr_atm[4]</td>
                                                                    <td style='color:rgb(132,194,37)'>" . Round($row[1], 1) . "</td>
                                                                    <td style='color:rgb(132,194,37)'>" . Round($row[0], 1) . "</td>
                                                                    <td style='color:rgb(132,194,37)'>" . Round($row[2], 1) . "</td>
                                                                </tr>";
                                        }
                                        $sql_this = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE (date between '" . $quarter_last['start_date'] . "' and '" . $quarter_last['last_date'] . "') and days_of_expire > 4";
                                        $result_this = mysqli_query($con, $sql_this);
                                        while ($row = mysqli_fetch_row($result_this)) {

                                            echo "      <tr>
                                                                  <td>$arr_atm[5]</td>
                                                                  <td>" . Round($row[1], 1) . "</td>
                                                                   <td>" . Round($row[0], 1) . "</td>
                                                                <td>" . Round($row[2], 1) . "</td>
                                                              </tr>";
                                        }
//chnaged by Falguni to solve atm max min avg error
                                        $sql_expiry = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE (date between '2020-01-01' and '$today') and days_of_expire > 4";
                                        $result_expiry = mysqli_query($con, $sql_expiry);
                                        while ($row = mysqli_fetch_row($result_expiry)) {

                                            echo "      <tr>
                                                                  <td>$arr_atm[6]</td>
                                                                  <td>" . Round($row[1], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                <td>" . Round($row[2], 1), "</td>
                                                              </tr>";
                                            //$nse_last_date = $row[3];
                                        }$sql_expiry = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE (date between '2019-01-01' and '2019-12-31') and days_of_expire > 4";
                                        $result_expiry = mysqli_query($con, $sql_expiry);
                                        while ($row = mysqli_fetch_row($result_expiry)) {

                                            echo "      <tr>
                                                                  <td>$arr_atm[7]</td>
                                                                  <td>" . Round($row[1], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                <td>" . Round($row[2], 1), "</td>
                                                              </tr>";
                                            //$nse_last_date = $row[3];
                                        }
                                        $sql_current = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE date between '2018-01-01' and '2018-12-31' and days_of_expire > 4";
                                        $result_current = mysqli_query($con, $sql_current);
                                        while ($row = mysqli_fetch_row($result_current)) {

                                            echo "      <tr>
                                                                  <td>$arr_atm[8]</td>
                                                                  <td>" . Round($row[1], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                <td>" . Round($row[2], 1), "</td>
                                                              </tr>";
                                        }
                                        $sql_current = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE date between '2017-01-01' and '2017-12-31' and days_of_expire > 4";
                                        $result_current = mysqli_query($con, $sql_current);
                                        while ($row = mysqli_fetch_row($result_current)) {

                                            echo "      <tr>
                                                                  <td>$arr_atm[9]</td>
                                                                  <td>" . Round($row[1], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                <td>" . Round($row[2], 1), "</td>
                                                              </tr>";
                                        }
                                        $sql_current = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse`WHERE date between '2016-01-01' and '2016-12-31' and days_of_expire > 4";
                                        $result_current = mysqli_query($con, $sql_current);
                                        while ($row = mysqli_fetch_row($result_current)) {

                                            echo "      <tr>
                                                                  <td>$arr_atm[10]</td>
                                                                  <td>" . Round($row[1], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                        <td>" . Round($row[2], 1), "</td>
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
                                        $week_before = date('y-m-d', strtotime('-7 days', strtotime($yesterday)));
                                        ;
                                        $month_before = date('y-m-d', strtotime('-31 days', strtotime($yesterday)));
                                        ;
                                        $year_before = date('y-m-d', strtotime('-365 days', strtotime($yesterday)));
                                        ;
                                        $arr_atm = array("Yesterday", "Weekly", "Monthly", $quarter["quarter"], $quarter_pre["quarter"], $quarter_last["quarter"], "52 week");
                                        $sql_current = "SELECT high,low,((high-low)*100/low) FROM `$table_name_fut` WHERE date = '$yesterday'";
                                        $result_current = mysqli_query($con, $sql_current);
                                        while ($row = mysqli_fetch_row($result_current)) {

                                            echo "      <tr>
                            <td>$arr_atm[0]</td>
                            <td>" . Round($row[0], 1) . "</td>
                            <td>" . Round($row[1], 1) . "</td>
                            <td>" . Round($row[0] - $row[1], 1) . "</td>
                            <td>" . Round($row[2], 1) . "</td>
                        </tr>";
                                        }
//   WHERE date between '$this_month_first' and '$today')
                                        $sql_current = "Select Max(week.h),Min(week.l),AVG(week.mn) from (SELECT high as h,low as l,((high-low)*100/low) as mn FROM `$table_name_fut` WHERE date between '$week_before' and '$yesterday')week";
                                        $result_current = mysqli_query($con, $sql_current);
                                        while ($row = mysqli_fetch_row($result_current)) {

                                            echo "  <tr>
                    <td>$arr_atm[1]</td>
                    <td>" . Round($row[0], 1) . "</td>
                    <td>" . Round($row[1], 1) . "</td>
                    <td>" . Round($row[0] - $row[1], 1) . "</td>
                    <td>" . Round($row[2], 1) . "</td>
                </tr>";
                                        }

                                        $sql_current = "Select Max(month.h),Min(month.l),AVG(month.mn) from (SELECT high as h,low as l,((high-low)*100/low) as mn FROM `$table_name_fut` WHERE date between '$month_before' and '$yesterday')month";
                                        $result_current = mysqli_query($con, $sql_current);
                                        while ($row = mysqli_fetch_row($result_current)) {

                                            echo "      <tr>
                            <td>$arr_atm[2]</td>
                            <td>" . Round($row[0], 1) . "</td>
                            <td>" . Round($row[1], 1) . "</td>
                            <td>" . Round($row[0] - $row[1], 1) . "</td>
                            <td>" . Round($row[2], 1) . "</td>
                        </tr>";
                                        }
                                        $sql_current = "Select Max(month.h),Min(month.l),AVG(month.mn) from (SELECT high as h,low as l,((high-low)*100/low) as mn FROM `$table_name_fut` WHERE date between '" . $quarter['start_date'] . "' and '$yesterday')month";
                                        $result_current = mysqli_query($con, $sql_current);
                                        while ($row = mysqli_fetch_row($result_current)) {

                                            echo "      <tr>
                                               <td>$arr_atm[3]</td>
                                                                     <td>" . Round($row[0], 1) . "</td>
                                                                      <td>" . Round($row[1], 1) . "</td>
                                                                           <td>" . Round($row[0] - $row[1], 1) . "</td>
                                                                           <td>" . Round($row[2], 1) . "</td>
                                                                 </tr>";
                                        }
                                        $sql_current = "Select Max(month.h),Min(month.l),AVG(month.mn) from (SELECT high as h,low as l,((high-low)*100/low) as mn FROM `$table_name_fut` WHERE date between '" . $quarter_pre['start_date'] . "' and '" . $quarter_pre['last_date'] . "')month";
                                        $result_current = mysqli_query($con, $sql_current);
                                        while ($row = mysqli_fetch_row($result_current)) {

                                            echo "      <tr>
                                                <td style='color:rgb(132,194,37)'>$arr_atm[4]</td>
                                                <td style='color:rgb(132,194,37)'>" . Round($row[0], 1) . "</td>
                                                 <td style='color:rgb(132,194,37)'>" . Round($row[1], 1) . "</td>
                                               <td style='color:rgb(132,194,37)'>" . Round($row[0] - $row[1], 1) . "</td>
                                               <td style='color:rgb(132,194,37)'>" . Round($row[2], 1) . "</td>
                                            </tr>";
                                        }
                                        $sql_current = "Select Max(month.h),Min(month.l),AVG(month.mn) from (SELECT high as h,low as l,((high-low)*100/low) as mn FROM `$table_name_fut` WHERE date between '" . $quarter_last['start_date'] . "' and '" . $quarter_last['last_date'] . "')month";
                                        $result_current = mysqli_query($con, $sql_current);
                                        while ($row = mysqli_fetch_row($result_current)) {

                                            echo "      <tr>
                                                                     <td>$arr_atm[5]</td>
                                                                     <td>" . Round($row[0], 1) . "</td>
                                                                      <td>" . Round($row[1], 1) . "</td>
                                                                           <td>" . Round($row[0] - $row[1], 1) . "</td>
                                                                           <td>" . Round($row[2], 1) . "</td>
                                                                 </tr>";
                                        }
                                        $sql_current = "Select Max(month.h),Min(month.l),AVG(month.mn) from (SELECT high as h,low as l,((high-low)*100/low) as mn FROM `$table_name_fut` WHERE date between '$year_before' and '$yesterday')month";
                                        $result_current = mysqli_query($con, $sql_current);
                                        while ($row = mysqli_fetch_row($result_current)) {

                                            echo "      <tr>
                                                                     <td>$arr_atm[6]</td>
                                                                     <td>" . Round($row[0], 1) . "</td>
                                                                      <td>" . Round($row[1], 1) . "</td>
                                                                           <td>" . Round($row[0] - $row[1], 1) . "</td>
                                                                           <td>" . Round($row[2], 1) . "</td>
                                                                 </tr>";
                                        }
                                    } else {
                                        include("BlissFreeDashboard.php");
                                    }
                                    ?>     




                                </tbody>
                            </table>
                        </div>
                        <?php if ($_SESSION['plan'] !== "FREE") { ?>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div id="chartdiv_vol_delta" class=""> </div> 

                            </div>
                        <?php } else { ?>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 hovereffect">
                                <div id="chartdiv_vol_delta" class=""> </div> 
                                <div class="overlay">
                                    <h2>Please Upgrade your Plan <br> <a class="btn-lg btn-block text-center" style="width:30%;margin-left:35%;"  href="BlissPricing.php" > Upgrade </a></h2>

                                </div> 
                            </div>

                        <?php } ?>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-3">





                            <table id="delta-table"   class=" table table-striped text-center">
                                <thead>
                                    <tr >
                                        <th ><input type='button' style="padding-left:0"  class="control_color_1" id='b1' onclick="prevdate()" value="<<" >   Date</th>
                                        <th>Intraday FO High-Low</th>
                                        <th>Difference     </th>
                                        <th>% <input type='button' class="control_color_1" id='b2' onclick="nextdate()" value=">>" ></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-8 "> 


                            <?php
                            $sql_companies = "SELECT sector,market_cap FROM `companies` WHERE c_name = '$search' ";

                            $result_companies = mysqli_query($con, $sql_companies);
                            $n3 = mysqli_num_rows($result_companies);


                            if ($n3 > 0) {
                                //echo "hello iiiiiiiiiiiiii";
                                $arr_atm = array("Sector", "Market Capital", "Beta", "IV Projection = __");

                                while ($row = mysqli_fetch_row($result_companies)) {
                                    if ($row != null) {
                                        $sector = $row[0];
                                        $marketcap = $row[1];
                                    }
                                }
                            }
                            ?>   


                            <form class="form-inline" style="display:none" id="type" role="form"> 
                                <span style="color:  rgb(132,194,37);"> Select chart type: </span>
                                <span class=" form-control control_color_1">
                                    <input type="radio" name="type" value="line" onclick="setType(this.value);" checked="checked" /> Line
                                </span>
                                <span class="form-control control_color_1">
                                    <input type="radio" name="type" value="column" onclick="setType(this.value);" /> Column
                                </span>
                            </form>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 " >
                                    <table class="table table-striped">
                                        <thead>
                                        <td>
                                            Sector
                                        </td>
                                        </thead>
                                        <tbody>
                                        <td>
                                            <?php echo $sector; ?>
                                        </td>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 ">
                                    <table class="table table-striped">
                                        <thead>
                                        <td>
                                            Market Capital
                                        </td>
                                        </thead>
                                        <tbody>
                                        <td>
                                            <?php echo $marketcap; ?>
                                        </td>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <table class="table table-striped">
                                        <thead>
                                        <td>
                                            Beta
                                        </td>
                                        </thead>
                                        <tbody>
                                        <td>
                                            Coming Soon
                                        </td>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 ">
                                    <table class="table table-striped">
                                        <thead>
                                        <td colspan="5">
                                            IV Projection
                                        </td>
                                        </thead>
                                        <tbody>
                                        <td >
                                            <span style='color:rgb(132,194,58)'  id="projection"> N/A </span>
                                        </td>
                                        <td colspan="3">


                                            <input type='text' class="form-control control_color_1 "  onchange="get_projection()"     id='day1_vq'>
                                        </td>
                                        <td>


                                            <span class="input-group-addon control_color_1" >
                                                <span class="glyphicon glyphicon-calendar" ></span>
                                            </span>


                                        </td>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 ">
                                    <table class="table table-striped">
                                        <thead>
                                        <td colspan="5">
                                            Intraday IV
                                        </td>
                                        </thead>
                                        <tbody>
                                        <td >
                                            <span id="intraday_iv"></span>
                                        </td>
                                        <td colspan="3">


                                            <input type='text' class="form-control control_color_1 " value="<?php echo $nse_last_date; ?>"  onchange="get_intraday()"     id='intra_date'>
                                        </td>
                                        <td>
                                            <span class="input-group-addon control_color_1" >
                                                <span class="glyphicon glyphicon-calendar" ></span>
                                            </span>

                                        </td>
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                                    <div class=" row">      
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 nopadding" id="b1">                       
                                            <input type='button' class="form-control control_color_1" name='b1' onclick="get_result(this.value)" value="<<" >                        
                                        </div>                
                                        <!-- <div class="input-group-btn " id="range_text">                       
                                             <input type='text' size="15" name='day' id='day1' class="form-control control_color_1" placeholder="From"  > -                 
                                         </div>   -->
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 nopadding"> 
                                            <input type='text' size="15" name='day' id='day1' style="display:none" class="d-none" placeholder="From"  >      
                                            <input type='text' class="form-control control_color_1"  name='day' id='day2' placeholder="To"  >                        
                                        </div>     
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 nopadding" id="b2">                       
                                            <input type='button' class="form-control control_color_1" name='b2' onclick="get_result(this.value)" value=">>">                        
                                        </div>

                                        <div  class="col-lg-3 col-md-3 col-sm-3 col-xs-3 nopadding" > 
                                            <select name="range" onchange="get_result(this.value)" class="form-control control_color_1" id="range">                    
                                                <option value=""></option>
                                                <option value="today" >Today</option>
                                                <option value="week" >Week</option>
                                                <option value="month" selected="selected"> Month</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <table  class=" table table-striped text-center" >
                                <thead>
                                    <tr>
                                        <th>Result Date</th>
                                        <th>Time</th>
                                        <th>Movement</th>
                                        <th>Changes</th>
                                        <th>IV Range</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
//   //show past result
                                    $sql = "SELECT date,time,ROUND(movement,1),changes FROM `earning2` WHERE  name = '$search' ORDER BY date desc limit 7";
                                    $result = mysqli_query($con, $sql); //excute query        
                                    $n = mysqli_num_rows($result); // give number of rows        
                                    if ($n > 0) {
                                        while ($row1 = mysqli_fetch_row($result)) { //fetch row one by one in loop
                                            $result_date = $row1[0];     //last vol  

                                            $days_ago = date('Y-m-d', strtotime('-7 days', strtotime($result_date)));
                                            ;
                                            $days_later = date('Y-m-d', strtotime('+2 days', strtotime($result_date)));
                                            ;
                                            $sql_result_vol = "SELECT AVG(ATM_vol),MAX(ATM_vol),MIN(NULLIF(ATM_vol, 0)) FROM `$table_name` WHERE date > '$days_ago' and date < '$days_later' ";

                                            $result_result_vol = mysqli_query($con, $sql_result_vol);
                                            $n_result_vol = mysqli_num_rows($result_result_vol);
                                            /* if there is no search value in highlow_vol table then search in bliss_vol database */
                                            if ($n_result_vol > 0) {
                                                while ($row = mysqli_fetch_row($result_result_vol)) {                                     //inserting all fetch value to array
                                                    if ($row != null) {
                                                        //   echo $days_ago." ";
                                                        $iv_range = ROUND($row[2], 1) . " - " . ROUND($row[1], 1);  //high
                                                        //   $array_all_m[$total_data][5] = ROUND($row[2],1)." / ".ROUND($row[1],1);  //high
                                                        // $pre_q_mov = Round($row[3] - $row[4],1);
                                                    }
                                                }
                                            }/* retrieve low data only when search is empty */

                                            $row1[0] = date('d M Y', strtotime($row1[0]));
                                            ;
                                            ?>                    
                                            <tr>
                                                <td><?php echo $row1[0]; ?></td>
                                                <td><?php echo $row1[1]; ?></td>
                                                <?php
                                                if ($_SESSION['plan'] !== "FREE") {
                                                    ?>
                                                    <td><?php echo $row1[2] . " %"; ?></td>
                                                    <td><?php echo $row1[3] . " %"; ?></td>
                                                    <td><?php echo $iv_range; ?></td>

                                                    <?php
                                                } else {
                                                    ?>
                                                    <td>XX</td>
                                                    <td>XX</td>
                                                    <td>XX</td>
                                                <?php }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="2"><?php echo 'No record found' ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>

                            </table>



                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 "> 
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                    <table id="employee-grid"   class=" table table-striped text-center">
                                        <thead>
                                            <tr>

                                                <th>Date</th>
                                                <th> ~Time(IST)</th>
                                                <th>Result Script  </th>


                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                    <table id="event-grid" class="table table-striped text-center" >
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Event Name</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            ?>
                                        </tbody>
                                    </table>


                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <table  id="fii-table" class="table table-striped table-fixed" >
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>FII Net Buy/Sell (Rs.Cr)</th>
                                                <th>DII Net Buy/Sell (Rs.Cr)</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            ?>

                                        </tbody>
                                    </table>


                                </div>

                            </div>
                        </div>
                    </div>






                    <?php
                } else {
                    echo " <div class=' text-center'> Scrip $search Not Found <a href='BlissDelta_Data.php'> Search Again </a>
                
                    </div>";
                }
            } else {
                echo " <div class='col-lg-12 panel-heading text-center'> To access this product, you need to    <a href='#' data-toggle='modal' data-target='#Register-modal'>Register</a>/
                        <a href='#' data-toggle='modal' data-target='#login-modal'>Login</a>  . <br> </div></div>";
            }

            function closestnumber($number, $candidates) {
                $last = null;
                foreach ($candidates as $cand) {
                    if ($cand < $number) {
                        $last = $cand;
                    } else if ($cand == $number) {
                        return $number;
                    } else if ($cand > $number) {
                        return $last;
                    }
                }
                return $last;
            }
            ?>

        </div>

        <section class='disclaimer'>
            <div class='container'>
                <div class='row' style="font-size: 14px; color:black">
                    <div class='col-lg-2 col-md-2 col-sm-2'>
                        Disclaimer :
                    </div>

                    <div class=' col-lg-10 col-md-10 col-sm-10'>
                        <marquee id='scroll_news'>
                            <div  onmouseout="document.getElementById('scroll_news').start();" onmouseover="document.getElementById('scroll_news').stop();">
                                1. All historical data is referenced to NSE closed data. 
                                2. Live data may be delayed.
                                3. Blue part in daily chart shows expiry week IV.
                            </div></marquee>

                    </div>


                </div>
            </div>
        </section> 
        <div class="modal fade " id="upgrade_modal" role="dialog">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <img src="blissquant2.jpg" alt="Bliss Image" >
                    </div>
                    <div class="modal-body ">

                        <div class="panel-heading title_all text-center">  Note  </div>     


                        <h4> Please Upgrade your plan: <a class="btn btn-success" href="BlissPricing.php" > Upgrade </a> </h4>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>


</html>
<script type="text/javascript" language="javascript" src="bootstrap-3.3.4-dist/js/jquery.carouFredSel-6.0.4-packed.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">      
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="amstockchart/amcharts/amcharts.js"></script>
<script type="text/javascript" src="amstockchart/amcharts/serial.js"></script>    
<script type="text/javascript" src="amstockchart/amcharts/amstock.js"></script>    


<script type="text/javascript" src="amstockchart/amcharts/themes/light.js"></script>
<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>

<script src="js/BlissDelta_Data.js"></script>
<script src="js/EventCalendar.js"></script>
<script src="js/dateformat.js"></script>
<?php
include ("./html/footer.html");



