<?php 
require_once ("../model/editinventory.php");
require("../db_connection.php");

if (isset($_GET["search"])) {
	$com = False;
	if ($_GET["search"] == 1) {
		$data = get_all_data($conn);

		if ($data) {
			session_start();
			$_SESSION['data'] = $data;
			
			if (isset($_GET["com"])) {
				$msg = $_GET['com'];
				header ("location: ../view/editinventory.php?com=$msg");
				exit();
			} else {

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
		header("location: ../view/addsales.php");
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


	if($errMsg != ""){
		echo "<span>". $errMsg ."</span>";
		echo "<a href='../view/editinventory.php'>BACK TO APPLY FORM</a>";
	} else {
		$msg = "";
		if ($itemPrice != -1) {
			$result = update_price($conn, $itemName, $itemPrice);
			if ($result) {
				// $msg .= "Successfully updated item price!<br/>";
				$msg .= "0";
			} else {
				// $msg .= "Failed to udpate item price!<br/>";
				$msg .= "1";
			}
		} 
		if ($itemStock != "") {
			$result = update_qty($conn, $itemName, $itemStock, $updateOption);
			if ($result) {
				// $msg .= "Successfully updated item stock!<br/>";
				$msg .= "2";
			} else {
				// $msg .= "Failed to udpate item stock!<br/>";
				$msg .= "3";
			}
		}
		header ("location: ../view/editinventory.php?com=$msg");
	}
}

?>