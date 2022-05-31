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
        <title>Bliss Earnings</title> 
        <link rel="stylesheet" href="jquery-ui.css">
        <script src="jquery-1.10.2.js"></script>
  <script src="jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
   <script type="text/javascript" language="javascript" src="bootstrap-3.3.4-dist/js/jquery.carouFredSel-6.0.4-packed.js"></script>
         <script type="text/javascript" language="javascript" src="bootstrap-3.3.4-dist/js/news-ticker.js"></script>
 
        <script>
           /* $("#accordion").on("shown.bs.collapse", function () {
                alert("ddddddd");
                var selected = $(this);
                var collapseh = $(".collapse.in").height();
                $.scrollTo(selected, 500, {
                    offset: -(collapseh)
                });
            });*/
          $(function() {
	$( "#accordion" ).accordion({
		heightStyle: "content",
		collapsible: true,
		active: false,
		activate: function( event, ui ) {
			if(!$.isEmptyObject(ui.newHeader.offset())) {
				$('html:not(:animated), body:not(:animated)').animate({ scrollTop: ui.newHeader.offset().top }, 'slow');
                    }
		}
	});
});
        </script>
       
    </head>
    <body>     
     
    
     
                <div class="row wrap">
                <div class="col-lg-2">
                    
                 </div>
           <div class="col-lg-8">   
              
               <table class="table table-condensed">
                   <tr>
                   <div class="panel-heading title_all text-center"> BlissQuants Products</div> 
                            <div class="panel-body">  At BlissQuants, we have tools and processes to collect and analyze the data. We discover patterns, extract their correlations and other useful information that can be used to make better trading decisions. BlissQuants products are the result of such data analytics.                            </div>
                   </tr>
                  
                   <tr>
                       <td>
                           <a href="#" >  <div class="panel-heading ">BlissCalc <i class="indicator glyphicon glyphicon-chevron-right  pull-right"></i></div></a>
                      <div class="panel-body">BlissCalc is an option strategy generator tool. </div>

                       </td>
                       
                       <td>
                           <a href="#" >   <div class="panel-heading ">BlissVol <i class="indicator glyphicon glyphicon-chevron-right  pull-right"></i></div></a>
                                 <div class="panel-body">BlissVOl is an IV (Implied Volatility) analyzer tool. </div>
                                 
                       </td>
                   </tr>
                   <tr>
                       
                   </tr>
                 
                  
                       
                          
                </table> 
                <div class="col-lg-1">
                    
                 </div>
               
               <div class="col-lg-10 panel-heading title_all text-center"> Product development is in progress...   <br>  <br>
                
                   <div class="panel-body text-center" style = "width:60%;margin-left: 20%">  
                        <br>
                      <div class="progress">
                          
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:75%">
    75%
   </div>
                         
  </div>
</div>
                   <br>
                   
               <span style=""> To know more about BlissQuants products, <a href="BlissAboutUs.php#collapseFive" onclick="location.reload();">Contact us.</a></span>
           </div>
                <div class="col-lg-1">
                    
                 </div>
           </div>
            <div class="col-lg-2">

            </div>
        </div>  
    <!--  <div class="row ">
        <div class="col-lg-3">   </div>
          <!--<div class="panel-group col-lg-6" id="accordion" role="tablist">   
            <div class="panel">
                <a class="collapsed" data-toggle="collapse"  data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  <div class="panel-heading" id="headingOne">
                    <h4 class="panel-title ">        
                        About <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i> 
                    </h4>
                  </div>
               </a>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="sub_name">
          Bliss analyzed Data provides the most important data which Delta hedger needs first thing in the morning. It analyzes earnings’ result and economic events movement and shows stock price impact on event day. It does analysis of India VIX versus Nifty movement. This is helpful for delta hedger to create, modify or exit from the position.<br><br>
          Bliss Implied Volatility is the online tool which gives ATM Implied volatility of the stock. 

It does analysis based on historical volatility of the stock and provides live high and low IV data.

That is helpful for delta hedger to create short and long gamma position.<br><br>

