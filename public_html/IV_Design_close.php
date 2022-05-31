<script>
    /* function range_sel(connect_page) //passing selected duration today,week or month
     {
     connect_page = "connect/" + connect_page;
     
     
     search = "";
     $.post(connect_page, {search: search}, function (result) {
     var obj = jQuery.parseJSON(result);
     
     var table = $('#iv_vol-table').DataTable({
     data: obj.a,
     "bDestroy": true, //destroy last table 
     "processing": true,
     "deferRender": true,
     "lengthMenu": [5, 10, 25, 50, 100],
     "iDisplayLength": 20,
     
     "sScrollX": true,
     "paging": false,
     "scrollY": "60vh",
     "dom": ' <"top">t<"bottom"p>',
     "order": [[1, "desc"]],
     "sEmptyTable": "No Script",
     language: {
     oPaginate: {
     "sNext": ">",
     "sPrevious": "<"
     },
     
     // "sInfoFiltered": "" //remove filter label text on searching
     },"columnDefs": [
     {
     "targets": [ 0 ],
     "visible": false,
     "searchable": false
     }
     ]
     });
     
     $('#search1').change(function(){
     
     table.search($(this).val()).draw() ;
     });
     $('#search_sector').change(function(){
     
     table.search($(this).val()).draw() ;
     });
     
     });
     
     }*/


</script>

<div class="row wrap">   
    <br>
    <?php
    include_once('register.php');
    $funObj = new register();
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
    $quarter_month = explode("-", $quarter['quarter']);
    $quarter_pre_month = explode("-", $quarter_pre['quarter']);
    $quarter_last_month = explode("-", $quarter_last['quarter']);
    /* if ($_SESSION['plan'] !== "FREE" )
      { */
