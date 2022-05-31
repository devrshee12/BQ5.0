<!doctype html>
<?php
include("header.php");
include("./db_connect.php");
include_once('register.php');  
 $funObj = new register();  
error_reporting(0);
//echo $_SESSION['user_id'];

?>
 <html>
  <head>
    <title> BlissQuants - Delta Hedging | Fund Management </title>
     <script>
   /* $(function() 
{  
   showdata_daily_vol('TVSMOTOR','chartdiv_vol');
   showdata_daily_vol('ICICIBANK','chartdiv_vol1');
   showdata_daily_vol('ASHOKLEY','chartdiv_vol2');
   showdata_daily_vol('RELIANCE','chartdiv_vol3');
   showdata_daily_vol('COALINDIA','chartdiv_vol4');
   showdata_daily_vol('LICHSGFIN','chartdiv_vol5');
   showdata_daily_vol('HDFCBANK','chartdiv_vol6');
   showdata_daily_vol('POWERGRID','chartdiv_vol7');
   showdata_daily_vol('ADANIENT','chartdiv_vol8');
   alert("dsf");
});*/
    </script>
   
   
   
    <?php if ($_SESSION['plan'] == "FREE") { ?>
            <style>


                .hovereffect .overlay {
                    width:100%;
                    height:100%;
                    position:absolute;
                    overflow:hidden;
                    top:0;
                    left:0;
                    opacity:0;
                    background-color:rgba(0,0,0,0.8);
                    -webkit-transition:all .4s ease-in-out;
                    transition:all .4s ease-in-out; 


                }

                .hovereffect h2 {
                    text-transform:uppercase;
                    color:#fff;
                    text-align:center;
                    position:relative;
                    font-size:17px;
                    background:rgba(0,0,0,0.6);
                    -webkit-transform:translatey(-100px);
                    -ms-transform:translatey(-100px);
                    transform:translatey(-100px);
                    -webkit-transition:all .2s ease-in-out;
                    transition:all .2s ease-in-out;
                    padding:10px;

                }



                .hovereffect:hover .overlay {
                    opacity:1;
                    filter:alpha(opacity=100);

                }

                .hovereffect:hover h2,.hovereffect:hover a.info {
                    opacity:1;
                    filter:alpha(opacity=100);
                    -ms-transform:translatey(0);
                    -webkit-transform:translatey(0);
                    transform:translatey(0);
                }

            </style>
    <?php } else {
    ?>
            <style>


                .hovereffect .overlay {
                    display:none;


                }

            </style>
<?php } ?>

     <style>
        
             #clear_watch{
                display: inline;
            }
            #search2{
                 display: inline;
            }
            #add_watch{
                display: inline;
            }
            #search1{
                 display: none;
            }
   
         span:hover{
             background-color: blue;
         }
         /*   #chartdiv_vol,#chartdiv_vol1,#chartdiv_vol2,#chartdiv_vol3{/*,#chartdiv_vol3,#chartdiv_vol4,#chartdiv_vol5,#chartdiv_vol6,#chartdiv_vol7,#chartdiv_vol8*
	width		: 20%;
       position        :fixed;
      
	height		: 30%;
      border          : 0px solid;
        border-color    : white;
       
	font-size	: 11px;
        background-color: transparent;  
      
       
        }
        #chartdiv_vol5,#chartdiv_vol6,#chartdiv_vol7,#chartdiv_vol4 {/*,#chartdiv_vol3,#chartdiv_vol4,#chartdiv_vol5,#chartdiv_vol6,#chartdiv_vol7,#chartdiv_vol8*
	width		: 20%;
       position        :fixed;
      top:40%;
	height		: 30%;
      border          : 0px solid;
        border-color    : white;
       
	font-size	: 11px;
        background-color: transparent;  
      
       
        }
         #chartdiv_vol10,#chartdiv_vol11,#chartdiv_vol8,#chartdiv_vol9{/*,#chartdiv_vol3,#chartdiv_vol4,#chartdiv_vol5,#chartdiv_vol6,#chartdiv_vol7,#chartdiv_vol8*
	width		:20%;
       position        :fixed;
      top:70%;
	height		: 30%;
      border          : 0px solid;
        border-color    : white;
       
	font-size	: 11px;
        background-color: transparent;  
      
       
        }*/
        
       .table{
             text-align: left;
         }
          .table-bordered{
             border:1px solid transparent;
         }
         .table-bordered > thead > tr > th{
    border:1px solid black;
}
table.table-bordered > tbody > tr > td{
    border:1px solid black;
}
.table-striped>thead>tr:first-child>td, 
.table-striped>thead>tr:first-child>th {
   background-color: rgb(132,194,37);
   font-size: 14px;
   color: blue;
   text-align: center;
   padding: 2px;
   white-space:nowrap;/*width according to table content*/
 }
   /*css resolution setting*/
        @media (min-width: 800px) and (max-width: 1100px) 
        {                
             .nav-pills > li > a{     
                width: 100%;
                background-color:  #474545;
                margin-bottom: 3px;
              color: white!important;
                font-size: 10px;
                text-align: left;    
                -webkit-transition: all .5s ease-in-out;
                -moz-transition: all .5s ease-in-out;     
                }
                 .navbar-nav > li
                 {        
                    background-color: #474545;
                    font-family: bold;
                    margin-left: 0.25%;
                    font-size: 12px;
                 }
                .footer1
                {    
                    position: relative;
                    padding-top: 200px;
                }         
            }
 @media  (min-width: 320px) and (max-width: 800px) { 
              
             .nav-pills > li > a{     
                width: 100%;
                background-color:  #474545;
                margin-bottom: 3px;
              color: white!important;
                font-size: 10px;
                text-align: left;    
                -webkit-transition: all .5s ease-in-out;
                -moz-transition: all .5s ease-in-out;     
                }
                .navbar-nav > li{        
                    background-color: #474545;
                   font-family: bold; 
                    margin-left: 0.25%;
                    font-size: 12px;
                }
      .footer1{    
            position: relative;
            padding-top: 200px;     
      }      
}   
    body {
    overflow-y:scroll;
}
     </style> 
      <script>
        var curr_link;
       
