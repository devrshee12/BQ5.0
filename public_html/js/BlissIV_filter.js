     var min,max, get_duration;
         /*hide on escape button*/
$( document ).on( 'keydown', function ( e ) {
if ( e.keyCode === 27 ) {
        $('#chartdiv_vol').hide();
    }
});
/*display chart on icon click*/
/*$(document).on('click', function(e) 
{
    $('span').click(function()
        { //a
           
           var image_name = $(this).attr('name');
          showdata2(image_name);
         // alert(image_name);
        });  
});*/
function range_sel() //passing selected duration today,week or month
{
    var datatable = $('#iv_vol-table').DataTable();
 
datatable.clear()
        .draw();
    
    
  search =  document.getElementById('search1').value;
 // alert(search);
$.post('connect/iv_filter_connect.php', { search : search }, function(result) { 
    // alert("fsdf");
    var obj;    
    var str2 = 'No Data';    //display this not data is there
 
    if(result.indexOf(str2) == -1)                                                  // check result value and str2 value equal or not
    {   //  alert(result); 
        var obj = jQuery.parseJSON(result);   
      //  alert(result); 
     // alert(obj.a);
       /* var
        for()
        {
            
        }*/
        
       //+- alert(obj);//parsing retrieve value   
     //  alert(obj.b);
        $('#iv_vol-table').DataTable( {
                     data: obj.a,        
                    "bDestroy": true,//destroy last table 
                    "processing": true,

                     "deferRender": true,
                     "lengthMenu": [5,10, 25, 50, 100],
                     "iDisplayLength": 20,
                     // "searching": true,
                      // "searching": true,
                      "paging": false,
                     "scrollY":  "700px",
                     "dom":' <"top">t<"bottom"p>',
                   "order": [[ 16, "asc" ]],
                        language: {

                            oPaginate: {
                           "sNext":">",
                           "sPrevious":"<"
                                },
                            "sEmptyTable": "No result scheduled",
                            "sInfoFiltered": "" //remove filter label text on searching
                        },
                    "aoColumnDefs": [ /* to disable sorting for column*/
                                { 'bSortable': false, 'aTargets': [ 7,8 ] },
                                { "bVisible": false, "aTargets": [16] }
                            ],
                        columns: [
                            { title: "Stock" },
                            { title: "Sector" },
                            { title: "Pr.closed <br> Price" },
                            { title: "Oct-Nov-<br>Dec Mov%" },
                            { title: obj.b+"<br> IV" },
                            { title: "<span style=' text-decoration: underline;'> NSE <br>close vol</span>" },
                            { title: "BQ close" },
                             { title: "<span style=' text-decoration: underline;'>Oct-17 Q<br> Avg IV</span>" },
                            { title: "<span style=' text-decoration: underline;'>Oct-17 Q<br> Min-Max IV </span>" },
                          
                           { title: "<span style=' text-decoration: underline;'>July-17 Q<br> Avg IV </span>" },
                            { title: "<span style=' text-decoration: underline;'>Avg IV <br>2014... </span>" },
                           { title: "<span style=' text-decoration: underline;'>Avg IV <br>2017...</span>" },
                           { title: "Result day<br> Min-Max IV " },
                            { title: "Result Day" },
                            { title: "Market <br> Cap(Cr)" },
                            { title: "Beta" }
                            
                        ]
                } );
   
  
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
$(function() 
{  
   $('#chartdiv_vol').hide();
});

 var c_name = "";
 var chart;
function make_chart(c_name2)
{
    var clr = [];    
    var chartData,charttrend;
   // var get_duration_val = document.getElementById("range2").options[document.getElementById("range2").selectedIndex].text;;
    var data1 =  c_name2;// + " IV  Min-Max  :    Blue mark is an expiry week";
    // function for get value from url 
    charttrend = generateChartData(c_name2);
  //  var codes = newCodes();
var chartData = charttrend.chartData;
var trendData = charttrend.trendData;
 //var first_avg_vol=Object.values(chartData[Object.keys(chartData).length - 5])[7];// get first value    
var first_avg_vol=Object.values(chartData[0])[7];// get first value        
 // alert(getCol(Object.values(chartData),0))
//alert(chartData);
 chart = AmCharts.makeChart("chartdiv_vol", {    
    "type": "serial",
    "theme": "none",
    "color" : "#fff",
    "pathToImages": "amstockchart/amcharts/images/",
    
    "dataProvider": chartData,                       // data pass from chartData array
     //"startDuration": 1, //animated entry of chart
    "valueAxes": [{
        "id":"v1",
        "axisColor": "#84C225",
        "axisThickness": 2,
        "gridAlpha": 0,
        "axisAlpha": 4,        
        "position": "left",
      
       "color":"#84C225"
    }, {
        "id":"v2",
       
        
        "axisThickness": 2,
        "gridAlpha": 0,
        "axisAlpha": 1,
        "position": "left",
         "title": "Quarter Average vol",
       
    } ],
    "balloon": {
        "cornerRadius": 6,
        "horizontalPadding":5,
        "verticalPadding": 5,
        "fontSize":8
    },
    "graphs": [{
        "valueAxis": "v1",
       "id": "volGraph",
      //  "lineColorField" : "lineColor",
       // "fillColorsField" : "lineColor",
         "labelOffset":5,
       "bulletField": "bullet",
    //   "customBullet": "bullet",
       "bulletSize": "10",
       
       "lineColor": "#84C225",
        //"customBullet": "bliss_icon.ico",
        "bulletSize": "15",
        "bulletBorderThickness": 50,
        "hideBulletsCount": 50,
        "title": data1,
         "fillAlphas": 0.3,
         "negativeBase": first_avg_vol,      
         "negativeLineColor": "#FF0000",
     //  "bulletSizeField": 40,
        "lineThickness" : 2,
        "title": "ATM IV",
        "openField": "open",
     //   "balloonText": "[[iv_text]]" ,
        "valueField": "visits",
		//"fillAlphas": 0
    }, {
      //  "id": "volGraph",
        "valueAxis": "v1",
        
         "fillAlphas": 0,
       //  "fillToGraph": "volGraph",
        // "fillColors": ['#1fc072', '#1fc072', '#1fc072', '#1fc072'],
        // "fillColorsField": '#1fc072',
        "bulletBorderThickness": 50,
        "balloonColor" : "#0000FF",
   
       // "fillColorsField": ['#84C225', '#ff0000'],
        "lineColor" : "#0000FF",
       
    // "type": "step",
        "hideBulletsCount": 20,
        "lineThickness" : 2,
        "title": data1 + " Quarter  Average IV ",
      //  "balloonText": "[[nifty_text]]" ,
        "valueField": "hits",
        
        "includeInMinMax" : true,
		
    }],
 //"trendLines":trendData, 
        "legend": {                                     // line colour with information at below
          "color" : "#FFF",                           // text colour 
         //"data" :[{title: data1 }],   
        verticalGap : 0,
         fontSize : 12,
       
         //markerType : "none",
        // autoMargins : false,
        /// marginLeft : 0,
         //labelText : data1,
         
      //  "valueText": " [[delta_text]]",
       // "valueWidth" : 400,
     //   "valueAlign" : "left",
         //textClickEnabled:true,
         switchable : false,
         position:"top"
    },
    "chartScrollbar": {
        "autoGridCount": true,
        //"graph": "g1",
        "scrollbarHeight": 2,        
        "selectedBackgroundColor": '#ffffff',
        "selectedGraphLineColor": '#ffffff',
        "color":"#ffffff"        
    },
    "chartCursor": {
        "cursorPosition": "mouse",
        "categoryBalloonColor": "#84C225",
        "categoryBalloonEnabled": true,
        "categoryBalloonDateFormat": "DD MMM YYYY "  ,
         "valueLineBalloonEnabled": true,
        "valueLineEnabled": true,
    },
    "categoryField": "date2",    
    "categoryAxis": {
        "parseDates": true,
        "axisColor": "#ffffff",
        "minorGridEnabled": true,
        "axisThickness" : 2
    },
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
           
            c_name2 : c_name2
            };
     
          
         /*get graph data*/ 
    $.post('connect/close_vol_graph_connect.php',{ ar_data : ar_data }, function(result)                       // retrive values from india vix table
    {      // alert(result); 
        var str2 = 'No Data';
       var str2 = 'No Data';
        if(result.indexOf(str2) === -1)
        {
            arr_data = jQuery.parseJSON(result);
             
        }
        else
        {
            nope = "no"; 
        }       
       
    });	
    
    // 
   var chartData = [];
 var  trendData = [];
    var i=0,j=0;
    var st = "",name, name_final,bullet ;
//var type = document.getElementById('type').value;
var type = document.querySelector('input[name = "type"]:checked').value;
var avg_vol = arr_data.c;
var newDate,visits,hits, open;
    for (var i = 0; i < parseInt(arr_data.b); i++) {
        // we create date objects here. In your data, you can have date strings
        // and then set format of your dates using chart.dataDateFormat property,
        // however when possible, use date objects, as this will speed up chart rendering.
         newDate = new Date(arr_data.a[j]);
       // newDate.setDate(newDate.getDate() + i);

        visits = arr_data.a[j+1];
        bullet =  "";
        hits =arr_data.a[j+2];
         //hits = "";
         open = 0;
      if( type == "column" )
      {
            name = "iv" + i;
             if(j > 2)
             { open = arr_data.a[j-2];
                   if(arr_data.a[j+1] < arr_data.a[j-2])
                   {
                       line_color = "#FF0000";
                  }    
                 else
                   {
                        line_color = "#84C225";
                   }
               }
        }
        else{
            name = "iv" + i;
             if(j > 2)
             { open = arr_data.a[j-2];
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
     if(visits > arr_data.a[j-2] + 2.5 || visits < arr_data.a[j-2] - 2.5)
                        {
                            bullet =  "square";
                              
                            }
  //  }
     
        chartData.push({
            name:name,
            date2: newDate, //date
            open: open,
            visits: visits, //india vix data
            hits: hits , // nifty data
            lineColor : line_color,  //line color
            "bullet":bullet,
            "avg_vol":avg_vol
        });
        if(i > 0)
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
        j = j+3;
       
    
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
    var data1 =  c_name2;// + " IV  Min-Max  :    Blue mark is an expiry week";
    // function for get value from url 
    chartData = generateChartData_daily_vol(c_name2);
//alert(chartData);
var chart = AmCharts.makeChart("chartdiv_vol", {    
    "type": "serial",
    "theme": "none",
    "color" : "#fff",
    "pathToImages": "amstockchart/amcharts/images/",
    
    "dataProvider": chartData,                       // data pass from chartData array
   // "dataDateFormat" = "YYYY-MM-DD, JJ:NN:SS",
    "valueAxes": [{
        "id":"v1",
        "axisColor": "#84C225",
        "axisThickness": 2,
        "gridAlpha": 0,
        "axisAlpha": 1,        
        "position": "left",
        "color":"#84C225",
        "dashLength" : 30
    }],
    "graphs": [{
        "valueAxis": "v1",
        "lineColor": "#84C225",
        //"customBullet": "bliss_icon.ico",
        "bulletSize": "15",
        "bulletBorderThickness": 50,
        "hideBulletsCount": 50,
        "title": data1,
         "fillAlphas": 0.3,
         "negativeLineColor": "#FF0000",
        "fillColorsField": "lineColor",
        "lineColorField" : "lineColor",
       
       // "balloonText": "[[iv_text]]" ,
        "valueField": "vol_diff",
        "balloonText": "[[vols]]" ,
		
    }],
    
        "legend": {                                     // line colour with information at below
        //"useGraphSettings": true,
         "color" : "#FFF",                           // text colour 
         //"data" :[{title: data1 }],   
        verticalGap : 0,
         fontSize : 12,
       
         //markerType : "none",
        // autoMargins : false,
        /// marginLeft : 0,
         //labelText : data1,
         
        "valueText": " [[delta_text]]",
        "valueWidth" : 400,
        "valueAlign" : "left",
         //textClickEnabled:true,
         switchable : false,
         position:"top"
         
      //  switchType : "V",         
    } ,
    "ChartScrollbarSettings ": {
       
        "enabled" : false
        
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
        "categoryBalloonEnabled": true,
       "categoryBalloonDateFormat": "DD MMM, JJ:NN:SS",   
        "cursorColor":"#0000FF",  
        "valueLineBalloonEnabled": true,
        "valueLineEnabled": true,
    },
   "categoryField": "date",
    "valueScrollbar": {
        "autoGridCount":true
    },
    "categoryAxis": {
         "parseDates": true,
        "axisColor": "#DADADA",
        "minorGridEnabled": true,
        "minPeriod": "mm",
       "equalSpacing" : true,
      
       /*for proper time format in axis with equal spacing*/
    //   "autoGridCount" :false,
       "gridCount" :8
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
            date1 : date1,
            c_name2 : c_name2
            };
            //alert(ar_data['c_name2']);
         /*get graph data*/ 
    $.post('connect/vol_graph_connect.php',{ ar_data : ar_data }, function(result)                       // retrive values from india vix table
    {        
        var str2 = 'No Data';
      // alert(result);
        if(result.indexOf(str2) === -1)
        {   
            arr_data = jQuery.parseJSON(result);
        }
        else
        {
            nope = "no"; 
        }
       
    });	
    // 
    //alert(arr_data.a);
   var chartData = [];
    var i=0,j=0;
    var st = "";
   var newDate,vols,strike,call_price,spot_price,delta,days_of_expiry,lineColor,vol_diff;
    for (var i = 0; i < parseInt(arr_data.b); i++) 
    { 
        arr_data.a[j] = dateFormat(arr_data.a[j], "yyyy/mm/dd");         
        newDate = new Date(arr_data.a[j]+ " " + arr_data.a[j+2]);// + " " + arr_data.a[j+2]); if we do both date and time then chart is not visisble in mozila

        vols = parseFloat(arr_data.a[j+1]);
        strike = arr_data.a[j+5];
        call_price = arr_data.a[j+6];
        spot_price = arr_data.a[j+7];
        delta= "ATM Intraday IV : " + vols + "<br>  Delta: " + arr_data.a[j+4] + "<br>  Strike: " + arr_data.a[j+5]+ "<br>  Call Price: " + arr_data.a[j+6]+ "<br>Spot Price: " + arr_data.a[j+7];
       
         days_of_expiry = parseFloat(arr_data.a[j+3]);
         lineColor = "#84C225";
         
                 /*  if(vols > parseFloat(arr_data.a[1]))
                   {
                       lineColor = "#FF0000";
                      
                  }    
                  else{
                       lineColor = "#84C225";
                  }*/
                vol_diff = vols  - arr_data.a[1] ;
               
       /* delta.push({
            date: newDate,
            vols: vols,
            delta:arr_data.a[j+4],
            time:time,
            delta_text:delta
            
        });*/
        if(days_of_expiry < 4 )
        { 
            lineColor = "#0000FF";
        }
        
        chartData.push({
            date: newDate,
            vols: vols,
            lineColor: lineColor,
            time:time,
            delta_text:delta,
            vol_diff : vol_diff
            
        });
    
        j = j+8;
    
    }
    return chartData;
 //   return chartData;
}

