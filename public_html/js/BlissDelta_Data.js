/*
 Created by Vineet Jain
 
 This JS File use for Dashboard page in BlissQuants
 
 It include function of 
 add_to_eye() : add script to chart watchlist
 add_to_watchlist() : add script to watchlist
 get_projection() : get IV Projection
 get_intraday(): get historical IV
 make_chart(search); create intraday chart
 make_chart_close(search); create daily IV chart with volume
 make_chart_movement(search); create daily IV chart with movement
 make_chart_indiavix(search); Create Indiavix Chart
 reload_data(): load page on selecting script
 add_event() : add event in daily chart with volume and movement
 get_result(duration) : Get latest quarterly Result of acript
 get_five_day_movement() : get five day future movement
 generateChartData_movement: get data for daily chart with movement
 generateChartData_close: get data for daily chart with volume
 generateChartData_daily_vol: get data of intraday IV
 zoomChart(): zoom amchart for particular date
 generateChartData2(): get data for indiavix chart
 
 */

var min, max, max_vol, min_vol, get_duration, eye_check, c_date, first_vol, first_avg_vol, result_date;
$('#chartdiv_vol_delta').css({
    top: 200,
    left: 600
});

var curr_date; // gives current date


var curr_date1;

var date2; // settind date2 to previous date
//function for prebvious date--------------------

// $( "#day1_vq" ).datepicker('destroy');

