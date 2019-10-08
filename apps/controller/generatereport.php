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
    if (is_null($_POST['group_by']) || ($_POST['group_by'] === "month")) {
        $group_by = "Month";
    } else {
        $group_by = "Week";
    }

    $sqlResult = getSQLResult($from, $to, $group_by);
    $_SESSION["sqlResult"] = $sqlResult;
    
    header("location:../view/displayreport.php");
?>