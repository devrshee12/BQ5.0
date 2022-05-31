/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var date1 = "2014-01-09/2014-12-31", day1, day2, day3, week_date, bliss_day1, bliss_day2;

$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        $('#chartdiv').hide();
    }
});

$(document).ready(function () {

    range_sel("week");

    //code   
    //to use our search box to search
    oTable = $('#employee-grid').dataTable();
    $('#search1').keyup(function () {
        oTable.fnFilter($(this).val());
        //$('.ticker1').ticker();
    });



});

$(function ()
{
    $('#chartdiv').hide();

    var table_name = "earning2";
    $.ajaxSetup({async: false});                                               // to run jquery ajax fast we have to false syncronization    
    $.post('get_update_time.php', {table_name: table_name}, function (result) {         // retrieve OHLC value from ohlc_connect.php by company code name

        var obj = jQuery.parseJSON(result);
        document.getElementById("earning_update").innerHTML = obj;
    });

});
$(document).on('click', function (e)
{
    // if($("#chartdiv").css('visibility') != 'hidden')
    if ($(e.target).closest('#chartdiv').length)
    {
        $('#chartdiv').hide();
    }

    $('img').click(function ()
    {
        var image_name = $(this).attr('src').split('\/');
        
        var name = image_name[image_name.length - 1].split('.');
        //alert(name[0]);
        show_chart(name[0]);
    });
});
var c_name = "";
function make_chart(c_name2)
{
    var clr = [];
    var chartData;

    // function for get value from url 
    chartData = generateChartData(c_name2);
    // alert(chartData);
    var chart = AmCharts.makeChart("chartdiv",
            {
                "dataProvider": chartData,
                "type": "serial",
                "theme": "none",
                "pathToImages": "amstockchart/amcharts/images/",
                "color": "#fff",
                "valueAxes": [{
                        // "position": "left",
                        "axisColor": "#FFF",
                    }],
                "legend": {// line colour with information at below
                    "data": [{title: c_name, "color": "rgb(58, 53, 49)"}, {title: "close > Previous close", color: "#84C225"}, {title: "close < Previous close", color: "#FF0000"}],
                    "color": "#FFF",
                    "verticalGap": 0 //gap top and bottom
                },
                "graphs": [{
                        "id": "g1",
                        "balloonText": "Date:<b>[[date]]</b><br>Open:<b>[[open]]</b><br>Low:<b>[[low]]</b><br>High:<b>[[high]]</b><br>Close:<b>[[close]]</b><br>Change:<b>[[change]]%</b><br>Previous Close:<b>[[p_close]]</b><br>",
                        "closeField": "close",
                        "fillColors": "#84C225",
                        "highField": "high",
                        "lineColor": "#84C225",
                        "fillAlphas": 1,
                        "lineAlpha": 1,
                        "lowField": "low",
                        "fillAlphas": 0.5,
                                "negativeFillColors": "#ff0000",
                        "negativeLineColor": "#ff0000",
                        "openField": "open",
                        "title": "Price:",
                        "type": "candlestick",
                        "valueField": "close",
                        "lineThickness": 2,
                        "inside": true,
                        // "proCandlesticks":true
                    }],
                "chartScrollbar": {
                    "autoGridCount": true,
                    //"graph": "g1",
                    "scrollbarHeight": 5,
                    "selectedBackgroundColor": '#84C225',
                    "selectedGraphLineColor": 'ff0000',
                    "color": "#ffffff",
                    "scrollbarHeight": 20
                },
                "chartCursor": {
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorPosition": "mouse",
                    "categoryBalloonColor": "#0000ff",
                    "categoryBalloonEnabled": true,
                    "categoryBalloonDateFormat": "MMM YYYY",
                    "fillColor": "#0000ff"
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "minPeriod": "MM",
                    "startOnAxis": false
                },
                exportConfig: {
                    menuRight: '21px',
                    menuBottom: '31px',
                    menuItems: [{
                            icon: 'amstockchart/amcharts/images/export.png',
                            format: 'png'
                        }]
                }
            });

    chart.addListener("rendered", zoomChart);
    zoomChart();
}
function generateChartData(c_name2)
{
    /*function getUrlVars() {
     var vars = {};
     var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
     vars[key] = value;
     });
     return vars;
     }*/
    var obj;
    // var c_name2 =  getUrlVars()["Name"];                                        //it will give the code name of company which is pass from BlissEarning.js
    $.ajaxSetup({async: false});                                               // to run jquery ajax fast we have to false syncronization
    //alert(c_name2);
    $.post('connect/ohlc_connect.php', {c_name: c_name2}, function (result) {         // retrieve OHLC value from ohlc_connect.php by company code name
        //   alert(result);
        obj = jQuery.parseJSON(result);
    });

    var chartData = [];
    var i = 0, j = 0;
    var st = "";
    c_name = obj.a[j] + " (This graph explains stock price movement after the company's quarterly result.)";
    for (var i = 0; i < parseInt(obj.b); i++)
    {
        // we create date objects here. In your data, you can have date strings
        // and then set format of your dates using chart.dataDateFormat property,
        // however when possible, use date objects, as this will speed up chart rendering.
        var newDate = new Date(obj.a[j + 1]);
        newDate = dateFormat(newDate, "dd mmm yyyy");
        if (Number(obj.a[j + 3]) != 0 && Number(obj.a[j + 6]) != 0)
        {
            var open = Number(obj.a[j + 3]);
            var high = Number(obj.a[j + 4]);
            var low = Number(obj.a[j + 5]);
            var close = Number(obj.a[j + 6]);
            var change = Number(obj.a[j + 2]);
            var p_close = Number(obj.a[j + 7]);
            chartData.push({
                c_name: c_name,
                date: newDate,
                open: open,
                high: high,
                low: low,
                close: close,
                change: change,
                p_close: p_close
            });
        }
        j = j + 8;
    }

    return chartData;
}
// this method is called when chart is first inited as we listen for "dataUpdated" event
function zoomChart() {
    // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
    chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length + 10);
}
function range_sel(duration) //passing selected duration today,week or month
{//alert(duration);

    $('.dataTables_filter input').addClass('form-control control_color');
    //ocument.getElementById('search1').value="";
    $('#sort1').show();
    $('#sort2').show();
    var select1 = document.getElementById("range").value;
    //check selected box value is range or not
    if (select1 == 'range')                                                         // in range display two editfield
    {
        $('#range_text').show();
        $('#b1').hide();
        $('#b2').hide();
        $('#b3').show();
        document.getElementById("day2").size = "10";
    } else                                                                           // or  display only one editfield
    {
        $('#b1').show();
        $('#b2').show();
        $('#b3').hide();
        $('#range_text').hide();
        document.getElementById("day2").size = "25";
    }

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

        var lastdisplay_Day = new Date(c_date.getFullYear(), c_date.getMonth() + 4, 0);
        day4 = dateFormat(lastdisplay_Day, "yyyy-mm-dd");
        week_date = day4;

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

    if (document.getElementById("range").value == "range")
    {
        $(function ()                                                                   //function for date-pick
        {
            $("#day1").datepicker('destroy');
            $("#day1").datepicker({dateFormat: 'd M yy', yearRange: "2009:2019", changeYear: true, background: '#474545', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'], });
        });
        $(function ()                                                                    //function for date-pick
        {
            $("#day2").datepicker('destroy');
            $("#day2").datepicker({dateFormat: 'd M yy', yearRange: "2009:2019", changeYear: true, background: '#474545', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'], });
        });

        day1 = dateFormat(document.getElementById('day1').value, "yyyy-mm-dd");
        day2 = dateFormat(document.getElementById('day2').value, "yyyy-mm-dd");
    } else
    {
       /* $("#day1").datepicker('destroy');
        $("#day2").datepicker('destroy');*/
        //
    }

    date1 = day1 + "/" + day2;
//alert(date1);
    script = document.getElementById("search1").value;
    $.post('connect/earning_all_connect.php', {data1: date1, script: script}, function (result)                       // retrive values from india vix table
    {     // alert(result); 
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
            "iDisplayLength": 20,
            // "bSort": false,
            "scrollY": "400px",
            "bPaginate": false,
            "dom": ' <"top">t<"bottom"p>',
            "order": [[1, "desc"]],
        });

    });
    /*var dataTable = $('#employee-grid').DataTable( {
     "bDestroy": true,//destroy last table 
     "processing": true,
     "serverSide": true,
     "deferRender": true,
     "lengthMenu": [5,10, 25, 50, 100],
     "iDisplayLength": 25,
     "columnDefs": [{ orderable: false, targets: [2,3,4,5] }],	
     "oLanguage.sInfoFiltered": "",
     "fnDrawCallback": function(oSettings) {
     if ($('#employee-grid tr').length < 4) {
     $('.dataTables_paginate').hide();
     $('.dataTables_length').hide();
     
     }
     else{
     $('.dataTables_paginate').show();
     $('.dataTables_length').show();
     }
     },
     
     // "searching": true,
     //"pagingType": "full_numbers",
     "scrollY":  "340px",
     "dom":' <"top">t<"bottom"ilp>',
     "order": [[ 1, "desc" ]],
     
     // "scrollCollapse": true,
     
     language: {
     searchPlaceholder: "Company/yyyy-mm-dd/change",
     "sSearch": "" , 
     oPaginate: {
     "sNext":">",
     "sPrevious":"<",
     
     },
     "sEmptyTable": "No result scheduled",
     "sInfoEmpty": "",
     
     
     "sInfoFiltered": "" //remove filter label text on searching
     },
     "ajax":{
     url :"connect/earning_connect.php", // json datasource
     type: "POST",  // method  , by default get
     data: { data1: date1, script : script },
     error: function(){  // error handling
     $(".employee-grid-error").html("");
     $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No result scheduled </th></tr></tbody>');
     $("#employee-grid_processing").css("display","none");							
     }	
     }
     } );
     //    $.fn.DataTable.ext.pager.numbers_length = 5; //paginate number on button
     //$('.dataTables_filter input').addClass('control_color_1');
     $('.dataTables_length select').addClass('control_color_1');*/
}
var sort1_check = 0, sort2_check = 0;                                           //counter variable for counting sort button press


function show_chart(strName)
{

    // function call when click on image 
    $('#chartdiv').show();
    make_chart(strName);                                      // create chart function (blissearning.php)                    

}


/*function tConvert (time) {
 // Check correct time format and split into components
 time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
 
 if (time.length > 1) { // If time format correct
 time = time.slice (1);  // Remove full string match value
 //alert(time);
 time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
 time[0] = +time[0] % 12 || 12; // Adjust hours
 time[3] = " ";
 }
 return time.join (''); // return adjusted time or original string
 }*/