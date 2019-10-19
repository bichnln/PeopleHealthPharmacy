<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="author" content="Le Ngoc Bich Nguyen"/>
    <meta name="description" content="DP2 Project"/>
    <link rel="stylesheet" href="../../lib/js/chartphp.css">
    <link rel="stylesheet" href="../../public/css/graphstyle.css">
        <script src="../../lib/js/jquery.min.js"></script>
        <script src="../../lib/js/chartphp.js"></script>
</head>

<body>
    <div class="content">
    <?php 
        include_once "header.inc";
        include("../../lib/inc/chartphp_dist.php");
        include_once("../../config.php");

        session_start();

        echo "<h1>Sales Report</h1>";
        /* Display weekly report  group by Item */

        if (isset($_SESSION['weekly_item'])) {
            $weekly_item = $_SESSION['weekly_item'];
            if (count($weekly_item) > 1) {
            
                echo "<h2>Weekly report on items' sales</h2>";
                echo "<div id='weekly_item_report'>";
                echo "<table border='1'>";
                
                echo "<tr><th>ItemID</th><th>ItemName</th><th>ItemPrice</th><th>TotalQuantity</th><th>TotalPrice</th><th>Week</th></tr>";

                for ($i = 1; $i < count($weekly_item); $i++) {
                    echo "<tr><td>" . $weekly_item[$i]["itemID"] . "</td>"
                            . "<td>" . $weekly_item[$i]['itemName'] . "</td>"
                            . "<td>" . $weekly_item[$i]['itemPrice'] . "</td>" 
                            . "<td>" . $weekly_item[$i]['TotalQuantity'] . "</td>"
                            . "<td>" . $weekly_item[$i]['TotalPrice'] . "</td>"
                            . "<td>" . $weekly_item[$i]['Week'] . "</td></tr>";
                }

                echo "</table>";
                echo "</div>";
                echo "<br>";
            } else {
                echo "<p>No weekly report for items!</p>";
            }

        }

        /* Display monthly report group by item */
        if (isset($_SESSION['monthly_item'])) {
            $monthly_item = $_SESSION['monthly_item'];
            if (count($monthly_item) > 1) {
                
                echo "<h2>Monthly report on items' sales</h2>";
                echo "<div id='monthly_items_report'>";
                echo "<table border='1'>";
                
                echo "<tr><th>ItemID</th><th>ItemName</th><th>ItemPrice</th><th>TotalQuantity</th><th>TotalPrice</th><th>Month</th></tr>";

                for ($i = 1; $i < count($monthly_item); $i++) {
                    echo "<tr><td>" . $monthly_item[$i]["itemID"] . "</td>"
                            . "<td>" . $monthly_item[$i]['itemName'] . "</td>"
                            . "<td>" . $monthly_item[$i]['itemPrice'] . "</td>" 
                            . "<td>" . $monthly_item[$i]['TotalQuantity'] . "</td>"
                            . "<td>" . $monthly_item[$i]['TotalPrice'] . "</td>"
                            . "<td>" . $monthly_item[$i]['Month'] . "</td></tr>";
                }

                echo "</table>";
                echo "</div>";
                echo "<br>";
            } else {
                echo "<p>No monthly report for items!</p>";
            }
        }
       
        /* Display weekly report group by categories */
        if (isset($_SESSION['weekly_category'])) {
            $weekly_category = $_SESSION['weekly_category'];
            if (count($weekly_category) > 1) {
            
                echo "<h2>Weekly report on category</h2>";
                echo "<div id='weekly_category_report'>";
                echo "<table border='1'>";
                
                echo "<tr><th>Category</th><th>TotalQuantity</th><th>TotalPrice</th><th>Month</th></tr>";

                for ($i = 1; $i < count($weekly_category); $i++) {
                    echo "<tr><td>" . $weekly_category[$i]['Category'] . "</td>"
                           . "<td>" . $weekly_category[$i]["TotalQuantity"] . "</td>"
                           . "<td>" . $weekly_category[$i]["TotalPrice"] . "</td>"
                           . "<td>" . $weekly_category[$i]['Week'] . "</td></tr>";
                }
                
                echo "</table>";
                echo "</div>";
                echo "<br>";
            } else {
                echo "<p>No weekly report for categories!</p>";
            }
        }

         /* Display monthly report group by categories */
         if (isset($_SESSION['monthly_category'])) {
            $monthly_category = $_SESSION['monthly_category'];
            if (count($monthly_category) > 1) {
                echo "<h2>Monthly report on category</h2>";
                echo "<div id='monthly_category_report'>";
                echo "<table border='1'>";
                
                echo "<tr><th>Category</th><th>TotalQuantity</th><th>TotalPrice</th><th>Month</th></tr>";

                for ($i = 1; $i < count($monthly_category); $i++) {
                    echo "<tr><td>" . $monthly_category[$i]['Category'] . "</td>"
                           . "<td>" . $monthly_category[$i]["TotalQuantity"] . "</td>"
                           . "<td>" . $monthly_category[$i]["TotalPrice"] . "</td>"
                           . "<td>" . $monthly_category[$i]['Month'] . "</td></tr>";
                }
                
                echo "</table>";
                echo "</div>";
                echo "<br>";
            } else {
                echo "<p>No monthly report for categories!</p>";
            }
        }
        echo "<form target='_blank' action='../controller/export.php' method='post'>";
        echo "<input type='hidden' name='form' value='export'/>";
                
        echo "<p><input type='submit' value='Export'></input></p>";
        echo "</form>";    

        echo "<hr>";
        echo "<h1>Prediction</h1>";
        /* Display weekly prediction  group by Item */
        
        if (isset($_SESSION['itemWeekPrediction'])) {
            echo "<h2>Projected sales of single item for week  basis</h2>";
            $item_week_prediction = $_SESSION['itemWeekPrediction'];
            if (count($item_week_prediction) > 0) {
            
                
                echo "<div id='item_week_prediction'>";
                echo "<table border='1'>";
                
                echo "<tr><th>ItemName</th><th>Projected Sales</th><th>Week</th></tr>";

                for ($i = 0; $i < count($item_week_prediction); $i++) {
                    echo "<tr><td>" . $item_week_prediction[$i]["itemName"] . "</td>"
                            . "<td>" . $item_week_prediction[$i]['projectedSales'] . "</td>"
                            . "<td>" . $item_week_prediction[$i]['week'] . "</td></tr>";

                }
                echo "</table>";
                echo "</div>";
                echo "<br>";
            } else {
                echo "<p>No prediction on weekly basis for items!</p>";
            }

            
        }


        /* Display items' predcition on monthly basis */
        if (isset($_SESSION['itemMonthPrediction'])) {
            echo "<h2>Projected sales of single item for monthly basis</h2>";
            $item_month_prediction = $_SESSION['itemMonthPrediction'];
            if (count($item_month_prediction) > 0) {
            
                echo "<div id='item_month_prediction'>";
                echo "<table border='1'>";
                
                echo "<tr><th>ItemName</th><th>Projected Sales</th><th>Month</th></tr>";

                for ($i = 0; $i < count($item_month_prediction); $i++) {
                    echo "<tr><td>" . $item_month_prediction[$i]["itemName"] . "</td>"
                            . "<td>" . $item_month_prediction[$i]['projectedSales'] . "</td>"
                            . "<td>" . $item_month_prediction[$i]['month'] . "</td></tr>";

                }
                echo "</table>";
                echo "</div>";
                echo "<br>";

            } else {
                echo "<p>No prediction on monthly basis for items!</p>";
            }
           
        }
       
        /* Display categories' prediction on monthly basis */
        if (isset($_SESSION['catMonthPrediction'])) {
            echo "<h2>Projected sales of category for monthly  basis</h2>";
            $cat_month_prediction = $_SESSION['catMonthPrediction'];
            if (count($cat_month_prediction) > 0) {
            
                echo "<div id='cat_month_prediction'>";
                echo "<table border='1'>";
                
                echo "<tr><th>Category</th><th>Projected Sales</th><th>Month</th></tr>";

                for ($i = 0; $i < count($cat_month_prediction); $i++) {
                    echo "<tr><td>" . $cat_month_prediction[$i]["category"] . "</td>"
                            . "<td>" . $cat_month_prediction[$i]['projectedSales'] . "</td>"
                            . "<td>" . $cat_month_prediction[$i]['month'] . "</td></tr>";

                }
                echo "</table>";
                echo "</div>";
                echo "<br>";
            } else {
                echo "<p>No prediction on monthly basis for category!</p>";
            }
            
        }

         /* Display item prediction on weekly basis */
         if (isset($_SESSION['catWeekPrediction'])) {
            $cat_week_prediction = $_SESSION['catWeekPrediction'];
            echo "<h2>Projected sales of category for weekly basis</h2>";
            if (count($cat_week_prediction) > 0) {
            
               
                echo "<div id='cat_week_prediction'>";
                echo "<table border='1'>";
                
                echo "<tr><th>Category</th><th>Projected Sales</th><th>Week</th></tr>";

                for ($i = 0; $i < count($cat_week_prediction); $i++) {
                    echo "<tr><td>" . $cat_week_prediction[$i]["category"] . "</td>"
                            . "<td>" . $cat_week_prediction[$i]['projectedSales'] . "</td>"
                            . "<td>" . $cat_week_prediction[$i]['week'] . "</td></tr>";

                }
                echo "</table>";
                echo "</div>";
                
                echo "<br>";
                echo "<hr>";
                
            } else {
                echo "<p>No prediction on weekly basis for category!</p>";
            }
            
        }

<<<<<<< HEAD
        /* Graph generating */
        echo "<h1>Graphs of projected sales</h1>";
        echo "<div class='graph'>";
        echo  $_SESSION['itemWeekGraph'];
        echo  $_SESSION['itemMonthGraph'];
        echo  $_SESSION['catWeekGraph'];
        echo  $_SESSION['catMonthGraph'];
        echo "</div>";
        
    ?>  
=======
        echo "<form target='_blank' action='../controller/export.php' method='post'>";
        echo "<input type='hidden' name='form' value='export'/>";
                
        echo "<p><input type='submit' value='Export'></input></p>";
        echo "</form>";    
    ?> 
>>>>>>> 7ff56d0d159c1587c5323af9e2a8c803e89e88ef
    </div>
</body>
</html>