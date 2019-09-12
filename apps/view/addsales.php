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
		<form action="addsalestodb.php" method="post">
			<fieldset>
				<p>
					<label for='ItemId'>Item ID</label>
					<input id='ItemId' name='itemid' type='text' required='required' pattern="^[a-zA-Z]+$"/>
				</p>
				<p>
					<label for='ItemName'>Item name</label>
					<input id='ItemName' name='itemname' type='text' required='required' pattern="^[a-zA-Z ]+$"/>
				</p>
				<p>
					<label for='Price'>Price</label>
					<input id='Price' name='price' type='text' required='required' pattern="\d+$"/>
				</p>
				<p>
					<label for='Quantity'>Quantity</label>
					<input id='Quantity' name='quantity' type='text' required='required' pattern="\d+$"/>
				</p>
				<p>
					<label for='Date'>Date Sold</label>
					<input id='Date' name='date' type='date' required='required'/>
				</p>
				<p>
				<span class="errortxt" id="statetxt"></span>
				</p>
				<p>
    			<button id="addbtn" class="btn" type="submit" name="submit" value="addsales">Add</button>				
				<input type="reset" value="Reset Form"/>
				</p>
			</fieldset>
		</form>
	</body>
</html>