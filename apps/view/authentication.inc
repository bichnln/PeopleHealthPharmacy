<?php
// Set employee ID if exists
session_start();
if (!isset($_SESSION['user'])) {
	header("location: login.php?fail=1");
} else {
	// Specify pages
	$sales_pages = array("addsales.php", "editsales.php");
	$inv_pages = array("inventory.php", "editinventory.php");
	$manager_pages = array("notification.php", "request_report.php", "displayreport.php");

	// Specify url
	$url = explode("/", $_SERVER['REQUEST_URI']);
	if (strpos($url[4], '?')) {
		$url = explode('?', $url[4])[0];
	} else {
		$url = $url[4];
	}

	// Specify role
	$user_role = $_SESSION['user']['eRole'];

	// Check page
	if (in_array($url, $sales_pages) && $user_role != 'Sales' && $user_role != 'Manager') {
		header("location: homepage.php?failRole=1");
	}
	if (in_array($url, $inv_pages) && $user_role != 'Inventory' && $user_role != 'Manager') {
		header("location: homepage.php?failRole=1");
	}
	if (in_array($url, $manager_pages) && $user_role != 'Manager') {
		header("location: homepage.php?failRole=1");
	}

}

?>