Bliss Calendar is the economic event calendar which helps delta hedger to track events before creating delta position.<br><br>
Bliss Delta Calculator is a standalone off line tool, which will help you to analyze the delta hedging option position. It is the most user friendly, simple and intuitive to use. The key feature is the flexibility to modify existing position in a quick manner. It gives BEP, pay off and chart to get clear understanding of the position.
      </div>
    </div>
  </div>
  <div class="panel">
    <a class="collapsed " data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">       
          Video <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i> 
      </h4>
    </div>
    </a>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="sub_name">
         <div class="container">            
           
                   <iframe class="col-lg-6" src="https://www.youtube.com/embed/-fIZqBAf3Ws" frameborder="0" allowfullscreen></iframe>
                
      </div>
    </div>
  </div>
      </div>
  <div class="panel">
       <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">       
          BlissDelta FAQ    <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>     
      </h4>
    </div>
           </a>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="sub_name">
          <div class="panel-group" id="accordion2" role="tablist">
                            <div class="panel">
                       <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree">
                    <div class="panel-heading" role="tab" id="headingThree">
                      <h4 class="panel-title">
                         What does meant Expected Time in BlissEarningData?
                      </h4>
                    </div>
                           </a>
                    <div id="collapseThree1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                      <div class="sub_name">
                          Expected Time in BlissEarningData is showing time at which result may come.
                          Expected Time is time when last result has been came.So it is our belief that result may come on and around same time only.
                        </div>
                    </div>
                  </div>
          </div>
          
                    <div class="panel">
                       <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree2" aria-expanded="false" aria-controls="collapseThree">
                    <div class="panel-heading" role="tab" id="headingThree">
                      <h4 class="panel-title">
                          Is Implied Volatility in Implied Volatility is of closing price?
                      </h4>
                    </div>
                           </a>
                    <div id="collapseThree2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                      <div class="sub_name">
                          No, Implied Volatility is not calculated by closing price.
                          Implied Volatility in Implied Volatility is calculated 3 times in a day i.e. 10 am, 1 pm, 3pm.
                        </div>
                    </div>
                  </div>
        </div>
    </div>
  </div>
              
               <div class="panel">
       <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
       
          Queries   <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i> 
        
      </h4>
    </div>
           </a>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="sub_name">
           <form class="form-horizontal" role="form" method="post" action="index.php">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="message" class="col-sm-2 control-label">Queries</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="4" name="message"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <input id="submit" name="submit" type="submit" value="Send" class="btn BlissColor">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <! Will be used to display an alert to the user>
        </div>
    </div>
</form>
        </div>
    </div>
  </div>
          
      <div class="col-lg-6">     
          <div id="accordion">
  <h3>About</h3>
  <div>
     Bliss analyzed Data provides the most important data which Delta hedger needs first thing in the morning. It analyzes earnings’ result and economic events movement and shows stock price impact on event day. It does analysis of India VIX versus Nifty movement. This is helpful for delta hedger to create, modify or exit from the position.<br><br>
          Bliss Implied Volatility is the online tool which gives ATM Implied volatility of the stock. 

It does analysis based on historical volatility of the stock and provides live high and low IV data.

That is helpful for delta hedger to create short and long gamma position.<br><br>

Bliss Calendar is the economic event calendar which helps delta hedger to track events before creating delta position.<br><br>
Bliss Delta Calculator is a standalone off line tool, which will help you to analyze the delta hedging option position. It is the most user friendly, simple and intuitive to use. The key feature is the flexibility to modify existing position in a quick manner. It gives BEP, pay off and chart to get clear understanding of the position.
     
  </div>
  <h3>Video</h3>
  <div>
    <p>  <iframe class="col-lg-6" src="https://www.youtube.com/embed/-fIZqBAf3Ws" frameborder="0" allowfullscreen></iframe></p>
  </div>
  <h3>BlissDelta FAQ </h3>
  <div>
    Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui. 
    <ul>
      <li>List item one</li>
      <li>List item two</li>
      <li>List item three</li>
    </ul>
  </div>
  <h3> Queries</h3>
  <div>
    Cras dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia mauris vel est. </p><p>Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
  </div>
</div>
      </div>     
         
        <div class="col-lg-3">   </div>
    </div>-->
             <div id="wrapper1" class="footer1 panel-body">
			
			<?php
                                include 'news_ticker_footer.php';
                        ?>
		</div>
</body>
</html>

<?php
    include("html/footer.html");
?>


