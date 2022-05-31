<!DOCTYPE html>
<?php
/* if(isset($_SERVER['HTTP_REFERER']))
  {
  $last = $_SERVER['HTTP_REFERER'];
  } */
error_reporting(0);

//include("session_check.php");     
include("header.php");
?>
<?php //session_start();
?>
<html>
    <head>

        <title> BlissQuants - Delta Hedging | About </title>     

        <link href="./css/style2.css" rel="stylesheet">
        <style>

            .panel-body  li{
                margin-bottom: 2%;
            }
            /* .form-group{
               margin:1px;
            
           }*/
            .btn-lg{
                padding-left: 2px;
                font-weight: normal;
                font-size: 13px;
            }
            h3{
                margin-top: 0;
            }
        </style>

        <script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
        <script>
            /*open panel when user is on about us page*/
            function company() {
                window.location.reload();
            }
            function career() {
                window.location.reload();
            }
            function contact() {
                window.location.reload();
            }


            $(document).ready(function () {

                //to open direct div panel on link

                var anchor = window.location.hash;

                $(anchor).collapse({toggle: false});/*for any browser that doesn't support transitions (or if it is deactivated).*/

                $(anchor).collapse('toggle');

                /*var hash = window.location.hash;
                 var anchor = $('a[href$="'+hash+'"]');
                 if (anchor.length > 0){
                 anchor.click();
                 }*/
                //change icon on open/close;
                function toggleChevron(e) {

                    $(e.target)
                            .prev('.accordion-toggle')
                            .find("i.indicator")
                            .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');

                }
                $('#accordion').on('hidden.bs.collapse', toggleChevron);
                $('#accordion').on('shown.bs.collapse', toggleChevron);

                function toggleChevron2(e) {
                    var text = $(e.target)
                            .prev('.accordion-toggle')
                            .find("i.indicator2")
                            .text() == '➴' ? '➵' : '➴';
                    $(e.target)
                            .prev('.accordion-toggle')
                            .find("i.indicator2")
                            .text(text);

                }

                $('#accordion').on('hidden.bs.collapse', toggleChevron2);
                $('#accordion').on('shown.bs.collapse', toggleChevron2);

            });
            function set_options(option_num) {
                document.getElementById("message_subject").options[option_num].selected = true;
            }
            function refreshCaptcha() {
                var img = document.images['captchaimg'];
                img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
            }
        </script>

    </head>

    <body>       

        <div class="row wrap">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 panel-group" id="accordion">
                <br><br>
                <div class="panel ">  
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <div class="panel-heading panel-primary">

                            <h4 class="panel-title">
                                <i class="indicator2">  ➵  </i>               
                                Who we are 
                                <i class="indicator glyphicon glyphicon-chevron-down  pull-right"> </i> 
                            </h4>

                        </div>
                    </a>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel">
                        <div class="panel-body">
                            The world is being re-shaped by the convergence of data and technology. You can have data without information, but you can't have information without data. <br><br>At BlissQuants, we gather loads of data related to stock market and work on it by the process of inspecting, transforming, and modeling data with the goal of discovering useful information to support decision-making. <br><br>We do believe that errors using inadequate data are much less than those using no data at all. By performing quantitative analysis of data, we provide useful information that helps you to take right trading decision fearlessly and confidently.<br>
                            <div class="row">  
                                <div class="col-lg-3">                 
                                    <a href="BlissPeople.php"><img src="images/bliss_tree_transpraent.gif" alt="Bliss Image" width="120" height="150"><h5>BlissQuants Team</h5> </a>
                                </div>
                                <div class="col-lg-9">
                                    <br>
                                    <b class="BlissFontColor">Vision</b>: Fearless financial trading.  <br> <br>
                                    <b class="BlissFontColor">Mission</b>: Trade confidently through knowledge and technology.<br> <br>
                                    <b class="BlissFontColor">Strategy</b>: Analyze data and follow discipline.<br> <br>
                                    <b class="BlissFontColor">Responsibility</b>: Commitment to ethical practices.<br><br>
                                    <b class="BlissFontColor">Values</b>:  Trust, Innovation, Quality <br> <br>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                        <div class="panel-heading" role="tab">
                            <h4 class="panel-title">
                                <i class="indicator2">  ➵  </i> 
                                What we do  
                                <i class="indicator glyphicon glyphicon-chevron-down  pull-right"> </i> 
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel">
                        <div class="panel-body">
                            <ul>

                                <li>    We do data analysis on capital market.  </li>    
                                <li>    We do option Delta hedging. </li>
                                <li>   We do technical analysis to identify stock trend.</li>
                                <li>   We do software development related to stocks trading.</li>
                            </ul> 
                            <div class="row">
                                <div class="col-lg-12 ">

                                    <div class="title_all" id="hitorical">
                                        <h3>About BlissQuants Analytics company </h3>
                                    </div>
                                    <div class="box-body">
                                        <iframe width="100%" height="456" src="https://www.youtube.com/embed/VaEQ6SDCHl0?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                                        <a href='#' data-toggle='modal' data-target='#Register-modal'><input class=' btn-lg btn-block text-center'  value='Request a Demo'></a>  

                                    </div>

                                </div>


                            </div>
                            <!-- <video width="600" height="550" controls>
                   <source src="BlissQuantsV14F.mp4" type="video/mp4">
                   
                  Your browser does not support the video tag.
                  </video>-->
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <i class="indicator2">  ➵  </i> 
                                What we provide
                                <i class="indicator glyphicon glyphicon-chevron-down  pull-right"> </i> 
                            </h4>
                        </div>
                    </a>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel">
                        <div class="panel-body">
                            <ul> 

                                <li> Investment opportunities based on BlissQaunts data. </li>
                                <li> Self-employment opportunities as option delta hedger.  </li>
                                <li> Coaching for Option Delta hedging techniques </li> 
                                <li> Necessary data for option trading - result impact, IV analysis, VIX- Index movement. </li>
                                <li> Softwares for Option positions and Implied Volatility analysis.</li>    
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="panel">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        <div class="panel-heading" role="tab">
                            <h4 class="panel-title">
                                <i class="indicator2">  ➵  </i> 
                                What we look for
                                <i class="indicator glyphicon glyphicon-chevron-down  pull-right"> </i> 
                            </h4>
                        </div>
                    </a>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel">
                        <div class="panel-body">
                            <br>
                            Looking for data analysts in the field of finance and software!
                            <br><br>
                            <span > Please contact us at <a href="mailto:inquiry@blissquants.com">inquiry@blissquants.com</a> </span>


                        </div>
                    </div>
                </div>

                <div class="panel">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                        <div class="panel-heading" role="tab">
                            <h4 class="panel-title">
                                <i class="indicator2">  ➵  </i> 
                                Where we are 
                                <i class="indicator glyphicon glyphicon-chevron-down  pull-right"> </i>   

                            </h4>
                        </div>
                    </a>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel">
                        <div class="panel-body">



                            <div class="col-md-7 ">      
                                <?php
                                $action = $_REQUEST['action'];

                                if ($action == "") /* display the contact form */ {
                                    ?> 
                                    <form class="form-horizontal" action="BlissAboutUs.php#collapseFive" method="post">
                                        <input type="hidden" name="action" value="submit"> 
                                        <!-- Name input-->
                                        <div class="form-group ">

                                            <div class="col-md-12">
                                                <input id="name" name="fname" type="text" placeholder="Your name" class="form-control" required>
                                            </div>
                                        </div>

                                        <!-- Email input-->
                                        <div class="form-group">

                                            <div class="col-md-12">
                                                <input id="email" name="email" type="text" placeholder="Your email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="col-md-12">
                                                <select name="range2" id="message_subject" class="form-control" required>                    
                                                    <option selected="selected">Subject</option>

                                                    <option>Option Delta Hedger</option>
                                                    <option>Coaching - Option Delta Hedging</option>
                                                    <option>BlissQuants IV Analytics Product Demo</option>
                                                    <option>Option Trading strategies</option>
                                                    <option>Software Development & Maintenance</option>
                                                    <option>Other </option>

                                                </select>
                                            </div>
                                        </div>

                                        <!-- company-->
                                        <div class="form-group">

                                            <div class="col-md-12">
                                                <input id="company" name="company" placeholder="Company" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <!-- background-->



                                        <!-- Message body -->
                                        <div class="form-group">

                                            <div class="col-md-12">
                                                <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group"> <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="table">
                                                <?php if (isset($msg)) { ?>
                                                    <tr>
                                                        <td colspan="2" align="center" valign="top"><?php echo $msg; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td align="right" valign="top"> Validation code:</td>
                                                    <td><img src="captcha.php?rand=<?php echo rand(); ?>" id='captchaimg'><br>
                                                        <label for='message'>Enter the code above here :</label>
                                                        <br>
                                                        <input id="captcha_code" name="captcha_code" type="text" class="form-control" required>
                                                        <br>
                                                        Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.</td>
                                                </tr>

                                            </table></div>

                                        <!-- Form actions -->
                                        <div class="form-group">
                                            <div class="col-md-12 text-center">
                                                <button type="submit"  class="btn BlissColor btn-block text-center">Submit</button>
                                            </div>
                                        </div>

                                    </form>       
                                    <?php
                                } else //* send the submitted data */ {
                                {
                                    $user_email = $_POST['email'];
                                    //Email information
                                    $headers = "MIME-Version: 1.0\n";
                                    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                                    $headers .= "From: " . $user_email;
                                    $admin_email = "inquiry@blissquants.com,vineet.jain@blissquants.com";
                                    $f_name = $_POST['fname'];
                                    $email = $f_name . '<' . $user_email . '>';
                                    $subject = $_POST['range2'];
                                    $company = $_POST['company'];
                                    $investing = $_POST['range'];
                                    $message = $_POST['message'];

                                    $comment = 'Name:-' . $f_name . ',    <br /> <br />  Email:-' . $user_email . ', <br /> <br /> company:-' . $company . ',  <br /> <br /> investing_background:-' . $investing . ',   <br /> <br />   Subject:-' . $subject . ',   <br /> <br />   Message:-' . $message;
                                    // if(isset($_POST['submit'])){
                                    // code for check server side validation
                                    if (empty($_SESSION['captcha_code']) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0) {
                                        echo "<span style='color:red'>The Validation code does not match!</span><br><a href=\"BlissAboutUs.php\" >Click Here To Continue</a>"; // Captcha verification is incorrect.		
                                        ?> <form class="form-horizontal" action="BlissAboutUs.php#collapseFive" method="post">
                                            <input type="hidden" name="action" value="submit"> 
                                            <!-- Name input-->
                                            <div class="form-group ">

                                                <div class="col-md-12">
                                                    <input id="name" name="fname" type="text" placeholder="Your name" value="<?php echo $f_name; ?>" class="form-control" required>
                                                </div>
                                            </div>

                                            <!-- Email input-->
                                            <div class="form-group">

                                                <div class="col-md-12">
                                                    <input id="email" name="email" type="text" placeholder="Your email" value="<?php echo $user_email; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <div class="col-md-12">
                                                    <select name="range2" id="message_subject" class="form-control" required>                    

                                                        <option>Option Delta Hedger</option>
                                                        <option>Coaching - Option Delta Hedging</option>
                                                        <option>BlissQuants IV Analytics Product Demo</option>
                                                        <option>Option Trading strategies</option>
                                                        <option>Software Development & Maintenance</option>
                                                        <option>Other </option>

                                                    </select>
                                                </div>
                                            </div>

                                            <!-- company-->
                                            <div class="form-group">

                                                <div class="col-md-12">
                                                    <input id="company" name="company" placeholder="Company" type="text" value="<?php echo $company; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <!-- background-->



                                            <!-- Message body -->
                                            <div class="form-group">

                                                <div class="col-md-12">
                                                    <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5" required><?php echo $message; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group"> <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="table">
                                                    <?php if (isset($msg)) { ?>
                                                        <tr>
                                                            <td colspan="2" align="center" valign="top"><?php echo $msg; ?></td>
                                                        </tr>
                                                        <?php
                                                    }//echo rand();
                                                    ;
                                                    ?>
                                                    <tr>
                                                        <td align="right" valign="top"> Validation code:</td>
                                                        <td><img src="captcha.php?rand=<?php echo rand(); ?>" id='captchaimg'><br>
                                                            <label for='message'>Enter the code above here :</label>
                                                            <br>
                                                            <input id="captcha_code" name="captcha_code" type="text" class="form-control" required>
                                                            <br>
                                                            Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.</td>
                                                    </tr>

                                                </table></div>

                                            <!-- Form actions -->
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit"  class="btn BlissColor btn-block text-center">Submit</button>
                                                </div>
                                            </div>

                                        </form>       
                                        <?php
                                    } else {// Captcha verification is Correct. Final Code Execute here!		
                                        mail($admin_email, "$subject", $comment, "From:" . $headers);
                                        echo "Thank You For Contacting Us! <br> We Will Contact You Soon <br>Incase we can not reply in 2 days please message us gain <br><a href=\"BlissAboutUs.php\" >Click Here To Continue</a>";
                                    }
//}
                                }
                                ?> 
                            </div>
                            <div class="col-md-5 col-xs-12 col-sm-12">
                                <h3 class="BlissFontColor">BlissQuants Analytics</h3>

                                <h5> Fearless Financial Trading <br>
                                    <img src="images/bliss_tree_transpraent.gif" alt="Bliss Image" width="120" height="150"><br>
                                 
                                    <!--India 	&nbsp;: +91 9898032020 <br>
                                    RahulRaj Mall, <br>Piplod, Surat, India<br><br>
                                    US  	&nbsp;	&nbsp 	&nbsp; : +1 (617) 530-0222  <br>
                                    Boston, MA, USA  <br>
                                    E-mail: <a href="mailto:inquiry@BlissQuants.com">inquiry@BlissQuants.com</a><br/></h5>-->
                                   <P> Contact number : +91 98980 32020 </P>
                                   <style>
                                       .BlissFontColor{
                                           font-size: 14px;
                                       }
                                    .address{
                                           font-size: 12px!important;
                                       }
                                   </style>
                                   <table class="table">
                                     
                                       <tr>
                                           <td>
                                               <span class="BlissFontColor" >Surat : </span> 
                                           </td>
                                           <td class="address">
                                               101 B, RahulRaj Mall, Dumas Road,<br>  Surat – 395007, Gujarat.
                                           </td>
                                       </tr>
                                        <tr>
                                           <td>
                                                <span class="BlissFontColor" >Rajkot : </span> 
                                           </td>
                                           <td class="address">
                                                 311, Jasal complex, Opp sterling hospital, <br> Ring road,  Rajkot-360005, Gujarat
                                           </td>
                                       </tr>
                                        <tr>
                                           <td>
                                                <span class="BlissFontColor" >Pune : </span> 
                                           </td>
                                           <td class="address">
                                               A11, The Laburnums, Mitcon Road, <br> Balewadi,  Pune – 411045, Maharashtra
                                           </td>
                                       </tr>
                                       <tr>
                                           <td>
                                                <span class="BlissFontColor">Boston : </span> 
                                           </td>
                                           <td class="address">11 Railroad Ave, North Reading, <br> Boston, MA 01864 | (617) 530-0222
                                           </td>
                                       </tr>
                                   </table>
  
                                                        


                                   
                           


                                    E-mail: <a href="mailto:inquiry@BlissQuants.com">inquiry@BlissQuants.com</a><br/></h5>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-lg-2"></div>

        </div>


    </body>
</html>
<?php
include("html/footer.html");
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
