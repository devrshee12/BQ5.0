<!DOCTYPE html>


<!------ Include the above in your HEAD tag ---------->


<!-- /Services section -->    
<?php
/* if(isset($_SERVER['HTTP_REFERER']))
  {
  $last = $_SERVER['HTTP_REFERER'];
  } */
//error_reporting(0);
//include("session_check.php");     
include("header.php");
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title> BlissQuants - Delta Hedging | About </title>     
        <script>
            $(document).ready(function () {
                $(".tutor").on("click", function () {
                    //  alert("fvz");
                    $("#Tutor").modal();

                });
            });

        </script>
        <style>
            /**********************
            /***** Services *******
            /*********************/
            .text-muted{
                padding:15px 0px; 
            }
            section{
                padding: 10px 0;
            }
            section .section-title{
                text-align:center;
                color: rgb(132,194,37);;
                margin-bottom:5px;
                text-transform:uppercase;
            }
            #what-we-do{
                /*background:#ffffff;*/
            }
            #what-we-do .card{
                padding: 1rem!important;
                border: none;
                margin-bottom:0rem;
                background-color: transparent;
                -webkit-transition: .5s all ease;
                -moz-transition: .5s all ease;
                transition: .5s all ease;
            }
            #what-we-do .card:hover{
                -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
                -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
                box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
            }
            #what-we-do .card .card-block{
                padding-left: 50px;
                position: relative;
                font-size: 15px;
            }
            #what-we-do .card .card-block a{
                /*color: #007b5e !important;*/
                color:  white;;
                font-weight:700;
                text-decoration:none;
            }
            #what-we-do .card .card-block a i{
                display:none;
            }
            #what-we-do .card:hover .card-block a i{
                display:inline-block;
                font-weight:700;
            }
            #what-we-do .card .card-block:before{
                font-family: FontAwesome;
                position: absolute;
                font-size: 39px;
                color:  rgb(132,194,37);;
                left: 0;
                -webkit-transition: -webkit-transform .2s ease-in-out;
                transition:transform .2s ease-in-out;
            }
            #what-we-do .card .block-1:before{

                content: "\f02d";
            }
            #what-we-do .card .block-2:before{

                content: "\f085";
            }
            #what-we-do .card .block-3:before{

                content: "\f043";
            }
            #what-we-do .card .block-4:before{

                content: "\f1c3";
            }
            #what-we-do .card .block-5:before{

                content: "\f080";
            }
            #what-we-do .card .block-6:before{

                content: "\f1c3";
            }
            #what-we-do .card .block-7:before{

                content: "\f19d";
            }
            #what-we-do .card .block-8:before{
                content: "\f095";
            }
            #what-we-do .card .block-9:before{
                content: "\f02d";
            }

            #what-we-do .card:hover .card-block:before{
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

            /*  .carousel-control{
                  width:10%;
              }*/
            /* .carousel-inner > .item > img,
             .carousel-inner > .item > a > img {
                 width: 100%;
                 height: 100%;
               
             }*/

            .carousel-inner{
                height:260px;
            }

            h2 {
                margin-top: 1%;
                margin-right: 5%;
                color:#FFF;
                text-align:right;
                position:relative;
                font-size:36px;
                padding:0px;
                height:100px;
                font-family: 'Josefin Sans';
                font-style: normal;
                font-weight: 400;
                padding-left:30%;
            }
            h4 {
                margin: 1% 5%;
                color:#FFF;
                text-align:right;
                position:relative;
                font-size:36px;
                padding:0px;
                font-family: 'Josefin Sans';
                font-style: normal;
                padding-left:15%;
            }


            li {
                font-size: 12px;
            }




            .img-responsive{
                margin-top:1%;
                height:80%;
                width:80%;
            }
            p{
                font-size: 14px;
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

            .modal-body{
                color: #000;
                font-size: 14px;
            }
            .modal-body  ul {
                list-style: none;
                padding: 0;
            }
            .modal-body li {
                padding-left: 1.3em;
                line-height: 20px;
                font-weight: bold;

                font-size: 16px;

            }
            .modal-body li:before {
                content: "\f00c"; /* FontAwesome Unicode */
                font-family: FontAwesome;
                display: inline-block;
                margin-left: -1.3em; /* same as padding-left set on li */
                width: 1.3em; /* same as padding-left set on li */
            }
            ol {
                counter-reset: item;
            }

            ol > li {
                counter-increment: item;
            }

            ol ol > li {
                display: block;
            }

            ol ol > li:before {
                content: counters(item, ".") ". ";
                margin-left: -20px;
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
                /*    width: 100%;
                    height:auto;*/
            }
            .modal-header, .modal-footer{
                background-color: rgb(58,53,49);
                height: 60px;
            }

            .modal-header img{
                height : 20%;
                width: 20%;
            }
            .close{
                color:white;
            }

            .modal-header{
                text-align:center;

            }
            .modal-body{
                text-align: left;

                max-height: calc(80vh - 50px);
                overflow-y: auto;


            }
            .panel-heading{
                font-size: 22px;

            }
            #myModal1{
                top:5%;
            }
            #myModal2{
                top:5%;
            }
            #myModal3{
                top:5%;
            }
            /*#myCarousel{
                background-color:rgba(255,255,255,1);
            }*/
        </style>



    </head>

    <body>       
        <div class="modal fade" id="Tutor" role="dialog">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <img src="blissquant2.jpg" style="height:40px;width:auto;" alt="Bliss Image" >
                    </div>
                    <div class="modal-body ">

                        <div class="panel-heading title_all text-center">  Tutors' profiles  </div>     

                        <div class="row  col-lg-offset-1">       
                            <div class="row">       
                                <div class="col-lg-11" >
                                    <h3 class="panel-heading"> Falguni Vahora  </h3>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" >
                                    <h5>
                                        <ul>	
                                            <li>Co-founder and Data Analytics Head, BlissQuants
                                            <li>BE EC, 20 years of professional experience   </li>
                                            <li>Software development, trading and teaching experience </li>
                                            <li>Certified Equity derivative trader and Research Analyst  </li>
                                            <li>Option IV Analytics and Delta hedging techniques expert </li>

                                        </ul>	
                                    </h5 >
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <img class="img-responsive" src="images/T_samir.jpg" >

                                </div>


                            </div>
                            <div class="row">       


                                <div class="col-lg-11" >
                                    <h3 class="panel-heading">Rupak Shah  </h3>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                                    <img class="img-responsive" src="images/T_rupak.jpg" >

                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" >
                                    <h5>
                                        <ul>		
                                            <li>Co-founder and Delta hedging Head, BlissQuants  </li>
                                            <li>15 years of option trading experience   </li>
                                            <li>Certified equity derivative trader  </li>
                                            <li>Option Short Gamma and IV Skew expert   </li>
                                            <li>Index Long Gamma expert   </li>
                                        </ul>	

                                    </h5    >
                                </div>


                            </div>

                            <div class="row">       

                                <div class="col-lg-11" >

                                    <h3 class="panel-heading"> Samir Vahora</h3>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" >
                                    <h5>
                                        <ul>	
                                            <li>Technical Adviser, BlissQuants </li>
                                            <li>BE EC + MBA finance, 23 years of professional experience  </li>
                                            <li>Technical architect in Software development  </li>
                                            <li>Certified CMT level I and II  in technical trading and Equity derivative trader</li>
                                            <li>Expert in Elliot wave chart pattern trading  </li>

                                        </ul>	
                                    </h5    >
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                                    <img class="img-responsive" src="images/T_falguni.jpg" >

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

