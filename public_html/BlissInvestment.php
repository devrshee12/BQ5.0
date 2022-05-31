<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
 <?php
        include("./header.php");
   
        ?>
<html>
    <head>
        <title>Bliss Earnings</title>   
          <script type="text/javascript" language="javascript" src="bootstrap-3.3.4-dist/js/jquery.carouFredSel-6.0.4-packed.js"></script>
         <script type="text/javascript" language="javascript" src="bootstrap-3.3.4-dist/js/news-ticker.js"></script>
         <style>
              #myModal4{
                      top:5%;
                     // width: 35%;
              }
              /* .modal-body1 is use to remove scrolling from body as we r useing  in every modal in footer */
               .modal-body1{
                 text-align: left !important;
                  max-height: calc(80vh ) !important;
                   overflow-y: auto;
	 
}
                input[type="button"]:disabled {
                    background: #dddddd;
                    color: black;
                }
                  .blinker{
                        font-family: 'Verdana','Open Sans';
                        font-size: 20px;
                        color:rgb(132,194,37);
                        animation: changecolor 7s infinite;

                        -moz-animation: changecolor 7s infinite; 
                        -webkit-animation: changecolor 7s infinite;
                        -ms-animation: changecolor 7s infinite; 
                        -o-animation: changecolor 7s infinite; 
                }
 
