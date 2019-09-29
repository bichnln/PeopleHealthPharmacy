<?php 
    session_start();

    $sqlResult = $_SESSION["sqlResult"];

    $name = date('Y-m-d'); // name the exported file using date 
    $filename =  $name . '.csv';    
    
    $handle =  fopen($filename, "w+");      // open file in w+ mode

    for ($i = 0; $i < count($sqlResult); $i++) {
        fputcsv($handle, $sqlResult[$i]);
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
    unset($_SESSION['sqlResult']);
   
    
   
?>




