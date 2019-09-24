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
		<form method="post">
			<fieldset>
				<legend>Inventory Record</legend>
					<p>
						<label for="itemID">Item ID</label>
						<input type="text" name="itemID" id="itemID" maxlength="10" size="10" required="required" pattern="^([0-9]){1,10}$"/>
					</p>
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
				<input type="submit" value="Submit"/>
				<input type="reset" value="Reset"/>
				</p>
			</fieldset>
		</form>
	</body>
</html>