/* Preload images script */
function ticker() {
    $('#ticker li:first').slideUp(function() {
        $(this).appendTo($('#ticker')).slideDown();
    });
}

setInterval(function(){ ticker(); }, 2000);
var myimages=new Array();
$(function() 
{ 
   var table_name = "earning2",up_time1,uptime2,obj,obj1;
    $.ajaxSetup({async: false});                                               // to run jquery ajax fast we have to false syncronization    
    $.post('get_update_time.php', { table_name: table_name }, function(result) {         // retrieve OHLC value from ohlc_connect.php by company code name
   
        obj = jQuery.parseJSON(result);   
   
    });
    
    var table_name = "economic_data";
    $.ajaxSetup({async: false});                                               // to run jquery ajax fast we have to false syncronization    
    $.post('get_update_time.php', { table_name: table_name }, function(result) {         // retrieve OHLC value from ohlc_connect.php by company code name
  
    obj1 = jQuery.parseJSON(result); 
    up_time1 =  obj.split(":");
    up_time1 = up_time1[1].split("|");
    
     uptime2 =  obj1.split(":");
    uptime2 = uptime2[1].split("|");
    });
    if(up_time1[0] > uptime2[0])
         document.getElementById("event_update").innerHTML = obj;
    else
     document.getElementById("event_update").innerHTML = obj1;
  changedate('return'); 
  range_sel('week');
 //  alert(up_time1[0] + " " + uptime2[0]);
});
function preloadimages(){
	for (i=0;i<preloadimages.arguments.length;i++){
		myimages[i]=new Image();
		myimages[i].src=preloadimages.arguments[i];
	}
}
//Declaration
var thisDate = 1;							// Tracks current date being written in calendar
var wordMonth = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
var today = new Date();							// Date object to store the current date
var todaysDay = today.getDay() + 1;					// Stores the current day number 1-7
var todaysDate = today.getDate();					// Stores the current numeric date within the month
var todaysMonth = today.getUTCMonth() + 1;				// Stores the current month 1-12
var todaysYear = today.getFullYear();					// Stores the current year
var monthNum = todaysMonth;						// Tracks the current month being displayed
var yearNum = todaysYear;						// Tracks the current year being displayed
var firstDate = new Date(String(monthNum)+"/1/"+String(yearNum));	// Object Storing the first day of the current month
var firstDay = firstDate.getUTCDay();					// Tracks the day number 1-7 of the first day of the current month
var numbDays = 0;
var calendarString = "";
var eastermonth = 0;
var easterday = 0;
var ev_day = [];
var ev_time = [];
var ev_month = [];
var ev_year = [];
var ev_date = [];
var ev_comp = [];
var ev_com_code = [];
var ev_holiday = ["26-01-2018", "13-02-2018", "02-03-2018","29-03-2018",   "30-03-2018", "01-05-2018", "15-08-2018","22-08-2018","13-09-2018","20-09-2018",  "02-10-2018", "18-10-2018","07-11-2018", "08-11-2018",  "25-12-2018","26-01-2017", "24-02-2017", "13-03-2017","04-04-2017",   "14-04-2017", "01-05-2017", "26-06-2017","15-08-2017","25-08-2017",  "02-10-2017", "19-10-2017", "20-10-2017",  "25-12-2017", "28-03-2015", "18-07-2015", "15-08-2015", "24-10-2015","26-01-2016","07-03-2016","24-03-2016","25-03-2016","14-04-2016","15-04-2016","19-04-2016","06-07-2016","15-08-2016","05-09-2016","13-09-2016","11-10-2016","12-10-2016","31-10-2016","14-11-2016","01-05-2016","02-10-2016","30-10-2016","25-12-2016"];
var ev_holiday_name = ["Republic Day", "Mahashivratri", "Holi", "Mahavir Jayanti","Good Friday", "Maharashtra Day","Independence Day","Bakri ID", "Ganesh Chaturthi", "Moharram", "Mahatma Gandhi Jayanti","Dasera", "Diwali-Laxmi Pujan", "Diwali-Balipratipada","Christmas","Republic Day", "Mahashivratri", "Holi", "Ram Navmi", "Dr. Baba Saheb Ambedkar Jayanti", "Maharashtra Day","Id-Ul-Fitr (Ramzan ID)","Independence Day", "Ganesh Chaturthi",  "Mahatma Gandhi Jayanti", "Diwali-Laxmi Pujan", "Diwali-Balipratipada","Christmas", "Ram Navami", "Id-uI-Fitar (Ramzan ID)", "Independence Day", "Muharram","Republic Day","Mahashivratri","Holi","Good Friday","Dr. Baba Saheb Ambedkar Jayanti","Ram Navami","Mahavir Jayanti","Id-Ul-Fitr (Ramzan ID)","Independence Day","Ganesh Chaturthi","Bakri ID","Dasera","Moharram","Diwali-Balipratipada","Gurunanak Jayanti","Maharashtra Day","Mahatma Gandhi Jayanti","Diwali-Laxmi Pujan","Christmas"];
var ev_change = [];
var dt1 = yearNum + "-" + monthNum + "-" + todaysDate;
var ev_dates2;
var total_event = 0;
var summ_date = [];
//var imf_time = [];
//var imf_date = [];
//var imf_comp = [];
//var imf_change = [];

