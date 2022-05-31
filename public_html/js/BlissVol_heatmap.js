
         var min,max, get_duration;
$( document ).on( 'keydown', function ( e ) {
if ( e.keyCode === 27 ) {
        $('#chartdiv_vol').hide();
    }
});

$(document).on('click', function(e) 
{
 
            var ac = "result";
  
        
        $('img').click(function()
                            { //a
                        var image_name = $(this).attr('name');
                    
                      showdata2(image_name);
                            });  
});

var date1 = "2014-01-09/2014-12-31",date2,day1,day2,day3,week_date;  
var sort,sort_count = 0,search,cnt = 0;
function range_sel(duration) //passing selected duration today,week or month
{    
    if(duration === 'sort')
    {
        sort_count++;
        if(sort_count % 2 === 0)
        {
           sort = "desc";
          // search = "";
        }
        else if(sort_count % 2 !== 0)
        {
           sort = "asc";
         //  search = "";
        }
    }
    else if(duration === 'week' || duration === 'fifteen' || duration === 'one_m' || duration === 'three_m' || duration === 'all' || duration === '1day')
    {
        sort = "desc";
      //  search = "";
    }
    else
    {
        sort = "desc";
       // search = duration;        
    }
 search =  document.getElementById('search1').value;
     get_duration = document.getElementById("range").value;
    // according to select option date will display   
   if(get_duration === 'week')
     {
         var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate() - 7);                                  // 7 days before date
         var lastDay = c_date;                                                      // todays date
     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");        
     }
     else if(get_duration === 'fifteen')
     {
         var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate() - 15);                                 // 15 days before date
         var lastDay = c_date;                                                      // todays date     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");         
     }
    else if(get_duration === 'one_m')
     {
         var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate() - 30);                                 // 1 month before date
         var lastDay = c_date;                                                      // todays date
     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");          
     }
     else if(get_duration === 'three_m')
     {
            var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate() - 91);                                 // 3 Month before date
         var lastDay = c_date;                                                      // todays date     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");         
     } 
     else if(get_duration === 'all')
     {
            var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate() - 400);                                 // all days before date
         var lastDay = c_date;                                                      // todays date     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");         
     } 
     else if(get_duration === '1day')
     {
         var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate());                                  // 7 days before date
         var lastDay = c_date;                                                      // todays date
     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");        
        
     }
date1 = day1+"/"+day2; 
                  
           
 var ar_data = {     
            date1 : date1,
            sort  : sort,
            search : search
            };
             // alert(ar_data['search']);
$.post('vol_connect.php', { ar_data : ar_data }, function(result) { 
    
    var obj;    
    var str2 = 'No Data';    //display this not data is there
  // alert(result);
    if(result.indexOf(str2) == -1)                                                  // check result value and str2 value equal or not
    {        
        var obj = jQuery.parseJSON(result);                                         //parsing retrieve value     
        
    
        $('#vol-table').DataTable( {
        data: obj.a,
        
        "bDestroy": true,//destroy last table 
					"processing": true,
					
                                         "deferRender": true,
                                         "lengthMenu": [5,10, 25, 50, 100],
                                         "iDisplayLength": 10,
                                         // "searching": true,
                                         "scrollY":  "350px",
                                         "dom":' <"top">t<"bottom"p>',
                                         "order": [[ 0, "asc" ]],
                                            language: {

                                                    oPaginate: {
                                             "sNext":">",
                                           "sPrevious":"<",
                                     },
                                     "sEmptyTable": "No result scheduled",
                                            "sInfoFiltered": "" //remove filter label text on searching
                                        },
        columns: [
            { title: "Company Name" },
            { title: "Min-Max IV" },
            { title: "Current IV" },
            { title: "Chart" }
           
            
        ]
    } );
   
    // $.fn.DataTable.ext.pager.numbers_length = 5; //paginate number on button
   // $('.dataTables_filter input').addClass('form-control control_color');
  $('.dataTables_length select').addClass('control_color');
    }  
    
  
 });
 
}
  $('#chartdiv_vol').css({
             top: 200,
             left: 600           
         });

  function show_chart(strName)
                {                     
                                                                                  // function call when click on image 
                          $('#chartdiv_vol').show();
                        make_chart(strName,max,min);                                               // create chart function (blissearning.php)                    
                 
                 }