<!--style="background-image: url('images/home_sample5.jpg')"<p style="font-size: 40%;">Knowledge is true opinion.<br>Know By quantitative analysis of stock market data</p>      
<img src="BlissTree.jpg" alt="Bliss Image" width="120" height="150"><br>-->  
        <div id="myCarousel" class="carousel slide " data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>

            </ol>

            <!-- Wrapper for slides-->
            <div class="carousel-inner " >
                <div class="item active">                          


                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
                        <img class="img-responsive" src="images/bliss_tree_transpraent.gif" >

                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                        <h2>We respect an ancient way of <a href="BlissData.php">the guru–shishya tradition.   </h2>

                        <h4>
                            .  .  .  And an ancient is a new modern.
                        </h4>
                    </div>


                </div>


                <div class="item" >

                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <img class="img-responsive"  src="images/bliss_tree_transpraent.gif" >

                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                        <h2>Learn with BlissQuants online live teaching classes.

                        </h2>
                        <h4>
                            We follow  <a href="Solutions.php">teacher-student tradition online</a>  in the modern world.
                        </h4>
                    </div>


                </div>
                <div class="item">


                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <img class="img-responsive" src="images/bliss_tree_transpraent.gif" >

                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <h2>No matter where you are, turn any room into your classroom.

                        </h2>
                        <h4>
                            <span> .  .  . Becasue <a href="Solutions.php">live teaching </a></span> is the best way of learning. </h4>
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




        <section id="what-we-do" class="wrap">
            <?php
            if (isset($_SESSION['error'])) {
                echo "
            <div class='alert alert-danger alert-dismissible  col-lg-8 col-lg-offset-2 text-center' style='background-color:#84c225;'>
            
              <h4 style='color:#F00;'><i class='icon fa fa-warning'></i> " . $_SESSION['error'] . "</h4>
              
            </div>
          ";
                unset($_SESSION['error']);
            }
            ?>
            <div class="container-fluid">




                <!--  <div class='row' style="font-size: 24px; color:white; background-color: rgb(58,53,49)">
  
                      <div class=' col-lg-12 col-md-12 col-sm-12' >
                          <marquee id='scroll_news'  onmouseout="document.getElementById('scroll_news').start();" onmouseover="document.getElementById('scroll_news').stop();"  >
                              <div  >
                                ****  One on one teaching - Class room or face-to- face via video connect. ****
                                  Each  session 30 minutes - 20 min theory & practical + 10 min Q/A. ****
                                  BlissQuants Certification on completion of course. ****
  
                              </div>
                          </marquee>
                      </div>
  
  
                  </div>-->

                <div class="row ">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-1">
                                
                                <h3 class="card-title">Getting Started in Stocks </h3>
                                This course is specially designed for those who wish to kickstart their entry in the stock market. Stock Market Basic course simplifies understanding of Equities, Currency, Derivatives and all types of trading markets. It dwells into different types of investing and trading styles. It deeply explains the impact of economic events, national policies on the stock market. It's created to give live trading experience to the learner with profit loss and ledger report. This course is the first step towards making a stock market as a career a parttime or a fulltime. 