var dd = new Date(yearNum,monthNum, 0);
lastDate = dd.getDate();
if(todaysMonth.toString().length===1) 
    todaysMonth = "0"+todaysMonth;//bcoz todaysMonth and monthnum is not matching
/* get value from database from earning table of event through calender_connect php file.*/
    $.ajaxSetup({async: false});
    $.post('connect/calender_connect.php', { date1: dt1 }, function(result) { //dt1 for if we want particular date event
        var obj = jQuery.parseJSON(result);
         var j = 2;         
        // alert(obj.c);
        //retrieve earning data
        for(i=0;i<obj.b;i++)
        {
            ev_date[i] =  obj.a[j+1];         //ev_date to retieve date.
            ev_time[i] = obj.a[j+2];
            ev_date2 = ev_date[i].split("-"); // split date to get year.
            ev_year[i] = ev_date2[0]; // take year in ev_year
            ev_comp[i] = obj.a[j]; // get company name in ev_comp
			ev_com_code[i]= obj.a[j-1];//get company code
            ev_change[i] = "±"+obj.a[j+3]; // get change in ev_change
            j = j + 6;
        }  
        j=1;
         //retrieve economic data
        for(i = i;i < obj.b + obj.d;i++)
        {
            ev_date[i] =  obj.c[j+1];         //ev_date to retieve date.
            ev_time[i] = obj.c[j+2];
            ev_date2 = ev_date[i].split("-"); // split date to get year.
            ev_year[i] = ev_date2[0]; // take year in ev_year
			ev_com_code[i]= obj.c[j];//get company code
            ev_comp[i] = obj.c[j]; // get event in ev_comp
            j = j + 7;
        }  
      //alert(ev_comp[i - 1]);
        total_event = obj.b + obj.d;  //obj.b give total row retrieve
    });
 // changedate will count date month year etc.
 // every button is press aur page is load this function will call
 // parameter shows what date to display
