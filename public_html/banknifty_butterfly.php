<?php
include 'header.php';
?> 
<html>
    <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">

    <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">  
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/BlissData.css">   
    <script >

        $(document).ready(function () {

            var table = $('#iv_vol-table').DataTable({
                "bDestroy": true,
                "processing": true,
                "deferRender": true,
                "lengthMenu": [5, 10, 25, 50, 100],
                "iDisplayLength": 20,
                "paging": false,
                "scrollY": "60vh",
                "dom": ' <"top">t<"bottom"p>',
                "sEmptyTable": "No Script",
                language: {
                    oPaginate: {
                        "sNext": ">",
                        "sPrevious": "<"
                    },
                    // "sInfoFiltered": "" //remove filter label text on searching
                }});
        });
    </script>
</html>
<body>
    <?php
     function recursive_array_search($needle, $haystack) {
                foreach ($haystack as $key => $value) {
                    $current_key = $key;
                    if ($needle === $value OR ( is_array($value) && recursive_array_search($needle, $value) !== false)) {
                        return $current_key;
                    }
                }
                return false;
            }
    if (isset($_SESSION['user_id'])) {
        ?>
        <div class="row">

            <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle  btn-lg" data-toggle="collapse" data-target=".bliss-data-menu">
                        <span class="title_all">Data-Menu</span><span class="glyphicon glyphicon-th"></span>
                    </button>
                </div> 

            </div>



            <?php
            include('./db_connect.php');
            $profit_sort = 0;
//$con=mysqli_connect("192.168.105.179","root","","bliss_vol_all"); 
            $sql6 = "SELECT ATM,ATM_price,options,date,time FROM `all_vol_banknifty` WHERE  date = (SELECT date
FROM `vol_banknifty` ORDER BY entry_number DESC  LIMIT 0, 1) and spot = (SELECT spot
FROM `vol_banknifty` ORDER BY entry_number DESC  LIMIT 0, 1) and delta between 0.01 and 0.99 and options = 'CE'  and days_of_expire > 0";                  //select db

            $result6 = mysqli_query($con, $sql6);
            $n6 = mysqli_num_rows($result6);
            //echo $n6."fsdf";
            if ($n6 > 0) {
                $i = 0;
                while ($row = mysqli_fetch_row($result6)) {
                    if ($row != null) {
                        $data_arr[$i][0] = $row[0];       /* strike */
                        $data_arr[$i][1] = $row[1];  /* premium */
                        $data_arr[$i][2] = $row[2];  /* options */
                        $i++;
                        $last_date1 = $row[3];
                        $last_time = $row[4];
                        $last_time_12h = date("g:i a", strtotime("$last_time"));
                    }
                }
            }
            //echo serialize($data_arr); 
            /* TAKING  all strike,premium and options in $data_arr */
            $k = 0;
            $strike_diff = array(100, 200, 300, 400, 500, 600, 700, 800); /* strike difference that we have to check in butterfly */
            $lot_size1 = 20;
            $lot_size2 = 40;
            $key1 = $key2 = 0;
            $val1 = $val2 = 0;
            $size_data = sizeof($data_arr);

            for ($q = 0; $q < sizeof($strike_diff); $q++)/* check for every strike diff */ {
                for ($j = 0; $j < $size_data; $j++)/* check for every strike */ {
                    $key1 = $key2 = 0;
                    $val1 = $val2 = 0;
                    $val = $data_arr[$j][0];
                    $val1 = $val + $strike_diff[$q]; /* second strike */
                    $val1 = $val1 . "";
                    $val2 = $val1 + $strike_diff[$q]; /* third strike */
                    $val2 = $val2 . "";
                    //echo $val1." ".$val2."<br>";
                    if ($val2 < $data_arr[$size_data - 1]) {
                        $key1 = recursive_array_search($val1, $data_arr); /* give index value of second strike */
                        $key2 = recursive_array_search($val2, $data_arr); /* give index value of third strike */

                        if ($key1 != 0 && $key2 != 0) {
                            //  echo $key2."fs";
                            $arr_index[$k][0] = $j; /* first strike */
                            $arr_index[$k][1] = $key1; /* second strike */
                            $arr_index[$k][2] = $key2; /* third strike */
                            $k++;
                        }
                    }
                }
            }


