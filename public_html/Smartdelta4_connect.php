<?php

//set_error_handler("sqlErrorHandler");
//set_time_limit(12000);
//excel reader file for import data from excel
/* include 'public_html\excel_reader\excel_reader.php';       // include the class
  include("public_html/header.php"); */
//include("header.php");
date_default_timezone_set('Asia/Kolkata');
//$excel = new PhpExcelReader;   
// creates object instance of the class
require_once "PHPExcel-1.8/Classes/PHPExcel.php";

$array_all_m = array();

//setting maximum execution time 
$tmpfname = "//192.168.119.24/tempBliss_192.168.105.174_spider/lossc.xlsx";
$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);
$worksheet = $excelObj->getSheet(0);
$lastRow = $worksheet->getHighestRow();
$format = 'yyyy-mm-dd';
$affected_row = 0;
$total_data = 0;

include('db_connect.php');
include('./db_connect_vol_all.php');
$c_name ;
for ($row = 2; $row <= $lastRow; $row++) {

    if ($worksheet->getCell('I' . $row)->getFormattedValue() != "" && $worksheet->getCell('I' . $row)->getFormattedValue() != 0) {




        $k = 0;

        $c_name1 = $worksheet->getCell('B' . $row)->getValue();
        $c_name1 = rtrim(ltrim(strtolower($c_name1)));

        $array_all_m[$total_data][0] = $c_name1; //script name
        $c_name = $worksheet->getCell('C' . $row)->getFormattedValue();
        $array_all_m[$total_data][1] = $c_name; //script name
        $name = $worksheet->getCell('G' . $row)->getFormattedValue();
        // $array_all_m[$total_data][2] = $name;     //last vol  
        $date = $worksheet->getCell('D' . $row)->getFormattedValue();


        $sec_type = $worksheet->getCell('E' . $row)->getFormattedValue();

        $op_string = preg_replace('/\s+/', ' ', $worksheet->getCell('F' . $row)->getFormattedValue());



        $name = $worksheet->getCell('G' . $row)->getFormattedValue();
        //  echo $strike;                         


        $date = $worksheet->getCell('H' . $row)->getFormattedValue();
        if ($date != "") {
            $date = date("Y-m-d", strtotime($date));
            //   $array_all_m[$total_data][3] = $date;  //high
        } else {
            //$array_all_m[$total_data][3] = $date;  //high
        }

        // echo $date;
        // echo $name;                         

        $date1 = $worksheet->getCell('A' . $row)->getFormattedValue();

        if ($date1 != "") {
            $date1 = date("Y-m-d", strtotime($date1));
            //  $array_all_m[$total_data][4] = $date1;  //high
        } else {
            // $array_all_m[$total_data][4] = $date1;  //high
        }



        $qty = $worksheet->getCell('I' . $row)->getFormattedValue();
        //$array_all_m[$total_data][5] = $qty;  //high

        $op_price = $worksheet->getCell('J' . $row)->getFormattedValue();
        //    $array_all_m[$total_data][6] = $op_price;  //high
        $name = $worksheet->getCell('K' . $row)->getFormattedValue();
        $array_all_m[$total_data][2] = 0;  //high
        $name = $worksheet->getCell('O' . $row)->getFormattedValue();
        $array_all_m[$total_data][3] = $name;  //high
        /* $name = $worksheet->getCell('M' . $row)->getFormattedValue();
          $array_all_m[$total_data][4] = "";  //high
          $name = $worksheet->getCell('N' . $row)->getFormattedValue();
          $array_all_m[$total_data][5] = $name;  //high */
        //$name = $worksheet->getCell('O' . $row)->getFormattedValue();


        $close = 0;
        $ex_days = 0;
        $iv = 0;
        $spot_ten_change = 0;
        $split = explode(" ", $op_string);
        $scrip = $split[0];

        if ($sec_type == 'DERIVATIVES') {



            if ($op_price != 0 || $op_price != "0") {
                if (count($split) > 2) {

                    $op_type = $split[2];
                    ;
                    $strike = $split[3];


                    $table_name_fut = "fut_" . $scrip;
                    //  $array_all_m[$total_data][4] = $strike;  //high
                    //echo $live_price."".$op_price."".$qty;
                    $live_price = get_live_data($strike, $scrip, $date1, $op_type, $con_all);  //high
                    $array_all_m[$total_data][4] = ($live_price - $op_price) * $qty;


                    $sql_close = "SELECT Close,day_left FROM `$table_name_fut` where Date = '$date1'";

                    $result_close = mysqli_query($con, $sql_close);
                    $n_close = mysqli_num_rows($result_close);
                    if ($n_close > 0) {
                        while ($row1 = mysqli_fetch_row($result_close)) {                                     //inserting all fetch value to array  // echo "hello";
                            if ($row1 != null) {//echo serialize($row);
                                $close = Round($row1[0], 1);
                                $ex_days = Round($row1[1], 1);
                            }
                            if ($op_type == "ce" || $op_type == "CE") {
                                $call = "true";
                                $op = 'c';
                            } elseif ($op_type == "pe" || $op_type == "PE") {
                                $op = 'p';
                                $call = "false";
                            }

                            if ($qty < 0) {
                                $total = $live_price * ABS($qty);

                                $margins = ($total * 16) / 100;
                                $array_all_m[$total_data][2] = Round($margins / 100000, 1) . " L";  //high
                                /* $intrest=($margins * 1) /100;
                                  $oneday=$intrest / 30;
                                  $pendingdays=$ex_days * $oneday; */
                            } else {

                                $array_all_m[$total_data][2] = 0;  //high
                            }


                            $spot_ten_change = $close + ($close * 0.1);


                            $iv = Round(option_implied_volatility($call, $close, $strike, 0, $ex_days / 365, $live_price + 1) * 100, 1);
                            $option_price = Round(BlackScholes($op, $spot_ten_change, $strike, $ex_days / 365, 0, $iv + 8), 1);

                            // $call = "true";
                            $spot_ten_change = $close - ($close * 0.1);

                            $option_price2 = Round(BlackScholes($op, $spot_ten_change, $strike, $ex_days / 365, 0, $iv + 8), 1);

                            $array_all_m[$total_data][5] = $option_price * $qty; //." ".$option_price;
                            $array_all_m[$total_data][6] = $option_price2 * $qty; //." ".$option_price;
                            // echo   $op." ".$spot_ten_change." ".$strike." ".$ex_days." ".$iv;
                        }

                        // $
                        //  $ten_change =  ABS((Round($option_price,1) - $position_parts[3]) * ABS($qty)); ; 
                    }
                } else {
                    $live_price = get_live_future($scrip, $con);
                    $array_all_m[$total_data][4] = ($live_price - $op_price) * $qty;
                    // $array_all_m[$total_data][11] = 
                    //   $array_all_m[$total_data][7] = "FU";

                    $spot_ten_change = ($live_price * 0.1) * $qty;
                    $array_all_m[$total_data][5] = Round($spot_ten_change);

                    $array_all_m[$total_data][6] = -Round($spot_ten_change);
                    $total = $live_price * $qty;

                    $margins = ($total * 16) / 100;
                    $array_all_m[$total_data][2] = Round($margins / 100000, 1) . " L";
                    ;  //high
                }
            }
        } else {
            $live_price = get_live_future($scrip, $con);
            $array_all_m[$total_data][4] = ($live_price - $op_price) * $qty;


            //  $array_all_m[$total_data][7] = "EQ";

            $spot_ten_change = ($live_price * 0.1) * $qty;
            $array_all_m[$total_data][5] = Round($spot_ten_change);

            $array_all_m[$total_data][6] = -Round($spot_ten_change);
            $total = $live_price * $qty;

            $margins = ($total * 16) / 100;
            $array_all_m[$total_data][2] = Round($margins / 100000, 1) . " L";
            ;  //high
        }


        $total_data = $total_data + 1;
    }
}

