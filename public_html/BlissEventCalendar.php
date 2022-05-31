<!doctype html>
<?php
include("header.php");
//include 'newsticker_read.php';
date_default_timezone_set('Asia/Kolkata');
 $day=date('D');
  $current_date = date('H:i');
    //  include("session_check.php");
 //include("html/BlissEventCalendar.html");    
        ?>
 <html>
  <head>
    <title> BlissQuants - Delta Hedging | Fund Management </title>
    <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">
   <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
   <script src="js/jquery-ui.js"></script>
    <script src="js/dateformat.js"></script>
    <script src="js/script.js"></script>
       <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
     <script src="js/BlissEventCalendar.js"></script>
   
       
      <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">      
       <link rel="stylesheet" type="text/css" href="css/BlissEventCalendar.css" />
     <style>
         .tab-pane{
             background-color: transparent !important;             
         }
         
     
    /*     .nav-tabs > li.active > a,
.nav-tabs > li.active > a:focus{
    background-color: transparent  !important;
    color: white;
}
.nav-tabs{
    border:none;
}*/
   
/*.btn-default:hover{
    background-color: #84C225 !important;
    color: black !important;  
}
.btn-default:active{
   background-color: #84C225 !important;
}*/
     </style>  
  </head>
    <body >   
     
        <div class="row wrap">
           
              <div class="col-lg-2 col-md-2 col-sm-2">
                
                 </div>
            
               
