<!doctype html>
<?php include("header.php"); ?>
<html>
    <head>
        <title> BlissQuants - Delta Hedging | Fund Management </title>
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">
        <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/dateformat.js"></script>
        <script src="js/script.js"></script>
        <script src="js/BlissEventCalendar.js"></script>

        <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="css/BlissEventCalendar.css" >
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">      

        <style>
            .tab-pane{
                background-color: transparent !important;             
            }


            .panel-body  li{
                margin-bottom: 2%;
            }
            .form-group{
                margin:1px;

            }
            .btn-lg{
                padding-left: 2px;
                font-weight: normal;
                font-size: 15px;
            }
            h3{
                margin-top: 0;
            }
            .form-horizontal{
                text-align: left;
            }


            input[type=number]::-webkit-inner-spin-button, 
            input[type=number]::-webkit-outer-spin-button { 
                -webkit-appearance: none; 
                margin: 0; 
            }
            input[type=number] {
                -moz-appearance:textfield;
            }

            .ticker {
                margin:10px;
                width: 400px;
                height: auto;

                box-shadow: 0px 0px 10px 1px ;
                background-color: transparent;
                text-align: left;
                padding-left:50px;
            }
            @media (min-width: 800px) and (max-width: 1100px) { 

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

            }

        </style> 
        <script  type="text/javascript" language="javascript">
            //on enter press go to next field 
            $(document).on('keypress', 'input,select', function (e) {
                //  alert("hello");
                if (e.which == 13) {
                    e.preventDefault();
                    // Get all focusable elements on the page
                    var $canfocus = $(':focusable');
                    var index = $canfocus.index(document.activeElement) + 1;
                    if (index >= $canfocus.length)
                        index = 0;
                    $canfocus.eq(index).focus();
                }
            });



            window.onload = function () {



                var d = new Date();//current date
                var d_date = d.getDate(); // current date dd ie:-26 if date is 26-08-2016

                var date = new Date();
                var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0); // full last date of month 

                var lastdate = lastDay.getDate(); //last date of month ie 31 if date is 31-08-2016
                var lastday = lastDay.getDay(); //last day of month in no ie if monday returns 1

                var thu;
                if (lastday < 4) //check last day greater then thursday or not
                {
                    thu = (lastdate - lastday) - 3; //return last thursday of month

                } else if (lastday > 4)
                {
                    thu = (lastdate - lastday) + 4; //return last thursday of month

                } else
                {
                    thu = lastdate;
                }


                var get_day = thu - d_date; // return days left to expiry
                //  alert(d_date);
                //alert(get_day);
                if (get_day < 0) { // check if get_day return negative then we take next month  last thursday as expiry
                    var lastDay = new Date(date.getFullYear(), date.getMonth() + 2, 0); // full last date of next month
                    var lastdate2 = lastDay.getDate(); // last date of next month
                    var lastday = lastDay.getDay();
                    if (lastday < 4)
                    {
                        thu = (lastdate2 - lastday) - 3;
                        // alert(lastdate);
                    } else if (lastday > 4)
                    {
                        thu = (lastdate2 - lastday) + 4;
                        //alert(lastday);
                    } else
                    {
                        thu = lastdate2;
                    }
                    //alert(d_date);
                    //   thu =(lastdate2 - lastday) - 3;
                    d_date = -(lastdate - d_date);
                    //    alert(d_date);
                    get_day = thu - d_date;
                    // alert(thu);
                }
                document.getElementById("days").value = get_day;

                var nifty = document.getElementById("nifty").value;
                document.getElementById("exposure").style.display = "none";
                document.getElementById("requiredmargin").style.display = "none";
                document.getElementById("onedayinterest").style.display = "none";
                //  document.getElementById("intresttillexpiry").style.display= "none";
                document.getElementById("remaininginterest").style.display = "none";
                document.getElementById("marginrequired").style.display = "none";


            };
            function apply()
            {
                var currentrate = document.getElementById("current_rate").value;
                var lotsize = document.getElementById("lot_size").value;
                var nifty = document.getElementById("nifty").value;
                var days = document.getElementById("days").value;
                var single_lot = document.getElementById("lot_size_single").value;
                var total = +currentrate * +lotsize;
                $("#border").addClass("ticker");
                //         
                document.getElementById("total").innerHTML = total;
                var margins = (total * nifty) / 100;
                var intrest = (margins * 1) / 100;
                var oneday = intrest / 30;
                var pendingdays = days * oneday;
                var pendingdaysperlot = pendingdays / single_lot;
                document.getElementById("margins").innerHTML = Math.round(margins);

                document.getElementById("oneday").innerHTML = Math.round(oneday);
                document.getElementById("pendingdays").innerHTML = Math.round(pendingdays);

                document.getElementById("pendingdaysperlot").innerHTML = Math.round(pendingdaysperlot * 100) / 100;
                document.getElementById("exposure").style.display = "inline";
                document.getElementById("requiredmargin").style.display = "inline";
                document.getElementById("onedayinterest").style.display = "inline";

                document.getElementById("remaininginterest").style.display = "inline";



            }

        </script>
    </head>
    <body>   

        <div class="row wrap">

            <div class="col-lg-3 col-md-3 col-sm-3">

            </div>


            <div class="col-lg-6 col-md-6 col-sm-6  text-center "> 
                <div class="title_all text-center">
                    Margin Calculator

                </div>



                <form class="form-horizontal" action="" method="post" >

                    <div class="form-group ">
                        <label class="col-md-6 btn-lg" for="name">Spot Price:-</label>
                        <div class="col-md-6">
                            <input type="number" name="current_rate" class="form-control" id="current_rate" style=" color:#000000" value="" autofocus >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 btn-lg" for="email">Lot Size:-</label>
                        <div class="col-md-6">
                            <input type="number" name="lot_size" id="lot_size_single" class="form-control" style="color:#000000" value="" onblur="apply()"> 
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-6 btn-lg" for="email">Option Quantity:-</label>
                        <div class="col-md-6">
                            <input type="number" name="lot_size" id="lot_size" class="form-control" style="color:#000000" value="" onblur="apply()"> 
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-6 btn-lg" for="email">Exchange Margin Requirement:-</label>
                        <div class="col-md-6">
          <!--                   <input type="number" name="nifty" id="nifty" class="form-control" style="color:#000000" value="">-->
                            <select name="nifty" id="nifty" style="color:#000000" class="form-control" onblur="apply()">
                                <option value="16.7" selected="">16.7 % for Scrip</option>
                                <option value="9">9 % for Nifty</option>

                            </select>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-6 btn-lg" for="email">Time to Expiry:-</label>
                        <div class="col-md-6">
                            <input type="text" id="days"  name="days" style="color:#000000" class="form-control" onblur="apply()">
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-6 btn-lg" >Exposure:-</label>
                        <div class="col-md-6">
                            <label class="btn-lg" id="total" ></label>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-6 btn-lg" >Required Margin:-</label>
                        <div class="col-md-6">
                            <label id="margins" class="btn-lg"></label>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-6 btn-lg">One Day interest:-</label>
                        <div class="col-md-6">
                            <label id="oneday" class="btn-lg"></label>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-6 btn-lg" >Interest Till Expiry:-</label>
                        <div class="col-md-6">
                            <label id="pendingdays"  class="btn-lg"></label>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-6 btn-lg" >Interest Till Expiry / lot:-</label>
                        <div class="col-md-6">
                            <label id="pendingdaysperlot"  class="btn-lg"></label>
                        </div>
                    </div> 

                </form>




            </div>



        </div>

        <?php
        include("html/footer.html");
        ?>
    </body>
</html>