echo json_encode($array_all_m);

//echo serialize($array_all_m);
function get_live_data($strike, $table, $date1, $type, $con_all) {
    $table_name = "vol_" . $table;
    $sql_close = "SELECT ATM_price FROM `$table_name` WHERE  ATM = '$strike' and options = '$type' order by entry_number desc limit 1";
//echo $table_name."".$date1."".$strike."".$table;
    $result_close = mysqli_query($con_all, $sql_close);
    $n_close = mysqli_num_rows($result_close);
    if ($n_close > 0) {
        while ($row1 = mysqli_fetch_row($result_close)) {
            return $row1[0];
        }
    } else {
        return 0;
    }
}

function get_live_future($table, $con) {
    $table_name = "vol_" . $table;
    $sql_close = "SELECT spot FROM `$table_name` order by entry_number desc limit 1";
//echo $table_name."".$date1."".$strike."".$table;
    $result_close = mysqli_query($con, $sql_close);
    $n_close = mysqli_num_rows($result_close);
    if ($n_close > 0) {
        while ($row1 = mysqli_fetch_row($result_close)) {
            return $row1[0];
        }
    } else {
        return 0;
    }
}

function BlackScholes($call_put_flag, $S, $X, $T, $r, $v) {
    $r = $r / 100;
    $v = $v / 100;
    $d1 = ( log($S / $X) + ($r + pow($v, 2) / 2) * $T ) / ( $v * pow($T, 0.5) );
    $d2 = $d1 - $v * pow($T, 0.5);
    if ($call_put_flag == 'c') {
        return $S * CND($d1) - $X * exp(-$r * $T) * CND($d2);
        $nom = "Call Price";
    } else {
        return $X * exp(-$r * $T) * CND(-$d2) - $S * CND(-$d1);
        $nom = 4;
//"Put Price";
    }
}

