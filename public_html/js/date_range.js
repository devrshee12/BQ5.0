/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    var select1 = document.getElementById("range").value; 

     if(select1 == 'range')
     {
         $('#range_text').show(); 
         $('#b1').hide();
         $('#b2').hide();
         $('#b3').show();
     }
     else
     {
         $('#b1').show();
         $('#b2').show();
         $('#b3').hide();
         $('#range_text').hide();
     }
    var get_duration;
    if(duration == 'week')
         {
             var c_date = new Date();
             var firstDay = new Date(c_date);
             firstDay.setDate(firstDay.getDate() - firstDay.getDay() + 1);
             var lastDay = new Date(c_date);
             lastDay.setDate(lastDay.getDate() - lastDay.getDay() + 7);
             day1 = dateFormat(firstDay, "yyyy-mm-dd");
             day2 = dateFormat(lastDay, "yyyy-mm-dd");
             day3 = dateFormat(firstDay, "mmm yyyy");
             week_date = day2;
             document.getElementById('day2').value = "From "+day1+" To "+day2;
             document.getElementById('day1').value = day1;
         }
    else if(duration == 'month')
         {
             var date = new Date();
             var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
             var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
             day1 = dateFormat(firstDay, "yyyy-mm-dd");
             day2 = dateFormat(lastDay, "yyyy-mm-dd");
             day3 = dateFormat(firstDay, "mmm yyyy");
             week_date = day2;
             document.getElementById('day2').value = day3;
             document.getElementById('day1').value = day1;
         }
     else if(duration == 'year')
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
         }
         else if(duration == 'range')      
          {
             document.getElementById('day2').value = "";
             document.getElementById('day1').value = "";
          }
         else if(duration == 'Go')
         {
             day1 = document.getElementById('day1').value;
             day2 = document.getElementById('day2').value;
         }
        else if(duration == '<<')
         {
          var select = document.getElementById("range").value; //getting the selected value

             if(day1 > "2009-01-01")
                {
                 if(select == 'week')
                   {
                     get_duration = document.getElementById('day1').value;
                     var firstDay = new Date(get_duration);
                     firstDay.setDate(firstDay.getDate() - firstDay.getDay()-6);
                     var lastDay = new Date(get_duration);
                     lastDay.setDate(lastDay.getDate() - lastDay.getDay());
                     day1 = dateFormat(firstDay, "yyyy-mm-dd");
                     day2 = dateFormat(lastDay, "yyyy-mm-dd");
                     day3 = dateFormat(firstDay, "mmm yyyy");
                     document.getElementById('day2').value = "From "+day1+" To "+day2;;
                     document.getElementById('day1').value = day1;
                   }
                 else if(select == 'month')
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
                else if(select == 'year')
                    {
                     get_duration = document.getElementById('day1').value;
                     var date = new Date(get_duration);
                     var firstDay = new Date(date.getFullYear() - 1, 0, 1);
                     var lastDay = new Date(date.getFullYear(), 0, 0);
                     day1 = dateFormat(firstDay, "yyyy-mm-dd");
                     day2 = dateFormat(lastDay, "yyyy-mm-dd");
                     day3 = dateFormat(firstDay, "yyyy");
                     document.getElementById('day2').value = day3;
                     document.getElementById('day1').value = day1;
                    }
                }
         }
         else if(duration == '>>')
         {
          var select = document.getElementById("range").value; //getting the selected value
             if(day2 < week_date)
                {     
                if(select == 'week')
                    {
                     get_duration = document.getElementById('day1').value;
                     var firstDay = new Date(get_duration);
                     firstDay.setDate(firstDay.getDate() - firstDay.getDay() + 8);
                     var lastDay = new Date(get_duration);
                     lastDay.setDate(lastDay.getDate() - lastDay.getDay() + 14);
                     day1 = dateFormat(firstDay, "yyyy-mm-dd");
                     day2 = dateFormat(lastDay, "yyyy-mm-dd");
                     day3 = dateFormat(firstDay, "mmm yyyy");
                     document.getElementById('day2').value = "From "+day1+" To "+day2;;
                     document.getElementById('day1').value = day1; 
                    }
                 else if(select == 'month')
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
                else if(select == 'year')
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
      if(document.getElementById("range").value == "range")
         {
            $(function()  //function for date-picker
                {
                 $( "#day1" ).datepicker('destroy');
                 $( "#day1" ).datepicker({ dateFormat: 'yy-mm-dd',yearRange: "1922:2014" , changeYear: true,   background: '#ff0000', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],  });
                }); 
            $(function()  //function for date-picker
             {
              $( "#day2" ).datepicker('destroy');
              $( "#day2" ).datepicker({ dateFormat: 'yy-mm-dd',yearRange: "1922:2014" , changeYear: true,   background: '#ff0000', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],  });
             }); 
         }
     else
     {
       $( "#day1" ).datepicker('destroy');
       $( "#day2" ).datepicker('destroy');  
     }         