// echo $_SESSION['plan'];
    if (isset($_SESSION['user_id'])) {

        $user_active = $funObj->re_authenticate($_SESSION['email']);
        if (!$user_active) {
            echo "<script>alert('You are logged in to other computer. Please relogin.');  "
            . "window.location = 'index.php';"
            . "</script>";
        }
        ?>

        <div id="chartdiv_vol">

        </div>
        <div id="dashboard">

        </div>
        <div id="get_name"></div>


        <div class="col-lg-12 col-md-12 col-sm-12 text-center "> 
            <div class="row">
                <div class="col-lg-8" >

                    <ul class="nav nav-tabs" style="border:none">  
                        <li  > <a href="Blissvol_close.php">IV Data</a></li> 
                        <li  > <a href="Blisslow_close.php">Low IV</a></li> 
                        <li  > <a href="BlissData_close.php">High IV</a></li> 
                        <h3>IV Analytics: Last 5 closed & BEP IV  </h3>  
                    </ul>
                </div>

                <div class="col-lg-2" >
                    <select id="search1" name="search1" class="form-control control_color_1 selectpicker " placeholder="Search Scrip" data-live-search="true">
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
                <div class="col-lg-2" >
                    <select id="search_sector" name="search_sector" class="form-control control_color_1 selectpicker " placeholder="Search Scrip" data-live-search="true">
                        <option placeholder="Search Scrip" value = ""> Select Sector</option>  
                        <option placeholder="Search Scrip" value = "NIFTY50"> NIFTY50</option>
                        <?php
                        $sql_all_companies = "SELECT sector FROM `companies` group by sector";
                        $result_all_companies = mysqli_query($con, $sql_all_companies);
                        //$all_company = mysqli_fetch_array($result_companies);
                        while ($row = mysqli_fetch_array($result_all_companies)) {

                            echo "<option data-tokens='" . $row['sector'] . "'>" . $row['sector'] . "</option>";
                        }
                        ?>


                    </select>   
                </div>
            </div>
            <table id='iv_vol-table' class='table table-striped text-center table-bordered' >
                <thead>
                    <tr>
                        <?php
                        $sql = "SELECT ATM_vol,date FROM `nse_vol_nifty` order by date DESC limit 5";                                     //FETCHING ALL company namre from db
                        // $sql = "SELECT a.date,a.time,a.spot,AVG(a.ATM_vol) FROM (select date,time,spot,ATM_vol from `vol_axisbank` Group by date DESC LIMIT 1,5) a";
                        $result = mysqli_query($con, $sql);
                        $n = mysqli_num_rows($result);
                        /* if there is no search value in highlow_vol table then search in bliss_vol database */
                        $last_days_vol = array(0, 0, 0, 0, 0);
                        $m = 0;
                        if ($n > 0) {
                            while ($row = mysqli_fetch_row($result)) {                                     //inserting all fetch value to array
                                if ($row != null) {/* insert high data in array */
                                    $last_days_vol[$m] = $row[1];
                                    // $last_dat_date[$m] = $row[1];
                                    $m++;
                                    // $total_data = $total_data + 1;
                                }
                            }
                        }
                        echo "    
                            
                              <th class='col-lg-1'>Stock</th>
                                         <th class='col-lg-1'>Live IV</th>
                                                   <th class='col-lg-1'>BEP</th>
                                    <th class='col-lg-1'>IV Changes</th>
                                    <th class='col-lg-1'>Start IV <bR>(9:30 AM)</th>
    <th class='col-lg-1'>" . $result_date = date('d M', strtotime($last_days_vol[0])) . "</th>
         <th class='col-lg-1'>" . $result_date = date('d M', strtotime($last_days_vol[1])) . "</th>
             <th class='col-lg-1'> " . $result_date = date('d M', strtotime($last_days_vol[2])) . "</th>
                     <th class='col-lg-1'>" . $result_date = date('d M', strtotime($last_days_vol[3])) . "</th>
           <th class='col-lg-1'> " . $result_date = date('d M', strtotime($last_days_vol[4])) . "</th>
             
                       <th class='col-lg-1  sector'>Sector</th>
                            
                                   
                                    <th class='col-lg-1'>Result Date</th>
                                    <th class='col-lg-1'>Market <br>Capitalization</th>
                                    ";
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    /*   $result_eye2 = mysqli_query($con, "SELECT v1.*,v2.atm_vol as atm_vol,v3.Sector as Sector,v3.Market_Cap as Market_Cap FROM `iv_close5`  as v1 left join `iv_live` as v2 on v1.name = v2.c_name left join `companies` as v3 on v1.name = v3.c_name  where  v1.date = (select date from `iv_close5` order by id desc limit 1) and v1.time = (select time from `iv_close5` order by id desc limit 1) order by name ASC");
                      while ($row = mysqli_fetch_array($result_eye2)) {
                      $diff = $row['atm_vol'] - $row['bep'];
                      $result_date = date('d M Y', strtotime($row['result_date']));
                      if ($row['name'] == 'NIFTY' || $row['name'] == 'BANKNIFTY' || $row['name'] == 'NIFTYIT') {
                      $result_date = "-";
                      }
                      $name_for_link = str_replace("&", "_", $row['name']);
                      if ($row['nifty'] == 1) {
                      echo "    <tr>
                      <td >NIFTY50</td>
                      <td ><a href='BlissDelta_Data.php?%20search1=$name_for_link' target='_blank' name=" . $row['name'] . " >" . $row['name'] . "</a></td>
                      <td ></td>
                      <td ><span style='color: rgb(132,194,37);'>" . Round($row['bep'], 1) . "</span></td>
                      <td >" . Round($diff, 1) . "</td>
                      <td ><span style='color: rgb(132,194,37);'>" . Round($row['nse_close_vol'], 1) . "</span></td>

                      <td ><span style='color: rgb(132,194,37);'>" . Round($row['nse_close_vol2'], 1) . "</span> </td>
                      <td ><span style='color: rgb(132,194,37);'> " . Round($row['nse_close_vol3'], 1) . "</span></td>
                      <td ><span style='color: rgb(132,194,37);'>" . Round($row['nse_close_vol4'], 1) . "</span></td>
                      <td ><span style='color: rgb(132,194,37);'> " . Round($row['nse_close_vol5'], 1) . "</span></td>"
                      . "   <td ><span style='color: rgb(132,194,37);'> " . $row['Sector'] . "</span></td>     ";



                      if (date('Y', strtotime($result_date)) == 2019) {
                      echo "<td ><span style='color: rgb(132,194,37);'>" . $result_date . "</span> </td>";
                      } else {
                      echo "<td ><span style='color: rgb(132,194,37);'>~ " . date('M Y', strtotime('+3 month', strtotime($result_date))) . "</span> </td>";
                      }

                      echo " <td ><span style='color: rgb(132,194,37);'> " . $row['Market_Cap'] . "</span></td>   </tr>

                      ";
                      } else {
                      echo "    <tr>
                      <td ></td>
                      <td ><a href='BlissDelta_Data.php?%20search1=$name_for_link' target='_blank' name=" . $row['name'] . " >" . $row['name'] . "</s></td>
                      <td ><span onclick='showdata_daily_vol(" . $row['name'] . ");' name=" . $row['name'] . "  style='color: rgb(255,255,0); cursor: pointer'>" . Round($row['atm_vol'], 1) . "</span></td>
                      <td >" . Round($row['bep'], 1) . "</td>
                      <td >" . Round($diff, 1) . "</td>
                      <td >" . Round($row['nse_close_vol'], 1) . "</td>
                      <td >" . Round($row['nse_close_vol2'], 1) . " </td>
                      <td > " . Round($row['nse_close_vol3'], 1) . "</td>
                      <td >" . Round($row['nse_close_vol4'], 1) . "</td>
                      <td > " . Round($row['nse_close_vol5'], 1) . "</td>

                      <td > " . $row['Sector'] . "</td>

                      ";

                      if (date('Y', strtotime($result_date)) == 2019) {
                      echo "<td ><span >" . $result_date . "</span> </td>";
                      } else {
                      echo "<td ><span >~ " . date('M Y', strtotime('+3 month', strtotime($result_date))) . "</span> </td>";
                      }

                      echo "<td > " . $row['Market_Cap'] . "</td>    </tr>
                      ";
                      }
                      } */
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        $header_array = array('Stock', 'Sector', 'Market Capitalization', 'Result Update ', 'Closed Price', $quarter_pre['quarter'] . ' Movement %', $quarter['quarter'] . ' Movement %', 'Previous day vol', 'Live IV', $quarter_pre_month[0] . "-" . $quarter_pre['year'] . 'Q  Avg IV ', $quarter_month[0] . '-' . $quarter['year'] . ' Q IV Min-Avg-Max', $quarter_pre_month[0] . "-" . $quarter_pre['year'] . ' Q IV<br> Min-Avg-Max ', $quarter_last_month[0] . "-" . $quarter_last['year'] . ' Q IV Min-Avg-Max', '2017 Avg IV', '2016 Avg IV', '2015 Avg IV', 'date');
        $header_array = json_encode($header_array);
        // echo "<a href='IV_Download.php?array_header=". $header_array ."'><i class='fa fa-download'></i> Download</a>";
    } else {
        $header_array = array('Stock', 'Sector', 'Market Capitalization', 'Result Update ', 'Closed Price', $quarter_pre['quarter'] . ' Movement %', $quarter['quarter'] . ' Movement %', 'Previous day vol', 'Live IV', $quarter_pre_month[0] . "-" . $quarter_pre['year'] . 'Q  Avg IV ', $quarter_month[0] . '-' . $quarter['year'] . ' Q IV Min-Avg-Max', $quarter_pre_month[0] . "-" . $quarter_pre['year'] . ' Q IV<br> Min-Avg-Max ', $quarter_last_month[0] . "-" . $quarter_last['year'] . ' Q IV Min-Avg-Max', '2017 Avg IV', '2016 Avg IV', '2015 Avg IV', 'date');
        $header_array = json_encode($header_array);
        echo "";



        echo "<div class='col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 text-center'> 
    	<table class='table table-condensed'>
                   <tr>
                   <div class='panel-heading title_all text-center'> BlissQuants Analytics Data</div> 
                            <div class='panel-body'>        
                                                      
                                   The world is being re-shaped by the convergence of data and technology. You can have data without information, but you can't have information without data. <br><br>At BlissQuants, we gather loads of data related to stock market and works on it by the process of inspecting, transforming, and modeling data with the goal of discovering useful information to support decision-making. <br><br>We do believe that errors using inadequate data are much less than those using no data at all. By performing quantitative analysis of data, we provide useful information that helps you to take right trading decision fearlessly and confidently.<br>
                            </div>
                   </tr>
                   <tr>
                      <div class='col-lg-12 panel-heading text-center'> To Know more about this product, you need to <br><br> <form action='BlissAboutUs.php#collapseFive' method='post'>
                                
                                <input class='btn-lg btn-block text-center blink_me' type='submit'  name='request_button' value='Contact Us'>
                            </form></div></div>
                   </tr>
                   <tr><div> </div></tr>
                   <tr>
                      <div class='col-lg-12  text-center'>Below are available data products </div></div>
                   </tr>
                   <tr>
                       <td>
                           <a href='BlissEarnings.php' > <div class='panel-heading'>Companies' Result <i class='indicator glyphicon glyphicon-chevron-right  pull-right'></i> </div></a>
                            <div class='panel-body'>We collect historical stock price data on the result day, perform our data modeling techniques and project expected stock price change on the result day. This helps option and future traders to create a safe position in some predefined range as per projected stock movement pattern. </div>

                       </td>
                       <td>
                           <a href='BlissEventCalendar.php' >   <div class='panel-heading '>Financial Calendar <i class='indicator glyphicon glyphicon-chevron-right  pull-right'></i></div></a>
                            <div class='panel-body'>BlissCalendar shows the schedule of upcoming events like GDP data, FED meeting, earing season, or holiday; which helps stock and option traders to take right decision of entry, hold or exit on position. </div>
                                 
                       </td>
                   </tr>
                   
                   <tr>
					    <td>
                                    <a href='BlissIndiaVix.php' > <div class='panel-heading '>VIX -  Volatility Index   <i class='indicator glyphicon glyphicon-chevron-right  pull-right'></i></div></a>
                                          <div class='panel-body'>VIX movement has lot to say about its index movement and stock market trend. It’s an interesting analogy to explore about an upcoming big move of Indian and global stock market.    
                                            </div>

                                </td>
						 <td>
                           <a href='Bliss_Fii_Dii_Data.php' >   <div class='panel-heading '>Fii Dii Data <i class='indicator glyphicon glyphicon-chevron-right  pull-right'></i></div></a>
                      <div class='panel-body'> Implied volatility is an essential ingredient to the option pricing Black and Scholes model. We analyze historical IV of option and compute its peak and bottom. This greatly helps option delta hedgers to create and manage short and long gamma delta positions. <a href='BlissAboutUs.php#collapseFive' onclick='location.reload();'>Contact us</a>, for more details.   </div>

                       </td>
                                     
                      
                   </tr>
                   
                       
                          
                </table> 
                                     
                        <a href='#' data-toggle='modal' data-target='#Register-modal'><input class=' btn-lg btn-block text-center'  value='Request a Demo'></a>  

                    
   </div>
  ";
    }
    /* }else{
      echo " <div class='col-lg-12 panel-heading text-center'>This facility is not available in the basic plan. <a href='BlissPricing.php'> Please upgrade your IV analytics plan. </a>
      </div></div>";
      } */
    ?>