function CND($x) {
    $Pi = 3.141592653589793238;
    $a1 = 0.319381530;
    $a2 = -0.356563782;
    $a3 = 1.781477937;
    $a4 = -1.821255978;
    $a5 = 1.330274429;
    $L = abs($x);
    $k = 1 / ( 1 + 0.2316419 * $L);
    $p = 1 - 1 / pow(2 * $Pi, 0.5) * exp(-pow($L, 2) / 2) * ($a1 * $k + $a2 * pow($k, 2) + $a3 * pow($k, 3) + $a4 * pow($k, 4) + $a5 * pow($k, 5) );
    if ($x >= 0) {
        return $p;
    } else {
        return 1 - $p;
    }
}

Function OptionDelta($OptionType, $s, $x, $t, $r, $V, $d) {
    If ($x == 0 Or $V == 0 Or $V == 1 Or $t == 0) {
        return 0;
    } Else {
        If ($OptionType == "C") {
            If ($t == 0) {
                If ($s == $x)
                    $OptionDelta = 0.5;
                ElseIf ($s > $x)
                    $OptionDelta = 1;
                ElseIf ($s < $x)
                    $OptionDelta = 0;
            }
            Else {
                $OptionDelta = ndist(dOne($s, $x, $t, $r, $V, $d));
            }
        } ElseIf ($OptionType == "P") {
            If ($t == 0) {
                If ($s == $x)
                    $OptionDelta = -0.5;
                ElseIf ($s > $x)
                    $OptionDelta = 0;
                ElseIf ($s < $x)
                    $OptionDelta = -1;
            }
            Else {
                $OptionDelta = ndist(dOne($s, $x, $t, $r, $V, $d)) - 1;
            }
        }
        return $OptionDelta;
    }
}

Function dOne($s, $x, $t, $r, $V, $d) {
    $log = log($s / $x);
    $sqrt = (sqrt($t));
    $sqr = pow($V, 2);
    $dOne = (log($s / $x) + ($r - $d + 0.5 * $sqr) * $t) / ($V * (sqrt($t)));

    return $dOne;
}

