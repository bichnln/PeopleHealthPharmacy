<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Edit Sales Records</title>
		<script src="../../public/js/addsales.js"></script>
	</head>
	<body>
		<div class="content">
			<?php include_once "header.inc"; ?>
			<?php include 'menu.inc';?>
			<fieldset>
			<table>
				<tr>
					<th>Item Name</th>
					<th>Sales Date</td>
					<th>Quantity</th>
				</tr>
				
				<?php
					$errMsg = "";
					session_start();

					if(!isset($_SESSION['data'])) {
						if (isset($_GET['com'])) {
							$msg = $_GET['com'];
							header ("location: ../controller/editsales.php?search=1&com=$msg");
						} else {
							header ("location: ../controller/editsales.php?search=1");
						}
					} else {
						$data = $_SESSION['data'];
						if (is_array($data)) {
							foreach($data as $row) {
								echo "<tr>";
								echo "<td>" . $row[0] . "</td>";
								echo "<td>" . $row[1] . "</td>";
								echo "<td>" . $row[2] . "</td>";
								echo "</tr>";
							}
						} else {
							$errMsg .= $data;
						}
						unset($_SESSION['data']);
					}
				?>
			</table>
			</fieldset>

			<form action="../controller/editsales.php" method="post">
				<fieldset>
					<legend>Edit Sales Record</legend>
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
							echo "<input id='salesDate' name='salesDate' type='datetime' value='". date('d/m/Y h:i:s') ."'/>"
						?>

					</p>
					<p>
					<span class="errortxt" id="statetxt"></span>
					</p>
					<p>
					<?php 
						// Return error messages
						if (isset($_GET['com'])) {
							$msg = $_GET['com'];

							if ($msg == 0) {
								echo "Successfully updated sales record!<br/>";
							} else {
								echo "Failed to udpate sales record!<br/>";
							}
						}
					?>
					</p>
					<p>
					<button id="editbtn" class="btn" type="submit" name="submit" value="editsales">Submit</button>				
					<input type="reset" value="Reset"/>
					</p>
				</fieldset>
			</form>
			<?php include_once "footer.inc"; ?>
		</div>
	</body>
</html>