<div class="col-lg-8 col-md-8 col-sm-8 text-center "> 
    <div class="row title_all text-center " >
                Economic event calender
               <span  class="blink small_font pull-right" id="event_update"></span>
            </div>
            <label class="btn btn-default">
                <a href="#tab_default_1" data-toggle="tab" > Calender </a>
            </label> 

            <label class="btn btn-default">
                <a href="#tab_default_2" data-toggle="tab"> Table </a>
            </label> 
             

    
      
        <div class="tab-content">
            <div class="tab-pane active col-lg-10 col-lg-offset-1 " id="tab_default_1">
                <div class="text-center col-lg-8 col-lg-offset-2" id="wall">
                        <div id="calendar"><!--  Dynamically Filled --></div>
                        <div class="square today"></div>  Today
                        <div class="square BlissColor"></div>Events 
                        <div class="square Holiday"></div> Market Holidays        
                </div>
            </div>
            <div class="tab-pane col-lg-8 col-lg-offset-2" id="tab_default_2">
                <form class="form-inline" role="form">    
						<div class="input-group">
					 <div class="input-group-btn" id="b1">                       
                            <input type='button' class="form-control control_color_1" name='b1' onclick="range_sel(this.value)" value="<<" >                        
                        </div>             
                      <div class="input-group-btn" id="range_text">                       
                                    <input type='button' class="form-control control_color_1" size="30" name='day' id='day1'   readonly>       -                 
                               </div>  
                        <div class="input-group-btn">                            
                                    <input type='button' class="form-control control_color_1" size="30" name='day' id='day2'   readonly>                        
                               </div>   
                        <div class="input-group-btn" id="b2">                       
                                    <input type='button' class="form-control control_color_1"  name='b2' onclick="range_sel(this.value)" value=">>">                        
                               </div>   
                        
                        <div class="input-group-btn">     
                            <select name="range" class="form-control control_color_1" onchange="range_sel(this.value)" id="range">                    
                            <option value="today" >Today</option>
                            <option value="week" selected="selected">Week</option>
                            <option value="month"> Month</option>
                            <!-- <option value="range">Range</option>-->
                            </select>
                        </div>
						</div>
                </form>     
              <div >            
                <table id="eventcalander-grid"  cellpadding="0" cellspacing="0" border="0" class=" table table-striped text-center ex1  " width="100%">
                    <thead>
                        <tr>
                            <th>Date/Time(IST)</th>
                            <th>Event</th>
                        </tr>
                    </thead>
                </table>
            </div> 
            </div>
        </div>


          <!--   <form class="form-inline" role="form">    
                      <div class="form-group" id="b1">                       
                            <input type='button' class="form-control control_color_1" name='b1' onclick="range_sel(this.value)" value="<<" >                        
                        </div>             
                      <div class="form-group" id="range_text">                       
                                    <input type='text' class="form-control control_color_1" size="30" name='day' id='day1'   readonly>       -                 
                               </div>  
                        <div class="form-group">                            
                                    <input type='text' class="form-control control_color_1" size="30" name='day' id='day2'   readonly>                        
                               </div>   
                        <div class="form-group" id="b2">                       
                                    <input type='button' class="form-control control_color_1"  name='b2' onclick="range_sel(this.value)" value=">>">                        
                               </div>   
                        
                        <div class="form-group">     
                            <select name="range" class="form-control control_color_1" onchange="range_sel(this.value)" id="range">                    
                            <option value="today" >Today</option>
                            <option value="week" selected="selected">Week</option>
                            <option value="month"> Month</option>
                      
                            </select>
                        </div>
             </form>     
              <div >            
                <table id="eventcalander-grid"  cellpadding="0" cellspacing="0" border="0" class=" table table-striped text-center" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Expected Time</th>
                            <th>Event</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
             <div class="col-lg-5 text-center" id="wall">
                        <div id="calendar">/div>
                        <div class="square WhiteColor"></div>  Today
                        <div class="square BlissColor"></div> Upcoming Events 
                        <div class="square OldEvent"></div> Old Events
                        <div class="square Holiday"></div> Market Holidays        
                </div>-->
        </div>
              <div class="col-lg-2">
              <!--  <div class="ticker ">
                    <h3>Market Today<br><span class="h3"><?php echo $datetime; ?></span></h3>
                   <ul id="ticker">
                     
                      <li><span class="span">Sensex:</span><span style="<?php if($current_date < '09:15' || $current_date > '15:30' || $day == 'Sat'   || $day == 'Sun')echo "color:grey"?><?php if($sensex_change<0)echo "color:#ff0000"?><?php if($sensex_change >0)echo "color:#07DA0F"?>"><?php echo $sensex."&nbsp;&nbsp;(".$sensex_change; ?></span>
                        <br><br><span class="span">Nifty:</span><span style="<?php if($current_date < '09:15' || $current_date > '15:30' || $day == 'Sat'   || $day == 'Sun')echo "color:grey"?><?php if($nifty_change<0)echo "color:#ff0000"?><?php if($nifty_change >0)echo "color:#07DA0F"?>"><?php echo $nifty1."&nbsp;&nbsp;(".$nifty_change; ?></span>
                        <br><br><span class="span">BankNifty:</span><span style="<?php if($current_date < '09:15' || $current_date > '15:30' || $day == 'Sat'   || $day == 'Sun')echo "color:grey"?><?php if($banknifty_change<0)echo "color:#ff0000"?><?php if($banknifty_change >0)echo "color:#07DA0F"?>"><?php echo $banknifty."&nbsp;(".$banknifty_change; ?></span>
                        <br><br><span class="span">India VIX:</span><span style="<?php if($current_date < '09:15' || $current_date > '15:30' || $day == 'Sat'   || $day == 'Sun')echo "color:grey"?><?php if($indiavix_change<0)echo "color:#ff0000"?><?php if($indiavix_change >0)echo "color:#07DA0F"?>"><?php echo $indiavix."&nbsp;&nbsp;(".$indiavix_change; ?></span></li>
                         <li><span class="span">Gainers (≥+5%):-</span><br> <span style="<?php if($current_date < '09:15' || $current_date > '15:30' || $day == 'Sat'   || $day == 'Sun')echo "color:grey"?>color:#07DA0F"><?php echo $uppercircuit; ?></span></li>
                         <li><span class="span">Losers (≤-5%):-</span><br> <span style="<?php if($current_date < '09:15' || $current_date > '15:30' || $day == 'Sat'   || $day == 'Sun')echo "color:#939393"?>color:#ff0000"><?php echo $lowercircuit; ?></span></li>
                          <li><span class="span">52 week High:</span><br><span style="<?php if($current_date < '09:15' || $current_date > '15:30' || $day == 'Sat'   || $day == 'Sun')echo "color:grey"?>color:#07DA0F"><?php echo $wkhigh1; ?></span></li>
                          <li><span class="span">52 week low:</span><br><span style="<?php if($current_date < '09:15' || $current_date > '15:30' || $day == 'Sat'   || $day == 'Sun')echo "color:#939393"?>color:#ff0000"><?php echo $wklow1;?></span></li>
                        <li><span class="span">Life time high:</span><br><span style="<?php if($current_date < '09:15' || $current_date > '15:30' || $day == 'Sat'   || $day == 'Sun')echo "color:grey"?>color:#07DA0F"><?php echo $lifetimehigh; ?></span></li>
                        <li><span class="span">Life time low:</span><br><span style="<?php if($current_date < '09:15' || $current_date > '15:30' || $day == 'Sat'   || $day == 'Sun')echo "color:grey"?>color:#ff0000"><?php echo $lifetimelow; ?></span></li>
                        <li><span class="span">Security in ban period:</span><br><?php echo $securityban; ?></li>
                        <li><span class="span">Company result:</span><br><?php echo $company; ?></li>
                        <li><span class="span">Economic event:</span><br><?php echo $event; ?></li>
                       
                    </ul>
                </div>-->
            </div>
        </div>
    </body>
</html>

<?php
include("html/footer.html");    
?>


