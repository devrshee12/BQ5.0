
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
                background-color: #474545;
                color: #FFF;
                text-align: center;
                line-height: 30px;
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
                color: #FFF;
                font-size: 40px;
                font-family: "Trebuchet MS", Arial, sans-serif;
            }
            .pricing-table .block-sub-text {
                text-transform: uppercase;
                font-size: 15px;
                color: #FFF000;
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
            }
            button.orange-button, input[type="button"].orange-button, input[type="reset"].orange-button, input[type="submit"].orange-button, a.button.orange-button {
                background-color: rgba(132,194,37,0.8);
                color: #000;
                padding: 12px 20px;
                box-shadow: 0 3px 0 0 rgba(24, 24, 25, 0.1);
                -webkit-transition: all .75s;
                transition: all .75s;
                margin-bottom: 6px;
                width: 100%;
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
                font-size: 18px;
                /* font-family: "Trebuchet MS", Arial, sans-serif;*/
            }
            .pricing-table .separator {
                margin-bottom: 20px;
            }
            .separator {
                background-color: #000;
                height: 3px;
                width: 100px;
                margin: 0 auto;
                margin-top: 20px;
                margin-bottom: 10px;
            }
            .pricing-table .item-details-block {
                height: 500px;
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
                font-size: 16px;
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
            .table-striped>tbody>tr>td, 
            .table-striped>tbody>tr>th { 
                font-size: 14px;
            }
            .form-horizontal{
                height: 20%;
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
                                    Bank Transfer Detail for NEFT/RTGS
                                </h1>
                            </div>
                        </div>
                    </div>

                </section>
                <div class="row">
                    <div class="col-md-6 col-sm-12  ">
                        <div class="pricing-table row ">       
                            <div class="item-details-block">
                                <h2 class="item-header">Pro</h2>
                                <div class="plus-header">Includes the following features:</div>
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
                                <br>
                                     <span class="btn" style="width:100%; font-size: 18px;color:rgb(132,194,37)">9999 INR per 3 Month / 25999 INR per 12 Months </span>

                            </div>
                       
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-12 ">
                        <div class="pricing-table row ">       
                            <div class="item-details-block">
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

                                <div >Please send a confirmation of transfer at- <a>inquiry@blissquants.com </a>
                                   

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
                                                    <button type="submit" class="btn BlissColor" style="width:100% ;  font-weight: bold;;font-size: 24px">Submit</button>
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

    $comment = 'Name:-' . $f_name . ',    <br /> <br />  Email:-' . $user_email . ', <br /> <br /> Mobile:-' . $mobile . ',  <br /> <br /> Plan:- Perosnal ' . $plan . ',   <br /> <br />   Subject:-' . $subject . ',   <br /> <br />   Message:-' . $message;
    mail($admin_email, "$subject", $comment, "From:" . $headers);
    echo "Thank You For Choosing Our Plan! <br> We Will Contact You Soon <br><a href=\"BlissTransfer.php\" >Click Here To Continue</a>";
}
?> 
                                </div>
                            </div>

                        </div>


                    </div>
                </div>



            </div>

        </div>
    </body>   
</html>
<?php
include ("./html/footer.html");

