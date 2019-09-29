<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="author" content="Le Ngoc Bich Nguyen"/>
    <meta name="description" content="DP2 Project"/>
</head>

<body>
    
    <?php 
        session_start();
        require_once("../db_connection.php");
        $from = "";
        $to = "";
        $sql="";
        if (!is_null($_POST['from_date']) && !is_null($_POST['to_date'])) {
            $from = $_POST['from_date'];
            $to = $_POST['to_date'];
        } else if (!is_null($_POST['from_date']) && is_null($_POST['to_date'])) {
            $from = $_POST['from'];
            $to = date('Y-m-d');
        } else if (!is_null($_POST['to_date']) && is_null($_POST['from_date'])) {
            $from = date('Y-m-d');
            $to = $_POST['to_date'];
        } else {
            
        }
        
        if (($from !== "" ) || ($to !== "")) {
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
                      
        } else {
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
        }
        

       if (! $result_1 = mysqli_query($conn, $sql)) {
           echo "MySQL error " . mysqli_error($conn);
       } else {
           $result_1 = mysqli_query($conn, $sql);
       }
        
        
        $_SESSION['sqlQuery' ] = $sql;

        echo "Sales record report from $from to $to: ";
        
        echo "<div id='items_sold'>";
        echo "<table border='1' id='items_sold_table'>";
        echo "<tr><th>ItemID</th><th>ItemName</th><th>ItemPrice</th><th>TotalQuantity</th><th>TotalPrice</th><th>Month</th></tr>";

        if (mysqli_num_rows($result_1)) {
            while ($row_1 = mysqli_fetch_array($result_1)) {
                echo "<tr><td>" . $row_1['itemID'] . "</td>"
                       . "<td>" . $row_1['itemName'] . "</td>"
                       . "<td>" . $row_1['itemPrice'] . "</td>" 
                       . "<td>" . $row_1['TotalQuantity'] . "</td>"
                       . "<td>" . $row_1['TotalPrice'] . "</td>"
                       . "<td>" . $row_1['Month'] . "</td></tr>";
            }
            echo "</table>";
            echo "<form target='_blank' action='../controller/export.php' method='post'>";
            echo "<input type='hidden' name='form' value='export'/>";
            
            echo "<p><input type='submit' value='Export'></input></p>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "<p>No results found</p>";
        }
    ?>
</body>

</html>