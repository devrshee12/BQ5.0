<!DOCTYPE html>

 <?php
  ob_start(); 
        include './header.php';
         require 'db_connect.php';
         ?>
     <html>
      <head>
        <title>Bliss Daily Data</title>   
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
             <script  type="text/javascript" language="javascript">
                 /*change focus on enter*/
              function copyToClipboard(element) {
                 // alert(element);
                 // var hello = "hi";
   //   Copied = hello.createTextRange();
  // hello.execCommand("Copy");     
  //element = "#leader_table";
   var $temp = $("<input>");
  $("body").append($temp);
  $temp.val(element).select();
  document.execCommand("copy");
  $temp.remove();
  /*var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).select();*/
 // element.execCommand("copy");
 // $temp.remove();
}

                 $( document ).ready(function() {
                $('.accordion-toggle').click(function (e) {
                  // alert(e.target.nodeName);
                     if(e.target.nodeName === 'TD')/* if condition is because jquery is giving effect accordingly like on td(table cell) or I tag*/
                   {
                        $(e.target)
                             .find("i.indicator")   
                      .toggleClass('glyphicon-minus glyphicon-plus');
                   }
                   else if(e.target.nodeName === 'I')
                   {
                        $(e.target) 
                    .toggleClass('glyphicon-minus glyphicon-plus');
                   }
/*if($('td span').hasClass('glyphicon-plus'))
{alert('plus');
    $(e.target).html('<span class="glyphicon glyphicon-minus"></span>'); 
}
else
{  alert('minus');    
    $(e.target).html('<span class="glyphicon glyphicon-plus"></span>'); 
}
                          if(e.target.nodeName === 'TD');
                   {
                     $(e.target)
                      .find("i.indicator")   
                    .toggleClass('glyphicon-minus glyphicon-plus');
                   }
                   else if(e.target.nodeName === 'I');
                   {
                        $(e.target) 
                    .toggleClass('glyphicon-minus glyphicon-plus');
                   }*/
}); 

/*$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);*/
 
                
});
  
    
    function get_member_data(search){            
  location.href = "Bliss_Daily_Data_table_admin.php? search="+search;
       
    }

 
                      $(document).on('keypress', 'input', function (e) {
    if (e.which === 13) {
        e.preventDefault();
        // Get all focusable elements on the page
       // alert(document.activeElement.value);
            if (document.activeElement.value === 'Search')
            {
                document.getElementById("search").click();
            }
            else{
                var $canfocus = $(':focusable');
                var index = $canfocus.index(document.activeElement) + 1;
                
                if (index >= $canfocus.length) index = 0;
                $canfocus.eq(index).focus();
            }
        
        }
    });

         </script>
        <style>
            /*few changes in table different from custom.css*/
        /*for text center , paddding 0 etc in table cell*/
        table{
    border: 1px solid black;
    table-layout: fixed;
   
}
        #search1{
     color:white;
 }
       .form-inline .form-control {
  display: inline-block;
  margin-right:4px;
}
            .table>tbody>tr>th, .table>tbody>tr>td { 
      
        color: white;
        
        border-top: none !important; 
        width:5%;
      
       font-size: 13px;
         padding-bottom: 0px;
            padding-top: 0px;
          text-align: left;
    }
    .table-striped{
        border: none;
    }
   
      .form-group{
        margin:1px;
    }
    .btn-lg{
        padding-left: 2px;
        font-weight: normal;
        font-size: 15px;
    }
    h3{
        margin-top: 0;
    }
    .form-horizontal{
       text-align: left;
    }
    
        
