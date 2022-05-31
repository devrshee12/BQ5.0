function ticker() {
    $('#ticker li:first').slideUp(function() {
        $(this).appendTo($('#ticker')).slideDown();
    });
}

setInterval(function(){ ticker(); }, 2000);   
   var date2 = "2014-01-09/2014-12-31",day1,day2,day3,week_date;   
    var chartData;
    var iv_text = "ds", nifty_text = "ds";
    
    $(document).ready(function() { 
        range_sel_vq("year");
        //code            
         var table_name = "india_vix";
    $.ajaxSetup({async: false});                                               // to run jquery ajax fast we have to false syncronization    
    $.post('get_update_time.php', { table_name: table_name }, function(result) {         // retrieve OHLC value from ohlc_connect.php by company code name
   
    var obj = jQuery.parseJSON(result); 
  //  document.getElementById("vix_update").innerHTML = obj;
    });
    
    });
function range_sel_vq(duration)                                                        //passing selected duration today,week or month
{    
    var select1 = document.getElementById("range_vq").value;
    
    if(select1 === 'range')                                                         // in range display two editfield
     {
         $('#range_text_vq').show(); 
         $('#b1_vq').hide();
         $('#b2_vq').hide();
         $('#b3_vq').show();
          document.getElementById("day2_vq").size = "15";
     }
     else                                                                           // or  display only one editfield
     {
         $('#b1_vq').show();
         $('#b2_vq').show();
         $('#b3_vq').hide();
         $('#range_text_vq').hide();
            document.getElementById("day2_vq").size = "25";
     }
    var get_duration;
    // according to select option date will display
    if(duration === 'today')
    {
        var c_date = new Date();                                                    // take today's date
        var firstDay = new Date(c_date);                                            // take date according to parameter 
        firstDay.setDate(firstDay.getDate());                                       // it will give you first day of date 

        var lastDay = new Date(c_date.getFullYear(), c_date.getMonth() + 1, 0);
        day1 = dateFormat(firstDay, "yyyy-mm-dd");
        day2 = day1;
        day3 = dateFormat(lastDay, "yyyy-mm-dd");
        //week_date = day3;                                                           //week date for not going beyond some date when we forwarding date
        document.getElementById('day2_vq').value = day1;                               // inserting date bcoz we need this date again as this textfield is disable
        document.getElementById('day1_vq').value = day1;                               // inserting for displaying date
    }
    else if(duration === 'week')
     {
         var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate() - firstDay.getDay() + 1);              // it will give you first day of week
         var lastDay = new Date(c_date);
         lastDay.setDate(lastDay.getDate() - lastDay.getDay() +  7);                // it will give you last day of week
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");
         
         var lastdisplay_Day = new Date(c_date.getFullYear(), c_date.getMonth() + 4, 0);
         day4 = dateFormat(lastdisplay_Day, "yyyy-mm-dd");
         week_date = day4;
         bliss_day1 = dateFormat(day1, "dd mmm yyyy");
                 bliss_day2 = dateFormat(day2, "dd mmm yyyy");
                 document.getElementById('day2_vq').value = bliss_day1+" - "+bliss_day2;
         document.getElementById('day1_vq').value = day1;
     }
    else if(duration === 'month')
     {
         var date = new Date();
         var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);           // it will give first day of month
         var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);        // it will give last day of month (month +1 means next month, 0 for previous month last date
         day1 = dateFormat(firstDay, "yyyy-mm-dd");
         day2 = dateFormat(lastDay, "yyyy-mm-dd");
         day3 = dateFormat(firstDay, "mmm yyyy");
        // week_date = day2;
         document.getElementById('day2_vq').value = day3;
         document.getElementById('day1_vq').value = day1;
     }
    else if(duration === 'year')
     {                 
         var date = new Date();
         var firstDay = new Date(date.getFullYear(), 0, 1);
         var lastDay = new Date(date.getFullYear() + 1, 0, 0);                  
         day1 = dateFormat(firstDay, "yyyy-mm-dd");
         day2 = dateFormat(lastDay, "yyyy-mm-dd");
         day3 = dateFormat(firstDay, "yyyy");
         week_date = day2;
         document.getElementById('day2_vq').value = day3;
         document.getElementById('day1_vq').value = day1;
      }
    else if(duration === 'range')      
    {
        document.getElementById('day2_vq').value = "";                                // if range is seleected then day2 textfield will become enable and we need blank textfield for user                      
        document.getElementById('day1_vq').value = "";
    }
    else if(duration === 'Go')                                                       //if range is selected then go is enable
     {
         day1 = document.getElementById('day1_vq').value;
         day2 = document.getElementById('day2_vq').value;
     }
   else if(duration === '<<')
     {   
     var select = document.getElementById("range_vq").value;                           //getting the selected value               
     if(day1 > "2008-01-01")                                                        //button will work if date is above 2009-01-01
         {
         if(select === 'today')
           {                                                                        // get_duration = document.getElementById('day2').value;
             get_duration = document.getElementById('day1_vq').value;
             var firstDay = new Date(get_duration);
             firstDay.setDate(firstDay.getDate() - 1);
             var lastDay = new Date(get_duration);
             lastDay.setDate(lastDay.getDate() - lastDay.getDay());
             day1 = dateFormat(firstDay, "yyyy-mm-dd");
             day2 = day1;                                                             
             document.getElementById('day2_vq').value = day1;
             document.getElementById('day1_vq').value = day1;
           }
         else if(select === 'week')
         {
            get_duration = document.getElementById('day1_vq').value;
            var firstDay = new Date(get_duration);
            firstDay.setDate(firstDay.getDate() - firstDay.getDay()-6);
            var lastDay = new Date(get_duration);
            lastDay.setDate(lastDay.getDate() - lastDay.getDay());
            day1 = dateFormat(firstDay, "yyyy-mm-dd");
            day2 = dateFormat(lastDay, "yyyy-mm-dd");
             bliss_day1 = dateFormat(day1, "dd mmm yyyy");
                 bliss_day2 = dateFormat(day2, "dd mmm yyyy");
                 document.getElementById('day2_vq').value = bliss_day1+" - "+bliss_day2;
            document.getElementById('day1_vq').value = day1;
         }
         else if(select === 'month')
            {
             get_duration = document.getElementById('day1_vq').value;
             var date = new Date(get_duration);
             var firstDay = new Date(date.getFullYear(), date.getMonth() - 1, 1);
             var lastDay = new Date(date.getFullYear(), date.getMonth(), 0);
             day1 = dateFormat(firstDay, "yyyy-mm-dd");
             day2 = dateFormat(lastDay, "yyyy-mm-dd");
             day3 = dateFormat(firstDay, "mmm yyyy");
             document.getElementById('day2_vq').value = day3;
             document.getElementById('day1_vq').value = day1;
            }
        else if(select === 'year')
            {
             get_duration = document.getElementById('day1_vq').value;
             var date = new Date(get_duration);
             var firstDay = new Date(date.getFullYear() - 1, 0, 1);                 // it will give you first day of year
             var lastDay = new Date(date.getFullYear(), 0, 0);                      // it will give you last day of year
             day1 = dateFormat(firstDay, "yyyy-mm-dd");
             day2 = dateFormat(lastDay, "yyyy-mm-dd");
             day3 = dateFormat(firstDay, "yyyy");                                   //we will print value in this format
             document.getElementById('day2_vq').value = day3;
             document.getElementById('day1_vq').value = day1;
            }
         }
     }
     else if(duration === '>>')                                                      // button will not work beyond current month last date,current month or current year thats why we stored value in week_date
     {
       var select = document.getElementById("range_vq").value;
       if(day2 < week_date)
         { 
             if(select === 'today')
             {                                    
                get_duration = document.getElementById('day1_vq').value;
                var firstDay = new Date(get_duration);
                firstDay.setDate(firstDay.getDate() + 1);
                var lastDay = new Date(get_duration);
                lastDay.setDate(lastDay.getDate() - lastDay.getDay());
                day1 = dateFormat(firstDay, "yyyy-mm-dd");
                day2 = day1;
                document.getElementById('day2_vq').value = day1;
                document.getElementById('day1_vq').value = day1;
              }
             else  if(select === 'week')
             {
                 get_duration = document.getElementById('day1_vq').value;
                 var firstDay = new Date(get_duration);
                 firstDay.setDate(firstDay.getDate() - firstDay.getDay() + 8);
                 var lastDay = new Date(get_duration);
                 lastDay.setDate(lastDay.getDate() - lastDay.getDay() + 14);                                
                 day1 = dateFormat(firstDay, "yyyy-mm-dd");
                 day2 = dateFormat(lastDay, "yyyy-mm-dd");
                   bliss_day1 = dateFormat(day1, "dd mmm yyyy");
                 bliss_day2 = dateFormat(day2, "dd mmm yyyy");
                 document.getElementById('day2_vq').value = bliss_day1+" - "+bliss_day2;
                
                 document.getElementById('day1_vq').value = day1; 
              }
             else if(select === 'month')
             {
                 get_duration = document.getElementById('day1_vq').value;
                 var date = new Date(get_duration);
                 var firstDay = new Date(date.getFullYear(), date.getMonth() + 1, 1);
                 var lastDay = new Date(date.getFullYear(), date.getMonth()+2, 0);
                 day1 = dateFormat(firstDay, "yyyy-mm-dd");
                 day2 = dateFormat(lastDay, "yyyy-mm-dd");
                 day3 = dateFormat(firstDay, "mmm yyyy");
                 document.getElementById('day2_vq').value = day3;
                 document.getElementById('day1_vq').value = day1;
             }
             else if(select === 'year')
             {
                 get_duration = document.getElementById('day1_vq').value;
                 var date = new Date(get_duration);
                 var firstDay = new Date(date.getFullYear() + 1, 0, 1);
                 var lastDay = new Date(date.getFullYear() + 2, 0, 0);
                 day1 = dateFormat(firstDay, "yyyy-mm-dd");
                 day2 = dateFormat(lastDay, "yyyy-mm-dd");
                 day3 = dateFormat(firstDay, "yyyy");
                 document.getElementById('day2_vq').value = day3;
                 document.getElementById('day1_vq').value = day1;
             }
         }
     }
 /*if(document.getElementById("range_vq").value === "range")
 {
     $(function()                                                                   //function for date-pick
     {
         $( "#day1_vq" ).datepicker('destroy');
         $( "#day1_vq" ).datepicker({ dateFormat: 'd M yy',yearRange: "2008:2018" , changeYear: true,   background: '#FFFFFF', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],  });
     }); 
    $(function()                                                                    //function for date-pick
     {
         $( "#day2_vq" ).datepicker('destroy');
         $( "#day2_vq" ).datepicker({ dateFormat: 'd M yy',yearRange: "2008:2018" , changeYear: true,   background: '#FFFFFF', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],  });
     }); 
       day1 = dateFormat(document.getElementById('day1_vq').value, "yyyy-mm-dd");
   
     day2 = dateFormat(document.getElementById('day2_vq').value, "yyyy-mm-dd");
 }
 else
 {
     $( "#day1_vq" ).datepicker('destroy');
     $( "#day2_vq" ).datepicker('destroy');  
 } */
