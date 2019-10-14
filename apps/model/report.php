<?php 
    require_once("../db_connection.php");
   

    /*
        Get MONTHLY report of sales, group by ITEM
    */
    function getMonthlyItem ($from, $to) {
        global $conn;
        $sql = "";
        $fetchedArray = array(array());
        array_pop($fetchedArray);

        if (($to === "" ) && ($to === "")) {
            $sql = "SELECT Sales_Record.itemID,
                                            Inventory_Record.itemName,
                                            Inventory_Record.itemPrice,
                                            SUM(Sales_Record.qty) as TotalQuantity,
                                            (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                            EXTRACT(Month FROM Sales_Record.salesDate) as Month
                                    FROM Sales_Record 
                                    INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                    GROUP BY itemID, Month
                                    ORDER BY TotalQuantity DESC;";
        } else if (($from !== "" ) && ($to === "")) {  // if only $from is specified
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
            
        } else if (($from === "") && ($to !=="")) {
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
        } else if (($from !== "") && ($to !== "")) {
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

        if ($result = mysqli_query($conn, $sql)) {
            $fields = array();
            for ($i = 0; $i < $result->field_count; $i++) {
                $fieldname = mysqli_fetch_field($result)->name;
                array_push($fields, $fieldname);
            }
            array_push($fetchedArray, $fields);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($fetchedArray, $row);
            }
        } else {
            echo "<p>Error: " .  mysqli_error($conn). "</p>";
        }

        return $fetchedArray;
    }

    /*
        Get WEEKLY report of sales, group by ITEM
    */
    function getWeeklyItem($from, $to) {
        global $conn;
        $sql = "";
        $fetchedArray = array(array());
        array_pop($fetchedArray);

        if (($to === "" ) && ($to === "")) {
            $sql = "SELECT Sales_Record.itemID,
                                            Inventory_Record.itemName,
                                            Inventory_Record.itemPrice,
                                            SUM(Sales_Record.qty) as TotalQuantity,
                                            (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                            EXTRACT(WEEK FROM Sales_Record.salesDate) as Week
                                    FROM Sales_Record 
                                    INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                    GROUP BY itemID, Week
                                    ORDER BY TotalQuantity DESC;";
        } else if (($from !== "" ) && ($to === "")) {  // if only $from is specified
            $sql = "SELECT Sales_Record.itemID,
                                        Inventory_Record.itemName,
                                        Inventory_Record.itemPrice,
                                        SUM(Sales_Record.qty) as TotalQuantity,
                                        (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                        EXTRACT(WEEK FROM Sales_Record.salesDate) as Week
                                FROM Sales_Record 
                                INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                WHERE CAST(Sales_Record.salesDate AS DATE) >= '" . $from ."'                      
                                GROUP BY itemID, Week
                                ORDER BY TotalQuantity DESC;";

            
        } else if (($from === "") && ($to !=="")) {
            $sql = "SELECT Sales_Record.itemID,
                                        Inventory_Record.itemName,
                                        Inventory_Record.itemPrice,
                                        SUM(Sales_Record.qty) as TotalQuantity,
                                        (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                        EXTRACT(WEEK FROM Sales_Record.salesDate) as Week
                                FROM Sales_Record 
                                INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                WHERE CAST(Sales_Record.salesDate AS DATE) <= '" . $to ."'                      
                                GROUP BY itemID, Week
                                ORDER BY TotalQuantity DESC;";
        } else if (($from !== "") && ($to !== "")) {
            $sql = "SELECT Sales_Record.itemID,
                                        Inventory_Record.itemName,
                                        Inventory_Record.itemPrice,
                                        SUM(Sales_Record.qty) as TotalQuantity,
                                        (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                        EXTRACT(WEEK FROM Sales_Record.salesDate) as Week
                                FROM Sales_Record 
                                INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                WHERE CAST(Sales_Record.salesDate AS DATE) >= '" . $from . "' AND CAST(Sales_Record.salesDate AS DATE) <= '" . $to . "'                      
                                GROUP BY itemID, Week
                                ORDER BY TotalQuantity DESC;";
        }    

        if ($result = mysqli_query($conn, $sql)) {
            $fields = array();
            for ($i = 0; $i < $result->field_count; $i++) {
                $fieldname = mysqli_fetch_field($result)->name;
                array_push($fields, $fieldname);
            }
            array_push($fetchedArray, $fields);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($fetchedArray, $row);
            }
        } else {
            echo "<p>Error: " .  mysqli_error($conn). "</p>";
        }

        return $fetchedArray;
    }

    /*
        Get MOTNHLY report of sales, group by CATEGORY
    */
    function getMonthlyCategory($from, $to) {
        global $conn;
        $sql = "";
        $fetchedArray = array(array());
        array_pop($fetchedArray);

        if (($to === "" ) && ($to === "")) {
            $sql = "SELECT Inventory_Record.category as Category,
                                                SUM(Sales_Record.qty) as TotalQuantity,
                                                (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                                EXTRACT(MONTH FROM Sales_Record.salesDate) as Month
                                        FROM Sales_Record 
                                        INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                        GROUP BY Category, Month
                                        ORDER BY TotalQuantity DESC;";

        } else if (($from !== "" ) && ($to === "")) {  // if only $from is specified
            $sql = "SELECT Inventory_Record.category as Category,
                                                    SUM(Sales_Record.qty) as TotalQuantity,
                                                    (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                                    EXTRACT(MONTH FROM Sales_Record.salesDate) as Month
                                            FROM Sales_Record 
                                            INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                            WHERE CAST(Sales_Record.salesDate AS DATE) >= '" . $from ."' 
                                            GROUP BY Category, Month
                                            ORDER BY TotalQuantity DESC;";

            
        } else if (($from === "") && ($to !=="")) {
            $sql = "SELECT Inventory_Record.category as Category,
                                                    SUM(Sales_Record.qty) as TotalQuantity,
                                                    (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                                    EXTRACT(MONTH FROM Sales_Record.salesDate) as Month
                                            FROM Sales_Record 
                                            INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                            WHERE CAST(Sales_Record.salesDate AS DATE) <= '" . $to ."'           
                                            GROUP BY Category, Month
                                            ORDER BY TotalQuantity DESC;";
        } else if (($from !== "") && ($to !== "")) {
            $sql = "SELECT Inventory_Record.category as Category,
                                            SUM(Sales_Record.qty) as TotalQuantity,
                                            (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                            EXTRACT(MONTH FROM Sales_Record.salesDate) as Month
                                    FROM Sales_Record 
                                    INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                    WHERE CAST(Sales_Record.salesDate AS DATE) >= '" . $from . "' AND CAST(Sales_Record.salesDate AS DATE) <= '" . $to . "'             
                                    GROUP BY Category, Month
                                    ORDER BY TotalQuantity DESC;";
        }    

        if ($result = mysqli_query($conn, $sql)) {
            $fields = array();
            for ($i = 0; $i < $result->field_count; $i++) {
                $fieldname = mysqli_fetch_field($result)->name;
                array_push($fields, $fieldname);
            }
            array_push($fetchedArray, $fields);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($fetchedArray, $row);
            }
        } else {
            echo "<p>Error: " .  mysqli_error($conn). "</p>";

        }

        return $fetchedArray;
    }
    /*
        Get WEEKLY report of sales, group by CATEGORY
    */
    function getWeeklyCategory($from, $to) {
        global $conn;
        $sql = "";
        $fetchedArray = array(array());
        array_pop($fetchedArray);

        if (($to === "" ) && ($to === "")) {
            $sql = "SELECT  Inventory_Record.category as Category,
                                                SUM(Sales_Record.qty) as TotalQuantity,
                                                (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                                EXTRACT(WEEK FROM Sales_Record.salesDate) as Week
                                        FROM Sales_Record 
                                        INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                        GROUP BY Category, Week
                                        ORDER BY TotalQuantity DESC;";

        } else if (($from !== "" ) && ($to === "")) {  // if only $from is specified
            $sql = "SELECT  Inventory_Record.category as Category,
                                                    SUM(Sales_Record.qty) as TotalQuantity,
                                                    (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                                    EXTRACT(WEEK FROM Sales_Record.salesDate) as Week
                                            FROM Sales_Record 
                                            INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                            WHERE CAST(Sales_Record.salesDate AS DATE) >= '" . $from ."' 
                                            GROUP BY Category, Week
                                            ORDER BY TotalQuantity DESC;";

            
        } else if (($from === "") && ($to !=="")) {
            $sql = "SELECT  Inventory_Record.category as Category,
                                            SUM(Sales_Record.qty) as TotalQuantity,
                                            (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                            EXTRACT(WEEK FROM Sales_Record.salesDate) as Week
                                    FROM Sales_Record 
                                    INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                    WHERE CAST(Sales_Record.salesDate AS DATE) <= '" . $to ."'           
                                    GROUP BY Category, Week
                                    ORDER BY TotalQuantity DESC;";
        } else if (($from !== "") && ($to !== "")) {
            $sql = "SELECT  Inventory_Record.category as Category,
                                                    SUM(Sales_Record.qty) as TotalQuantity,
                                                    (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                                                    EXTRACT(WEEK FROM Sales_Record.salesDate) as Week
                                            FROM Sales_Record 
                                            INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                                            WHERE CAST(Sales_Record.salesDate AS DATE) >= '" . $from . "' AND CAST(Sales_Record.salesDate AS DATE) <= '" . $to . "'      
                                            GROUP BY Category, Week
                                            ORDER BY TotalQuantity DESC;";
        }    

        if ($result = mysqli_query($conn, $sql)) {
            $fields = array();
            for ($i = 0; $i < $result->field_count; $i++) {
                $fieldname = mysqli_fetch_field($result)->name;
                array_push($fields, $fieldname);
            }
            array_push($fetchedArray, $fields);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($fetchedArray, $row);
            }
        } else {
            echo "<p>Error: " .  mysqli_error($conn). "</p>";
        }
        return $fetchedArray;
    }

    function getOneItemWeekly($itemName) {
        global $conn;
        $fetchedArray = array(array());
        array_pop($fetchedArray);
        $sql = "SELECT Sales_Record.itemID,
                        Inventory_Record.itemName,
                        Inventory_Record.itemPrice,
                        SUM(Sales_Record.qty) as TotalQuantity,
                        (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                        EXTRACT(WEEK FROM Sales_Record.salesDate) as Week
                FROM Sales_Record 
                INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                WHERE Inventory_Record.itemName = '" . $itemname . "'                 
                GROUP BY Week
                ORDER BY TotalQuantity DESC;";

        if ($result = mysqli_query($conn, $sql)) {
            $fields = array();
            for ($i = 0; $i < $result->field_count; $i++) {
                $fieldname = mysqli_fetch_field($result)->name;
                array_push($fields, $fieldname);
            }
            array_push($fetchedArray, $fields);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($fetchedArray, $row);
            }
        } else {
            echo "<p>Error: " .  mysqli_error($conn). "</p>";
        }
        return $fetchedArray;
        
    }

    function getOneItemMonthly($itemName) {
        global $conn;
        $fetchedArray = array(array());
        array_pop($fetchedArray);
        $sql = "SELECT Sales_Record.itemID,
                        Inventory_Record.itemName,
                        Inventory_Record.itemPrice,
                        SUM(Sales_Record.qty) as TotalQuantity,
                        (Inventory_Record.itemPrice * SUM(Sales_Record.qty)) as TotalPrice,
                        EXTRACT(MONTH FROM Sales_Record.salesDate) as Month
                FROM Sales_Record 
                INNER JOIN Inventory_Record ON Inventory_Record.itemID = Sales_Record.itemID 
                WHERE Inventory_Record.itemName = '" . $itemname . "'                 
                GROUP BY Month
                ORDER BY TotalQuantity DESC;";

        if ($result = mysqli_query($conn, $sql)) {
            $fields = array();
            for ($i = 0; $i < $result->field_count; $i++) {
                $fieldname = mysqli_fetch_field($result)->name;
                array_push($fields, $fieldname);
            }
            array_push($fetchedArray, $fields);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($fetchedArray, $row);
            }
        } else {
            echo "<p>Error: " .  mysqli_error($conn). "</p>";
        }
        return $fetchedArray;

    }



?>