.control_color_1
    {
     background-color: #474545!important;
    color: #ffffff;
      border-radius: 0px;
         border-color: #474545;
         font-weight:normal;
           font-size: 13px;
            height:25px;
           text-align: center;
    }
      .control_color_2
    {
    background-color: rgb(58, 53, 49);
    color:  #ffffff;
      border-radius: 0px;
       border-color: rgb(58, 53, 49);
       font-weight:normal;
         font-size: 13px;
         height:25px;
         text-align: center;
    }  
 
       .btn_effect{
     
      margin-top: 2%;
       padding-top: 0px;
       border-radius: 10px; 
       background-color: #474545;
          padding-top: 1px;
     -webkit-transition: all .8s ease-in-out;
    -moz-transition: all .8s ease-in-out; 
      -o-transition: all .8s ease-in-out; 
    height: 50%;
    color:  rgb(132,194,37);
    font-size: 15px;
    }
    .btn_effect:hover{
     background-color: rgb(132,194,37)!important;
     color: white;  
     font-size: 17px;
     text-decoration: none;
 }
 .btn_effect:focus{
     background-color: rgb(132,194,37)!important;
     color: white;  
     font-size: 17px;
     text-decoration: none;
 }
 .button{
    
    position:relative;
  
     width:50%;
     height:80%;
    left:25%;
  
 }
   blink {
-webkit-animation-name: blink; 
-webkit-animation-iteration-count: infinite; 
-webkit-animation-timing-function: cubic-bezier(1.0,0,0,1.0);
-webkit-animation-duration: 1s;
}
 @media (min-width: 800px) and (max-width: 1100px) { 
               
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
     
            }
</style>   

    </head>
     <body>         
            <div class="row wrap">
                 <div class="col-lg-2 col-md-2 col-sm-2">
          
      </div>
                
           <div class="col-lg-10 col-md-10 col-sm-10 text-center">   
              
                <ul class="nav nav-tabs">
      <li><a href="Bliss_Daily_Data_table_admin.php">M2M</a></li>
                                <li><a href="SmartDelta5.php">10% Up Down </a></li>
                                <li><a href="SmartDelta3.php">Individual M2M</a></li>
    </ul>
               
               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                       
                                <div class="col-lg-3 form-group">
                            <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                    <input class="form-control panel-heading" id="search1"   name="search" placeholder="Search for" required>
                                </div>
                            <div class="col-lg-3 form-group">
                                    <input type='button' id="search" class="btn  panel-heading" onClick ="get_member_data(document.getElementById('search1').value)" value="Search">
                                    <input type='button' class="btn  panel-heading" onClick ="location.href='Bliss_Daily_Data_Table_Admin.php';" value="Back">

                            </div>
                     



                     <form class="form-horizontal" action="" method="post" >
                         
                       
                   <table id="leader_table" class="table table-striped text-center" >
                           <thead>
                                   <tr>
                                       <th style="width:40px">Id</th>
                                       
                                       <th style="width:140px" colspan="2">Name</th>
                                       <th style="width:70px">ODIN</th>
                                      
                                        <th style="width:40px">8:30</th>
                                       <th style="width:40px">Pos</th>
                                       <th style="width:65px" >StopLoss</th>
                                       <th style="width:60px" >Current</th>
                                       <th >Limit</th>
                                        <th>Depo</th>
                                        <th>Tomorrow</th>
                                       <th>Today sheet</th>
                                       <th>Yesterday</th>
                                       <th >Intraday</th>
                                       
                                       <th >Theta</th>
                                      <th >10%up(L)</th>
                                       
                                       <th >10%Down(L)</th>
                                    </tr>
                            </thead>
                           <tbody>
                               
                               <?php
                              
       $date= date('Y-m-d');
       
       // $date='2016-08-18';
                 $prev_date = date('Y-m-d', strtotime($date .' -1 day'));
                 if(isset($_SESSION['leader']))
                  $leader_logged = $_SESSION['leader'];
