<?php 
require_once ("../model/editsales.php");
require("../db_connection.php");

if (isset($_GET["search"])) {
	$com = False;
	if ($_GET["search"] == 1) {
		$data = get_all_data($conn);
		session_start();
		if ($data) {
			$_SESSION['data'] = $data;

			if (isset($_GET["com"])) {
				$msg = $_GET['com'];
				header ("location: ../view/editsales.php?com=$msg");
				exit();
			}
		} else {
			$_SESSION['data'] = "Cannot reach to the server!";
		}
	} else {
		$_SESSION['data'] = "Uh-oh! Something went wrong!";
	}
	if (!$com) {
		header ("location: ../view/editsales.php");
	}
} else {
	// Santitise the input
	function sanitise_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	// Check if process was triggered by a form submit
	if(isset($_POST["itemName"])) {
		$itemName = sanitise_input($_POST["itemName"]);
	} else {
		// Redirect to form, if the process not triggered by a form submit
		header("location: ../view/editsales.php");
	}
	if(isset($_POST["qty"])) {
		$qty = sanitise_input($_POST["qty"]);
	} else {
		// Redirect to form, if the process not triggered by a form submit
		header("location: ../view/editsales.php");
	}
	if(isset($_POST["salesDate"])) {
		$salesDate = sanitise_input($_POST["salesDate"]);
		$salesDate = date('Y-m-d H:i:s', strtotime($salesDate));
	} else {
		// Redirect to form, if the process not triggered by a form submit
		header("location: ../view/editsales.php");
	}

	// Validate data
	$errMsg = "";

	if($itemName == "") {
		$errMsg .= "You must enter the item's name<br/>";
	} else if (!preg_match("/^[A-Za-z ]{1,40}$/", $itemName)) {
		$errMsg .= "The item name must contain uppercase or lowercase letters and spaces<br/>";
	}
	if ($qty != "") {
		if (!preg_match("/([0-9]){1,10}/", $qty)) {
			$errMsg .= "The item quantity must contain only positive numbers<br/>";
		}		
	}

	if($errMsg != ""){
		echo "<span>". $errMsg ."</span>";
		echo "<a href='../view/editsales.php'>BACK TO APPLY FORM</a>";
	} else {
		if ($qty != "") {
			$result = update_qty($conn, $itemName, $salesDate, $qty);
			if($result) {
				header ("location: ../view/editsales.php?com=0");
			} else {
				header ("location: ../view/editsales.php?com=1");
			}
		}
	}
}

?>