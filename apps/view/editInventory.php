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
				<th>Item Name</th>
				<th>Item Price</td>
				<th>Quantity in Stock</th>
				<th>Category</th>
			</tr>
			
			<?php
				$errMsg = "";
				session_start();

				if(!isset($_SESSION['data'])) {
					if (isset($_GET['com'])) {
						$msg = $_GET['com'];
						header ("location: ../controller/editinventory.php?search=1&com=$msg");
					} else {
						header ("location: ../controller/editinventory.php?search=1");
					}
				} else {
					$data = $_SESSION['data'];
					if (is_array($data)) {
						foreach($data as $row) {
							echo "<tr>";
							echo "<td>" . $row[1] . "</td>";
							echo "<td>" . $row[2] . "</td>";
							echo "<td>" . $row[3] . "</td>";
							echo "<td>" . $row[4] . "</td>";
							echo "</tr>";
						}
					} else {
						$errMsg .= $data;
					}
					unset($_SESSION['data']);
				}
			?>

		 v
		<input type="button" id="btnEdit" value="Edit" onClick="editInventory()"/>
		<form id="editForm" method="post" action="../controller/editinventory.php" style="visibility:hidden">
			<fieldset>
				<legend>Inventory Record</legend>
					<p>
						<label for="itemName">Item Name</label>
						<input type="text" name="itemName" id="itemName" maxlength="40" size="40" required="required" pattern="^[A-Za-z ]{1,40}$"/>
					</p>
					<p>
						<label for="itemPrice">Item Price</label>
						<input type="text" name="itemPrice" id="itemPrice" maxlength="8" size="8" pattern="([0-9])+(\.[0-9]{1,2})?" />
					</p>
					<p>
						<label for="itemStock">Quantity in Stock</label>
						<input type="text" name="itemStock" id="itemStock" maxlength="10" size="10" pattern="[0-9]+"/>
					</p>
					<p>
						<label for="itemCate">Item Category</label>
						<input type="text" name="itemCate" id="itemCate" maxlength="30" size="30" required="required" pattern="^[A-Za-z0-9]{1,30}$"/>
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
					<p>
					<?php 
						// Return error messages
						if (isset($_GET['com'])) {
							$msg = $_GET['com'];
							$li = array("Successfully updated item price!<br/>", "Failed to udpate item price!<br/>", "Successfully updated item stock!<br/>", "Failed to udpate item stock!<br/>", "Successfully updated item category!<br/>", "Failed to udpate item category!<br/>");

							for ($i=0; $i < strlen($msg); $i++) {
								echo $li[$msg[$i]];
							}
						}
					?>
					</p>
					<input type="submit" value="Submit"/>
					<input type="reset" value="Reset"/>
					<input type="button" id="editCancel" value="Cancel" onClick="cancelEdit()"/>
		</form>
	</body>
	<?php include_once "footer.inc"; ?>
</html>
		
	