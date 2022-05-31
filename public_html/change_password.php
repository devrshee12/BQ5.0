<?php
 include './header.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
/* $key=md5('australia');
$salt=md5('australia');

//encrypt
function encrypt($string,$key)
{
	$string=rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$string,MCRYPT_MODE_ECB)));
	return $string;

}
//decrypt
function decrypt($string,$key)
{
	$string=rtrim((mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key,base64_decode($string),MCRYPT_MODE_ECB)));
	return $string;

}
function hashword($string,$salt)
{
	$string=crypt($string,'$1$'.$salt.'$');
	return string;
}
*/
?>



<html>
    <head>
        <title> BlissQuants - Delta Hedging | Fund Management </title>
         <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /> 
         <meta http-equiv="X-UA-Compatible" content="IE=9" /> 
         <meta name="viewport" content="width=device-width, initial-scale=1">
          <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="css/bootsrap-theme.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="bliss_icon.ico" > <!-- Link for Bliss icon-->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'><!--for open seance font--> 
       <script src="js/jquery-1.9.1.js"></script> <!-- for changing scripts(slides)--> 
      <!--   <script src="js/jquery-ui.js"></script>--
       <link href="bootstrap-3.3.4-dist/css/agency.min.css" rel="stylesheet">-->
       
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.9/media/css/jquery.dataTables.css">
        <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/dateformat.js"></script>
        <script src="js/script.js"></script>
        <script src="sudden_movement.js"></script>

        <script type="text/javascript" language="javascript" src="DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
       
                
            
        <link rel="stylesheet" type="text/css" href="css/BlissEventCalendar.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css">

        <style type="text/css">
            .tab-pane{
                background-color: transparent !important;
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
            /*     .nav-tabs > li.active > a,
        .nav-tabs > li.active > a:focus{
            background-color: transparent  !important;
            color: white;
        }
        .nav-tabs{
            border:none;
        }*/





            /*.btn-default:hover{
                background-color: #84C225 !important;
                color: black !important;
            }
            .btn-default:active{
               background-color: #84C225 !important;
            }*/

        </style>
        
         <style>
      #flag{
          color: #000;
      }
 .ui-datepicker {
    background: #474545;
    
    color: #ff0000;
    width: 25%;
    height: 40%;
    font: Euromode;
    position: relative;
    z-index:1050 !important;
 
}
 /*UI for selected date*/
.ui-datepicker-calendar .ui-state-active {  
    background: #84C225; 
    display: none;
}  
/* UI for header*/
.ui-datepicker-header {  
     font: Euromode;
    color: #FFFFFF;  
    font-weight: bold;  
    background:#4f4d4d;
    color: #84C225;
    
} 
/*UI for DAY name*/
.ui-datepicker th {  
  
    color: #84C225;  
    background: #1a1919;
    font: Euromode;
   
}  

.circle {
    
     width: 100%;
    height: 40px;
    background: #ffffff;
    
}
#bar {
  background: #ffffff;
  border: 20px rgb(58, 53, 49);
  height: 100%;
  width: 100%;
  content: " ";
}
#score {
  height: 8px;
  width: 0;
  
}
#grade{
    font-size: 10px;
    width : 25px;
    color:black;
}

      
   .form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 0px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
