<?php 
require_once ("../model/editinventory.php");
require("../db_connection.php");

if (isset($_GET["search"])) {
	if ($_GET["search"] == 1) {
		$data = get_all_data($conn);

		if ($data) {
			session_start();
			$_SESSION['data'] = $data;
		} else {
			$_SESSION['data'] = "Cannot reach to the server!";
		}
	} else {
		$_SESSION['data'] = "Uh-oh! Something went wrong!";
	}
	header ("location: ../view/editinventory.php");
} else {
	// Santitise the input
	function sanitise_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	// Check if process was triggered by a form submit
	if(isset($_POST["itemID"])) {
		$itemID = sanitise_input($_POST["itemID"]);
	} else {
		// Redirect to form, if the process not triggered by a form submit
		header("location: ../view/editinventory.php");
	}
	if(isset($_POST["itemPrice"])) {
		$itemPrice = sanitise_input($_POST["itemPrice"]);
		if (!$itemPrice) {
			$itemPrice = -1;
		}
	} else {
		// Redirect to form, if the process not triggered by a form submit
		header("location: ../view/editinventory.php");
	}
	if(isset($_POST["itemStock"])) {
		$itemStock = sanitise_input($_POST["itemStock"]);
	} else {
		// Redirect to form, if the process not triggered by a form submit
		header("location: ../view/editinventory.php");
	}
	$updateOption = $_POST["updateOption"];

	// Validate data
	$errMsg = "";

	if($itemID == "") {
		$errMsg .= "You must enter the item ID<br/>";
	} else if (!preg_match("/^([0-9]){1,10}$/", $itemID)) {
		$errMsg .= "The item ID must contain only number from 0 to 9 with the maximum length of 10<br/>";
	}

	if ($itemPrice != -1) {
		if (!preg_match("/([0-9])+(\.[0-9]{1,2})?/", $itemPrice)) {
			$errMsg .= "The item price must contain only decimal numbers<br/>";
		}
	}
	
	if ($itemStock != "") {
		if (!preg_match("/([0-9]){1,10}/", $itemStock)) {
			$errMsg .= "The item quantity must contain only positive numbers<br/>";
		}		
	}


	if($errMsg != ""){
		echo "<span>". $errMsg ."</span>";
		echo "<a href='../view/editinventory.php'>BACK TO APPLY FORM</a>";
	} else {
		if ($itemPrice != -1) {
			$result = update_price($conn, $itemID, $itemPrice);
		} 
		if ($itemStock != "") {
			$result = update_qty($conn, $itemID, $itemStock, $updateOption);
		}
		header ("location: ../view/editinventory.php");
	}
}

?>