<?php 
    session_start();

    $weekly_item = $_SESSION['weekly_item'];
    $monthly_item = $_SESSION['monthly_item'];
    $weekly_category = $_SESSION['weekly_category'];
    $monthly_category = $_SESSION['monthly_category'];

    $name = date('Y-m-d'); // name the exported file using date 
    $filename =  $name . '.csv';    
    
    $handle =  fopen($filename, "w+");      // open file in w+ mode

    for ($i = 0; $i < count($weekly_item); $i++) {
        fputcsv($handle, $weekly_item[$i]);
    }
    fputs($handle, "\n");
    for ($i = 0; $i < count($monthly_item); $i++) {
        fputcsv($handle, $monthly_item[$i]);
    }
    fputs($handle, "\n");
    for ($i = 0; $i < count($weekly_category); $i++) {
        fputcsv($handle, $weekly_category[$i]);
    }
    fputs($handle, "\n");
    for ($i = 0; $i < count($monthly_category); $i++) {
        fputcsv($handle, $monthly_category[$i]);
    }

    fseek($handle, 0);
    
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    header("Pragma: no-cache");
    header("Expires: 0");
    
    fpassthru($handle);
    fclose($handle);
    
    ignore_user_abort(true);
    unlink($filename);  // delete file in server after download
    unset($_SESSION['weekly_item']);
    unset($_SESSION['monthly_item']);
    unset($_SESSION['weekly_category']);
    unset($_SESSION['monthly_category']);
   
    
   
?>




