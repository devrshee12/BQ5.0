<!doctype html>
<?php
include("header.php");

        ?>
 <html>
  <head>
    <title> BlissQuants - Delta Hedging | Fund Management </title>
    <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">
   <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
   <script src="js/jquery-ui.js"></script>
    <script src="js/dateformat.js"></script>
    <script src="js/script.js"></script>
     <script src="js/BlissEventCalendar.js"></script>
     
      <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
          <link rel="stylesheet" type="text/css" href="css/BlissEventCalendar.css" />
      <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">      
    
     <style>
         .tab-pane{
             background-color: transparent !important;             
         }
         
     
   .panel-body  li{
         margin-bottom: 2%;
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
    
        
              input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=number] {
    -moz-appearance:textfield;
}

    .ticker {
        margin:10px;
         width: 400px;
	height: auto;
	
	box-shadow: 0px 0px 10px 1px ;
	background-color: transparent;
	text-align: left;
        padding-left:50px;
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
      <script  type="text/javascript" language="javascript">
          //on enter press go to next field 
          $(document).on('keypress', 'input,select', function (e) {
            //  alert("hello");
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(document.activeElement) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
    });
       
       
       
          window.onload = function() {
          
           
           
    var d = new Date();//current date
                var d_date=d.getDate(); // current date dd ie:-26 if date is 26-08-2016
             
                 var date = new Date();
                var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0); // full last date of month 
                
                var lastdate=lastDay.getDate(); //last date of month ie 31 if date is 31-08-2016
                var lastday=lastDay.getDay(); //last day of month in no ie if monday returns 1
             
               var thu;
               if(lastday < 4) //check last day greater then thursday or not
               {
                    thu =(lastdate - lastday) - 3; //return last thursday of month
                    
               }
               else if(lastday > 4)
               {
                   thu =(lastdate - lastday) + 4; //return last thursday of month
                  
               }
               else
               {
                   thu=lastdate;
               }
               
              
                    var get_day = thu - d_date; // return days left to expiry
                   //  alert(d_date);
                    //alert(get_day);
                    if(get_day < 0){ // check if get_day return negative then we take next month  last thursday as expiry
                          var lastDay = new Date(date.getFullYear(), date.getMonth() + 2, 0); // full last date of next month
                var lastdate2=lastDay.getDate(); // last date of next month
                var lastday=lastDay.getDay();
                 if(lastday < 4)
               {
                    thu =(lastdate2 - lastday) - 3;
                    // alert(lastdate);
               }
               else if(lastday > 4)
               {
                   thu =(lastdate2 - lastday) + 4;
                  //alert(lastday);
               }
               else
               {
                   thu=lastdate2;
               }
                //alert(d_date);
                 //   thu =(lastdate2 - lastday) - 3;
                     d_date = -(lastdate - d_date);
                  //    alert(d_date);
                     get_day = thu - d_date;
                    // alert(thu);
                     }
                     
                document.getElementById("days").value=get_day;
                
                  
                  
                  
                     document.getElementById("requiredmargin").style.display= "none";
                       
                            document.getElementById("marginrequired").style.display= "none"; 
             
                  
                };
          function apply()
          {
              var currentrate=document.getElementById("current_rate").value;
              var op_price=document.getElementById("op_price").value;
               var strike_price=document.getElementById("strike_price").value;
                var days=document.getElementById("days").value;
                var op_type=document.getElementById("op_type").value;
                //alert(op_type);
           //     $("#border").addClass("ticker");
     var iv = 0;
            document.getElementById("margins").innerHTML= 0;
               if(op_type == "CE")
               {
                   iv = option_implied_volatility(true,currentrate,strike_price,0,days/365,op_price).toFixed(3) * 100;
               document.getElementById("margins").innerHTML= iv.toFixed(1) ;
           }
           else{
               iv = option_implied_volatility(false,currentrate,strike_price,0,days/365,op_price).toFixed(3) * 100;
                document.getElementById("margins").innerHTML= iv.toFixed(1) ;
           }
          
             if(iv)
             {
                 // alert(iv);
              }
              else{
               //   alert("fvf");
              }
                     document.getElementById("requiredmargin").style.display= "inline";
                       
             document.getElementById("marginrequired").style.display= "inline";
           
             
          }
          
          function probability(price, target, days, volatility) {

    var p = price;
    var q = target;
    var t = days / 365;
    var v = volatility;

    var vt = v * Math.sqrt(t);
    var lnpq = Math.log(q / p);

    var d1 = lnpq / vt;

    var y = Math.floor(1 / (1 + .2316419 * Math.abs(d1)) * 100000) / 100000;
    var z = Math.floor(.3989423 * Math.exp(-((d1 * d1) / 2)) * 100000) / 100000;
    var y5 = 1.330274 * Math.pow(y, 5);
    var y4 = 1.821256 * Math.pow(y, 4);
    var y3 = 1.781478 * Math.pow(y, 3);
    var y2 = 0.356538 * Math.pow(y, 2);
    var y1 = 0.3193815 * y;
    var x = 1 - z * (y5 - y4 + y3 - y2 + y1);
    x = Math.floor(x * 100000) / 100000;

    if (d1 < 0) {
        x = 1 - x
    }
    ;

    var pbelow = Math.floor(x * 1000) / 10;
    var pabove = Math.floor((1 - x) * 1000) / 10;

    return [pbelow, pabove];
}

