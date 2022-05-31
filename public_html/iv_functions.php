<?php
function quarter_detail($date_for_detail) {
    //$date_for_detail = "2018-03-13";
    $quarter_num = array(01, 04, 07, 10); //start month of quarter
    $curr_month = date('m', strtotime($date_for_detail));
    $firstmonth_quarter = closestnumber($curr_month, $quarter_num); //get nearest less number in array
    $year = date('Y', strtotime($date_for_detail));
//if ($firstmonth_quarter != 01) {


    $pre_start_date = $year . "-" . ($firstmonth_quarter) . "-01";

    $pre_end_date = $year . "-" . ($firstmonth_quarter + 2) . "-30";
    $firstmonth = substr(date('F', strtotime($pre_start_date)), 0, 1);
    $secondmonth = substr(date('F', strtotime('+1 month', strtotime($pre_start_date))), 0, 1);
    $thirdmonth = substr(date('F', strtotime('+2 month', strtotime($pre_start_date))), 0, 1);


    $quarter = $firstmonth . "-" . $secondmonth . "-" . $thirdmonth;
    $quarter_detail = array("start_date" => $pre_start_date, "last_date" => $pre_end_date, "quarter" => $quarter, "year" => $year);
    return $quarter_detail;
}

function closestnumber($number, $candidates) {
    $last = null;
    foreach ($candidates as $cand) {
        if ($cand < $number) {
            $last = $cand;
        } else if ($cand == $number) {
            return $number;
        } else if ($cand > $number) {
            return $last;
        }
    }
    return $last;
}