<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    include("header_all.php");
?>
<html>
    <head>
        <title>Bliss Delta</title> 
          <script type="text/javascript" language="javascript" src="bootstrap-3.3.4-dist/js/jquery.carouFredSel-6.0.4-packed.js"></script>
         <script type="text/javascript" language="javascript" src="bootstrap-3.3.4-dist/js/news-ticker.js"></script>
    </head>
     <body>         
            <div class="row wrap">
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle  btn-lg" data-toggle="collapse" data-target=".bliss-data-menu">
                           
                           
                             <span class="title_all">Service-Menu</span><span class="glyphicon glyphicon-th"></span>
                                   
                        </button>
                    </div> 
                    <div class="navbar-collapse collapse bliss-data-menu">
                     <ul class="nav nav-stacked nav-pills">
                        <li ><a href="BlissCoach.php" class="active" >BlissDelta</a></li>
                         <li><a href="BlissInvestment.php" >BlissFund</a></li>
                        <li ><a href="BlissCall.php">BlissCall</a></li>  
                        <li><a href="BlissKB.php">BlissBlog</a></li>
                        <li><a href="BlissFAQ.php" >FAQ</a></li>                 
                     </ul>
                         </div>
                 </div>
           <div class="col-lg-8 col-md-8 col-sm-8">   
               <div class="title_all text-center">
                   <span style="padding-right: 30px"> BlissDelta   </span>   <small style="color:white">We do Option Delta Hedging</small>
                   
               </div>
               <div >
                 
                 
                  
                   <div class="panel-body">Delta Hedging is a scientific way of making consistent profit in the stock market. This method helps to create profitable strategies that can make you earn in the stock market. Be a part of our our Delta hedging team. If you are a beginner, come and learn Delta hedging technique  with our Bliss coach. <br>
                       <br> Interested in joining as Delta hedger or learning option Delta hedging techniques? <a href="BlissAboutUs.php#collapseFive" onclick="location.reload();">     Contact us.</a>
                   </div>
                 
                   <br> 
                
                   <div class="row">
                  
                       <div class="col-lg-4 col-md-4 col-sm-4"><div class="panel-heading">Basic Options </div>
                           <div class="sub_name">
                               <ul>
                                   <li> Introduction </li>
                                   <li> What are options?</li>
                                   <li> Why use options?</li>
                                   <li> How options work</li>
                                   <li> Types of options</li>
                                   <li>Call and Put specifics</li>
                                   <li>Option Premium</li>
                                   <li>Expiration, Exercise and Assignment</li>
                                    <li>Practice with Softwares ODIN and NOW</li> 
                               </ul>
                           </div>
</div>
                     
                       <div class="col-lg-4 col-md-4 col-sm-4"><div class="panel-heading ">Advanced Options</div> 
                            <div class="sub_name">
                                <ul>
                                    <li>Butterfly methodologies</li> 
                                    <li>Straddle and Strangle</li> 
                                    <li>Collar and Condor</li> 
                                    <li>Bull  and Bear Spreads</li> 
                                    <li>Covered options</li> 
                                    <li>Synthetic hedging techniques</li> 
                                    <li>Conversion and Reversion-Triangles</li> 
                                    <li>Ratio spreads</li> 
                                    <li>Analyze delta position with BlissCalc software.</li> 
                                  </ul>
                               </div>
                                 </div>
                     
                       <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class=" panel-heading ">Hedging Methods</div >
                            <div class="sub_name">
                                    <ul >
                                    <li>Option Greeks</li> 
                                    <li>Delta Hedging</li> 
                                    <li>Delta Neutral management</li> 
                                    <li>Delta management techniques</li> 
                                     <li>Short and Long Gamma</li>  
                                     <li>Gamma Neutral management</li> 
                                     <li>Options Theta</li> 
                                     <li>Option Vega and  Implied Volatility</li> 
                                    
                                </ul>
                            </div>                         
               
                   </div>
           
               </div>
              
               
                </div>
            <div class="col-lg-2 col-md-2 col-sm-2">

            </div>
           </div>
           </div>
         <div id="wrapper1" class="footer1 panel-body">
			
			<?php
                        include 'news_ticker_footer.php';
                        
                        ?>
		</div>
                     
        <?php

    include("html/footer.html");
?>  
</body>
</html>



