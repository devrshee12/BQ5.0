var min, max, get_duration, search, first_vol;
/*hide on escape button*/
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        $('#chartdiv_vol').hide();
    }

});
$(document).ready(function () {
//alert("f")
    /*
     * Natural Sort algorithm for Javascript - Version 0.7 - Released under MIT license
     * Author: Jim Palmer (based on chunking idea from Dave Koelle)
     * Contributors: Mike Grier (mgrier.com), Clint Priest, Kyle Adams, guillermo
     * See: http://js-naturalsort.googlecode.com/svn/trunk/naturalSort.js
     */
    function naturalSort(a, b, html) {
        var re = /(^-?[0-9]+(\.?[0-9]*)[df]?e?[0-9]?%?$|^0x[0-9a-f]+$|[0-9]+)/gi,
                sre = /(^[ ]*|[ ]*$)/g,
                dre = /(^([\w ]+,?[\w ]+)?[\w ]+,?[\w ]+\d+:\d+(:\d+)?[\w ]?|^\d{1,4}[\/\-]\d{1,4}[\/\-]\d{1,4}|^\w+, \w+ \d+, \d{4})/,
                hre = /^0x[0-9a-f]+$/i,
                ore = /^0/,
                htmre = /(<([^>]+)>)/ig,
                // convert all to strings and trim()
                x = a.toString().replace(sre, '') || '',
                y = b.toString().replace(sre, '') || '';
        // remove html from strings if desired
        if (!html) {
            x = x.replace(htmre, '');
            y = y.replace(htmre, '');
        }
        // chunk/tokenize
        var xN = x.replace(re, '\0$1\0').replace(/\0$/, '').replace(/^\0/, '').split('\0'),
                yN = y.replace(re, '\0$1\0').replace(/\0$/, '').replace(/^\0/, '').split('\0'),
                // numeric, hex or date detection
                xD = parseInt(x.match(hre), 10) || (xN.length !== 1 && x.match(dre) && Date.parse(x)),
                yD = parseInt(y.match(hre), 10) || xD && y.match(dre) && Date.parse(y) || null;

        // first try and sort Hex codes or Dates
        if (yD) {
            if (xD < yD) {
                return -1;
            } else if (xD > yD) {
                return 1;
            }
        }

        // natural sorting through split numeric strings and default strings
        for (var cLoc = 0, numS = Math.max(xN.length, yN.length); cLoc < numS; cLoc++) {
            // find floats not starting with '0', string or 0 if not defined (Clint Priest)
            var oFxNcL = !(xN[cLoc] || '').match(ore) && parseFloat(xN[cLoc], 10) || xN[cLoc] || 0;
            var oFyNcL = !(yN[cLoc] || '').match(ore) && parseFloat(yN[cLoc], 10) || yN[cLoc] || 0;
            // handle numeric vs string comparison - number < string - (Kyle Adams)
            if (isNaN(oFxNcL) !== isNaN(oFyNcL)) {
                return (isNaN(oFxNcL)) ? 1 : -1;
            }
            // rely on string comparison if different types - i.e. '02' < 2 != '02' < '2'
            else if (typeof oFxNcL !== typeof oFyNcL) {
                oFxNcL += '';
                oFyNcL += '';
            }
            if (oFxNcL < oFyNcL) {
                return -1;
            }
            if (oFxNcL > oFyNcL) {
                return 1;
            }
        }
        return 0;
    }

    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
        "natural-asc": function (a, b) {
            return naturalSort(a, b, true);
        },
        "natural-desc": function (a, b) {
            return naturalSort(a, b, true) * -1;
        },
        "natural-nohtml-asc": function (a, b) {
            return naturalSort(a, b, false);
        },
        "natural-nohtml-desc": function (a, b) {
            return naturalSort(a, b, false) * -1;
        },
        "natural-ci-asc": function (a, b) {
            a = a.toString().toLowerCase();
            b = b.toString().toLowerCase();

            return naturalSort(a, b, true);
        },
        "natural-ci-desc": function (a, b) {
            a = a.toString().toLowerCase();
            b = b.toString().toLowerCase();

            return naturalSort(a, b, true) * -1;
        }
    });
});




