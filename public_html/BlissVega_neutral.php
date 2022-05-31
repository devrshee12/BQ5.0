<!doctype html>
<?php
include("header.php");
include("db_connect.php");
//error_reporting(0);
?>
<html>
    <head>
        <title>IV Data</title>

        <script src="js/jquery-ui.js"></script>    
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">

        <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="amstockchart/amcharts/amcharts.js"></script>
        <script type="text/javascript" src="amstockchart/amcharts/serial.js"></script>    
        <script type="text/javascript" src="amstockchart/amcharts/light.js"></script>    
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">    
        <script src="js/dateformat.js"></script>
        
        <script src="js/BlissIV_vol_vega.js"></script>     
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/BlissData.css">    


        <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
       
    </head>
    <body  onload="range_sel('vega_connect.php');">   <!-- by default load 1 day data -->  
 <style>
         
            </style>
        <?php include("./IV_Vega_Design.php"); ?>

        <script>
            document.getElementById("iv_title").innerHTML = "Historical IV Analytics – Historical option data of At-the-money Implied Volatility with Future price movement ";
        </script>