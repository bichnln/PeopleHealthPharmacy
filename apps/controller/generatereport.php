<?php
    session_start();
    include_once("../../config.php");
    require_once("../model/report.php");
    require_once("../model/prediction.php");
    require_once("../../lib/inc/chartphp_dist.php");
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


    $_SESSION['itemWeekGraph'] = itemWeekPredictionGraphData($week);
    $_SESSION['itemMonthGraph'] = itemMonthPredictionGraphData($month);
    $_SESSION['catWeekGraph'] = catWeekPredictionGraphData($week);
    $_SESSION['catMonthGraph'] = catMonthPredictionGraphData($month);

    function itemWeekPredictionGraphData($time) {
        $data = itemWeekPrediction($time);
        if (count($data) <= 0) {
            return null;
        } else {
            $sales_array = array();
            $series = array();
            array_pop($sales_array);
            foreach ($data as $itemData) {
                $slope = $itemData['slope'];
                $intercept = $itemData['intercept'];
                $sales_data[$itemData['itemName']] = array();
            
                array_push($series, $itemData['itemName']);
                
                for ($i = 0; $i < 5; $i++) {
                
                    $projected = $slope[0] * ($time - $i) + $intercept;
                    $temp = array(strval($time - $i), $projected);
                    array_push($sales_data[$itemData['itemName']], $temp);                
                }
                array_push($sales_array, $sales_data[$itemData['itemName']]);
            }   

            $p = new chartphp();
            $p->data = $sales_array;
            $p->chart_type = "line";
            $p->title = "Projected Sales on weekly basis of Items";
            $p->xlabel = "Week";
            $p->ylabel = "Sales";
            $p->series_label = $series;
            $out = $p->render('c1');

            return $out;
        }   
    }
    function itemMonthPredictionGraphData($time) {
        $data = itemMonthPrediction($time);
        if (count($data) <= 0) {
            return null;
        } 
        $sales_array = array();
        $series = array();
        array_pop($sales_array);
        foreach ($data as $itemData) {
            $slope = $itemData['slope'];
            $intercept = $itemData['intercept'];
            $sales_data[$itemData['itemName']] = array();
           
            array_push($series, $itemData['itemName']);
            
            for ($i = 0; $i < 5; $i++) {
               
                $projected = $slope[0] * ($time - $i) + $intercept;
                $temp = array(strval($time - $i), $projected);
                array_push($sales_data[$itemData['itemName']], $temp);                
            }
            array_push($sales_array, $sales_data[$itemData['itemName']]);
        }   

        $p = new chartphp();
        $p->data = $sales_array;
        $p->chart_type = "line";
        $p->title = "Projected Sales on monthly basis of Items";
        $p->xlabel = "Month";
        $p->ylabel = "Sales";
        $p->series_label = $series;
        $out = $p->render('c1');
        return $out;
    }

    function catWeekPredictionGraphData($time) {
        $data = categoryWeekPrediction($time);
        if (count($data) <= 0) {
            return null;
        }
        $sales_array = array();
        $series = array();
        array_pop($sales_array);
        foreach ($data as $catData) {
            $slope = $catData['slope'];
            $intercept = $catData['intercept'];
            $sales_data[$catData['category']] = array();
           
            array_push($series, $catData['category']);
            
            for ($i = 0; $i < 5; $i++) {
               
                $projected = $slope[0] * ($time - $i) + $intercept;
                $temp = array(strval($time - $i), $projected);
                array_push($sales_data[$catData['category']], $temp);                
            }
            array_push($sales_array, $sales_data[$catData['category']]);
        }   

        $p = new chartphp();
        $p->data = $sales_array;
        $p->chart_type = "line";
        $p->title = "Projected Sales on weekly basis of Categories";
        $p->xlabel = "Week";
        $p->ylabel = "Sales";
        $p->series_label = $series;
        $out = $p->render('c1');

        return $out;
        print_r($out);
    }
    
    function catMonthPredictionGraphData($time) {

        $data = categoryMonthPrediction($time);

        if (count($data) <= 0) {
            return null;
        }
        $sales_array = array();
        $series = array();
        array_pop($sales_array);
        foreach ($data as $catData) {
            $slope = $catData['slope'];
            $intercept = $catData['intercept'];
            $sales_data[$catData['category']] = array();
           
            array_push($series, $catData['category']);
            
            for ($i = 0; $i < 5; $i++) {
               
                $projected = $slope[0] * ($time - $i) + $intercept;
                $temp = array(strval($time - $i), $projected);
                array_push($sales_data[$catData['category']], $temp);                
            }
            array_push($sales_array, $sales_data[$catData['category']]);
        }   

        $p = new chartphp();
        $p->data = $sales_array;
        $p->chart_type = "line";
        $p->title = "Projected Sales on monthly basis of Categories";
        $p->xlabel = "Month";
        $p->ylabel = "Sales";
        $p->series_label = $series;
        $out = $p->render('c1');
        return $out;
    }
   header("location:../view/displayreport.php");

?>
