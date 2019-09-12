<!DOCTYPE html>
<html lang="en">
	<?php include 'header.inc';?>
	<body>
		<h1>Add an Inventory Record</h1>
		<form method="post" action="result.php">
			<fieldset>
				<legend>Inventory Record</legend>
				<table>
					<tr>
						<td>
							<label>Product ID</label>
							<input type="text" name="proID" id="ProID" maxlength="25" size="25" required="required" pattern="\d*"/>
						</td>
						<td>
							<label>Product Name</label>
							<input type="text" name="proName" id="ProName" maxlength="25" size="25" required="required"/>
						</td>
						<td>
							<label>Product Price</label>
							<input type="text" name="proPrice" id="ProPrice" maxlength="7" size="7" required="required" pattern="\d*?\.?\d{1,2}"/>
						</td>
						<td>
							<label>Quantity in Stock</label>
							<input type="text" name="proQty" id="ProQty" maxlength="3" size="3" required="required" pattern="\d*"/>
						</td>
					</tr>
				</table>
				<input type="submit" value="Submit"/>
				<input type="reset" value="Reset"/>
			</fieldset>
		</form>
	</body>
</html>