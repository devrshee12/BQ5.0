<!doctype html>
<?php
include("header.php");
include("db_connect.php");
//error_reporting(0);
?>
<html>
    <head>
        <title>Implied Volatility IV  </title>

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
    <body  onload="range_sel('iv2_long_connect.php'); ">   <!-- by default load 1 day data -->  
        
        <?php   include("IV2_Design.php"); ?>
        
    <script>
     //   document.getElementById("iv_title").innerHTML= "Historical IV Analytics – Historical option data of At-the-money Implied Volatility with Future price movement ";
        </script>