if(isset($_SESSION['admin']) || $leader_logged == 'Vineet')
      {     
      
                    if (isset($_GET['search']) && $_GET['search'] !== '') 
                        {
                            $a = $_GET['search'];
                            $search = $a;
                            //echo $search;   
                        $sql = "SELECT date,yesterdaym2m,todaym2m,theta,sheet,current_margin,margin_limit,day_before_yesterday_m2m,odin_code,t.Name,Id,Leader_Name,code,deposit,morning_attendance,position,stoploss,ten_up,ten_down FROM `daily_m2m`t inner join (
                                            select date as MaxDate, Name as name
                                            from `daily_m2m` where Name LIKE '$search%' OR odin_code LIKE '%$search%' order by date desc limit 1
                                        ) tm on t.date = tm.MaxDate and t.Name = tm.name order by Leader_Name ASC , Name ASC "; 
                //echo "yess";
                        } 
                        else {
                  //  echo "yess";
                            $sql = "SELECT date,yesterdaym2m,todaym2m,theta,sheet,current_margin,margin_limit,day_before_yesterday_m2m,odin_code,Name,Id,Leader_Name,code,deposit,morning_attendance,position,stoploss,ten_up,ten_down FROM `daily_m2m`t inner join (
                                            select max(date) as MaxDate
                                            from `daily_m2m`
                                        ) tm on t.date = tm.MaxDate order by Leader_Name ASC , Name ASC"; 
                   // echo "No";
                        }       
       //  }             
                 
     
     $i = 0; 
     /*select last date(latest) value from table*/
        
        
        $query=mysqli_query($con, $sql);
      
        $total_yesterday = 0;
                $total_today = 0;
                $total_sheet = 0;
                $total_theta = 0;
        $count = 0;
        $total_current_margin = 0;
        $total_margin_limit = 0;
        $total_margin_pankaj = 0;
        $total_margin_jayesh = 0;
        $total_deposit_jayesh = 0;
        $total_limit_jayesh = 0;
        $total_margin_amit = 0;
        $total_deposit_amit = 0;
        $total_limit_amit = 0;
        $total_limit_pankaj = 0;
        $total_deposit_pankaj = 0;
        $total_margin_surya = 0;
        $total_limit_surya = 0;
        $total_deposit_surya = 0;
        $total_day_before_yesterday=0;
        $total_current_margin_all=0;
        $total_margin_limit_all=0;
        $total_deposit_all = 0 ;
        $total_deposit = 0;
        $total_today_jayesh = 0;
        $total_today_amit = 0;
         $total_today_pankaj = 0;
        $total_today_surya = 0;
        $total_today_rupak = 0;
        $current_margin;
        $margin_limit;
        $eight = 8;
       //$dailym2m_arr; /*array for storing data that are going to display*/
         while($row=  mysqli_fetch_array($query))
            {
            
             //   echo $row[0]."".$date;
             /*check if last date is today's date*/
             if($date == $row[0])
             {
          
                 
               
                $dailym2m_arr[$count][0]=$row[0]; //date
                $dailym2m_arr[$count][1]=$row[1]; //yesterday
                $dailym2m_arr[$count][2]=$row[2]; //today
                $dailym2m_arr[$count][3]=$row[3]; //theta
                $dailym2m_arr[$count][4]=$row[4]; //sheet
             
             
                $dailym2m_arr[$count][5]=$row[5]; //current margin
                $dailym2m_arr[$count][6]=$row[6]; //margin limit
                $dailym2m_arr[$count][7]=$row[7]; //day before yesterday
                   $dailym2m_arr[$count][8]=$row[8]; //odin
                $dailym2m_arr[$count][9] = $row[9];//name
                 $name_split = explode(" ",$dailym2m_arr[$count][9]);
             $name[]=$name_split[0]."_".$row[12];
                  $dailym2m_arr[$count][10]=strval($row[10]);//id
                $dailym2m_arr[$count][11]=$row[11];//leader name
                $dailym2m_arr[$count][12]=$row[12];//code
                $dailym2m_arr[$count][13]=$row[13];//deposit
               
             //   $odin_code[$count]=$row[8];
                /*calculating sum of yesterday, today(m2m) and total sheet(@today)*/
                 $total_theta=$dailym2m_arr[$count][3] + $total_theta;
            
            
       // echo "aaa";
         }
         else /*if last date is not today(here today and sheet column is blank and here yesterday sheet is total sheet*/
             {
             
           /*????*/
           
            
             $dailym2m_arr[$count][0]=$row[0]; //date
             $dailym2m_arr[$count][1]=$row[4];//yesterday
             $dailym2m_arr[$count][2]="";//today
             $dailym2m_arr[$count][3]="";//theta
             $dailym2m_arr[$count][4]="";//sheet
             $dailym2m_arr[$count][5]=$row[5]; //current margin
             $dailym2m_arr[$count][6]=$row[6]; //margin limit
             $dailym2m_arr[$count][7]=$row[1];//day before yesterday
             $dailym2m_arr[$count][8]=$row[8]; //odin
             $dailym2m_arr[$count][9] = $row[9];//name
              $name_split = explode(" ",$dailym2m_arr[$count][9]);
             $name[]=$name_split[0]."_".$row[12];
             $dailym2m_arr[$count][10]=$row[10];//id
            
             $dailym2m_arr[$count][11]=$row[11];//leader name
             $dailym2m_arr[$count][12]=$row[12];//code
          $dailym2m_arr[$count][13]=$row[13];//deposit
            
               
         // echo "aaabbb";
            }
             $dailym2m_arr[$count][14]=$row[14];//morning attendance
                $dailym2m_arr[$count][15]=$row[15];//position
                $dailym2m_arr[$count][16]=$row[16];//stoploss
                 $dailym2m_arr[$count][17]=$row[17];//ten_up
                $dailym2m_arr[$count][18]=$row[18];//ten_down
             //echo $dailym2m_arr[$count][10];
             $total_yesterday = $dailym2m_arr[$count][1] + $total_yesterday;
             $total_today =$dailym2m_arr[$count][2] + $total_today;
             $total_sheet =$dailym2m_arr[$count][4] + $total_sheet;
            
             $total_day_before_yesterday=$dailym2m_arr[$count][7] + $total_day_before_yesterday;
             $total_deposit = $dailym2m_arr[$count][13] + $total_deposit;
               $total_current_margin += $dailym2m_arr[$count][5] ;
    $total_margin_limit += $dailym2m_arr[$count][6] ;
    $count++;
           }
           
       /*             $column = 11; // number of the column you want
                    $titles =  array_map(function($v) use ($column) {
        echo $v[$column-1] . " ";
    },$dailym2m_arr);
*/
           
        /* $titles = array_map(function($e) {
    return is_object($e) ? $e->Title : strval($e[10]);
}, $dailym2m_arr);*/
  /*sort function*/
                      function subval_sort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	asort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}
 $txt = "<table ><thead><tr><th>Code</th><th>Name</th><th>Odin</th><th>Margin</th></tr></thead><tbody>";
 if(isset($dailym2m_arr))
     {
           $dailym2m_arr_sort = subval_sort($dailym2m_arr,8);
            $smart_code = array_column($dailym2m_arr_sort, 12);
            
           //$smart_code = array_column(json_decode(json_encode($dailym2m_arr), true), 10);
           
          $first_names = array_column($dailym2m_arr_sort, 9);
          $odin = array_column($dailym2m_arr_sort, 8);
          $margin = array_column($dailym2m_arr_sort, 6);
        // echo serialize($dailym2m_arr);
        
        // $copy_data = array_combine($first_names, $odin);
         
          
        for($i=0; $i < sizeof($first_names);$i++)
         {
              $txt .= "<tr><td>".$smart_code[$i]."</td><td>".$first_names[$i]."</td><td>".$odin[$i]."</td><td>".$margin[$i]."</td></tr>";
         }
          $txt .= "</tbody></table>";
      
      ?> <button class="panel-heading" onclick="copyToClipboard('<?php echo htmlspecialchars(json_encode($txt)); ?>')">Copy Data</button>
                           <?php
//print_r($txt); 
           
           $data_summ = array();
            
           /* below loop initialize array*/
            foreach ( $dailym2m_arr as $value ) {
        //  if($data_summ[ $value[11] ])
    $data_summ[ $value[11]."member" ] = 0;
    $data_summ[ $value[11]."yesterday" ] = 0;
    $data_summ[ $value[11]."today" ] = 0;
    $data_summ[ $value[11]."theta" ] = 0;
    $data_summ[ $value[11]."sheet" ] = 0;
    $data_summ[ $value[11]."yesterday_before" ] = 0;
    $data_summ[ $value[11]."current_margin" ] = 0;
        $data_summ[ $value[11]."margin_limit" ] = 0;
    $data_summ[ $value[11]."deposit" ] = 0;
 $data_summ[ $value[11]."ten_up" ] = 0;
    $data_summ[ $value[11]."ten_down" ] = 0;
  $data_summ[ $value[11]."stoploss" ] = 0;
}
   $data_summ[ "ten_up" ] = 0;
    $data_summ[ "ten_down" ] = 0;
    $data_summ[ "stoploss" ] = 0;
  
    /*below loop calculate sum of column ( today sheet, yesterday, theta etc) group by leader name*/
      foreach ( $dailym2m_arr as $list ) {
    //$number = str_replace( ",", ".", $list[1] ) * 1;
    //  if($data_summ[ $list[11] ])
    $data_summ[ $list[11]."yesterday" ] += $list[1];
    $data_summ[ $list[11]."today" ] += $list[2];
    $data_summ[ $list[11]."theta" ] += $list[3];
    $data_summ[ $list[11]."sheet" ] += $list[4];
     $data_summ[ $list[11]."current_margin" ] += $list[5];
      $data_summ[ $list[11]."margin_limit" ] += $list[6];
    $data_summ[ $list[11]."yesterday_before" ] += $list[7];
     $data_summ[ $list[11]."member" ] += 1;
    $data_summ[ $list[11]."deposit" ] += $list[13];
    $data_summ[ $list[11]."ten_up" ] += $list[17];
    $data_summ[ $list[11]."ten_down" ] += $list[18];
    $data_summ[ $list[11]."stoploss" ] += $list[16];
    $data_summ[ "stoploss" ] += $list[16];
      $data_summ[ "ten_up" ] += $list[17];
    $data_summ[ "ten_down" ] += $list[18];
}           
     
//$data_summ[ "ten_down" ] = 0;
       $name[$count]='pankajgroup';
        $name[$count+1]=  'suryagroup';
        $name[$count+2]=  'jayeshgroup';
        $name[$count+3]=  'amitgroup';
        $name[$count+4]=  'sahilgroup';
        $name[$count+5]=  'sfalgunigroup';
        $ab = 0;
     
         
          $dailym2m_arr[$count][9] = "XL1";
          $dailym2m_arr[$count + 1][9] = "XL2";
          $dailym2m_arr[$count + 2][9] = "XL3";
     }
       //$name_arr = [];
     // echo serialize($data_summ);
                  if(isset($_POST['enter']))
                    {

                      /*loop for getting value and update one by one for all members*/
                     for($i=0;$i<$count;$i++)
                       {
//                              /*get name of member*/
                                $name_arr[0] = $dailym2m_arr[$i][9];
//                             
                          $name_arr[7] = $_POST[$name[$i]."margin_limit"];
                          $depo = $_POST[$name[$i]."Depo"];
                        //  echo  $depo ;
                         // $code = $dailym2m_arr[$i][12];
                            $rs =  mysqli_query($con,"UPDATE daily_m2m SET margin_limit='$name_arr[7]',deposit='$depo' WHERE  name ='$name_arr[0]'");
                            
                       }
                       /*for two editable cell that will store in text file*/
                       $newsticker="daily_m2m.txt";
                         $f = fopen($newsticker, "w");
                         
                       for($i=$count;$i<$count+3;$i++)
                       {
                            $excel[$i]=$_POST[$name[$i]."xl"]."\n";
                            fwrite($f,$excel[$i]);
                            echo $excel[$i];
                       }
                          fclose($f);
                          /*reload page*/
                          header("Location:Bliss_Daily_Data_Table_Admin.php");
//                        
                    }
