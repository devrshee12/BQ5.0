<?php

include("header.php");
?>

<html>
  <head>
    <title> BlissQuants - Delta Hedging | Fund Management </title>
     <script src="js/jquery-ui.js"></script>    
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">
        <script type="text/javascript" language="javascript" src="bootstrap-3.3.4-dist/js/jquery.carouFredSel-6.0.4-packed.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">      
        <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
         <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>
 <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/BlissData.css">    
      <table id="smartdelta"   class='table table-striped table-bordered'>
  
<thead>
  <th class=' select'>client id</th>
<th class=' select'>Client Name</th>
<th class=' select'>Scrip Name</th>
<th class=' select'> Ex date</th>
 <th class=' '> Current Date</th>
<th > Qty</th>

<th >Rate</th>

<th > Amount</th>
<th ><span >  Close Price</span></th>

<th >Book PL </th>
<th >Notional PL</th>
<th >Tota PL</th>
<th >Type</th>
<th >10 Up</th>
<th >10 Down</th>
</thead>

<tfoot>
    <tr>
<td  colspan="10">Total</td>


<td  id="totalpl" ></td>
<td ></td>
<td   id="tenup">10 Up</td>
<td   id="tendown">10 Down</td>
    </tr>
</tfoot>

</table>
     <script>
     

$(document).ready(function () {
// Setup - add a text input to each footer cell
   



    range_sel_delta();
    //alert(search);
 
  
  
});
var date1 = "2014-01-09/2014-12-31", date2, day1, day2, day3, week_date, c_date;
var sort, sort_count = 0, search, cnt = 0;
var ar_data;
var tenup,tendown,totalpl;
function range_sel_delta() //passing selected duration today,week or month
{
    $.post('Smartdelta_connect.php',  function (result)                       // retrive values from india vix table
    {    //   alert(result);
       
         var obj = jQuery.parseJSON(result);
     var table =   $('#smartdelta').DataTable({               
                 data: obj,
                "bDestroy": true, //destroy last table 
                "processing": true,
                "deferRender": true,
                "lengthMenu": [5, 10, 25, 50, 100],
                "iDisplayLength": 20,
                // "searching": true,
                "sScrollX": "100%", 
                "paging": false,
                "scrollY": "60vh",
                "dom": ' <"top">t<"bottom"p>',
                "order": [[1, "asc"]],
                language: {
                    oPaginate: {
                        "sNext": ">",
                        "sPrevious": "<"
                    },
                    "sEmptyTable": "No Script",
                    "sInfoFiltered": "" //remove filter label text on searching
                },
                initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
              //  alert(column)
               if ($(column.header()).hasClass('select')) {
                var select = $('<select class="form-control control_color_1 selectpicker col-lg-1" id="select" ><option value="">ALL</option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 // alert("");
                column.data().unique().sort().each( function ( d, j ) {
                   
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
                
                }
                
            } );
            },footerCallback: function () {

                    var api = this.api();

                    var table = api.table();
                  //  alert(table.footer());
                    //Sub Total
                    $( table.column( 10).footer() ).html(
                        api.column( 11, {page:'current'} ).data().sum().toFixed(0)
                    );
           
            $( table.column(12  ).footer() ).html(
                        api.column( 13, {page:'current'} ).data().sum().toFixed(0)
                    );
            $( table.column( 13 ).footer() ).html(
                        api.column( 14, {page:'current'} ).data().sum().toFixed(0)
                    );

                    
            }

            });
           // alert(document.getElementById("totalpl"));
      
         document.getElementById("tenup").innerHTML = table.column( 13 ).data().sum(); 
          document.getElementById("tendown").innerHTML = table.column( 14 ).data().sum(); 
            totalpl = table.column( 11 ).data().sum();
table.columns.adjust().draw();
    });
    


}


     
     </script>    
   
     
       