<br><br>We deliver through One on one teaching method which covers numerous real stock data related sums for practice. Each session is designed for 45 minutes which includes 30 minutes Theory and Practical session and 15 minutes for QA. On completion of the course, an exam will be taken and BlissQuants Certification will be given.
<br><br>
                                <li>Concepts of Equity, Derivatives, and types of market</li>
                                <li>Types of trading - Fundamental, Technical and Mathematical trading</li>
                                <li>Event impact - News, Economic events, Monetary policy, Data etc</li>
                                <li>Trading elemental - Risk /Reward calculations, portfolio diversification.</li>
                                <li>Eq Buy Sell experience, Live trading experience </li> 
                                <li>Back office management, PNL report, margin report  </li> 
                                
                                <li> One on One teaching - BlissQuants Certification on course completion</li> 


                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-2">

                                <h3 class="card-title">Delve into Derivatives </h3>
This course is specially designed for those who wish to enter into the world of derivatives. It covers the basic concept of Future and options. Option pricing reality and Option Greeks are covered in details. Straddle, Strangle, spreads and Butterfly option strategies are focused in this course. All strategies are explained with live data and numerous sums are covered through live positions in the stock market. Imperative aspects of options i.e. Margin, expense, expiry, and interest calculation topics will be explained with real data. 
This course is the first step towards making derivative trading as a career- a part-time or a fulltime.<br><br> We deliver through One on one teaching method which covers numerous real derivatives data sums to practice. Each session is designed for 45 minutes which includes 30 minutes Theory & Practical session and 15 minutes for Q/A. On completion of the course, an exam will be taken and BlissQuants Certification will be given.
<br><br>
                                <ul>
                                    <li>Option pricing, Option Greeks, Option spread</li>
                                    <li>Butterfly, Straddle, Strangle, IV skew</li>
                                    <li>Caller, covered call, Protective put, Synthetic Options</li>
                                    <li>Margin, expense and interest calculation.</li>
                                    <li>Live position experience  </li> 
                                 
                                    <li> One on One teaching - BlissQuants Certification on course completion</li> 

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-3">
                                <h3 class="card-title">Mastering Option Delta Hedging</h3> 
                                This course is the first step towards making Option delta trading as a full-time career. Option pricing reality and Option Greeks are covered in details with respect to market volatility. Synthetic hedging methods of short gamma and long gamma will be explained in details with live trading experience.  The real-time impact of Implied Volatility - IV will be covered All strategies are explained with live data and numerous sums are covered through live positions in the stock market. Imperative aspects of options i.e. Margin, expense, expiry, and interest calculation topics will be explained with real data.   
<br><br>We deliver through One on one teaching method which covers numerous real derivatives data related sums to practice. Each session is designed for 45 minutes which includes 30 minutes Theory & Practical session and 15 minutes for Q/A. On completion of the course, an exam will be taken and BlissQuants Certification will be given.