$(document).ready(function () {
    //alert("fd");

    /* if ($.cookie("popup_1_2") == null) {
     $("#new_message").modal('show');
     }
     $.cookie("popup_1_2", "2");
     */
    c_date = new Date();
    curr_date = new Date(); // gives current date
    //function for prebvious date--------------------
    curr_date = dateFormat(curr_date, "yyyy-mm-dd");
    $("#day1_vq").datepicker({dateFormat: 'yy-mm-dd', yearRange: "2008:2018", changeYear: true, minDate: c_date, background: '#FFFFFF', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']});
    $('#day1_vq').datepicker('setDate', c_date);

    $("#intra_date").datepicker({dateFormat: 'yy-mm-dd', yearRange: "2008:2018", changeYear: true, maxDate: c_date, background: '#FFFFFF', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']});

    range_sel_delta();


    curr_date1 = new Date();
    curr_date1.setDate(curr_date1.getDate() - 1); // it will give previous day date
    curr_date1 = dateFormat(curr_date1, "yyyy-mm-dd");
    date2 = curr_date1; // settind date2 to previous date
    get_five_day_movement(); // call to function
    document.getElementById('search2').value = "";

    get_projection();

    get_intraday();
    get_result('month');
    /* oTable = $('#employee-grid').dataTable();
     $('#search_earning').keyup(function(){
     // alert("fd");
     oTable.fnFilter($(this).val()); 
     //$('.ticker1').ticker();
     });*/
});
var date1 = "2014-01-09/2014-12-31", date2, day1, day2, day3, week_date, c_date;
var sort, sort_count = 0, search, cnt = 0;
var ar_data;
function add_to_eye()
{
    search = document.getElementById('search1').value;

    if ($("#eye_check").prop('checked') == true) {
        eye_check = "yes";
        document.getElementById('add_toggle').innerHTML = "added";
    } else {
        eye_check = "No";
        document.getElementById('add_toggle').innerHTML = "add";
    }
    var ar_data = {
        eye_check: eye_check,
        search: search
    };
    //alert(eye_check);
    $.ajaxSetup({async: false});                                               // to run jquery ajax fast we have to false syncronization
    $.post('connect/insert_eye.php', {ar_data: ar_data}, function (result) {         // retrieve OHLC value from ohlc_connect.php by company code name
        //  obj = jQuery.parseJSON(result);             
    });
}
function add_to_watchlist()
{//alert("fx");
    search = document.getElementById('search1').value;

    if ($("#watch_check").prop('checked') == true) {
        watch_check = "yes";
        document.getElementById('add_watch').innerHTML = "added";
    } else {
        watch_check = "No";
        document.getElementById('add_watch').innerHTML = "add";
    }
    var ar_data = {
        watch_check: watch_check,
        search: search
    };
    // alert(watch_check);
    $.ajaxSetup({async: false});                                               // to run jquery ajax fast we have to false syncronization
    $.post('connect/insert_watchlist.php', {ar_data: ar_data}, function (result) {         // retrieve OHLC value from ohlc_connect.php by company code name
        //  obj = jQuery.parseJSON(result);             
    });
}

function get_projection() //passing selected duration today,week or month
{
    search = document.getElementById('search1').value;
    date = document.getElementById('day1_vq').value;
    // alert(search);
    ar_data = {date1: date, //date
        c_name2: search // company name
    };
    $.post('connect/get_projection.php', {ar_data: ar_data}, function (result) { //send data to blissdelta_delta_connect.php page
        document.getElementById('projection').innerHTML = result;

    });
}
function get_intraday() //passing selected duration today,week or month
{
    search = document.getElementById('search1').value;
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
}
function range_sel_delta() //passing selected duration today,week or month
{//alert(c_date);
    // todays date     
    date1 = dateFormat(c_date, "yyyy-mm-dd");


    search = document.getElementById('search1').value;

    //alert(search);   

    chart_type = document.getElementById('chart_type').value;
    if (chart_type == "intraday")
    {
        make_chart(search);

    } else if (chart_type == "daily") {
        make_chart_close(search);
    } else if (chart_type == "movement") {
        make_chart_movement(search);

    } else if (chart_type == "election") {
        //alert("fsd");
        make_chart_election(search);

    } else {
        make_chart_indiavix(search);
    }
    /* date1 = dateFormat(c_date, "yyyy-mm-dd");
     date1 = date1+"/2018-05-01";  */
//alert(date1);

    $.post('connect/fii_connect.php', {ar_data: ar_data}, function (result)                       // retrive values from india vix table
    {
        $('#fii-table').DataTable({
            data: jQuery.parseJSON(result),
            "bDestroy": true, //destroy last table 
            "processing": true,
            "deferRender": true,
            "iDisplayLength": 5,
            "bSort": false,
            "scrollY": "200px",
            "bPaginate": false,
            "dom": ' <"top">t<"bottom"p>',
            "order": [[0, "desc"]]

        });
    });
    $.post('connect/fii_connect.php', {ar_data: ar_data}, function (result)                       // retrive values from india vix table
    {   //  alert(jQuery.parseJSON(result)); 
        /* var str2 = 'No Data';
         var str2 = 'No Data';
         if (result.indexOf(str2) === -1)
         {
         arr_data = jQuery.parseJSON(result);
         
         } else
         {
         nope = "no";
         }*/
        $('#fii-table').DataTable({
            data: jQuery.parseJSON(result),
            "bDestroy": true, //destroy last table 
            "processing": true,
            "deferRender": true,
            "iDisplayLength": 5,
            "bSort": false,
            "scrollY": "200px",
            "bPaginate": false,
            "dom": ' <"top">t<"bottom"p>',
            "order": [[0, "desc"]],
        });

    });
    // alert("sdf"); 
    $.post('connect/event_connect.php', {search: search}, function (result)                       // retrive values from india vix table
    {    //alert(result); 

        $('#event-grid').DataTable({
            data: jQuery.parseJSON(result),
            "bDestroy": true, //destroy last table 
            "processing": true,
            "deferRender": true,
            "iDisplayLength": 5,
            "bSort": false,
            "scrollY": "200px",
            "bPaginate": false,
            "dom": ' <"top">t<"bottom"p>',
            "order": [[0, "desc"]],
        });

    });

}

function get_result(duration)
{
    var select = document.getElementById("range").value;


    var get_duration;
    // according to select option date will display

    if (duration == 'today')
    {
        var c_date = new Date();                                                    // take todays date
        var firstDay = new Date(c_date);                                            // take date according to parameter 
        firstDay.setDate(firstDay.getDate());                                       // it will give you first day of date 

        var lastDay = new Date(c_date.getFullYear(), c_date.getMonth() + 1, 0);
        day1 = dateFormat(firstDay, "yyyy-mm-dd");
        day2 = day1;
        day3 = dateFormat(lastDay, "yyyy-mm-dd");
        //week_date = day3;         
        bliss_day1 = dateFormat(day1, "dd mmm yyyy");

        document.getElementById('day2').value = bliss_day1;                               // inserting date bcoz we need this date again as this textfield is disable
        document.getElementById('day1').value = day1;                               // inserting for displaying date
    } else if (duration == 'week')
    {
        var c_date = new Date();
        var firstDay = new Date(c_date);
        firstDay.setDate(firstDay.getDate() - firstDay.getDay() + 1);              // it will give you first day of week
        var lastDay = new Date(c_date);
        lastDay.setDate(lastDay.getDate() - lastDay.getDay() + 7);                // it will give you last day of week
        day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
        day2 = dateFormat(lastDay, "yyyy-mm-dd");



        bliss_day1 = dateFormat(day1, "dd mmm yyyy");
        bliss_day2 = dateFormat(day2, "dd mmm yyyy");
        document.getElementById('day2').value = bliss_day1 + " - " + bliss_day2;
        ;
        document.getElementById('day1').value = day1;
        document.getElementById("day2").size = "25";
        document.getElementById("day1").size = "15";
    } else if (duration == 'month')
    {
        var date = new Date();
        var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);           // it will give first day of month
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);        // it will give last day of month (month +1 means next month, 0 for previous month last date
        day1 = dateFormat(firstDay, "yyyy-mm-dd");
        day2 = dateFormat(lastDay, "yyyy-mm-dd");
        day3 = dateFormat(firstDay, "mmm yyyy");
        var lastdisplay_Day = new Date(date.getFullYear(), date.getMonth() + 4, 0);
        day4 = dateFormat(lastdisplay_Day, "yyyy-mm-dd");
        week_date = day4;
        // week_date = day2;
        document.getElementById('day2').value = day3;
        document.getElementById('day1').value = day1;
    } else if (duration == 'year')
    {
        var date = new Date();
        var firstDay = new Date(date.getFullYear(), 0, 1);
        var lastDay = new Date(date.getFullYear() + 1, 0, 0);
        day1 = dateFormat(firstDay, "yyyy-mm-dd");
        day2 = dateFormat(lastDay, "yyyy-mm-dd");
        day3 = dateFormat(firstDay, "yyyy");
        week_date = day2;
        document.getElementById('day2').value = day3;
        document.getElementById('day1').value = day1;
    } else if (duration == 'range')
    {
        document.getElementById('day2').value = "";                                // if range is seleected then day2 textfield will become enable and we need blank textfield for user                      
        document.getElementById('day1').value = "";
    } else if (duration == 'Go')                                                       //if range is selected then go is enable
    {
        day1 = document.getElementById('day1').value;
        day2 = document.getElementById('day2').value;
    } else if (duration == '<<')
    {
        var select = document.getElementById("range").value;                           //getting the selected value               
        if (day1 > "2009-01-01")                                                        //button will work if date is above 2009-01-01
        {
            if (select == 'today')
            {                                                                        // get_duration = document.getElementById('day2').value;
                get_duration = document.getElementById('day1').value;
                var firstDay = new Date(get_duration);
                firstDay.setDate(firstDay.getDate() - 1);
                var lastDay = new Date(get_duration);
                lastDay.setDate(lastDay.getDate() - lastDay.getDay());
                day1 = dateFormat(firstDay, "yyyy-mm-dd");
                day2 = day1;
                bliss_day1 = dateFormat(day1, "dd mmm yyyy");
                document.getElementById('day2').value = bliss_day1;                               // inserting date bcoz we need this date again as this textfield is disable

                document.getElementById('day1').value = day1;
            } else if (select == 'week')
            {
                get_duration = document.getElementById('day1').value;
                var firstDay = new Date(get_duration);
                firstDay.setDate(firstDay.getDate() - firstDay.getDay() - 6);
                var lastDay = new Date(get_duration);
                lastDay.setDate(lastDay.getDate() - lastDay.getDay());
                day1 = dateFormat(firstDay, "yyyy-mm-dd");
                day2 = dateFormat(lastDay, "yyyy-mm-dd");
                bliss_day1 = dateFormat(day1, "dd mmm yyyy");
                bliss_day2 = dateFormat(day2, "dd mmm yyyy");
                document.getElementById('day2').value = bliss_day1 + " - " + bliss_day2;
                ;
                document.getElementById('day1').value = day1;
            } else if (select == 'month')
            {
                get_duration = document.getElementById('day1').value;
                var date = new Date(get_duration);
                var firstDay = new Date(date.getFullYear(), date.getMonth() - 1, 1);
                var lastDay = new Date(date.getFullYear(), date.getMonth(), 0);
                day1 = dateFormat(firstDay, "yyyy-mm-dd");
                day2 = dateFormat(lastDay, "yyyy-mm-dd");
                day3 = dateFormat(firstDay, "mmm yyyy");
                document.getElementById('day2').value = day3;
                document.getElementById('day1').value = day1;
            } else if (select == 'year')
            {
                get_duration = document.getElementById('day1').value;
                var date = new Date(get_duration);
                var firstDay = new Date(date.getFullYear() - 1, 0, 1);                 // it will give you first day of year
                var lastDay = new Date(date.getFullYear(), 0, 0);                      // it will give you last day of year
                day1 = dateFormat(firstDay, "yyyy-mm-dd");
                day2 = dateFormat(lastDay, "yyyy-mm-dd");
                day3 = dateFormat(firstDay, "yyyy");                                   //we will print value in this format
                document.getElementById('day2').value = day3;
                document.getElementById('day1').value = day1;
            }
        }
    } else if (duration == '>>')                                                      // button will not work beyond current month last date,current month or current year thats why we stored value in week_date
    {
        var select = document.getElementById("range").value;
        //alert(week_date);
        if (day2 < week_date)
        {
            if (select == 'today')
            {
                get_duration = document.getElementById('day1').value;
                var firstDay = new Date(get_duration);
                firstDay.setDate(firstDay.getDate() + 1);
                var lastDay = new Date(get_duration);
                lastDay.setDate(lastDay.getDate() - lastDay.getDay());
                day1 = dateFormat(firstDay, "yyyy-mm-dd");
                day2 = day1;
                bliss_day1 = dateFormat(day1, "dd mmm yyyy");

                document.getElementById('day2').value = bliss_day1;                               // inserting date bcoz we need this date again as this textfield is disable

                document.getElementById('day1').value = day1;
            } else if (select == 'week')
            {
                get_duration = document.getElementById('day1').value;
                var firstDay = new Date(get_duration);
                firstDay.setDate(firstDay.getDate() - firstDay.getDay() + 8);
                var lastDay = new Date(get_duration);
                lastDay.setDate(lastDay.getDate() - lastDay.getDay() + 14);
                day1 = dateFormat(firstDay, "yyyy-mm-dd");
                day2 = dateFormat(lastDay, "yyyy-mm-dd");
                bliss_day1 = dateFormat(day1, "dd mmm yyyy");
                bliss_day2 = dateFormat(day2, "dd mmm yyyy");
                document.getElementById('day2').value = bliss_day1 + " - " + bliss_day2;
                ;
                document.getElementById('day1').value = day1;
            } else if (select == 'month')
            {
                get_duration = document.getElementById('day1').value;
                var date = new Date(get_duration);
                var firstDay = new Date(date.getFullYear(), date.getMonth() + 1, 1);
                var lastDay = new Date(date.getFullYear(), date.getMonth() + 2, 0);
                day1 = dateFormat(firstDay, "yyyy-mm-dd");
                day2 = dateFormat(lastDay, "yyyy-mm-dd");
                day3 = dateFormat(firstDay, "mmm yyyy");
                document.getElementById('day2').value = day3;
                document.getElementById('day1').value = day1;
            } else if (select == 'year')
            {
                get_duration = document.getElementById('day1').value;
                var date = new Date(get_duration);
                var firstDay = new Date(date.getFullYear() + 1, 0, 1);
                var lastDay = new Date(date.getFullYear() + 2, 0, 0);
                day1 = dateFormat(firstDay, "yyyy-mm-dd");
                day2 = dateFormat(lastDay, "yyyy-mm-dd");
                day3 = dateFormat(firstDay, "yyyy");
                document.getElementById('day2').value = day3;
                document.getElementById('day1').value = day1;
            }
        }
    }

    date1 = day1 + "/" + day2;
//  alert(date1);


    $.post('connect/earning_connect.php', {data1: date1}, function (result)                       // retrive values from india vix table
    {    // alert(result); 
        var table = $('#employee-grid').DataTable();

        table
                .clear()
                .draw();
        $.fn.dataTable.ext.errMode = 'throw';
        $('#employee-grid').DataTable({
            data: jQuery.parseJSON(result),
            "bDestroy": true, //destroy last table 
            "processing": true,
            "deferRender": true,
            "iDisplayLength": 5,
            // "bSort": false,
            "scrollY": "200px",
            "bPaginate": false,
            "dom": ' <"top">t<"bottom"p>',
            "order": [[0, "desc"]],
        });
        //     var table = $('#employee-grid').DataTable();
        //   $('#employee-grid').DataTable().scroller().scrollToRow(20);


        /* $('#employee-grid').on( 'error.dt', function ( e, settings, techNote, message ) {
         console.log( 'An error has been reported by DataTables: ', message );
         } ) ;*/

    });


}





/*$(document).keypress(function (event) {
 if (event.keyCode == 13) {
 
 search = document.getElementById('search2').value;
 document.getElementById('search1').value = search;
 //alert(search);
 //document.getElementById('search_value').value=search;
 search = search.replace("&", "_");
 location.href = "BlissDelta_Data.php? search1=" + search;
 
 }
 });*/
function reload_data() {
    search = document.getElementById('search2').value;
    document.getElementById('search1').value = search;
    //alert(search);
    //document.getElementById('search_value').value=search;
    search = search.replace("&", "_");
    location.href = "BlissDelta_Data.php? search1=" + search;
}
function make_chart(c_name2)
{
    var clr = [];
    var chartData;
    //var get_duration_val = document.getElementById("range2").options[document.getElementById("range2").selectedIndex].text;;
    //alert(c_name2);
    // function for get value from url 
    chartData = generateChartData_daily_vol(c_name2);
//alert(chartData)
    //var first_vol = Object.values(chartData[0])[1];// get first value
    var data1 = c_name2;
    company_label = c_name2.toUpperCase();
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
                "precision": 1
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

            "valueText": company_label + " - [[delta_text]]",
            "valueWidth": 400,
            "valueAlign": "left",
            //textClickEnabled:true,
            switchable: false,
            position: "top"
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


//end of function----------------------
function get_five_day_movement() {

    date2 = dateFormat(date2, "yyyy-mm-dd"); //set date formate to yyyy-mm-dd
    // alert(date2 + "  " + curr_date);
    if (date2 == curr_date || date2 == curr_date1 || date2 > curr_date) //check wheter date is equal to current date,previous date or greater then current date
    {
        date2 = curr_date1; // when date is more then current date it set date to current date
        //alert(date2);
        document.getElementById("b2").style.display = "none"; //disable next button
    } else
    {
        document.getElementById("b2").style.display = "inline"; // enable next button
    }
    // alert(date2);
    //last five day movement code starting------------------
    //alert(date1);
    $.ajaxSetup({async: false});
    ar_data = {date1: date2, //date
        c_name2: search // company name
    };
    //alert(ar_data['c_name2']);
//alert(ar_data['c_name2']);
    $.post('connect/BlissDelta_Delta_Connect_2.php', {ar_data: ar_data}, function (result) { //send data to blissdelta_delta_connect.php page

        var obj;
        var str2 = 'No Data';    //display this not data is there
//alert(result);
        if (result.indexOf(str2) == -1)                                                  // check result value and str2 value equal or not
        {
            var obj = jQuery.parseJSON(result);
            /* var comp_name = obj.b;
             $(function () {
             
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
             });*/

            //parsing retrieve value     
            // alert(obj.a);
            $('#delta-table').DataTable({
                data: obj.a,
                "bDestroy": true, //destroy last table 
                "processing": true,
                "deferRender": true,
                "iDisplayLength": 5,
                "bSort": false,
                "bPaginate": false,
                "dom": ' <"top">t<"bottom"p>',
                "order": [[0, "desc"]],
            });


            // $.fn.DataTable.ext.pager.numbers_length = 5; //paginate number on button
            // $('.dataTables_filter input').addClass('form-control control_color');
            //$('.dataTables_length select').addClass('control_color');
        }
        // alert(obj.b);

    });
}
function prevdate()
{

    var pdate = c_date;
    var pday = pdate.getDay();
    pdate.setDate(pdate.getDate() - 6); // decrease six day to current date
    date2 = pdate;
    c_date = date2;
    get_five_day_movement(); // call function
    // alert(c_date);
}
;
function nextdate()
{

    var pdate = c_date;
    //    alert(c_date);
    var pday = pdate.getDay();
    pdate.setDate(pdate.getDate() + 5); // add five day to current date
    date2 = pdate;

    c_date = date2;

    get_five_day_movement(); //call function
    //  alert(c_date);
}
;
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
// this method is called when chart is first inited as we listen for "dataUpdated" event
/*function zoomChart() {
 // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
 chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length + 10);
 }*/
var quarter;
var chart, chartData;
function generateChartData_election(c_name2)
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
    $.post('connect/election_vol_graph_connect.php', {ar_data: ar_data}, function (result)                       // retrive values from india vix table
    {    // alert(result); 
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
    quarter = arr_data.quarter;
    result_date = arr_data.result_date;
    //alert(result_date);
    var newDate, visits, hits, open, volume, days_of_expiry, lineColor, event, delta;
    first_avg_vol = avg_vol;
    for (var i = 0; i < parseInt(arr_data.b); i++) {
        // we create date objects here. In your data, you can have date strings
        // and then set format of your dates using chart.dataDateFormat property,
        // however when possible, use date objects, as this will speed up chart rendering.
        // newDate = new Date(arr_data.a[j]);
        newDate = arr_data.a[j];

        visits = arr_data.a[j + 1];
        delta = "ATM Implied Volatality : " + visits + "<br>  Delta: " + arr_data.a[j + 6] + "<br>  Strike: " + arr_data.a[j + 7] + "<br>  Call Price: " + arr_data.a[j + 8] + "<br>Spot Price: " + arr_data.a[j + 9];

        // bullet = "";
        hits = arr_data.a[j + 2];
        //hits = "";
        open = 0;
        volume = arr_data.a[j + 3];
        days_of_expiry = arr_data.a[j + 4];
        bullet = arr_data.a[j + 5];

        if (days_of_expiry < 4)
        {
            lineColor = "#0000FF";
        } else {
            lineColor = "#84C225";
        }

        chartData.push({
            name: name,
            date: newDate, //date
            open: open,
            visits: visits, //india vix data
            hits: hits, // nifty data
            lineColor: lineColor, //line color
            "bullet": bullet,
            "avg_vol": avg_vol,
            "volume": volume,
            delta_text: delta
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
                "lineColor": lineColor
            });
        }
        j = j + 10;


    }
    //  alert(chartData);
    return {
        chartData: chartData,
        trendData: trendData
    };
    //   return chartData;

}
function make_chart_election(c_name2)
{
    var clr = [];
    var chartData, charttrend;
    // var get_duration_val = document.getElementById("range2").options[document.getElementById("range2").selectedIndex].text;;
    var data1 = c_name2;// + " IV  Min-Max  :    Blue mark is an expiry week";
    // function for get value from url 
    company_label = c_name2.toUpperCase();
    charttrend = generateChartData_election(c_name2);
    //  var codes = newCodes();
    chartData = charttrend.chartData;
    var trendData = charttrend.trendData;
    //var first_avg_vol=Object.values(chartData[Object.keys(chartData).length - 5])[7];// get first value    
    //   var first_avg_vol = Object.values(chartData[0])[7];// get first value        
    // alert(getCol(Object.values(chartData),0))
//alert(chartData);

    chart = AmCharts.makeChart("chartdiv_vol_delta", {
        "type": "stock",
        "theme": "none",
        "color": "#fff",
        "pathToImages": "amstockchart/amcharts/images/",
        "autoMarginOffset": 20,
        "mouseWheelZoomEnabled": true,
        /* "listeners": [{
         "event": "dataUpdated",
         "method": handleZoom,
         "startDate":"2018-01-01",
         }
         ],*/
        // "dataProvider": chartData,                       // data pass from chartData array
        "dataSets": [{
                "color": "#84C225",
                "fieldMappings": [{
                        "fromField": "visits",
                        "toField": "visits"
                    }, {
                        "fromField": "hits",
                        "toField": "hits"
                    }, {
                        "fromField": "volume",
                        "toField": "volume"
                    }],
                "dataProvider": chartData,
                "categoryField": "date",
                "stockEvents": [{
                        "date": new Date(2018, 6, 19),
                        type: "sign",
                        "text": "H",
                        backgroundColor: "#00CC00",
                        "graph": "volGraph",
                        "description": "High IV"
                    },
                    {
                        "date": new Date(2018, 7, 19),
                        type: "sign",
                        "text": "L",
                        backgroundColor: "#CC0000",
                        "graph": "volGraph",
                        "description": "Low IV"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        "text": "R",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    }
                ]
            }],
        "panels": [{
                "showCategoryAxis": false,
                "plotAreaBorderColor": "#000",
                "plotAreaBorderAlpha": 1,
                "percentHeight": 70,
                "stockGraphs": [{
                        "id": "volGraph",
                        //    "title": data1,
                        "fillAlphas": 0.3,
                        "negativeBase": first_avg_vol,
                        "negativeLineColor": "#FF0000",
                        "fillColorsField": "lineColor",
                        "lineColorField": "lineColor",
                        "lineThickness": 2,
                        // "title":  "[[delta_text]]",
                        "valueField": "visits",
                        //  "showBalloon": true,
                        "bullet": "round",
                              "bulletSize": 2
                        // "customBullet": "bullet",

                        //  "customBulletField": "bullet",
                        // "bulletField": "bullet",
                  
                                // "labe"
                    }/*, {
                        //  "id": "volGraph",
                        "valueAxis": "v1",
                        "lineColor": "#000",
                        "lineThickness": 2,
                        "title": quarter + " Avg IV " + " ",
                        //  "balloonText": "[[nifty_text]]" ,
                        "valueField": "hits",
                        "useDataSetColors": false,
                        //"balloonText": quarter + "<b> Avg IV </b>" ,

                    }*/],
                "stockLegend": {
                    "valueTextRegular": "",
                    "markerType": "line",
                    "marginTop": 20,
                    "color": "#fff",
                    "valueText": company_label + " - [[delta_text]]",
                    /* "color": "#FFF", // text colour 
                     "data": "",
                     verticalGap: 0,
                     fontSize: 12,
                     markerType: "none",
                     // autoMargins : false,
                     /// marginLeft : 0,
                     //labelText : data1,
                     
                     "valueText": company_label + " - [[delta_text]]",
                     "valueWidth": 400,
                     "valueAlign": "left",
                     //textClickEnabled:true,
                     switchable: false,
                     position: "top"*/
                }
            }, {
                "plotAreaBorderColor": "#000",
                "plotAreaBorderAlpha": 1,
                "title": "Volume",
                "percentHeight": 30,
                "stockGraphs": [{
                        "valueField": "volume",
                        // "type": "serial",
                        // "lineColor": "#84C225",
                        // "cornerRadiusTop": 2,
                        "fillAlphas": 1
                    }],
                "stockLegend": {
                    "valueTextRegular": " ",
                    "markerType": "none",
                    "valueText": quarter + " Avg IV " + " ",
                },
                "valueAxes": [{
                        "usePrefixes": true,
                        "axisColor": "#FFF",
                        "axisThickness": 2,
                        "gridAlpha": 0,
                        "axisAlpha": 4,
                        "precision": 0,
                        "color": "#84C225"
                    }],
            }
        ],
        "panelsSettings": {
            //    "color": "#fff",

            "marginLeft": 10,
            "marginTop": 5,
            "marginBottom": 5,
            "marginRight": 10,
        },
        /*"balloon": {
         //  "adjustBorderColor": false,
         "color": "#FFFFFF",
         "borderThickness" : 2,
         "borderAlpha" : 0,
         "fixedPosition": false,
         "offsetX": 50,
         "offsetY": 80,
         
         "fillColor": "transparent"
         },*/
        "chartScrollbarSettings": {
            //  "graph": "volGraph",
            "autoGridCount": true,
            "backgroundColor": "#84C225",
            "backgroundAlpha": 0.5,
            "gridColor": "#84C225",
            "selectedBackgroundColor": "rgb(58, 53, 49)",
            "selectedBackgroundAlpha": 1,
            "position": "top"
        },
        "categoryAxesSettings": {
            "axisColor": "#FFF",
            "color": "#fff",
            "axisThickness": 2,
            "maxSeries": 900,
        },
        "valueAxesSettings": {
            "color": "#84C225",
            "gridAlpha": 0,
            "inside": true,
            "showLastLabel": true,
            "precision": 1
        },
        "chartCursorSettings": {
            //"pan": true,
            "balloonPointerOrientation": "vertical",
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "categoryBalloonColor": "#0000ff",
            "cursorColor": "#0000FF",
            //valueBalloonsEnabled: true,
        },
        "periodSelector": {
            "position": "bottom",
            "dateFormat": "YYYY-MM-DD",
            "inputFieldsEnabled": false,
            "periods": [
                {
                    "period": "DD",
                    "count": 200,
                    "selected": true,
                    "label": ""
                }],
        },
        "dataDateFormat": "YYYY-MM-DD"
                /* "export": {
                 "enabled": true
                 }*/
    });

    chart.addListener("zoomed", function (event) {
        add_event(event);

    });
//alert(chartData);
    zoomChart();

    // GRAPHS
    // duration graph
    /*  var durationGraph = new AmCharts.AmGraph();
     
     durationGraph.lineColorField = "lineColor";
     durationGraph.fillColorsField = "lineColor";
     durationGraph.fillAlphas = 0.3;
     durationGraph.balloonText = "[[value]]";
     durationGraph.lineThickness = 1;
     durationGraph.legendValueText = "[[value]]";*/


//chart.zoomToCategoryValues(new Date(2017, 2, 10), new Date(2017,3,12));
    // zoomChart();
}
function make_chart_close(c_name2)
{
    var clr = [];
    var chartData, charttrend;
    // var get_duration_val = document.getElementById("range2").options[document.getElementById("range2").selectedIndex].text;;
    var data1 = c_name2;// + " IV  Min-Max  :    Blue mark is an expiry week";
    // function for get value from url 
    company_label = c_name2.toUpperCase();
    charttrend = generateChartData_close(c_name2);
    //  var codes = newCodes();
    chartData = charttrend.chartData;
    var trendData = charttrend.trendData;
    //var first_avg_vol=Object.values(chartData[Object.keys(chartData).length - 5])[7];// get first value    
    //   var first_avg_vol = Object.values(chartData[0])[7];// get first value        
    // alert(getCol(Object.values(chartData),0))
//alert(chartData);

    chart = AmCharts.makeChart("chartdiv_vol_delta", {
        "type": "stock",
        "theme": "none",
        "color": "#fff",
        "pathToImages": "amstockchart/amcharts/images/",
        "autoMarginOffset": 20,
        "mouseWheelZoomEnabled": true,
        /* "listeners": [{
         "event": "dataUpdated",
         "method": handleZoom,
         "startDate":"2018-01-01",
         }
         ],*/
        // "dataProvider": chartData,                       // data pass from chartData array
        "dataSets": [{
                "color": "#84C225",
                "fieldMappings": [{
                        "fromField": "visits",
                        "toField": "visits"
                    }, {
                        "fromField": "hits",
                        "toField": "hits"
                    }, {
                        "fromField": "volume",
                        "toField": "volume"
                    }],
                "dataProvider": chartData,
                "categoryField": "date",
                "stockEvents": [{
                        "date": new Date(2018, 6, 19),
                        type: "sign",
                        "text": "H",
                        backgroundColor: "#00CC00",
                        "graph": "volGraph",
                        "description": "High IV"
                    },
                    {
                        "date": new Date(2018, 7, 19),
                        type: "sign",
                        "text": "L",
                        backgroundColor: "#CC0000",
                        "graph": "volGraph",
                        "description": "Low IV"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        "text": "R",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    }
                ]
            }],
        "panels": [{
                "showCategoryAxis": false,
                "plotAreaBorderColor": "#000",
                "plotAreaBorderAlpha": 1,
                "percentHeight": 70,
                "stockGraphs": [{
                        "id": "volGraph",
                        "title": data1,
                        "fillAlphas": 0.3,
                        "negativeBase": first_avg_vol,
                        "negativeLineColor": "#FF0000",
                        "fillColorsField": "lineColor",
                        "lineColorField": "lineColor",
                        "lineThickness": 2,
                        "title":  company_label + " At The Money IV (Blue line indicates expiry week)",
                                "valueField": "visits",
                        // "showBalloon": false
                        // "bullet": "diamond",
                        // "customBullet": "bullet",

                        //  "customBulletField": "bullet",
                        // "bulletField": "bullet",
                        // "bulletSize": 15
                        // "labe"
                    }, {
                        //  "id": "volGraph",
                        "valueAxis": "v1",
                        "lineColor": "#000",
                        "lineThickness": 2,
                        "title": quarter + " Avg IV " + " ",
                        //  "balloonText": "[[nifty_text]]" ,
                        "valueField": "hits",
                        "useDataSetColors": false,
                        //"balloonText": quarter + "<b> Avg IV </b>" ,

                    }],
                "stockLegend": {
                    "valueTextRegular": "",
                    "markerType": "line",
                    "marginTop": 20,
                    "color": "#fff"
                }
            }, {
                "plotAreaBorderColor": "#000",
                "plotAreaBorderAlpha": 1,
                "title": "Volume",
                "percentHeight": 30,
                "stockGraphs": [{
                        "valueField": "volume",
                        // "type": "serial",
                        // "lineColor": "#84C225",
                        // "cornerRadiusTop": 2,
                        "fillAlphas": 1
                    }],
                "stockLegend": {
                    "valueTextRegular": " ",
                    "markerType": "none"
                },
                "valueAxes": [{
                        "usePrefixes": true,
                        "axisColor": "#FFF",
                        "axisThickness": 2,
                        "gridAlpha": 0,
                        "axisAlpha": 4,
                        "precision": 0,
                        "color": "#84C225"
                    }],
            }
        ],
        "panelsSettings": {
            //    "color": "#fff",

            "marginLeft": 10,
            "marginTop": 5,
            "marginBottom": 5,
            "marginRight": 10,
        },
        /*"balloon": {
         //  "adjustBorderColor": false,
         "color": "#FFFFFF",
         "borderThickness" : 2,
         "borderAlpha" : 0,
         "fixedPosition": false,
         "offsetX": 50,
         "offsetY": 80,
         
         "fillColor": "transparent"
         },*/
        "chartScrollbarSettings": {
            //  "graph": "volGraph",
            "autoGridCount": true,
            "backgroundColor": "#84C225",
            "backgroundAlpha": 0.5,
            "gridColor": "#84C225",
            "selectedBackgroundColor": "rgb(58, 53, 49)",
            "selectedBackgroundAlpha": 1,
            "position": "top"
        },
        "categoryAxesSettings": {
            "axisColor": "#FFF",
            "color": "#fff",
            "axisThickness": 2,
            "maxSeries": 900,
        },
        "valueAxesSettings": {
            "color": "#84C225",
            "gridAlpha": 0,
            "inside": true,
            "showLastLabel": true,
            "precision": 1
        },
        "chartCursorSettings": {
            //"pan": true,
            "balloonPointerOrientation": "vertical",
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "categoryBalloonColor": "#0000ff",
            "cursorColor": "#0000FF",
            //valueBalloonsEnabled: true,
        },
        "periodSelector": {
            "position": "bottom",
            "dateFormat": "YYYY-MM-DD",
            "inputFieldsEnabled": false,
            "periods": [
                {
                    "period": "DD",
                    "count": 200,
                    "selected": true,
                    "label": ""
                }],
        },
        "dataDateFormat": "YYYY-MM-DD"
                /* "export": {
                 "enabled": true
                 }*/
    });

    chart.addListener("zoomed", function (event) {
        add_event(event);

    });
//alert(chartData);
    zoomChart();

    // GRAPHS
    // duration graph
    /*  var durationGraph = new AmCharts.AmGraph();
     
     durationGraph.lineColorField = "lineColor";
     durationGraph.fillColorsField = "lineColor";
     durationGraph.fillAlphas = 0.3;
     durationGraph.balloonText = "[[value]]";
     durationGraph.lineThickness = 1;
     durationGraph.legendValueText = "[[value]]";*/


//chart.zoomToCategoryValues(new Date(2017, 2, 10), new Date(2017,3,12));
    // zoomChart();
}
/*function zoomChart() {
 // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
 chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
 }*/
/*function handleZoom(event) {
 var startDate = event.startDate;
 alert(startDate);
 var endDate = event.endDate;
 document.getElementById("startDate").value = AmCharts.formatDate(startDate, "DD/MM/YYYY");
 document.getElementById("endDate").value = AmCharts.formatDate(endDate, "DD/MM/YYYY");
 
 // as we also want to change graph type depending on the selected period, we call this method
 changeGraphType(event);
 }*/
function make_chart_movement(c_name2)
{
    var clr = [];
    var chartData, charttrend;
    // var get_duration_val = document.getElementById("range2").options[document.getElementById("range2").selectedIndex].text;;
    var data1 = c_name2;// + " IV  Min-Max  :    Blue mark is an expiry week";
    company_label = c_name2.toUpperCase();
    // function for get value from url 
    charttrend = generateChartData_movement(c_name2);
    //  var codes = newCodes();
    chartData = charttrend.chartData;
    var trendData = charttrend.trendData;
    //var first_avg_vol=Object.values(chartData[Object.keys(chartData).length - 5])[7];// get first value    
    //   var first_avg_vol = Object.values(chartData[0])[7];// get first value        
    // alert(getCol(Object.values(chartData),0))
//alert(chartData);

    chart = AmCharts.makeChart("chartdiv_vol_delta", {
        "type": "stock",
        "theme": "none",
        "color": "#fff",
        "pathToImages": "amstockchart/amcharts/images/",
        "autoMarginOffset": 20,
        "mouseWheelZoomEnabled": true,
        /* "listeners": [{
         "event": "dataUpdated",
         "method": handleZoom,
         "startDate":"2018-01-01",
         }
         ],*/
        // "dataProvider": chartData,                       // data pass from chartData array
        "dataSets": [{
                "color": "#84C225",
                "fieldMappings": [{
                        "fromField": "visits",
                        "toField": "visits"
                    }, {
                        "fromField": "hits",
                        "toField": "hits"
                    }, {
                        "fromField": "volume",
                        "toField": "volume"
                    }],
                "dataProvider": chartData,
                "categoryField": "date",
                "stockEvents": [{
                        "date": new Date(2018, 6, 19),
                        type: "sign",
                        "text": "H",
                        backgroundColor: "#00CC00",
                        "graph": "volGraph",
                        "description": "High IV"
                    },
                    {
                        "date": new Date(2018, 7, 19),
                        type: "sign",
                        "text": "L",
                        backgroundColor: "#CC0000",
                        "graph": "volGraph",
                        "description": "Low IV"
                    },
                    {
                        "date": new Date(2017, 11, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 1, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 2, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 3, 19),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 19),
                        type: "sign",
                        "text": "R",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 4, 11),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "R",
                        "description": "Result"
                    },
                    {
                        "date": new Date(2018, 9, 5),
                        type: "sign",
                        backgroundColor: "#FFF",
                        "graph": "volGraph",
                        "borderColor": "#0000FF",
                        "color": "#000",
                        "text": "D",
                        "description": "Result"
                    }
                ]
            }],
        "panels": [{
                "showCategoryAxis": false,
                "plotAreaBorderColor": "#000",
                "plotAreaBorderAlpha": 1,
                "percentHeight": 70,
                "stockGraphs": [{
                        "id": "volGraph",
                        "title": data1,
                        "fillAlphas": 0.3,
                        "negativeBase": first_avg_vol,
                        "negativeLineColor": "#FF0000",
                        "fillColorsField": "lineColor",
                        "lineColorField": "lineColor",
                        "lineThickness": 2,
                        "title": company_label + " At The Money IV (Blue line indicates expiry week)",
                                "valueField": "visits",
                        "bulletField": "bullet",
                        "bulletSize": 30

                                //"fillAlphas": 0
                    }, {
                        //  "id": "volGraph",
                        "valueAxis": "v1",
                        "lineColor": "#000",
                        "lineThickness": 2,
                        "title": quarter + " Avg IV " + first_avg_vol,
                        //  "balloonText": "[[nifty_text]]" ,
                        "valueField": "hits",
                        "useDataSetColors": false,
                        //"balloonText": quarter + "<b> Avg IV </b>" ,

                    }],
                "stockLegend": {
                    "valueTextRegular": " ",
                    "markerType": "line",
                    "marginTop": 20,
                    "color": "#fff"
                }
            }, {
                "plotAreaBorderColor": "#000",
                "plotAreaBorderAlpha": 1,
                "title": "Future Movement",
                "percentHeight": 30,
                "stockGraphs": [{
                        "valueField": "volume",
                        "type": "column",
                        "fillAlphas": 1,
                    }],
                "stockLegend": {
                    "valueTextRegular": " ",
                    "markerType": "none"
                },
                "valueAxes": [{
                        "usePrefixes": true,
                        "axisColor": "#FFF",
                        "axisThickness": 2,
                        "gridAlpha": 0,
                        "axisAlpha": 4,
                        "precision": 0,
                        "color": "#84C225"
                    }],
            }
        ],
        "panelsSettings": {
            //    "color": "#fff",

            "marginLeft": 10,
            "marginTop": 5,
            "marginBottom": 5,
            "marginRight": 10,
        },
        "chartScrollbarSettings": {
            //  "graph": "volGraph",
            "autoGridCount": true,
            "backgroundColor": "#84C225",
            "backgroundAlpha": 0.5,
            "gridColor": "#84C225",
            "selectedBackgroundColor": "rgb(58, 53, 49)",
            "selectedBackgroundAlpha": 1,
            "position": "top"
        },
        "categoryAxesSettings": {
            "axisColor": "#FFF",
            "color": "#fff",
            "axisThickness": 2,
            "maxSeries": 900,
        },
        "valueAxesSettings": {
            "color": "#84C225",
            "gridAlpha": 0,
            "inside": true,
            "showLastLabel": true,
            "precision": 1
        },
        "chartCursorSettings": {
            //"pan": true,
            "balloonPointerOrientation": "vertical",
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "categoryBalloonColor": "#0000ff",
            "cursorColor": "#0000FF",
            //valueBalloonsEnabled: true,
        },
        "periodSelector": {
            "position": "bottom",
            "dateFormat": "YYYY-MM-DD",
            "inputFieldsEnabled": false,
            "periods": [
                {
                    "period": "DD",
                    "count": 200,
                    "selected": true,
                    "label": ""
                }]
        },
        "dataDateFormat": "YYYY-MM-DD"

    });


    chart.addListener("zoomed", function (event) {
        add_event(event);

    });
    zoomChart();


}
function add_event(event) {
    //console.log(chart.panels[0].valueAxes[0]);
    // get panel and graph
//alert(c_name2);
    var panel = chart.panels[0];
    var graph = panel.stockGraphs[0];

    // iterate through panel's data
    // find dates with lowest and highest values
    var min;
    var max;

    var minDate;
    var maxDate = 0;

    var field = graph.valueField + graph.periodValue;
    // alert("fg" + result_date[21] + "");
    //  alert("fd");
    for (var i = 0; i < panel.dataProvider.length; i++) {
        var row = panel.dataProvider[i];
        // eliminate out of reach dates
        if (row.date < event.startDate)
            continue;
        else if (row.date > event.endDate)
            break;
        if ((min === undefined || (min > row[field])) && row.lineColor === "#84C225") {
            min = row[field];
            minDate = row.date;
        }
        if ((max === undefined || (max < row[field])) && row.lineColor === "#84C225") {
            max = row[field];
            maxDate = row.date;
        }
    }

    // update StockEvents for the two
    var dataSet = chart.dataSets[0];

    //dataSet.stockEvents[0].date = new Date("2018-03-19");
    dataSet.stockEvents[0].date = maxDate;
    dataSet.stockEvents[1].date = minDate;


    result_size = result_date.length - 1;
    cnt = 2;

    for (i = result_size; i > (result_size - 7); i--)
    {
        if (result_date[i] > "2016-12-31")
        {
            dataSet.stockEvents[cnt].date = new Date(result_date[i]);
            //alert(result_date[i]);
            cnt = cnt + 1;
        }
    }

    // var s_events = new chart.stockEvents() ;


    // alert(chart.dataSets[0]);

    chart.validateNow(true, true);

    // set defautl period
    if (chart.defaultPeriodSet === undefined) {
        chart.defaultPeriodSet = true;
        chart.periodSelector.setDefaultPeriod();
    }
}
function zoomChart() {

    chart.zoom(new Date(2018, 2, 10), new Date(2018, 6, 12));
    // chart.zoomToIndexes(chartData.length - 7, chartData.length - 1);
    //chart.zoomToDates(new Date(2017, 2, 10), new Date(2017,2,12));
    // or ==> event.chart.valueAxis.zoomToValues(new Date(2017, 2, 10), new Date(2017,2,12));
}

function generateChartData_close(c_name2)
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
    {    // alert(result); 
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
    quarter = arr_data.quarter;
    result_date = arr_data.result_date;
    //alert(result_date);
    var newDate, visits, hits, open, volume, days_of_expiry, lineColor, event;
    first_avg_vol = avg_vol;
    for (var i = 0; i < parseInt(arr_data.b); i++) {
        // we create date objects here. In your data, you can have date strings
        // and then set format of your dates using chart.dataDateFormat property,
        // however when possible, use date objects, as this will speed up chart rendering.
        // newDate = new Date(arr_data.a[j]);
        newDate = arr_data.a[j];

        visits = arr_data.a[j + 1];

        // bullet = "";
        hits = arr_data.a[j + 2];
        //hits = "";
        open = 0;
        volume = arr_data.a[j + 3];
        days_of_expiry = arr_data.a[j + 4];
        bullet = arr_data.a[j + 5];

        if (days_of_expiry < 4)
        {
            lineColor = "#0000FF";
        } else {
            lineColor = "#84C225";
        }

        chartData.push({
            name: name,
            date: newDate, //date
            open: open,
            visits: visits, //india vix data
            hits: hits, // nifty data
            lineColor: lineColor, //line color
            "bullet": bullet,
            "avg_vol": avg_vol,
            "volume": volume,
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
                "lineColor": lineColor
            });
        }
        j = j + 6;


    }
    //  alert(chartData);
    return {
        chartData: chartData,
        trendData: trendData
    };
    //   return chartData;

}

