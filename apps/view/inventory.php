<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Add Inventory Records</title>
	</head>
	<body>
	<?php include_once 'header.inc';?>
		<h1>Add an Inventory Record</h1>
		<form method="post">
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
				<p>
				<input type="submit" value="Submit"/>
				<input type="reset" value="Reset"/>
				</p>
			</fieldset>
		</form>
	</body>
</html>