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
        if (isset($_SESSION['sqlResult'])) {
            $sqlResult = $_SESSION['sqlResult'];
            if (count($sqlResult) > 1) {
            
                echo "<div id='items_sold'>";
                echo "<table border='1' id='items_sold_table'>";

                if (array_key_exists("Month", $sqlResult[1])) {
                    echo "<tr><th>ItemID</th><th>ItemName</th><th>ItemPrice</th><th>TotalQuantity</th><th>TotalPrice</th><th>Month</th></tr>";
                
                    for ($i = 1; $i < count($sqlResult); $i++) {
                        echo "<tr><td>" . $sqlResult[$i]["itemID"] . "</td>"
                                . "<td>" . $sqlResult[$i]['itemName'] . "</td>"
                                . "<td>" . $sqlResult[$i]['itemPrice'] . "</td>" 
                                . "<td>" . $sqlResult[$i]['TotalQuantity'] . "</td>"
                                . "<td>" . $sqlResult[$i]['TotalPrice'] . "</td>"
                                . "<td>" . $sqlResult[$i]['Month'] . "</td></tr>";
                    }
                } else {
                    echo "<tr><th>ItemID</th><th>ItemName</th><th>ItemPrice</th><th>TotalQuantity</th><th>TotalPrice</th><th>Week</th></tr>";
                
                    for ($i = 1; $i < count($sqlResult); $i++) {
                        echo "<tr><td>" . $sqlResult[$i]["itemID"] . "</td>"
                                . "<td>" . $sqlResult[$i]['itemName'] . "</td>"
                                . "<td>" . $sqlResult[$i]['itemPrice'] . "</td>" 
                                . "<td>" . $sqlResult[$i]['TotalQuantity'] . "</td>"
                                . "<td>" . $sqlResult[$i]['TotalPrice'] . "</td>"
                                . "<td>" . $sqlResult[$i]['Week'] . "</td></tr>";
                    }
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
            //unset($_SESSION['sqlResult']);
        } 
        


    ?>  
    
</body>

</html>