@keyframes changecolor
{
25%   {color: white;}
50%  {color:rgb(132,194,37);}
75%  {color: #417CA7;}
100%  {color:rgb(132,194,37);}
}
/* Mozilla Browser */
@-moz-keyframes changecolor 
{
25%   {color: white;}
50%  {color:rgb(132,194,37);}
75%  {color: #417CA7;}
100%  {color:rgb(132,194,37);}
}
/* WebKit browser Safari and Chrome */
@-webkit-keyframes changecolor 
{
25%   {color: white;}
50%  {color:rgb(132,194,37);}
75%  {color: #417CA7;}
100%  {color:rgb(132,194,37);}
}
/* IE 9,10*/
@-ms-keyframes changecolor 
{
25%   {color: white;}
50%  {color:rgb(132,194,37);}
75%  {color: #417CA7;}
100%  {color:rgb(132,194,37);}
}
         </style>
         <script  type="text/javascript" language="javascript">
              $(document).ready(function(){
          $("#download").click(function () {
         document.getElementById('agree').checked = false;
          document.getElementById('download').disabled=true;
         $("#myModal4").modal('hide');
         });
       });
        function apply()
                {
                 document.getElementById('download').disabled=true;
                if(document.getElementById('agree').checked==true)
                {
                document.getElementById('download').disabled=false;
                }
                if(document.getElementById('agree').checked==false)
                {
                 document.getElementById('download').enabled=false;
                }
                }
      
         </script>
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
                         <li ><a href="BlissCoach.php"  >BlissDelta</a></li>
                         <li><a href="BlissInvestment.php" class="active">BlissFund</a></li>
                        <li ><a href="BlissCall.php">BlissCall</a></li>                    
                      
                        <li><a href="BlissKB.php">BlissBlog</a></li>
                        <li><a href="BlissFAQ.php" >FAQ</a></li>                    
                     </ul>
                         </div>
                 </div>
               <div class="col-lg-8 col-md-8 col-sm-8">   
             <!--  <div class="title_all text-center">
                   <span style="padding-right: 30px"> BlissFund   </span>   <small style="color:white">We manage fund based on our BlissQuants data</small>
                   
               </div>
               <div>
                    <table  class="table table-striped table-condensed">
          <thead>
               <tr>                
                    <td class="tr1" align="center">Product </td>
                    <td class="tr1" align="center">Description</td>
                    <td class="tr1" align="center">Duration
                        (Minimum)</td>
                    <td class="tr1" align="center">Risk-Reward</td>
                  <!--  <td class="tr1" align="center">Investment</td>
                  
                </tr> 
                 <tr >                
                    <td >BlissBroth</td>
                    <td >BlissBroth is a short term delivery based trading system. Based on fundamental research and technical analysis, entry and exit are decided for stocks. It works on 6-8 stocks.</td>
                    <td >1 year</td>
                    <td >LR-LR</td>
                           
                </tr>
                <tr >                
                    <td> BlissStock</td>
                    <td >BlissStock is a medium term delivery based system. It is based on fundamental research and technical trend analysis. It works on 20-25 stocks. </td>
                    <td >3 years</td>
                    <td >LR-MR</td>
               
                </tr>  
                <tr >                
                   <td>BlissWave</td>
                    <td>BlissWave is a medium term trading system. It is a volume based trading in futures with necessary option hedging techniques.</td>
                    <td>1 year</td>
                    <td>HR-HR</td>
            
                    
                </tr> 
                 <tr >                
                    <td >BlissOpus</td>
                    <td >BlissOpus is a trend following system in 10 midcap scrips. It has always position in either long or short. </td>
                    <td >3 years</td>
                    <td >MR-MR</td>
               
                  
                </tr> 
               
                <tr >                
                    <td >BlissIndex</td>
                    <td >BlissIndex is a short term trend following in Indices. It considers necessary hedging techniques too.</td>
                    <td >3 years</td>
                    <td >MR-MR</td>
                   <!-- <td >6L</td>
                   
                </tr>
               
                        
          </thead>
       </table> 
             
               </div>
             
                                
      
         
          <div class="row sub_name">
          
           
            <div class="col-lg-4 text-left"> 
                <table class="table table-condensed">      
              
                    <tr><td>Low Risk (LR):</td><td>10 to 20% Downside</td></tr>
                    <tr><td>Medium Risk (MR):</td><td>20 to 35% Down side</td></tr>
                    <tr><td>High Risk (HR):</td><td>Up to 40% down side</td></tr>
              
                </table>
            
  
            </div>
              <div class="col-lg-4 text-left"> 
                 <table class="table table-condensed" >                
                     <tr><td>Low Reward (LR):</td><td>Up to 70%</td></tr>
                    <tr><td>Medium Reward (MR):</td><td>Up to 100%</td></tr>
                    <tr> <td>High Reward (HR):</td><td>Up to 200%</td></tr>
          
                </table>
              </div>
              *Reward is calculated over a period of three years. <br>
          </div>-->
             
              <div class="title_all text-center">
                  <span style="padding-right: 30px"> BlissFund   </span>   <small style="color:white">We trade based on BlissQuants data</small>
               </div>
             
                    <table class="table table-condensed">
                  <tr>
                  
                   <div class="panel-body">  In today's intricate and volatile market stock investment requires constant monitoring and attention. It’s not wise to remain just hopeful on stock investment for a long term. There is a need to have right exit for any stock entry. Also due to complex nature of market, it is an essential to have trading process which can create a wealth in bullish, bearish or sideways market. It means there are ways to create a wealth by trading both ways- long and short, and taking accurate pause and exit.
                       <br><bR>
BlissFund is an endeavor specially designed to enhance the wealth of investors in limited segments. The service is primarily focused on disciplinary trading with strict controlled over loss. The persistent presence is a key to succeed in the capital market. We have taken this as a mantra while designing our trading systems. <a href="#" data-toggle="modal" data-target="#myModal4"> <span class="blinker">Open an account with us.</span></a> 

  
 <br><br>

For further inquiry, <a href="BlissAboutUs.php#collapseFive" onclick="location.reload();"> contact us.</a> 

</div>
                   </tr>
                 <!--  <tr>
                       <td>
                            <div class="panel-heading">BlissBroth</div>
                           <div class="sub_name">
                               BlissBroth is a short term delivery based trading system. Based on fundamental research and technical analysis, entry and exit are decided for stocks. It works on the principle of low risk low reward. It is recommended to stay minimum one year in this process.
                           </div>

                       </td>
                             <td>
                            <div class="panel-heading ">BlissWave </div>
                                   BlissWave is a medium term trading system. It is a volume based trading in futures with necessary option hedging techniques. It works on the principle of high risk high reward. It is recommended to stay minimum two years in this process. 
                                                        
                       </td>
                       <td>
                            <div class="panel-heading ">BlissOpus </div>
                                   BlissOpus is a trend following system in midcap scrips. It has always position in either long or short or predefined pause. It works on the principle of medium risk medium reward. It is recommended to stay minimum three years in this process. 
                                                        
                       </td>
                       <td>
                            <div class="panel-heading ">BlissIndex </div>
                                                           BlissIndex is a short term trend following system in Indices. It considers necessary hedging techniques too. It works on the principle of medium risk medium reward. It is recommended to stay minimum three years in this process.                  
                       </td>
                   </tr>-->
                   <tr>
                      
                   </tr>
               </table>
               </div>
                <div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
            <img src="blissquant2.jpg" alt="Bliss Image" >
        </div>
        <div class="modal-body modal-body1">
          
        <div class="panel-heading title_all text-center">Download  KYC form.  </div>     



You agree and understand that the information and material contained in the KYC form of Market-Hub Stock Broking Pvt. Ltd. is property of Market-Hub Stock Broking Pvt. Ltd. 
The content of the KYC Form cannot be copied, reproduced, republished, uploaded, posted, transmitted or distributed for any non-personal use without obtaining prior permission from Market-Hub Stock Broking Pvt. Ltd. 
Also Market-Hub Stock Broking Pvt. Ltd. not agree & nor acknowledge any information displayed on the website from where you are downloading our KYC Form & Market-Hub Stock Broking Pvt. Ltd. reserve the right to terminate the accounts of subscribers/customers or visitors, who violate the proprietary rights, in addition to necessary legal action.  
<br><br>
If you do not agree to any of the terms mentioned in this agreement, you should exit the download the KYC Form.

<br><br>
<h5><input type="checkbox" id="agree" name="agree" onClick="apply()" id="agree" >I agree terms and condition.</h5>
                   
         
</div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href="https://www.markethubonline.com/Upload/635707565874091250_Individual%20KYC_March%2015.pdf" target="_blank" ><input type="button" name="download" class="btn btn-default" id="download" value=" Download Form "  disabled  /></a>
        </div>
      </div>
    </div>
       </div>
               
              
       
          
                
               
            <div class="col-lg-2">
                
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