function changedate(buttonpressed) 
{
    if (buttonpressed === "prevyr") yearNum--;   // parameter is previous year
    else if (buttonpressed === "nextyr") yearNum++; // parameter is next year
    else if (buttonpressed === "prevmo") monthNum--; // parameter is previous month
    else if (buttonpressed === "nextmo") monthNum++;// parameter is next month
    else  if (buttonpressed === "return") {  // parameter is for current month and date
            monthNum = todaysMonth;
            yearNum = todaysYear;
    }
    // var dt = yearNum + "-" + monthNum + "-" + todaysDay;
    if (monthNum === 0) {
        monthNum = 12;
        yearNum--;
    }
    else if (monthNum === 13) {
        monthNum = 1;
        yearNum++;
    }
    var dd = new Date(yearNum,monthNum, 0);
    lastDate = dd.getDate();
    numbDays = lastDate;
    firstDate = new Date(String(monthNum)+"/1/"+String(yearNum));
    firstDay = firstDate.getDay() + 1;
    createCalendar();
    return;
}
// this will display calender view
function createCalendar() 
{
    calendarString = '';
    var daycounter = 0; // daycounter will count date
    var k=0;
    calendarString += '<table class="" width="100%" style=\"border-collapse: separate;\">';
    calendarString += '<tr  bgcolor=\"#3A3531">';
    calendarString += '<td><h3><a href=\"#\" onMouseOver=\"" onMouseOut=\"" onClick=\"changedate(\'prevyr\')\">\<<<\/a></h3><\/td>';
    calendarString += '<td><h3><a href=\"#\" onMouseOver=\"" onMouseOut=\"" onClick=\"changedate(\'prevmo\')\">\<<\/a></h3><\/td>';
    calendarString += '<td style=\"font-size:17px\" colspan=\"3\"><b>' + wordMonth[monthNum-1] + ' ' + yearNum + '<\/b><\/td>';
    calendarString += '<td><h3><a href=\"#\" onMouseOver=\"" onMouseOut=\"" onClick=\"changedate(\'nextmo\')\">\><\/a></h3><\/td>';
    calendarString += '<td><h3><a href=\"#\" onMouseOver=\"" onMouseOut=\"" onClick=\"changedate(\'nextyr\')\">\>><\/a></h3><\/td>';
    calendarString += '<\/tr>';
    calendarString += '<tr bgcolor=\"#3A3531\">';
    calendarString += '<td><font color="#84C225" style=\"font-size:15px; \" >Sun<\/td>';
    calendarString += '<td><font color="#84C225" style=\"font-size:15px; \" >Mon<\/td>';
    calendarString += '<td><font color="#84C225" style=\"font-size:15px; \" >Tue<\/td>';
    calendarString += '<td><font color="#84C225" style=\"font-size:15px; \" >Wed<\/td>';
    calendarString += '<td><font color="#84C225" style=\"font-size:15px; \" >Thu<\/td>';
    calendarString += '<td><font color="#84C225" style=\"font-size:15px; \" >Fri<\/td>';
    calendarString += '<td><font color="#84C225" style=\"font-size:15px; \" >Sat<\/td>';
    calendarString += '<\/tr>';
    thisDate === 1;
        
    summ_date.length = 0;
    //imf_comp.length = 0;
    //imf_date.length = 0;
    //.length = 0;       
    k = 0;
    //this loop is count date and show event and cuurent date  
    for (var i = 1; i <= 6; i++) 
    {
        calendarString += '<tr >';
        for (var x = 1; x <= 7; x++) 
        {
            daycounter = (thisDate - firstDay)+1;
            // alert(thisDate + "  " + x + "  " + i);
            thisDate++;
            //this condition will leave cell blank if no date is there
            if ((daycounter > numbDays) || (daycounter < 1)) 
            {
                calendarString += '<td align=\"center\" bgcolor=\"#3A3531\"  height=\"30\" width=\"30\">&nbsp;<\/td>';
            } 
            else 
            {      
                if(monthNum.toString().length===1)
                    monthNum = "0"+monthNum;
                if(daycounter.toString().length===1)
                    daycounter = "0"+daycounter;
                //alert(todaysDay+"  "+x+" "+todaysDate+" "+daycounter+" "+todaysMonth+" "+monthNum);
                // this condition will check any event or current date is there is not by checkevent function
                if(ev_holiday.indexOf(daycounter + "-" + monthNum + "-" + yearNum) !== -1)
                {
                    calendarString += '<td  id=\"dv3' + daycounter + '"\" bgcolor=\"#3A3531\" class=\"dv3' + daycounter + '"\" align=\"center\"  onmouseenter=\"showevents(' + daycounter + ',' + monthNum + ',' + yearNum + ',' + i + ',' + x + ');\" onmouseleave=\"hideevents();\"   style=\"border:3px solid #417CA7; border-radius:80%\" height=\"60\" width=\"30\" ><a href=\"#\" ><font color="#ffffff" style=\"font-size:15px; font-weight: bold\">' + daycounter + '</font><\/a><\/td>';
                }
                else if (checkevents(daycounter,monthNum,yearNum,i,x) || ((todaysDay === x) && (todaysDate === daycounter) && (todaysMonth === monthNum)))
                {                                   
                    //this check if current date is there then display according to that
                    //onmouseenter and onmouseleave it will call function named showevent and hideevent
                 //  alert(ev_holiday.indexOf(daycounter + "-" + monthNum + "-" + yearNum));
                    summ_date[k] = yearNum + "-" + monthNum + "-" + daycounter;  //add dates in array
                    k++;
                  //  alert(todaysDay+"  "+x+" "+todaysDate+" "+daycounter+" "+todaysMonth+" "+monthNum);
                    if ((todaysDay == x) && (todaysDate == daycounter) && (todaysMonth == monthNum)) 
                    {
                        calendarString += '<td  id=\"dv3' + daycounter + '"\" bgcolor=\"#3A3531\" class=\"dv3' + daycounter + '"\" align=\"center\"  onmouseenter=\"showevents(' + daycounter + ',' + monthNum + ',' + yearNum + ',' + i + ',' + x + ');\" onmouseleave=\"hideevents();\"  style=\"border:3px solid #ffffff;  border-radius:80%\"  height=\"60\"  ><a href=\"#\" ><font color="#ffffff" style=\"font-size:15px; font-weight: bold\">' + daycounter + '</font><\/a><\/td>';
                    }
                      else if(((todaysDate > daycounter) && (todaysMonth == monthNum)) || todaysMonth > monthNum)
                    {
                        calendarString += '<td  id=\"dv3' + daycounter + '"\" bgcolor=\"#3A3531\"class=\"dv3' + daycounter + '"\" align=\"center\" onmouseenter=\"showevents(' + daycounter + ',' + monthNum + ',' + yearNum + ',' + i + ',' + x + ');\" onmouseleave=\"hideevents();\"   style=\"border:3px solid #84C225; border-radius:80%\" height=\"60\" ><a href=\"#\" ><font color="#ffffff" style=\"font-size:15px; font-weight: bold\">' + daycounter + '</font><\/a><\/td>';
                    }
                    else	
                    {
                        calendarString += '<td  id=\"dv3' + daycounter + '"\" bgcolor=\"#3A3531\" class=\"dv3' + daycounter + '"\" align=\"center\" onmouseenter=\"showevents(' + daycounter + ',' + monthNum + ',' + yearNum + ',' + i + ',' + x + ');\" onmouseleave=\"hideevents();\"   style=\"border:3px solid #84C225; border-radius:80%\" height=\"60\" ><a href=\"#\" ><font color="#ffffff" style=\"font-size:15px; font-weight: bold\">' + daycounter + '</font><\/a><\/td>';
                    }
                    //this check if event is there then display according to that
                  
                    
                } 
                
                else 
                {
                    // this show normal date without events
                    calendarString += '<td align=\"center\" bgcolor=\"#3A3531\" height=\"40\" width=\"40\"><font color="#ffffff" style=\"font-size:15px; font-weight: bold\">' + daycounter + '<\/td>';
                }
            }
        }
        calendarString += '<\/tr>';
    }
    //if current month not is there then it will show "show current date" button
    if ((todaysMonth == monthNum && todaysYear == yearNum)) 
    {
      //  calendarString += '<tr><td colspan=\"7\"  nowrap align=\"center\" valign=\"center\" bgcolor=\"#cccccc\" width=\"280\" height=\"22\"><font color="#ffffff"><\/td><\/tr><\/table>';
    }
    else
    {
        calendarString += '<tr><td colspan=\"7\"  nowrap align=\"center\" valign=\"center\" bgcolor=\"#3A3531\" width=\"280\" height=\"22\"><div id=\"current_month\" class=\"current_month\"><a href=\"javascript:changedate(\'return\')\"><font color="#000"><b>Show Current Date<\/b><\/a><\/div><\/td><\/tr><\/table>';
    }
    
    // this will add code in html
    var object=document.getElementById('calendar');
    object.innerHTML= calendarString;
    thisDate = 1;
    var  m = 0;
    /*for(var j = 0 ; j < summ_date.length ; j++) 
    {
        for ( var i = 0; i < total_event; i++ ) 
        {
            if(ev_date[i] === summ_date[j])   //check event date = calender date
            {
               /* imf_comp[m] = ev_comp[i];
                imf_date[m] = ev_date[i];
                imf_time[m] = ev_time[i];
                imf_change[m] = ev_change[i];
                m++;
            }
        }
    } */   
}