function probability_above(price, target, days, volatility) {
    return probability(price, target, days, volatility)[1];
}

function probability_below(price, target, days, volatility) {
    return probability(price, target, days, volatility)[0];
}

function ndist(z) {
    return (1.0 / (Math.sqrt(2 * Math.PI))) * Math.exp(-0.5 * z);
    //??  Math.exp(-0.5*z*z)
}

function N(z) {
    b1 = 0.31938153;
    b2 = -0.356563782;
    b3 = 1.781477937;
    b4 = -1.821255978;
    b5 = 1.330274429;
    p = 0.2316419;
    c2 = 0.3989423;
    a = Math.abs(z);
    if (a > 6.0) {
        return 1.0;
    }
    t = 1.0 / (1.0 + a * p);
    b = c2 * Math.exp((-z) * (z / 2.0));
    n = ((((b5 * t + b4) * t + b3) * t + b2) * t + b1) * t;
    n = 1.0 - b * n;
    if (z < 0.0) {
        n = 1.0 - n;
    }
    return n;
}

function fraction(z) {
// given a decimal number z, return a string with whole number + fractional string
// i.e.  z = 4.375, return "4 3/8"

    var whole = Math.floor(z);
    var fract = z - whole;
    var thirtytwos = Math.round(fract * 32);
    if (thirtytwos == 0) {
        return whole + " ";
    }  //(if fraction is < 1/64)
    if (thirtytwos == 32) {
        return whole + 1;
    }  //(if fraction is > 63/64)

//32's non-trivial denominators: 2,4,8,16
    if (thirtytwos / 16 == 1) {
        return whole + " 1/2";
    }

    if (thirtytwos / 8 == 1) {
        return whole + " 1/4";
    }
    if (thirtytwos / 8 == 3) {
        return whole + " 3/4";
    }

    if (thirtytwos / 4 == Math.floor(thirtytwos / 4)) {
        return whole + " " + thirtytwos / 4 + "/8";
    }

    if (thirtytwos / 2 == Math.floor(thirtytwos / 2)) {
        return whole + " " + thirtytwos / 2 + "/16";
    } else
        return whole + " " + thirtytwos + "/32";

} //end function
function black_scholes(call, S, X, r, v, t) {
// call = Boolean (to calc call, call=True, put: call=false)
// S = stock prics, X = strike price, r = no-risk interest rate
// v = volitility (1 std dev of S for (1 yr? 1 month?, you pick)
// t = time to maturity

// define some temp vars, to minimize function calls
    var sqt = Math.sqrt(t);
    var Nd2;  //N(d2), used often
    var nd1;  //n(d1), also used often
    var ert;  //e(-rt), ditto
    var delta;  //The delta of the option

    d1 = (Math.log(S / X) + r * t) / (v * sqt) + 0.5 * (v * sqt);
    d2 = d1 - (v * sqt);

    if (call) {
        delta = N(d1);
        Nd2 = N(d2);
    } else { //put
        delta = -N(-d1);
        Nd2 = -N(-d2);
    }

    ert = Math.exp(-r * t);
    nd1 = ndist(d1);

    gamma = nd1 / (S * v * sqt);
    vega = S * sqt * nd1;
    theta = -(S * v * nd1) / (2 * sqt) - r * X * ert * Nd2;
    rho = X * t * ert * Nd2;

    return (S * delta - X * ert * Nd2);

} //end of black_scholes

