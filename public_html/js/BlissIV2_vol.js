var min, max, get_duration, search,first_vol;
/*hide on escape button*/
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        $('#chartdiv_vol').hide();
    }

});

function clear_watchlist()
{

    watch_check = "all";
    var ar_data = {
        watch_check: watch_check

    };
    if (confirm("Delete All Script from Watchlist") == true) {
        $.ajaxSetup({async: false});                                               // to run jquery ajax fast we have to false syncronization
        $.post('connect/insert_watchlist.php', {ar_data: ar_data}, function (result) {         // retrieve OHLC value from ohlc_connect.php by company code name
            //  obj = jQuery.parseJSON(result);             
        });
    }

}
function add_to_watchlist(watch_check)
{
    search = document.getElementById('search2').value;

    if (search != "")
    {
        var ar_data = {
            watch_check: watch_check,
            search: search
        };
        // alert(watch_check);
        $.ajaxSetup({async: false});                                               // to run jquery ajax fast we have to false syncronization
        $.post('connect/insert_watchlist.php', {ar_data: ar_data}, function (result) {         // retrieve OHLC value from ohlc_connect.php by company code name
         /* obj = jQuery.parseJSON(result);   
            alert(obj.a + " is added");*/
        });
    } else {
        clear_watchlist();
    }
    location.href = "Watchlist.php";
}

function get_script() {

    date2 = ""; //set date formate to yyyy-mm-dd


    search = "";// _ symbol is added where & pass in url so we remove _ as quandl not getting QUOTE
    //search = search.replace("&", "");
    $.ajaxSetup({async: false});
    ar_data = {date1: date2, //date
        c_name2: search // company name
    };
    //   alert(ar_data['c_name2']);

    $.post('connect/BlissDelta_Delta_Connect.php', {ar_data: ar_data}, function (result) { //send data to blissdelta_delta_connect.php page
        // alert(result);
        var obj;
        var str2 = 'No Data';    //display this not data is there

        if (result.indexOf(str2) == -1)                                                  // check result value and str2 value equal or not
        {
            var obj = jQuery.parseJSON(result);
            var comp_name = obj.b;
          //  $(function () {
              //  alert(obj.b);
                var availableTags = comp_name;
                $("#search2").autocomplete({
                    source: function (request, response) { // function for alphabetical order in autocomplete searchbox
                        var term = $.ui.autocomplete.escapeRegex(request.term)
                                , startsWithMatcher = new RegExp("^" + term, "i")
                                , startsWith = $.grep(availableTags, function (value) {
                                    return startsWithMatcher.test(value.label || value.value || value);
                                })
                                , containsMatcher = new RegExp(term, "i")
                                , contains = $.grep(availableTags, function (value) {
                                    return $.inArray(value, startsWith) < 0 &&
                                            containsMatcher.test(value.label || value.value || value);
                                });

                        response(startsWith.concat(contains));
                    }
                    // source: availableTags
                });
           // });

        }


    });
}
function range_sel(connect_page) //passing selected duration today,week or month
{
    //  var datatable = $('#iv_vol-table').DataTable();

//datatable.clear()
    // .draw();
if($('#search2').css('display') !== 'none')
{
        get_script();
}

    connect_page = "connect/" + connect_page;
    search = document.getElementById('search1').value;
  //alert(connect_page);
    $.post(connect_page, {search: search}, function (result) {
        //alert(result);
        // alert("fsdf");
        var obj;
        var str2 = 'No Data1';    //display this not data is there

        if (result.indexOf(str2) == -1)                                                  // check result value and str2 value equal or not
        {   // alert(result); 
            var obj = jQuery.parseJSON(result);

            $('#iv_vol-table').DataTable({
                data: obj.a,
                "bDestroy": true, //destroy last table 
                "processing": true,
                "deferRender": true,
                "lengthMenu": [5, 10, 25, 50, 100],
                "iDisplayLength": 20,
                // "searching": true,
                "sScrollX": "100%", 
                "paging": false,
                "scrollY": "60vh",
                "dom": ' <"top">t<"bottom"p>',
                "order": [[1, "asc"]],
                language: {
                    oPaginate: {
                        "sNext": ">",
                        "sPrevious": "<"
                    },
                    "sEmptyTable": "No Script",
                    "sInfoFiltered": "" //remove filter label text on searching
                },
                "aoColumnDefs": [/* to disable sorting for column*/
                   // {'bSortable': false, 'aTargets': [9, 10]}
                ],
               
            });


            $('.dataTables_length select').addClass('control_color');

        }


    });

}