function range_heatmap(duration) //passing selected duration today,week or month for heatmap
{
  var start = performance.now();
    var get_duration = document.getElementById("range2").value;
    // according to select option date will display   
   if(get_duration === 'week')
     {
         var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate() - 7);                                  // 7 days before date
         var lastDay = c_date;                                                      // todays date
     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");        
        
     }
     else if(get_duration === 'fifteen')
     {
         var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate() - 15);                                 // 15 days before date
         var lastDay = c_date;                                                      // todays date     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");         
     }
    else if(get_duration === 'one_m')
     {
           var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate() - 30);                                 // 1 month before date
         var lastDay = c_date;                                                      // todays date
     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");          
     }
     else if(get_duration === 'three_m')
     {
            var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate() - 91);                                 // 3 Month before date
         var lastDay = c_date;                                                      // todays date     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");         
     } 
     else if(get_duration === 'all')
     {
            var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate() - 400);                                 // all days before date
         var lastDay = c_date;                                                      // todays date     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");         
     } 
     else if(get_duration === '1day')
     {
         var c_date = new Date();
         var firstDay = new Date(c_date);
         firstDay.setDate(firstDay.getDate());                                  // 7 days before date
         var lastDay = c_date;                                                      // todays date
     
         day1 = dateFormat(firstDay, "yyyy-mm-dd");                                 //formating date
         day2 = dateFormat(lastDay, "yyyy-mm-dd");        
        
     }
date2 = day1+"/"+day2; 
//alert(date2);

    // CODE


    $.post('heatmap_connect.php', { date1 : date2 }, function(result) { 
    var obj;    
    var str2 = 'No Data';                                                           //display this not data is there
  //alert(result);
 
    if(result.indexOf(str2) === -1)                                                  // check result value and str2 value equal or not
    {        
        var obj = jQuery.parseJSON(result);                                         //parsing retrieve value     
    }  
   var dt = obj.c.split(" ");
   dt[0] = dateFormat(dt[0], "dd mmm yyyy");
   dt[1] = hours_am_pm(dt[1]);
   //alert(dt[1]);
    document.getElementById("vol_time").innerHTML = "Last Updated:" + dt[0] + " | " + dt[1] + "";
  //  alert(obj.c);
    var table1 = document.getElementById('dyn_t2');
    var rowCount = table1.rows.length - 1;
    for(var i=rowCount; i>0; i--) 
    {
        var row = table1.rows[i];
        table1.deleteRow(i);
        rowCount--;
    }
    
    var table = document.getElementById('dyn_t2');
    var i,j,total_row = obj.b;                                                      // it will total number of value
    var rowCount = table.rows.length;
  //  alert(rowCount);
    var colour = "#84C225";
    for(j=0;j<total_row;j++)
    {  
        if(j % 4 === 0)
        {
            var cell_no = 0;                                                                //for every row cell_no start from 0
            var row = table.insertRow(table.rows.length);                                            //inerting row
        }                       
                var cell1 = row.insertCell(j % 4);                                        //create cell by cell_number
                element1 = "<a style='color:#000' href='BlissDelta_Data.php?&search1=" + obj.a[j][0]+"'>" + obj.a[j][0] + "</a><br>IV : "+obj.a[j][1];              
                cell1.innerHTML = element1;               
                cell1.bgColor = colour;
                cell1.width = "22%";
                cell1.setAttribute('onmouseover', 'showdata(this)');;
                cell1.setAttribute('onmouseout', 'hidedata()');;
               // cell1.setAttribute("onclick",'showdata2(this)');
              //  cell1.onmouseout = tdOnMouseOut;
               if(j<20)
                 colour = shadeColor2(colour, 0.1);               
             /*   var color1 = "rbg(63,131,163)";
            var lighter-color = shadeRGBColor(color1, 0.5);  //  rgb(159,193,209)
            var darker-color = shadeRGBColor(color1, -0.25); //  rgb(47,98,122)*/            
    }   
        colour = "#ff4646";
            table.rows[10].cells[3].bgColor = colour;  
            colour = shadeColor2(colour, 0.1); //colour and its % that want to shades
            table.rows[10].cells[2].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[10].cells[1].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[10].cells[0].bgColor = colour;  
            
            colour = shadeColor2(colour, 0.1);
            table.rows[9].cells[3].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[9].cells[2].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[9].cells[1].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[9].cells[0].bgColor = colour; 
            colour = shadeColor2(colour, 0.1);
            table.rows[8].cells[3].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[8].cells[2].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[8].cells[1].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[8].cells[0].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[7].cells[3].bgColor = colour;
        colour = shadeColor2(colour, 0.1);
        table.rows[7].cells[2].bgColor = colour;
        colour = shadeColor2(colour, 0.1);
        table.rows[7].cells[1].bgColor = colour;
        colour = shadeColor2(colour, 0.1);
            table.rows[7].cells[0].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[6].cells[3].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[6].cells[2].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[6].cells[1].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
            table.rows[6].cells[0].bgColor = colour;  
            colour = shadeColor2(colour, 0.1);
       var time = performance.now() - start;

     });
 

}
//time format convertor
function hours_am_pm(time) {
        var hours = time[0] + time[1];
        var min = time[3] + time[4];
        if (hours < 12) {
            return hours + ':' + min + ' AM';
        } else {
            hours=hours - 12;
            hours=(hours.length < 10) ? '0'+hours:hours;
            return hours+ ':' + min + ' PM';
        }
    }
  // shades in heatmap 