date2 = day1+"/"+day2;    
    //chartData = generateChartData();                                                         // As selected value it will display graph according to that
    chartData2 = generateChartData2();

var chart = AmCharts.makeChart("chartdiv2", {
    
    "type": "serial",
    "theme": "none",
    "color" : "#fff",
    "pathToImages": "amstockchart/amcharts/images/",
    
    "dataProvider": chartData2,                       // data pass from chartData array
    
    "valueAxes": [{
        "id":"v1",
        "axisColor": "#417CA7",
        "axisThickness": 2,
        "gridAlpha": 0,
        "axisAlpha": 4,        
        "position": "left",
        "color":"#417CA7"
    }, {
        "id":"v2",
        "axisColor": "#84C225",
        "axisThickness": 2,
        "gridAlpha": 0,
        "axisAlpha": 1,
        "position": "right",
        "color":"#84C225"
    } ],
    "graphs": [{
        "valueAxis": "v1",
        "lineColor": "#417CA7",
        "customBullet": "bliss_icon.ico",
        "bulletSize": "15",
        "bulletBorderThickness": 80,
        "hideBulletsCount": 20,
        "lineThickness" : 2,
        "title": "India Vix",
        "balloonText": "[[iv_text]]" ,
        "valueField": "visits",
		"fillAlphas": 0
    }, {
        "valueAxis": "v2",
        "lineColor": "#FFFFFF",
        "customBullet": "bliss_icon.ico",
        "bulletSize": "15",
        "cursorBulletAlpha" : "0",
        "bulletBorderThickness": 50,
        "balloonColor" : "#84C225",
        "lineColorField" : "lineColor",
        "fillColorsField" : "lineColor",
        "hideBulletsCount": 20,
        "lineThickness" : 2,
        "title": "Nifty",
        "balloonText": "[[nifty_text]]" ,
        "valueField": "hits",
        "legendColor" : "#84C225",
        "includeInMinMax" : true,
		"fillAlphas": 0
    },{
      "lineColor": "#ffffff",
      "title": ">1% Up Down",
      "switchable" : false
      //"visibleInLegend" : false
     //"valueField": "ud_value",
    }],

        "legend": {                                     // line colour with information at below
        //"useGraphSettings": true,
         "color" : "#FFF",                           // text colour 
        // "data" :[{title: "India Vix" , color: "#0080FF",valueAxis: "v1",},{title: "Nifty", color: "#FFFFFF"},{title: ">1% Up Down", color: "#84C225"}],         
         verticalGap : 0,
         textClickEnabled:false,
         switchable : true,
         switchType : "V"  
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
        "categoryBalloonDateFormat": "DD MMM YYYY "        
    },
    "categoryField": "date2",    
    "categoryAxis": {
        "parseDates": true,
        "axisColor": "#ffffff",
        "minorGridEnabled": true,
        "axisThickness" : 2
    }
});

} 