//echo serialize($arr_index);

            for ($i = 0; $i < sizeof($arr_index); $i++) {/* get index value for butterfly pair */
                $b1 = $arr_index[$i][0];
                $b2 = $arr_index[$i][1];
                $b3 = $arr_index[$i][2];
                /**/
                $profit[$i] = (2 * $data_arr[$b2][1]) - ($data_arr[$b1][1] + $data_arr[$b3][1]); /* get fix loss by 2Short - (Long + Long) */
                $profit[$i] = round($profit[$i]);
                //echo $i;
            }
//echo serialize($profit);
            arsort($profit); /* short by minimum loss */

            $h = 0;
            /* get index value as arrange by sorting */
            foreach ($profit as $key => $value) {
                /* get index of butterfly pair in variables */
                $f1 = $arr_index[$key][0];
                $f2 = $arr_index[$key][1];
                $f3 = $arr_index[$key][2];
                // echo $data_arr[$f1][0]." ".$data_arr[$f2][0]." ".$data_arr[$f3][0]."<br>";
                /* get diff between first 2 strike for ahead calculation */
                $diff = $data_arr[$f2][0] - $data_arr[$f1][0];
                /* get max profit by (diff - first strike)*$lot_size1 + (150 * second strike premimum) - ($lot_size1* third strike premium) */
                $max_gain = Round((($diff - $data_arr[$f1][1]) * $lot_size1 ) + ($lot_size2 * $data_arr[$f2][1]) - ($data_arr[$f3][1] * $lot_size1));
                $total_loss = $profit[$key] * $lot_size1;
                
                if ($total_loss != 0)
                    $reward = round(ABS($max_gain / $total_loss));
                $range = ($data_arr[$f3][0] - $data_arr[$f1][0]);
                if (($total_loss > "-1100" || ($max_gain > 6000 && $reward > 4)) && $range > 300 && $data_arr[$f3][1] > 10) {
                    $butterfly_bn[$h][0] = $data_arr[$f1][0] . "&nbsp;   CE    &nbsp;" . "<span style='color:yellow'>+ 20  </span> &nbsp;@ " . $data_arr[$f1][1];
                    $butterfly_bn[$h][1] = $data_arr[$f2][0] . "&nbsp;   CE    &nbsp;" . "<span style='color:red'>- 40  </span> &nbsp;@ " . $data_arr[$f2][1];
                    $butterfly_bn[$h][2] = $data_arr[$f3][0] . "&nbsp;  CE   &nbsp;" . "<span style='color:yellow'>+ 20  </span> &nbsp;@ " . $data_arr[$f3][1];
                    $butterfly_bn[$h][3] = $total_loss; /* profit * lot size */
                    $butterfly_bn[$h][4] = $max_gain;
                    $butterfly_bn[$h][5] = $data_arr[$f3][0] . " - " . $data_arr[$f1][0]; /* strike range */
                    $butterfly_bn[$h][5] = $butterfly_bn[$h][5] . " (" . ($range) . ")"; /* strike range and its difference) */

                    if ($butterfly_bn[$h][3] >= 0) {
                        $butterfly_bn[$h][6] = "No Risk:" . $max_gain;
                    } else {
                        if (round(ABS($max_gain / $butterfly_bn[$h][3])) > 6) {
                            $butterfly_bn[$h][6] = "1:" . $reward;
                            $profit_sort = ABS($max_gain / $butterfly_bn[$h][3]);
                        } else {
                            $butterfly_bn[$h][6] = "";
                        }
                    }
                    $butterfly_bn[$h][7] = $data_arr[$f3][2];
                    $butterfly_bn[$h][8] = $profit_sort;
                    $h++;
                }
            }
            unset($data_arr);
            unset($arr_index);
            unset($profit);

            $sql6 = "SELECT ATM,ATM_price,options FROM `all_vol_banknifty` WHERE  date = (SELECT date
