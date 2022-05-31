<?php
include("header.php");
$con=mysqli_connect("localhost","root","","bliss_vol_all"); 
?>
<html>
    <head>
    
<link href="css/BlissVol.css" rel="stylesheet">    
    <script src="js/jquery-ui.js"></script>    
      <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">
               
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
                   <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
     <script type="text/javascript" src="amstockchart/amcharts/amcharts.js"></script>
    <script type="text/javascript" src="amstockchart/amcharts/serial.js"></script>    
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">    
    <script src="js/dateformat.js"></script>
    <script src="js/BlissIVHighLow.js"></script>     
    
     <style>
         .tab-pane{
             background-color: transparent !important;             
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
   
     </style>  
  </head>
    <body>   
      <body  onload="range_sel('week');">   <!-- by default load 1 day data -->  
      <div class="row wrap">    
      <div id="chartdiv_vol"></div>
      
           
             <div class="col-lg-2 col-md-2 col-sm-2">
           <div class="navbar-header">
                        <button type="button" class="navbar-toggle  btn-lg" data-toggle="collapse" data-target=".bliss-data-menu">
                            <span class="title_all">Data-Menu</span><span class="glyphicon glyphicon-th"></span>
                        </button>
                    </div> 
           <div class="bliss-data-menu">
             
                <ul class="nav nav-stacked nav-pills">                  
                    <li><a  href="BlissIVHighLow.php" class="active">Implied Volatality</a></li> 
                    <li><a href="get_collar.php">Live Strategy</a></li>
                    <li><a  href="Bliss_Daily_Data_Display.php">Daily M2M</a></li>
                    <li><a href="Imbalance_vol_spread.php" >Extra</a></li>
                </ul>  

           </div>
      </div>
            
               
<div class="col-lg-9 col-md-9 col-sm-9 text-center "> 
    
             <span  class="small_font pull-right" id="last_update" style="color:white"></span>
          
            
     <ul class="nav nav-tabs">
        <li > <a href="BlissIVHighLow.php" > High Vol </a></li>
         <li > <a href="BlissIVlowhigh.php" > Low Vol </a></li>
        
          <li> <a href="Intraday_IV.php" > Intraday ATM </a></li>
           <li  > <a href="IV.php" > BlissVOL </a></li>
           <li> <a href="BlissDelta_Data.php" > Delta Dashboard </a></li>
             <li > <a href="IV_filter.php" > F1L </a></li>
            <li  > <a href="f2_iv.php" > F2H </a></li>
             <li > <a href="F3R.php" > F3R </a></li>
            <li  > <a href="F4E.php" > F4E </a></li>
             <li class="active" > <a href="NiftyBN_strikes.php" > NBN </a></li>
     </ul>

            
                    <div >
            
			<table id="vol-table"  cellpadding="0" cellspacing="0" border="0" class=" table table-striped text-center" width="100%">
					<thead>
						<tr>
                                                    <th>VOL_NAME</th>
							<th>DATE</th>
                                                     <th>TIME</th>
                                                    <th>ATM</th>
                                                     <th>ATM_vol</th>
                                                      <th>VOLUME</th>
                                                       <th>DELTA</th>
                                                        <th>OPTION</th>
						</tr>
					</thead>
                                        
  

          <?php


          
          $sql = " SELECT date,Time,ATM,ATM_vol,volume,delta,options FROM vol_nifty WHERE date = (SELECT date FROM vol_nifty order by entry_number desc limit 1) and Time = (SELECT time FROM vol_nifty order by entry_number desc limit 1)";
            $result = mysqli_query($con,$sql) or die(mysqli_error()); 

               If(mysqli_num_rows($result)>0)
               {
                 while($row= mysqli_fetch_array($result) )
                 {  
                     if(round($row['delta'],1)!= 0)
                     {
            ?>
                                      
             <tr>
                 <td>Nifty</td>
              <td><?php echo $row['date']; ?></td> 
              <td><?php echo $row['Time']; ?></td> 
              <td><?php echo $row['ATM']; ?></td>
              <td><?php echo round($row['ATM_vol'],1); ?></td>
              <td><?php echo round($row['volume'],1); ?></td>
              <td><?php echo round($row['delta'],1); ?></td>
              <td><?php echo $row['options']; ?></td>
              
            </tr>
            <?php
                     }
            }
            }
             $sql = " SELECT date,Time,ATM,ATM_vol,volume,delta,options FROM vol_banknifty WHERE date = (SELECT date FROM vol_banknifty order by entry_number desc limit 1) and Time = (SELECT time FROM vol_banknifty order by entry_number desc limit 1)";
            $result = mysqli_query($con,$sql) or die(mysqli_error()); 

               If(mysqli_num_rows($result)>0)
               {
                 while($row= mysqli_fetch_array($result) )
                 {  
                    if(round($row['delta'],1)!= 0)
                     {
            ?>
             <tr>
                 <td>BNnifty</td>
              <td><?php echo $row['date']; ?></td> 
              <td><?php echo $row['Time']; ?></td> 
              <td><?php echo $row['ATM']; ?></td>
              <td><?php echo round($row['ATM_vol'],1); ?></td>
              <td><?php echo round($row['volume'],1); ?></td>
              <td><?php echo round($row['delta'],1); ?></td>
              <td><?php echo $row['options']; ?></td>
              
            </tr>
            <?php
                     }
            }
            }
             ?>


   </table>      
			
		</div>
            </div>
             </div>
              






    <?php
include("html/footer.html");    
?>
    </body>
</html>