#date-picker{
    z-index: 200;
}
.account-wall
{
    margin-top: 5px;
    padding: 5px 0px 5px 0px;
    background-color: rgb(58,53,49);;
    -moz-box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
    -webkit-box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
    box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
}
.login-title
{
    color: rgb(132,194,37);
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 116px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
.btn-block{
    background-color: rgb(132,194,37);;
    background: linear-gradient(rgb(132,194,37), rgb(100,130,9));
    color: black;
    -moz-box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
    -webkit-box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
    box-shadow: 0 0 24px rgba(0, 0, 0, 0.8);
}
.dropdown-menu{
    padding: 0;
    width:100px;
}
.omb_btn-facebook {background: #3b5998;}
 .omb_btn-twitter {background: #00aced;}
.omb_btn-google {background: #c32f10;}

  </style>
  
    </head>
    <body >
        <div>
         
     <!-- <div class="col-lg-2 col-md-2 col-sm-2">-->
       <div class="col-md-3">
      
      <!--model popup-->
           
      <!--model end-->
        
    
                
               
                    
               <!--   <div class="model" id="changemodel" tabindex="-1">
                        <div class="model-dialog">
                            <div class="model-content">
                                <div class="model-header">
                                    
                                    <button  class="close"data-dismiss="model">&times;</button>
                                    <h4 class="model-title">change password</h4>
                                </div>
                                    <div class="model-body"> 
               -->
               
                                         <form  onsubmit=" return validateform()"  name="form"  method="post" action="change_password.php">
                    
                <div class="form-group">
               
                <input class="form-control" type="password" name="oldpassword" placeholder="Enter old password"style="color:black">
                           </div> 
                        
                <div class="form-group">
                       
                            <input class="form-control"type="password" name="newpassword"placeholder="Enter new password"style="color:black">
                            </div>
                         
                        
                        <div class="form-group">
                           
                        <input class="form-control"type="password" name="repeatnewpassword"placeholder="Repeat new password"style="color:black">
                            </div>
                
               <div class="form-group">         
                <input class="form-control" type="submit" name="submit" value="change password" class="btn btn-primary" style="color:white;background-color:green;border:2px solid #336600;padding:3px">
                 </div> 
                
                <div class="form-group">
                <input class="form-control"  type="button" name="forget password" value="forget password" class="btn btn-primary" onclick="window.location='forget_password.php'" style="color:white;background-color:green;border:2px solid #336600;padding:3px">
               <!-- <a href="forget_password.php">forget password? click here</a>-->
                     
            </div>
                
            </form>  
             
                       
                                
                           
           
       
    

       </div>
                



               
                    
                        <!--                <form class="form-inline" role="form">
                                                                            <div class="input-group input-group-lg control_color_1">
                                             <div class="input-group-btn " id="b1">
                                                 <input type='button' class="form-control control_color_1" name='b1' onclick="range_sel(this.value)" value="<<" >
                                             </div>
                                             <div class="input-group-btn " id="range_text">
                                                 <input type='text' size="15" name='day' id='day1' class="form-control control_color_1" placeholder="From"  > -
                                             </div>
                                             <div class="input-group-btn ">
                                                      <input type='text' size="15"class="form-control control_color_1"  name='day' id='day2' placeholder="To"  >
                                             </div>
                                             <div class="input-group-btn" id="b2">
                                                 <input type='button' class="form-control control_color_1" name='b2' onclick="range_sel(this.value)" value=">>">
                                             </div>
                                             <div class="input-group-btn" id="b3">
                                                 <input type='button' class="form-control control_color_1" name='b3' onclick="range_sel(this.value)" value="Go">
                                             </div>
                                             <div class="input-group-btn"  width="100%">
                                                 <select name="range" onchange="range_sel(this.value)" class="form-control control_color_1" id="range">
                                                     <option value=""></option>
                                                     <option value="today" >Today</option>
                                                     <option value="week" selected="selected">Week</option>
                                                     <option value="month"> Month</option>
                                                      <option value="range">Range</option>
                                                 </select>
                                             </div>
                                                    </div>
                                        </form>     -->
                

	
                
      <!--  <div div class="modal fade" id="change-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        
                                <div class="modal-header">
                                    
                                   
                                    <h3 class="modal-center">change password</h3>
                                </div>
                                       <div class="modal-dialog" style="width: 30%">
                                        <div class="account-wall">
                                            <form class="form-signin" onsubmit=" return validateform()"  name="form"  method="post" action="changepass.php" >
                    
                <div class="form-group">   
                <input class="form-control" type="password" name="oldpassword" placeholder="Enter old password"style="color:black">
                </div>                          
                        
                
                      <div class="form-group">       
                            <input class="form-control"type="password" name="newpassword"placeholder="Enter new password"style="color:black">
                            
                      </div>
                         
                            <div class="form-group">   
                        <input class="form-control"type="password" name="repeatnewpassword"placeholder="Repeat new password"style="color:black">
                           
                </div>  
                            <button class="btn btn-lg btn-block" type="submit">change password</button>
                
                <button class="btn btn-lg btn-block" type="submit"onclick="window.location='forget_password.php'">forget password</button>
                
                
            </form>  
             
                       
                                    </div> 
            
                            </div>
           
                    
            -->
        
        <!--validate form-->
        <script>
            
            
            
                function validateform() {
                var fields = ["oldpassword","newpassword","repeatnewpassword"];
                var i, l = fields.length;
                var fieldname;
                for(i = 0; i < l; i++) 
                {
                    fieldname = fields[i];
                    if(document.forms["form"][fieldname].value === "") 
                    {
                        alert(fieldname + " can not be empty");
                        return false;
                     }
                }
                return true;
            }
 
            </script>    
            
            <!-- php start--> 
            
            <?php
             //session_start();
                    
                    //connection
          //  $con= mysqli_connect("localhost","aangi","","aangi")or die("some error occurred during connection". mysqli_error($con));
                   $con= mysqli_connect("127.0.0.1","root","","bliss")or die("some error occurred during connection". mysqli_error($con));
                     
                     //select database
           //mysqli_select_db($con,"aangi")or die("database is not selected ");
                   mysqli_select_db($con,"bliss")or die("database is not selected ");
                     
 
                     //events on submit 
                     
                     if(isset($_POST['submit']))
                        {
                         
                            //assign values
                            $oldpassword= $_POST['oldpassword'];
                            $newpassword= $_POST['newpassword'];
                            $repeatnewpassword= $_POST['repeatnewpassword'];
                        
                            //assign session's username to variable
                        // $user=$_SESSION['user_id'];
                         $user="falguniv";
                            
                            //query to fatch password of currenrt user
                            $oqr=mysqli_query($con,"select password from bliss_register where user_id='$user'") or die("query didn't work");
                            
                            //store result into variable
                       //    $odata= mysqli_fetch_row($oqr);
                            

                            
                         $odata= mysqli_fetch_array($oqr);
                         
                            // echo " oldpassword:".$odata['password']."<br>";
                          
                            
                     // $hash = '$2y$10$OCbpB9j36At5YQkAF9OQMuF';
                       
                    //   echo password_needs_rehash($odata['password'], PASSWORD_DEFAULT)."----";
                      /*  echo password_hash($oldpassword,PASSWORD_DEFAULT)." 5/// ".$odata['password'];
                         //if($odata['password']== $oldpassword)
                         // {*/
                   echo $odata['password']." == ".$oldpassword;
                         echo "<br>";
                     //    echo $hash2 $odata['password'];
                         //echo "<br>";
                       // echo  "<br>".password_verify($oldpassword,$odata['password'])."******";
                        
                                               
                   //  if($odata['password']== $oldpassword)                     
                     if (password_verify($oldpassword,$odata['password']))
                        {
                          
                                //success
                                //compare new password and repeatnewpassword
                                if($newpassword==$repeatnewpassword)
                                {
                                    //success
                                    //set new password into database
                                    
                                    $encrypted_password=password_hash($newpassword,PASSWORD_DEFAULT);
                                   // ECHO encrypted_password;
                                    $q= mysqli_query($con,"update bliss_register set password='$encrypted_password' where user_id='$user'") or die(mysql_error());
                                    //$q= mysqli_query($con,"update bliss_register set password='$newpassword' where user_id='$user'") or die(mysql_error());
                                    
                                    //success
                                    
                                    
                                    if($q)
                                    {                                    
                                        echo "<script>alert('password changed successfully')</script>";
                                    }
                                   
                                
                                }
                                
                                //if new and repeatnew password doesn't match
                                else
                                {
                                    //alert message 
                                    echo "<script>alert('new password and repeat-new password is not match ')</script>";
                                }
                            }                             
                            //if old password doesn't match 
                            else 
                            {
                                    //alert message 
                                echo "<script>alert('old password not match!')</script>";    
                            }
                        }
                        
 
?>
            

           
                            
        
        
                               <!-- <div class="model-footer">

                                    <!--<button class="btn btn-primary" data-dismiss="model">close</button>-->
                                <!--</div>
                            </div>
                       </div>

                </div>-->
                  
         
          
          
       
</div>
      
</body>
</html>
         
