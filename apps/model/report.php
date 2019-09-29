<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="author" content="Le Ngoc Bich Nguyen"/>
    <meta name="description" content="DP2 Project"/>
</head>

<body>
    
    <?php 
   
    function getSQLResult($from, $to) {
        include("../db_connection.php");

        $sql="";
        $fetchedArray = array(array());
        array_pop($fetchedArray);
        // generate report of all sales if both from and to date are not specified
        if (($to === "" ) && ($to === "")) {
            $sql = "SELECT Sales_Record.itemID,
                             Inventory_Record.itemName,
                             Inventory_Record.itemPrice,
                             SUM(Sales_Record.qty) as TotalQuantity,
                             (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                             EXTRACT(MONTH FROM Sales_Record.salesDate) as Month
                      FROM Sales_Record 
                      INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                      GROUP BY itemID, Month
                      ORDER BY TotalQuantity DESC;";
        } else { // if either $to or $from is specified
            if (($from !== "" ) && ($to === "")) {  // if only $from is specified
                $sql = "SELECT Sales_Record.itemID,
                             Inventory_Record.itemName,
                             Inventory_Record.itemPrice,
                             SUM(Sales_Record.qty) as TotalQuantity,
                             (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                             EXTRACT(MONTH FROM Sales_Record.salesDate) as Month
                      FROM Sales_Record 
                      INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                      WHERE CAST(Sales_Record.salesDate AS DATE) >= '" . $from ."'                      
                      GROUP BY itemID, Month
                      ORDER BY TotalQuantity DESC;";
            } else if (($from === "") &&($to !== "")) { // if only $to is specified
                $sql = "SELECT Sales_Record.itemID,
                             Inventory_Record.itemName,
                             Inventory_Record.itemPrice,
                             SUM(Sales_Record.qty) as TotalQuantity,
                             (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                             EXTRACT(MONTH FROM Sales_Record.salesDate) as Month
                      FROM Sales_Record 
                      INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                      WHERE CAST(Sales_Record.salesDate AS DATE) <= '" . $to ."'                      
                      GROUP BY itemID, Month
                      ORDER BY TotalQuantity DESC;";
            } else { // if both are specified
                $sql = "SELECT Sales_Record.itemID,
                                Inventory_Record.itemName,
                                Inventory_Record.itemPrice,
                                SUM(Sales_Record.qty) as TotalQuantity,
                                (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                EXTRACT(MONTH FROM Sales_Record.salesDate) as Month
                        FROM Sales_Record 
                        INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                        WHERE CAST(Sales_Record.salesDate AS DATE) >= '" . $from . "' AND CAST(Sales_Record.salesDate AS DATE) <= '" . $to . "'                      
                        GROUP BY itemID, Month
                        ORDER BY TotalQuantity DESC;";   
            }
        }         
            if (! $result = mysqli_query($conn, $sql)) {
                echo "MySQL error " . mysqli_error($conn);
            } else {
                $result = mysqli_query($conn, $sql);
                $fields = array();
                for ($i = 0; $i < $result->field_count; $i++) {
                    $fieldname = mysqli_fetch_field($result)->name;
                    array_push($fields, $fieldname);
                }
                array_push($fetchedArray, $fields);
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($fetchedArray, $row);
                }
            }
            return $fetchedArray;
            
    }
    ?>
</body>

</html>