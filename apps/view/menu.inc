<?php
$pages = array("addsales.php", "editsales.php", "inventory.php", "editinventory.php", "notification.php", "request_report.php", 
				"homepage.php", "displayreport.php");
$url = explode("/", $_SERVER['REQUEST_URI']);

echo "
<nav>
	<button class ='dropbtn' onclick=\"location.href = 'homepage.php'\">Home</button>
";

// Support logout;
if (isset($_GET['logout'])) {
	session_start();
	if (isset($_SESSION['user_id'])) {
		unset($_SESSION['user_id']);
	}
}

// Specify url
if (strpos($url[4], '?')) {
	$url = explode('?', $url[4])[0];
} else {
	$url = $url[4];
}

// Prevent unauthenticated users from accessing pages via buttons
if (in_array($url, $pages)) {
	echo "
		<div class='dropdown'>
			<button class='dropbtn'>Sales</button>
			<div class='dropcontent'>
				<a href='addsales.php'>Add Sale</a>
				<a href='editsales.php'>Edit Sale</a>
			</div>
		</div>
		
		<div class='dropdown'>
			<button class='dropbtn'>Inventory</button>
			<div class='dropcontent'>
				<a href='inventory.php'>Add Product</a>
				<a href='editInventory.php'>Edit Product</a>
			</div>
		</div>

				
		<button class ='dropbtn' onclick=\"location.href = 'notification.php'\">Stock</button>
		
		<button class ='dropbtn' onclick=\"location.href = 'request_report.php'\">Report</button>

		<button class ='dropbtn' onclick=\"location.href = 'login.php?logout=1'\">Logout</button>
	</nav>
	";
}

?>