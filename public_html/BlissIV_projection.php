<!doctype html>
<?php
include("header.php");
include("db_connect.php");
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
        <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="css/BlissEventCalendar.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">      
        <script src="js/dateformat.js"></script>

        <script  type="text/javascript" language="javascript">
            //on enter press go to next field 
            $(document).ready(function () {
                //alert("fd");
                c_date = new Date();
                curr_date = new Date(); // gives current date
                //function for prebvious date--------------------
                curr_date = dateFormat(curr_date, "yyyy-mm-dd");
                $("#day1_vq").datepicker({dateFormat: 'yy-mm-dd', yearRange: "2008:2018", changeYear: true, minDate: c_date, background: '#FFFFFF', dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']});
                $('#day1_vq').datepicker('setDate', c_date);


                curr_date1 = new Date();
                curr_date1.setDate(curr_date1.getDate() - 1); // it will give previous day date
                curr_date1 = dateFormat(curr_date1, "yyyy-mm-dd");
                date2 = curr_date1; // settind date2 to previous date


                get_projection();
    


            });



            function get_projection() //passing selected duration today,week or month
            {
                $("#border").addClass("ticker");
                search = document.getElementById("search2").value;
                date = document.getElementById('day1_vq').value;
                // alert(search);
                ar_data = {date1: date, //date
                    c_name2: search // company name
                };
                $.post('connect/get_projection.php', {ar_data: ar_data}, function (result) { //send data to blissdelta_delta_connect.php page
                    document.getElementById('projection').innerHTML = result;

                });
            }

        </script>
    </head>
    <body >   

         <div class="row wrap">
           
        <div class="col-lg-3 col-md-3 col-sm-3">
          
      </div>
            
               
    <div class="col-lg-6 col-md-6 col-sm-6  text-center "> 
       <div class="title_all text-center">
                    IV Projection (Assuming spot price as last closed price)

                </div>


             

                        <form class="form-horizontal" action="" method="post" >

                            <table class="table table-striped">

                                <tbody>

                                <td colspan="3">


                                    <input type='text' class="form-control control_color_1 "  onchange="get_projection()"     id='day1_vq'>
                                </td>
                                <td>


                                    <select id="search2" name="search2" class="form-control control_color_1 selectpicker " placeholder="Search Scrip" onchange="get_projection()"  data-live-search="true">
                                        <?php
                                        $sql_all_companies = "SELECT c_name FROM `companies`";
                                        $result_all_companies = mysqli_query($con, $sql_all_companies);
                                        //$all_company = mysqli_fetch_array($result_companies);
                                        while ($row = mysqli_fetch_array($result_all_companies)) {

                                            echo "<option data-tokens='" . $row['c_name'] . "'>" . $row['c_name'] . "</option>";
                                        }
                                        ?>


                                    </select>

                                </td>
                                </tbody>
                            </table>
                            <div class="form-group">
              <label class="col-md-6 btn-lg" id="marginrequired"  >IV Projection:-</label>
              <div class="col-md-6">
                 <label  id="projection" class="btn-lg"> N/A </label>
              </div>
            </div> 
                        </form>
                       
      
                    </div>

            

                </div>


            </div>



        </div>

        <?php
        include("html/footer.html");
        ?>
    </body>
</html>



