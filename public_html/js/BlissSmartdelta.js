

$(document).ready(function () {
   // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
    range_sel_delta();
    //alert(search);
   
  
  
});
var date1 = "2014-01-09/2014-12-31", date2, day1, day2, day3, week_date, c_date;
var sort, sort_count = 0, search, cnt = 0;
var ar_data;

function range_sel_delta() //passing selected duration today,week or month
{
    $.post('Smartdelta_connect.php', {}, function (result)                       // retrive values from india vix table
    {       alert(jQuery.parseJSON(result)); 
       /* var str2 = 'No Data';
        var str2 = 'No Data';
        if (result.indexOf(str2) === -1)
        {
            arr_data = jQuery.parseJSON(result);

        } else
        {
            nope = "no";
        }*/
          var obj = jQuery.parseJSON(result);
        $('#smartdelta').DataTable({               
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

            });

    });

}

