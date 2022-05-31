     var min,max, get_duration,first_vol;
         /*hide on escape button*/
         //var result = showdata_daily_vol('TVSMOTOR','chartdiv_vol');  
// window.onload =   onload_run();
var chart_id = ["chartdiv_vol", "chartdiv_vol1", "chartdiv_vol2", "chartdiv_vol3", "chartdiv_vol4", "chartdiv_vol5", "chartdiv_vol6", "chartdiv_vol7", "chartdiv_vol8", "chartdiv_vol9", "chartdiv_vol10", "chartdiv_vol11", "chartdiv_vol12", "chartdiv_vol13", "chartdiv_vol14"];
function run_onload() {
   // username = "vineetjain495"
  /* if($('#search2').css('display') !== 'none')
{
        get_script();
}
   $.ajaxSetup({async: false});*/
     $.post('connect/eye_connect.php', { }, function(result) { 
            //alert(result);
             var obj = jQuery.parseJSON(result); 
            chart_num = 0;
            
      for(i=obj.a.length-1;i>0;i--)
      {//alert(obj.a[i-1]); 
            showdata_daily_vol(obj.a[i-1],chart_id[chart_num]);
            chart_num++;
      }
   /*showdata_daily_vol('ICICIBANK','chartdiv_vol1');
   showdata_daily_vol('ASHOKLEY','chartdiv_vol2');
   showdata_daily_vol('RELIANCE','chartdiv_vol3');
   showdata_daily_vol('COALINDIA','chartdiv_vol4');
   showdata_daily_vol('LICHSGFIN','chartdiv_vol5');
   showdata_daily_vol('HDFCBANK','chartdiv_vol6');
   showdata_daily_vol('POWERGRID','chartdiv_vol7');
   showdata_daily_vol('ADANIENT','chartdiv_vol8');*/
    });
   
  };
  function clear_eyelist()
{

    eye_check = "all";
    var ar_data = {
        eye_check: eye_check

    };
    if (confirm("Delete All Script from Watchlist") == true) {
        $.ajaxSetup({async: false});                                               // to run jquery ajax fast we have to false syncronization
        $.post('connect/insert_eye.php', {ar_data: ar_data}, function (result) {         // retrieve OHLC value from ohlc_connect.php by company code name
            //  obj = jQuery.parseJSON(result);             
        });
    }

}
function add_to_eye(eye_check)
{
     search = document.getElementById('search2').value;
      if (search != "")
    {
     /*if($("#eye_check").prop('checked') == true){
                eye_check = "yes";
                document.getElementById('add_toggle').innerHTML = "added";
        }
        else{
         eye_check = "No";
         document.getElementById('add_toggle').innerHTML = "add";
        }*/
          var ar_data = {     
            eye_check : eye_check,
            search : search
            };
     //alert(eye_check);
    $.ajaxSetup({async: false});                                               // to run jquery ajax fast we have to false syncronization
      $.post('connect/insert_eye.php', { ar_data:ar_data  }, function(result) {         // retrieve OHLC value from ohlc_connect.php by company code name
         // alert(result);
            var obj = jQuery.parseJSON(result);  
            if(obj.a !== "")
            {
                alert(obj.a);
                
            }
            else{
                location.href = "BlissEye.php";
            }
             });
              } else {
        clear_eyelist();
        location.href = "BlissEye.php";
    }
    
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
            });

        }


    });
}

function showdata_daily_vol(eq,chart_div)
{ 
   
    document.getElementById("get_name").value = eq;  
   
  
   //
  $("#"+chart_div).show();
    

       
     make_chart_daily_vol(eq,chart_div);                                      // create chart function (blissearning.php)  
     
   
}
//hide chaRT onload


 var c_name = "";
 var chart;

