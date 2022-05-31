<!doctype html>
<?php
include("header.php");
include("db_connect.php");
//error_reporting(0);
?>
<html>
    <head>
        <title>Implied Volatility IV  </title>


        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">    


        <style>
            /*
 * Component: Box
 * --------------
 */
            .box {
                position: relative;
                border-radius: 3px;
                background: transparent;
                border-top: 3px solid #d2d6de;
                margin-bottom: 20px;
                width: 100%;
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            }
            .box.box-primary {
                border-top-color: #3c8dbc;
            }
            .box.box-info {
                border-top-color: #00c0ef;
            }
            .box.box-danger {
                border-top-color: #dd4b39;
            }
            .box.box-warning {
                border-top-color: #f39c12;
            }
            .box.box-success {
                border-top-color: #00a65a;
            }
            .box.box-default {
                border-top-color: #d2d6de;
            }
            .box.collapsed-box .box-body,
            .box.collapsed-box .box-footer {
                display: none;
            }
            .box .nav-stacked > li {
                border-bottom: 1px solid #f4f4f4;
                margin: 0;
            }
            .box .nav-stacked > li:last-of-type {
                border-bottom: none;
            }
            .box.height-control .box-body {
                max-height: 300px;
                overflow: auto;
            }
            .box .border-right {
                border-right: 1px solid #f4f4f4;
            }
            .box .border-left {
                border-left: 1px solid #f4f4f4;
            }
            .box.box-solid {
                border-top: 0;
            }
            .box.box-solid > .box-header .btn.btn-default {
                background: transparent;
            }
            .box.box-solid > .box-header .btn:hover,
            .box.box-solid > .box-header a:hover {
                background: rgba(0, 0, 0, 0.1);
            }
            .box.box-solid.box-default {
                border: 1px solid #d2d6de;
            }
            .box.box-solid.box-default > .box-header {
                color: #444444;
                background: transparent;
                background-color: transparent;
            }
            .box.box-solid.box-default > .box-header a,
            .box.box-solid.box-default > .box-header .btn {
                color: #444444;
            }
            .box.box-solid.box-primary {
                border: 1px solid #3c8dbc;
            }
            .box.box-solid.box-primary > .box-header {
                color: #ffffff;
                background: #3c8dbc;
                background-color: transparent;
            }
            .box.box-solid.box-primary > .box-header a,
            .box.box-solid.box-primary > .box-header .btn {
                color: #ffffff;
            }
            .box.box-solid.box-info {
                border: 1px solid #00c0ef;
            }
            .box.box-solid.box-info > .box-header {
                color: #ffffff;
                background: #00c0ef;
                background-color: transparent;
            }
            .box.box-solid.box-info > .box-header a,
            .box.box-solid.box-info > .box-header .btn {
                color: #ffffff;
            }
            .box.box-solid.box-danger {
                border: 1px solid #dd4b39;
            }
            .box.box-solid.box-danger > .box-header {
                color: #ffffff;
                background: #dd4b39;
                background-color: transparent;
            }
            .box.box-solid.box-danger > .box-header a,
            .box.box-solid.box-danger > .box-header .btn {
                color: #ffffff;
            }
            .box.box-solid.box-warning {
                border: 1px solid #f39c12;
            }
            .box.box-solid.box-warning > .box-header {
                color: #ffffff;
                background: #f39c12;
                background-color: transparent;
            }
            .box.box-solid.box-warning > .box-header a,
            .box.box-solid.box-warning > .box-header .btn {
                color: #ffffff;
            }
            .box.box-solid.box-success {
                border: 1px solid #00a65a;
            }
            .box.box-solid.box-success > .box-header {
                color: #ffffff;
                background: #00a65a;
                background-color: transparent;
            }
            .box.box-solid.box-success > .box-header a,
            .box.box-solid.box-success > .box-header .btn {
                color: #ffffff;
            }
            .box.box-solid > .box-header > .box-tools .btn {
                border: 0;
                box-shadow: none;
            }
            .box.box-solid[class*='bg'] > .box-header {
                color: #fff;
            }
            .box .box-group > .box {
                margin-bottom: 5px;
            }
            .box .knob-label {
                text-align: center;
                color: #333;
                font-weight: 100;
                font-size: 12px;
                margin-bottom: 0.3em;
            }
            .box > .overlay,
            .overlay-wrapper > .overlay,
            .box > .loading-img,
            .overlay-wrapper > .loading-img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
            .box .overlay,
            .overlay-wrapper .overlay {
                z-index: 50;
                background: rgba(255, 255, 255, 0.7);
                border-radius: 3px;
            }
            .box .overlay > .fa,
            .overlay-wrapper .overlay > .fa {
                position: absolute;
                top: 50%;
                left: 50%;
                margin-left: -15px;
                margin-top: -15px;
                color: #000;
                font-size: 30px;
            }
            .box .overlay.dark,
            .overlay-wrapper .overlay.dark {
                background: rgba(0, 0, 0, 0.5);
            }
            .box-header:before,
            .box-body:before,
            .box-footer:before,
            .box-header:after,
            .box-body:after,
            .box-footer:after {
                content: " ";
                display: table;
            }
            .box-header:after,
            .box-body:after,
            .box-footer:after {
                clear: both;
            }
            .box-header {
                color: #444;
                display: block;
                padding: 10px;
                position: relative;
            }
            .box-header.with-border {
                border-bottom: 1px solid #f4f4f4;
            }
            .collapsed-box .box-header.with-border {
                border-bottom: none;
            }
            .box-header > .fa,
            .box-header > .glyphicon,
            .box-header > .ion,
            .box-header .box-title {
                display: inline-block;
                font-size: 18px;
                margin: 0;
                line-height: 1;
            }
            .box-header > .fa,
            .box-header > .glyphicon,
            .box-header > .ion {
                margin-right: 5px;
            }
            .box-header > .box-tools {
                position: absolute;
                right: 10px;
                top: 5px;
            }
            .box-header > .box-tools [data-toggle="tooltip"] {
                position: relative;
            }
            .box-header > .box-tools.pull-right .dropdown-menu {
                right: 0;
                left: auto;
            }
            .box-header > .box-tools .dropdown-menu > li > a {
                color: #444!important;
            }
            .btn-box-tool {
                padding: 5px;
                font-size: 12px;
                background: transparent;
                color: #97a0b3;
            }
            .open .btn-box-tool,
            .btn-box-tool:hover {
                color: #606c84;
            }
            .btn-box-tool.btn:active {
                box-shadow: none;
            }
            .box-body {
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                border-bottom-right-radius: 3px;
                border-bottom-left-radius: 3px;
                padding: 10px;
            }
            .no-header .box-body {
                border-top-right-radius: 3px;
                border-top-left-radius: 3px;
            }
            .box-body > .table {
                margin-bottom: 0;
            }
            .box-body .fc {
                margin-top: 5px;
            }
            .box-body .full-width-chart {
                margin: -19px;
            }
            .box-body.no-padding .full-width-chart {
                margin: -9px;
            }
            .box-body .box-pane {
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 3px;
            }
            .box-body .box-pane-right {
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                border-bottom-right-radius: 3px;
                border-bottom-left-radius: 0;
            }
            .box-footer {
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                border-bottom-right-radius: 3px;
                border-bottom-left-radius: 3px;
                border-top: 1px solid #f4f4f4;
                padding: 10px;
                background-color: #ffffff;
            }
            .chart-legend {
                margin: 10px 0;
            }
            @media (max-width: 991px) {
                .chart-legend > li {
                    float: left;
                    margin-right: 10px;
                }
            }
            .box-comments {
                background: #f7f7f7;
            }
            .box-comments .box-comment {
                padding: 8px 0;
                border-bottom: 1px solid #eee;
            }
            .box-comments .box-comment:before,
            .box-comments .box-comment:after {
                content: " ";
                display: table;
            }
            .box-comments .box-comment:after {
                clear: both;
            }
            .box-comments .box-comment:last-of-type {
                border-bottom: 0;
            }
            .box-comments .box-comment:first-of-type {
                padding-top: 0;
            }
            .box-comments .box-comment img {
                float: left;
            }
            .box-comments .comment-text {
                margin-left: 40px;
                color: #555;
            }
            .box-comments .username {
                color: #444;
                display: block;
                font-weight: 600;
            }
            .box-comments .text-muted {
                font-weight: 400;
                font-size: 12px;
            }
        </style>
        <script>
            $(document).ready(function(){
                $('video').bind('contextmenu',function() { return false; });
                 $('body').bind('contextmenu',function() { return false; });
             });
        
        </script>

    </head>
    <body >
     
            <div class="row">
                 <div class="col-lg-6 col-lg-offset-3 ">
                    
                        <div class="title_all" id="hitorical">
                            <h3>BlissQuants Data Analytics</h3>
                        </div>
                        <div class="box-body">
                            <iframe width="100%" height="456" src="https://www.youtube.com/embed/VaEQ6SDCHl0?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                         
                          <a href='#' data-toggle='modal' data-target='#Register-modal'><input class=' btn-lg btn-block text-center'  value='Request a Demo'></a>  
                          
                    </div>
               
            </div>
        
                  
        </div>

    </body>