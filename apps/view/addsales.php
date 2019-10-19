<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Add Sales Records</title>
		<script src="../../public/js/addsales.js"></script>
	</head>
	<body>
	<div class="content">
			<?php 
				include_once "authentication.inc";
				include_once "header.inc";
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
						<input id='page' name='page' type='hidden' value='addsales' />
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


			<!-- add php to process this form to db -->
			<form action="../controller/addsales.php" method="post">
				<fieldset>
					<legend>Add Sales Record</legend>
					<p>
						<label for="itemName">Item Name</label>
						<input type="text" name="itemName" id="itemName" maxlength="40" size="40" required="required" pattern="^[A-Za-z ]{1,40}$"/>
					</p>
					<p>
						<label for='qty'>Quantity</label>
						<input id='qty' name='qty' type='text' size='10' required='required' pattern="^[0-9]+$"/>
					</p>
					<p>
						<label for='salesDate'>Date Sold</label>
						<?php
							date_default_timezone_set("Australia/Melbourne");
							echo "<input id='salesDate' name='salesDate' type='datetime' size='40' readonly value='". date("Y-m-d H:i:s") ."'/>"
						?>

					</p>
					<p>
						<span class="errortxt" id="statetxt"></span>
					</p>
					<p>
					<?php 
					// Return error messages
					if (isset($_GET['suc'])) {
						if ($_GET['suc'] == 's1') {
							echo "<span class='suctxt'>Successfully added!</span>";
						}
					} else if (isset($_GET["err"])) {
						$error = $_GET["err"];

						if ($error == "s1") {
							echo "<span class='errortxt'>Can not create a sales table</span>";
						} else if ($error == "s2") {
							echo "<span class='errortxt'>There is no item with the given name</span>";
						} else if ($error == "s3") {
							echo "<span class='errortxt'>Cannot update inventory table</span>";
						} else if ($error == "s4") {
							echo "<span class='errortxt'>Cannot insert into sales table</span>";
						}
					} else if (isset($_GET["msg"])) {
						if ($_GET["msg"] == "s1") {
							echo "<span class='errortxt'>Not much item in stock</span>";
						}
					}
					?>
					</p>
					<p>
						<button id="addbtn" class="btn" type="submit" name="submit" value="addsales">Submit</button>				
						<input type="reset" value="Reset"/>
					</p>
				</fieldset>
			</form>
			<?php 
				include_once "footer.inc"; 
			?>

		</div>
		<script>
			var url = "addsales.php";
			window.history.pushState("", "", url);
		</script>
	</body>
</html>