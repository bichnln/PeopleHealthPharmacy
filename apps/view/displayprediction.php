<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="author" content="Le Ngoc Bich Nguyen"/>
    <meta name="description" content="DP2 Project"/>
</head>

<body>
	<div class="content">
		<?php include_once "header.inc"; ?>
		<?php 
			session_start();

			/* Display weekly prediction  group by Item */

			if (isset($_SESSION['itemWeekPrediction'])) {
				$item_week_prediction = $_SESSION['itemWeekPrediction'];
				if (count($item_week_prediction) > 0) {
				
					echo "<h2>Projected sales of single item for week  basis</h2>";
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
					echo "<p>No weekly report for items!</p>";
				}
			}

			/* Display monthly report group by item */
			if (isset($_SESSION['itemMonthPrediction'])) {
				$item_month_prediction = $_SESSION['itemMonthPrediction'];
				if (count($item_month_prediction) > 0) {
				
					echo "<h2>Projected sales of single item for month  basis</h2>";
					echo "<div id='item_week_prediction'>";
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
					echo "<p>No weekly report for items!</p>";
				}
			}
		   
			/* Display monthly report group by categories */
			if (isset($_SESSION['catMonthPrediction'])) {
				$cat_month_prediction = $_SESSION['catMonthPrediction'];
				if (count($cat_month_prediction) > 0) {
				
					echo "<h2>Projected sales of category for month  basis</h2>";
					echo "<div id='item_week_prediction'>";
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
					echo "<p>No weekly report for items!</p>";
				}
			}

			 /* Display monthly report group by categories */
			 if (isset($_SESSION['catWeekPrediction'])) {
				$cat_week_prediction = $_SESSION['catWeekPrediction'];
				if (count($cat_week_prediction) > 0) {
				
					echo "<h2>Projected sales of category for week  basis</h2>";
					echo "<div id='item_week_prediction'>";
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
				} else {
					echo "<p>No weekly report for items!</p>";
				}
			}
			
			
			 
		?>  
    </div>
</body>
<?php include_once "footer.inc"; ?>
</html>