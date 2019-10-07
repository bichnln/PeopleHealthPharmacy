<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Add Sales Records</title>
		<script src="../../public/js/addsales.js"></script>
	</head>
	<body>
		<?php 
		include_once "header.inc";
		?>
		<!-- add php to process this form to db later -->
		<form action="../controller/addsales.php" method="post">
			<fieldset>
				<p>
					<label for="itemName">Item Name</label>
					<input type="text" name="itemName" id="itemName" maxlength="40" size="40" required="required" pattern="^[A-Za-z ]{1,40}$"/>
				</p>
				<p>
					<label for='qty'>Quantity</label>
					<input id='qty' name='qty' type='text' required='required' pattern="^[0-9]+$"/>
				</p>
				<p>
					<label for='salesDate'>Date Sold</label>
					<?php
						date_default_timezone_set("Australia/Melbourne");
						echo "<input id='salesDate' name='salesDate' type='datetime' readonly value='". date('d/m/Y h:i:s') ."'/>"
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
    			<button id="addbtn" class="btn" type="submit" name="submit" value="addsales">Add</button>				
				<input type="reset" value="Reset Form"/>
				</p>
			</fieldset>
		</form>
	</body>
</html>