// this will check any event is not there.
function checkevents(day,month,year,week,dayofweek)
{     
    var numevents = 0;
     
    var current_date = year + "-" + month + "-" + day;
  //  alert(current_date);
    for (var i = total_event; i > 0; i--)
    {
        if (current_date === ev_date[i]) 
        {
            numevents++;
            continue;
        }
    }
    if (numevents === 0) 
    {
            return false;
    } 
    else {
            return true;
    }
}
//this will hide div "dv3+day" on mouseleave
function hideevents() 
{
   $('.tooltips2').remove();
    $('#wall').css('opacity', '1');
    $('#dynt').css('opacity', '1');
}
var cnt = 0;
//this will show div "dv3+day" on mouseenter
 
function showevents(day,month,year,week,dayofweek) 
{   //Declaration    
    var index = -1;
    var count = 0;  
    //add 0 on single digit month and date
    if(month.toString().length===1)
        month = "0"+month;
    if(day.toString().length===1)
        day = "0"+day;
    
    var st = "";               
    var c_date = year + "-" + month + "-" + day;                                  //hover date to check with retrieve date
  var c_date2 = day + "-" + month + "-" +  year;                                //this date variable is for holiday date comparison
    var c_date3 = dateFormat(c_date, "dd mmm yyyy");                              // change format of date to display
    //loop for counting how many are there event on same day;
    for ( var i = 0; i < ev_date.length; i++ ) 
    {
        if(ev_date[i] === c_date)//check how many time date arrive in ev_date array so on next loop we can know how much time we have to circulate next loop
        {
            count++;
        }
    }
    
    //dsiplay day of date in tooltip
                var weekday=new Array(7);
                weekday[0]="Sunday";
                weekday[1]="Monday";
                weekday[2]="Tuesday";
                weekday[3]="Wednesday";
                weekday[4]="Thursday";
                weekday[5]="Friday";
                weekday[6]="Saturday";                
                var Day = new Date(c_date);             
                
    st =  "<table class='table-condensed' border=1><tr><td colspan = '2' style='text-align: center;font-weight:bold'>"+c_date3 + "   - "+weekday[Day.getDay()]+ "</td></tr><tr><td><font color=#fff> Result/Event</font></td><td><font color=#fff>Expected price movement <br> (after result-Range %)</font></td></tr>";
    //loop for insert data on st(string variable) for tooltip
    for(var i=0; i<count; i++)
    {        
        index = ev_date.indexOf(c_date,index + 1); //get index of
        if(!ev_change[index])
        {
            ev_change[index] = "-";
        }
        else if(ev_change[index] === "±"+0)
        {
            ev_change[index] = "*";
        }
		var len=ev_comp[index];
		//alert(len.length);
		if(len.length > 20)
		{
			
			st = st +  "<tr><td>"+ ev_com_code[index] + "</td><td> " + ev_change[index] +" </td></tr>";
			
		}
		else
		{
			st = st +  "<tr><td>"+ ev_comp[index] + "</td><td> " + ev_change[index] +" </td></tr>";
		}
        
    }
    //  if no event is there then print "No event data"
    if(count == 0)
    {
         st =  "<table border=1><tr><td colspan = '2' style='text-align: center;font-weight:bold'>"+c_date3 + "   - "+weekday[Day.getDay()]+ "</td></tr><tr><td class='text-center'><font color=#fff>No Event Today</font></td></tr>";
    }
    // display holiday info
    if(ev_holiday.indexOf(c_date2) !== -1)
    {        
        holiday="(Holiday)";
        st = st + "<tr><td colspan='2' class='text-center'><b>" + ev_holiday_name[ev_holiday.indexOf(c_date2)] + "  " + holiday +"</b></td></tr>";
    }
   st = st +  " </table> ";
   
  //  obj.innerHTML= "" + st;*/
  //  alert('df');
  if(st !== "")
  {    
         var title = st;
        // $(this).data('tipText', title);
         $('<p class="tooltips2"></p>').html(title).appendTo('body').fadeIn(10);
        // $('#wall').css('opacity', '0.2');
         //$('#dynt').css('opacity', '0.2');
        $( this ).mousemove(function (e) {
        if(e.pageY < 350)
           {
               if(st.length > 2000)
                {
                var mousex = e.pageX + 20;
                //Get X coordinates
                var mousey = e.pageY - 250;
                //Get Y coordinates
                 } 
                 else
                {
                var mousex = e.pageX + 20;
                //Get X coordinates
                var mousey = e.pageY + 10;
                //Get Y coordinates
                 } 
           }
           
       else
        {
             if(st.length > 1200)
                {
                    var mousex = e.pageX + 20;
                   //Get X coordinates
                   var mousey = e.pageY - 300;
                   //Get Y coordinates
                }
                else
                {
                    var mousex = e.pageX + 20;
                   //Get X coordinates
                   var mousey = e.pageY - 100;
                   //Get Y coordinates
                }
        }         
         $('.tooltips2').css({
             top: mousey,
             left: mousex             
         });        
     });
    }
}
var date1 = "2014-01-09/2014-12-31",day1,day2,day3,week_date;
function range_sel(duration) //passing selected duration today,week or month
{   
    var select1 = document.getElementById("range").value; 
   //check selected box value is range or not
     if(select1 === 'range')                                                         // in range display two editfield
     {
         $('#range_text').show(); 
         $('#b1').hide();
         $('#b2').hide();
         $('#b3').show();
     }
     else                                                                           // or  display only one editfield
     {
         $('#b1').show();
         $('#b2').show();
         $('#b3').hide();
         $('#range_text').hide();
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
        document.getElementById('day2').value = day1;                               // inserting date bcoz we need this date again as this textfield is disable
        document.getElementById('day1').value = day1;                               // inserting for displaying date
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
         document.getElementById('day2').value = "From "+day1+" To "+day2;
         document.getElementById('day1').value = day1;
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
         document.getElementById('day2').value = day3;
         document.getElementById('day1').value = day1;
     }
    
   else if(duration === '<<')
     {   
     var select = document.getElementById("range").value;                           //getting the selected value               
     if(day1 > "2009-01-01")                                                        //button will work if date is above 2009-01-01
         {
            if(select === 'today')
            {                                                                        // get_duration = document.getElementById('day2').value;
              get_duration = document.getElementById('day1').value;
              var firstDay = new Date(get_duration);
              firstDay.setDate(firstDay.getDate() - 1);
              var lastDay = new Date(get_duration);
              lastDay.setDate(lastDay.getDate() - lastDay.getDay());
              day1 = dateFormat(firstDay, "yyyy-mm-dd");
              day2 = day1;                                                             
              document.getElementById('day2').value = day1;
              document.getElementById('day1').value = day1;
            }
            else if(select === 'week')
            {
               get_duration = document.getElementById('day1').value;
               var firstDay = new Date(get_duration);
               firstDay.setDate(firstDay.getDate() - firstDay.getDay()-6);
               var lastDay = new Date(get_duration);
               lastDay.setDate(lastDay.getDate() - lastDay.getDay());
               day1 = dateFormat(firstDay, "yyyy-mm-dd");
               day2 = dateFormat(lastDay, "yyyy-mm-dd");
               document.getElementById('day2').value = "From "+day1+" To "+day2;;
               document.getElementById('day1').value = day1;
            }
            else if(select === 'month')
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
           }
          
        }
    }
     else if(duration === '>>')                                                      // button will not work beyond current month last date,current month or current year thats why we stored value in week_date
     {
       var select = document.getElementById("range").value;
       if(day2 < week_date)
         { 
             if(select === 'today')
             {                                    
                get_duration = document.getElementById('day1').value;
                var firstDay = new Date(get_duration);
                firstDay.setDate(firstDay.getDate() + 1);
                var lastDay = new Date(get_duration);
                lastDay.setDate(lastDay.getDate() - lastDay.getDay());
                day1 = dateFormat(firstDay, "yyyy-mm-dd");
                day2 = day1;
                document.getElementById('day2').value = day1;
                document.getElementById('day1').value = day1;
              }
             else  if(select === 'week')
             {
                 get_duration = document.getElementById('day1').value;
                 var firstDay = new Date(get_duration);
                 firstDay.setDate(firstDay.getDate() - firstDay.getDay() + 8);
                 var lastDay = new Date(get_duration);
                 lastDay.setDate(lastDay.getDate() - lastDay.getDay() + 14);                                
                 day1 = dateFormat(firstDay, "yyyy-mm-dd");
                 day2 = dateFormat(lastDay, "yyyy-mm-dd");
                 document.getElementById('day2').value = "From "+day1+" To "+day2;;
                 document.getElementById('day1').value = day1; 
              }
             else if(select === 'month')
             {
                 get_duration = document.getElementById('day1').value;
                 var date = new Date(get_duration);
                 var firstDay = new Date(date.getFullYear(), date.getMonth() + 1, 1);
                 var lastDay = new Date(date.getFullYear(), date.getMonth()+2, 0);
                 day1 = dateFormat(firstDay, "yyyy-mm-dd");
                 day2 = dateFormat(lastDay, "yyyy-mm-dd");
                 day3 = dateFormat(firstDay, "mmm yyyy");
                 document.getElementById('day2').value = day3;
                 document.getElementById('day1').value = day1;
             }                      
         }
     }
   //alert(document.getElementById("range").value);  
  /*if(document.getElementById("range").value === "range")
 { 
     $(function()                                                                   //function for date-pick
     {
         $( "#day1" ).datepicker('destroy');
         $( "#day1" ).datepicker({ dateFormat: 'yy-mm-dd',yearRange: "1922:2014" , changeYear: true,   background: '#ff0000', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],  });
     }); 
    $(function()                                                                    //function for date-pick
     {
         $( "#day2" ).datepicker('destroy');
         $( "#day2" ).datepicker({ dateFormat: 'yy-mm-dd',yearRange: "1922:2014" , changeYear: true,   background: '#ff0000', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],  });
     }); 
     day1 = document.getElementById('day1').value;
     day2 = document.getElementById('day2').value;
 }
 else
 {
     $( "#day1" ).datepicker('destroy');
     $( "#day2" ).datepicker('destroy');  
 } */
      date1 = day1+"/"+day2; 
   //************aakash*******************   
