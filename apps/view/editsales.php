<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Edit Sales Records</title>
		<script src="../../public/js/addsales.js"></script>
	</head>
	<body>
		<?php 
		include_once "header.inc";
		require_once ("../db_connection.php");
		?>

		<!-- add php to process this form to db later -->
		<?php
		$query = "SELECT itemID, salesDate, qty 
				FROM Sales_Record";
		$result = mysqli_query($conn, $query);

		if(!$result)
		{
			echo "<p> There is something wrong with the SQL query. </p>";
		}
		else
        {
            echo "<table border =\"1\">\n";

            echo "<tr> \n"
                . "<th scope=\"col\">Item ID</th>\n"
                . "<th scope=\"col\">Sales Date</th>\n"
                . "<th scope=\"col\">Quantity</th>\n"
                . "</tr>";

            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>\n";
                echo "<td>", $row["itemID"], "</td>\n";
                echo "<td>", $row["salesDate"], "</td>\n";
                echo "<td>", $row["qty"], "</td>\n";
                echo "</tr>\n";
            }
            echo "</table>";

            mysqli_free_result($result);
            mysqli_close($conn);
        }
		?>

		<!-- add php to process this form to db later -->
		<form action="../controller/db_editsales.php" method="post">
			<fieldset>
				<p>
					<label for='itemID'>Item ID</label>
					<input id='itemID' name='itemID' type='text' required='required' pattern="^[0-9]{1,10}$"/>
				</p>
				<p>
					<label for='qty'>Quantity</label>
					<input id='qty' name='qty' type='text' required='required' pattern="^[0-9]+$"/>
				</p>
				<p>
					<label for='salesDate'>Date Sold</label>
					<input id='salesDate' name='salesDate' type='date' required='required'/>
				</p>
				<p>
				<span class="errortxt" id="statetxt"></span>
				</p>
				<p>
    			<button id="editbtn" class="btn" type="submit" name="submit" value="editsales">Edit</button>				
				<input type="reset" value="Reset Form"/>
				</p>
			</fieldset>
		</form>
	</body>
</html>