function shadeColor2(color, percent) {   
    var f=parseInt(color.slice(1),16),t=percent<0?0:255,p=percent<0?percent*-1:percent,R=f>>16,G=f>>8&0x00FF,B=f&0x0000FF;
    return "#"+(0x1000000+(Math.round((t-R)*p)+R)*0x10000+(Math.round((t-G)*p)+G)*0x100+(Math.round((t-B)*p)+B)).toString(16).slice(1);
}
// to show chart
function showdata2(eq)
{
         cnt = 0;
    var get_duration = document.getElementById("range").value;  
    var eq;
    var max,min;
    
   
date1 = day1+"/"+day2;  
//search = eq;
sort = "DESC";


 var ar_data = {     
            date1 : date1,
            sort  : sort,
            search : eq
            };
       //   alert(ar_data['date1']);  
$.post('vol_connect.php', { ar_data : ar_data }, function(result) { 
    var obj;    
    var str2 = 'No Data';                                                           //display this not data is there

   // alert(result);
    if(result.indexOf(str2) == -1)                                                  // check result value and str2 value equal or not
    {        
        var obj = jQuery.parseJSON(result);                                         //parsing retrieve value     
    }  
     /*st = obj.a[0][0] + "<br>Max : " +  obj.a[0][1] + "<br>Min : " +  obj.a[0][2] + "<br>Current : " +  obj.a[0][3]  ;
    // alert(st);
     if(st != "")
        {
            //alert(st);
            var title = st;
            $('<p class="tooltip"></p>').html(title).appendTo('body').fadeIn(10);
  
        }*/
    max = obj.a[0][1];
    min = obj.a[0][4];
   // alert("fds");
    
    });
    
    /*$( this ).mousemove(function (e) {
        
         if(e.pageY < 400)
         {
            var mousex = e.pageX - 450;
            //Get X coordinates
            var mousey = e.pageY + 10;
            //Get Y coordinates
        }
        else
        {
                var mousex = e.pageX - 450;
            //Get X coordinates
            var mousey = e.pageY - 250 ;
            //Get Y coordinates
        }*/
         
         $('#chartdiv_vol').css({
             top: 200,
             left: 600           
         });
        
    // });
       
     $('#chartdiv_vol').show();
                         make_chart(eq,max,min);                                      // create chart function (blissearning.php)                    
                 
    /* $( "#chartdiv_vol" ).toggle(function() {
        alert( "First handler for .toggle() called." );
        }, function() {
         alert( "Second handler for .toggle() called." );
        });*/
    
}
//show chart on hover
function showdata(eqt)
{//alert(eqt);
    cnt = 0;
     var get_duration = document.getElementById("range2").value;
   
      var eq;
      var max,min;
    eq = eqt.innerHTML.split(">");
   //alert(eq);
eq[1] = eq[1].replace('</a',''); //for script having character '&' in name
   //alert(eq[1]); 
date1 = date2;  
search = eq[1];
sort = "ASC";
//alert(eq );
 var ar_data = {     
            date1 : date1,
            sort  : sort,
            search : search
            };
            
$.post('vol_connect.php', { ar_data : ar_data }, function(result) { 
    var obj;    
    var str2 = 'No Data';                                                           //display this not data is there

       // alert(result);
    if(result.indexOf(str2) === -1)                                                  // check result value and str2 value equal or not
    {        
        var obj = jQuery.parseJSON(result);                                         //parsing retrieve value     
    }  
    
    max = obj.a[0][1];
    min = obj.a[0][2];
    
    });
    
    $( this ).mousemove(function (e) {
        if(e.pageY < 400)
         {
            var mousex = e.pageX - 550;
            //Get X coordinates
            var mousey = e.pageY + 10;
            //Get Y coordinates
        }
        else
        {
                var mousex = e.pageX - 550;
            //Get X coordinates
            var mousey = e.pageY - 250 ;
            //Get Y coordinates
        }
         
         $('#chartdiv_vol').css({
             top: mousey,
             left: mousex            
         });
        
     });
       
     $('#chartdiv_vol').show();
                         make_chart(eq[1],max,min);                                      // create chart function (blissearning.php)                    
                 
    /* $( "#chartdiv_vol" ).toggle(function() {
        alert( "First handler for .toggle() called." );
        }, function() {
         alert( "Second handler for .toggle() called." );
        });*/
    
}
function hidedata() 
{
        if(cnt == 0)
        $('#chartdiv_vol').hide();
    /* $('#chartdiv_vol').css({
             top: 0,
             left: 0,             
         })*/
   $(this).unbind('mousemove');  //remove mouse move function
}

