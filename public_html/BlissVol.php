<!doctype html>         
<?php
/*$time;
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;*/

//    include("session_check.php");      
    include("header.php"); 
   // include("html/BlissVol.html");   
   
 /*   
 $time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo 'Page generated in '.$total_time.' seconds.----------';*/
?>
 <html>
  <head>
    <title>Bliss Vol</title>  
   
    <link href="css/BlissVol.css" rel="stylesheet">    
    <script src="js/jquery-ui.js"></script>    
      <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">
               
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
                   <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
     <script type="text/javascript" src="amstockchart/amcharts/amcharts.js"></script>
    <script type="text/javascript" src="amstockchart/amcharts/serial.js"></script>    
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">    
    <script src="js/dateformat.js"></script>
    <script src="js/BlissVol_heatmap.js"></script>
   
  </head>
  <body onload="range_heatmap('1day')">    
            <div id="chartdiv_vol"></div>
          
              
    <div class="row wrap">
        
        <div class="col-md-12 ">
            <div class="row title_all text-center">
                  <h3>IV Analytics: IV HeatMap </h3> 
               <span  class="blink small_font pull-right" id="vol_time"></span>
            </div>
           </div>
      
        <div class="col-lg-6 col-md-offset-3 text-center">  
          
             <form class="form-inline" role="form">   
                    <select name="range" onchange="range_heatmap(this.value)" class="form-control control_color_1" id="range2">                    
                        <option value="" ></option>
                        <option value="1day" selected="selected">1 day</option>
                        <option value="week" >1 Week</option>
                        <option value="fifteen" >15 Days</option>
                        <option value="one_m">1 Month</option>
                      <!--  <option value="three_m">3 Month</option>
                        <option value="all">All time</option>-->
                    </select>
             </form>
           
            <table id="dyn_t2" class="text-center BlissVolHeatmap BlissColor">
            <thead>
                <tr>                
                    <td colspan="4" class="BlissColor"></td>
                </tr>  
            </thead>
            
             </table> 
            <br>
            
        </div>
    
    </div>
            

    </body>
</html>
         
   <?php
    include("html/footer.html");    
    ?>