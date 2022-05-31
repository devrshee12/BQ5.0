
<!-- *********** BY AANGI *************  -->


<?php
include './header.php';
?>


<div class="col-lg-4 col-md-4 col-sm-4">
</div>
<div class="col-lg-4 col-md-4 col-sm-4">


    <?php
    include("db_connect.php");
    // $con = mysqli_connect("127.0.0.1", "root", "", "bliss");//or die("some error occurred during connection" . mysqli_error($con));
    //select database
    //mysqli_select_db($con,"aangi")or die("database is not selected ");
    //mysqli_select_db($con, "bliss")or die("database is not selected ");


    if (isset($_GET['code'])) {
        $get_email = $_GET['email'];
        $get_code = $_GET['code'];

        echo "<h3>" . $get_email . "</h3><br>";
        //echo $get_code;

        $query1 = mysqli_query($con, "select * from bliss_register where email='$get_email' ");
        // $numrow1= mysqli_num_rows($query1);
        //if($numrow1!=0)
        // {

        while ($row1 = mysqli_fetch_array($query1)) {
//echo "fd";
            $db_code = $row1['passreset'];
            $db_email = $row1['email'];

            if ($get_email == $db_email && $get_code == $db_code) {
                echo "
                
                <form data-toggle='validator' role='form' role='form' name='form'  action='reset_password.php?code=$get_code'  method='POST' >    
                   <!-- <div class='form-group'>

                        <input type='password' class='form-control' name='newpass' placeholder='Enter new password' style='color:black'>
                    </div>


                    <div class='form-group'>

                        <input type='password' class='form-control' name='newpass1' placeholder='repeat new password' style='color:black'>
                    </div>-->

                    <input type='hidden' name='email' value='$db_email'>


                    <div class='row'>
                        <div class='col-xs-12 col-sm-12 col-lg-12'>
                            <div class='col-lg-12  form-group' style='padding: 0'><input type='password'  data-minlength='6' id='inputPassword_change' class='form-control'   name='newpass'  placeholder='Enter new password'> 

                                <div class='help-block'>Minimum of 6 characters</div>
                            </div>   
                        </div>
                        <div class='col-xs-12 col-sm-12 col-lg-12  form-group'> 
                            <input type='password' class='form-control'  name='newpass1' id='inputPasswordConfirm_change' data-match='#inputPassword_change' data-match-error='Whoops, these dont match'  placeholder='repeat new password' required/>
                                   <div class='help-block with-errors'></div>
                        </div>
                        <div class='form-group'>
                            <input class='btn-lg btn-block' type='submit' name='submit' value='submit' class='btn btn-primary' style='color:white;background-color:green;border:2px solid #336600;padding:3px'>
                        </div>
                       
                    </div> 
                </form>
                ";
                } else {
                echo "Email / Code does not match";
                }
                }
                //} else {
                //   echo "********";    
                //}
                }




                if (!isset($_GET['code'])) {
                //events on submit 
                echo "<form  onsubmit='return validateform()' name='form'  action='forget_password.php'  method='POST' >    



                    <div class='form-group'>

                        <input type='text' class='form-control' name='email' placeholder='Enter email id' style='color:black'>
                    </div>

                    <div class='form-group'>
                        <input class='form-control' type='submit' name='submit' value='reset password' class='btn btn-primary' style='color:white;background-color:green;border:2px solid #336600;padding:3px'>
                    </div>
                </form>
                ";
                if (isset($_POST['submit'])) {

                //assign values
                //  $username = $_POST['username'];
                $email = $_POST['email'];

                //  $user=$_SESSION['user_id'];
                //$user="aangi";
                //query to fatch email of currenrt user
                $query = mysqli_query($con, "select * from bliss_register where email ='$email'") or die("query didn't work");
                $numrow = mysqli_num_rows($query);

                if ($numrow != 0) {
                while ($row = mysqli_fetch_array($query)) {
                $db_email = $row['email'];
                if ($email === $db_email) {
                $code = rand(100000, 1000000);

                $to = $db_email;
                $subject = "password reset";
                $body = "this is an automated email.please do not reply to this email.

                click the link given below or paste it into your browser.

                http://192.168.119.24/Bq4.0/public_html/forget_password.php?code=$code&email=$db_email
                ";

                mysqli_query($con, "update bliss_register set passreset=$code where email ='$email'") or die("query didn't work");

                mail($to, $subject, $body);

                echo "check your mail.";
                } else {
                echo "<script>alert('Email id is incorrect!')</script>";
                }
                }
                } else {
                echo "<script>alert('username does not exists !')</script>";
                }
                }
                }
                ?>

                <!--validate form-->
                <script>



                    function validateform() {
                        var fields = ["username", "email"];
                        var i, l = fields.length;
                        var fieldname;
                        for (i = 0; i < l; i++)
                        {
                            fieldname = fields[i];
                            if (document.forms["form"][fieldname].value === "")
                            {
                                alert(fieldname + " can not be empty");
                                return false;
                            }
                        }
                        return true;
                    }

                </script>    

            <?php ?>