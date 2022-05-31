<?php
//session_start();
include("header.php");

include("db_connect.php");
if (isset($_SESSION['email'])) {

    $MERCHANT_KEY = "JViVlL3m";
    $SALT = "Orgo3sYE1L";
    $name = $_SESSION['user_id'];
    $email = $_SESSION['email'];
    $product = "coaching";
    if (isset($_SESSION['mobile'])) {

        $mobile = $_SESSION['mobile'];
    } else {
        $mobile = "";
    }
    $price = 0;
    // echo $email;
} else {

    $MERCHANT_KEY = "JViVlL3m";
    $SALT = "Orgo3sYE1L";
    $name = "";
    $email = "";
    $product = "";
    $mobile = "";
    $price = 0;
}

function getCallbackUrl() {
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response.php';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>PayUmoney BOLT PHP7 Kit</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <!-- this meta viewport is required for BOLT //-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >

            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <!-- BOLT Sandbox/test //--
             <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
            color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
              <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
            -->

            <!-- BOLT Production/Live //-->
            <script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
            color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
    </head>
    <style type="text/css">
        .main {
            margin-left:30px;
            font-family:Verdana, Geneva, sans-serif, serif;
        }
        .text {
            float:left;
            width:180px;
        }
        .dv {
            margin-bottom:5px;
        }
        .astext {
            background:none;
            border:none;
            margin:0;
            padding:0;
            cursor: pointer;
            color: rgb(132,194,37);
            font-size : 20px;

        }
        .btn-lg{
            margin-top: 5%;
            width: 100%;
            background-color: rgb(132,194,37)!important;
            color:black;
        }
        .panel-heading{
            background-color: rgb(132,194,37)!important;
            color:black!important;
            text-align: center;
        }
        .panel-body{
            height: 50%;
        }

    </style>
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

            content: "\f02d";
        }
        #what-we-do .card .block-2:before{

            content: "\f085";
        }
        #what-we-do .card .block-3:before{

            content: "\f071";
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
            height: 30rem;

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
        .col-md-6{
            padding-top: 10px ;
        }
        strong{
            margin-bottom:  10px;
        }
        #pro_detail{
            font-size: 15px;
        }
        .pm-button > a{
            color: #000;
            text-align: center;
        }
        .pm-button{
             text-align: center;
        }
        /*#myCarousel{
            background-color:rgba(255,255,255,1);
        }*/
    </style>
    <body>
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
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Payment Checkout</div>
                    <div class="panel-body">

                        <form action="#" id="payment_form">

                            <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
                            <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />


                            <span><input type="hidden" id="key" name="key" placeholder="Merchant Key" value="<?php echo $MERCHANT_KEY; ?>" /></span>

                            <span><input type="hidden" id="salt" name="salt" placeholder="Merchant Salt" value="<?php echo $SALT; ?>" /></span>



                            <span><input type="hidden" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo "Txn" . rand(10000, 99999999); ?>" /></span>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Product:</strong></div>
                                <div class="col-md-12">
                                    <select class="form-control" id="pinfo" onchange="get_price(this.value)" name="pinfo">
                                        <option value="Selectsss" selected>select</option>
                                        <?php
                                        $sql = "SELECT * FROM payment_plan  order by code asc";
                                        $result_scrip = mysqli_query($con, $sql);
                                        $n_scrip = mysqli_num_rows($result_scrip);