function option_implied_volatility(call, S, X, r, t, o) {
// call = Boolean (to calc call, call=True, put: call=false)
// S = stock prics, X = strike price, r = no-risk interest rate
// t = time to maturity
// o = option price

// define some temp vars, to minimize function calls
    sqt = Math.sqrt(t);
    MAX_ITER = 100;
    ACC = 0.0001;

    sigma = (o / S) / (0.398 * sqt);
    for (i = 0; i < MAX_ITER; i++) {
        price = black_scholes(call, S, X, r, sigma, t);
        diff = o - price;
        if (Math.abs(diff) < ACC)
            return sigma;
        d1 = (Math.log(S / X) + r * t) / (sigma * sqt) + 0.5 * sigma * sqt;
        vega = S * sqt * ndist(d1);
        sigma = sigma + diff / vega;
    }
    return "Error, failed to converge";

} //end of option_implied_volatility
          
          </script>
  </head>
    <body >   
     
        <div class="row wrap">
           
        <div class="col-lg-3 col-md-3 col-sm-3">
          
      </div>
            
               
    <div class="col-lg-6 col-md-6 col-sm-6  text-center "> 
       <div class="title_all text-center">
             Option Calculator
       </div>
    
      
     
            
             
                  <form class="form-horizontal" action="" method="post" >
                 
               <div class="form-group ">
              <label class="col-md-6 btn-lg" for="name">Spot Price:-</label>
              <div class="col-md-6">
                <input type="number" name="current_rate" class="form-control" id="current_rate" style=" color:#000000" value="" autofocus >
              </div>
            </div>
                
               
                
               <div class="form-group">
              <label class="col-md-6 btn-lg" for="email">Option Strike:-</label>
              <div class="col-md-6">    
<!--                   <input type="number" name="nifty" id="nifty" class="form-control" style="color:#000000" value="">-->
               <input type="text" id="strike_price"  name="strike_price" style="color:#000000" class="form-control" >
              </div>
            </div> 
                      <div class="form-group">
              <label class="col-md-6 btn-lg" for="email">Option Price:-</label>
              <div class="col-md-6">
               <input type="number" name="op_price" id="op_price" class="form-control" style="color:#000000" value="" onblur="apply()"> 
              </div>
            </div> 
                
             <div class="form-group">
              <label class="col-md-6 btn-lg" for="email">Time to Expiry:-</label>
              <div class="col-md-6">
                  <input type="text" id="days"  name="days" style="color:#000000" class="form-control" onblur="apply()">
              </div>
            </div> 
                <div class="form-group">
              <label class="col-md-6 btn-lg" for="email">Option Type:-</label>
              <div class="col-md-6">
                  
                      <select class="form-control control_color_1" id="op_type" onchange="apply()" ><option value="CE">CE</option><option value="PE">PE</option></select>
              </div>
            </div> 
                        <div class="form-group">
              <label class="col-md-6 btn-lg"  >Option Implied Volatilty:-</label>
              <div class="col-md-6">
                  
                       <label id="margins" class="btn-lg"></label>
              </div>
              
            </div> 
         
              </form>
            </div>
      
        </div>
 
    
       <?php
include("html/footer.html");    
?>
    </body>
</html>



