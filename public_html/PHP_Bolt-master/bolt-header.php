<?php
/* $currentCookieParams = session_get_cookie_params(); 

  $rootDomain = '.blissquants.com';

  session_set_cookie_params(
  $currentCookieParams["lifetime"],
  $currentCookieParams["path"],
  $rootDomain,
  $currentCookieParams["secure"],
  $currentCookieParams["httponly"]
  ); */

session_start();
$_SERVER['REQUEST_URI'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (!isset($_SESSION['email'])) {
    header('Location: ../Bliss_Coaching.php');
    $_SESSION['error'] = "Please login for payment";
}
$path = "../";
/* include 'connect/user_individual_connect.php';
  $user_individual = new user_individual_connect(); */
?>


<html>

    <head>


        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /> 
        <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
        <meta name="description" content="BlissQuants is the Option delta hedging Trading, Training and Implied Volatility Data Analytics product company in Indian Derivatives market.">
        <meta name="keywords" content="Implied Volatility, IV, Vol, Volatility, Options, Historical, Data,option delta hedging, delta hedging coaching,delta hedging,implied volatility  training,
              Option Greek, Delta, Theta, Gamma, Vega, Average Volatility, Maximum, Max, Minimum, Min, Volatility, NSE, learning option Greeks,
              Future, Derivatives, Trading, Talk Delta, ODIN, Economic, Result, Quarterly, Implied Volatility movement, 
              IV Chart,Charts, IV Projection, FII, DII data, watchlist, Long Gamma, Short gamma, Training,Result Data, Time, India Vix, At the money, ATM, Option Strategies, Spread, Price movement, 
              Analysis, Analytic, Financial trading, Hedging">

        <link rel="shortcut icon" href="images/bliss_icon.ico" > <!-- Link for Bliss icon-->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'><!--for open seance font--> 
        <script src="js/jquery-1.9.1.js"></script> <!-- for changing scripts(slides)--> 
        <script src="js/jquery-1.10.2.js"></script> <!-- for changing scripts(slides)--> 
        <link rel="stylesheet" type="text/css" href="../bootstrap-3.3.4-dist/css/bootstrap.min.css" />
        <script src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>

        <link href="../font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"><!-- this link for a designing font on down-right side--> 

        <script src="../bootstrap-validator-master/js/validator.js"></script>
        <link rel="stylesheet" href="../css/jquery-ui.css">





        <link rel="stylesheet" type="text/css" href="../bootstrap-3.3.4-dist/css/custom.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>

            /* var IDLE_TIMEOUT = 2; //seconds
             var _idleSecondsCounter = 0;
             document.onclick = function () {
             _idleSecondsCounter = 0;
             };
             document.onmousemove = function () {
             _idleSecondsCounter = 0;
             };
             document.onkeypress = function () {
             _idleSecondsCounter = 0;
             };
             
             var myInterval = window.setInterval(CheckIdleTime, 1000000);
             
             function CheckIdleTime() {
             _idleSecondsCounter++;
             //var oPanel = document.getElementById("SecondsUntilExpire");
             
             if (_idleSecondsCounter >= IDLE_TIMEOUT) {
             
             window.clearInterval(myInterval);
             $.post('logout.php', {}, function (result)                       // retrive values from india vix table
             {
             alert("You are logged out");
             
             window.location.href = 'index.php';
             });
             //oPanel.innerHTML = ("Job Done");
             }
             }*/
            /*$(window).on('unload', function() {
             alert("dv");
             var URL = "logout.php";
             // var data = "bar";
             
             navigator.sendBeacon(URL);
             
             });
             /*window.onbeforeunload = function(){
             //Ajax request to update the database
             // alert("sdv");
             $.ajax({
             type: "POST",
             url: "logout.php"
             });
             };*/
            //$(document).ready(function () {

            /*     $(window).bind("beforeunload", function () {
             fnLogOut();
             
             });
             alert("vdfv");
             });
             function fnLogOut() { alert('browser closing'); }
             /* $(document).ready(function () {
             /*    $(window).keyup(function (e) {
             if (e.keyCode === 44) {
             copyToClipboard();
             // $("body").hide();
             
             }
             
             });
             $('#login-modal').on('shown.bs.modal', function() {
             alert("Fdsf");
             $(this).find('input:first').focus();
             });
             // alert("Fsd");
             /*    $('#login-modal').on('shown.bs.modal', function () {
             alert("Fsd");
             $('#logintext').focus();
             });
             });*/


            function detail_check() {

                em = document.getElementById('logintext').value;
                pw1 = document.getElementById('pw1').value;
                //alert(em);
                $.post('email_password_check.php', {em: em, pw1: pw1}, function (result) { //send data to blissdelta_delta_connect.php page
                    var obj = jQuery.parseJSON(result);
                    // alert(obj.b);
                    if (obj.b === "FREE")
                    {
                        window.location.href = 'BlissDelta_Data.php';
                    } else if (obj.a === "TRUE")
                    {
                        window.location.href = 'BlissDelta_Data.php';

                    } else {
                        alert(obj.a);
                        document.getElementById('pw1').value = "";
                        $('#pw1').focus();
                    }

                });
            }


        </script>
        <style>
            #flag{
                color: #000;
            }
            .ui-datepicker {
                background: #474545;

                color: #ff0000;
                width: 25%;
                height: 40%;
                font: Euromode;
                position: relative;
                z-index:1050 !important;

            }
            /*UI for selected date*/
            .ui-datepicker-calendar .ui-state-active {  
                background: #84C225; 
                display: none;
            }  
            /* UI for header*/
            .ui-datepicker-header {  
                font: Euromode;
                color: #FFFFFF;  
                font-weight: bold;  
                background:#4f4d4d;
                color: #84C225;

            } 
            /*UI for DAY name*/
            .ui-datepicker th {  

                color: #84C225;  
                background: #1a1919;
                font: Euromode;

            }  

            .circle {

                width: 100%;
                height: 40px;
                background: #ffffff;

            }
            #bar {
                background: #ffffff;
                border: 20px rgb(58, 53, 49);
                height: 100%;
                width: 100%;
                content: " ";
            }
            #score {
                height: 8px;
                width: 0;

            }
            #grade{
                font-size: 10px;
                width : 25px;
                color:black;
            }


            .form-signin
            {
                /*  //  max-width: 330px;*/
                padding: 15px;
                margin: 0 auto;
            }
            .form-signin .form-signin-heading, .form-signin .checkbox
            {
                margin-bottom: 10px;
            }
            .form-signin .checkbox
            {
                font-weight: normal;
            }
            .form-signin .form-control
            {
                position: relative;
                font-size: 16px;
                height: auto;
                padding: 10px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
            .form-signin .form-control:focus
            {
                z-index: 2;
            }
            .form-signin input[type="text"]
            {
                margin-bottom: -1px;
                border-bottom-left-radius: 0;
                border-bottom-right-radius: 0;
            }
            .form-signin input[type="password"]
            {
                margin-bottom: 0px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }
            #date-picker{
                z-index: 200;
            }
            .account-wall
            {
                margin-top: 5px;
                padding: 5px 0px 5px 0px;
                background-color: rgb(58,53,49);;
                -moz-box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
                -webkit-box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
                box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
            }
            .login-title
            {
                color: rgb(132,194,37);
                font-size: 18px;
                font-weight: 400;
                display: block;
            }
            .profile-img
            {
                width: 96px;
                height: 116px;
                margin: 0 auto 10px;
                display: block;
                -moz-border-radius: 50%;
                -webkit-border-radius: 50%;
                border-radius: 50%;
            }
            .need-help
            {
                margin-top: 10px;
            }
            .new-account
            {
                display: block;
                margin-top: 10px;
            }
            .btn-block{
                background-color: rgb(132,194,37);;
                background: linear-gradient(rgb(132,194,37), rgb(100,130,9));
                color: black;
                -moz-box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
                -webkit-box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
                box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
            }
            .dropdown-menu{
                padding: 0;
                width:100px;
            }
            .omb_btn-facebook {background: #3b5998;}
            .omb_btn-twitter {background: #00aced;}
            .omb_btn-google {background: #c32f10;}
            .modal-dialog{
                width:50%;
            }
            #hello{
                color:white;
            }
            a:visited {
                background-color: green;
            }
        </style>
    </style>
</head>

<body>

    <div class="" style='border-bottom: 1px solid #DDD;' role="navigation"> <!--This navbar class use for create navigation bar From bootstramp    -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><!-- for button pattorn -->
                Menu   
            </button> <!-- button over -->
            <a href="index.php">  <img class="navbar-brand" src="../images/BlissQuantsTM.jpg" alt="Bliss Image"></a> <!-- for link and image -->
        </div> 
        <div class="navbar-collapse collapse" > <!-- this is a unordered list class --> 
            <ul class="navbar-nav nav" id="main_navbar">    <!-- unordered list class-->          
                <li><a href="<?php echo $path; ?>index.php" >Home</a></li> <!-- this is Header list Option (1)Home --> 
                <li class="dropdown dropdown-large"><a href="<?php echo $path; ?>BlissData.php" >Analytics</a> <!-- This is Header list option(2)Option data and its class is dropdown --> 
                    <ul class="dropdown-menu dropdown-menu-large" >
                        <div class="row">
                            <li class="col-sm-4">
                                <ul>
                                    <li class="dropdown-header">IV Analytics</li>
                                    <?php
                                    $pre = "../";
                                    if (isset($_SESSION['email']) && ($_SESSION['email'] == 'vineetjain495@gmail.com' || $_SESSION['email'] == 'sfalguni.v@gmail.com' || $_SESSION['email'] == 'rupak.shah99@gmail.com' || $_SESSION['email'] == 'vedipatel99@gmail.com')) {
                                        ?>
                                        <li > <a href="<?php echo $path; ?>BlissData.php">IV Analytics: Quarterly Average  </a></li>
                                        <li  > <a href="<?php echo $path; ?>recommend_iv_all.php">IV Analytics: Hedgers' experience</a></li>
                                        <li  > <a href="<?php echo $path; ?>days_avg.php">IV Analytics: 60 days average</a></li>
                                        <li><a href="<?php echo $path; ?>next_day_gap.php" >IV Analytics: Next Day Gap Difference</a></li>
                                        <li><a href="<?php echo $path; ?>BlissVega_neutral.php" >IV Analytics: Vega Skew  </a></li>
                                        <li  > <a href="<?php echo $path; ?>iv2_short.php">IV Analytics: Last 3 similar months </a></li>
                                        <li  > <a href="<?php echo $path; ?>iv3_short.php">IV Analytics: Last 2 similar months </a></li>
                                        <li > <a href="<?php echo $path; ?>huge_gap.php"> IV Analytics: Huge Gap Difference</a></li>
                                        <li > <a href="<?php echo $path; ?>BlissIndexSpread.php"> IV Analytics: Index IV Skew</a></li>
                                        <li  > <a href="<?php echo $path; ?>BlissData_close.php">IV Analytics: Last 5 closed & BEP IV </a></li>
                                        <li  > <a href="<?php echo $path; ?>banknifty_butterfly.php">IV Analytics: Butterfly </a></li>
                                        <li  > <a href="<?php echo $path; ?>BlissOI.php">IV Analytics: Index OI </a></li>
                                        <li  > <a href="<?php echo $path; ?>get_collar.php">IV Analytics: Collar </a></li>
                                    <?php } elseif (isset($_SESSION['email']) && ($_SESSION['email'] == 'Shahnehalb.ns@gmail.com' )) {
                                        ?>

                                        <li  > <a href="<?php echo $path; ?>recommend_iv_all.php">IV Analytics: Hedgers' experience</a></li>
                                        <li  > <a href="<?php echo $path; ?>days_avg.php">IV Analytics: 60 days average</a></li>
                                        <li><a href="<?php echo $path; ?>next_day_gap.php" >IV Analytics: Next Day Gap Difference</a></li>

                                    <?php } elseif (isset($_SESSION['email']) && ($_SESSION['email'] == '1414details@gmail.com' )) {
                                        ?>

                                        <li > <a href="<?php echo $path; ?>BlissData.php">IV Analytics: Quarterly Average  </a></li>


                                        <li  > <a href="<?php echo $path; ?>iv3_short.php">IV Analytics: Last 2 similar months </a></li>

                                    <?php } elseif (isset($_SESSION['email']) && ($_SESSION['email'] == 'sfalguni.v@gmail.com' || $_SESSION['email'] == 'TUSSHAARR84@GMAIL.COM' )) {
                                        ?>

                                        <li  > <a href="<?php echo $path; ?>iv2_short.php">IV Analytics: Last 3 similar months </a></li>


                                        <li  > <a href="<?php echo $path; ?>days_avg.php">IV Analytics: 60 days average</a></li>

                                    <?php } elseif (isset($_SESSION['email']) && ($_SESSION['email'] == 'samir_dabhelia@yahoo.in' || $_SESSION['email'] == '2006maulik@gmail.com' || $_SESSION['email'] == 'alpeshkanadiya11@gmail.com' || $_SESSION['email'] == 'nileshghevariya@yahoo.com' || $_SESSION['email'] == 'falgunipro@blissquants.com')) {
                                        ?>

                                        <li > <a href="<?php echo $path; ?>BlissData.php">IV Analytics: Quarterly Average  </a></li>

                                        <li><a href="<?php echo $path; ?>next_day_gap.php" >IV Analytics: Next Day Gap Difference</a></li>

                                        <li  > <a href="<?php echo $path; ?>days_avg.php">IV Analytics: 60 days average</a></li>

                                        <li  > <a href="<?php echo $path; ?>BlissPricing.php">IV Analytics: Pricing </a></li>       
                                        <li  > <a href="<?php echo $path; ?>BlissData_close.php">IV Analytics: Last 5 closed & BEP IV  </a></li>

                                    <?php } else {
                                        ?>

                                        <li > <a href="<?php echo $path; ?>BlissData.php"> IV Analytics: Quarterly Average</a></li>
                                        <li > <a href="<?php echo $path; ?>huge_gap.php"> IV Analytics: IV Gap Difference</a></li>
                                        <li  > <a href="<?php echo $path; ?>BlissData2.php">IV Analytics: Last 3 similar months  </a></li>
                                        <li  > <a href="<?php echo $path; ?>BlissData_close.php">IV Analytics: Last 5 closed & BEP IV </a></li>
                                        <li > <a href="<?php echo $path; ?>BlissIndexSpread.php"> IV Analytics: Index Skew</a></li>
                                        <li><a href="<?php echo $path; ?>BlissDelta_Data.php" ><span style='color:yellow'>  IV Analytics: Dashboard  </span> </a></li>
                                        <li  > <a href="<?php echo $path; ?>BlissEye.php">IV: Chart Watchlist </a></li>
                                        <li  > <a href="<?php echo $path; ?>Blissoi.php">IV Analytics: Nifty OI </a></li>
                                        <li > <a href="<?php echo $path; ?>BlissData">IV Analytics: Quarterly Average  </a></li>

                                        <li  > <a href="<?php echo $path; ?>banknifty_butterfly.php">IV Analytics: Butterfly </a></li>


                                        <?php
                                    }
                                    ?>

                                    <li class="divider"></li>


                                </ul>
                            </li>
                            <li class="col-sm-4">
                                <ul>
                                    <li class="dropdown-header">IV Analytics</li>
                                    <li class="divider"></li>
                                    <?php
                                    if (isset($_SESSION['email']) && ($_SESSION['email'] == 'vineetjain495@gmail.com' || $_SESSION['email'] == 'rupak.shah99@gmail.com' || $_SESSION['email'] == 'vedipatel99@gmail.com' || $_SESSION['email'] == 'shahnehalb.ns@gmail.com')) {
                                        ?>




                                        <li  > <a href="<?php echo $path; ?>recommend_iv.php">IV Analytics: Hedgers' experience</a></li>
                                        <li  > <a href="<?php echo $path; ?>days_avg.php">IV Analytics: 60 days average</a></li>
                                        <li><a href="<?php echo $path; ?>BlissDelta_Data.php" > <span style='color:yellow'>  IV Analytics: Dashboard  </span></a></li>
                                        <li  > <a href="<?php echo $path; ?>BlissEye.php">IV: Chart Watchlist </a></li>
                                        <li  > <a href="<?php echo $path; ?>Watchlist.php">IV: Stock Watchlist </a></li>
                                        <li  > <a href="<?php echo $path; ?>BlissPricing.php">IV Analytics: Pricing </a></li> 
                                    <?php } elseif (isset($_SESSION['email']) && ( $_SESSION['email'] == 'samir_dabhelia@yahoo.in' || $_SESSION['email'] == 'sfalguni.v@gmail.com' || $_SESSION['email'] == '1414details@gmail.com' || $_SESSION['email'] == '2006maulik@gmail.com' || $_SESSION['email'] == 'alpeshkanadiya11@gmail.com' || $_SESSION['email'] == 'nileshghevariya@yahoo.com' || $_SESSION['email'] == 'falgunipro@blissquants.com')) { ?>



                                        <li><a href="<?php echo $path; ?>BlissDelta_Data.php" > <span style='color:yellow'>  IV Analytics: Dashboard  </span></a></li>
                                        <li  > <a href="<?php echo $path; ?>BlissEye.php">IV: Chart Watchlist </a></li>
                                        <li  > <a href="<?php echo $path; ?>Watchlist.php">IV: Stock Watchlist </a></li>


                                    <?php } else {
                                        ?>


                                        <li  > <a href="<?php echo $path; ?>Watchlist.php">IV: Stock Watchlist </a></li>
                                        <li  > <a href="<?php echo $path; ?>BlissPricing.php">IV Analytics: Pricing </a></li> 

                                        <?php
                                    }
                                    ?>

                                    <li class="divider"></li>


                                </ul>
                            </li>
                            <li class="col-sm-4">
                                <ul>
                                    <li class="dropdown-header">Data</li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo $path; ?>BlissEarnings.php">Result Data</a></li>
                                    <li><a href="<?php echo $path; ?>BlissEventCalendar.php">Economics Data</a></li>
                                    <li><a href="<?php echo $path; ?>Bliss_Fii_Dii_Data.php">FII / DII Data</a></li>
                                    <li><a href="<?php echo $path; ?>BlissIndiaVix.php">IndiaVIX / Nifty Charts</a></li>
                                    <li><a href="<?php echo $path; ?>cboe_vix.php">IndiaVIX / CBOEVIX Charts</a></li>

                                    <li class="divider"></li>

                                </ul>
                            </li>
                            <li class=" " > 

                            </li>
                        </div>
                        <div class="row footer_header">    

                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="navbar-text" >
                                        Support : +91 9898032020
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href='#' data-toggle='modal' data-target='#Register-modal'><input class=' btn-lg btn-block text-center'  value='Request a Demo'></a>
                                </div>
                            </div>     
                            <div class="col-lg-4 col-md-4 col-sm-4">

                                <ul class="social-network social-circle pull-right">
                                    <li style="display: inline"> Follow us :</li>
                                    <li style="display: inline"><a href="https://www.facebook.com/blissquants" target="_blank" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <!--<li style="display: inline"><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li> -->
                                    <li style="display: inline"><a href="https://plus.google.com/u/0/104418184884371093173" target="_blank" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                    <li style="display: inline"><a href="https://www.linkedin.com/company/10313538" target="_blank" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                </ul>	
                            </div>




                        </div>
                    </ul>

                </li>
                <li class="dropdown dropdown-large"><a href="<?php echo $path; ?>Solutions.php" >Solutions</a> <!-- This is Header list option(2)Option data and its class is dropdown --> 
                    <ul class="dropdown-menu dropdown-menu-large ">
                        <div class="row">
                            <li class="col-sm-6">
                                <ul>
                                    <li class="dropdown-header">Analytics</li>
                                    <li class="divider"></li>

                                    <li  > <a href="<?php echo $path; ?>Solutions.php" > IV Analytics </a></li>
                                    <li  > <a href="<?php echo $path; ?>Solutions_DashBoard.php" > IV DashBoard </a></li>

                                    <li > <a href="<?php echo $path; ?>Solutions_training.php" > Delta Hedging Training </a></li>
                                    <li > <a href="<?php echo $path; ?>BlissKB.php" > Knowledge Base </a></li>


                                    <li class="divider"></li>


                                </ul>
                            </li>


                            <li class="col-sm-6">
                                <ul>
                                    <li class="dropdown-header">Tools</li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo $path; ?>BlissMarginCalculator.php">Margin Calculator</a></li>
                                    <li><a href="<?php echo $path; ?>BlissOptionCalculator.php">Option Calculator</a></li>
                                    <li><a href="<?php echo $path; ?>BlissIV_projection.php">IV Projection</a></li>
                                    <li><a href="<?php echo $path; ?>BlissIntraday.php">Historical IV</a></li>
                                    <li><a href="<?php echo $path; ?>BlissVol.php">IV HeatMap</a></li>
                                    <li><a  href="<?php echo $path; ?>BlissCalc_Alpha40_final.xls">BlissCalc</a></li><!--This is BlissCalc option in Products  -->
                                    <li class="divider"></li>
                                </ul>
                            </li>
                            <!--  <li class="col-sm-4">
                                   <ul>
                                       <li class="dropdown-header">Reports</li>
                                       <li class="divider"></li>
                                       <li><a href="Bliss_Daily_Data_table_admin.php">M2M</a></li>
                                       <li><a href="SmartDelta5.php">10% Up Down </a></li>
                                       <li><a href="SmartDelta3.php">Individual M2M</a></li>
                                      
       
                                       <li class="divider"></li>
                                   </ul>
                               </li>-->
                        </div>
                        <div class="row footer_header">    

                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="col-lg-6  col-md-6 col-sm-6">
                                    <div class="navbar-text" >
                                        Support : +91 9898032020
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href='#' data-toggle='modal' data-target='#Register-modal'><input class=' btn-lg btn-block text-center'  value='Request a Demo'></a> 
                                </div>

                            </div>     
                            <div class="col-lg-4 col-md-4 col-sm-4">

                                <ul class="social-network social-circle pull-right">

                                    <li style="display: inline"> Follow us :</li>
                                    <li style="display: inline"><a href="https://www.facebook.com/blissquants" target="_blank" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <!--<li style="display: inline"><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li> -->
                                    <li style="display: inline"><a href="https://plus.google.com/u/0/104418184884371093173" target="_blank" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                    <li style="display: inline"><a href="https://www.linkedin.com/company/10313538" target="_blank" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                </ul>	
                            </div>




                        </div>
                    </ul>

                </li>

                <li class="dropdown dropdown-large"><a href="<?php echo $path; ?>Bliss_Services.php">Services</a><!--This is Header list option (6)About there are use of dropdown clas  -->
                    <ul class="dropdown-menu dropdown-menu-large ">
                        <div class="row">
                            <li class="col-sm-12">
                                <ul>
                                    <li class="dropdown-header">Services</li>
                                    <li class="divider"></li>

                                    <li  > <a href="<?php echo $path; ?>Bliss_Services.php" > Software Development </a></li>
                                    <li  > <a href="<?php echo $path; ?>Bliss_Coaching.php" > Teaching Courses </a></li>
                                    <li > <a href="<?php echo $path; ?>Delta_awareness_program.php" > Option Delta Hedging Awareness Program </a></li>
                                    <li class="divider"></li>


                                </ul>
                            </li>



                        </div>
                        <div class="row footer_header">    

                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="col-lg-6  col-md-6 col-sm-6">
                                    <div class="navbar-text" >
                                        Support : +91 9898032020
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href='#' data-toggle='modal' data-target='#Register-modal'><input class=' btn-lg btn-block text-center'  value='Request a Demo'></a> 
                                </div>

                            </div>     
                            <div class="col-lg-4 col-md-4 col-sm-4">

                                <ul class="social-network social-circle pull-right">

                                    <li style="display: inline"> Follow us :</li>
                                    <li style="display: inline"><a href="https://www.facebook.com/blissquants" target="_blank" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <!--<li style="display: inline"><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li> -->
                                    <li style="display: inline"><a href="https://plus.google.com/u/0/104418184884371093173" target="_blank" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                    <li style="display: inline"><a href="https://www.linkedin.com/company/10313538" target="_blank" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                </ul>	
                            </div>




                        </div>
                    </ul>
                </li>
                <li ><a href="BlissAboutUs.php#collapseOne">About</a><!--This is Header list option (6)About there are use of dropdown clas  -->

                </li> 
                <li class="header_tag">
                    <a id="hello" style="display:none;" value = "" class="blink"> </a>
                </li>

                <script>
                    var curr_link;
                    //  var colour="black";
                    //alert(document.URL);
                    var splitname = document.URL.split("?", 1);
                    //  alert(splitname);
                    for (var i = 0; i < document.links.length; i++) {



                        if (document.links[i].href == splitname) {

                            document.links[i].style.color = "white";
                            if (i > 2 && i < 17) {
                                document.links[2].style.color = "white";
                            } else if (i > 16 && i < 25) {
                                document.links[17].style.color = "white";
                            }
                            document.links[i].style.opacity = 1;
                            curr_link = document.links[i].href;
//alert(curr_link);
                            var filename = curr_link.substring(curr_link.lastIndexOf('/') + 1);

                        } else
                        {
                            //document.links[i].style.color = "#737373";

                        }
                        // document.getElementById("drop").style.color = "#000";
                    }
                </script>
                <?php if (!isset($_SESSION['user_id'])) {
                    ?>     
                    <li id="signInDropdown" class="dropdown navbar-right">                        
                        <a href="#" data-toggle="modal" data-target="#Register-modal">Register</a>  

                    </li>
                    <li  class="dropdown navbar-right">

                        <a href="#" data-toggle="modal" data-target="#login-modal">Login</a>  


                    </li>


                    <?php
                } else {
                    ?> 
                    <li  class="dropdown navbar-right"><a>
                            <?php
                            if (isset($_SESSION['leader'])) {
                                echo "" . $_SESSION['leader'];
                            } else if (isset($_SESSION['admin'])) {
                                echo "" . $_SESSION['admin'];
                            } else {
                                echo "" . $_SESSION['user_id'];
                            }
                            ?></a></li>
                    <li  class="dropdown navbar-right">
                        <a href=""><span class="glyphicon glyphicon-chevron-down"></span></a>
                        <ul class="dropdown-menu " ><!--This is Unordered list of dropdown menu class of About  -->
                            <li class="text-right" > <a href="#" data-toggle="modal"  data-target="#change-modal">Change Password</a></li>
                            <li class="text-right"><a  href='../logout.php'>Logout</a></li>

                        </ul>
                    </li>

                <?php }
                ?>  
            </ul>    


        </div>    

    </div>

    <div class="modal" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-header">
            <h3 class='text-center'>Login to BlissQuants IV Analytics</h3>
        </div>
        <div class="modal-dialog" style="width: 30%">

            <div class="account-wall">
                <img class="profile-img" src="images/bliss_tree_transpraent.gif"
                     alt="">
                <form class="form-signin" name="login" method="post" action="javascript:detail_check()">
                    <input type="text" name="em" class="form-control" placeholder="Email Or Username" id="logintext" required autofocus><br>



                    <input type="password" name="pw1" id="pw1" class="form-control" placeholder="Password" required><br>
                    <button class="btn btn-lg btn-block" type="submit"  >
                        Sign in
                    </button>


                </form>  
                <button class="btn btn-lg btn-block" type="submit" name="forget" onclick="window.location = 'forget_password.php'">Forget password</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-header">
            <h3 class='text-center'>Register to BlissQuants IV Analytics</h3>
        </div>
        <div class="modal-dialog">

            <div class="account-wall">

                <!--     <div class="col-xs-4 col-sm-2 col-lg-8 col-md-offset-2 text-center">
                      
                                 <a href="#" class=" btn-lg btn-block omb_btn-facebook">
                                         <i class="fa fa-facebook visible-xs"></i>
                                         <span class="hidden-xs">Register with Facebook</span>
                                 </a>
                         </div>
                         

            <br>
            <br> 
                 <P> OR </p>-->
                <form name="register" action="register_connect.php" data-toggle="validator" role="form" method="post" class="form-signin text-center" >
                    <div class="row">

                        <div class="col-xs-6 col-sm-6 col-lg-6 form-group">
                            <input   class="form-control"   name="name" id="inputName" placeholder="Enter your Full Name" data-error="please Enter your name" required> 
                            <div class="help-block with-errors"></div>
                        </div>



                        <div class="col-xs-6 col-sm-6 col-lg-6 form-group"> 
                            <input type="tel" class="form-control"   name="mobile" id="UserMobile"  placeholder="Mobile Number" pattern="^\d{10}$"  data-error="please enter valid mobile number(10 digit)"  required>
                            <div class="help-block with-errors"></div>
                        </div>


                    </div> 
                    <br>
                    <div class="row ">

                        <div class="col-xs-6 col-sm-6 col-lg-6 form-group"> 
                            <input type="email" class="form-control" name="em" id="inputEmail" placeholder="Email"  data-error="email address is invalid" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-lg-6 form-group"> 
                            <input  class="form-control"   name="company"  placeholder="Company" data-error="please fill the name of company" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-lg-6 ">
                            <div class="col-lg-12  form-group" style='padding: 0'><input type="password"  data-minlength="6" id="inputPassword" class="form-control"   name="pw1"  placeholder="Password"> 
                                <!--    </div><div class="col-lg-2" style='padding: 3px'> <div class="circle"><div id="score"></div><div id="grade">strength</div> </div> 
                                -->
                                <div class="help-block">Minimum of 6 characters</div>
                            </div>   
                        </div>
                        <div class="col-xs-6 col-sm-6 col-lg-6  form-group"> 
                            <input type="password" class="form-control"  name="pw2" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match"  placeholder="Confirm your Password" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> 
                    <br>
                    <div class="row form-group">
                        <div class="col-xs-6 col-sm-6 col-lg-6  form-group">
                            <select name="countries" class="form-control" id="countries" >
                                <option value='ad' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ad" data-title="Andorra">Andorra</option>
                                <option value='ae' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ae" data-title="United Arab Emirates">United Arab Emirates</option>
                                <option value='af' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag af" data-title="Afghanistan">Afghanistan</option>
                                <option value='ag' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ag" data-title="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value='ai' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ai" data-title="Anguilla">Anguilla</option>
                                <option value='al' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag al" data-title="Albania">Albania</option>
                                <option value='am' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag am" data-title="Armenia">Armenia</option>
                                <option value='an' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag an" data-title="Netherlands Antilles">Netherlands Antilles</option>
                                <option value='ao' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ao" data-title="Angola">Angola</option>
                                <option value='aq' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag aq" data-title="Antarctica">Antarctica</option>
                                <option value='ar' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ar" data-title="Argentina">Argentina</option>
                                <option value='as' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag as" data-title="American Samoa">American Samoa</option>
                                <option value='at' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag at" data-title="Austria">Austria</option>
                                <option value='au' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag au" data-title="Australia">Australia</option>
                                <option value='aw' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag aw" data-title="Aruba">Aruba</option>
                                <option value='ax' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ax" data-title="Aland Islands">Aland Islands</option>
                                <option value='az' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag az" data-title="Azerbaijan">Azerbaijan</option>
                                <option value='ba' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ba" data-title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value='bb' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bb" data-title="Barbados">Barbados</option>
                                <option value='bd' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bd" data-title="Bangladesh">Bangladesh</option>
                                <option value='be' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag be" data-title="Belgium">Belgium</option>
                                <option value='bf' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bf" data-title="Burkina Faso">Burkina Faso</option>
                                <option value='bg' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bg" data-title="Bulgaria">Bulgaria</option>
                                <option value='bh' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bh" data-title="Bahrain">Bahrain</option>
                                <option value='bi' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bi" data-title="Burundi">Burundi</option>
                                <option value='bj' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bj" data-title="Benin">Benin</option>
                                <option value='bm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bm" data-title="Bermuda">Bermuda</option>
                                <option value='bn' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bn" data-title="Brunei Darussalam">Brunei Darussalam</option>
                                <option value='bo' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bo" data-title="Bolivia">Bolivia</option>
                                <option value='br' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag br" data-title="Brazil">Brazil</option>
                                <option value='bs' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bs" data-title="Bahamas">Bahamas</option>
                                <option value='bt' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bt" data-title="Bhutan">Bhutan</option>
                                <option value='bv' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bv" data-title="Bouvet Island">Bouvet Island</option>
                                <option value='bw' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bw" data-title="Botswana">Botswana</option>
                                <option value='by' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag by" data-title="Belarus">Belarus</option>
                                <option value='bz' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag bz" data-title="Belize">Belize</option>
                                <option value='ca' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ca" data-title="Canada">Canada</option>
                                <option value='cc' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cc" data-title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value='cd' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cd" data-title="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                <option value='cf' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cf" data-title="Central African Republic">Central African Republic</option>
                                <option value='cg' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cg" data-title="Congo">Congo</option>
                                <option value='ch' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ch" data-title="Switzerland">Switzerland</option>
                                <option value='ci' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ci" data-title="Cote D'Ivoire (Ivory Coast)">Cote D'Ivoire (Ivory Coast)</option>
                                <option value='ck' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ck" data-title="Cook Islands">Cook Islands</option>
                                <option value='cl' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cl" data-title="Chile">Chile</option>
                                <option value='cm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cm" data-title="Cameroon">Cameroon</option>
                                <option value='cn' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cn" data-title="China">China</option>
                                <option value='co' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag co" data-title="Colombia">Colombia</option>
                                <option value='cr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cr" data-title="Costa Rica">Costa Rica</option>
                                <option value='cs' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cs" data-title="Serbia and Montenegro">Serbia and Montenegro</option>
                                <option value='cu' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cu" data-title="Cuba">Cuba</option>
                                <option value='cv' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cv" data-title="Cape Verde">Cape Verde</option>
                                <option value='cx' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cx" data-title="Christmas Island">Christmas Island</option>
                                <option value='cy' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cy" data-title="Cyprus">Cyprus</option>
                                <option value='cz' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cz" data-title="Czech Republic">Czech Republic</option>
                                <option value='de' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag de" data-title="Germany">Germany</option>
                                <option value='dj' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag dj" data-title="Djibouti">Djibouti</option>
                                <option value='dk' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag dk" data-title="Denmark">Denmark</option>
                                <option value='dm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag dm" data-title="Dominica">Dominica</option>
                                <option value='do' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag do" data-title="Dominican Republic">Dominican Republic</option>
                                <option value='dz' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag dz" data-title="Algeria">Algeria</option>
                                <option value='ec' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ec" data-title="Ecuador">Ecuador</option>
                                <option value='ee' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ee" data-title="Estonia">Estonia</option>
                                <option value='eg' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag eg" data-title="Egypt">Egypt</option>
                                <option value='eh' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag eh" data-title="Western Sahara">Western Sahara</option>
                                <option value='er' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag er" data-title="Eritrea">Eritrea</option>
                                <option value='es' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag es" data-title="Spain">Spain</option>
                                <option value='et' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag et" data-title="Ethiopia">Ethiopia</option>
                                <option value='fi' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag fi" data-title="Finland">Finland</option>
                                <option value='fj' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag fj" data-title="Fiji">Fiji</option>
                                <option value='fk' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag fk" data-title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value='fm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag fm" data-title="Federated States of Micronesia">Federated States of Micronesia</option>
                                <option value='fo' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag fo" data-title="Faroe Islands">Faroe Islands</option>
                                <option value='fr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag fr" data-title="France">France</option>
                                <option value='fx' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag fx" data-title="France, Metropolitan">France, Metropolitan</option>
                                <option value='ga' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ga" data-title="Gabon">Gabon</option>
                                <option value='gb' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gb" data-title="Great Britain (UK)">Great Britain (UK)</option>
                                <option value='gd' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gd" data-title="Grenada">Grenada</option>
                                <option value='ge' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ge" data-title="Georgia">Georgia</option>
                                <option value='gf' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gf" data-title="French Guiana">French Guiana</option>
                                <option value='gh' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gh" data-title="Ghana">Ghana</option>
                                <option value='gi' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gi" data-title="Gibraltar">Gibraltar</option>
                                <option value='gl' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gl" data-title="Greenland">Greenland</option>
                                <option value='gm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gm" data-title="Gambia">Gambia</option>
                                <option value='gn' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gn" data-title="Guinea">Guinea</option>
                                <option value='gp' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gp" data-title="Guadeloupe">Guadeloupe</option>
                                <option value='gq' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gq" data-title="Equatorial Guinea">Equatorial Guinea</option>
                                <option value='gr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gr" data-title="Greece">Greece</option>
                                <option value='gs' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gs" data-title="S. Georgia and S. Sandwich Islands">S. Georgia and S. Sandwich Islands</option>
                                <option value='gt' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gt" data-title="Guatemala">Guatemala</option>
                                <option value='gu' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gu" data-title="Guam">Guam</option>
                                <option value='gw' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gw" data-title="Guinea-Bissau">Guinea-Bissau</option>
                                <option value='gy' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag gy" data-title="Guyana">Guyana</option>
                                <option value='hk' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag hk" data-title="Hong Kong">Hong Kong</option>
                                <option value='hm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag hm" data-title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                <option value='hn' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag hn" data-title="Honduras">Honduras</option>
                                <option value='hr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag hr" data-title="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                                <option value='ht' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ht" data-title="Haiti">Haiti</option>
                                <option value='hu' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag hu" data-title="Hungary">Hungary</option>
                                <option value='id' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag id" data-title="Indonesia">Indonesia</option>
                                <option value='ie' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ie" data-title="Ireland">Ireland</option>
                                <option value='il' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag il" data-title="Israel">Israel</option>
                                <option value='in' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag in" data-title="India" selected="selected">India</option>
                                <option value='io' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag io" data-title="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value='iq' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag iq" data-title="Iraq">Iraq</option>
                                <option value='ir' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ir" data-title="Iran">Iran</option>
                                <option value='is' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag is" data-title="Iceland">Iceland</option>
                                <option value='it' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag it" data-title="Italy">Italy</option>
                                <option value='jm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag jm" data-title="Jamaica">Jamaica</option>
                                <option value='jo' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag jo" data-title="Jordan">Jordan</option>
                                <option value='jp' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag jp" data-title="Japan">Japan</option>
                                <option value='ke' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ke" data-title="Kenya">Kenya</option>
                                <option value='kg' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag kg" data-title="Kyrgyzstan">Kyrgyzstan</option>
                                <option value='kh' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag kh" data-title="Cambodia">Cambodia</option>
                                <option value='ki' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ki" data-title="Kiribati">Kiribati</option>
                                <option value='km' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag km" data-title="Comoros">Comoros</option>
                                <option value='kn' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag kn" data-title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value='kp' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag kp" data-title="Korea (North)">Korea (North)</option>
                                <option value='kr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag kr" data-title="Korea (South)">Korea (South)</option>
                                <option value='kw' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag kw" data-title="Kuwait">Kuwait</option>
                                <option value='ky' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ky" data-title="Cayman Islands">Cayman Islands</option>
                                <option value='kz' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag kz" data-title="Kazakhstan">Kazakhstan</option>
                                <option value='la' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag la" data-title="Laos">Laos</option>
                                <option value='lb' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag lb" data-title="Lebanon">Lebanon</option>
                                <option value='lc' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag lc" data-title="Saint Lucia">Saint Lucia</option>
                                <option value='li' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag li" data-title="Liechtenstein">Liechtenstein</option>
                                <option value='lk' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag lk" data-title="Sri Lanka">Sri Lanka</option>
                                <option value='lr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag lr" data-title="Liberia">Liberia</option>
                                <option value='ls' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ls" data-title="Lesotho">Lesotho</option>
                                <option value='lt' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag lt" data-title="Lithuania">Lithuania</option>
                                <option value='lu' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag lu" data-title="Luxembourg">Luxembourg</option>
                                <option value='lv' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag lv" data-title="Latvia">Latvia</option>
                                <option value='ly' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ly" data-title="Libya">Libya</option>
                                <option value='ma' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ma" data-title="Morocco">Morocco</option>
                                <option value='mc' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mc" data-title="Monaco">Monaco</option>
                                <option value='md' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag md" data-title="Moldova">Moldova</option>
                                <option value='mg' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mg" data-title="Madagascar">Madagascar</option>
                                <option value='mh' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mh" data-title="Marshall Islands">Marshall Islands</option>
                                <option value='mk' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mk" data-title="Macedonia">Macedonia</option>
                                <option value='ml' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ml" data-title="Mali">Mali</option>
                                <option value='mm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mm" data-title="Myanmar">Myanmar</option>
                                <option value='mn' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mn" data-title="Mongolia">Mongolia</option>
                                <option value='mo' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mo" data-title="Macao">Macao</option>
                                <option value='mp' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mp" data-title="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value='mq' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mq" data-title="Martinique">Martinique</option>
                                <option value='mr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mr" data-title="Mauritania">Mauritania</option>
                                <option value='ms' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ms" data-title="Montserrat">Montserrat</option>
                                <option value='mt' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mt" data-title="Malta">Malta</option>
                                <option value='mu' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mu" data-title="Mauritius">Mauritius</option>
                                <option value='mv' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mv" data-title="Maldives">Maldives</option>
                                <option value='mw' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mw" data-title="Malawi">Malawi</option>
                                <option value='mx' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mx" data-title="Mexico">Mexico</option>
                                <option value='my' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag my" data-title="Malaysia">Malaysia</option>
                                <option value='mz' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag mz" data-title="Mozambique">Mozambique</option>
                                <option value='na' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag na" data-title="Namibia">Namibia</option>
                                <option value='nc' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag nc" data-title="New Caledonia">New Caledonia</option>
                                <option value='ne' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ne" data-title="Niger">Niger</option>
                                <option value='nf' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag nf" data-title="Norfolk Island">Norfolk Island</option>
                                <option value='ng' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ng" data-title="Nigeria">Nigeria</option>
                                <option value='ni' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ni" data-title="Nicaragua">Nicaragua</option>
                                <option value='nl' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag nl" data-title="Netherlands">Netherlands</option>
                                <option value='no' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag no" data-title="Norway">Norway</option>
                                <option value='np' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag np" data-title="Nepal">Nepal</option>
                                <option value='nr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag nr" data-title="Nauru">Nauru</option>
                                <option value='nu' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag nu" data-title="Niue">Niue</option>
                                <option value='nz' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag nz" data-title="New Zealand (Aotearoa)">New Zealand (Aotearoa)</option>
                                <option value='om' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag om" data-title="Oman">Oman</option>
                                <option value='pa' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag pa" data-title="Panama">Panama</option>
                                <option value='pe' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag pe" data-title="Peru">Peru</option>
                                <option value='pf' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag pf" data-title="French Polynesia">French Polynesia</option>
                                <option value='pg' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag pg" data-title="Papua New Guinea">Papua New Guinea</option>
                                <option value='ph' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ph" data-title="Philippines">Philippines</option>
                                <option value='pk' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag pk" data-title="Pakistan">Pakistan</option>
                                <option value='pl' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag pl" data-title="Poland">Poland</option>
                                <option value='pm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag pm" data-title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value='pn' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag pn" data-title="Pitcairn">Pitcairn</option>
                                <option value='pr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag pr" data-title="Puerto Rico">Puerto Rico</option>
                                <option value='ps' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ps" data-title="Palestinian Territory">Palestinian Territory</option>
                                <option value='pt' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag pt" data-title="Portugal">Portugal</option>
                                <option value='pw' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag pw" data-title="Palau">Palau</option>
                                <option value='py' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag py" data-title="Paraguay">Paraguay</option>
                                <option value='qa' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag qa" data-title="Qatar">Qatar</option>
                                <option value='re' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag re" data-title="Reunion">Reunion</option>
                                <option value='ro' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ro" data-title="Romania">Romania</option>
                                <option value='ru' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ru" data-title="Russian Federation">Russian Federation</option>
                                <option value='rw' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag rw" data-title="Rwanda">Rwanda</option>
                                <option value='sa' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sa" data-title="Saudi Arabia">Saudi Arabia</option>
                                <option value='sb' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sb" data-title="Solomon Islands">Solomon Islands</option>
                                <option value='sc' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sc" data-title="Seychelles">Seychelles</option>
                                <option value='sd' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sd" data-title="Sudan">Sudan</option>
                                <option value='se' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag se" data-title="Sweden">Sweden</option>
                                <option value='sg' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sg" data-title="Singapore">Singapore</option>
                                <option value='sh' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sh" data-title="Saint Helena">Saint Helena</option>
                                <option value='si' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag si" data-title="Slovenia">Slovenia</option>
                                <option value='sj' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sj" data-title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value='sk' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sk" data-title="Slovakia">Slovakia</option>
                                <option value='sl' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sl" data-title="Sierra Leone">Sierra Leone</option>
                                <option value='sm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sm" data-title="San Marino">San Marino</option>
                                <option value='sn' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sn" data-title="Senegal">Senegal</option>
                                <option value='so' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag so" data-title="Somalia">Somalia</option>
                                <option value='sr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sr" data-title="Suriname">Suriname</option>
                                <option value='st' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag st" data-title="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value='su' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag su" data-title="USSR (former)">USSR (former)</option>
                                <option value='sv' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sv" data-title="El Salvador">El Salvador</option>
                                <option value='sy' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sy" data-title="Syria">Syria</option>
                                <option value='sz' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag sz" data-title="Swaziland">Swaziland</option>
                                <option value='tc' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tc" data-title="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value='td' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag td" data-title="Chad">Chad</option>
                                <option value='tf' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tf" data-title="French Southern Territories">French Southern Territories</option>
                                <option value='tg' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tg" data-title="Togo">Togo</option>
                                <option value='th' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag th" data-title="Thailand">Thailand</option>
                                <option value='tj' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tj" data-title="Tajikistan">Tajikistan</option>
                                <option value='tk' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tk" data-title="Tokelau">Tokelau</option>
                                <option value='tl' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tl" data-title="Timor-Leste">Timor-Leste</option>
                                <option value='tm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tm" data-title="Turkmenistan">Turkmenistan</option>
                                <option value='tn' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tn" data-title="Tunisia">Tunisia</option>
                                <option value='to' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag to" data-title="Tonga">Tonga</option>
                                <option value='tp' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tp" data-title="East Timor">East Timor</option>
                                <option value='tr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tr" data-title="Turkey">Turkey</option>
                                <option value='tt' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tt" data-title="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value='tv' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tv" data-title="Tuvalu">Tuvalu</option>
                                <option value='tw' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tw" data-title="Taiwan">Taiwan</option>
                                <option value='tz' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tz" data-title="Tanzania">Tanzania</option>
                                <option value='ua' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ua" data-title="Ukraine">Ukraine</option>
                                <option value='ug' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ug" data-title="Uganda">Uganda</option>
                                <option value='uk' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag uk" data-title="United Kingdom">United Kingdom</option>
                                <option value='um' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag um" data-title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value='us' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">United States</option>
                                <option value='uy' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag uy" data-title="Uruguay">Uruguay</option>
                                <option value='uz' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag uz" data-title="Uzbekistan">Uzbekistan</option>
                                <option value='va' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag va" data-title="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
                                <option value='vc' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag vc" data-title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                <option value='ve' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ve" data-title="Venezuela">Venezuela</option>
                                <option value='vg' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag vg" data-title="Virgin Islands (British)">Virgin Islands (British)</option>
                                <option value='vi' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag vi" data-title="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                                <option value='vn' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag vn" data-title="Viet Nam">Viet Nam</option>
                                <option value='vu' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag vu" data-title="Vanuatu">Vanuatu</option>
                                <option value='wf' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag wf" data-title="Wallis and Futuna">Wallis and Futuna</option>
                                <option value='ws' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ws" data-title="Samoa">Samoa</option>
                                <option value='ye' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ye" data-title="Yemen">Yemen</option>
                                <option value='yt' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag yt" data-title="Mayotte">Mayotte</option>
                                <option value='yu' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag yu" data-title="Yugoslavia (former)">Yugoslavia (former)</option>
                                <option value='za' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag za" data-title="South Africa">South Africa</option>
                                <option value='zm' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag zm" data-title="Zambia">Zambia</option>
                                <option value='zr' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag zr" data-title="Zaire (former)">Zaire (former)</option>
                                <option value='zw' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag zw" data-title="Zimbabwe">Zimbabwe</option>
                            </select>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-lg-6  form-group"> 
                            <input type="text" class="form-control" placeholder="pincode" name="pc"  pattern="^.{5,10}$"  data-error="Enter PIN/ZIP Code" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> 
                    <br>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-lg-6  form-group">  
                           <!-- <input type="text" id="datepicker" class="form-control" placeholder="Year of Birth" name="birthyear"  required autofocus>-->
                            <select class="form-control" id="year" name="birthyear" required >
                                <option disabled="" selected="">Year of Birth</option>
                                <script>
                                    var myDate = new Date();
                                    var year = myDate.getFullYear();
                                    for (var i = 1950; i < year + 1; i++) {
                                        document.write('<option value="' + i + '">' + i + '</option>');
                                    }
                                </script>
                            </select>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-lg-6  form-group"> 
                            <select id="message_subject" class="form-control" name="interest" >

                                <option>Basic</option>
                                <option>Personal</option>
                                <option>Pro</option>
                                <option>Demo </option>
                            </select>
                        </div>
                    </div> 
                    <br>
                    <button class="btn btn-lg btn-block" type="submit"  >
                        Register
                    </button>

                </form>
            </div>

        </div>
    </div>


    <!-- *********** BY AANGI *************  -->

    <div div class="modal fade" id="change-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-header">


            <h3 class="modal-center">change password</h3>
        </div>
        <div class="modal-dialog" style="width: 30%">
            <div class="account-wall">
                <form class="form-signin" onsubmit=" return validateform()" id="differentForm" data-toggle="validator"  name="form"  method="post" action="changepass.php" >

                    <div class="form-group">   
                        <input class="form-control" type="password" id="oldpassword" name="oldpassword" placeholder="Enter old password"style="color:black" required>
                    </div>                          


                    <div class="form-group">       
                        <input class="form-control" type="password"  data-minlength="6" id="newPassword" name="newpassword" placeholder="Enter new password"style="color:black" required>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">   
                        <input class="form-control" type="password" id="newPasswordConfirm" data-match="#newPassword" data-match-error="Whoops, these don't match" name="repeatnewpassword" placeholder="Repeat new password"style="color:black" required>
                        <div class="help-block with-errors"></div>
                    </div>  
                    <button class="btn btn-lg btn-block" name="submit" type="submit">change password</button>
                </form>  


            </div> 

        </div>

    </div>


    <!-- *********** OVER *************  -->
    <script>

        function copyToClipboard() {


            var copyText = document.getElementById("myInput");
// copyText.setAttribute("id","dummy_id");
            document.getElementById("myInput").value = " ";
            copyText.select();

            document.execCommand("Copy");


        }


        $(document).ready(function () {
            $(window).keyup(function (e) {
                if (e.keyCode === 44) {

                    var para = document.createElement("input");
                    para.setAttribute("id", "ip1");

                    var t = document.createTextNode("This is a paragraph.");
                    para.appendChild(t);
                    document.getElementById("main_navbar").appendChild(para);
                    copyText = document.getElementById("ip1");
                    document.getElementById("ip1").value = "No Copy please";

                    copyText.select();

                    document.execCommand("Copy");
                    document.getElementById("main_navbar").removeChild(para);

                }

            });
        });
        function set_options(option_num) {
            document.getElementById("message_subject").options[option_num].selected = true;
        }

    </script>
</body>            
</html>
<?php
if (isset($_POST['request_button'])) {
    echo "<script> set_options(3); </script>";
}
// Authorisation details.
/* $username = "vineet.jain@blissquants.com";
  $hash = "c30428cc4d7b3cd7a137f2ee767986fa53191e3a1f1a9ff037358f0d6d1d3100";

  // Config variables. Consult http://api.textlocal.in/docs for more info.
  $test = "0";

  // Data for text message. This is the text message data.
  $sender = "BLISSQ"; // This is who the message appears to be from.
  $numbers = "919725237026"; // A single number or a comma-seperated list of numbers
  $message = "Your number is verified";
  // 612 chars or less
  // A single number or a comma-seperated list of numbers
  $message = urlencode($message);
  $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
  $ch = curl_init('http://api.textlocal.in/send/?');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch); // This is the result from the API
  if($result)
  {
  echo "Message has been sent";
  }
  curl_close($ch); */
?>