FROM `vol_banknifty` ORDER BY entry_number DESC  LIMIT 0, 1) and spot = (SELECT spot
FROM `vol_banknifty` ORDER BY entry_number DESC  LIMIT 0, 1) and delta between -0.99 and -0.01 and options = 'PE'  and days_of_expire > 0";                  //select db

            $result6 = mysqli_query($con, $sql6);
            $n6 = mysqli_num_rows($result6);
            // echo $n6;
            if ($n6 > 0) {
                $i = 0;
                while ($row = mysqli_fetch_row($result6)) {
                    if ($row != null) {
                        $data_arr[$i][0] = $row[0];                //take last date of updation assuming that vol_acc table is updating properly
                        $data_arr[$i][1] = $row[1];
                        $data_arr[$i][2] = $row[2];
                        $i++;
                    }
                }
                //  echo serialize($data_arr); 
            }
            $k = 0;
            $strike_diff = array(100, 200, 300, 400, 500, 600, 700, 800); /* strike difference that we have to check in butterfly */

            $size_data = sizeof($data_arr);
            for ($q = 0; $q < sizeof($strike_diff); $q++) {
                for ($j = 0; $j < $size_data; $j++) {
                    $key1 = $key2 = 0;
                    $val = $data_arr[$j][0];
                    $val1 = $val + $strike_diff[$q];
                    $val1 = $val1 . "";
                    $val2 = $val1 + $strike_diff[$q];
                    $val2 = $val2 . "";

                    if ($val2 < $data_arr[$size_data - 1]) {
                        $key1 = recursive_array_search($val1, $data_arr);
                        $key2 = recursive_array_search($val2, $data_arr);

                        if ($key1 != 0 && $key2 != 0) {
                            // echo $key2." ";
                            $arr_index[$k][0] = $j;
                            $arr_index[$k][1] = $key1;
                            $arr_index[$k][2] = $key2;
                            $k++;
                        }
                    }
                }
            }
            for ($i = 0; $i < sizeof($arr_index); $i++) {
                $b1 = $arr_index[$i][0];
                $b2 = $arr_index[$i][1];
                $b3 = $arr_index[$i][2];
                $profit[$i] = (2 * $data_arr[$b2][1]) - ($data_arr[$b1][1] + $data_arr[$b3][1]);
                $profit[$i] = round($profit[$i]);
                //echo $i;
            }
