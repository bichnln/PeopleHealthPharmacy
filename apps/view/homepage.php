<!DOCTYPE html>
<html lang="en">
	<body>
		<div class="content">
			<?php 
				include_once "authentication.inc";
				include 'header.inc';
			?>
			<?php 
				if (isset($_GET['failRole'])) {
					echo "Uh-oh! Are you doing something wrong?";
				}
			?>
			<?php include_once "footer.inc"; ?>
		</div>
		<script>
			var url = "homepage.php";
			window.history.pushState("", "", url);
		</script>
	</body>
</html>