function option_implied_volatility($call, $S, $X, $r, $t, $o) {
// call = Boolean (to calc call, call=True, put: call=false)
// S = stock prics, X = strike price, r = no-risk interest rate
// t = time to maturity
// o = option price
// define some temp vars, to minimize function calls
    $sqt = sqrt($t);
    $MAX_ITER = 100;
    $ACC = 0.0001;

    $sigma = ($o / $S) / (0.398 * $sqt);
    for ($i = 0; $i < $MAX_ITER; $i++) {
        $price = black_scholes($call, $S, $X, $r, $sigma, $t);
        $diff = $o - $price;
        if (abs($diff) < $ACC)
            return $sigma;
        $d1 = (log($S / $X) + $r * $t) / ($sigma * $sqt) + 0.5 * $sigma * $sqt;
        $vega = $S * $sqt * ndist($d1);
        $sigma = $sigma + $diff / $vega;
    }
    return "Error, failed to converge";
}

function ndist($z) {
    return (1.0 / (sqrt(2 * PI()))) * exp(-0.5 * $z);
    //??  Math.exp(-0.5*z*z)
}

function black_scholes($call, $S, $X, $r, $v, $t) {
// call = Boolean (to calc call, call=True, put: call=false)
// S = stock prics, X = strike price, r = no-risk interest rate
// v = volitility (1 std dev of S for (1 yr? 1 month?, you pick)
// t = time to maturity
// define some temp vars, to minimize function calls
    $sqt = sqrt($t);
    $Nd2;  //N(d2), used often
    $nd1;  //n(d1), also used often
    $ert;  //e(-rt), ditto
    $delta;  //The delta of the option

    $d1 = (log($S / $X) + $r * $t) / ($v * $sqt) + 0.5 * ($v * $sqt);
    $d2 = $d1 - ($v * $sqt);

    if ($call) {
        $delta = N($d1);
        $Nd2 = N($d2);
    } else { //put
        $delta = -N(-$d1);
        $Nd2 = -N(-$d2);
    }

    $ert = exp(-$r * $t);
    $nd1 = ndist($d1);

    $gamma = $nd1 / ($S * $v * $sqt);
    $vega = $S * $sqt * $nd1;
    $theta = -($S * $v * $nd1) / (2 * $sqt) - $r * $X * $ert * $Nd2;
    $rho = $X * $t * $ert * $Nd2;

    return ( $S * $delta - $X * $ert * $Nd2);
}

function cumnormdist($x) {
    $b1 = 0.319381530;
    $b2 = -0.356563782;
    $b3 = 1.781477937;
    $b4 = -1.821255978;
    $b5 = 1.330274429;
    $p = 0.2316419;
    $c = 0.39894228;

    if ($x >= 0.0) {
        $t = 1.0 / ( 1.0 + $p * $x );
        return (1.0 - $c * exp(-$x * $x / 2.0) * $t *
                ( $t * ( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
    } else {
        $t = 1.0 / ( 1.0 - $p * $x );
        return ( $c * exp(-$x * $x / 2.0) * $t *
                ( $t * ( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
    }
}

function N($z) {
    $b1 = 0.31938153;
    $b2 = -0.356563782;
    $b3 = 1.781477937;
    $b4 = -1.821255978;
    $b5 = 1.330274429;
    $p = 0.2316419;
    $c2 = 0.3989423;
    $a = abs($z);
    if ($a > 6.0) {
        return 1.0;
    }
    $t = 1.0 / (1.0 + $a * $p);
    $b = $c2 * exp((-$z) * ($z / 2.0));
    $n = (((($b5 * $t + $b4) * $t + $b3) * $t + $b2) * $t + $b1) * $t;
    $n = 1.0 - $b * $n;
    if ($z < 0.0) {
        $n = 1.0 - $n;
    }
    return $n;
}

?>