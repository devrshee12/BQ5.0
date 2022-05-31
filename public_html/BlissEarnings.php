<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
 <?php
        include './header.php';
          include './db_connect.php';
      ?> 
<html>
    <head>
        <title>Bliss Earnings</title>   
         <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
             <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css">
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">  <script src="js/dateformat.js"></script>   
		  <script language="JavaScript" src="js/BlissEarnings.js" type="text/javascript"></script>
                  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
                  <script type="text/javascript" language="javascript" src="bootstrap-3.3.4-dist/js/jquery.carouFredSel-6.0.4-packed.js"></script>
       
                <script type="text/javascript" src="amstockchart/amcharts/amcharts.js"></script>
           <script type="text/javascript" src="amstockchart/amcharts/serial.js"></script>
           <script type="text/javascript" src="amstockchart/amcharts/themes/light.js"></script>
            <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css" />
        <style>
     #chartdiv {
	width		: 55%;
        position        :fixed;
        z-index         : 10; 
	height		: 60%;
        left            : 20%;
        top             : 20%;
        border          : 5px solid;
        border-color    : white;
	font-size	: 11px;
        background-color: rgb(58, 53, 49);  
        display: none;
        }
         .table-bordered > thead > tr > th{
                border:1px solid black;
            }
            table.table-bordered > tbody > tr > td{
                border:1px solid black;
                text-align: center;
            }
           
        
</style>       
    </head>
     <body>         
            <div class="row wrap">
                <div class="col-lg-2 col-md-2 col-sm-2">
                
                 
                 </div>
                
           <div class="col-lg-9 col-md-9 col-sm-9 text-center">   
               <div class="row title_all text-center">
              Analysis of companies’ result impact on stock price
               <span  class="small_font pull-right" id="earning_update"></span>
            </div>
               <form class="form-inline text-center" role="form">  
               
                    <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH --
                            <input id="search1" name="search" class="form-control control_color_1" onKeyUp ="range_sel(this.value);" placeholder="Search for" >-->
                      <select id="search1" name="search" class="form-control control_color_1 selectpicker " placeholder="Search Scrip" onchange="range_sel(this.value)" data-live-search="true">
                              <option placeholder="Search Scrip" value = ""> Select Stock</option>  
                                        <?php
                                        $sql_all_companies = "SELECT c_name FROM `companies`";
                                        $result_all_companies = mysqli_query($con, $sql_all_companies);
                                        //$all_company = mysqli_fetch_array($result_companies);
                                        while ($row = mysqli_fetch_array($result_all_companies)) {

                                            echo "<option data-tokens='" . $row['c_name'] . "'>" . $row['c_name'] . "</option>";
                                        }
                                        ?>


                                        </select>
                        <div class="input-group input-group-lg control_color_1">      
                     <div class="input-group-btn " id="b1">                       
                         <input type='button' class="form-control control_color_1" name='b1' onclick="range_sel(this.value)" value="<<" >                        
                     </div>                
                     <div class="input-group-btn " id="range_text">                       
                         <input type='text' size="15" name='day' id='day1' class="form-control control_color_1" placeholder="From"  > -                 
                     </div>   
                     <div class="input-group-btn ">                       
                              <input type='text' size="15" class="form-control control_color_1"  name='day' id='day2' placeholder="To"  >                        
                     </div>     
                     <div class="input-group-btn" id="b2">                       
                         <input type='button' class="form-control control_color_1" name='b2' onclick="range_sel(this.value)" value=">>">                        
                     </div>
                     <div class="input-group-btn" id="b3">                       
                         <input type='button' class="form-control control_color_1" name='b3' onclick="range_sel(this.value)" value="Go">                        
                     </div>
                     <div class="input-group-btn"  width="100%"> 
                         <select name="range" onchange="range_sel(this.value)" class="form-control control_color_1" id="range">                    
                             <option value=""></option>
                             <option value="today" >Today</option>
                             <option value="week" selected="selected">Week</option>
                             <option value="month"> Month</option>
                              <option value="range">Range</option>
                         </select>
                     </div>
                            </div>
             </form>
	<div >
            
			<table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class=" table table-striped  table-bordered text-center" width="100%">
					<thead>
						<tr>
							<th>Company name</th>
							<th>Date</th>
							<th>Time(IST)</th>
							<th>Change(%)</th>
                                                        <th>Movement (Min - Max(%))<br>Result day changes</th>
                            <th>Chart</th>
						</tr>
					</thead>
			</table>
		</div>
	
	      <div id="chartdiv" ></div>	
		 
            
           </div>
                
              <div id="wrapper1" class="footer1 panel-body">
			
			<?php
                              //include 'news_ticker_footer.php';
                        ?>
		</div>
 </div>   
                 <?php
 include ("./html/footer.html");
        ?>
               
                 
            
         
      
</body>
</html>



