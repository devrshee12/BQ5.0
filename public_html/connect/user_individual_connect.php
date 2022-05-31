<?php

include_once("config.php");

Class user_individual_connect {

    private $db;

    function _construct() {

        // $this->db = new mysqli(DB_HOSTS, DB_USER, DB_PASSWORD, DB_DATABSE);
        // echo "hrllo";
        if (mysqli_connect_errno()) {
            //echo "Could not connect BlissQuants Database";
        }
    }

    function get_page_data($email) {

        $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABSE);
        
        $query = mysqli_query($db, "select pages from `user_pages` where email_id = '" . $email . "'");
        $page_name = mysqli_fetch_row($query);
        // echo $ATM_vol[0];
        $pages = explode(",", $page_name[0]);
        return $pages;
    }

    
}

?>