function range_sel_sector(connect_page) //passing selected duration today,week or month
{
    //  var datatable = $('#iv_vol-table').DataTable();

//datatable.clear()
    // .draw();
/*if($('#search2').css('display') !== 'none')
{
        //get_script();
}*/

    connect_page = "connect/" + connect_page;
    search = document.getElementById('search_sector').value;
  //alert(search);
    $.post(connect_page, {search: search}, function (result) {
        //alert(result);
        // alert("fsdf");
        var obj;
        var str2 = 'No Data1';    //display this not data is there

        if (result.indexOf(str2) == -1)                                                  // check result value and str2 value equal or not
        {   // alert(result); 
            var obj = jQuery.parseJSON(result);

            $('#iv_vol-table').DataTable({
                data: obj.a,
                "bDestroy": true, //destroy last table 
                "processing": true,
                "deferRender": true,
                "lengthMenu": [5, 10, 25, 50, 100],
                "iDisplayLength": 20,
                // "searching": true,
                "sScrollX": "100%", 
                "paging": false,
                "scrollY": "60vh",
                "dom": ' <"top">t<"bottom"p>',
                "order": [[1, "asc"]],
                language: {
                    oPaginate: {
                        "sNext": ">",
                        "sPrevious": "<"
                    },
                    "sEmptyTable": "No Script",
                    "sInfoFiltered": "" //remove filter label text on searching
                },
                "aoColumnDefs": [/* to disable sorting for column*/
                   // {'bSortable': false, 'aTargets': [9, 10]}
                ],
               
            });


            $('.dataTables_length select').addClass('control_color');

        }


    });

}

