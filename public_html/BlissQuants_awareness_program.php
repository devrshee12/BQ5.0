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
            *{
                padding:0;
                margin:0;
                -webkit-transition: 1s;
                transition: 1s;
            }
            .clrd-font{
                /* background: #FF512F;
                background: -webkit-linear-gradient(to right, #F09819, #FF512F);
                 background: linear-gradient(to right, #F09819, #FF512F);
                 -webkit-background-clip: text;
                 -webkit-text-fill-color: transparent;*/
              
            }
            .btn-primary {
                background-color:transparent;
                color: #fff;
                border: 2px solid #fff;
                font-size:20px;
                text-transform: uppercase;
                border-radius: 0px;	
            }
            .btn-primary:hover {
                background-color:transparent;
                border-color: #84C225;
                color: #84C225;
                border-radius: 20px;
            }

            .single_portfolio_text{
                display:inline-block;
                padding:0;
                position:relative;
                overflow: hidden;
                border:10px solid transparent;
                height: 350px;
                text-align:center;

            }
            .single_portfolio_text img{
                width:auto; 
                height: 300px;

            }
            .single_portfolio_text  img:hover
            {
                transition:all 0.6s; /* Change Speed */
                -ms-transform: scale(2, 2); /* IE 9 */
                -webkit-transform: scale(2, 2); /* Safari */
                transform: scale(2, 2); /* Change Size */
                overflow:auto;
                z-index:1!important; /* you can change it, but better let this in default */
                width:auto; 
                height: 300px;
                border : 3px black solid;
            }
            .single_portfolio_text:hover{
                overflow: visible;        
                z-index:2
            }
            .single_portfolio_text:hover .portfolio_images_overlay{
                top:5%;
                left: 5%;
            }

            .portfolio_images_overlay{
                width: 90%;
                height: 90%;
                background: rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin: 0 auto;
                margin-top : 7%;
                top: -100%;
                left: 5%;
                position: absolute;
                transition:.6s;

            }


            .portfolio_images_overlay .product_price{
                font-size: 25px;
                color: #84C225;
                margin-top: 40%;
                line-height:30px;
            }
            .portfolio_images_overlay .product_price i{
                margin-right: -10px;
            }
            .zoom{
                width: 180px;
                height: 180px;
                position: absolute;
                bottom: -100px;
                right: -100px;
                border-radius: 50%;

                background: #84C225;
                background: -webkit-linear-gradient(to right, #F09819, #84C225);
                background: linear-gradient(to right, #cde6a7, #4f7416);
                box-shadow:0px 0px 0px 10px rgba(0,0,0,0.5);
                opacity:0.9;
            }
            .zoom:before {
                content: "\f00e";
                font-family: FontAwesome;
                color: rgba(255, 255, 255, 0.5);
                font-size: 50px;
                padding-right: 20px;
                position: absolute;
                top: 10px;
                left: 30px;
            }
            @media (min-width:769px) and (max-width:991px) {
                .portfolio_images_overlay {
                    padding: 0px;
                }
            }
            @media (max-width:768px) {
                .portfolio_images_overlay{
                    padding: 170px 20px;
                }
            }
            @media (max-width:580px) {
                .portfolio_images_overlay{
                    padding: 100px 20px;
                }
            }
            @media (max-width:480px) {
                .portfolio_images_overlay{
                    padding: 40px 20px;
                }
            }
            @media (max-width:320px) {
                .portfolio_images_overlay{
                    padding: 20px;
                }
            }
            h6{

                color: #84C225;
                font-size: 15px;

                border: 2px solid #fff;
                padding-top: 10px;
                padding-bottom: 10px;
            }
         
        </style>
<style>
           
             .card{
                padding: 1rem!important;
                border: none;
                margin-bottom:0rem;
                background-color: transparent;
                -webkit-transition: .5s all ease;
                -moz-transition: .5s all ease;
                transition: .5s all ease;
                text-align: left;
            }
             .card:hover{
                -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
                -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
                box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
            }
             .card .card-block{
                padding-left: 50px;
                position: relative;
                font-size: 12px;
            }
             .card .card-block a{
                /*color: #007b5e !important;*/
                color:  white;;
                font-weight:700;
                text-decoration:none;
            }
             .card .card-block a i{
                display:none;
            }
             .card:hover .card-block a i{
                display:inline-block;
                font-weight:700;
            }
             .card .card-block:before{
                font-family: FontAwesome;
                position: absolute;
                font-size: 39px;
                color:  rgb(132,194,37);;
                left: 0;
                -webkit-transition: -webkit-transform .2s ease-in-out;
                transition:transform .2s ease-in-out;
            }
             .card .block-1:before{
                /*   content: "\f0e7";*/
                content: "\f19c";
            }
             .card .block-2:before{
                content: "\f24e";
            }
             .card .block-3:before{
                content: "\f0ee";
            }
             .card .block-4:before{
                content: "\f209";
            }
             .card .block-5:before{
                content: "\f0a1";
            }
             .card .block-6:before{
                content: "\f218";
            }
             .card .block-7:before{
                content: "\f0e7";
            }
             .card .block-8:before{
                content: "\f095";
            }
             .card .block-9:before{
                content: "\f02d";
            }
             .card:hover .card-block:before{
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg); 
                -webkit-transition: .5s all ease;
                -moz-transition: .5s all ease;
                transition: .5s all ease;
            } 
            .card{
                height: 100%;

            }
            .card-text{
                color: #FFF;
                font-size: 12px;
            }  
            .card-title{
                color:  rgb(132,194,37);;
            }  
            .link{
                color:  rgb(255,255,255);
                font-weight: normal!important;
            }
            .modal-body{
                color: #000;
                font-size: 28px!important;
                font-family: 'Open Sans';
            }
        </style>
    </head>
    <body>

        <div class="row">
            <div class="title_all" id="hitorical">
                <h3>BlissQuants Awareness Programs </h3>
                 <div class="row ">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-block block-1">
                                <h3 class="card-title">Enrich Your FQ - Financial Quotient</h3>
                               <p class="card-text"> As a part of Enrich your FQ program, we are spreading awareness about the basics of finance and the concept of earnings. It’s imperative for everyone to understand money- matters because simply money matters. We are very passionate to share our knowledge towards finance related matters in a much simple manner.</p>
                                In this 2 hour - awareness program, we will share our ideas and learnings of Financial fundamentals and various ways of earning passive income which will help each one of us to create a wealth which grows even if we are not working!
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-block block-2">
                                <h3 class="card-title">Knowing Option Greeks - Derivatives   </h3>
                                <p class="card-text">As a part of Knowing Option Greeks – Derivatives program, we are talking to finance students, finance interested folks, brokerage houses etc and spreading awareness about the kind of Option Greeks trading and hedging work we are doing in our company. We are very passionate to share our knowledge towards how to build and apply the pure mathematical skill in options hedging trading.   </p>
                               In this 2 hour - awareness program, we will share our niche area knowledge of Option Greeks, Option strategies and Option delta hedging including long and short gamma delta methods. We share our Knowledge of Implied Volatility movement which will help option traders to improve their strategies and minimized the unlimited risk which could result due to option writing!
                        </div>
                    </div>
            </div>
                <br>
                <div class="col-md-4 col-sm-4 col-xs-12 col-lg-offset-4">
                    <a href='#' data-toggle='modal' data-target='#invite-modal'><input class=' btn-lg btn-block text-center'  value='Invite us to speak '></a> 
                </div>
            </div>
           
            <?php
            if (isset($_SESSION['error'])) {
                echo "
            <div class='alert alert-danger alert-dismissible col-lg-8 col-lg-offset-2' >
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo "
            <div class='alert alert-success alert-dismissible  col-lg-8 col-lg-offset-2 '>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
                unset($_SESSION['success']);
            }
            // echo         $_SESSION['success'];
            ?>
            <div class="container-fluid">

                <div class="row jumbotron">

                    <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">Maliba MBA College, Bardoli, Gujarat</h6>
                        <img src="BQ_Branding/im4.jpg" alt="" />




                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">Dr D Y Patil MBA college, Pune, Maharashtra </h6>
                        <img src="BQ_Branding/im8.jpg" alt="" />



                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">S. R. Luthra Institute of Management, Surat, Gujarat </h6>
                        <img src="BQ_Branding/im10.jpg" alt="" />





                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">Jainam Share consultant pvt ltd. Surat, Gujarat</h6>
                        <img src="BQ_Branding/im50.jpg" alt="" />




                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">D Y PATIL College Of Engineering, Pune, Maharashtra </h6>
                        <img src="BQ_Branding/im3.jpg" alt="" />





                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">DIMR MBA college, Pune,Maharashtra </h6>
                        <img src="BQ_Branding/im6.jpg" alt="" />





                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">BlissQuants Data Analytics, Surat, Gujarat</h6>
                        <img src="BQ_Branding/im9.jpg" alt="" />




                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">BlissQuants Data Analytics, Surat, Gujarat</h6>
                        <img src="BQ_Branding/im11.jpg" alt="" />

                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">Dr D Y Patil MBA college, Pune, Maharashtra </h6>
                        <img src="BQ_Branding/im13.jpg" alt="" />


                    </div><div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">BlissQuants Data Analytics, Surat, Gujarat</h6>
                        <img src="BQ_Branding/im14.jpg" alt="" />

                    </div><div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">Maliba MBA College, Bardoli, Gujarat</h6>
                        <img src="BQ_Branding/im15.jpg" alt="" />

                    </div><div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">S. R. Luthra Institute of Management, Surat, Gujarat</h6>
                        <img src="BQ_Branding/im17.jpg" alt="" />

                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">Avadh Utopia Surat, Gujarat</h6>
                        <img src="BQ_Branding/im16.jpg" alt="" />

                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">Sarvajanik College of Engineering and Technology, Surat, Gujarat</h6>
                        <img src="BQ_Branding/im18.jpg" alt="" />


                    </div><div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">DIMR MBA college, Pune,Maharashtra </h6>
                        <img src="BQ_Branding/im23.jpg" alt="" />



                    </div><div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                        <h6 class="clrd-font">DIMR MBA college, Pune, Maharashtra</h6>
                        <img src="BQ_Branding/im20.jpeg" alt="" />


                    </div>

                </div>

                <br> <br>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
            <script src="js/script.js"></script>




        </div>

    </body>