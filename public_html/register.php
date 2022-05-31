<?php

include "config.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class register {

    private $db;

    function __construct() {

        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABSE);
        if (mysqli_connect_errno()) {

            echo "Error: Could not connect to database.";

            exit;
        }
    }

    // destructor  
    function __destruct() {
        
    }

    public function UserRegister($user_id, $email, $password, $country, $pincode, $birthyear, $interest, $role, $name, $mobile, $company, $org_email) {
        $db = $this->db;
        $today = '1991-09-30';
        $org_today = date('Y-m-d');
        $email = strtolower($email);
        $user_id = strtolower($user_id);
        // and register_date = '1991-09-30'
        //  $password = md5($password); 
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
        $qr = mysqli_query($db, "INSERT INTO bliss_register(user_id, email, password,country, pincode,birthyear,interest,role,register_date,name,mobile,company,first_date,email_org) values('" . $user_id . "','" . $email . "','" . $encrypted_password . "','" . $country . "','" . $pincode . "','" . $birthyear . "','" . $interest . "','" . $role . "','" . $today . "','" . $name . "','" . $mobile . "','" . $company . "','" . $org_today . "','" . $org_email . "')") or die(mysql_error());


        return $qr;
    }

    public function confirm_update($passkey, $email) {
        $db = $this->db;
        //  $password = md5($password); 
        //  echo $passkey." ".$email ;
        $qr = mysqli_query($db, "UPDATE bliss_register SET email = '$email'  where email = '$passkey'") or die(mysql_error());
        return $qr;
    }

    public function confirm_update_date($email) {
        $db = $this->db;
        $res = mysqli_query($db, "SELECT * FROM bliss_register WHERE (email = '" . $email . "' OR user_id = '" . $email . "') ");
        $user_data = mysqli_fetch_array($res);
        //print_r($user_data);  
        //$no_rows = mysqli_num_rows($res);
        $interest = $user_data['interest'];

        if ($interest == 'Basic') {
            $today = "2030-12-12";
            $plan = "FREE";
        } else {

            $today = date('Y-m-d');
            $plan = "";
        }
        // echo $passkey." ".$email ;
        $qr = mysqli_query($db, "UPDATE bliss_register SET register_date = '$today',plan = '$plan'  where email = '$email'") or die(mysql_error());
        return $qr;
    }

    public function Login($email, $password) {
        $db = $this->db;
        //  $encrypted_password=password_hash($password,PASSWORD_DEFAULT);
        $res = mysqli_query($db, "SELECT * FROM bliss_register WHERE (email = '" . $email . "' OR user_id = '" . $email . "') and register_date <> '1991-09-30' ");
        $user_data = mysqli_fetch_array($res);
        //print_r($user_data);  
        $no_rows = mysqli_num_rows($res);
        $register_date = $user_data['register_date'];
        //Convert it into a timestamp.
        $now = strtotime(date('Y-m-d'));
        //Get the current timestamp.
        $then = strtotime($register_date);

        //Calculate the difference.
        $difference = $now - $then;
        $session_id = "";//$user_data['session_id'];
        //$email = strtolower($email);
        //echo $difference;
        //Convert seconds into days.
        if ($session_id == '') {
            $day_diff = floor($difference / (60 * 60 * 24));
            if ($no_rows == 1) {
                if ($register_date != '1991-09-30') {
                    if ($day_diff < 30 || $register_date == '0000-00-00') {

                        if (password_verify($password, $user_data['password'])) {

                            $_SESSION['login'] = true;
                            //  $_SESSION['uid'] = $user_data['id'];  
                            $_SESSION['user_id'] = strtolower($user_data['user_id']);
                            $_SESSION['email'] = strtolower($user_data['email']);
                            if ($user_data['role'] == 'leader') {
                                $_SESSION['leader'] = $user_data['leader_name'];
                            } elseif ($user_data['role'] == 'admin') {
                                $_SESSION['admin'] = $user_data['leader_name'];
                            }
                            $_SESSION['plan'] = $user_data['plan'];
                            $_SESSION['mobile'] = $user_data['mobile'];
                            $_SESSION['sess_id'] = session_id();
                            $result = mysqli_query($db, "update `bliss_register` set session_id = '" . $_SESSION['sess_id'] . "' WHERE email = '" . $email . "' OR user_id = '" . $email . "'");
                            return "TRUE";
                        } else {
                            return "Username / Password  Not Match";
                        }
                    } else {
                        return "Your account has been expired please contact company";
                    }
                } else {
                    return "Your account not activated yet. It will be done within 24 hours of your registeration";
                }
            } else {
                return "Emailid is not Registered";
            }
        } else {
            return "You are already login in other machine";
        }
    }

    public function User_detail($email) {
        $db = $this->db;
        //  $encrypted_password=password_hash($password,PASSWORD_DEFAULT);
        $res = mysqli_query($db, "SELECT * FROM bliss_register WHERE (email = '" . $email . "' OR user_id = '" . $email . "') ");
        $user_data = mysqli_fetch_array($res);
        //print_r($user_data);  
        return $user_data;
        // $no_rows = mysqli_num_rows($res);  
        //  $register_date = $user_data['register_date'];
    }

    public function isUserExist($email) {
        $db = $this->db;
        $qr = mysqli_query($db, "SELECT * FROM bliss_register WHERE email = '" . $email . "'");
        echo $row = mysqli_num_rows($qr);
        if ($row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function re_authenticate($email) {
        $db = $this->db;
        $qr = mysqli_query($db, "SELECT session_id FROM bliss_register WHERE email = '" . $email . "'");
        $row = mysqli_fetch_row($qr);

        if ($row[0] == session_id()) {
            // echo "true";
            return true;
        } else {// echo "true";
            session_destroy();
            return false;
        }
    }

}
