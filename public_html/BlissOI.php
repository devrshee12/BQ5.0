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
            #chartdiv_nifty_ce ,#chartdiv_banknifty_ce,#chartdiv_nifty_pe ,#chartdiv_banknifty_pe{
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


                make_chart();



            });

            function make_chart()
            {
                var clr = [];
                var chartData;
                //  alert("fv");

                generateChartData_daily_vol("nifty","chartdiv_nifty_ce");
                generateChartData_daily_vol("banknifty","chartdiv_banknifty_ce");
               // generateChartData_daily_vol("nifty","chartdiv_nifty_pe","PE");
               // generateChartData_daily_vol("banknifty","chartdiv_banknifty_pe","PE");
                //alert(chartData);
                //       alert("fv");
                //var first_vol = Object.values(chartData[0])[1];// get first value




            }

            function generateChartData_daily_vol(name, chart_div, op_type)
            {
                // alert("sv");, op_type
                var arr_data = [];

                $.post('connect/vol_oi_connect.php', {name: name, op_type : op_type}, function (result)                       // retrive values from india vix table
                {
                    var str2 = 'No Data';


                    arr_data = jQuery.parseJSON(result);
                    // alert(arr_data.last_time);

document.getElementById("last_update").innerHTML = arr_data.last_time;
                    // alert(arr_data.strike.length);
                    var chartData = [];

                    var newDate, oi_ce,oi_pe, strike;

                    for (var i = 0; i < arr_data.strike.length; i++)
                    {

                        oi_ce = parseFloat(arr_data.oi_ce[i]);
                        strike = arr_data.strike[i];
                        oi_pe = parseFloat(arr_data.oi_pe[i]);

                        chartData.push({
                            strike: strike,
                            oi_ce: oi_ce,
                            oi_pe: oi_pe
                        });



                    }

                    chart_intraday = AmCharts.makeChart(chart_div, {
                        "type": "serial",
                        "theme": "none",
                        "color": "#fff",
                        "pathToImages": "amstockchart/amcharts/images/",
                      
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
                        ],
                        "graphs": [{
                                "id": "v1",
                                "lineColor": "#84C225",
                                "title": "CALL :",
                                "type": "column",
                                "fillAlphas": 0.3,
                                "negativeLineColor": "#FF0000",
                                "valueField": "oi_ce",
                                  "color": "#FFF", // text colour 
                            },
                        {
                                "id": "v2",
                                "lineColor": "#0000FF",
                                "title": "PUT : ",
                                "type": "column",
                                "fillAlphas": 0.3,
                                "negativeLineColor": "#FF00FF",
                                "valueField": "oi_pe",
                                  "color": "#FFF", // text colour 
                            }],
                        "legend": {
     
            "color": "#FFF", // text colour 
          
           
            "valueAlign": "left",
        
            position: "bottom",
         
    },
                      
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
                        "categoryField": "strike",
                        // "secondCategoryField": "date",



                    });
                    //   alert(chartData);
                });
                // 
            }



        </script>
    </head>
    <body >   

        <div class="row wrap">




            <div class="col-lg-12 col-md-12 col-sm-12 text-center "> 
                  <h3 class="section-title h3"> OI Index Chart</h3>
               
                <span id="last_update">
                 
                </span>
                <label class="btn btn-default">
                    <a href="#tab_default_1" data-toggle="tab" > Nifty </a>
                </label> 

                <label class="btn btn-default">
                    <a href="#tab_default_2" data-toggle="tab"> Banknifty </a>
                </label> 




                <div class="tab-content">
                    <div class="tab-pane active col-lg-offset-2 " id="tab_default_1">
                          <div class="col-lg-10" >
                        
                        <div id="chartdiv_nifty_ce"> </div>  
                          </div>
                       
                    </div>
                    <div class="tab-pane col-lg-offset-2" id="tab_default_2">
 <div class="col-lg-10" >
                       
                        <div id="chartdiv_banknifty_ce"> </div> 
 </div>
                         
                    </div>
                </div>

            </div>







        </div>



    </div>
</div>
</div>

<?php
include("html/footer.html");
?>
</body>
</html>



