<!doctype html>
<?php
include("header.php");
include("db_connect.php");
?>
<html>
    <head>
        <title> BlissQuants - Delta Hedging | Fund Management </title>
        <script src="js/jquery-ui.js"></script>    
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">
        <script type="text/javascript" language="javascript" src="bootstrap-3.3.4-dist/js/jquery.carouFredSel-6.0.4-packed.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">      
        <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="css/BlissEventCalendar.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">     

        <script type="text/javascript" src="amstockchart/amcharts/amcharts.js"></script>
        <script type="text/javascript" src="amstockchart/amcharts/serial.js"></script>    
        <script type="text/javascript" src="amstockchart/amcharts/amstock.js"></script>    
        <script src="js/dateformat.js"></script>
        <style>
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
        <script  type="text/javascript" language="javascript">
            //on enter press go to next field 
            $(document).ready(function () {
                //alert("fd");
                c_date = new Date();


                $("#intra_date").datepicker({dateFormat: 'yy-mm-dd', yearRange: "2008:2019", changeYear: true, maxDate: c_date, background: '#FFFFFF', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']});



                get_intraday();



            });

            function make_chart(c_name2, date_his)
            {
                var clr = [];
                var chartData;
                //var get_duration_val = document.getElementById("range2").options[document.getElementById("range2").selectedIndex].text;;
                //alert(c_name2);
                // function for get value from url 
                chartData = generateChartData_daily_vol(c_name2, date_his);

                //var first_vol = Object.values(chartData[0])[1];// get first value
                var data1 = c_name2;

                chart_intraday = AmCharts.makeChart("chartdiv_vol_delta", {
                    "type": "serial",
                    "theme": "none",
                    "color": "#fff",
                    "pathToImages": "amstockchart/amcharts/images/",
                    "plotAreaBorderAlpha": 1,
                    "plotAreaBorderColor": "#000",
                    "dataProvider": chartData, // data pass from chartData array
                    // "dataDateFormat" = "YYYY-MM-DD, JJ:NN:SS",
                    "valueAxes": [{
                            "axisColor": "#000",
                            "axisThickness": 2,
                            "gridAlpha": 0,
                            "axisAlpha": 1,
                            "position": "left",
                            "color": "#84C225",
                            "dashLength": 30,
                            "inside": true,
                            "precision": 1,
                        },
                                /*{
                                 "id":"v1",
                                 "axisColor": "#000",
                                 "axisThickness": 2,
                                 "gridAlpha": 0,
                                 "axisAlpha": 1,        
                                 
                                 "color":"#84C225",
                                 "dashLength" : 30,
                                 "labelsEnabled":false,
                                 "position":"right"
                                 
                                 }*/],
                    "graphs": [{
                            "id": "v1",
                            "lineColor": "#84C225",
                            //"customBullet": "bliss_icon.ico",


                            "title": "",
                            "fillAlphas": 0.3,
                            "negativeBase": first_vol,
                            "negativeLineColor": "#FF0000",
                            "fillColorsField": "lineColor",
                            "lineColorField": "lineColor",
                            "gridCount": 2,
                            // "balloonText": "[[iv_text]]" ,
                            "valueField": "vols",
                            "bullet": "round",
                            "bulletField": "bullet",
                            "bulletSize": 4,
                            "bulletSizeField": "bulletSize",
                        }],
                    "legend": {// line colour with information at below
                        //"useGraphSettings": true,
                        "color": "#FFF", // text colour 
                        "data": "",
                        verticalGap: 0,
                        fontSize: 12,
                        markerType: "none",
                        // autoMargins : false,
                        /// marginLeft : 0,
                        //labelText : data1,

                        "valueText": data1 + " [[delta_text]]",
                        "valueWidth": 400,
                        "valueAlign": "left",
                        //textClickEnabled:true,
                        switchable: false,
                        position: "bottom",
                        //  switchType : "V",         
                    },
                    "trendLines": [
                        {
                            "initialValue": 25,
                            "initialXValue": 25,
                            "finalValue": 11,
                            "finalXValue": 12
                        }
                    ],
                    "chartCursor": {
                        "cursorPosition": "mouse",
                        "categoryBalloonColor": "#0000ff",
                        "cursorColor": "#0000FF",
                        "categoryBalloonEnabled": true,
                        "categoryBalloonDateFormat": "DD MMM, JJ:NN:SS",
                        "valueLineBalloonEnabled": true,
                        "valueLineEnabled": true,
                        "valueBalloonsEnabled": false,
                    },
                    "chartScrollbar": {
                        "autoGridCount": true,
                        //"graph": "g1",
                        "scrollbarHeight": 40,
                        "oppositeAxis": true,
                        "offset": 20,
                        "backgroundColor": "#84C225",
                        "backgroundAlpha": 0.5,
                        "gridColor": "#84C225",
                        "selectedBackgroundColor": "rgb(58, 53, 49)",
                        "selectedBackgroundAlpha": 1,
                        "position": "top"

                    },
                    /* "valueScrollbar": {
                     "autoGridCount":true
                     },*/
                    "categoryField": "date",
                    // "secondCategoryField": "date",
                    "categoryAxis": {
                        "parseDates": true,
                        "axisColor": "#000",
                        "minorGridEnabled": true,
                        "minPeriod": "mm",
                        "equalSpacing": false,
                        /*for proper time format in axis with equal spacing*/
                        //   "autoGridCount" :false,
                        "gridCount": 8
                                //  "dateFormats": [{period:"hh",format:"YYYY-MM-DD,HH:NN:SS"}]
                    },
                    "dataDateFormat": "YYYY-MM-DD HH:NN:SS"

                });

                //alert("maxDate");
                add_event_HL();

            }

            function add_event_HL() {


                //chart = chart_intraday;// = event.chart;
                var axis = chart_intraday.valueAxes[0];
                var graph = chart_intraday.graphs[0];

                /* if (chart.minMaxMarked)
                 return;*/
                min = 1000;
                max = 0;
                for (var i = 0; i < chart_intraday.dataProvider.length; i++) {
                    var dp = chart_intraday.dataProvider[i];
                    if (dp[graph.valueField] > max) {


                        max = dp[graph.valueField];
                        maxdp = dp;

                    } else if (dp[graph.valueField] < min) {
                        min = dp[graph.valueField];
                        mindp = dp;

                    }
                }
                if (min !== 1000)
                {
                    if (typeof mindp.bullet !== 'undefined')
                    {
                        mindp.bullet = "triangleDown";
                        mindp.bulletSize = 20;
                    }
                }

                if (max !== 0)
                {
                    if (maxdp.bullet !== 'undefined')
                    {
                        maxdp.bullet = "triangleUp";
                        maxdp.bulletSize = 20;
                    }
                }
                chart_intraday.minMaxMarked = true;


                // take in updated data
                // chart.validateData();
                chart_intraday.validateNow(true, true);
            }

            function generateChartData_daily_vol(c_name2, date_his)
            {
                var nope = "";
                var arr_data = [];
                var time;
                var c_date = new Date();

                //day1 = dateFormat(c_date, "yyyy-mm-dd");                                 //formating date

                day1 = date_his;
                date1 = day1 + "/" + day1;
                $.ajaxSetup({async: false});
                var ar_data = {
                    date1: date1,
                    c_name2: c_name2
                };
                //alert(ar_data['c_name2']);
                /*get graph data*/
                $.post('connect/vol_graph_connect.php', {ar_data: ar_data}, function (result)                       // retrive values from india vix table
                {
                    var str2 = 'No Data';
                    //  alert(result);
                    if (result.indexOf(str2) === -1)
                    {
                        arr_data = jQuery.parseJSON(result);
                    } else
                    {
                        nope = "no";
                    }

                });
                // 

                var chartData = [];
                var i = 0, j = 0;
                var st = "";
                var newDate, vols, strike, call_price, spot_price, delta, days_of_expiry, lineColor, vol_diff;
                if (arr_data.a[1])
                {
                    first_vol = parseFloat(arr_data.a[1]);
                } else {
                    first_vol = 0;
                }
                // alert(first_vol);
                for (var i = 0; i < parseInt(arr_data.b); i++)
                {
                    // arr_data.a[j] = dateFormat(arr_data.a[j], "yyyy/mm/dd");
                    newDate = arr_data.a[j] + " " + arr_data.a[j + 2];// + " " + arr_data.a[j+2]); if we do both date and time then chart is not visisble in mozila

                    vols = parseFloat(arr_data.a[j + 1]);
                    strike = arr_data.a[j + 5];
                    call_price = arr_data.a[j + 6];
                    spot_price = arr_data.a[j + 7];
                    delta = "At The Money Intraday Implied Volatality : " + vols + "<br>  Delta: " + arr_data.a[j + 4] + "<br>  Strike: " + arr_data.a[j + 5] + "<br>  Call Price: " + arr_data.a[j + 6] + "<br>Spot Price: " + arr_data.a[j + 7];

                    days_of_expiry = parseFloat(arr_data.a[j + 3]);
                    lineColor = "#84C225";

                    /*  if(vols > parseFloat(arr_data.a[1]))
                     {
                     lineColor = "#FF0000";
                     
                     }    
                     else{
                     lineColor = "#84C225";
                     }*/
                    vol_diff = vols - arr_data.a[1];

                    /* delta.push({
                     date: newDate,
                     vols: vols,
                     delta:arr_data.a[j+4],
                     time:time,
                     delta_text:delta
                     
                     });*/
                    if (days_of_expiry < 4)
                    {
                        lineColor = "#0000FF";
                    }

                    chartData.push({
                        date: newDate,
                        vols: vols,
                        lineColor: lineColor,
                        time: time,
                        delta_text: delta,
                        vol_diff: vol_diff

                    });

                    j = j + 8;

                }
                return chartData;
                //   return chartData;
            }

            function get_intraday() //passing selected duration today,week or month
            {
                search = document.getElementById('search2').value;
                // alert(search + "546");
                date = document.getElementById('intra_date').value;

                ar_data = {date1: date, //date
                    c_name2: search // company name
                };
                //alert(date);
                $.post('connect/Intraday_IV_connect.php', {ar_data: ar_data}, function (result) { //send data to blissdelta_delta_connect.php page
                    //alert(result);
                    document.getElementById('intraday_iv').innerHTML = result;
                    // $('#intra_date').datepicker('setDate', c_date);

                });
                make_chart(search, date);
            }

        </script>
    </head>
    <body >   

        <div class="row wrap">

            <div class="col-lg-3 col-md-3 col-sm-3">

            </div>


            <div class="col-lg-6 col-md-6 col-sm-6  text-center "> 
                <div class="title_all text-center">
                    Historical  IV 
                </div>




                <form class="form-horizontal" action="" method="post" >

                    <table class="table table-striped">

                        <tbody>

                        <td colspan="3">


                            <input type='text' class="form-control control_color_1 "  onchange="get_intraday()"     id='intra_date'>
                        </td>
                        <td>


                            <select id="search2" name="search2" class="form-control control_color_1 selectpicker " placeholder="Search Scrip" onchange="get_intraday()"  data-live-search="true">
                                <?php
                                $sql_all_companies = "SELECT c_name FROM `companies`";
                                $result_all_companies = mysqli_query($con, $sql_all_companies);
                                //$all_company = mysqli_fetch_array($result_companies);
                                while ($row = mysqli_fetch_array($result_all_companies)) {

                                    echo "<option data-tokens='" . $row['c_name'] . "'>" . $row['c_name'] . "</option>";
                                }
                                ?>


                            </select>

                        </td>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label class="col-md-6 btn-lg" id="marginrequired"  > IV :-</label>
                        <div class="col-md-6">
                            <label  id="intraday_iv" class="btn-lg"> N/A </label>
                        </div>
                    </div> 
                </form>




                <div id="chartdiv_vol_delta"> </div>  


            </div>



        </div>
    </div>
</div>

<?php
include("html/footer.html");
?>
</body>
</html>



