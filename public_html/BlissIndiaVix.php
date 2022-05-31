<?php
include("header.php");
//include 'newsticker_read.php';
date_default_timezone_set('Asia/Kolkata');
 $day=date('D');
  $current_date = date('H:i');
?> 
<html>
    
    <head>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="amstockchart/amcharts/amcharts.js"></script>
        <script type="text/javascript" src="amstockchart/amcharts/serial.js"></script>        
        <script src="js/dateformat.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css" /><!-- for datepicker UI--->       
        <script src="js/BlissIndiaVix2.js"></script>        
        
         <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css" />
         <link href="css/BlissIndiaVix.css" rel="stylesheet">
           <style>
              .nav-tabs{    
    margin-left: 0%;   
    border: none;
    height: 38px;
   
    }
   .nav-tabs > li > a{      
     width: 100%;
    background-color: #474545;
    margin-bottom: 3px;
    border-radius: 0;
    color: white;
    font-size: 14px;
    text-align: center;
    border: none; 
    height: 38px;
    }
    li > a.active{
        background-color: rgb(132,194,37);
        height: 38px;
    }
         </style>
    </head>
    <body >      
               
          <div class="row wrap">
                 <div class="col-lg-2 col-md-2 col-sm-2">
                    
                </div>
             <div class="col-lg-8 col-md-8 col-sm-8 ">    
                  <div class="row title_all text-center" >
               VIX -  Volatility Index 
               <span  class="small_font pull-right" id="vix_update"></span>
            </div>
                 <div class=" bliss-data-menu text-right">
                   <ul class="nav nav-tabs" role="tablist">
                       <li class="active"><a href="BlissIndiaVix.php"  role="tab" data-toggle="tab">IndiaVIX v/s Nifty</a></li>
                       <li class="inactive"><a href="cboe_vix.php">IndiaVIX v/s CBOE VIX(USA)</a></li>
                       <li>
                       <form class="form-inline text-center" role="form">  
				<div class="input-group input-group-lg  control_color_1" >
                <div class="input-group-btn" id="b1_vq">                       
                    <input type='button' class="form-control control_color_1" name='b1'  onclick="range_sel_vq(this.value)" value="<<" >                        
                </div> 
                <div class="input-group-btn" id="range_text_vq">                       
                    <input type='text' class="form-control control_color_1" size="10"   name='range1' id='day1_vq' placeholder="From"  >  -                      
                </div>              
                <div class="input-group-btn">                      
                    <input type='text' class="form-control control_color_1" size="10"  name='range2' id='day2_vq' placeholder="To" >                        
                </div>  
                <div class="input-group-btn" id="b2_vq">                       
                    <input type='button' class="form-control control_color_1" name='b2' onclick="range_sel_vq(this.value)" value=">>">                        
                </div>
                <div class="input-group-btn" id="b3_vq">                       
                    <input type='button' class="form-control control_color_1" name='b3'  onclick="range_sel_vq(this.value)" value="Go">                        
                </div>
                <div class="input-group-btn"> 
                    <select name="range" class="form-control control_color_1"  onchange="range_sel_vq(this.value)"  id="range_vq">  
                       <option value="week" >Week</option>
                       <option value="month" > Month</option>
                       <option value="year" selected="selected">Year</option>
                       <option value="range">Range</option>
                    </select>
                </div>
                  </div> 
                        </form>
                       </li>
                   </ul>      
                    
               </div>
           
            
            <div id="chartdiv2" ></div>   
            
            </div>
               <div class="col-lg-2">
               
            </div>
         
                             </div>      
        
    </body>
</html>
<?php
include("html/footer.html");
?>