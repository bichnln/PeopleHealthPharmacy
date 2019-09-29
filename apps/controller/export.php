<?php 
    session_start();
    require_once("../db_connection.php");   
    
    $name = date('Y-m-d'); // name the exported file using date 
    $filename =  $name . '.csv';    
    $sql = $_SESSION['sqlQuery'];   
    
    $fields = array(); // store fields' name
    
    $handle =  fopen($filename, "w+");      // open file in w+ mode
    $result = mysqli_query($conn, $sql);    // get result of sql query
    
    // push fields'name into fields array
    for ($i = 0; $i < $result->field_count; $i++) {
        $fieldname = mysqli_fetch_field($result)->name;
        array_push($fields, $fieldname);
    }
    // put fields'name into csv file
    fputcsv($handle,$fields);

    // put result to file
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($handle, $row);
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
    
   
    

?>



