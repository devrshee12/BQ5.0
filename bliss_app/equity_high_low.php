<?php
$search = $_POST['search'];
$date1 = $_POST['date1'];
//$date1 = "2016-07-04";

//$sort =  "DESC";
//$search = "SBIN";
 $c_name = $search.".NS";

        
        if (preg_match("@([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})@", $date1, $regs)) { 

            $from_unix_time = mktime(0, 0, 0, $regs[2], $regs[1], $regs[3]);
            $day_before = strtotime("yesterday", $from_unix_time);
            $formatted = date('Y-m-d', $day_before);
           // echo $formatted."   dasd ";
            } 
        else if (preg_match("@([0-9]{1,2}) ([0-9]{1,2}) ([0-9]{4})@", $date1, $regs)) {  
            $from_unix_time = mktime(0, 0, 0, $regs[2], $regs[1], $regs[3]);
            $day_before = strtotime("yesterday", $from_unix_time);
            $formatted = date('Y-m-d', $day_before);
           // echo $formatted."dfdfsd";
                } 
     else   { 
        $date3 = strtotime($date1);
     $formatted = date('Y-m-d', $date3);
   //   echo $formatted;
            //$formatted = "";
         }
         $date2 = date('Y-m-d', strtotime('-10 day', strtotime($formatted))); - 5;
        // echo $date2;
         
         $con=mysqli_connect("localhost","blissquants","bliss"); 
    if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
     else 
        {
            $sel_db =  mysqli_select_db($con,"bliss");
        }
        $sql = "SELECT date,movement FROM `earning2` WHERE date > '$formatted' and  name = '$search'"; 
            $result=mysqli_query($con,$sql); //excute query        
            $n=mysqli_num_rows($result); // give number of rows             
             while($row1=mysqli_fetch_row($result)) //fetch row one by one in loop
                {                                      
                    $array2[] = $row1;                                       
                } 
                if($n>0){
                    $sql = "SELECT date,ROUND(movement,1) FROM `earning2` WHERE  name = '$search' and date < '$formatted' ORDER BY date desc limit 1"; 
                }
                else{
                    $sql = "SELECT date,ROUND(movement,1) FROM `earning2` WHERE  name = '$search' ORDER BY date desc limit 1";
                }
         $result=mysqli_query($con,$sql); //excute query        
            $n=mysqli_num_rows($result); // give number of rows             
             while($row1=mysqli_fetch_row($result)) //fetch row one by one in loop
                {       /*    $date_result = new DateTime($row1[0]);
                    $date_result = $date_result->format('d M Y');
                     $array2[] = $date_result; */                           
                    $array2[] = $row1;  
                   
                } 
               /* $sel_db =  mysqli_select_db($con,"bliss_vol_all");
                $sql = "SELECT date,time,strike,vol,spread,options FROM `iv_spread` WHERE script = '$search' ORDER BY date desc limit 1"; 
                        $result=mysqli_query($con,$sql); //excute query        
            $n=mysqli_num_rows($result); // give number of rows             
             while($row1=mysqli_fetch_row($result)) //fetch row one by one in loop
                {                                      
                    $array3[] = $row1;                                       
                } */
                 // echo serialize($array2);
       //  echo serialize($array3);
        $pieces2 = explode("-", $formatted);
        $pieces1 = explode("-", $date2);
                    $d1 = $pieces1[2];
                    $d2 = $pieces2[2];
                    $y1 = $pieces1[0];
                    $y2 = $pieces2[0];
                    $m1 =  $pieces1[1] - 1;
                    $m2 = $pieces2[1] - 1;
           if (($handle = fopen("http://ichart.finance.yahoo.com/table.csv?s=$c_name&d=$m2&e=$d2&f=$y2&g=d&a=$m1&b=$d1&c=$y1&ignore=.csv", "r")) !==FALSE) // a,b,c  == start date,month, year, g = d means day,w=week,m==month,y=year, d,e,f = last date,month, year            
                            {
                            // Set the parent array key to 0
                            $key = 0;
                            // While there is data available loop through unlimited times (0) using separator (,)
                            while (($data = fgetcsv($handle, 0, ",")) !==FALSE) {
                                // Count the total keys in each row
                                $c = count($data);
                              //  print  $c . "<BR>"; 
                                //Populate the array
                                If ($key != 0) {
                                      $date = new DateTime($data[0]);
                                    $date_hl = $date->format('d M Y');
                                    $arrCSV[$key-1][0] = $date_hl; //Time
                                 //   $arrCSV[$key-1][1] = $data[1];            //Open
                                    $arrCSV[$key-1][1] = round( $data[2] , 1)."-".round( $data[3] , 1);            //High - low
                                    //$arrCSV[$key-1][] = $data[3];            //Low
                                    //$arrCSV[$key-1][4] = $data[6];            //Adj Close
                                    $arrCSV[$key-1][2] = round( ($data[2] - $data[3]) , 1);            //Volume
                                  //  $arrCSV[$key-1][6] = $data[4];             //close
                                }
                                $key++;
                                //passing value to array
                            } // end while
                          //  echo serialize($arrCSV);
                          
                         //  echo json_encode($arrCSV,JSON_NUMERIC_CHECK);
$ch;
$o;
$h;
$l;
$c;
$p;
               
                  
                    // Close the CSV file
                fclose($handle);
                } // end if

 $sql6 = "SELECT date FROM `vol_nifty` order by entry_number DESC limit 1" ;                  //select db

  $result6 = mysqli_query($con,$sql6);  
            $n6=mysqli_num_rows($result6);            
            if($n6>0)
            {
              while($row=mysqli_fetch_row($result6))
              {
                  if($row != null)
                  {  
                      $last_date1 =  $row[0];                //take last date of updation assuming that vol_acc table is updating properly
                        //   $datetime = $row[0]." ".$row[1];       //taking last date and time to variable
                        //  $last_time=$row[1];  
                 
                  }
               }
               
            }
           
            $sql3 = "SELECT id, script, strike, vol, spread, options FROM  `iv_spread` 
