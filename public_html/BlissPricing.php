<?php
include './header.php';
?>
<html>
    <head>
        <style>
            .pricing-table {
                margin-top: 0px;
            }
            .pricing-table {
              
                margin-bottom: 10px;
            }
            .pricing-table .pricing-table-item {
                border-bottom: 0px;
            }
            .pricing-table .item-header {
                background-color: #696969;
                color: #000;
                text-align: center;
                line-height: 40px;
            }
            h2, .header-two {
                /*font-family: Helvetica, Arial, sans-serif;*/
                font-size: 19px;
                line-height: 1;
                text-transform: uppercase;
            }
            .pricing-table .item-cta-block {
                background-color: #474545;;
                padding: 10px;
                text-align: center;
                position: relative;
            }
            .pricing-table .block-price {
                color: #000000;
                font-size: 35px;
                font-family: 'Open Sans',"Trebuchet MS", Arial, sans-serif;
            }
            .pricing-table .block-sub-text {
                
                font-size: 15px;
                color: #fff;
                line-height: 26px;
                margin-bottom: 10px;
            }
            .pricing-table .pricing-toggle-holder {
                display: none;
            }
            .pricing-table .pricing-toggle-holder button {
                padding-left: 0;
                padding-right: 0;
            }
            .item-cta-block .button.orange-button {
                display: inline-block;
                width: 90%;
            }
            button.orange-button, input[type="button"].orange-button, input[type="reset"].orange-button, input[type="submit"].orange-button, a.button.orange-button {
                background-color: rgba(132,194,37,0.8);
                color: #000;
                padding: 12px 20px;
                box-shadow: 0 3px 0 0 rgba(24, 24, 25, 0.1);
                -webkit-transition: all .75s;
                transition: all .75s;
                margin-bottom: 6px;
            }
            button .glyphicon-menu-right, input[type="button"] .glyphicon-menu-right, input[type="reset"] .glyphicon-menu-right, input[type="submit"] .glyphicon-menu-right, a.button .glyphicon-menu-right {
                top: -1px;
                margin-left: 5px;
                font-size: 9px;
            }
            .pricing-table .item-details-block {
                background-color: rgb(58, 53, 49);;
                padding: 10px 10px;
               
            }
            .pricing-table .plus-header {
                text-align: center;
                font-size: 16px;
               /* font-family: "Trebuchet MS", Arial, sans-serif;*/
            }
            .pricing-table .separator {
                margin-bottom: 10px;
            }
            .separator {
                background-color: rgb(132,194,37);
                height: 3px;
                width: 100px;
                margin: 0 auto;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            .pricing-table .item-details-block {
               height: 45%;
            }
            .modal .item-details-block {
               height: 70%;
            }
            .pricing-table .item-details-block ul {
                list-style: none;
                margin: 0;
                padding: 0;
            }
            .pricing-table .item-details-block ul li {
                line-height: 1.5;
            }
            .item-details-block li {
                text-align: center;
                margin-bottom: 2px;
                line-height: 60%;
                font-size: 14px;
            }
            .separator-type, .title-type, .intro-type, .content-type .intro-type p {
                position: relative;
            }
            .intro-type .container {
                padding: 107px 0px 102px 0px !important;
            }
            .company-heading h1 {
               
                line-height: 40px;
                color: rgba(132,194,37,0.8);
                
                text-align: center;
                background-color: rgb(58, 53, 49);;
            }
            .seo-header, .product-header, .intro-type .container h1.white, .company-heading h1 {
                
                text-transform: capitalize;
                font-size: 20px;
               
            }
            .parallax {
                background-attachment: inherit !important;
            }
            .parallax {
                background-attachment: inherit !important;
            }
            .parallax {
                background-attachment: inherit !important;
                background-repeat: repeat;
                background-size: cover;
                position: absolute;
                top: 0px;
                bottom: 0px;
                width: 100%;
                z-index: -10;
            }
        </style>

    </head>
     <body>
           <div class="row wrap">
               <div class="col-lg-8 col-lg-offset-2">
                  
        <section class="company-heading" id="parallax-one">
      
            <div >
                <div class="row ">
                    <div class="col-md-12">
                        <h1>
                            BlissQuants IV Analytics Pricing
                        </h1>
                    </div>
                </div>
            </div>
            
        </section>
        <div >
            <div class="pricing-table row">
                   <div class="col-md-4 col-sm-6">
                    <div class="">
                        <h2 class="item-header">Basic</h2>
                        <div class="item-cta-block" >
                            <div id="js__block-price" class="block-price currency-container" data-country="usd">Free</div>
                            <div class="block-sub-text"> LIfe Time</div>

                            

                            <a class="button orange-button" href='#' data-toggle='modal' data-target='#Register-modal'>Free</a>
                        </div>
                        <div class="item-details-block">
                            <div class="plus-header">Offered features:</div>
                            <div class="separator"></div>
                            <ul>
                                <li>Historical ATM IV</li>
                                <li>IV Projection</li>
                                <li>Option Calculator</li>
                                <li>Margin Calculator</li>
                                <li> Result Calendar</li>
                                <li> Economic Calendar</li>
                                <li> IndiaVIX Data and Chart</li>
                                <li> FII DII Data</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="pricing-table-item">
                        <h2 class="item-header">Personal</h2>
                        <div class="item-cta-block" >
                            <div id="js__block-price" class="block-price currency-container"  data-country="usd">3999 INR</div>
                            <div class="block-sub-text">Per Quarter</div>

                          

                             <a class="button orange-button outbound" href='#' data-toggle='modal' data-target='#personal-modal'>Buy Personal</a>
                        </div>
                        <div class="item-details-block">
                            <div class="plus-header">Offered features:</div>
                            <div class="separator"></div>
                            <ul>
                               <li>  ATM IV live chart</li>
                               <li>ATM IV daily chart</li>
                                <li>Historical IV data</li>
                                <li>IV Chart Watchlist</li>
                                <li>IV Stock Watchlist</li>
                             <li>Stock IV movement during Result week</li>
                                <li> Historical FO movement</li>
                               
                                <li>Result calendar – date and time </li>
                                
                                <li>All basic features</li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="pricing-table-item">
                        <h2 class="item-header">Pro</h2>
                        <div class="item-cta-block" >
                            <div id="js__block-price" class="block-price currency-container" data-country="usd">9999 INR</div>
                            <div class="block-sub-text"> Per Quarter</div>
                            
                            <a class="button orange-button outbound" href='#' data-toggle='modal' data-target='#pro-modal'>Buy Pro</a>
                        </div>
                        <div class="item-details-block">
                            <div class="plus-header">Offered features:</div>
                            <div class="separator"></div>
                            <ul>
                                <li> 2 strategies customization with live IV</li>
                                 <li> Live Event Announcement</li>
                                <li>  ATM IV live chart</li>
                               <li>ATM IV daily chart</li>
                                <li>Historical IV data</li>
                                <li>IV Chart Watchlist</li>
                                <li>IV Stock Watchlist</li>
                             <li>Stock IV movement during Result week</li>
                                <li> Historical FO movement</li>
                               
                                <li>Result calendar – date and time </li>
                                
                                <li>All basic features</li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
             <!--   <div class="col-md-3 col-sm-6">
                    <div class="pricing-table-item">
                        <h2 class="item-header">Enterprise</h2>
                        <div class="item-cta-block" >
                            <div id="js__block-price" class="block-price currency-container" style="display: inline-block;" data-country="usd">19999 (INR)</div>
                            <div class="block-sub-text"><div id="js__block-price" class="currency-container" style="display: none;" data-country="cad">USD</div> Per Quarter</div>

                            <div class="pricing-toggle-holder">
                                <button class="pricing-toggle">
                                    <span class="pricing-toggle-open">See Ultimate Features <span class="glyphicon glyphicon-plus"></span></span>
                                    <span class="pricing-toggle-close">Hide Ultimate Features <span class="glyphicon glyphicon-minus"></span></span>
                                </button>
                            </div> 

                            <a class="button orange-button outbound" href="BlissAboutUs.php#collapseFive" target="_blank">Buy Enterprise</a>
                        </div>
                        <div class="item-details-block">
                            <div class="plus-header">Includes the following features:</div>
                            <div class="separator"></div>
                            <ul>
                                <li>5 strategies customization with live IV</li>
                                 <li>  Individual 10 Register</li>
                                  <li> Live Event Announcement</li>
                              
                                <li>  ATM IV live chart</li>
                               <li>ATM IV daily chart</li>
                                <li>Historical IV data</li>
                                <li>IV Chart Watchlist</li>
                                <li>IV Stock Watchlist</li>
                             <li>Stock IV movement during Result week</li>
                                <li> Historical FO movement</li>
                               
                                <li>Result calendar – date and time </li>
                                
                                <li>All basic features</li>
                            </ul>
                        </div>
                    </div>-->
                </div>
            </div>
                   
        </div>
           </div>
          <div div class="modal fade" id="personal-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

         <div class="modal-header">


            <h3 class="modal-center">BlissQuants IV Analytics Personal Package <br><br><p style="font-size:18px">3999 INR per 3 Month / 12999 INR per 12 Months<p></h3>
        </div>
              <div class="modal-dialog pricing-table">
            <div class="account-wall item-details-block">
                                <table  class=" table table-striped " >

                                    <tbody >
                                        <tr >
                                            <td >Name</td>
                                            <td>BlissQuants Technologies</td>

                                        </tr>
                                        <tr>
                                            <td>Bank Name</td>
                                            <td>HDFC Bank</td>

                                        </tr>
                                        <tr>
                                            <td>A/C No.</td>
                                            <td>50200005727930</td>

                                        </tr>
                                        <tr>
                                            <td>IFSC Code</td>
                                            <td>HDFC0000896</td>

                                        </tr>
                                    </tbody>
                                </table>

                                <div class="text-center">Please send a confirmation of transfer at- <a>inquiry@blissquants.com </a>
                                   

                                </div>
                                 <br>
                                <div class="col-md-12 col-sm-12 ">
                                    <?php
                                    $action = "";
                                    if (isset($_REQUEST['action'])) {
                                        $action = $_REQUEST['action'];
                                    }
                                    if ($action == "") /* display the contact form */ {
                                        ?> 
                                        <form class="form-horizontal" action="" method="post">
                                            <input type="hidden" name="action" value="submit"> 
                                            <!-- Name input-->
                                            <div class="form-group ">

                                                <div class="col-md-6 col-sm-6">
                                                    <input id="name" name="fname" type="text" placeholder="Your name" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="mobile" name="mobile" placeholder="Mobile" type="text" class="form-control" required>
                                                </div>
                                            </div>

                                            <!-- Email input-->
                                            <div class="form-group">

                                                <div class="col-md-6  col-sm-6">
                                                    <input id="email" name="email" type="text" placeholder="Your email" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <select name="range" class="form-control" required>                    
                                                        <option value="" selected="selected">Plan</option>

                                                        <option >3999 (INR)  for 3 Month </option>

                                                        <option >12999 (INR)  for 1 Year </option>                            
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- company-->





                                            <!-- Message body -->
                                            <div class="form-group">

                                                <div class="col-md-12">
                                                    <textarea class="form-control" id="message" name="message" placeholder="Please write Payment Detail or your query here..." rows="5" ></textarea>
                                                </div>
                                            </div>

                                            <!-- Form actions -->
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn BlissColor" style="width:100% ;  font-size: 18px">Submit</button>
                                                </div>
                                            </div>

                                        </form>   
    <?php
} else /* send the submitted data */ {
    $user_email = $_POST['email'];
    //Email information
    $headers = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers .= "From: " . $user_email;
    $admin_email = "inquiry@blissquants.com,vineet.Jain@blissquants.com";
    $f_name = $_POST['fname'];
    $email = $f_name . '<' . $user_email . '>';
    $subject = "Payment Detail";
    $mobile = $_POST['mobile'];
    $plan = $_POST['range'];
    $message = $_POST['message'];

    $comment = 'Name:-' . $f_name . ',    <br /> <br />  Email:-' . $user_email . ', <br /> <br /> Mobile:-' . $mobile . ',  <br /> <br /> Plan:- Personal ' . $plan . ',   <br /> <br />   Subject:-' . $subject . ',   <br /> <br />   Message:-' . $message;
    mail($admin_email, "$subject", $comment, "From:" . $headers);
    echo "Thank You For Choosing Our Plan! <br> We Will Contact You Soon <br><a href=\"BlissTransfer.php\" >Click Here To Continue</a>";
}
?> 
                                </div>
                            </div>
                  

        </div>

        </div>
 <div div class="modal fade" id="pro-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-header">


            <h3 class="modal-center">BlissQuants IV Analytics Pro Package <br><br><p style="font-size:18px">9999 INR per 3 Month / 25999 INR per 12 Months<p></h3>
        </div>
              <div class="modal-dialog pricing-table">
            <div class="account-wall item-details-block">
                                <table  class=" table table-striped " >

                                    <tbody >
                                        <tr >
                                            <td >Name</td>
                                            <td>BlissQuants Technologies</td>

                                        </tr>
                                        <tr>
                                            <td>Bank Name</td>
                                            <td>HDFC Bank</td>

                                        </tr>
                                        <tr>
                                            <td>A/C No.</td>
                                            <td>50200005727930</td>

                                        </tr>
                                        <tr>
                                            <td>IFSC Code</td>
                                            <td>HDFC0000896</td>

                                        </tr>
                                    </tbody>
                                </table>

                                <div class="text-center">Please send a confirmation of transfer at- <a>inquiry@blissquants.com </a>
                                   

                                </div>
                                 <br>
                                <div class="col-md-12 col-sm-12 ">
                                    <?php
                                    $action = "";
                                    if (isset($_REQUEST['action'])) {
                                        $action = $_REQUEST['action'];
                                    }
                                    if ($action == "") /* display the contact form */ {
                                        ?> 
                                        <form class="form-horizontal" action="" method="post">
                                            <input type="hidden" name="action" value="submit"> 
                                            <!-- Name input-->
                                            <div class="form-group ">

                                                <div class="col-md-6 col-sm-6">
                                                    <input id="name" name="fname" type="text" placeholder="Your name" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="mobile" name="mobile" placeholder="Mobile" type="text" class="form-control" required>
                                                </div>
                                            </div>

                                            <!-- Email input-->
                                            <div class="form-group">

                                                <div class="col-md-6  col-sm-6">
                                                    <input id="email" name="email" type="text" placeholder="Your email" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <select name="range" class="form-control" required>                    
                                                        <option value="" selected="selected">Plan</option>

                                                        <option >9999 (INR)  for 3 Month </option>

                                                        <option >25999 (INR)  for 1 Year </option>                            
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- company-->





                                            <!-- Message body -->
                                            <div class="form-group">

                                                <div class="col-md-12">
                                                    <textarea class="form-control" id="message" name="message" placeholder="Please write Payment Detail or your query here..." rows="5" ></textarea>
                                                </div>
                                            </div>

                                            <!-- Form actions -->
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn BlissColor" style="width:100% ;  font-size: 18px">Submit</button>
                                                </div>
                                            </div>

                                        </form>   
    <?php
} else /* send the submitted data */ {
    $user_email = $_POST['email'];
    //Email information
    $headers = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers .= "From: " . $user_email;
    $admin_email = "inquiry@blissquants.com,vineet.Jain@blissquants.com";
    $f_name = $_POST['fname'];
    $email = $f_name . '<' . $user_email . '>';
    $subject = "Payment Detail";
    $mobile = $_POST['mobile'];
    $plan = $_POST['range'];
    $message = $_POST['message'];

    $comment = 'Name:-' . $f_name . ',    <br /> <br />  Email:-' . $user_email . ', <br /> <br /> Mobile:-' . $mobile . ',  <br /> <br /> Plan:- Pro ' . $plan . ',   <br /> <br />   Subject:-' . $subject . ',   <br /> <br />   Message:-' . $message;
    mail($admin_email, "$subject", $comment, "From:" . $headers);
    echo "Thank You For Choosing Our Plan! <br> We Will Contact You Soon <br><a href=\"BlissTransfer.php\" >Click Here To Continue</a>";
}
?> 
                                </div>
                            </div>
                  

        </div>

     </div>
    </body>   
</html>
<?php
include ("./html/footer.html");

?>