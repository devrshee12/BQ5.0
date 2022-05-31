<!doctype html>
<?php
include("header.php");
include("./db_connect.php");
error_reporting(0);
?>
<html>
    <head>
        <title> Short Gamma </title>
        <link href="css/BlissVol.css" rel="stylesheet">    
        <script src="js/jquery-ui.js"></script>    
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">

        <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="amstockchart/amcharts/amcharts.js"></script>
        <script type="text/javascript" src="amstockchart/amcharts/serial.js"></script>    
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">    
        <script src="js/dateformat.js"></script>
        <script src="js/BlissIV_vol.js"></script>    
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/BlissData.css">    
        <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>

    </head>
    <body  onload="range_sel('short_gamma_connect.php');">   <!-- by default load 1 day data -->  
        <?php include("IV_Design.php"); ?>
    </body>
</html>
<script>
    document.getElementById("iv_title").innerHTML = "Stable IV Analytics - List of securities which are running at stable Implied Volatility";
</script>