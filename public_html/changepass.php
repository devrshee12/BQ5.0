<!-- *********** BY AANGI *************  -->

<?php
include_once('register.php');  
  include("db_connect.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  
            // session_start();
                    
                    //connection
          //  $con= mysqli_connect("localhost","aangi","","aangi")or die("some error occurred during connection". mysqli_error($con));
                /*  $con= mysqli_connect("127.0.0.1","root","","bliss")or die("some error occurred during connection". mysqli_error($con));
                     
                     //select database
           //mysqli_select_db($con,"aangi")or die("database is not selected ");
                   mysqli_select_db($con,"bliss")or die("database is not selected ");
                     
 */
                     //events on submit 
                     
                     if(isset($_POST['submit']))
                        {
                         
                            //assign values
                            $oldpassword= $_POST['oldpassword'];
                            $newpassword= $_POST['newpassword'];
                            $repeatnewpassword= $_POST['repeatnewpassword'];
                        
                            
                            //echo $oldpassword."<br>";
                          //  echo $newpassword."<br>";
                            //echo $repeatnewpassword."<br>";
                            //assign session's username to variable
                          // $user= $_POST['username'] ;
                        $user =$_SESSION['user_id'];
                        // $user="jayeshs";
                            
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
                   //echo "database=".$odata['password']."  ==  "."enter=".$oldpassword;
                 
                  // echo " <a href='index.php'> password changed successfully ....go back </a>";
                     //    echo $hash2 $odata['password'];
                         //echo "<br>";
                       // echo  "<br>".password_verify($oldpassword,$odata['password'])."******";
                        
                                               
                  //  if($odata['password']== $oldpassword)   {                  
                     if (password_verify($oldpassword,$odata['password']))
                        {
                          
                                //success
                                //compare new password and repeatnewpassword
                                if($newpassword==$repeatnewpassword)
                                {
                                    //success
                                    //set new password into database
                                    
                                   $encrypted_password=password_hash($newpassword,PASSWORD_DEFAULT);
                                   //$q= mysqli_query($con,"update bliss_register set password='$encrypted_password' where user_id='$user'") or die(mysql_error());
                                    $q= mysqli_query($con,"update bliss_register set password='$encrypted_password' where user_id='$user'") or die(mysql_error());
                                    
                                    
                                    //success
                                    
                                    
                                    if($q)
                                    {
                                    
                                        echo "<script>alert('password changed successfully');"
                                         . "window.location = '".$_SERVER['HTTP_REFERER']."';                                             "
                                                . "</script>";
                                        
                                        //header("location: ".$_SERVER['HTTP_REFERER']); 
                                    }
                                   
                                
                                }
                                
                                //if new and repeatnew password doesn't match
                                else
                                {
                                    //alert message 
                                    echo "<script>alert('new password and repeat-new password is not match ');"
                                         . "window.location = '".$_SERVER['HTTP_REFERER']."';                                             "
                                                . "</script>";
                                }
                            } 
                            
                            //if old password doesn't match 
                            else 
                            {
                                    //alert message 
                                echo "<script>alert('old password not match!');"
                                         . "window.location = '".$_SERVER['HTTP_REFERER']."';                                             "
                                                . "</script>"; 
                            }
                      //   header("location:logout.php"); 
                        }
                        
                        
           
?>

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
            

            
