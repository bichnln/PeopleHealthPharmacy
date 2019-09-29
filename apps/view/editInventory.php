<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Display/Edit Inventory Records</title>
		<script src="../../public/js/editInventoryJS.js"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	</head>
	<body>
	<?php include_once 'header.inc';?>
		<h1>Display an Inventory Record</h1>
		<table border="1">
			<tr>
				<th>Item ID</th>
				<th>Item Name</th>
				<th>Item Price</td>
				<th>Quantity in Stock</th>
			</tr>
			
			<?php
				$errMsg = "";
				session_start();
				if(!isset($_SESSION['data'])) {
					header ("location: ../controller/editinventory.php?search=1");	
				} else {
					$data = $_SESSION['data'];
					if (is_array($data)) {
						foreach($data as $row) {
							echo "<tr>";
							echo "<td>" . $row[0] . "</td>";
							echo "<td>" . $row[1] . "</td>";
							echo "<td>" . $row[2] . "</td>";
							echo "<td>" . $row[3] . "</td>";
							echo "</tr>";
						}
					} else {
						$errMsg .= $data;
					}
					unset($_SESSION['data']);
				}
			?>

		</table>
		<input type="button" id="btnEdit" value="Edit" onClick="editInventory()"/>
		<form id="editForm" method="post" action="../controller/editinventory.php" style="visibility:hidden">
			<fieldset>
				<legend>Inventory Record</legend>
					<p>
						<label for="itemID">Item ID</label>
						<input type="text" name="itemID" id="itemID" maxlength="10" size="10" required="required" pattern="^([0-9]){1,10}$" />
					</p>
					<p>
						<label for="itemPrice">Item Price</label>
						<input type="text" name="itemPrice" id="itemPrice" maxlength="8" size="8" pattern="([0-9])+(\.[0-9]{1,2})?" />
					</p>
					<p>
						<label for="itemStock">Quantity in Stock</label>
						<input type="text" name="itemStock" id="itemStock" maxlength="10" size="10" pattern="[0-9]+"/>
					</p>
					<p> Update quanity
						<select name="updateOption" id="updateOption">
							<option value="Add">Add</option>
							<option value="Subtract">Subtract</option>
						</select>
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
		
	