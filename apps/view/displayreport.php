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
        
        if (count($sqlResult) > 1) {

            $_SESSION["sqlResult"] = $sqlResult;
    

            echo "Sales record report from $from to $to: ";
            
            echo "<div id='items_sold'>";
            echo "<table border='1' id='items_sold_table'>";
            echo "<tr><th>ItemID</th><th>ItemName</th><th>ItemPrice</th><th>TotalQuantity</th><th>TotalPrice</th><th>Month</th></tr>";
            
            for ($i = 1; $i < count($sqlResult); $i++) {
                echo "<tr><td>" . $sqlResult[$i]["itemID"] . "</td>"
                           . "<td>" . $sqlResult[$i]['itemName'] . "</td>"
                           . "<td>" . $sqlResult[$i]['itemPrice'] . "</td>" 
                           . "<td>" . $sqlResult[$i]['TotalQuantity'] . "</td>"
                           . "<td>" . $sqlResult[$i]['TotalPrice'] . "</td>"
                           . "<td>" . $sqlResult[$i]['Month'] . "</td></tr>";
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