</div> 
<br>
<div class='disclaimer'>
    <div class='container'>
        <div class='row' style="font-size: 14px; color:black">
            <div class='col-lg-2 col-md-2 col-sm-2'>
                Disclaimer :
            </div>

            <div class=' col-lg-10 col-md-10 col-sm-10' >
                <marquee id='scroll_news'  onmouseout="document.getElementById('scroll_news').start();" onmouseover="document.getElementById('scroll_news').stop();"  >
                    <div  >
                        1. All historical data is referenced to NSE closed data. 
                        2. Live data may be delayed.
                        3. Green font indicates Nifty 50 Stocks.
                        4. White font indicates Non Nifty 50 Stocks.
                        5. '-' sign indicates no volume or ATM option trade.
                    </div>
                </marquee>
            </div>


        </div>
    </div>
</div> 
</body>
<script src="js/BlissDashboard.js"></script>

</html>
<?php
include("html/footer.html");

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
<?php
if (isset($_SESSION['email'])) {//echo $_SESSION['email'];
    if ($_SESSION['email'] == 'sfalguni.v@gmail.com' || $_SESSION['email'] == 'vineetjain495@gmail.com') {
        ?>
        <style>
            body{

                -webkit-user-select:auto;
                -khtml-user-select:auto;
                -moz-user-select:auto;
                -ms-user-select:auto;
                -o-user-select:auto;
                user-select:auto;

            }
        </style>
        <?php
    }
}
?>