function generateChartData_movement(c_name2)
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
    $.post('connect/close_movement_graph_connect.php', {ar_data: ar_data}, function (result)                       // retrive values from india vix table
    {    //  alert(result); 
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
    quarter = arr_data.quarter;
    result_date = arr_data.result_date;

    var newDate, visits, hits, open, volume, days_of_expiry, lineColor;
    first_avg_vol = avg_vol;
    for (var i = 0; i < parseInt(arr_data.b); i++) {
        // we create date objects here. In your data, you can have date strings
        // and then set format of your dates using chart.dataDateFormat property,
        // however when possible, use date objects, as this will speed up chart rendering.
        newDate = arr_data.a[j];
        // newDate.setDate(newDate.getDate() + i);

        visits = arr_data.a[j + 1];

        // bullet = "";
        hits = arr_data.a[j + 2];
        //hits = "";
        open = 0;
        volume = arr_data.a[j + 3];
        days_of_expiry = arr_data.a[j + 4];
        bullet = arr_data.a[j + 5];
        if (days_of_expiry < 4)
        {
            lineColor = "#0000FF";
        } else {
            lineColor = "#84C225";
        }

        chartData.push({
            name: name,
            date: newDate, //date
            open: open,
            visits: visits, //india vix data
            hits: hits, // nifty data
            "bullet": bullet,
            lineColor: lineColor, //line color

            "avg_vol": avg_vol,
            "volume": volume
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
                "lineColor": lineColor
            });
        }
        j = j + 6;


    }
    //  alert(chartData);
    return {
        chartData: chartData,
        trendData: trendData
    };
    //   return chartData;

}


