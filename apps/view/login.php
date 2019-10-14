<!DOCTYPE html>
<html lang="en">
<?php include 'header.inc';?>
	<body>
		<form method="post" action="./loginTest.php">
			<h1>Login</h1>
			<p id="error"></p>
			<label for="username">Username:</label>
			<input name="username" id="username" type="text"/>
			<label for="password">Password:</label>
			<input name="password" id="password" type="text"/>
			<button type="submit">Login</button>
		</form>
	</body>
</html>