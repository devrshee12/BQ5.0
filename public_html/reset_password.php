<!-- *********** BY AANGI *************  -->

<?php
 include './header.php';
  include './db_connect.php';
         ?>





<?php

            
   if(isset($_POST['submit']))
   {
$newpass=$_POST['newpass'];
$newpass1=$_POST['newpass1'];
$post_username=$_POST['email'];
$code=$_GET['code'];

if($newpass == $newpass1)
{
            $encrypted_password=password_hash($newpass,PASSWORD_DEFAULT);
    
            //$encrypted_password=password_hash($newpass,PASSWORD_DEFAULT);
            $q= mysqli_query($con,"update bliss_register set password='$encrypted_password' where email='$post_username'") or die(mysql_error());    
            //$q= mysqli_query($con,"update bliss_register set password='$encrypted_password' where user_id='$post_username'") or die(mysql_error());
            $q= mysqli_query($con,"update bliss_register set passreset=0 where email='$post_username'") or die(mysql_error());
            
            
            echo "<script>alert('your password has been updated')</script> <a href='index.php'>click here to login</a>";
} else {
echo "<script>alert('password must match')</script><a href='forget_password.php?code=$code&username=$post_username'>click here to go back.";   
}
   } else {
       echo "*****************";       
}
?>


 