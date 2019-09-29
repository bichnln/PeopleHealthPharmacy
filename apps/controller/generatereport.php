<?php
    session_start();
    require_once("../model/report.php");
    $from = "";
    $to = "";
    
    if (!is_null($_POST['from_date'])) {
        $from = $_POST['from_date'];
    }

    if (!is_null($_POST['to_date'])) {
        $to = $_POST['to_date'];
    }

    $sqlResult = getSQLResult($from, $to);
    $_SESSION["sqlResult"] = $sqlResult;

    header("location:../view/displayreport.php");
?>