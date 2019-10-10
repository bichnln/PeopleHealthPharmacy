<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Add Inventory Records</title>
		<script src="../../public/js/addinventory.js"></script>
	</head>
	<body>
	<?php include_once 'header.inc';?>
		<h1>Add an Inventory Record</h1>
		<form action="../controller/addinventory.php" method="post">
			<fieldset>
				<legend>Inventory Record</legend>
					<p>
						<label for="itemName">Item Name</label>
						<input type="text" name="itemName" id="itemName" maxlength="40" size="40" required="required" pattern="^[A-Za-z ]{1,40}$"/>
					</p>
					<p>
						<label for="itemPrice">Item Price</label>
						<input type="text" name="itemPrice" id="itemPrice" maxlength="8" size="8" required="required" pattern="^([0-9])+(\.[0-9]{1,2})?$"/>
					</p>
					<p>
						<label for="itemStock">Quantity in Stock</label>
						<input type="text" name="itemStock" id="itemStock" maxlength="10" size="10" required="required" pattern="^[0-9]+$"/>
					</p>
					<p>
					<span class="errortxt" id="statetext"></span>
					</p>
					<p>
					<?php 
						// Return error messages
						if (isset($_GET['suc'])) {
							if ($_GET['suc'] == 'i1') {
								echo "<span class='suctxt'>Successfully updated!</span>";
							} else if ($_GET['suc'] == 'i2') {
								echo "<span class='suctxt'>Successfully added!</span>";
							}
						} else if (isset($_GET["err"])) {
							$error = $_GET["err"];

							if ($error == "s0") {
								echo "<span class='errortxt'>Uh-oh! You're doing illegal thing</span>";
							} else if ($error == "i1") {
								echo "<span class='errortxt'>Cannot create a inventory table</span>";
							} else if ($error == "i2") {
								echo "<span class='errortxt'>Cannot checek duplicate</span>";
							} else if ($error == "i3") {
								echo "<span class='errortxt'>Cannot update item</span>";
							} else if ($error == "i4") {
								echo "<span class='errortxt'>Cannot add item</span>";
							}
						}
					?>
					</p>
				<p>
				<input type="submit" value="Submit"/>
				<input type="reset" value="Reset"/>
				</p>
			</fieldset>
		</form>

	</body>
</html>