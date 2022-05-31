<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include("header.php");
include("db_connect.php");
?>
<html>
    <head>
        <title>Bliss Earnings</title> 
        <script src="js/jquery-ui.js"></script>    
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">

        <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>

        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">    
        <script src="js/dateformat.js"></script>

        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/BlissData.css">    
        <script>
            var curr_link;






            $(document).ready(function () {
                // alert("df");
                var table = $('#iv_index-table').DataTable({"bDestroy": true, //destroy last table 
                    "processing": true,
                    "deferRender": true,
                    "lengthMenu": [5, 10, 25, 50, 100],
                    "iDisplayLength": 20,
                    "searching": true,
                    "sScrollX": true,
                    "paging": false,
                    "scrollY": "60vh",
                    "dom": ' <"top">t<"bottom"p>',
                    "order": [[4, "desc"]],
                    language: {
                        oPaginate: {
                            "sNext": ">",
                            "sPrevious": "<"
                        },
                        "sEmptyTable": "No Script",
                        // "sInfoFiltered": "" //remove filter label text on searching
                    }});



            });

        </script>

    </head>
    <body>     


        <div class="row wrap title_all">
            <div class="col-lg-3">

            </div>

            <div class="col-lg-6" >
                <ul class="nav nav-tabs" style="border:none">  
                    <li  > <a href="BlissIndexSpread.php"  >Weekly Banknifty</a></li> 
                    <!--       <li > <a href="IV-Result" > 1st Month </a></li>
                      <li  > <a href="IV-Result-2" >2nd Month </a></li>
                      <li  > <a href="IV-Result-3"  > 3rd Month</a></li>
                    -->

                    <li  > <a href="BlissNiftySpread.php"  >Weekly Nifty</a></li> 
                    <h3>IV Analytics: Index Spread </h3> 
                </ul>

                <table  id="iv_index-table" class="table table-striped table-bordered">

                    <thead>
                        <tr>

                            <td>Time Stamp</td>
                            <td>Long</td>

                            <td>Short</td>
                            <td>Type</td>
                            <td>Cost</td>


                            <td>Range</td>



                        </tr>
                    </thead>
                    <?php
                    if (isset($_SESSION['user_id']) && $_SESSION['plan'] != "FREE") {
                        $sql_current = "SELECT * FROM `index_spread` where ranges > '400' and scrip = 'BANKNIFTY' order by ranges desc";
                        $result_current = mysqli_query($con, $sql_current);
                        $num_row = mysqli_num_rows($result_current);
                        //echo $num_row;
                        if ($num_row == 0) {
                            $sql_current = "SELECT * FROM `index_spread` where ranges > '200' and scrip = 'BANKNIFTY' order by ranges desc";
                            $result_current = mysqli_query($con, $sql_current);
                        }
                        while ($row = mysqli_fetch_row($result_current)) {

                            echo "      <tr>
                            
                          
                        
                            <td>" . date("d M Y", strtotime($row[1])) . " " . date("h:i A", strtotime($row[2])) . "</td>
                            <td>" . $row[3] . " @ " . $row[4] . "</td>
                               
                            <td>" . $row[5] . " @ " . $row[6] . "</td>
                                  <td> 1 : " . $row[8] . " " . $row[10] . "</td>
                            <td>" . Round($row[7] * 20, 1) . "</td>
                                
                          
                               
                            <td>" . $row[9] . "</td>
                          
                           
                        </tr>";
                        }
                    } else {
                        echo "      <tr>
                            
                          
                        
                            <td>XX</td>
                            <td>XX</td>
                            <td>XX</td>
                            <td>XX</td>
                            <td>XX</td>
                            <td>XX</td>
                            
                        
                           
                        </tr>";
                    }
                    ?>
                </table>
            </div>

            <div class="col-lg-2">

            </div>

        </div>







    </body>
</html>


<?php
include("html/footer.html");
?>

