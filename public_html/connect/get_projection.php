<?php
$dat1 =  $_POST["ar_data"];
$date1 = $dat1["date1"];
$c_name2 = $dat1["c_name2"];
//$date1 = "2018-03-20";
//$c_name2 ="ASHOKLEY";
$comp_number = 0;
    include("../db_connect.php");
          
//$conn=mysqli_connect("localhost","root","","bliss_option"); 
 
         $table_name = strtolower("vol_".strtolower($c_name2));
          $sql_yesterday = "SELECT date,spot,ATM,ATM_price,ATM_vol,days_of_expire FROM `$table_name` order by entry_number desc limit 1";
                            $result_yesterday = mysqli_query($con, $sql_yesterday);
                            while ($row = mysqli_fetch_row($result_yesterday)) {
                                $date2 = $row[0];
                                $spot= $row[1];
                                $atm=$row[2];
                                $atm_price=$row[3];
                                $get_vol = $row[4];
                                $ex_days= $row[5];                                
                            }
                      

//Convert it into a timestamp.
$then = strtotime($date1);
//Get the current timestamp.
$now = strtotime($date2);
 
//Calculate the difference.
$difference = $now - $then;
 //echo $difference;
//Convert seconds into days.
$day_diff = floor($difference / (60*60*24) );
 
                           //echo $day_diff."hf".$spot." ".$atm." ".$atm_price." ",$ex_days." ";
                           
                           if($ex_days + $day_diff > 0)
                           {
                            $ex_days = $ex_days + $day_diff;
                            $get_vol =  Round(option_implied_volatility(true,$spot,$atm,0,$ex_days/365,$atm_price) * 100,1);
                            echo $get_vol;
                           }
                           else{
                               echo "No Vol";
                           }

function option_implied_volatility($call,$S,$X,$r,$t,$o) { 
// call = Boolean (to calc call, call=True, put: call=false)
// S = stock prics, X = strike price, r = no-risk interest rate
// t = time to maturity
// o = option price
 
// define some temp vars, to minimize function calls
  $sqt = sqrt($t);
  $MAX_ITER = 100;
  $ACC = 0.0001;
 
  $sigma = ($o/$S)/(0.398*$sqt);
  for ($i=0;$i<$MAX_ITER;$i++) {
    $price = black_scholes($call,$S,$X,$r,$sigma,$t);
    $diff = $o-$price;
    if (abs($diff) < $ACC) return $sigma;
    $d1 = (log($S/$X) + $r*$t)/($sigma*$sqt) + 0.5*$sigma*$sqt;
    $vega = $S*$sqt*ndist($d1);
    $sigma = $sigma+$diff/$vega;
  }
  return "Error, failed to converge";
 
}
function ndist($z) {
  return (1.0/(sqrt(2*PI())))*exp(-0.5*$z);
  //??  Math.exp(-0.5*z*z)
}
function black_scholes($call,$S,$X,$r,$v,$t) { 
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
 
  $d1 = (log($S/$X) + $r*$t)/($v*$sqt) + 0.5*($v*$sqt);
  $d2 = $d1 - ($v*$sqt);
 
  if ($call) {
    $delta = N($d1);
    $Nd2 = N($d2);
  } else { //put
    $delta = -N(-$d1);
    $Nd2 = -N(-$d2);
  }
 
  $ert = exp(-$r*$t);
  $nd1 = ndist($d1);
 
  $gamma = $nd1/($S*$v*$sqt);
  $vega = $S*$sqt*$nd1;
  $theta = -($S*$v*$nd1)/(2*$sqt) - $r*$X*$ert*$Nd2;
  $rho = $X*$t*$ert*$Nd2;
 
  return ( $S*$delta-$X*$ert *$Nd2);
 
}
function cumnormdist($x)
{
  $b1 =  0.319381530;
  $b2 = -0.356563782;
  $b3 =  1.781477937;
  $b4 = -1.821255978;
  $b5 =  1.330274429;
  $p  =  0.2316419;
  $c  =  0.39894228;

  if($x >= 0.0) {
      $t = 1.0 / ( 1.0 + $p * $x );
      return (1.0 - $c * exp( -$x * $x / 2.0 ) * $t *
      ( $t *( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
  }
  else {
      $t = 1.0 / ( 1.0 - $p * $x );
      return ( $c * exp( -$x * $x / 2.0 ) * $t *
      ( $t *( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
    }
}
function N($z) {
  $b1 =  0.31938153;
  $b2 = -0.356563782;
  $b3 =  1.781477937;
  $b4 = -1.821255978;
  $b5 =  1.330274429;
  $p  =  0.2316419;
  $c2 =  0.3989423;
  $a= abs($z);
  if ($a>6.0) {return 1.0;} 
  $t = 1.0/(1.0+$a*$p);
  $b = $c2*exp((-$z)*($z/2.0));
  $n = (((($b5*$t+$b4)*$t+$b3)*$t+$b2)*$t+$b1)*$t;
  $n = 1.0-$b*$n;
  if ($z < 0.0) {$n = 1.0 - $n;}
  return $n;
} 
//echo serialize($vol_data);
//echo " <script type='text/javascript'> window.location = 'excel_upload.php'</script>";*/
?>
    