function range_sel(connect_page) //passing selected duration today,week or month
{
//alert("f")

    connect_page = "connect/" + connect_page;
    search = "";
    // alert(search);
    $.post(connect_page, {search: search}, function (result) {
        //   alert(result);
        // alert("fsdf");
        var obj;
        var str2 = 'No Data1';    //display this not data is there
 var groupColumn = 6;
        if (result.indexOf(str2) == -1)                                                  // check result value and str2 value equal or not
        {
            //alert(result);
            var obj = jQuery.parseJSON(result);
            //  $.fn.dataTable.moment("dd-MM-yyyy");// "Sunday, February 14 3:25 pm"

            var table = $('#iv_vol-table').DataTable({
                data: obj.a,
                "bDestroy": true, //destroy last table 
                "processing": true,
                "deferRender": true,
                "lengthMenu": [5, 10, 25, 50, 100],
                "iDisplayLength": 20,
                // "searching": true,
                //"sScrollX": true,
                "paging": false,
                "scrollY": "60vh",
                dom: 'rt',
                buttons: [{
                        extend: 'csv',
                         title: 'BlissQuants_Restricted_'+ document.title,
               
                        text: 'Export to Excel'
                    }],
                  "order": [[ groupColumn, 'asc' ]],
               "columnDefs": [
            {orderable: false , "visible": false, "targets": groupColumn},
             {orderable: false ,  "targets": [0,1,2,3,4,5,7,8,9]}
        ],
      
        "displayLength": 25,
        'rowCallback': function(row, data, index){
    if(data[10] == "long"){
        $(row).find('td').css('color', 'rgb(132,194,37)');
    }
    if(data[10] == "short"){
        $(row).find('td').css('color', '#F00');
    } },
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="10" style="background-color:#rgb(58,53,49);text-align:center;font-size:16px;" >'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        },
          
            });
 $('#iv_vol-table tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
            table.order( [ groupColumn, 'desc' ] ).draw();
        }
        else {
            table.order( [ groupColumn, 'asc' ] ).draw();
        }
    } );
 $("#expo_button").on("click", function () {
                //alert("zdf");
                table.button('.buttons-csv').trigger();
            });

           
            $('#search_sector').change(function () {

                /*  if ($(this).val() === "NIFTY50")
                 {   
                 table.column('.nifty').search($(this).val()).draw();
                 } else {
                 */
                table.column('.sector').search($(this).val()).draw();
                // }

            });
           
            /*   table.buttons().container()
             .appendTo($('#expo_button'));
             var buttons = new $.fn.dataTable.Buttons(table, {
             buttons: [{
             extend: 'excel',
             text: 'Export to Excel'
             }]
             }).container().appendTo($('#expo_button'));*/
            //$('.dataTables_length select').addClass('control_color');
//table.columns.adjust().draw();
        }


    });

}

function showdata_daily_vol(eq)
{


    document.getElementById("get_name").value = eq;


    //
    $('#chartdiv_vol').show();

    $('#chartdiv_vol').css({
        top: 200,
        left: 400
    });

    make_chart_daily_vol(eq);                                      // create chart function (blissearning.php)  

}
//hide chaRT onload
$(function ()
{
    $('#chartdiv_vol').hide();
});



function make_chart_daily_vol(c_name2)
{
    var clr = [];
    var chartData;
    //var get_duration_val = document.getElementById("range2").options[document.getElementById("range2").selectedIndex].text;;
    //alert(c_name2);
    // function for get value from url 
    chartData = generateChartData_daily_vol(c_name2);

    //var first_vol = Object.values(chartData[0])[1];// get first value
    var data1 = c_name2;

    chart_intraday = AmCharts.makeChart("chartdiv_vol", {
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
        //   "dataDateFormat": "YYYY-MM-DD HH:NN:SS"

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
    //  alert(axis.maxReal);  
    mindp.bullet = "triangleDown";
    mindp.bulletSize = 20;
    maxdp.bullet = "triangleUp";
    maxdp.bulletSize = 20;
    chart_intraday.minMaxMarked = true;

    // take in updated data
    // chart.validateData();
    chart_intraday.validateNow(true, true);
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

    if (arr_data.a[1])
    {
        first_vol = parseFloat(arr_data.a[1]);
    } else {
        first_vol = 0;
    }

    // 
    //alert(arr_data.a);
    var chartData = [];
    var i = 0, j = 0;
    var st = "";
    var newDate, vols, strike, call_price, spot_price, delta, days_of_expiry, lineColor, vol_diff;
    for (var i = 0; i < parseInt(arr_data.b); i++)
    {
        //arr_data.a[j] = dateFormat(arr_data.a[j], "yyyy/mm/dd");
        newDate = arr_data.a[j] + " " + arr_data.a[j + 2];// + " " + arr_data.a[j+2]); if we do both date and time then chart is not visisble in mozila

        vols = parseFloat(arr_data.a[j + 1]);
        strike = arr_data.a[j + 5];
        call_price = arr_data.a[j + 6];
        spot_price = arr_data.a[j + 7];
        delta = "ATM Intraday IV : " + vols + "<br>  Delta: " + arr_data.a[j + 4] + "<br>  Strike: " + arr_data.a[j + 5] + "<br>  Call Price: " + arr_data.a[j + 6] + "<br>Spot Price: " + arr_data.a[j + 7];

        days_of_expiry = parseFloat(arr_data.a[j + 3]);
        lineColor = "#84C225";


        vol_diff = vols - arr_data.a[1];


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

