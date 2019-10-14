<?php 
require_once ("../db_connection.php");
require_once ("../model/notification.php");

if (isset($_GET['search'])) {
	if ($_GET['search'] == 1) {
		$data = get_low_stock_items($conn);

		session_start();
		$_SESSION['data'] = $data;
		header("location: ../view/notification.php");
		exit();
	}

}

?>