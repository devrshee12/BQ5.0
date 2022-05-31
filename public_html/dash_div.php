<style>
    #chartdiv_vol_delta {
        width		: 100%;
        border:10px;
        border-style: solid;
        border-width: 2px;
        border-color: black;
        height		: 350px;;            
        top             : 80px;

        /*box-shadow: 10px 10px 20px  #000000;*/

    }
</style>
<script >
    $(document).ready(function () {
        range_sel_delta();
        get_five_day_movement(); // call to function
        document.getElementById('search2').value = "";


    });
</script>
<div class="row wrap ">


    <?php
    session_start();

    include_once('register.php');
    include_once("iv_functions.php");
    include("./db_connect.php");
    $funObj = new register();
    $user_active = $funObj->re_authenticate($_SESSION['email']);
    if (!$user_active) {
        echo "<script>alert('You are logged in to other computer. Please relogin.');  "
        . "window.location = 'index.php';"
        . "</script>";
    }

    $sql = "SELECT date FROM `nse_vol_nifty` order by date desc limit 1";
    $result_scrip = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result_scrip);
    $last_updated = date('d M y', strtotime($row[0]));
    $today = date('Y-m-d');
    //$today = "2018-04-13";
    $yesterday = date('Y-m-d', strtotime('-1 days', strtotime($today)));
    $date_pre = date('Y-m-d', strtotime('-3 months', strtotime($today)));
    $date_last = date('Y-m-d', strtotime('-6 months', strtotime($today)));
    $quarter = quarter_detail($today);
    //echo serialize($quarter);
    $quarter_pre = quarter_detail($date_pre);
    $quarter_last = quarter_detail($date_last);
    $quarter_month = $quarter['quarter'];
    $quarter_pre_month = $quarter_pre['quarter']; // explode("-", $quarter_pre['quarter']);
    $quarter_last_month = explode("-", $quarter_last['quarter']);
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


    $cmp = "";


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
    $n4 = mysqli_num_rows($result_check_watch);
   
    if ($n4 > 0) {

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


                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                        <h5 id="company_name" style="font-size: 16px;"><?php echo "<span>" . $company['d_name'] . "</span> Implied Volatility "; ?> </h5>
                    </div>



                    <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
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

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <?php if ($_SESSION['plan'] !== "FREE") { ?>
                            <select name="chart_type" onchange="range_sel_delta();" class="form-control control_color_1" id="chart_type"> 
                                <option selected="selected" value="intraday" >Intraday Chart</option>
                                <option value="daily" >Daily Chart</option>
                                <option value="indiavix" >IndiaVIX Chart</option>
                                <option value="movement" >Movement</option>
                            </select> 
                        <?php } else {
                            ?>
                            <select name="chart_type" onchange="upgrade_message();" class="form-control control_color_1" id="chart_type"> 
                                <option  value="intraday" >Intraday Chart</option>
                                <option  value="daily" >Daily Chart</option>
                                <option value="indiavix" >IndiaVIX Chart</option>
                                <option selected="selected" value="movement" >Movement</option>
                            </select> 
                        <?php }  ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <span class='pull-left add_list'><input id='eye_check' onclick = "add_to_eye()" type="checkbox" value="" <?php echo $checked_script; ?>> <span id="add_toggle"> <?php echo $add; ?> </span>  to   <a href="BlissEye.php" target="T">Chart Watchlist  </a></span>
                        <span class='pull-left  add_list' ><input id='watch_check' onclick = "add_to_watchlist_dash()" type="checkbox" value="" <?php echo $watched_script; ?>> <span id="add_watch_dash"> <?php echo $add_watch ?> </span>  to   <a href="Watchlist.php" target="T">Watchlist  </a></span>
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
                            $quarter = quarter_detail($today);
//echo serialize($quarter);
                            $quarter_pre = quarter_detail($date_pre);
                            $quarter_last = quarter_detail($date_last);
                            $today_avg_vol;
                            $arr_atm = array("Today", "Last Day", "Expiry Week-Last Q", $quarter["quarter"], $quarter_pre["quarter"], $quarter_last["quarter"], "2019", "2018", "2017", "2016", "2015");

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

                            $sql_expiry = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE (date between '2019-01-01' and '$today') and days_of_expire > 4";
                            $result_expiry = mysqli_query($con, $sql_expiry);
                            while ($row = mysqli_fetch_row($result_expiry)) {

                                echo "      <tr>
                                                                  <td>$arr_atm[6]</td>
                                                                  <td>" . Round($row[1], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                <td>" . Round($row[2], 1), "</td>
                                                              </tr>";
                                //$nse_last_date = $row[3];
                            }$sql_expiry = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE (date between '2018-01-01' and '2018-12-31') and days_of_expire > 4";
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
                            $sql_current = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE date between '2017-01-01' and '2017-12-01' and days_of_expire > 4";
                            $result_current = mysqli_query($con, $sql_current);
                            while ($row = mysqli_fetch_row($result_current)) {

                                echo "      <tr>
                                                                  <td>$arr_atm[8]</td>
                                                                  <td>" . Round($row[1], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                <td>" . Round($row[2], 1), "</td>
                                                              </tr>";
                            }
                            $sql_current = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse` WHERE date between '2016-01-01' and '2016-12-01' and days_of_expire > 4";
                            $result_current = mysqli_query($con, $sql_current);
                            while ($row = mysqli_fetch_row($result_current)) {

                                echo "      <tr>
                                                                  <td>$arr_atm[9]</td>
                                                                  <td>" . Round($row[1], 1), "</td>
                                                                   <td>" . Round($row[0], 1), "</td>
                                                                <td>" . Round($row[2], 1), "</td>
                                                              </tr>";
                            }
                            $sql_current = "SELECT AVG(ATM_vol),MIN(ATM_vol),MAX(ATM_vol) FROM `$table_name_nse`WHERE date between '2015-01-01' and '2015-12-01' and days_of_expire > 4";
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

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
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
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">





                    <table id="delta-table"   class=" table table-striped text-center">
                        <thead>
                            <tr >
                                <th ><input type='button' style="padding-left:0"  class="control_color_1" id='b1' onclick="prevdate()" value="<<" >   Date</th>
                                <th> FO High-Low</th>
                                <th>Difference     </th>
                                <th>% <input type='button' class="control_color_1" id='b2' onclick="nextdate()" value=">>" ></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
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
        </div>





        <?php
    } else {
        echo " <div class=' text-center'> Scrip $search Not Found <a href='BlissDelta_Data.php'> Search Again </a>
                
                    </div>";
    }
    ?>

</div>