$(function() 
{
    // $( '#chartdiv_vol' ).die();
    //  $( '#chartdiv_vol' ).resizable();
    // $( '#chartdiv_vol' ).draggable();    
   $('#chartdiv_vol').hide();
});
$(document).on('click', function(e) 
{
   // if($("#chartdiv_vol").css('visibility') !== 'hidden')
       if ($(e.target).closest('#chartdiv_vol').length ) 
        {
          // $('#chartdiv_vol').hide();
           cnt = 0;
        } 
});
 var c_name = "";
function make_chart(c_name2)
{
    var clr = [];    
    var chartData;
   // var get_duration_val = document.getElementById("range2").options[document.getElementById("range2").selectedIndex].text;;
    var data1 =  c_name2 + " IV  Min-Max  :    Blue mark is an expiry week";
    // function for get value from url 
    chartData = generateChartData(c_name2);
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
        "color":"#84C225"
    }],
    "graphs": [{
        "valueAxis": "v1",
        "lineColor": "#84C225",
        //"customBullet": "bliss_icon.ico",
        "bulletSize": "15",
        "bulletBorderThickness": 50,
        "hideBulletsCount": 50,
        "title": "Vol",
        "lineColorField" : "lineColor",
        "fillColorsField" : "lineColor",
       // "balloonText": "[[iv_text]]" ,
        "valueField": "vols",
        "balloonText": "[[delta_text]]" ,
		"fillAlphas": 0
    }],
    
        "legend": {                                     // line colour with information at below
        //"useGraphSettings": true,
         "color" : "#84C225",                           // text colour 
        // "data" :[{title: data1}],   
         verticalGap : 0,
         fontSize : 10,
         markerType : "none",
         autoMargins : false,
         marginLeft : 0,
         labelText : data1,
        
         //textClickEnabled:true,
         switchable : false,
         position:"top"
         
      //  switchType : "V",         
    },
    "ChartScrollbarSettings ": {
       
        "enabled" : false
        
    },
   
    "chartCursor": {
        "cursorPosition": "mouse",
        "categoryBalloonColor": "#0000ff",
        "categoryBalloonEnabled": true,
       "categoryBalloonDateFormat": "DD MMM, JJ:NN:SS",        
    },
   "categoryField": "date",
   
    "categoryAxis": {
        "parseDates": true,
        "axisColor": "#DADADA",
        "minorGridEnabled": true,
        "minPeriod": "mm",
        "equalSpacing" : true
      //  "dateFormats": [{period:"hh",format:"YYYY-MM-DD,HH:NN:SS"}]
    }
});

chart.addListener("dataUpdated", zoomChart);

zoomChart();
}
function generateChartData(c_name2) 
{   
    var nope = "";
    var arr_data = [];
    var time;
    
    $.ajaxSetup({async: false});
    var ar_data = {     
            date1 : date1,
            c_name2 : c_name2
            };
         //   alert(ar_data['date1']);
    $.post('vol_graph_connect.php',{ ar_data : ar_data }, function(result)                       // retrive values from india vix table
    {        
        var str2 = 'No Data';
     //alert(result);
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
//alert(new Date(arr_data.a[j] + " " + arr_data.a[j+2]));
    for (var i = 0; i < parseInt(arr_data.b); i++) {
       
     
       arr_data.a[j] = dateFormat(arr_data.a[j], "yyyy/mm/dd");  
       
 var newDate = new Date(arr_data.a[j]+ " " + arr_data.a[j+2]);// + " " + arr_data.a[j+2]); if we do both date and time then chart is not visisble in mozila

        //  newDate = newDate    
        /*  if(get_duration === '1day')
     {
        var newDate = new Date(arr_data.a[j+2]);      
         newDate.setMinutes(newDate.getMinutes() + i);
     }  */
        var vols = parseFloat(arr_data.a[j+1]);
       var strike = arr_data.a[j+5];
       var call_price = arr_data.a[j+6];
       var spot_price = arr_data.a[j+7];
        var delta= "IV : " + vols + "<br>delta: " + arr_data.a[j+4] + "<br>strike: " + arr_data.a[j+5]+ "<br>Call Price: " + arr_data.a[j+6]+ "<br>Spot Price: " + arr_data.a[j+7];
       
      var days_of_expiry = parseFloat(arr_data.a[j+3]);
      var lineColor = "#84C225";
    //AmCharts.formatDate(newDate     , "DD MMM, YYYY");
    if(days_of_expiry > 4 )
    { //lineColor = "#0000FF";
    
        chartData.push({
            date: newDate,
            vols: vols,
            lineColor: lineColor,
            time:time,
            delta_text:delta
            
        });
    }
        j = j+8;
    
    }
    return chartData;
}
// this method is called when chart is first inited as we listen for "dataUpdated" event
function zoomChart() {
    // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
    chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length + 10);
}

