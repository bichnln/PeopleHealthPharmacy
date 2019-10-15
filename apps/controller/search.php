<?php
require_once ("../model/editinventory.php");
require("../db_connection.php");

function sanitise_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (isset($_POST['page'])) {
	$page = $_POST['page'];
} else {
	header("location: ../view/homepage.php");
}

if ($page) {
	if(isset($_POST["itemName"])) {
		$itemName = sanitise_input($_POST["itemName"]);

		$data = get_all_data($conn, $itemName);
		if ($data) {
			session_start();
			$_SESSION['items'] = $data;
		}  else {
			header ("location: ../view/". $page .".php?com=2");
			exit();
		}

		header ("location: ../view/". $page .".php?com=1");
		exit();
	} else {
		// Redirect to form, if the process not triggered by a form submit
		header("location: ../view/". $page .".php?com=0");
		exit();
	}
}





?>