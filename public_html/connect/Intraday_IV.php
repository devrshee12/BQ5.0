<?php

include("../config.php");

Class Intraday_IV {

    private $db;

    function _construct() {

        // $this->db = new mysqli(DB_HOSTS, DB_USER, DB_PASSWORD, DB_DATABSE);
        // echo "hrllo";
        if (mysqli_connect_errno()) {
            //echo "Could not connect BlissQuants Database";
        }
    }

    function get_intraday_data($script, $date) {

        $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABSE);
        $table_name = strtolower("nse_vol_" . $script);
        // echo $date;
        $query = mysqli_query($db, "select ATM_vol from `" . $table_name . "` where date = '" . $date . "'");
        $ATM_vol = mysqli_fetch_row($query);
        // echo $ATM_vol[0];
        return $ATM_vol[0];
    }

    function get_fii_data($date) {

        $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABSE);

        $sql = "Select date,fii_net,dii_net From `fii_data` ORDER BY DATE DESC";
        $query = mysqli_query($db, $sql);
        $currentmonth = date('M Y');
        // $row = mysqli_fetch_all($query);
        $i = 0;
        $array_fii[][] = 0;
        while ($row = mysqli_fetch_array($query)) {                    // convert fetch date month
            $time = strtotime($row[0]); // convert date to string                              
            $month = date('M Y', $time); //change format
            if ($month == $currentmonth) { //check if current month and fetched month are diffrent then display "Month Year" format otherwise display "date month year"
                $array_fii[$i][0] = date('d M Y', $time);
            } else {
                $array_fii[$i][0] = $month;
                ;
            }
            if ($row[1] < 0) {
                $array_fii[$i][1] = "<span style='color:#ff0000' >$row[1]</span>";
            } else {
                $array_fii[$i][1] = "<span style='color:#07DA0F' >$row[1]</span>";
            }
            if ($row[2] < 0) {
                $array_fii[$i][2] = "<span style='color:#ff0000' >$row[2]</span>";
            } else {
                $array_fii[$i][2] = "<span style='color:#07DA0F' >$row[2]</span>";
            }
            $i++;
        }
        return $array_fii;
    }

    function get_earning($date) {
        $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABSE);
        $pieces = explode("/", $date); // split date with /
        $date1 = $pieces[0]; //take one date
        if (count($pieces) > 1) { // check whether second date is there or not
            $date2 = $pieces[1]; // insert second date
        } else {
            $date2 = 0;
        }
        if ($date2 == 0) {
            $sql = "SELECT name,d_name,date,time,max_change,movement,changes,max_Movement,min_Movement FROM `earning2` WHERE date = '$date1'";
        } else {
            $sql = "select name,d_name,date,time,max_change,movement,changes,max_Movement,min_Movement from `earning2` WHERE date between '$date1' and '$date2'";
        }
        $query = mysqli_query($db, $sql) or die("earning_connect.php: get earning2");

       $array_fii[][] = 0;
        $i = 0;
        while ($row = mysqli_fetch_array($query)) {  // preparing an array
           $array_fii[$i][0] = $row['date']; 

            if ($row["time"] == "00:00:00") {
                $name1 = $row["d_name"];
                $dt1 = $row["date"];

                $result2 = mysqli_query($db, "SELECT name,d_name,date,time FROM earning2 WHERE d_name = '$name1' AND changes <> 0 ORDER BY date desc LIMIT 1;"); //get last result time from earning which has changes not zero bcoz we want time from that
                $m = mysqli_num_rows($result2);
                // echo "<br><br>  yes <br><br>".mysql_num_rows($result2);
                $p = 0;
                if ($m > 0) {
                    while ($row1 = mysqli_fetch_row($result2)) { //fetch row one by one in loop
                        $p = $p + 1;
                        if ($p == $m)
                            $tt = $row1[3];
                        $array_fii[$i][1] = date("h:i A", strtotime($tt));
                        
                    }
                }
                else {
                    $tt = $row["time"];
                    $array_fii[$i][1] = date("h:i A", strtotime($tt));
                }
            } else {
                $tt = $row["time"];
                $array_fii[$i][1] = date("h:i A", strtotime($tt));
            }
            $name_for_link = str_replace("&", "_", $row["name"]);
            $array_fii[$i][2]  = "<a href='BlissDelta_Data.php?%20search1=$name_for_link' target='_blank' name='".$row['name']."' style='color: #FFF; '>" . $row["name"] . "</span>";;
         $i++;
        }//echo serialize($array_fii);
         return $array_fii;
    }
    function get_earning_all($date,$script) {
        $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABSE);
        $pieces = explode("/", $date); // split date with /
        $date1 = $pieces[0]; //take one date
        if (count($pieces) > 1) { // check whether second date is there or not
            $date2 = $pieces[1]; // insert second date
        } else {
            $date2 = 0;
        }
        if($script == "")
        {
        if ($date2 == 0) {
            $sql = "SELECT name,d_name,date,time,max_change,movement,changes,max_Movement,min_Movement FROM `earning2` WHERE date = '$date1'";
        } else {
            $sql = "select name,d_name,date,time,max_change,movement,changes,max_Movement,min_Movement from `earning2` WHERE date between '$date1' and '$date2'";
        }
        }
        else{
            $sql = "SELECT name,d_name,date,time,max_change,movement,changes,max_Movement,min_Movement FROM `earning2` WHERE name like '$script%'";
        }
        $query = mysqli_query($db, $sql) or die("earning_connect.php: get earning2");

       $array_fii[][] = 0;
        $i = 0;
        while ($row = mysqli_fetch_array($query)) {  // preparing an array
            $array_fii[$i][0]  = $row["name"];
           $array_fii[$i][1] = $row['date']; 

            if ($row["time"] == "00:00:00") {
                $name1 = $row["name"];
                $dt1 = $row["date"];
                
                $result2 = mysqli_query($db, "SELECT name,d_name,date,time,max_change,movement FROM `earning2` WHERE name = '$name1' AND changes <> 0 ORDER BY date desc LIMIT 1;"); //get last result time from earning which has changes not zero bcoz we want time from that
                $m = mysqli_num_rows($result2);
                // echo "<br><br>  yes <br><br>".mysql_num_rows($result2);
                $p = 0;
                if ($m > 0) {
                    while ($row1 = mysqli_fetch_row($result2)) { //fetch row one by one in loop
                        $p = $p + 1;
                        if ($p == $m)
                            $tt = $row1[3];
                        $array_fii[$i][2] = date("h:i A", strtotime($tt));
                         $array_fii[$i][3]  = Round($row1[4],1);
                        $array_fii[$i][4]  = Round($row1[5],1);
                    }
                }
                else {
                    $tt = $row["time"];
                    $array_fii[$i][2] = date("h:i A", strtotime($tt));
                     $array_fii[$i][3]  = Round($row["changes"],1);
                $array_fii[$i][4]  = Round($row["movement"],1);
                }
            } else {
                $tt = $row["time"];
                $array_fii[$i][2] = date("h:i A", strtotime($tt));
                 $array_fii[$i][3]  = Round($row["changes"],1);
                $array_fii[$i][4]  = Round($row["movement"],1);
            }
            
             
                  $array_fii[$i][5]  =  "<img src='image/".$row["name"].".jpg' alt='img' height='15' width='20'/>";
         $i++;
        }//echo serialize($array_fii);
         return $array_fii;
    }
     function get_event($date) {
         
        $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABSE);
        mysqli_query($db,'SET CHARACTER SET utf8');
        $pieces = explode("/", $date); // split date with /
        $date1 = $pieces[0]; //take one date
        if (count($pieces) > 1) { // check whether second date is there or not
            $date2 = $pieces[1]; // insert second date
        } else {
            $date2 = 0;
        }
        if($date2 == 0)
        {
           // $sql = "SELECT name,d_name,date,time,max_change FROM `earning2` WHERE date = '$date1' UNION"; 
                 $sql = "SELECT d_name,date,time FROM `earning2` WHERE date = '$date1' UNION SELECT event,date,time FROM `economic_data` WHERE date = '$date1' ";
        }
        else 
        {
             // $sql = "select name,d_name,date,time,max_change from `earning2` WHERE date between '$date1' and '$date2' ORDER BY date desc";
                $sql = "select d_name,date,time from `earning2` WHERE date between '$date1' and '$date2' UNION SELECT event,date,time FROM `economic_data` WHERE date between '$date1' and '$date2' ";
        }
        $query = mysqli_query($db, $sql) or die("earning_connect.php: get earning2");

       $array_fii[][] = 0;
        $i = 0;
        while ($row = mysqli_fetch_array($query)) {  // preparing an array
          

          
                $name1 = $row["d_name"];
              
                  $dt=  $row["date"];
			$dat=date("d M Y", strtotime($dt));
			$day=date("l", strtotime($dt));
			 $tt=$row["time"];
			$time=date("h:i A", strtotime($tt));
               $array_fii[$i][0] = $dat.' | '.$day.' | '.$time ;
            $array_fii[$i][1]  = $row["d_name"];;
         $i++;
        }
           if($date2 == 0)
        {
          $sql = "SELECT scrip,event,date,time FROM `event_scrip` WHERE date = '$date1'";
        } else 
        {
             // $sql = "select name,d_name,date,time,max_change from `earning2` WHERE date between '$date1' and '$date2' ORDER BY date desc";
                $sql = "SELECT scrip,event,date,time FROM `event_scrip` WHERE date between '$date1' and '$date2'";
        }
    $result = mysqli_query($db, $sql); //excute query        
    $n = mysqli_num_rows($result); // give number of rows  
    if ($n > 0) {
        while ($row2 = mysqli_fetch_array($result)) { //fetch row one by one in loop
             $dt=  $row2["date"];
			$dat=date("d M Y", strtotime($dt));
			$day=date("l", strtotime($dt));
			 $tt=$row2["time"];
			$time=date("h:i A", strtotime($tt));
               $array_fii[$i][0] = $dat.' | '.$day.' | '.$time ;
            $array_fii[$i][1]  = $row2["scrip"]." ".$row2["event"];;
         $i++;
        }
    }
     //echo serialize($array_fii);
         return $array_fii;
    }
    function get_event_dashboard($search) {
          $array_fii[][] = 0;
        $i = 0;
         $today = date("Y-m-d");
        $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABSE);
        mysqli_query($db,'SET CHARACTER SET utf8');
        $sql = "SELECT event,date FROM `event_scrip` WHERE  date >= '$today' and scrip = '$search' ORDER BY date asc";
    $result = mysqli_query($db, $sql); //excute query        
    $n = mysqli_num_rows($result); // give number of rows  
    if ($n > 0) {
        while ($row2 = mysqli_fetch_row($result)) { //fetch row one by one in loop
             $row2[1] = date('d M Y', strtotime($row2[1]));
              $array_fii[$i][0] = $row2[1]; ;
            $array_fii[$i][1]  = strtoupper($search)." ".$row2[0];
            $i++;
        }
    }
          
     $sql = "SELECT event,date FROM `economic_data` WHERE  date >= '$today' ORDER BY date asc ";
        $result = mysqli_query($db, $sql); //excute query        
        $n = mysqli_num_rows($result); // give number of rows  
        if ($n > 0) {
          
            while ($row1 = mysqli_fetch_row($result)) { //fetch row one by one in loop
                $row1[1] = date('d M Y', strtotime($row1[1]));
                ;
                if (strpos($row1[0], '(h)') == false) {
                      $array_fii[$i][0] = $row1[1]; ;
            $array_fii[$i][1]  = $row1[0];
                $i++;
                
                } else {
                  
                                   $array_fii[$i][0] = "<span style='color: rgb(132,194,37);'>" . $row1[1]. "</span>";
                                  $array_fii[$i][1]  =  "<span style='color: rgb(132,194,37);'>".  $row1[0]." </span>";
                        $i++;
                                       
                }
            }
        } else {
          
            ?>
                                            <tr>
                                                <td colspan="2"><?php echo 'Date not declared yet'; ?></td>
                                            </tr>
            <?php
        }
        
    
     //echo serialize($array_fii);
         return $array_fii;
    }
}

?>