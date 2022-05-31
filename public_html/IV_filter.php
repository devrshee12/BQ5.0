<!doctype html>
<?php
include("header.php");
include("./db_connect.php");
error_reporting(0);
?>
<html>
    <head>
        <title> BlissQuants - Delta Hedging | Fund Management </title>
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
        <style>
            span:hover{
                background-color: blue;
            }
            #chartdiv_vol {
                width		: 60%;
                position        :fixed;
                z-index         : 10; 
                height		: 60%;

                border          : 5px solid;
                border-color    : white;
                font-size	: 11px;
                background-color: rgb(58, 53, 49);  
                overflow-y:auto;
                display: none;
            }
            .table{
                text-align: left;
            }
            .table-bordered{
                border:1px solid transparent;
            }
            .table-bordered > thead > tr > th{
                border:1px solid black;
            }
            table.table-bordered > tbody > tr > td{
                border:1px solid black;
            }
            /*css resolution setting*/
            @media (min-width: 800px) and (max-width: 1100px) 
            {                
                .nav-pills > li > a{     
                    width: 100%;
                    background-color:  #474545;
                    margin-bottom: 3px;
                    color: white!important;
                    font-size: 10px;
                    text-align: left;    
                    -webkit-transition: all .5s ease-in-out;
                    -moz-transition: all .5s ease-in-out;     
                }
                .navbar-nav > li
                {        
                    background-color: #474545;
                    font-family: bold;
                    margin-left: 0.25%;
                    font-size: 12px;
                }
                .footer1
                {    
                    position: relative;
                    padding-top: 200px;
                }         
            }
            @media  (min-width: 320px) and (max-width: 800px) { 

                .nav-pills > li > a{     
                    width: 100%;
                    background-color:  #474545;
                    margin-bottom: 3px;
                    color: white!important;
                    font-size: 10px;
                    text-align: left;    
                    -webkit-transition: all .5s ease-in-out;
                    -moz-transition: all .5s ease-in-out;     
                }
                .navbar-nav > li{        
                    background-color: #474545;
                    font-family: bold; 
                    margin-left: 0.25%;
                    font-size: 12px;
                }
                .footer1{    
                    position: relative;
                    padding-top: 200px;     
                }      
            }   

        </style>  
    </head>
    <body  onload="range_sel('iv_filter_connect.php');">   <!-- by default load 1 day data -->  
         <?php   include("IV_Design.php"); ?>
    </body>
</html>