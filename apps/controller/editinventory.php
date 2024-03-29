<?php 
require_once ("../model/editinventory.php");
require("../db_connection.php");

if (isset($_GET["search"])) {
	$com = False;
	if ($_GET["search"] == 1) {
		$data = get_all_data($conn, "");

		if ($data) {
			session_start();
			$_SESSION['data'] = $data;
			
			if (isset($_GET["com"])) {
				$msg = $_GET['com'];
				header ("location: ../view/editinventory.php?com=$msg");
				exit();
			}
		} else {
			$_SESSION['data'] = "Cannot reach to the server!";
		}
	} else {
		$_SESSION['data'] = "Uh-oh! Something went wrong!";
	}
	if (!$com) {
		header ("location: ../view/editinventory.php");
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
	if(isset($_POST["itemCate"])) {
		$itemCate = sanitise_input($_POST["itemCate"]);
	} else {
		// Redirect to form, if the process not triggered by a form submit
		header("location: ../view/inventory.php");
	}
	$updateOption = $_POST["updateOption"];

	// Validate data
	$errMsg = "";

	if($itemName == "") {
		$errMsg .= "You must enter the item's name<br/>";
	} else if (!preg_match("/^[A-Za-z ]{1,40}$/", $itemName)) {
		$errMsg .= "The item name must contain uppercase or lowercase letters and spaces<br/>";
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
	if($itemCate == "") {
		$errMsg .= "You must enter the item's category<br/>";
	} else if (!preg_match("/^([A-Za-z0-9]){1,30}$/", $itemCate)) {
		$errMsg .= "The item category must contain uppercase or lowercase letters without spaces<br/>";
	}

	if($errMsg != ""){
		echo "<span>". $errMsg ."</span>";
		echo "<a href='../view/editinventory.php'>BACK TO APPLY FORM</a>";
	} else {
		$msg = "";
		if ($itemPrice != -1) {
			$result = update_single($conn, $itemName, $itemPrice, "price");
			if ($result) {
				$msg .= "0";
			} else {
				$msg .= "1";
			}
		} 
		if ($itemStock != "") {
			$result = update_qty($conn, $itemName, $itemStock, $updateOption);
			if ($result) {
				$msg .= "2";
			} else {
				$msg .= "3";
			}
		}
		if ($itemCate != "") {
			$result = update_single($conn, $itemName, $itemCate, "cate");
			if ($result) {
				$msg .= "4";
			} else {
				$msg .= "5";
			}
		} 
		header ("location: ../view/editinventory.php?com=$msg");
	}
}

?>