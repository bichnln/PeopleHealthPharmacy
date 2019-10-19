<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Add Inventory Records</title>
		<script src="../../public/js/addinventory.js"></script>
	</head>
	<body>
	<div class="content">
		<?php 
			include_once 'header.inc';
			include_once "authentication.inc";
		?>
			<!-- add search feature -->
			<?php 
				if (isset($_SESSION['items'])) {
					$data = $_SESSION['items'];
					// echo $data;
					if(is_array($data)) {
			?>
						<table border='1'>
							<tr>
								<th>Item Name</th>
								<th>Item Price</td>
								<th>Quantity in Stock</th>
								<th>Category</th>
							</tr>
						<?php 
						foreach($data as $row) {
							echo "<tr>";
							echo "<td>" . $row[1] . "</td>";
							echo "<td>" . $row[2] . "</td>";
							echo "<td>" . $row[3] . "</td>";
							echo "<td>" . $row[4] . "</td>";
							echo "</tr>";
						}

						?>
						
						</table>
			<?php
					}

					if (isset($_GET['com'])) {
						if ($_GET['com'] != 1)
							echo "Uh-oh! There is something wrong with the system.";
					}	

				} else {
					if (isset($_GET['com'])) {
						if ($_GET['com'] == 2) {
							echo "Uh-oh! There is no item in the inventory.";
						}
					}
				}
				unset($_SESSION['items']);

			?>
			<form action="../controller/search.php" method="post" >
				<fieldset>
					<legend>Search Items</legend>
						<p>
							<label for="itemName">Item Name</label>
							<input type="text" name="itemName" id="itemName" maxlength="40" size="40" required="required" pattern="^[A-Za-z ]{1,40}$"/>
						</p>
						<input id='page' name='page' type='hidden' value='inventory' />
						<p>
							<button id="searchbtn" class="btn" type="submit" name="submit" value="searchitems">Search</button>				
						</p>
						<p>
							<?php
								if (isset($_GET['com'])) {
									if ($_GET['com'] == 0) {
										echo "<span class='errortxt'>Failed to search the item</span>";
									}
								}
							?>

						</p>
				</fieldset>
			</form>
			<form action="../controller/addinventory.php" method="post">
				<fieldset>
					<legend>Add Inventory Record</legend>
						<p>
							<label for="itemName">Item Name</label>
							<input type="text" name="itemName" id="itemName" maxlength="40" size="40" required="required" pattern="^[A-Za-z ]{1,40}$"/>
						</p>
						<p>
							<label for="itemPrice">Item Price</label>
							<input type="text" name="itemPrice" id="itemPrice" maxlength="8" size="10" required="required" pattern="^([0-9])+(\.[0-9]{1,2})?$"/>
						</p>
						<p>
							<label for="itemStock">Quantity in Stock</label>
							<input type="text" name="itemStock" id="itemStock" maxlength="10" size="10" required="required" pattern="^[0-9]+$"/>
						</p>
						<p>
							<label for="itemCate">Item Category</label>
							<input type="text" name="itemCate" id="itemCate" maxlength="30" size="40" required="required" pattern="^[A-Za-z0-9]{1,30}$"/>
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
			<?php include_once "footer.inc"; ?>
		</div>
	</body>
</html>