//echo serialize($profit);
            arsort($profit);
            $final = array_keys($profit, max($profit));
            //  echo serialize($profit);
            // echo $final[0];


            foreach ($profit as $key => $value) {

                $f1 = $arr_index[$key][0];
                $f2 = $arr_index[$key][1];
                $f3 = $arr_index[$key][2];
                // echo $data_arr[$f1][0]." ".$data_arr[$f2][0]." ".$data_arr[$f3][0]."<br>";
                $diff = $data_arr[$f2][0] - $data_arr[$f1][0];
                $max_gain = Round((($diff - $data_arr[$f1][1]) * $lot_size1 ) + ($lot_size2 * $data_arr[$f2][1]) - ($data_arr[$f3][1] * $lot_size1));
                // echo $data_arr[$f1][1]." ".$data_arr[$f2][1]." ".$data_arr[$f3][1]." ".($profit[$key]*$lot_size1)." ".$max_gain."<br><br>";
                $total_loss = $profit[$key] * $lot_size1;
                if ($total_loss != 0)
                    $reward = round(ABS($max_gain / $total_loss));

                $range = ($data_arr[$f3][0] - $data_arr[$f1][0]);
                if (($total_loss > "-1100" || ($max_gain > 6000 && $reward > 4)) && $range > 300 && $data_arr[$f1][1] > 10) {
                    $butterfly_bn[$h][0] = $data_arr[$f1][0] . "&nbsp;   PE    &nbsp;" . "<span style='color:yellow'>+ 20  </span> &nbsp;@ " . $data_arr[$f1][1];
                    $butterfly_bn[$h][1] = $data_arr[$f2][0] . "&nbsp;   PE    &nbsp;" . "<span style='color:red'>- 40  </span> &nbsp;@ " . $data_arr[$f2][1];
                    $butterfly_bn[$h][2] = $data_arr[$f3][0] . "&nbsp;  PE   &nbsp;" . "<span style='color:yellow'>+ 20  </span> &nbsp;@ " . $data_arr[$f3][1];
                    $butterfly_bn[$h][3] = $total_loss;
                    $butterfly_bn[$h][4] = $max_gain;
                    $butterfly_bn[$h][5] = $data_arr[$f3][0] . " - " . $data_arr[$f1][0];
                    $butterfly_bn[$h][5] = $butterfly_bn[$h][5] . " (" . $range . ")";
                    $butterfly_bn[$h][6] = "";
                    if ($butterfly_bn[$h][3] >= 0) {
                        $profit_ratio = ABS(Round($max_gain / 100));
                        $butterfly_bn[$h][6] = "0:" . $profit_ratio;
                        $profit_sort = $profit_ratio;
                    } else {
                        if (round(ABS($max_gain / $butterfly_bn[$h][3])) > 1 and ( $data_arr[$f3][0] - $data_arr[$f1][0]) > 200) {
                            $butterfly_bn[$h][6] = "1:" . $reward;
                            $profit_sort = ABS($max_gain / $butterfly_bn[$h][3]);
                        } else {
                            $butterfly_bn[$h][6] = "";
                        }
                    }
                    $butterfly_bn[$h][7] = $data_arr[$f3][2];
                    $butterfly_bn[$h][8] = $profit_sort;
                    $h++;
                }
            }

            array_multisort(/* array_column($butterfly_bn, 6),      SORT_ASC, */
                    array_column($butterfly_bn, 8), SORT_DESC, $butterfly_bn);
            unset($data_arr);
            unset($arr_index);
            unset($profit);

            //    echo $key;
            //echo serialize($butterfly_bn); 
           
            ?>
            <div class=" col-lg-8 col-md-8 col-sm-8 text-center" >
                <span  class="small_font pull-right" id="" style="color:white"> <?php echo "Last Update Time : " . $last_date1 . "   " . $last_time_12h; ?> </span>
    <?php include("butterfly_tab.php"); ?>
                <h3>IV Analytics: Butterfly</h3> 

                <table id="iv_vol-table" class="table table-striped table-bordered text-left">
                    <thead>
                        <tr>
                            <th> Strategy </th>
                            <th> Fix Loss </th>
                            <th> Max Gain </th>
                            <th> Range </th>
                            <th> Risk/Reward </th>


                        </tr>
                    </thead>
    <?php
    for ($i = 0; $i < sizeof($butterfly_bn); $i++) {
        if ($butterfly_bn[$i][6] != "") {

            echo "<tr>" .
            "<td>" . $butterfly_bn[$i][0] . "<br>" . $butterfly_bn[$i][1] . "<br>" . $butterfly_bn[$i][2] . "</td>" .
            //  "<td> Bank Nifty <br>".$butterfly_bn[$i][0]."<br>".$butterfly_bn[$i][1]."<br>".$butterfly_bn[$i][2]."</td>".
            /*  "<td>".$butterfly_bn[$i][1]."</td>".
              "<td>".$butterfly_bn[$i][2]."</td>". */
            "<td>" . $butterfly_bn[$i][3] . "</td>" . //fix loss
            "<td>" . $butterfly_bn[$i][4] . "</td>" . //max gain
            "<td>" . $butterfly_bn[$i][5] . "</td>" . //range
            "<td>" . $butterfly_bn[$i][6] . "</td>" . //risk/reward   
            //"<td>".$butterfly_bn[$i][7]."</td>".//option type
            "</tr>";
        }
    }
    ?>
                </table>
            </div>
        </div>
                    <?php
                } else {

                    echo "<div class='col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 text-center'> 
    	<table class='table table-condensed'>
                   <tr>
                   <div class='panel-heading title_all text-center'> BlissQuants Analytics Data</div> 
                            <div class='panel-body'>        
                                                      
                                   The world is being re-shaped by the convergence of data and technology. You can have data without information, but you can't have information without data. <br><br>At BlissQuants, we gather loads of data related to stock market and works on it by the process of inspecting, transforming, and modeling data with the goal of discovering useful information to support decision-making. <br><br>We do believe that errors using inadequate data are much less than those using no data at all. By performing quantitative analysis of data, we provide useful information that helps you to take right trading decision fearlessly and confidently.<br>
                            </div>
                   </tr>
                   <tr>
                      <div class='col-lg-12 panel-heading text-center'> To Know more about this product, you need to <br><br> <form action='BlissAboutUs.php#collapseFive' method='post'>
                                
                                <input class='btn-lg btn-block text-center blink_me' type='submit'  name='request_button' value='Contact Us'>
                            </form></div></div>
                   </tr>
                   <tr><div> </div></tr>
                   <tr>
                      <div class='col-lg-12  text-center'>Below are available data products </div></div>
                   </tr>
                   <tr>
                       <td>
                           <a href='BlissEarnings.php' > <div class='panel-heading'>Companies' Result <i class='indicator glyphicon glyphicon-chevron-right  pull-right'></i> </div></a>
                            <div class='panel-body'>We collect historical stock price data on the result day, perform our data modeling techniques and project expected stock price change on the result day. This helps option and future traders to create a safe position in some predefined range as per projected stock movement pattern. </div>

                       </td>
                       <td>
                           <a href='BlissEventCalendar.php' >   <div class='panel-heading '>Financial Calendar <i class='indicator glyphicon glyphicon-chevron-right  pull-right'></i></div></a>
                            <div class='panel-body'>BlissCalendar shows the schedule of upcoming events like GDP data, FED meeting, earing season, or holiday; which helps stock and option traders to take right decision of entry, hold or exit on position. </div>
                                 
                       </td>
                   </tr>
                   
                   <tr>
					    <td>
                                    <a href='BlissIndiaVix.php' > <div class='panel-heading '>VIX -  Volatility Index   <i class='indicator glyphicon glyphicon-chevron-right  pull-right'></i></div></a>
                                          <div class='panel-body'>VIX movement has lot to say about its index movement and stock market trend. It’s an interesting analogy to explore about an upcoming big move of Indian and global stock market.    
                                            </div>

                                </td>
						 <td>
                           <a href='Bliss_Fii_Dii_Data.php' >   <div class='panel-heading '>Fii Dii Data <i class='indicator glyphicon glyphicon-chevron-right  pull-right'></i></div></a>
                      <div class='panel-body'> Implied volatility is an essential ingredient to the option pricing Black and Scholes model. We analyze historical IV of option and compute its peak and bottom. This greatly helps option delta hedgers to create and manage short and long gamma delta positions. <a href='BlissAboutUs.php#collapseFive' onclick='location.reload();'>Contact us</a>, for more details.   </div>

                       </td>
                                     
                      
                   </tr>
                   
                       
                          
                </table> 
                                     
                        <a href='#' data-toggle='modal' data-target='#Register-modal'><input class=' btn-lg btn-block text-center'  value='Request a Demo'></a>  

                    
   </div>
  ";
                }
                ?>
</body>

<script>

    var curr_link;

    var splitname = document.URL.split("?", 1);

    for (var i = 0; i < document.links.length; i++) {

        if (document.links[i].href == splitname) {

            document.links[i].style.color = "WHite";


        }

    }
</script>

