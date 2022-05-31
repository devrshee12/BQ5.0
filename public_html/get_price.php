<?php

include './db_connect.php';
//$_POST['id'] = "A Kickstart with the Stock Market Basics";
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM payment_plan where name = '" . $_POST['id'] . "'";
    $result_scrip = mysqli_query($con, $sql);
    $n_scrip = mysqli_num_rows($result_scrip);
    // echo $n_scrip;
    if ($n_scrip > 0) {

        $row = mysqli_fetch_array($result_scrip);
        //  echo serialize($row);
    }
    // $selected = ($crow['id'] == $catid) ? 'selected' : ''; 

    echo json_encode($row);
}
?>