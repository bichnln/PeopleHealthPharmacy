<?php
    session_start();
    require_once("../model/report.php");
    $from = "";
    $to = "";
    $group_by = "";
    
    if (!is_null($_POST['from_date'])) {
        $from = $_POST['from_date'];
    }

    if (!is_null($_POST['to_date'])) {
        $to = $_POST['to_date'];
    }

    $_SESSION['monthly_category'] = getMonthlyCategory($from, $to);
    $_SESSION['weekly_category'] = getWeeklyCategory($from, $to);
    $_SESSION['monthly_item'] = getMonthlyItem($from, $to);
    $_SESSION['weekly_item'] = getWeeklyItem($from, $to);
    
    header("location:../view/displayreport.php");


?>