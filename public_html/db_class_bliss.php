<?php
// DB.class.php

class db_class_bliss {  
        function __construct() {  
            include('db_connect.php');  
          /*  $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);  
            mysqli_select_db($con,DB_DATABSE );  
            if(!$con)// testing the connection  
            {  
                die ("Cannot connect to the database");  
            }   */
              //echo serialize($con);
            return $con;  
          
        }  
        public function Close(){  
            mysqli_close();  
        }  
    }  