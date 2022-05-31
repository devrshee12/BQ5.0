
$(function() 
{ 
  
    range_sel_event();
   
});

var date1 = "2014-01-09/2014-12-31",day1,day2,day3,week_date;
function range_sel_event() //passing selected duration today,week or month
{   

  
         var date = new Date();
         var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);           // it will give first day of month
         var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);        // it will give last day of month (month +1 means next month, 0 for previous month last date
         day1 = dateFormat(firstDay, "yyyy-mm-dd");
         day2 = dateFormat(lastDay, "yyyy-mm-dd");
         day3 = dateFormat(firstDay, "mmm yyyy");
        // week_date = day2;
      
     
    
     date1 = day1+"/"+day2; 
   
   //************aakash*******************   
 //alert(date1);
    get_data();
      
  
 
 }
 function get_data()
 {//alert(date1);
   var dataTable = $('#eventcalander-grid').DataTable( {
					"bDestroy": true,//destroy last table
                                        "fixedHeader": true,
					"processing": true,
					"serverSide": true,
                                        "deferRender": true,
                                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                                        "columnDefs": [{ orderable: false, targets: [1] }],
                                         "iDisplayLength": 10,
                                          
                                       // "searching": true,
                                       // "scrollY":  "280px", /*for fixed header and scroll
                                        "dom":' <"top">t<"bottom"ip>',
					"order": [[ 0, "desc" ]],
                                       //"scrollCollapse": true,
                                       "scrollY":  "200px",
                                        language: {
                                            searchPlaceholder: "Company/yyyy-mm-dd/change",
                                            "sSearch": "" ,
                                        oPaginate: {
                                                   "sNext":">",
                                                 "sPrevious":"<html> <</html>",
                                           },
                                        },
					"ajax":{
						url :"EventCalender_connect.php", // json datasource
						type: "POST",  // method  , by default get
						data: { data1: date1 },
						error: function(){  // error handling
							$(".eventcalander-grid-error").html("");
							$("#eventcalander-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No information</th></tr></tbody>');
							$("#eventcalander-grid_processing").css("display","none");
							
						}	
					}
				} );
                            }
                            