// this method is called when chart is first inited as we listen for "dataUpdated" event
function zoomChart() {
    // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
    
    chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length + 10);
    
}
function make_chart_daily_vol(c_name2,chart_div)
{
   var clr = [];    
    var chartData;
   // var get_duration_val = document.getElementById("range2").options[document.getElementById("range2").selectedIndex].text;;
    var data1 =  c_name2;// + " IV  Min-Max  :    Blue mark is an expiry week";
    // function for get value from url 
     
    chartData = generateChartData_daily_vol(c_name2);
 

var chart = AmCharts.makeChart(chart_div, {    
    "type": "serial",
    "theme": "none",
    "color" : "#fff",
    "pathToImages": "amstockchart/amcharts/images/",
    
    "dataProvider": chartData,                       // data pass from chartData array
   // "dataDateFormat" = "YYYY-MM-DD, JJ:NN:SS",
    "valueAxes": [{
        "id":"v1",
        "axisColor": "#84C225",
        "axisThickness": 0,
        "gridAlpha": 0,
        "axisAlpha": 0,        
        "position": "left",
        "color":"#84C225",
        "labelsEnabled":false,
        "dashLength" : 30,
        "inside": true,
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
         "negativeBase": first_vol,      
         "negativeLineColor": "#FF0000",
        "fillColorsField": "lineColor",
        "lineColorField" : "lineColor",
       
       // "balloonText": "[[iv_text]]" ,
        "valueField": "vols",
        "balloonText": "IV:[[vols]] CE: [[strike]] @[[call]] Spot:[[future]]" ,
		
    }],
    
        "legend": {                                     // line colour with information at below
        //"useGraphSettings": true,
         "color" : "#FFFF00",                           // text colour 
         //"data" :[{title: data1 }],   
        verticalGap : 0,
         fontSize : 12,
       "markerSize" : 10,
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
       
        //"valueLineBalloonEnabled": true,
        "valueLineEnabled": true,
    },
   "categoryField": "date",
    
    "categoryAxis": {
         "parseDates": true,
        "axisColor": "#DADADA",
        "minorGridEnabled": false,
        "minPeriod": "mm",
       "equalSpacing" : false,
      "gridThickness": 0,
      //"labelsEnabled":false,
     // "position":"top",
      "axisAlpha":0,
      "enabled":false,
      "gridCount":0
       /*for proper time format in axis with equal spacing*/
    //   "autoGridCount" :false,
       
      //  "dateFormats": [{period:"hh",format:"YYYY-MM-DD,HH:NN:SS"}]
    }
});
 //alert(chartData);
AmCharts.checkEmptyData = function(chart) {
  if (0 == chart.dataProvider.length) {
    // set min/max on the value axis
    chart.valueAxes[0].minimum = 0;
    chart.valueAxes[0].maximum = 100;

    // add dummy data point
    var dataPoint = {
      dummyValue: 0
    };
    dataPoint[chart.categoryField] = '';
    chart.dataProvider = [dataPoint];

    // add label
    chart.addLabel(0, '50%', 'The chart contains no data', 'center');

    // set opacity of the chart div
    chart.chartDiv.style.opacity = 0.5;

    // redraw it
    chart.validateNow();
  }
}
AmCharts.checkEmptyData(chart);
//chart.addListener("dataUpdated", zoomChart);
  
//zoomChart();

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
        // alert(c_name2+"fd");
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
//    alert(arr_data);
   var chartData = [];
    var i=0,j=0;
    var st = "";
   var newDate,vols,strike,call_price,spot_price,delta,days_of_expiry,lineColor,vol_diff;
  
   if(arr_data.a[1])
   {
   first_vol= parseFloat(arr_data.a[1]);
   }
   else{
       first_vol= 0;
   }
    //alert(first_vol);
    for (var i = 0; i < parseInt(arr_data.b); i++) 
    { 
        arr_data.a[j] = dateFormat(arr_data.a[j], "yyyy/mm/dd");         
        newDate = new Date(arr_data.a[j]+ " " + arr_data.a[j+2]);// + " " + arr_data.a[j+2]); if we do both date and time then chart is not visisble in mozila

        vols = parseFloat(arr_data.a[j+1]);
        strike = arr_data.a[j+5];
        call_price = arr_data.a[j+6];
        spot_price = arr_data.a[j+7];
        delta= "IV : " + vols ;
       
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
            vol_diff : vol_diff,
            strike: arr_data.a[j+5],
            call:arr_data.a[j+6],
            future:arr_data.a[j+7]
            
        });
    
        j = j+8;
    
    }
    return chartData;
 //   return chartData;
}