<br><br>
                                <ul>
                                    <li>Option pricing, Option Greeks, IV Analytics and IV projection</li>
                                    <li>Short Gamma method, Long Gamma method, Strike shifting insights</li>
                                    <li>Delta neutral management </li>
                                    <li>Margin, expense and interest calculation  .</li>
                                    <li>Live position experience  </li> 
                                 
                                    <li> One on One teaching - BlissQuants Certification on course completion</li> 

                                </ul>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            <!--    <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-7">
                                <h3 class="card-title">Advanced Option Hedging Strategies. </h3> 

                                <ul>
                                    <li>Delta neutral management techniques </li>   
                                    <li>IV Skew Game –All  strategies in details  </li>
                                    <li>	Vega game  - All strategies in details </li>
                                    <li>	Theta game  -All strategies in details </li>
                                    <li>	Gamma methods for volatile events </li>
                                    <li>	Strike shifting insights </li>
                                    <li>	Live position experience   </li>
                                    <li> 12 sessions for ₹50,000/ $725   </li>
                                    <li> 45 minutes session ( 30 min Theory & Practical + 15 min Q/A )</li>
                                    <li> One on One teaching - BlissQuants Certification on course completion</li> 

                                </ul>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-5">
                                <h3 class="card-title">Insights of Stock-trading Strategies using Technical Analysis</h3>

                                <ul>
                                    <li>Elliot wave trading</li>
                                    <li>Moving average trading</li>
                                    <li>Chart pattern trading</li>
                                    <li>Money management</li>
                                    <li>Risk/Reward analysis  </li>
                                    <li>CMT exam preparation guidance </li>
                                    <li> 15 sessions for ₹50,000/ $725  </li>
                                    <li> 45 minutes session ( 30 min Theory & Practical + 15 min Q/A )</li>
                                    <li> One on One teaching - BlissQuants Certification on course completion</li> 



                                </ul>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-4">
                                <h3 class="card-title">Excel in stock Analytics with Excel/ VBA Programming </h3> 
                                <ul>
                                    <li>Basics of back testing</li>
                                    <li>Historical data management </li>
                                    <li>Close price and OHLC analysis</li>
                                    <li>Macro definition and setup</li> 
                                    <li>CAGR,CALMAR, Profit Loss calculations </li>
                                    <li>Chart creation  </li>
                                    <li>Risk/Reward analysis                            </li>
                                    <li> 9 sessions for ₹15,000/ $225  </li>
                                    <li> 45 minutes session ( 30 min Theory & Practical + 15 min Q/A )</li>
                                    <li> One on One teaching - BlissQuants Certification on course completion</li> 

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>-->
                <br><br>
                <div class="row">

                    <div class="col-lg-4 col-md-4 col-sm-6 col-lg-offset-2">
                        <a href="#" data-toggle="modal" data-target="Tutor" class="tutor"><input class=' btn-lg btn-block text-center'  value='Tutors profiles'></a>
                    </div>
                    <!-- <div class="col-lg-3 col-md-3 col-sm-6">
                         <a href='BlissAboutUs.php#collapseFive'><input class=' btn-lg btn-block text-center'  value='Contact Us'></a>
                     </div>-->
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href='index_bolt.php'><input class=' btn-lg btn-block text-center'  value='Pay Now'></a>
                    </div>
                </div>


        </section>


        <!-- <div class="row footer_header ">    
 
             <div class="col-lg-8 col-md-8 col-sm-8">
                 <div class="col-lg-6 col-md-6 col-sm-6">
                     <div class="navbar-text" >
                         INDIA Contact : +91 9824001268 <br>
                         US Contact : +1 (617) 530-0222
                     </div>
                 </div>
                 <div class="col-lg-6 col-md-6 col-sm-6">
                   
                 </div>
             </div>     
             <div class="col-lg-4 col-md-4 col-sm-4">
 
                 <ul class="social-network social-circle pull-right">
                     <li style="display: inline"> Follow us :</li>
                     <li style="display: inline"><a href="https://www.facebook.com/blissquants" target="_blank" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                     <li style="display: inline"><a href="https://plus.google.com/u/0/104418184884371093173" target="_blank" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                     <li style="display: inline"><a href="https://www.linkedin.com/company/10313538" target="_blank" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                 </ul>	
             </div>
 
 
 
 
         </div>-->
        <?php

        function getCallbackUrl() {
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response.php';
        }

        include("html/footer.html");
        ?>
    </body>
</html>

