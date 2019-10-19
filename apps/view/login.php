<!DOCTYPE html>
<html lang="en">
	<body>
		<div class="content">
			<?php include 'header.inc';?>
			<form method="post" action="../controller/authentication.php">
				<fieldset>
					<legend>Login</legend>
					<p>
						<label for="username">Username:</label>
						<input name="username" id="username" type="text" required maxlength="30" size="30" pattern="^[A-Za-z0-9]{1,30}$" />
					</p>
					<!-- Password must have at least 8 characters (including Uppercase, LowerCase, Number/Special Chars) -->
					<p>
						<label for="password">Password:</label>
						<input name="password" id="password" type="password" required maxlength="40" size="30" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" />
					</p>
					<p>
						<?php 
							if (isset($_GET['auth'])) {
								echo "<span id='error'>Incorrect username or password!</span>";
							}
							if (isset($_GET['fail'])) {
								echo "<span id='error'>Uh oh! Are you doing something wrong?</span>";	
							}
						?>
					</p>
					<p>
						<button type="submit">Login</button>
					</p>
				</fieldset>
			</form>
		</div>
		<script>
			var url = "login.php";
			window.history.pushState("", "", url);
		</script>
		<?php include_once "footer.inc"; ?>
	</body>
</html>