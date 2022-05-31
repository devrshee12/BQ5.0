<?php
//include("config.php");
//include("../config_server.php");
Class user_privilege
{  private $db;
    function __construct(){
        
         $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABSE);
         if (mysqli_connect_errno()) {

            echo "Error: Could not connect to database.";

            exit;
        }
    }
    
    function __destruct(){
        
    }
    function get_export_privilege(){
        $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABSE);
        $today = date('Y-m-d');
        $query = mysqli_query($db,"select email from `user_privilege` where title = 'export'");
        $n = mysqli_num_rows($query);
        if($n > 0)
        {
            $result_scrip = mysqli_fetch_array($query);
            return $result_scrip;
        }
        else{
            return 0;
        }
        
    }
   
}