function upgrade_message() {
              
                $('#upgrade_modal').modal('show');
                   
            }
            </script>
  </head>
   <body  onload="run_onload()">   <!-- by default load 1 day data );--> 
        <div class="row wrap">  
  <?php 
  /*if ($_SESSION['plan'] !== "FREE" )
    {*/
  if(isset($_SESSION['user_id']))
  {
       $user_active = $funObj->re_authenticate($_SESSION['email']);  
   if(!$user_active)
   {
        echo "<script>alert('You are logged in to other computer. Please relogin.');  "
                                . "window.location = 'index.php';"
                                        . "</script>";
   }
         ?>
   
          <div id="get_name"></div>
                   <div class="col-lg-12 col-md-12 col-sm-12 text-center "> 
            <br>
            <div class="row title_all" >
                <div class="col-lg-9" ><h3>IV Chart Watchlist</h3></div>
                 <div class="col-lg-3" id="iv_title">
                     <input class="form-control control_color_1" id="search1" name="search" autocomplete="off" placeholder="Search for " onKeyUp ="range_sel('IV_vol_connect.php');" required>
                       
                     
                     <ul class="nav nav-tabs" style="border:none">                   
             
                <li c><form class="form-inline" role="form"> 
                        
                        <div class="input-group">
                            <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                           
                        </div>

                    </form> </li>
             <!--   <li id="type"><form class="form-inline" style="display:none" role="form"> 
                        <span style="color:  rgb(132,194,37);"> Select chart type: </span>
                        <span class=" form-control control_color_1">
                            <input type="radio" name="type" value="line" onclick="setType(this.value);" checked="checked" /> Line
                        </span>
                        <span class="form-control control_color_1">
                            <input type="radio" name="type" value="column" onclick="setType(this.value);" /> Column
                        </span>
                    </form>
                </li>-->
               
                <li >
                   <select id="search2" name="search2" class="form-control control_color_1 selectpicker " placeholder="Search Scrip" onchange="reload_data()" data-live-search="true">
                                <option placeholder="Search Scrip" value = ""> Select Stock</option>         
 <?php
                                         $sql_all_companies = "SELECT c_name FROM `companies`";
                                                $result_all_companies = mysqli_query($con, $sql_all_companies);
                                                //$all_company = mysqli_fetch_array($result_companies);
                                                while ($row = mysqli_fetch_array($result_all_companies)) {

                                                               echo "<option data-tokens='".$row['c_name']."'>".$row['c_name']."</option>";
                                                            }
                                        
                                        ?>
                                           
                                          
                                          </select>   
                </li>
                   <?php if ($_SESSION['plan'] !== "FREE") { ?>
                <li>
                        <button class="btn btn-default control_color_1" id="add_watch" onclick="add_to_eye('yes')" >  <i class="fa fa-plus-square" aria-hidden="true"></i></button>
                    </li>
                   <li>
                        <button class="btn btn-default control_color_1" id="clear_watch" onclick="add_to_eye('no')" ><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                    </li>
                 <?php } else { ?>
                 <li>
                        <button class="btn btn-default control_color_1" id="add_watch" onclick="upgrade_message()" >  <i class="fa fa-plus-square" aria-hidden="true"></i></button>
                    </li>
                   <li>
                        <button class="btn btn-default control_color_1" id="clear_watch" onclick="upgrade_message()" ><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                    </li>
               <?php } ?>   
            </ul> 
                 
                 </div>    
                    </div>   
            
         
            
            

        </div>
       <?php  if ($_SESSION['plan'] !== "FREE") { ?>           
         <div class="row">
  <div class="col-xs-4 col-md-4 col-lg-4"> <div id="chartdiv_vol" style="width:400px;height:300px;"></div>   </div>
  <div class="col-xs-4 col-md-4 col-lg-4"><div id="chartdiv_vol1" style="width:400px;height:300px;"></div></div>
  <div class="col-xs-4 col-md-4 col-lg-4"><div id="chartdiv_vol2"   style="width:400px;height:300px;"></div></div>
 
  
         </div> 
          <div class="row">
                <div class="col-xs-4 col-md-4 col-lg-4"> <div id="chartdiv_vol3" style="width:400px;height:300px;"></div>   </div>
 <div class="col-xs-4 col-md-4 col-lg-4"  ><div id="chartdiv_vol4" style="width:400px;height:300px;"></div></div>
  <div class="col-xs-4 col-md-4 col-lg-4"><div id="chartdiv_vol5" style="width:400px;height:300px;"></div></div>
 
  
 </div>
           <div class="row">
                <div class="col-xs-4 col-md-4 col-lg-4"> <div id="chartdiv_vol6" style="width:400px;height:300px;"></div>   </div>
  <div class="col-xs-4 col-md-4 col-lg-4"><div id="chartdiv_vol7" style="width:400px;height:300px;"></div></div>
 <div class="col-xs-4 col-md-4 col-lg-4"><div id="chartdiv_vol8" style="width:400px;height:300px;"></div></div>
  
  
</div>
            <div class="row">
  <div class="col-xs-4 col-md-4 col-lg-4"> <div id="chartdiv_vol9" style="width:400px;height:300px;"></div> </div>
  <div class="col-xs-4 col-md-4 col-lg-4"><div id="chartdiv_vol10" style="width:400px;height:300px;"></div></div>
  <div class="col-xs-4 col-md-4 col-lg-4"><div id="chartdiv_vol11" style="width:400px;height:300px;"></div></div>
</div>
           <?php   } else { ?>
           <div class="">
           <div class="row ">
  <div class="col-xs-3 col-md-3 col-lg-3"> <div id="chartdiv_vol"></div>     </div>
  <div class="col-xs-3 col-md-3 col-lg-3"><div id="chartdiv_vol1"></div></div>
  <div class="col-xs-3 col-md-3 col-lg-3"><div id="chartdiv_vol2"></div></div>
   <div class="col-xs-3 col-md-3 col-lg-3"> <div id="chartdiv_vol3"></div>   </div>
  
         </div> 
          <div class="row">
 <div class="col-xs-3 col-md-3 col-lg-3"><div id="chartdiv_vol4"></div></div>
  <div class="col-xs-3 col-md-3 col-lg-3"><div id="chartdiv_vol5"></div></div>
  <div class="col-xs-3 col-md-3 col-lg-3"> <div id="chartdiv_vol6"></div>   </div>
  <div class="col-xs-3 col-md-3 col-lg-3"><div id="chartdiv_vol7"></div></div>
  
 </div>
                <div class="row">
 <div class="col-xs-3 col-md-3 col-lg-3"><div id="chartdiv_vol8"></div></div>
   <div class="col-xs-3 col-md-3 col-lg-3"> <div id="chartdiv_vol9"></div> </div>
  <div class="col-xs-3 col-md-3 col-lg-3"><div id="chartdiv_vol10"></div></div>
  <div class="col-xs-3 col-md-3 col-lg-3"><div id="chartdiv_vol11"></div></div>
  
</div>
              
               </div>
             <?php } ?>
 

    
    
     
         
       <?php
        }
      else
      {
         echo " <div class='col-lg-12 panel-heading text-center'> To access this product, you need to    <a href='#' data-toggle='modal' data-target='#Register-modal'>Register</a>/
                        <a href='#' data-toggle='modal' data-target='#login-modal'>Login</a>  . <br> </div></div>";
      }
      /*}else{
             echo " <div class='col-lg-12 panel-heading text-center'> This facility is not available in the basic plan. <a href='BlissPricing.php'> Please upgrade your IV analytics plan. </a>
                       </div></div>";
        }*/
      
      ?>
           </div>
       <div class="modal fade " id="upgrade_modal" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <img src="blissquant2.jpg" alt="Bliss Image" >
            </div>
            <div class="modal-body ">

                <div class="panel-heading title_all text-center">  Note  </div>     


                <h4> Please Upgrade your plan: <a class="btn btn-success" href="BlissPricing.php" > Upgrade </a> </h4>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
        </body>
       
</html>  
          <?php
include("html/footer.html");    
 
?>
        <script src="js/jquery-ui.js"></script>    
        
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
                   
      <script type="text/javascript" src="amstockchart/amcharts/amcharts.js"></script>
    <script type="text/javascript" src="amstockchart/amcharts/serial.js"></script>    
     <script type="text/javascript" src="amstockchart/amcharts/light.js"></script>    
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">    
    <script src="js/dateformat.js"></script>
    <script src="js/BlissEye.js"></script>     