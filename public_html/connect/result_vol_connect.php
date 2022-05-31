
<?php

$array_all_m = array();
$total_data = 0;
include("../db_connect.php");
//$search = $_POST['search'];
$search = "";
$curr_time = 0;
if ($search == "")
    $sql = "SELECT * FROM `iv`  order by sector ASC";
else {
    $sql = "SELECT * FROM `iv`   where name like '$search%'    order by sector ASC";
}// q AVG VOL >= 33 AND Crt VOL > Q avg VOL by max 5% AND (Qhigh Vol - crt vol)> (crtvol- Q low vol) AND mov >=2.5

$result_scrip = mysqli_query($con, $sql);
$n_scrip = mysqli_num_rows($result_scrip);
if ($n_scrip > 0) {//if($movement[0] >= 3 && $movement[1] >= 3 && $movement[2] >= 3 )
    while ($row = mysqli_fetch_row($result_scrip)) {                                     //inserting all fetch value to array  // echo "hello";
      // $curr_month =  date('m');;; /*get current month to compare*/
        $curr_month = 10; // date('m');;; /*get current month to compare*/
$result_month =  date('m',strtotime($row[15]));;
$last_result_month = $curr_month - 03;
               if ($curr_month == $result_month || $result_month == $last_result_month)
               {
                  $last_date = $row[16];
                        $row[14] = date('d M Y', strtotime($row[14]));

                        if (strpos($row[2], "NIFTY") !== FALSE) {
                            include("../IV_nifty_array.php");
                            // $array_all_m[$total_data][17] = $total_data;
                            $total_data = $total_data + 1;
                        } else {
                            include("../IV_array.php");
                            //   $array_all_m[$total_data][17] = $total_data;
                            $total_data = $total_data + 1;
                        }
                         $curr_time = $row[16];
               }
                    //  }
                
           
    }
}

$curr_time = date("g:i a", strtotime("$curr_time"));
// $Script=array("ADANIPORTS","AMBUJACEM","ASIANPAINT","BAJFINANCE");



echo json_encode(array("a" => $array_all_m, "b" => $curr_time));  //json code to encrypt
// }
?>
         