<!doctype html>
<?php
include("header.php");
include("./db_connect.php");
error_reporting(0);
?>
<html>
    <head>
        <title> BlissQuants - Delta Hedging | Fund Management </title>

        <script src="js/jquery-ui.js"></script>    
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">

        <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="amstockchart/amcharts/amcharts.js"></script>
        <script type="text/javascript" src="amstockchart/amcharts/serial.js"></script>    
        <script type="text/javascript" src="amstockchart/amcharts/light.js"></script>    
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">    
        <script src="js/dateformat.js"></script>
        <script src="js/BlissIV_vol.js"></script>     

<link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/BlissData.css">    
        

    </head>
    <body  onload="range_sel('iv3_result_vol_1_connect.php')">   <!-- by default load 1 day data -->  
                   
        
    <?php   include("IV3_Design.php"); ?>
    </body>
</html>