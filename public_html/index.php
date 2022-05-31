<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include("header.php");
?>      
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" >
        <title>BlissQuants IV</title> 
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        <style>
            /*  .carousel-control{
                  width:10%;
              }*/
            /* .carousel-inner > .item > img,
             .carousel-inner > .item > a > img {
                 width: 100%;
                 height: 100%;
               
             }*/
            body{
                background :  url('images/bliss_back.gif') no-repeat fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            .carousel-inner{
                height:585px;
            }

            .hovereffect .overlay {
                width:100%;
                height:100%;
                position:absolute;
                overflow:hidden;
                top:0;
                left:0;
                opacity:0;
                background-color:rgba(58,53,49,0.90);
                -webkit-transition:all .4s ease-in-out;
                transition:all .4s ease-in-out
            }

            h2 {
                margin-top: 15%;
                margin-right: 5%;
                color:#fff;
                text-align:right;
                position:relative;
                font-size:48px;
                padding:0px;
                height:100px;
                font-family: 'Josefin Sans';
                font-style: normal;
                font-weight: 400;
                padding-left:30%;
            }
            h4 {
                margin: 10% 5%;
                color:#fff;
                text-align:right;
                position:relative;
                font-size:36px;
                padding:0px;
                font-family: 'Josefin Sans';
                font-style: normal;
                padding-left:15%;
            }
            .hovereffect span{
                font-size: 36px;
                color:rgb(132,194,37);
                font-weight: bold;
            }
            .hovereffect a.info {
                text-decoration:none;
                display:inline-block;
                text-transform:uppercase;
                color:#fff;
                border:1px solid #fff;
                background-color:transparent;
                opacity:0;
                filter:alpha(opacity=0);
                -webkit-transition:all .2s ease-in-out;
                transition:all .2s ease-in-out;
                margin:150px 0 0;
                padding:7px 14px;
                font-size: 16px;
            }


            .hovereffect .overlay {
                opacity:1;
                filter:alpha(opacity=100);

            }

            .carousel-indicators li {

                width: 18px;
                height: 18px;
                margin: 10px;

                border-color: #84C225;
                box-shadow: inset 0 1px 1px rgb(132,194,37), 0 0 8px rgb(132,194,37);
            }
            .carousel-inner .active{
                background-color: transparent !important;
            }
            .carousel-indicators .active {
                width: 18px;
                height: 18px;
                margin: 10px;
            }
            .img-responsive2{
                height:75%;

            }

            .img-responsive{
                margin-top:20%;
                height:auto;
                width:auto;
            }
            @media (max-width: 1024px){

                .img-responsive{
                    height:300px;
                    margin-top:5%;
                    margin-left : 30%;
                }
                h2 {
                    font-size:32px;
                    text-align:center;
                    margin:0px;
                    padding-left:0%;
                    text-align:center;
                }
                h4 {
                    font-size:24px;                
                    text-align:center;
                    margin:0px;
                    padding-left:0%;
                    text-align:center;
                }
                span{
                    font-size: 18px;
                }
            }
            @media (max-width: 760px){

                .img-responsive{
                    height:300px;
                    margin-top:5%;
                    margin-left : 30%;
                }
                h2 {
                    font-size:36px;
                    margin:0px;
                    padding-left:0%;
                    text-align:center;
                }
                h4 {
                    font-size:24px;                
                    margin:0px;
                    padding-left:0%;
                    text-align:center;
                }
                span{
                    font-size: 18px;
                }
            }
            @media (max-width: 640px){

                .img-responsive{
                    height:300px;
                    margin-top:5%;
                    margin-left : 30%;


                }
                h2 {
                    font-size:36px;
                    margin:0px;
                    padding-left:0%;
                    text-align:center;
                }
                h4 {
                    font-size:24px;                
                    margin:0px;
                    padding-left:0%;
                    text-align:center;
                }
                span{
                    font-size: 24px;
                }
            }
            @media (max-width: 480px){

                .img-responsive{
                    height:200px;
                    margin-top:5%;
                    margin-left : 10%;
                }
                h2 {
                    font-size:24px;
                    margin:0px;
                    padding-left:0%;
                    text-align:center;
                }
                h4 {
                    font-size:18px;                
                    margin:0px;
                    padding-left:0%;
                    text-align:center;
                }
                span{
                    font-size: 18px;
                }
            }
        </style>

    </head>
    <body >
        <div class="wrap">

            <div class="text-center">
       <!--style="background-image: url('images/home_sample5.jpg')"<p style="font-size: 40%;">Knowledge is true opinion.<br>Know By quantitative analysis of stock market data</p>      
       <img src="BlissTree.jpg" alt="Bliss Image" width="120" height="150"><br>-->  
                <div id="myCarousel" class="carousel slide " data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides-->
                    <div class="carousel-inner " >
                        <div class="item active">                          


                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <img class="img-responsive" src="images/bliss_tree_transpraent.gif">
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12  col-xs-12">
                                <h2>Analytics is knowledge is power.</h2>
                                <h4>
                                    <a href="index.php"> BlissQuants </a> analyzes financial data.
                                </h4>
                            </div>


                        </div>


                        <div class="item" >

                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <img class="img-responsive" src="images/bliss_tree_transpraent.gif" >

                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" >
                                <h2>Without data, you’re just another person with an opinion.</h2>
                                <h4>
                                    <span><a href="BlissData.php">  BlissQuants data  </a></span> provides information and data.
                                </h4>
                            </div>


                        </div>
                        <div class="item">


                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <img class="img-responsive" src="images/bliss_tree_transpraent.gif" >

                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                <h2>Data is the new science. </h2>
                                <h4>
                                    <span><a href="Solutions.php"> BlissQuants products </a></span> are scientific approach to find the solution. </h4>
                            </div>


                        </div>
                        <div class="item">

                            <div class="col-lg-3 col-md-3  col-sm-12 col-xs-12">
                                <img class="img-responsive" src="images/bliss_tree_transpraent.gif" >
                            </div>
                            <div class="col-lg-9 col-md-9  col-sm-12 col-xs-12">
                                <h2>Only data is meaningless, unless you apply it.  </h2>
                                <h4>
                                    <span><a href="Solutions.php">   BlissQuants Solutions </a></span>  provide systems and processes to trade confidently. </h4>
                            </div>


                        </div>


                    </div>

                    <!-- Left and right controls 
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>-->
                </div>
            </div>


        </div>



    </body>
</html>
<?php
include("html/footer.html");
?>  