//chart.addListener("dataUpdated", zoomChart);

//zoomChart();

// generate some random data, quite different range
function generateChartData2() {
 
    var nope = "";
    var arr_data = [];
    //alert(nope);
    $.ajaxSetup({async: false});
    $.post('iv_connect.php',{ date1:date2 }, function(result)                       // retrive values from india vix table
    {         
       // alert(result);
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
    var i=0,j=0;
    var st = "";

    for (var i = 0; i < parseInt(arr_data.b); i++) {
        // we create date objects here. In your data, you can have date strings
        // and then set format of your dates using chart.dataDateFormat property,
        // however when possible, use date objects, as this will speed up chart rendering.
        var newDate = new Date(arr_data.a[j]);
       // newDate.setDate(newDate.getDate() + i);

        var visits = parseFloat(arr_data.a[j+1]);
        var hits = parseFloat(arr_data.a[j+2]);
      
      var  ud_value = "",line_color = "#84C225",iv_close,nft_p_close,nft_close,iv_change,nft_change,iv_balloon,nft_balloon;
     
      nft_p_close = parseFloat(arr_data.a[j-1]);
      nft_close = parseFloat(arr_data.a[j+2]);
     
      nft_change =  (nft_close - nft_p_close) * 100 / nft_p_close; 
     
     
         iv_balloon ="<b><span style='color:#417CA7'>India VIX</span> <br>"+Math.abs(arr_data.a[j+1]).toFixed(1)+"</b>";
     
    if(nft_change > 1)
     {
         nft_balloon ="<b><span style='color:#005900;'>Nifty</span> <br>"+ Math.abs(arr_data.a[j+2]).toFixed(1) + "<br> <span style='color:#005900'>" + Math.abs(nft_p_close - nft_close).toFixed(2) + "  Point Up</span></b>";
     line_color = "#ffffff";
     ud_value =arr_data.a[j+2];
        }    
   else if(nft_change < (-1))
     {
         nft_balloon ="<b><span style='color:#005900;'>Nifty</span> <br>"+ Math.abs(arr_data.a[j+2]).toFixed(1) + "<br> <span style='color:ff0000'>" +  Math.abs(nft_p_close - nft_close).toFixed(2) + "  Point Down </span></b>";
     line_color = "#ffffff";
      ud_value = arr_data.a[j+2];
        }
     else
     {
         nft_balloon ="<b><span style='color:#005900'>Nifty</span> <br>"+ Math.abs(arr_data.a[j+2]).toFixed(1)+"</b>";
     }    

        chartData.push({
            date2: newDate, //date
            visits: visits, //india vix data
            hits: hits,  // nifty data
            iv_text:iv_balloon, //india vix text
            nifty_text:nft_balloon, //nifty text
            lineColor : line_color, //line color
            ud_value : ud_value 
        });
        j = j+3;
    }
//  document.getElementById("vix_update").innerHTML = "Last Updated: "+arr_data.a[j - 3];
    return chartData;
}

function zoomChart(){
    chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length - 1);
}
//