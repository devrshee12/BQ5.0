<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
 <?php
 ob_start(); 
        include './header.php';
         require 'db_connect.php';
         //get all fii dii data
         $sql="Select * From fii_data ORDER BY date DESC";
         $query=  mysqli_query($con, $sql);
         $count=0;
          
          
      ?> 
<html>
      <head>
        <title>Bliss Daily Data</title>   
         <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">
   <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
   <script src="js/jquery-ui.js"></script>
    <script src="js/dateformat.js"></script>
    <script src="js/script.js"></script>
  
     
      <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>  
        
      <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">      
            

    </head>
     <body>         
            <div class="row wrap">
                <div class="col-lg-2 col-md-2 col-sm-2">
                
                   
                 </div>
                <div class="col-lg-1 col-md-1 col-sm-1"></div>
           <div class="col-lg-6 col-md-6 col-sm-6 text-center">   
               <div class="row title_all text-center">
         FII & DII Trading Activity Data(Provisional Figures)
               <span  class="small_font pull-right" id="earning_update"></span>
            </div>

               
               <div class="row">
                   <div class="col-lg-2"></div>
                   <div class="col-lg-4 ">
                       <form class="form-horizontal" action="" method="post" >
                   <table id="fii-table" cellpadding="0" cellspacing="0" border="0" class="table table-striped" >
                           <thead>
                                   <tr>
                                       <th>Date</th>
                                       <th>FII Net <br>Purchases/ Sales (Rs.Cr)</th>
                                       <th>DII Net <br>Purchases/ Sales (Rs.Cr)</th>
                                       
                               </tr>
                       </thead>
                           <tbody>
                              <?php
                              $total_fii=0;
                              $total_dii=0;
                              //get current month
                               $currentmonth=date('M Y');
                                  
                               while($row=  mysqli_fetch_array($query))
            {                    // convert fetch date month
                                   $time=  strtotime($row[1]);// convert date to string                              
                                   $month=date('M Y',$time); //change format
                                  
                              ?>
                               <tr>
                                   <td><?php  if($month == $currentmonth ) //check if current month and fetched month are diffrent then display "Month Year" format otherwise display "date month year"
                                   { echo date('d M Y',$time);} else {echo $month; }?></td>
                                   <td  style="<?php if($row[2]<0)echo "color:#ff0000"?><?php if($row[2] >0)echo "color:#07DA0F"?>"><?php  echo $row[2]; ?></td>
                                   <td style="<?php if($row[3]<0)echo "color:#ff0000"?><?php if($row[3] >0)echo "color:#07DA0F"?>"><?php  echo  $row[3]; ?></td>
                               </tr>
                                 <?php
                                        }
                                 ?>
                              
                       </tbody>
                   </table>
                        
                     </form>
                   </div>
               </div>
            
           </div>
           
 </div>   
                 <?php
                
 include ("./html/footer.html");
        ?>
               
                 
            
         
      
</body>
</html>



