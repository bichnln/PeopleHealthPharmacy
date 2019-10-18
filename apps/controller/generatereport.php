<?php
    session_start();
    require_once("../model/report.php");
    require_once("../model/prediction.php");
    $from = "";
    $to = "";
    $group_by = "";
    $week;
    $month;
    
    function empty_check($input) {
        if (strlen(trim($input)) === 0) {   
            return true;
        } else{
            return false;
        }
    }
    if (!is_null($_POST['from_date'])) {
        $from = $_POST['from_date'];
    }

    if (!is_null($_POST['to_date'])) {
        $to = $_POST['to_date'];
    }

    // TODO: check if empty spaces
    if (isset($_POST['week']) && !empty_check( $_POST['week'])) {
        $date = new DateTime($_POST['week']);
        $week = $date->format("W");
    } else {
        $date = new DateTime(date('Y-m-d'));
        $week = $date->format('W') + 1;
    }

    if (isset($_POST['month']) && !empty_check($_POST['month'])) {
        $date = new DateTime($_POST['month']);
        $month = $date->format("m");
    } else {
        $date = new DateTime(date('Y-m-d'));
        $month = $date->format('m') + 1;
    }

    $_SESSION['monthly_category'] = getMonthlyCategory($from, $to);
    $_SESSION['weekly_category'] = getWeeklyCategory($from, $to);
    $_SESSION['monthly_item'] = getMonthlyItem($from, $to);
    $_SESSION['weekly_item'] = getWeeklyItem($from, $to);
    $_SESSION['itemWeekPrediction'] = itemWeekPrediction($week);
    $_SESSION['itemMonthPrediction'] = itemMonthPrediction($month);
    $_SESSION['catMonthPrediction'] = categoryMonthPrediction($month);
    $_SESSION['catWeekPrediction'] = categoryWeekPrediction($week);
    
    header("location:../view/displayreport.php");


?>