// alert(date1);
  $.post('connect/EventCalender_connect.php', {data1: date1}, function (result)                       // retrive values from india vix table
    {     
       //alert(result); 
         var table = $('#eventcalander-grid').DataTable();
 
table
    .clear()
    .draw();
    $.fn.dataTable.ext.errMode = 'throw';
        $('#eventcalander-grid').DataTable({
                data: jQuery.parseJSON(result),
                "bDestroy": true, //destroy last table 
                "processing": true,
                "deferRender": true,
               
                "iDisplayLength": 5,
               // "bSort": false,
               "scrollY":  "375px",
                "bPaginate": false,
                "dom": ' <"top">t<"bottom"p>',
                "order": [[0, "asc"]]
              

            });
         /*   var table = $('#eventcalander-grid').DataTable();
           table.columns.adjust().draw();*/

    });
     /* var dataTable = $('#eventcalander-grid').DataTable( {
					"bDestroy": true,//destroy last table 
					"processing": true,
					"serverSide": true,
                                        "deferRender": true,
                                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                                        "columnDefs": [{ orderable: false, targets: [1] }],
                                         "iDisplayLength": 10,
                                       // "searching": true,
                                       // "scrollY":  "280px", /*for fixed header and scroll
                                        "dom":' <"top">t<"bottom"ip>',
										   "order": [[ 0, "asc" ]],
                                       // "scrollCollapse": true,
                                        language: {
                                            searchPlaceholder: "Company/yyyy-mm-dd/change",
                                            "sSearch": "" ,
											 oPaginate: {
										   "sNext":">",
										 "sPrevious":"<",
									   },
                                        },
					"ajax":{
						url :"connect/EventCalender_connect.php", // json datasource
						type: "POST",  // method  , by default get
						data: { data1: date1 },
						error: function(){  // error handling
							$(".eventcalander-grid-error").html("");
							$("#eventcalander-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No information</th></tr></tbody>');
							$("#eventcalander-grid_processing").css("display","none");
							
						}	
					}
				} );*/
       //***************aakash****************************
      today = dateFormat(today, "yyyy-mm-dd");
   
      if(day2 < today)
      document.getElementById("exp_time").innerHTML = "Time";
      else
      document.getElementById("exp_time").innerHTML = "Expected Time";
 $.post('event_connect.php', { date1: date1 }, function(result) { 
    var obj;
    //alert(result);
    var str2 = 'No Data';                                                           //diaplay this not data is there
    if(result.indexOf(str2) === -1)                                                  // check result value and str2 value equal or not
    {
        var obj = jQuery.parseJSON(result);                                         //parsing retrieve value
    }
     // deleting previous table row before inserting new value 
    var table1 = document.getElementById('dynt');                                  //take an object of table id dyn_t
    var rowCount = table1.rows.length - 1;                                          // count total row
    for(var i=rowCount; i>0; i--)                                                   // loop for deleting row
    {
        var row = table1.rows[i];                    
        table1.deleteRow(i);
        rowCount--;
    }
     // inserting table row with new values
    var table = document.getElementById('dynt');
    var i,j,total_row = obj.b;                                                      // it will total number of value
    var initial_cell = 1;                                                           //initial cell = 2 bcoz in array data we want start from 2
    var total_cell = 5;                                                            // total_cell bcoz we want data till only
    var rowCount = table.rows.length;
    for(j=0;j<total_row;j++)
    {
        var cell_no = 0;                                                                //for every row cell_no start from 0
        var row = table.insertRow(rowCount);                                            //inerting row
        if(j % 2 === 0)                                                                  //display row in alternate colour
        row.bgColor = 'grey';
        for(i=initial_cell;i<total_cell;i++)
        {                            
            var cell1 = row.insertCell(cell_no);
            if(i === initial_cell)
            {
                element1 = dateFormat(obj.a[i + 1], "dd mmm yyyy");
            }
            else if (i === initial_cell + 1)
            {   
                var d=new Date(obj.a[i]);
                var weekday=new Array(7);
                weekday[0]="Sunday";
                weekday[1]="Monday";
                weekday[2]="Tuesday";
                weekday[3]="Wednesday";
                weekday[4]="Thursday";
                weekday[5]="Friday";
                weekday[6]="Saturday";
                element1 = weekday[d.getDay()];
            }
            else if (i === initial_cell + 2)
            {
                if(obj.a[i] === "00:00:00")
                {
                    obj.a[i] = "";
                }
                var time1;
               time1 = tConvert(obj.a[i]);
                element1 = time1;
            }
            else if (i === initial_cell + 3)
            {
               element1 = obj.a[i - 3] + " Quarter  Result ";  
            }
            else
            {
                element1 = "";
            }
             cell1.innerHTML = element1;
             cell_no++; 
        }
        initial_cell = initial_cell + 5;
        total_cell = total_cell + 5;
    }
    initial_cell = 1;  
    total_cell = 5; 
    total_row = total_row + obj.d; 
    //j=0;
    while(j<total_row)
    {
        var cell_no = 0;                                                                //for every row cell_no start from 0
        var row = table.insertRow(rowCount);                                            //inerting row
        if(j % 2 === 0)                                                                  //display row in alternate colour
        row.bgColor = 'grey';
        for(i=initial_cell;i<total_cell;i++)
        {                            
            var cell1 = row.insertCell(cell_no);
            if(i === initial_cell)
            {
                element1 = dateFormat(obj.c[i + 1], "dd mmm yyyy");
            }
            else if (i === initial_cell + 1)
            {   
                var d=new Date(obj.c[i]);
                var weekday=new Array(7);
                weekday[0]="Sunday";
                weekday[1]="Monday";
                weekday[2]="Tuesday";
                weekday[3]="Wednesday";
                weekday[4]="Thursday";
                weekday[5]="Friday";
                weekday[6]="Saturday";
                element1 = weekday[d.getDay()];
            }
            else if (i === initial_cell + 2)
            {
                if(obj.c[i] === "00:00:00")
                {
                    obj.c[i] = "";
                }
               var time1;
               time1 = tConvert(obj.c[i]);
                element1 = time1;
            }
            else if (i === initial_cell + 3)
            {
               element1 = obj.c[i - 3] + "";  
            }
            else
            {
                element1 = "";
            }
             cell1.innerHTML = element1;
             cell_no++; 
        }
        initial_cell = initial_cell + 7;
        total_cell = total_cell + 7;
        j++;
    }
    });
 }
 function tConvert (time) {
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
}
/*function hours_am_pm(time) {
        var hours = time[0] + time[1];
        var min = time[2] + time[3];
        if (hours < 12) {
            return hours + ':' + min + ' AM';
        } else {
            hours=hours - 12;
            hours=(hours.length < 10) ? '0'+hours:hours;
            return hours+ ':' + min + ' PM';
        }
    }*/
/* window.onload = function() {
  range_sel('week');
};*/