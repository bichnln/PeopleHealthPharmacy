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
	if (isset($_SESSION['user'])) {
		unset($_SESSION['user']);
		session_unset();
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
	// Support seperate view
	$user_role = $_SESSION['user']['eRole'];
	$sales_script = "
		<div class='dropdown'>
			<button class='dropbtn'>Sales</button>
			<div class='dropcontent'>
				<a href='addsales.php'>Add Sale</a>
				<a href='editsales.php'>Edit Sale</a>
			</div>
		</div>
	";
	$inventory_script = "
		<div class='dropdown'>
			<button class='dropbtn'>Inventory</button>
			<div class='dropcontent'>
				<a href='inventory.php'>Add Product</a>
				<a href='editInventory.php'>Edit Product</a>
			</div>
		</div>
	";
	$manager_script = "
		<button class ='dropbtn' onclick=\"location.href = 'notification.php'\">Stock</button>
		<button class ='dropbtn' onclick=\"location.href = 'request_report.php'\">Report</button>
	";

	// Separte view
	if ($user_role == 'Sales') {
		echo $sales_script;
	} else if ($user_role == 'Inventory') {
		echo $inventory_script;
	} else if ($user_role == "Manager") {
		echo $sales_script . $inventory_script . $manager_script;
	}

	echo "				
		<button class ='dropbtn' onclick=\"location.href = 'login.php?logout=1'\">Logout</button>
	</nav>
	";
}

?>