//echo $n_scrip;
                                        if ($n_scrip > 0) {

                                            while ($row = mysqli_fetch_array($result_scrip)) {
                                                // $selected = ($crow['id'] == $catid) ? 'selected' : ''; 
                                                echo "
                            <option value='" . $row['name'] . "' >" . $row['name'] . "</option>
                          ";
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>Price:</strong>
                                    <span><input class="form-control" type="text" id="amount" name="amount"  placeholder="Amount" value="<?php echo $price; ?>"  required/></span>    
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>Name:</strong>
                                    <span><input  type="hidden" placeholder="Product Info" value="<?php echo $product; ?>" /></span>

                                    <span><input class="form-control" type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo $name; ?>"  required/></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>Email:</strong>

                                    <span><input class="form-control" type="text" id="email" name="email" placeholder="Email ID" value="<?php echo $email; ?>"  required/></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>Mobile:</strong>

                                    <span><input class="form-control" type="text" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="<?php echo $mobile; ?>" required/></span>
                                </div>
                            </div>


                            <span><input type="hidden" id="hash" name="hash" placeholder="Hash" value="<?php
                                if (isset($json['success'])) {
                                    echo $json['success'];
                                }
                                ?>" /></span>

                            <div></div>
                          <!--- <div><a><input type="submit"  class="btn-lg"  value="Pay Now" onclick="launchBOLT(); return false;" /></a></div>-->
                            <div class="form-group">             
                                <a> <div class="col-md-12 col-xs-12" id="pay_button" ></div></a>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                <!--REVIEW ORDER-->
                <div class="panel panel-info">
                    <div class="panel-heading" >
                        Product Detail <div class="pull-right" >INR <small id="pro_price"></small></div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">

                            <div class="col-sm-12 col-xs-10">
                                <h3 class="col-xs-12" id="pro_name">Product name</h3> <hr>
                                    <div class="col-xs-12" id="pro_detail"><span></span></div>
                            </div>

                        </div>

                    </div>
                </div>
            </div></div>
        <script type="text/javascript">
            function selectItemByValue(elmnt, value) {

                for (var i = 0; i < elmnt.options.length; i++)
                {
                    if (elmnt.options[i].value === value) {
                        // alert(i)
                        elmnt.selectedIndex = i;
                        break;
                    }
                }
            }
            $(document).ready(function () {

            });
            function get_price(product) {
//alert(product);
                $.ajax({
                    type: 'POST',
                    url: 'get_price.php',
                    data: {id: product},
                    dataType: 'json',
                    success: function (response) {

                        document.getElementById('amount').value = Number(response.price);
                        document.getElementById('pro_name').innerHTML = response.name;

                        document.getElementById('pro_price').innerHTML = response.price;
                        document.getElementById('pay_button').innerHTML = response.button;
                        //alert(response.button);
                        /* if(response.code == "P01")
                         {
                         desc = response.description + '<br><br>' +  '<li>Concepts of Equity, Derivatives, and types of market</li>'+
                         '<li>Types of trading - Fundamental, Technical and Mathematical trading</li>' +
                         '<li>Event impact - News, Economic events, Monetary policy, Data etc</li>' +
                         '<li>Trading elemental - Risk /Reward calculations, portfolio diversification.</li>' +
                         '<li>Eq Buy Sell experience, Live trading experience </li>' + 
                         '<li>Back office management, PNL report, margin report  </li>' + 
                         '<li> 6 sessions for ₹10,000/ $160  </li>' +
                         '<li> 45 minutes session ( 30 min Theory & Practical + 15 min Q/A )</li>' +
                         '<li> One on One teaching - BlissQuants Certification on course completion</li>';
                         }
                         else if(response.code == "P02")
                         {
                         desc = response.description +  '<br><br>' +   '<li>Delta neutral management techniques </li>' +   
                         '<li>IV Skew Game –All  strategies in details  </li>' +
                         '<li>	Vega game  - All strategies in details </li>' +
                         '<li>	Theta game  -All strategies in details </li>' +
                         '<li>	Gamma methods for volatile events </li>' +
                         '<li>	Strike shifting insights </li>' +
                         '<li>	Live position experience   </li>' +
                         '<li> 12 sessions for ₹50,000/ $725   </li>' +
                         '<li> 45 minutes session ( 30 min Theory & Practical + 15 min Q/A )</li>' +
                         '<li> One on One teaching - BlissQuants Certification on course completion</li>' ;
                         }
                         else if(response.code == "P03")
                         {
                         desc = response.description +  '<br><br>' +    '<li>Option pricing, Option Greeks, Option spread</li>' +
                         '<li>Butterfly, Straddle, Strangle, IV skew</li>' +
                         '<li>Caller, covered call, Protective put, Synthetic Options</li>' +
                         '<li>Margin, expense and interest calculation.</li>' +
                         '<li>Live position experience  </li>' + 
                         '<li> 9 sessions for ₹15,000/ $225  </li>' +
                         '<li> 45 minutes session ( 30 min Theory & Practical + 15 min Q/A )</li>' +
                         '<li> One on One teaching - BlissQuants Certification on course completion</li>';
                         }
                         else if(response.code == "P04")
                         {
                         desc = response.description +  '<br><br>' +    '<li>Basics of back testing</li>' +
                         '<li>Historical data management </li>' +
                         '<li>Close price and OHLC analysis</li>' +
                         '<li>Macro definition and setup</li>' + 
                         '<li>CAGR,CALMAR, Profit Loss calculations </li>' +
                         '<li>Chart creation  </li>' +
                         '<li>Risk/Reward analysis                            </li>' +
                         '<li> 9 sessions for ₹15,000/ $225  </li>' +
                         '<li> 45 minutes session ( 30 min Theory & Practical + 15 min Q/A )</li>' +
                         '<li> One on One teaching - BlissQuants Certification on course completion</li>' ;
                         }
                         else if(response.code == "P05")
                         {
                         desc = response.description +  '<br><br>' +    '<li>Elliot wave trading</li>' +
                         '<li>Moving average trading</li>' +
                         '<li>Chart pattern trading</li>' +
                         '<li>Money management</li>' +
                         '<li>Risk/Reward analysis  </li>' +
                         '<li>CMT exam preparation guidance </li>' +
                         '<li> 15 sessions for ₹50,000/ $725  </li>' +
                         '<li> 45 minutes session ( 30 min Theory & Practical + 15 min Q/A )</li>' +
                         '<li> One on One teaching - BlissQuants Certification on course completion</li>' ;
                         }
                         else if(response.code == "P06")
                         {
                         desc = response.description + '<br><br>' +   '<li>Option pricing, Option Greeks, IV Analytics and IV projection</li>' +
                         '<li>Short Gamma method, Long Gamma method, Strike shifting insights</li>' +
                         '<li>Delta neutral management </li>' +
                         '<li>Margin, expense and interest calculation  .</li>' +
                         '<li>Live position experience  </li>' + 
                         '<li> 12 sessions ₹40,000/ $560 </li>' +
                         '<li> 45 minutes session ( 30 min Theory & Practical + 15 min Q/A )</li>' +
                         '<li> One on One teaching - BlissQuants Certification on course completion</li>' ;
                         }
                         else if(response.code == "P07")
                         {
                         desc = response.description + '<br><br>' +   '<li>Web based product | yearly license fees | ₹15,000/ $225</li>' ;
                         }
                         else if(response.code == "P08")
                         {
                         desc = response.description + '<br><br>' +   'Excel based tool | Yearly license fees | ₹2,500/ $40' ;
                         }
                         else{*/
                        desc = response.description;
                        // }
                        document.getElementById('pro_detail').innerHTML = desc;
                        //document.getElementById('pro_price').innerHTML = response.price;
                        //    alert(response.price);
                        // sleep(2);
                        $.ajax({
                            url: 'get_hash.php',
                            type: 'post',
                            data: JSON.stringify({
                                key: $('#key').val(),
                                salt: $('#salt').val(),
                                txnid: $('#txnid').val(),
                                amount: $('#amount').val(),
                                pinfo: $('#pinfo').val(),
                                fname: $('#fname').val(),
                                email: $('#email').val(),
                                mobile: $('#mobile').val(),
                                udf5: $('#udf5').val()
                            }),
                            contentType: "application/json",
                            dataType: 'json',
                            success: function (json) {
                                if (json['error']) {
                                    $('#alertinfo').html('<i class="fa fa-info-circle"></i>' + json['error']);
                                } else if (json['success']) {
                                    //alert(json['success']);
                                    $('#hash').val(json['success']);
                                }
                            }
                        });
                    }

                });
//alert($('#pinfo').val());
                /*     $.ajax({
                 url: 'index.php',
                 type: 'post',
                 data: JSON.stringify({
                 key: $('#key').val(),
                 salt: $('#salt').val(),
                 txnid: $('#txnid').val(),
                 amount: $('#amount').val(),
                 pinfo: $('#pinfo').val(),
                 fname: $('#fname').val(),
                 email: $('#email').val(),
                 mobile: $('#mobile').val(),
                 udf5: $('#udf5').val()
                 }),
                 contentType: "application/json",
                 dataType: 'json',
                 success: function (json) {
                 if (json['error']) {
                 $('#alertinfo').html('<i class="fa fa-info-circle"></i>' + json['error']);
                 } else if (json['success']) {
                 $('#hash').val(json['success']);
                 }
                 }
                 });*/

            }


            //-->
        </script>
        <script type="text/javascript"><!--

            //--
        </script>	

    </body>



</html>

