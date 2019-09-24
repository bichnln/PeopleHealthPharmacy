<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Display/Edit Inventory Records</title>
		<script src="../../public/js/editInventoryJS.js"></script>
	</head>
	<body>
	<?php include_once 'header.inc';?>
		<h1>Display an Inventory Record</h1>
		<table border="1">
			<tr>
				<th>
					Item ID
				</th>
				<th>
					Item Name
				</th>
				<th>
					Item Price
				</td>
				<th>
					Quantity in Stock
				</th>
			</tr>
			<?php
			$conn = @mysqli_connect("localhost", "root", "root", "PHP");
			if ($conn) {
				
				$inventoryRecord = mysqli_query($conn, "SELECT * from inventory_record");
				while ($row = mysqli_fetch_array($inventoryRecord)) {
					echo "<tr>";
					echo "<td>" . $row['itemID'] . "</td>";
					echo "<td>" . $row['itemName'] . "</td>";
					echo "<td>" . $row['itemPrice'] . "</td>";
					echo "<td>" . $row['itemStock'] . "</td>";
					echo "</tr>";
				}
				
			} else {
				echo "DB connection error!";
			}
			?>
		</table>
		<input type="button" id="btnEdit" value="Edit" onClick="editInventory()"/>
		<form id="editForm" method="post" action="editInventoryPHP.php" style="visibility:hidden">
			<fieldset>
				<legend>Inventory Record</legend>
					<p>
						<label for="itemID">Item ID</label>
						<input type="text" name="itemID" id="itemID" maxlength="10" size="10" required="required" pattern="\d*"/>
					</p>
					<p>
						<label for="itemName">Product Name</label>
						<input type="text" name="itemName" id="itemName" maxlength="40" size="40" required="required"/>
					</p>
					<p>
						<label for="itemPrice">Product Price</label>
						<input type="text" name="itemPrice" id="itemPrice" maxlength="8" size="8" required="required" pattern="\d*?\.?\d{1,2}"/>
					</p>
					<p>
						<label for="itemStock">Quantity in Stock</label>
						<input type="text" name="itemStock" id="itemStock" maxlength="10" size="10" required="required" pattern="\d*"/>
					</p>
					<p>
					<span class="errortxt" id="statetext"></span>
					</p>
					<input type="submit" value="Submit"/>
					<input type="reset" value="Reset"/>
					<input type="button" id="editCancel" value="Cancel" onClick="cancelEdit()"/>
		</form>
	</body>
</html>
		
	