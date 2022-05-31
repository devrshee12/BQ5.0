<!DOCTYPE html>


<!------ Include the above in your HEAD tag ---------->


<!-- /Services section -->    
<?php
    
include("header.php");
?>
<html>
    <head>

        <title> BlissQuants - Delta Hedging | About </title>     

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
                font-size: 12px;
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
                /*   content: "\f0e7";*/
                content: "\f20e";
            }
            #what-we-do .card .block-2:before{
                content: "\f0eb";
            }
            #what-we-do .card .block-3:before{
                content: "\f0ee";
            }
            #what-we-do .card .block-4:before{
                content: "\f209";
            }
            #what-we-do .card .block-5:before{
                content: "\f0a1";
            }
            #what-we-do .card .block-6:before{
                content: "\f218";
            }
            #what-we-do .card .block-7:before{
                content: "\f0e7";
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
                height: 20rem;

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
        <!-- Services section -->
        <section id="what-we-do" class="wrap">
            <div class="container-fluid">
                <h3 class="section-title h3">What we do</h3>
<!--
                <div class="row ">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-1">
                                <h3 class="card-title">Software Development & Testing</h3>
                                <p class="card-text"> Being a solution provider in this domain for many years, we have the right mix of expert talent to design, develop & test software product & provide maintenance.</p>
                                <ul>
                                    <li>CMS Product Design & Development Services</li>
                                    <li>Clean code & APIs</li>
                                    <li>Performance, load, unit, integration & stress testing</li>
                                </ul>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-2">
                                <h3 class="card-title">Website Design & Development </h3>
                                <p class="card-text"> Our team of web designers concept & design our award-winning, all-in-one templates. 
                                    They craft every details so that our templates set the industry standard.
                                </p>
                                <ul>
                                    <li>Custom Website Design & Application Development</li>
                                    <li>Responsive Web Design</li>
                                    <li>Multi-browser compatibility</li>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-3">
                                <h3 class="card-title">Database Design & maintenance</h3>
                                <p class="card-text">
                                    Go for top-notch security &amp; data protection in your software product.
                                </p>
                                <ul>
                                    <li>Logically design/restructure databases</li>
                                    <li>Creatively generate reports with data</li>
                                    <li>Discover data patterns through data analysis</li>
                                </ul>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-7">
                                <h3 class="card-title">UX/UI Design</h3>
                                <p class="card-text">Great frontend/UI application is an integral part of the software we create.
                                </p>
                                <ul>
                                    <li>User Interface design & application development</li>
                                    <li>Frontend design & re-writing website with latest framework</li>
                                    <li>UX design with UML MODELING</li>
                                </ul>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-5">
                                <h3 class="card-title">Articulate your ideas</h3>
                                <p class="card-text">
                                    The information must be detailed written in a format to easily read & understandable for targeted audience.We have engineers to articulate your ideas.
                                </p>
                                <ul>
                                    <li>Technical writing :  Preserve the knowledge for business.
                                    </li>
                                    <li>Content Writing:  Web content writer specialization.</li>
                                    <li>Blog writing : Great story tellers for blogging .</li>
                                </ul>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <a  href="Solutions.php" class="link" >
                                <div class="card-block block-8">
                                    <h3 class="card-title">Our products & Projects</h3>
                                    Bliss products & platforms enable transformation solutions, banking solutions & unified communication collaboration solutions. 

                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">

                        <div class="card">
                            <a href="Solutions_training.php" class="link">
                                <div class="card-block block-9">

                                    <h3 class="card-title">Option Delta Coaching</h3>
                                    <p class="card-text"> Delta Hedging is a scientific way of making consistent profit in the stock market. <br>

                                        Interested in joining as Delta hedger or learning option Delta hedging techniques? <a href="BlissAboutUs.php#collapseFive" class="link" style="color:rgb(132,194,37)">Contact us </a>
                                    </p>

                                </div>
                            </a> 
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <a href="BlissAboutUs.php#collapseFive" class="link" style="color:rgb(132,194,37)">
                                <div class="card-block block-8">
                                    <h3 class="card-title">Single point of contact
                                    </h3>
                                    <p class="card-text"> Never-ending support. Client support is available 24/7/365 by phone & email With supporting text below as a natural lead-in to additional content.</p>
                                </div>
                            </a> 
                        </div>
                    </div>
                </div>-->
                <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">

                        <div class="card">
                            <div class="card-block block-4">
                                <h3 class="card-title">Financial Utilities & Data Analytics </h3>
                                <p class="card-text">Our Project specialists focus on Financial utility development & customization. We provide option Delta hedging analysis software. 
                                    Macro data for delta hedgers & Derivates data analysis, quantitative services, & research.
                                </p>
                            </div>
                        </div>

                    </div>
                     <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <a  href="Solutions.php" class="link" >
                                <div class="card-block block-5">
                                    <h3 class="card-title">Our products & Projects</h3>
                                    Bliss products & platforms enable transformation solutions, banking solutions & unified communication collaboration solutions. 

                                </div>
                            </a>
                        </div>
                    </div>
                  
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <a href="BlissAboutUs.php#collapseFive" class="link" style="color:rgb(132,194,37)">
                                <div class="card-block block-8">
                                    <h3 class="card-title">Single point of contact
                                    </h3>
                                    <p class="card-text"> Never-ending support. Client support is available 24/7/365 by phone & email With supporting text below as a natural lead-in to additional content.</p>
                                </div>
                            </a> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <style>

        </style>
        <div class="row footer_header ">    

            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="navbar-text" >
                        INDIA Contact : +91 9898032020 <br>
                        US Contact : +1 (617) 530-0222
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <a href='BlissAboutUs.php#collapseFive'><input class=' btn-lg btn-block text-center'  value='Contact Us'></a>
                </div>
            </div>     
            <div class="col-lg-4 col-md-4 col-sm-4">

                <ul class="social-network social-circle pull-right">
                    <li style="display: inline"> Follow us :</li>
                    <li style="display: inline"><a href="https://www.facebook.com/blissquants" target="_blank" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <!--<li style="display: inline"><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li> -->
                    <li style="display: inline"><a href="https://plus.google.com/u/0/104418184884371093173" target="_blank" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                    <li style="display: inline"><a href="https://www.linkedin.com/company/10313538" target="_blank" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                </ul>	
            </div>




        </div>
        <div id="modal_coach" class="modal fade" role="dialog" >
            <div class="modal-dialog  ">
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <img src="blissquant2.jpg" alt="Bliss Image" >
                    </div>
                    <div class="modal-body">

                        <ul > <li>   BlissTrend: Bliss Trend is the software which will generate daily stop loss and target based on predefined system for successful trend following. </li>    
                            <li>   BlissCalc: Light - weight product to analyze Option strategies and Gamma neutral mechanism. </li>
                            <li>   BlissQuants IV Analytics</li>
                            <li>  BlissQuants IV Dashboard </li> </ul>
                        <br> <br>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal_ux" class="modal fade" role="dialog" >
            <div class="modal-dialog  ">
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <img src="blissquant2.jpg" alt="Bliss Image" >
                    </div>
                    <div class="modal-body">

                        <ul>
                            <li>Concept Analysis & Testing</li><li>UX/UI Design</li><li>Low-to-high Level QA</li>
                        </ul>
                        <br> <br>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
<?php
//include("html/footer.html"); 
if (isset($_POST['request_button'])) {
    echo "<script> set_options(3); </script>";
}
if (isset($_POST['training_button'])) {
    echo "<script> set_options(2); </script>";
}
/* if($last == "http://192.168.119.24/BQ4.0/public_html/Solutions.php" || $last == "http://192.168.119.24/BQ4.0/public_html/header.php" )
  {
  echo "<script> set_options(6); </script>";
  }
  if($last == "http://192.168.119.24/BQ4.0/public_html/Solutions_training.php" )
  {
  echo "<script> set_options(2); </script>";
  } */
?>  
