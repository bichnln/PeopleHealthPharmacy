<?php 
    session_start();
    require_once("../model/prediction.php");
    
   


    // check if input is empty or consists of only whitespaces
    // $name is the name of the input
    // trim whitespace at the beginning and end before counting string's length for comparison
    function empty_check($input) {
        if (strlen(trim($input)) === 0) {   
            return true;
        } else{
            return false;
        }
    }

    // TODO: check if empty spaces
    if (isset($_POST['week']) && !empty_check( $_POST['week'])) {
        $date = new DateTime($_POST['week']);
        $week = $date->format("W");
    } else {
        $week =  date('w', date('Y-m-d')) + 1;
    }

    if (isset($_POST['month']) && !empty_check($_POST['month'])) {
        $date = new DateTime($_POST['week']);
        $month = $date->format("m");
    } else {
        $month = date('m', date('Y-m-d')) + 1;
    }

    $_SESSION['itemWeekPrediction'] = itemWeekPrediction($week);
    $_SESSION['itemMonthPrediction'] = itemMonthPrediction($month);
    $_SESSION['catMonthPrediction'] = categoryMonthPrediction($month);
    $_SESSION['catWeekPrediction'] = categoryWeekPrediction($week);

    header("location: ../view/displayprediction.php");

?>