INNER JOIN (SELECT MAX( id ) AS maxID, options AS op FROM  `iv_spread` 
WHERE script =  '$search' AND DATE =  '$last_date1' GROUP BY op)maxID ON maxID.maxID = id";
        
            $result3 = mysqli_query($con,$sql3);
            $n3=mysqli_num_rows($result3);
            
            $total_data = 0;
            if($n3>0)
            {
              while($row=mysqli_fetch_row($result3))
              {
                  if($row != null && $row[4] > 2)
                  {  //  $spread[$total_data][6] = "<img src='image/". $row[1].".jpg' alt='no img' name='$row[1]|$row[8]|$row[4]' height='15' width='20'/>";
                     /* $spread[$total_data][3] = $row[1];
                      $spread[$total_data][4] = */
                       $strike1 = explode(" - ", $row[2]);
                       $option1 = explode(" - ", $row[5]);
                       $spread[$total_data][0] = $row[1];
                         $spread[$total_data][1] = $strike1[0]." ".$option1[0];
                           $spread[$total_data][2] = $strike1[1]." ".$option1[1];
                   
                      $spread[$total_data][3] = $row[4];
                    
                     
                    
                      
                      // echo $spread[$total_data][0]."  ".$spread[$total_data][1]."  ".$spread[$total_data][2]."  ".$spread[$total_data][3]."<BR>";
                       $total_data = $total_data + 1;
                  }             
                }            
            }
            
           
            
            
            
            
            
            
            $cmp = get_cmp($search);
               echo json_encode(array("highlow" => $arrCSV,"result" => $array2,"spread" => $spread,"cmp" => $cmp));  //json code to encrypt
          
               function get_cmp($eq_name){
                   
                   $file ="http://www.google.com/finance/info?q=NSE:$eq_name";
                                 //  echo $file;
                      
                       //Obtain Quote Info
                         $quote = file_get_contents($file);

                       //Remove CR's from ouput - make it one line
                         $json = str_replace("\n", "", $quote);
                         
                        //Remove //, [ and ] to build qualified string  
                          $data = substr($json, 4, strlen($json) -5);

                        //decode JSON data
                          $json_output = json_decode(utf8_decode($data));

                          $cmp = floatval(str_replace(',', '',$json_output->l));
                          return $cmp;
               }
  
?>