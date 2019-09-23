<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Add Sales Records</title>
<<<<<<< HEAD
		<script src="../../public/js/addsales1.js"></script>
=======
		<script src="../../public/js/addsales.js"></script>
>>>>>>> master
	</head>
	<body>
		<?php 
		include_once "header.inc";
		?>
		<!-- add php to process this form to db later -->
		<form action="addsalestodb.php" method="post">
			<fieldset>
				<p>
					<label for='itemID'>Item ID</label>
					<input id='itemID' name='itemID' type='text' required='required' pattern="^[a-zA-Z]+$"/>
				</p>
				<p>
					<label for='itemName'>Item name</label>
					<input id='itemName' name='itemName' type='text' required='required' pattern="^[a-zA-Z ]+$"/>
				</p>
				<p>
					<label for='itemPrice'>Price</label>
					<input id='itemPrice' name='itemPrice' type='text' required='required' pattern="\d+$"/>
				</p>
				<p>
					<label for='qty'>Quantity</label>
					<input id='qty' name='qty' type='text' required='required' pattern="\d+$"/>
				</p>
				<p>
					<label for='salesDate'>Date Sold</label>
					<input id='salesDate' name='salesDate' type='date' required='required'/>
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