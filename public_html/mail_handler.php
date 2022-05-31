<?php 
$dsf = $_POST['email'];
echo $dsf;
if (isset($_POST['email']))  {
  $user_email = $_POST['email'];
  //Email information
  $admin_email = "Vineet.Jain@blissquants.com";
  $f_name= $_POST['fname'];
  $email = $f_name.'<'.$user_email.'>';      
  $subject = $_POST['range2'];
  $company =$_post['company'];
  $investing = $_POST['range'];
  $comment = 'company:-'.$_POST['company'].',investing_background:-'.$_POST['investing'].',Message:-'.$_POST['message'];
  echo "Thank you for contacting us!";
  //send email
  mail($admin_email, "$subject", $comment, "From:" . $email);
  
  //Email response
  header("http://www.blissquants.com/BlissAboutUs.php#collapseFive");
  echo "Thank you for contacting us!";
  }
?>