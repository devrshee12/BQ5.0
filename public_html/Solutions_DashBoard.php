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


        <script>
            $(document).ready(function () {
                $('video').bind('contextmenu', function () {
                    return false;
                });
                $('body').bind('contextmenu', function () {
                    return false;
                });
            });
        </script>
    </head>
    <body>
        <div class="jumbotron">
            <div class="row">
                <div class="col-lg-4  ">

                    <div class="title_all" id="hitorical">
                        <h3>Mastering Option Delta Hedging : Training by BlissQuants</h3>
                    </div>
                    <div >

                        <!-- <video width="100%" height="456" controls controlsList="nodownload">
<source src="video/BlissQuants_DeltaTrainingV11Final.mp4" type="video/mp4">
</video>-->
                        <iframe width="100%" height="456" src="https://www.youtube.com/embed/2uisEehzmhg?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                        <form action="BlissAboutUs.php#collapseFive" method="post">

                            <input class=" btn-lg btn-block text-center "  type="submit" name="training_button" value="Training Inquiry">
                        </form>

                    </div>

                </div>


                <div class="col-lg-4  ">

                    <div class="title_all" id="hitorical">
                        <h3>Option IV Analytics: Software Products by BlissQuants</h3>
                    </div>
                    <div >

                        <!-- <video width="100%" height="456" controls controlsList="nodownload">
<source src="video/BlissQuants_DeltaTrainingV11Final.mp4" type="video/mp4">
</video>-->
                        <iframe width="100%" height="456" src="https://www.youtube.com/embed/DDL3GAxLtMg?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                        <form action="BlissAboutUs.php#collapseFive" method="post">

                            <a href='#' data-toggle='modal' data-target='#Register-modal'><input class=' btn-lg btn-block text-center'  value='Request a Demo'></a>  
                        </form>

                    </div>

                </div>

                <div class="col-lg-4 ">

                    <div class="title_all" id="hitorical">
                        <h3>BlissQuants Option Data Analytics Company </h3>
                    </div>
                    <div class="box-body">
                        <iframe width="100%" height="456" src="https://www.youtube.com/embed/VaEQ6SDCHl0?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                        <a href='#' data-toggle='modal' data-target='#Register-modal'><input class=' btn-lg btn-block text-center'  value='Request a Demo'></a>  

                    </div>

                </div>


            </div>
        </div>
    </body>