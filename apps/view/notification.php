<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Low Stock Notification</title>
	</head>
	<body>
		<?php 
		include_once "header.inc";
		require_once ("../db_connection.php");
		?>

		<!-- display all inventory records -->
		<?php
		$query = "SELECT itemName, itemStock
				FROM Inventory_Record";
		$result = mysqli_query($conn, $query);

		//identify threshold
		$limit = 100;

		//initialize empty arrays
		$items = array();
		$msgArray = array();

		if(!$result)
		{
			echo "<p> There is something wrong with the SQL query. </p>";
		}
		else
        {
            echo "<table border =\"1\">\n";

            echo "<tr> \n"
                . "<th scope=\"col\">Item Name</th>\n"
                . "<th scope=\"col\">Sales Stock</th>\n"
                . "</tr>";

            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>\n";
                echo "<td>", $row["itemName"], "</td>\n";
                echo "<td>", $row["itemStock"], "</td>\n";
                echo "</tr>\n";
                //append empty array
                $items[] = $row;
            }
            echo "</table>";
        }
		//print_r($items);

		foreach ($items as $data) {
			
			//if item stock is lower than threshold
			if($data['itemStock'] <= $limit)
			{
				//add items into message array
				$msgArray[] = "Warning! " . $data['itemName'] . " is lower than stock threshold! <br />";
			}
			
		}

		for($i = 0; $i < count($msgArray); $i++)
		{
			echo $msgArray[$i];
		}
            mysqli_free_result($result);
            mysqli_close($conn);
		?>
	</body>
</html>