function showdata2(eq)
{ //alert("ff");

    document.getElementById("get_name").value = eq;

    var eq;


    //search = eq;
    //
    $('#chartdiv_vol').show();

    $('#chartdiv_vol').css({
        top: 200,
        left: 400
    });

    /*var mql = window.matchMedia("screen and (max-width: 1000px)")
     if (mql.matches){ // if media query matches
     //alert("Window is 800px or wider")
     
     $('#chartdiv_vol').css({
     top: 200,
     left: 400           
     });
     }
     else{
     // do something else
     }*/


    make_chart(eq);                                      // create chart function (blissearning.php)  

}
function showdata_daily_vol(eq)
{ //alert("ff");

    document.getElementById("get_name").value = eq;


    //
    $('#chartdiv_vol').show();

    $('#chartdiv_vol').css({
        top: 200,
        left: 400
    });

    /*var mql = window.matchMedia("screen and (max-width: 1000px)")
     if (mql.matches){ // if media query matches
     //alert("Window is 800px or wider")
     
     $('#chartdiv_vol').css({
     top: 200,
     left: 400           
     });
     }
     else{
     // do something else
     }*/


    make_chart_daily_vol(eq);                                      // create chart function (blissearning.php)  

}
//hide chaRT onload
$(function ()
{
    $('#chartdiv_vol').hide();
});
function getCol(matrix, col) {
    var column = [];
    for (var i = 0; i < matrix.length; i++) {
        column.push(matrix[i][col]);
    }
    return column;
}
var c_name = "";
var chart;
function make_chart(c_name2)
{
    var clr = [];
    var chartData, charttrend;
    // var get_duration_val = document.getElementById("range2").options[document.getElementById("range2").selectedIndex].text;;
    var data1 = c_name2;// + " IV  Min-Max  :    Blue mark is an expiry week";
    // function for get value from url 
    charttrend = generateChartData(c_name2);
    //  var codes = newCodes();
    var chartData = charttrend.chartData;
    var trendData = charttrend.trendData;
    //var first_avg_vol=Object.values(chartData[Object.keys(chartData).length - 5])[7];// get first value    
   // var first_avg_vol = Object.values(chartData[0])[7];// get first value        
    // alert(getCol(Object.values(chartData),0))
//alert(chartData);
    chart = AmCharts.makeChart("chartdiv_vol", {
        "type": "serial",
        "theme": "none",
        "color": "#fff",
        "pathToImages": "amstockchart/amcharts/images/",
        "plotAreaBorderAlpha": 1,
        "plotAreaBorderColor": "#000",
        "dataProvider": chartData, // data pass from chartData array
        // "dataDateFormat" = "YYYY-MM-DD, JJ:NN:SS",
        "valueAxes": [{
                "id": "v1",
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
                "valueAxis": "v1",
                "lineColor": "#84C225",
                //"customBullet": "bliss_icon.ico",
                "bulletSize": "15",
                "bulletBorderThickness": 50,
                "hideBulletsCount": 50,
                "title": "",
                "fillAlphas": 0.3,
                "negativeBase": first_vol,
                "negativeLineColor": "#FF0000",
                "fillColorsField": "lineColor",
                "lineColorField": "lineColor",
                "gridCount": 2,
                // "balloonText": "[[iv_text]]" ,
                "valueField": "vols",
                "balloonText": "[[vols]]",
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

            "valueText": data1 +  " [[delta_text]]",
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
        }
        /* "export": {
         "enabled": true
         }*/
    });

    // GRAPHS
    // duration graph
    var durationGraph = new AmCharts.AmGraph();

    durationGraph.lineColorField = "lineColor";
    durationGraph.fillColorsField = "lineColor";
    durationGraph.fillAlphas = 0.3;
    durationGraph.balloonText = "[[value]]";
    durationGraph.lineThickness = 1;
    durationGraph.legendValueText = "[[value]]";
    chart.addListener("dataUpdated", zoomChart);

    zoomChart();
}
function setType(type) {
    //alert(type);
    //alert(document.getElementById("get_name").value);
    switch (type) {
        case 'line':
            showdata2(document.getElementById("get_name").value);
            chart.graphs[0].type = 'line';
            chart.graphs[0].lineAlpha = 1;
            chart.graphs[0].fillAlphas = 0;

            chart.validateNow();
            break;

        case 'column':
            showdata2(document.getElementById("get_name").value);

            chart.graphs[0].type = 'column';
            chart.graphs[0].lineAlpha = 0;
            chart.graphs[0].fillAlphas = 0.5;
            chart.validateNow();
            break;

            return;
    }


    document.getElementById('chartdiv_vol').style.display = 'block';
    chart.invalidateSize();
    chart.animateAgain();
}
function generateChartData(c_name2)
{
    var nope = "";
    var arr_data = [];
    var time;
    var line_color = "#84C225";

    $.ajaxSetup({async: false});
    var ar_data = {
        c_name2: c_name2
    };


    /*get graph data*/
    $.post('connect/close_vol_graph_connect.php', {ar_data: ar_data}, function (result)                       // retrive values from india vix table
    {      // alert(result); 
        var str2 = 'No Data';
        var str2 = 'No Data';
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
    var trendData = [];
    var i = 0, j = 0;
    var st = "", name, name_final, bullet;
//var type = document.getElementById('type').value;
    var type = document.querySelector('input[name = "type"]:checked').value;
    var avg_vol = arr_data.c;
    var newDate, visits, hits, open;
    for (var i = 0; i < parseInt(arr_data.b); i++) {
        // we create date objects here. In your data, you can have date strings
        // and then set format of your dates using chart.dataDateFormat property,
        // however when possible, use date objects, as this will speed up chart rendering.
        newDate = new Date(arr_data.a[j]);
        // newDate.setDate(newDate.getDate() + i);

        visits = arr_data.a[j + 1];
        bullet = "";
        hits = arr_data.a[j + 2];
        //hits = "";
        open = 0;
        if (type == "column")
        {
            name = "iv" + i;
            if (j > 2)
            {
                open = arr_data.a[j - 2];
                if (arr_data.a[j + 1] < arr_data.a[j - 2])
                {
                    line_color = "#FF0000";
                } else
                {
                    line_color = "#84C225";
                }
            }
        } else {
            name = "iv" + i;
            if (j > 2)
            {
                open = arr_data.a[j - 2];
                /* if(arr_data.a[j+4] < arr_data.a[j+1])
                 {
                 line_color = "#84C225";
                 /* if(visits < arr_data.a[j-2] - 2.5){
                 bullet =  "square";
                 }*
                 }    
                 else
                 {
                 line_color = "#84C225";
                 /* if(visits > arr_data.a[j-2] + 2.5)
                 {
                 // bullet =  "square";
                 
                 }*
                 
                 }*/
                /*    if(visits > hits)
                 {
                 line_color = "#84C225";
                 }
                 else{
                 line_color = "#FF0000";
                 }*/
            }
        }
        /* if(visits > arr_data.a[j-2] + 2.5 || visits < arr_data.a[j-2] - 2.5)
         {
         bullet =  "square";
         
         }*/
        //  }

        chartData.push({
            name: name,
            date2: newDate, //date
            open: open,
            visits: visits, //india vix data
            hits: hits, // nifty data
            lineColor: line_color, //line color
            "bullet": bullet,
            "avg_vol": avg_vol
        });
        if (i > 0)
        {
            name_final = "iv" + (i - 1);
            trendData.push({
                "dashLength": 3,
                "finalCategory": name_final,
                "finalValue": visits,
                "initialCategory": name,
                "initialValue": visits,
                "lineColor": line_color
            });
        }
        j = j + 3;


    }
    //  alert(chartData);
    return {
        chartData: chartData,
        trendData: trendData
    };
    //   return chartData;
}
// this method is called when chart is first inited as we listen for "dataUpdated" event
function zoomChart() {
    // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
    chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length + 10);
}
function make_chart_daily_vol(c_name2)
{
    var clr = [];
    var chartData;
    // var get_duration_val = document.getElementById("range2").options[document.getElementById("range2").selectedIndex].text;;
    var data1 = c_name2;// + " IV  Min-Max  :    Blue mark is an expiry week";
    // function for get value from url 
    chartData = generateChartData_daily_vol(c_name2);
 //   var first_vol = Object.values(chartData[0])[1];// get first value
    var chart = AmCharts.makeChart("chartdiv_vol", {
      "type": "serial",
        "theme": "none",
        "color": "#fff",
        "pathToImages": "amstockchart/amcharts/images/",
        "plotAreaBorderAlpha": 1,
        "plotAreaBorderColor": "#000",
        "dataProvider": chartData, // data pass from chartData array
        // "dataDateFormat" = "YYYY-MM-DD, JJ:NN:SS",
        "valueAxes": [{
                "id": "v1",
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
                "valueAxis": "v1",
                "lineColor": "#84C225",
                //"customBullet": "bliss_icon.ico",
                "bulletSize": "15",
                "bulletBorderThickness": 50,
                "hideBulletsCount": 50,
                "title": "",
                "fillAlphas": 0.3,
                "negativeBase": first_vol,
                "negativeLineColor": "#FF0000",
                "fillColorsField": "lineColor",
                "lineColorField": "lineColor",
                "gridCount": 2,
                // "balloonText": "[[iv_text]]" ,
                "valueField": "vols",
                "balloonText": "[[vols]]",
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

            "valueText": data1 +  " [[delta_text]]",
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
        }

    });

    chart.addListener("dataUpdated", zoomChart);

    zoomChart();
}
function generateChartData_daily_vol(c_name2)
{
    var nope = "";
    var arr_data = [];
    var time;
    var c_date = new Date();

    day1 = dateFormat(c_date, "yyyy-mm-dd");                                 //formating date
    //  day1 = '2017-12-12';
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
        // alert(result);
        if (result.indexOf(str2) === -1)
        {
            arr_data = jQuery.parseJSON(result);
        } else
        {
            nope = "no";
        }

    });
    
    if(arr_data.a[1])
   {
   first_vol= parseFloat(arr_data.a[1]);
   }
   else{
       first_vol= 0;
   }
            
    // 
    //alert(arr_data.a);
    var chartData = [];
    var i = 0, j = 0;
    var st = "";
    var newDate, vols, strike, call_price, spot_price, delta, days_of_expiry, lineColor, vol_diff;
    for (var i = 0; i < parseInt(arr_data.b); i++)
    {
        arr_data.a[j] = dateFormat(arr_data.a[j], "yyyy/mm/dd");
        newDate = new Date(arr_data.a[j] + " " + arr_data.a[j + 2]);// + " " + arr_data.a[j+2]); if we do both date and time then chart is not visisble in mozila

        vols = parseFloat(arr_data.a[j + 1]);
        strike = arr_data.a[j + 5];
        call_price = arr_data.a[j + 6];
        spot_price = arr_data.a[j + 7];
        delta = "ATM Intraday IV : " + vols + "<br>  Delta: " + arr_data.a[j + 4] + "<br>  Strike: " + arr_data.a[j + 5] + "<br>  Call Price: " + arr_data.a[j + 6] + "<br>Spot Price: " + arr_data.a[j + 7];

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

