
<div class="row wrap">    

    <?php
    include_once('register.php');
    include_once("iv_functions.php");
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

    $quarter_pre = quarter_detail($date_pre);
    $quarter_last = quarter_detail($date_last);
    $quarter_month = $quarter['quarter'];
    $quarter_pre_month = $quarter_pre['quarter']; // explode("-", $quarter_pre['quarter']);
    $quarter_last_month = explode("-", $quarter_last['quarter']);

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
        <style>
            .tooltip {
                position: relative;
                display: inline-block;
                font-size: 36px;
            }

            .tooltip  {
                visibility: hidden;
                background-color: black;
                color: #fff!important;
                text-align: center;
                padding: 5px 0;
                border-radius: 6px;
                position: absolute;
                z-index: 1;
                width: 120px;
                top: 100%;
                left: 50%; 
                margin-left: -60px; 
                font-size: 12px;
            }

            .tooltip:hover {
                visibility: visible;
            }
        </style>
        <script>
            function hide_description()
            {
            $('.tooltips2').remove();
            }
            function show_description(){
            var st = "IV Data shows % difference of IV between close IV and Live IV";
            // $(this).data('tipText', title);
            $('<p class="tooltips2"></p>').html(st).appendTo('body').fadeIn(10);
            $(this).mousemove(function (e) {
            if (e.pageY < 350)
            {
            if (st.length > 2000)
            {
            var mousex = e.pageX + 20;
            //Get X coordinates
            var mousey = e.pageY - 250;
            //Get Y coordinates
            }
            else
            {
            var mousex = e.pageX + 20;
            //Get X coordinates
            var mousey = e.pageY + 10;
            //Get Y coordinates
            }
            }
            else
            {
            if (st.length > 1200)
            {
            var mousex = e.pageX + 20;
            //Get X coordinates
            var mousey = e.pageY - 300;
            //Get Y coordinates
            }
            else
            {
            var mousex = e.pageX + 20;
            //Get X coordinates
            var mousey = e.pageY - 100;
            //Get Y coordinates
            }
            }

            $('.tooltips2').css({
            top: mousey,
                    left: mousex
            });
            });
            }
        </script>
        <div class="col-lg-12 col-md-12 col-sm-12 text-center "> 
            <br>
            <div class="row title_all" >
                <div class="col-lg-8" >
                    <ul class="nav nav-tabs" style="border:none">  
                        <?php
                        if ($_SESSION['email'] !== 'sfalguni.v@gmail.com' || $_SESSION['email'] !== 'TUSSHAARR84@GMAIL.COM') {
                            echo "  <li  > <a href='days_avg' >IV Data</a></li> ";
                        }
                        ?>
                        <li  > <a href="days_long">Low IV</a></li> 
                        <li  > <a href="days_short">High IV</a></li> 





                        <h3>IV Analytics: 60 days Average</h3> 
                    </ul> 
                </div>


                <script>
                    $(document).ready(function(){

                    $('#mytooltip').tooltip();
                    // options set in JS by class


                    });
                    var curr_link;
                    //  var colour="black";
                    //alert(document.URL);
                    var splitname = document.URL.split("?", 1);
                    // alert(splitname);
                    for (var i = 0; i < document.links.length; i++) {



                    if (document.links[i].href == splitname) {
                    //  alert(document.links[i].style.color);
                    document.links[i].style.color = "white";
                    document.links[i].style.opacity = 1;
                    curr_link = document.links[i].href;
                    var filename = curr_link.substring(curr_link.lastIndexOf('/') + 1);
                    } else
                    {
                    //document.links[i].style.color = "#737373";

                    }
                    // document.getElementById("drop").style.color = "#000";
                    }
                </script>

                <div class="col-lg-2" >
                   <!-- <input class="form-control control_color_1" id="search1" name="search" autocomplete="off" placeholder="Search for " onKeyUp ="range_sel('IV_vol_connect.php');" required>-->
                    <select id="search1" name="search1" class="form-control control_color_1 selectpicker " placeholder="Search Scrip"  data-live-search="true">
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

                    <ul class="nav nav-tabs" style="border:none">                   



                        <li >
                            <select id="search2" name="search2" class="form-control control_color_1 selectpicker " placeholder="Search Scrip"  data-live-search="true">
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
                        </li>



                    </ul> 

                </div>   
                <div class="col-lg-2" >
                   <!-- <input class="form-control control_color_1" id="search1" name="search" autocomplete="off" placeholder="Search for " onKeyUp ="range_sel('IV_vol_connect.php');" required>-->
                    <select id="search_sector" name="search_sector" class="form-control control_color_1 selectpicker " placeholder="Search Scrip"  data-live-search="true">
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
                        echo "  
                                    <th class='col-lg-1'>Stock</th>
                                     <th class='col-lg-1'>Live IV </th>
                                      <th class='col-lg-1'>IV % Changes </th>
                                       <th class='col-lg-1'>60D Avg IV </th>
                                <th class='col-lg-1'>60 Days <br>Min-Avg-Max IV </th>
                                  <th class='col-lg-1'><span >  Closed IV <br>" . $last_updated . "</span></th>
                                     <th class='col-lg-1 sector'>Sector</th>
                                    <th class='col-lg-1'>Result <br> Update </th>
                                    <th class='col-lg-1'>Market <br> Capitalization </th>
                                 
 <th class='col-lg-1'> " . $quarter['quarter'] . "-" . $quarter['year'] . " FO<br> Movement %</th>
                                     <th class='col-lg-1'>" . $quarter_pre['quarter'] . "-" . $quarter_pre['year'] . " FO<br> Movement %</th>

                                   
                                   
                                      <th class='col-lg-1'>FO Closed Price  <br>" . $last_updated . "</th>
                                    
                                   
                                  
                                 
                                   ";
                        ?>
                    </tr>
                </thead>
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
                            </form> <br> Sample Data <a href='IV_Download.php?array_header=" . $header_array . "'><i class='fa fa-download'></i> Download</a></div></div>
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
    ?>

    <style>
        .blink_me{
            -webkit-animation: glowing 1500ms infinite;
            -moz-animation: glowing 1500ms infinite;
            -o-animation: glowing 1500ms infinite;
            animation: glowing 1500ms infinite;

        }
        @-webkit-keyframes glowing {
            0% { background-color: #FFFFFF; -webkit-box-shadow: 0 0 3px #FFFFFF; }
            50% { background-color: #000000; -webkit-box-shadow: 0 0 40px #000000; }
            100% { background-color: #FFFFFF; -webkit-box-shadow: 0 0 3px #FFFFFF; }
        }

        @-moz-keyframes glowing {
            0% { background-color: #FFFFFF; -moz-box-shadow: 0 0 3px #FFFFFF; }
            50% { background-color: #000000; -moz-box-shadow: 0 0 40px #000000; }
            100% { background-color: #FFFFFF; -moz-box-shadow: 0 0 3px #FFFFFF; }
        }

        @-o-keyframes glowing {
            0% { background-color: #FFFFFF; box-shadow: 0 0 3px #FFFFFF; }
            50% { background-color: #000000; box-shadow: 0 0 40px #000000; }
            100% { background-color: #FFFFFF; box-shadow: 0 0 3px #FFFFFF; }
        }

        @keyframes glowing {
            0% { background-color: #FFFFFF; box-shadow: 0 0 3px #FFFFFF; }
            50% { background-color: #000000; box-shadow: 0 0 40px #000000; }
            100% { background-color: #FFFFFF; box-shadow: 0 0 3px #FFFFFF; }
        }
    </style>
    <script>
        var curr_link;
        //  var colour="black";
        //alert(document.URL);
        /*  var splitname = document.URL.split("?", 1);
         //  alert(splitname);
         for (var i = 0; i < document.links.length; i++) {
         
         
         
         if (document.links[i].href == splitname) {
         
         
         document.links[i].style.color = "#FFF";
         document.links[2].style.color = "white";
         document.links[i].style.opacity = 1;
         
         
         
         }
         
         }*/

        function blinker()
        {
        $(‘.blink_me’).fadeOut(500);
        $(‘.blink_me’).fadeIn(500);
        }
        setInterval(blinker, 1000);
        function copyToClipboard() {


        var copyText = document.getElementById("search1");
        // copyText.setAttribute("id","dummy_id");
        document.getElementById("search1").value = " ";
        copyText.select();
        //alert("Fsd");
        document.execCommand("Copy");
        }


        $(document).ready(function () {
        $(window).keyup(function (e) {
        if (e.keyCode === 44) {
        // alert("f")
        // copyToClipboard();
        // $("body").hide();

        }

        });
        });
    </script>

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

<script src="js/BlissDashboard.js"></script>