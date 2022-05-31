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
           <style>
            /*few changes in table different from custom.css*/
        /*for text center , paddding 0 etc in table cell*/
        
   
            
      .form-group{
        margin:1px;
    }
    
    
 
 



 
</style>   
    <script>


    $(document).ready(function () {
// Setup - add a text input to each footer cell




        range_sel_delta();
        //alert(search);



    });
    var date1 = "2014-01-09/2014-12-31", date2, day1, day2, day3, week_date, c_date;
    var sort, sort_count = 0, search, cnt = 0;
    var ar_data;
    var tenup, tendown, totalpl;
    function range_sel_delta() //passing selected duration today,week or month
    {
        $.post('Smartdelta5_connect.php', function (result)                       // retrive values from india vix table
        {   // alert(result);

            var obj = jQuery.parseJSON(result);
            var table = $('#smartdelta').DataTable({
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
                    this.api().columns().every(function () {
                        var column = this;
                        //  alert(column)
                        if ($(column.header()).hasClass('select')) {
                            var select = $('<select class="form-control control_color_1 selectpicker" id="select" ><option value="">ALL</option></select>')
                                    .appendTo($(column.header()))
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                                );

                                        column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                    });
                            // alert("");
                            column.data().unique().sort().each(function (d, j) {

                                select.append('<option value="' + d + '">' + d + '</option>')
                            });

                        }

                    });
                }, footerCallback: function () {

                    var api = this.api();

                    var table = api.table();
                    //  alert(table.footer());
                    //Sub Total
                    $(table.column(4).footer()).html(
                            api.column(4, {page: 'current'}).data().sum().toFixed(0)
                            );
                    $(table.column(5).footer()).html(
                            api.column(5, {page: 'current'}).data().sum().toFixed(0)
                            );
                    $(table.column(6).footer()).html(
                            api.column(6, {page: 'current'}).data().sum().toFixed(0)
                            );
                    $(table.column(7).footer()).html(
                            api.column(7, {page: 'current'}).data().sum().toFixed(0)
                            );
                  //  $('tr:eq(1) td:eq(2)', api.table().footer()).html(format(total2, ''));
                   totalpl = table.column( 4 ).data().sum() / 1000;
                           document.getElementById("totalpl").innerHTML =  Math.round(totalpl) ;  
                           livepl = table.column( 5 ).data().sum() / 1000;
                           document.getElementById("livepl").innerHTML =  Math.round(livepl) ;  
                  tenup = table.column( 6 ).data().sum() / 1000;
                           document.getElementById("tenup").innerHTML =  Math.round(tenup) ;  
                           tendown = table.column( 7 ).data().sum() / 1000;
                           document.getElementById("tendown").innerHTML =  Math.round(tendown) ;  
                }

            });
            
            table.columns.adjust().draw();
            // alert(document.getElementById("totalpl"));

              
              // document.getElementById("tendown").innerHTML =  table.column( 7 ).data().sum().tofixed(2); 
            //totalpl = table.column( 4 ).data().sum();
            
        });



    }



</script> 

    </head>
    <body>
        <div class="col-lg-10 col-lg-offset-2">
               <ul class="nav nav-tabs">
      <li><a href="Bliss_Daily_Data_table_admin.php">M2M</a></li>
                                <li><a href="SmartDelta5.php">10% Up Down </a></li>
                                <li><a href="SmartDelta3.php">Individual M2M</a></li>
    </ul>
              <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                       
                                <div class="col-lg-3 form-group">
                            <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                    <input class="form-control panel-heading" id="search1"   name="search" placeholder="Search for" required>
                                </div>
                            <div class="col-lg-3 form-group">
                                    <input type='button' id="search" class="btn  panel-heading" onClick ="get_member_data(document.getElementById('search1').value)" value="Search">
                                    <input type='button' class="btn  panel-heading" onClick ="location.href='Bliss_Daily_Data_Table_Admin.php';" value="Back">

                            </div>     
                        <button class="panel-heading" onclick="copyToClipboard('')">Copy Data</button>
    <table id="smartdelta"   class='table table-striped table-bordered'>

        <thead>
        <th class='col-lg-2 select'>client id</th>
        <th class='col-lg-4 select'>Client Name</th>


        <th class='col-lg-1'> Deposit </th>
        <th class='col-lg-1'> Margin </th>

        <th class='col-lg-2'>Yesterday M2M </th>
        <th class='col-lg-2'>Live M2M </th>

        <th class='col-lg-1'>Live 10% Up </th>
        <th class='col-lg-1'>Live 10% Down </th>
    </thead>

    <tfoot>
        <tr>
            <td  colspan="4">Total</td>


            <td   ></td>
            <td ></td>
            <td  ></td>
            <td  ></td>
        </tr>
        <tr>
            <td  colspan="4">Total (000s)</td>


            <td  id="totalpl" ></td>
            <td id="livepl"></td>
            <td   id="tenup"></td>
            <td   id="tendown"></td>
        </tr>
    </tfoot>

</table>
            </div>
              </div></div>
        </body>
   