function make_chart_indiavix()
{
    day1 = dateFormat(c_date, "yyyy-mm-dd");                                 //formating date
    //  day1 = '2017-12-12';
    date1 = "2017-01-01/" + day1;
    //chartData = generateChartData();                                                         // As selected value it will display graph according to that
    chartData2 = generateChartData2();

    var chart = AmCharts.makeChart("chartdiv_vol_delta", {
        "type": "serial",
        "theme": "none",
        "color": "#fff",
        "pathToImages": "amstockchart/amcharts/images/",
        "plotAreaBorderAlpha": 1,
        "plotAreaBorderColor": "#000",
        "dataProvider": chartData2, // data pass from chartData array

        "valueAxes": [{
                "id": "v1",
                "axisColor": "#000",
                "axisAlpha": 4,
                "axisThickness": 0,
                "gridAlpha": 0,
                "position": "left",
                "precision": 2,
                "color": "#84C225"
            }],
        "graphs": [{
                "valueAxis": "v1",
                "lineColor": "#84C225",
                "customBullet": "bliss_icon.ico",
                "bulletSize": "15",
                "bulletBorderThickness": 80,
                "hideBulletsCount": 20,
                "lineThickness": 2,
                "title": "India Vix",
                "balloonText": "[[iv_text]]",
                "valueField": "visits",
                "fillAlphas": 0
            }],
        "legend": {// line colour with information at below
            "color": "#FFF", // text colour 
            //"data" :[{title: "" }],   
            verticalGap: 0,
            fontSize: 12,
            markerType: "line",
            // autoMargins : false,
            /// marginLeft : 0,
            // labelText : "Quarter Average",

            "valueText": " ",
            // "valueWidth" : 400,
            //   "valueAlign" : "left",
            //textClickEnabled:true,
            switchable: false,
            //position: "bottom"
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
        "chartCursor": {
            "cursorPosition": "mouse",
            "categoryBalloonColor": "#0000ff",
            "cursorColor": "#0000FF",
            "categoryBalloonEnabled": true,
            "categoryBalloonDateFormat": "DD MMM YYYY ",
            "valueLineBalloonEnabled": true,
            "valueLineEnabled": true,
            "valueBalloonsEnabled": false,
            "valueLineAlpha": 1,
        },
        "categoryField": "date2",
        "categoryAxis": {
            "parseDates": true,
            "axisColor": "#000",
            "minorGridEnabled": true,
            "axisThickness": 0
        },
        "dataDateFormat": "YYYY-MM-DD"
    });

}

//chart.addListener("dataUpdated", zoomChart);

//zoomChart();

// generate some random data, quite different range
function generateChartData2() {

    var nope = "";
    var arr_data = [];
    //alert(date);
    $.ajaxSetup({async: false});
    $.post('connect/iv_connect.php', {date1: date1}, function (result)                       // retrive values from india vix table
    {
        // alert(result);
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
    var i = 0, j = 0;
    var st = "";

    for (var i = 0; i < parseInt(arr_data.b); i++) {
        // we create date objects here. In your data, you can have date strings
        // and then set format of your dates using chart.dataDateFormat property,
        // however when possible, use date objects, as this will speed up chart rendering.
        var newDate = arr_data.a[j];
        // newDate.setDate(newDate.getDate() + i);

        var visits = parseFloat(arr_data.a[j + 1]);
        var hits = parseFloat(arr_data.a[j + 2]);

        var ud_value = "", line_color = "#84C225", iv_close, nft_p_close, nft_close, iv_change, nft_change, iv_balloon, nft_balloon;

        nft_p_close = parseFloat(arr_data.a[j - 1]);
        nft_close = parseFloat(arr_data.a[j + 2]);

        nft_change = (nft_close - nft_p_close) * 100 / nft_p_close;


        iv_balloon = "<b><span style='color:#417CA7'>India VIX</span> <br>" + Math.abs(arr_data.a[j + 1]).toFixed(1) + "</b>";

        if (nft_change > 1)
        {
            nft_balloon = "<b><span style='color:#005900;'>Nifty</span> <br>" + Math.abs(arr_data.a[j + 2]).toFixed(1) + "<br> <span style='color:#005900'>" + Math.abs(nft_p_close - nft_close).toFixed(2) + "  Point Up</span></b>";
            line_color = "#ffffff";
            ud_value = arr_data.a[j + 2];
        } else if (nft_change < (-1))
        {
            nft_balloon = "<b><span style='color:#005900;'>Nifty</span> <br>" + Math.abs(arr_data.a[j + 2]).toFixed(1) + "<br> <span style='color:ff0000'>" + Math.abs(nft_p_close - nft_close).toFixed(2) + "  Point Down </span></b>";
            line_color = "#ffffff";
            ud_value = arr_data.a[j + 2];
        } else
        {
            nft_balloon = "<b><span style='color:#005900'>Nifty</span> <br>" + Math.abs(arr_data.a[j + 2]).toFixed(1) + "</b>";
        }

        chartData.push({
            date2: newDate, //date
            visits: visits, //india vix data
            hits: hits, // nifty data
            iv_text: iv_balloon, //india vix text
            nifty_text: nft_balloon, //nifty text
            lineColor: line_color, //line color
            ud_value: ud_value
        });
        j = j + 3;
    }
//  document.getElementById("vix_update").innerHTML = "Last Updated: "+arr_data.a[j - 3];
    return chartData;
}

function probability(price, target, days, volatility) {

    var p = price;
    var q = target;
    var t = days / 365;
    var v = volatility;

    var vt = v * Math.sqrt(t);
    var lnpq = Math.log(q / p);

    var d1 = lnpq / vt;

    var y = Math.floor(1 / (1 + .2316419 * Math.abs(d1)) * 100000) / 100000;
    var z = Math.floor(.3989423 * Math.exp(-((d1 * d1) / 2)) * 100000) / 100000;
    var y5 = 1.330274 * Math.pow(y, 5);
    var y4 = 1.821256 * Math.pow(y, 4);
    var y3 = 1.781478 * Math.pow(y, 3);
    var y2 = 0.356538 * Math.pow(y, 2);
    var y1 = 0.3193815 * y;
    var x = 1 - z * (y5 - y4 + y3 - y2 + y1);
    x = Math.floor(x * 100000) / 100000;

    if (d1 < 0) {
        x = 1 - x
    }
    ;

    var pbelow = Math.floor(x * 1000) / 10;
    var pabove = Math.floor((1 - x) * 1000) / 10;

    return [pbelow, pabove];
}

function probability_above(price, target, days, volatility) {
    return probability(price, target, days, volatility)[1];
}

function probability_below(price, target, days, volatility) {
    return probability(price, target, days, volatility)[0];
}

function ndist(z) {
    return (1.0 / (Math.sqrt(2 * Math.PI))) * Math.exp(-0.5 * z);
    //??  Math.exp(-0.5*z*z)
}

function N(z) {
    b1 = 0.31938153;
    b2 = -0.356563782;
    b3 = 1.781477937;
    b4 = -1.821255978;
    b5 = 1.330274429;
    p = 0.2316419;
    c2 = 0.3989423;
    a = Math.abs(z);
    if (a > 6.0) {
        return 1.0;
    }
    t = 1.0 / (1.0 + a * p);
    b = c2 * Math.exp((-z) * (z / 2.0));
    n = ((((b5 * t + b4) * t + b3) * t + b2) * t + b1) * t;
    n = 1.0 - b * n;
    if (z < 0.0) {
        n = 1.0 - n;
    }
    return n;
}

function fraction(z) {
// given a decimal number z, return a string with whole number + fractional string
// i.e.  z = 4.375, return "4 3/8"

    var whole = Math.floor(z);
    var fract = z - whole;
    var thirtytwos = Math.round(fract * 32);
    if (thirtytwos == 0) {
        return whole + " ";
    }  //(if fraction is < 1/64)
    if (thirtytwos == 32) {
        return whole + 1;
    }  //(if fraction is > 63/64)

//32's non-trivial denominators: 2,4,8,16
    if (thirtytwos / 16 == 1) {
        return whole + " 1/2";
    }

    if (thirtytwos / 8 == 1) {
        return whole + " 1/4";
    }
    if (thirtytwos / 8 == 3) {
        return whole + " 3/4";
    }

    if (thirtytwos / 4 == Math.floor(thirtytwos / 4)) {
        return whole + " " + thirtytwos / 4 + "/8";
    }

    if (thirtytwos / 2 == Math.floor(thirtytwos / 2)) {
        return whole + " " + thirtytwos / 2 + "/16";
    } else
        return whole + " " + thirtytwos + "/32";

} //end function
function black_scholes(call, S, X, r, v, t) {
// call = Boolean (to calc call, call=True, put: call=false)
// S = stock prics, X = strike price, r = no-risk interest rate
// v = volitility (1 std dev of S for (1 yr? 1 month?, you pick)
// t = time to maturity

// define some temp vars, to minimize function calls
    var sqt = Math.sqrt(t);
    var Nd2;  //N(d2), used often
    var nd1;  //n(d1), also used often
    var ert;  //e(-rt), ditto
    var delta;  //The delta of the option

    d1 = (Math.log(S / X) + r * t) / (v * sqt) + 0.5 * (v * sqt);
    d2 = d1 - (v * sqt);

    if (call) {
        delta = N(d1);
        Nd2 = N(d2);
    } else { //put
        delta = -N(-d1);
        Nd2 = -N(-d2);
    }

    ert = Math.exp(-r * t);
    nd1 = ndist(d1);

    gamma = nd1 / (S * v * sqt);
    vega = S * sqt * nd1;
    theta = -(S * v * nd1) / (2 * sqt) - r * X * ert * Nd2;
    rho = X * t * ert * Nd2;

    return (S * delta - X * ert * Nd2);

} //end of black_scholes

function option_implied_volatility(call, S, X, r, t, o) {
// call = Boolean (to calc call, call=True, put: call=false)
// S = stock prics, X = strike price, r = no-risk interest rate
// t = time to maturity
// o = option price

// define some temp vars, to minimize function calls
    sqt = Math.sqrt(t);
    MAX_ITER = 100;
    ACC = 0.0001;

    sigma = (o / S) / (0.398 * sqt);
    for (i = 0; i < MAX_ITER; i++) {
        price = black_scholes(call, S, X, r, sigma, t);
        diff = o - price;
        if (Math.abs(diff) < ACC)
            return sigma;
        d1 = (Math.log(S / X) + r * t) / (sigma * sqt) + 0.5 * sigma * sqt;
        vega = S * sqt * ndist(d1);
        sigma = sigma + diff / vega;
    }
    return "Error, failed to converge";

} //end of option_implied_volatility

/*function call_iv(s,x,r,t,o) 
 { 
 return option_implied_volatility(true,s,x,r/100,t/365,o); 
 }​*/
/*AmCharts.addInitHandler(function (chart) {
 
 // check if "secondCategoryField" is set
 if (chart.secondCategoryField === undefined)
 return;
 
 // init guides array
 if (chart.categoryAxis.guides === undefined)
 chart.categoryAxis.guides = [];
 
 // add a guide for each category
 for (var x = 0; x < chart.dataProvider.length; x++) {
 chart.categoryAxis.guides.push({
 "category": chart.dataProvider[ x ][ chart.categoryField ],
 "toCategory": chart.dataProvider[ x ][ chart.categoryField ],
 "expand": true,
 "label": chart.dataProvider[ x ][ chart.secondCategoryField ],
 "position": "top",
 "tickLength": 0
 });
 }
 
 }, ["serial"]);*/