//                          
    /*  foreach ( $dailym2m_arr as $value ) {
        //  if($data_summ[ $value[11] ])
    $data_summ[ $value[11] ] = 0;
}*/
//echo serialize($dailym2m_arr);

//echo serialize($data_summ);
                
                    unset($_POST['enter']);
                    unset($name_arr);
                
      

                               $leader_count = 0;
                              /* $file=  fopen("daily_m2m.txt","r");
                                        
                                     while(!feof($file))
                                        {
                                            $read=  fgets($file);
                                            $myArray[] =$read;
                                           // echo $read;
                                       // echo "fgfg";
                                         }*/
                               
                               if(isset($dailym2m_arr))
                               {//echo "vdfg";
                                for($i=0;$i<$count;$i++)
                                {
                                    
                                     if($i%2 == 1)
                                    {
                                       
                                        $control_class = "control_color_1";
                                    }
                                     else {
                                         $control_class = "control_color_2";
                                     }
                                     
                                    // $total_yesterday += $yesterday[$i];
                                    //$total_yesterday=$yesterday[$i] + $yesterday[$i + 1];
                                     if($i == 0)
                                     {
                                         $last_leader = '';
                                     }
                                    else {
                                            $last_leader = $dailym2m_arr[$i - 1][11];
                                            
                                           
                                    }
                                     if($last_leader !== $dailym2m_arr[$i][11])                                         
                                     {  
                                       
                                     
                                                   $leader_count++;
                                                   if($i > 1) 
                                                        {
                                                        echo "  </tbody>
                                                                        </table>
                                                                        </div>
                                                                        </td>  
                                                                     </tr>  ";
                                                        $total_today_jayesh = $total_today;
                                                        }
                                                      
                                                   ?>
                                                               
                                                     <!-- Group total         --->                      
                                                    <tr  >
                                                        <td class="accordion-toggle" data-toggle="collapse"  data-target="<?php echo "#acc_".$dailym2m_arr[$i][11] ?>" id="toggle_table">  <i class="indicator glyphicon glyphicon-plus"> </i> </td>
                                                       
                                                            <td colspan="2" class="text-center" style="text-align: center;"><?php echo $dailym2m_arr[$i][11]; ?></td>
                                                                <td><input type="text" name="<?php echo $name[$i]."xl"; ?>" id="<?php echo $name[$i]."xl"; ?>" placeholder="<?php echo $name[$i]."xl"; ?>" 
                                                                        style="color: rgb(132,194,37); text-align: center; " class="form-control control_color_2" value="<?php echo $data_summ[ $dailym2m_arr[$i][11]."member" ]; ?>" size="10"></td>
                                                                <td colspan=2></td>
                                                                <td> <?php echo $data_summ[ $dailym2m_arr[$i][11]."stoploss"  ]; ?></td>
                                                                <td style="color: rgb(132,194,37); text-align: center; "><?php echo $data_summ[ $dailym2m_arr[$i][11]."current_margin"  ]; ?></td>
                                                                   

                                                           <td><input type="text" name="<?php echo $name[$i]."margin_limit"; ?>" id="<?php echo $name[$i]."margin_limit"; ?>" placeholder="<?php echo $name[$i]." Margin Limit"; ?>" class="form-control control_color_2" style="color: rgb(132,194,37); text-align: center; " value="<?php echo $data_summ[ $dailym2m_arr[$i][11]."margin_limit"  ]; ?>" size="10"></td>
                                                           <td><input type="text"  name="<?php echo $name[$i]."Depo"; ?>" id="<?php echo $name[$i]."Depo"; ?>" placeholder="<?php echo $name[$i]." Depo"; ?>" class="form-control control_color_2" style="color: rgb(132,194,37); text-align: center; " value="<?php echo $data_summ[ $dailym2m_arr[$i][11]."deposit"  ]; ?>" size="10"></td>
                                                          <td style="text-align: center;"><?php echo $data_summ[ $dailym2m_arr[$i][11]."sheet"  ]; ?></td>
                                                           <td style="text-align: center;"><?php echo $data_summ[ $dailym2m_arr[$i][11]."yesterday"  ]; ?></td>
                                                           
                                                           <td style="text-align: center;"><?php echo $data_summ[ $dailym2m_arr[$i][11]."yesterday_before"  ]; ?></td>
                                                           <td style="text-align: center;"><?php echo $data_summ[ $dailym2m_arr[$i][11]."today"  ]; ?></td>
                                                           <td style="text-align: center;"><?php echo $data_summ[ $dailym2m_arr[$i][11]."theta"  ]; ?></td>
                                                           <td style="text-align: center;"><?php echo Round($data_summ[ $dailym2m_arr[$i][11]."ten_up"  ]); ?></td>
                                                           <td style="text-align: center;"><?php echo Round($data_summ[ $dailym2m_arr[$i][11]."ten_down"  ]); ?></td>
                                                           
                                                           
                                                    </tr>
                                                     <tr>
                                                        <td colspan="17" style="padding:0;background-color: transparent" class="hiddenRow"><div  class="<?php if(!isset($search)) {echo 'collapse';} else {echo '';} ?>" id="<?php echo "acc_".$dailym2m_arr[$i][11] ?>"> 
                                                          <table class="table table-striped" style="background-color: transparent" >
                                                            <thead >
                                   <tr>
                                       <th style="width:30px">Id</th>
                                       <th style="width:60px">Code</th>
                                       <th style="width:80px">Name</th>
                                        <th style="width:70px">ODIN</th>
                                       
                                       <th style="width:40px">8:30</th>
                                       <th style="width:40px">Pos</th>
                                       <th style="width:65px" >StopLoss</th>
                                       <th style="width:60px" >Current</th>
                                       <th>Limit</th>
                                        <th >Depo</th>
                                         <th>Tomorrow </th>
                                       <th>Today sheet</th>
                                       <th>Yesterday </th>
                                       <th >Intraday</th>
                                       
                                       <th >Theta</th>
                                     <th >10%up(L)</th>
                                       
                                       <th >10%Down(L)</th>
                                    </tr>
                            </thead>
                                                                  <tbody style="border: none">  
                                                                      
                                                        <?php



                                                              }
                                                              
                                  if($dailym2m_arr[$i][14] == 'A' && $dailym2m_arr[$i][15] == 'Y')
                                   {                                       
                                            $attendance_color = 'style="color: RED; text-transform:uppercase" ';
                                   }
                                   Else{
                                       $attendance_color = 'style="color: white; text-transform:uppercase"';
                                   } 
                                   $split_name =  explode(" ",$dailym2m_arr[$i][9]);
                                   $split_name2 = $split_name[1];

                                                        ?>
                                   
                               
                                                 <!-- individual c-->
                                                    <tr class='text-center'>
                                                        <td ><?php  echo  $i+1; ?></td>
                                                        <td ><?php echo $dailym2m_arr[$i][12]; ?></td>
                                                        <td ><?php echo $split_name[0]." ".$split_name2[0]; ?></td>
                                                        <td><?php echo $dailym2m_arr[$i][8]; ?></td>
                                                        <td <?php echo $attendance_color; ?>><?php echo $dailym2m_arr[$i][14]; ?></td>
                                                        <td <?php echo $attendance_color; ?>><?php echo $dailym2m_arr[$i][15]; ?></td>
                                                        <td ><?php echo "<blink>".$dailym2m_arr[$i][16]."</blink>";; ?></td>
                                                          <td style="text-align: center;"><?php if(isset($dailym2m_arr[$i][5])) echo round ($dailym2m_arr[$i][5],1); else echo ''; ?></td>
                                                      
                                                        <td><input type="text" name="<?php echo $name[$i]."margin_limit"; ?>" id="<?php echo $name[$i]."margin_limit"; ?>"  
                                                                   class="form-control <?php echo $control_class; ?>" value="<?php if(isset($dailym2m_arr[$i][6])) echo round ($dailym2m_arr[$i][6],1); else echo ''; ?>" size="10" autofocus=""></td>
                                                        <td><input type="text" style="color: yellow;" name="<?php echo $name[$i]."Depo"; ?>" id="<?php echo $name[$i]."Depo"; ?>"  
                                                                   class="form-control <?php echo $control_class; ?>" value="<?php if(isset($dailym2m_arr[$i][13])) echo round ($dailym2m_arr[$i][13],1); else echo ''; ?>" size="10" autofocus=""></td>
                                                        <td style="color: rgb(132,194,37); text-align: center;"><?php if(isset($dailym2m_arr[$i][4])) echo $dailym2m_arr[$i][4]; else echo ''; ?></td>
                                                     
                                                        <td style="text-align: center;"><?php if(isset($dailym2m_arr[$i][1])) echo $dailym2m_arr[$i][1]; else echo ''; ?></td> 
                                                           <td style="text-align: center;"><?php if(isset($dailym2m_arr[$i][7])) echo $dailym2m_arr[$i][7]; else echo ''; ?></td>
                                                       <td style="text-align: center;"><?php if(isset($dailym2m_arr[$i][2])) echo $dailym2m_arr[$i][2]; else echo ''; ?></td>
                                                       <td style="text-align: center;"><?php if(isset($dailym2m_arr[$i][3]))echo $dailym2m_arr[$i][3]; else echo ''; ?></td>
                                                       <td ><?php echo Round($dailym2m_arr[$i][17]); ?></td>
                                                       <td ><?php echo Round($dailym2m_arr[$i][18]); ?></td>

                                                     
                                                    </tr>  
                                                 
                                   <?php
                                      }
                               }
                               else{
                                 echo " <tr> <td> No data Available </td></tr>";
                               }
                                      
                                   ?>

                                   
                                        <?php
                                         echo "  </tbody>
                                                                        </table>
                                                                        </td>  
                                                                     </tr>  ";
                                        if (!isset($_GET['search']) || $_GET['search'] == '') { //if when user will search then no need to display every group total
                                  
                                  ?>
                             
                                <tr>
                                    <td></td>
                                      <td colspan="2"><label>Total</label></td>
                                      <td style="color: rgb(132,194,37);text-align: center;"><?php  echo $i; ?></td>
                                      <td colspan=2></td>
                                      <td style="color: rgb(132,194,37);text-align: center;"><?php echo $data_summ[ "stoploss" ]; ?></td>
                                      <td style="color: rgb(132,194,37);text-align: center;"><?php  echo round($total_current_margin * 10,1); ?></td>
                                      <td style="color: rgb(132,194,37);text-align: center;"><?php  echo round($total_margin_limit * 10,1); ?></td>
                                      <td style="color: rgb(132,194,37);text-align: center;"><?php  echo round($total_deposit * 10,1); ?></td>
                                      <td style="color: rgb(132,194,37);text-align: center;"><?php  echo round($total_sheet,1); ?></td>
                                      <td style="color: rgb(132,194,37);text-align: center;"><?php  echo round($total_yesterday,1); ?></td>
                                      <td style="color: rgb(132,194,37);  text-align: center;"><?php  echo round($total_day_before_yesterday,1); ?></td>
                                      <td style="color: rgb(132,194,37);text-align: center;"><?php  echo round($total_today,1); ?></td>
                                     
                                       <td style="color: rgb(132,194,37);text-align: center;"><?php  echo round($total_theta,1); ?></td>
                                         <td style="color: rgb(132,194,37);text-align: center;"><?php  echo $data_summ[ "ten_up" ]; ?></td>
                                         <td style="color: rgb(132,194,37);text-align: center;"><?php  echo $data_summ[ "ten_down" ]; ?></td> 
                                </tr>
                                    <?php
                                }
                                
      }
      else
      {                             
      ?>                         
                                  
                               
                       </tbody>
                          <?php      echo " <div class='panel-heading'> You have no acccess
                Please Login
                    </div>";
      }
                                  ?>
                   </table>
                     <button type="submit" name="enter" value="Submit" class="button btn btn_effect btn_lg">Submit</button>
                     </form>
                        
               </div>
                   </div>
                   
           </div>
           
 </div>   
                
            </div>
                       
                 <?php
                
 include ("./html/footer.html");
        ?>
               
                 
            
         
      
</body>
</html>



