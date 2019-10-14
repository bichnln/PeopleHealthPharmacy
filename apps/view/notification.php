<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<meta name='author' content='DP2'/>
		<title>PHP - Low Stock Notification</title>
	</head>
	<body>
		<?php include_once "header.inc"; ?>

		<?php 
		// Initialize
		$warningArray = array();
		$impArray = array();
		$limit = 100;
		
		// Pull data
		session_start();
		if (!isset($_SESSION['data'])) {
			header("location: ../controller/notification.php?search=1");
		} else {
			$data = $_SESSION['data'];
			if (is_array($data)) {
				// Add array
				foreach ($data as $item) {
					$stock = $item[1];
					// Warning message
					if($stock <= $limit && $stock >= $limit/2){
						$msg = "<p class='warningMsg'>Warning! <span>" . $item[0] . "</span> - <span>". $stock ."</span> is lower than stock threshold!</p>";
						array_push($warningArray, $msg);
					} else if ($stock < $limit/2) { // Important message
						$msg = "<p class='impMsg'>Important! <span>" . $item[0] . "</span> - <span>". $stock ."</span> is really low now! Please make an order as soon as possible!</p>";
						array_push($impArray, $msg);
					}
					
				}


				// Print message
				foreach ($impArray as $msg)
				{
					echo $msg;
				}
				foreach ($warningArray as $msg) {
					echo $msg;
				}
			} else {
				if ($data == 1) {
					echo "<p>Uh-oh! There is something wrong with the syetem.</p>";
				} else if ($data == 2) {
					echo "<p>It's a nice day! There is no low stock item.</p>";
				}
			}
			unset($_SESSION['data']);
		}



		?>
	</body>
	<?php include_once "footer.inc"; ?>
</html>