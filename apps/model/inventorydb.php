<?php

// Retrieved information
if (isset($_POST["itemName"])) {
	$itemName = $_POST["itemName"];
} else {
	// Error 0 - information hasn't been passed
	header("location: ../view/inventory.php?err=i0");
}
if (isset($_POST["itemPrice"])) {
	$itemPrice = $_POST["itemPrice"];
} else {
	// Error 0 - information hasn't been passed
	header("location: ../view/inventory.php?err=i0");
}
if (isset($_POST["itemStock"])) {
	$itemStock = $_POST["itemStock"];
} else {
	// Error 0 - information hasn't been passed
	header("location: ../view/inventory.php?err=i0");
}
if(isset($_POST["itemCate"])) {
	$itemCate = $_POST["itemCate"];
} else {
	// Redirect to form, if the process not triggered by a form submit
	header("location: ../view/inventory.php");
}

require_once("../db_connection.php");
$sql_sales_table = "CREATE TABLE IF NOT EXISTS Inventory_Record(
					itemID int(10) NOT NULL AUTO_INCREMENT,
					itemName varchar(40) NOT NULL,
					itemPrice decimal(5,2) NOT NULL,
					itemStock int(10),
					category varchar(30),
					PRIMARY KEY(itemID));";

$result = mysqli_query($conn, $sql_sales_table);

// Check if it can create a inventory table
if ($result) {
	// Check duplicate data
	$checkDuplicate = "SELECT * FROM Inventory_Record 
					   WHERE itemName = '$itemName'";
	$result = mysqli_query($conn, $checkDuplicate);

	if($result) {
		$item = mysqli_fetch_assoc($result);

		if ($item) {
			// IF an item exists
			$itemID = $item['itemID'];
			$total = $item['itemStock'] + $itemStock;
			$updateQuery = "UPDATE Inventory_Record SET itemStock = $total WHERE itemID = $itemID";
			$result = mysqli_query($conn, $updateQuery);

			if($result) {
				// Success 1 - Update item successfully
				header("location: ../view/inventory.php?suc=i1");
			} else {
				// Error 3 - Can not update inventory
				// header("location: ../view/inventory.php?err=i3");
				echo mysql_error($result);
			}
		} else {
			// IF an item doesn't exist
			$insertQuery = "INSERT INTO Inventory_Record(itemName, itemPrice, itemStock, category) VALUES ('$itemName', $itemPrice, $itemStock, '$itemCate');";

			$result = mysqli_query($conn, $insertQuery);
			if ($result) {
				// Success 2 - Insert item successfully
				header("location: ../view/inventory.php?suc=i2");
			} else {
				// Error 4 - Can not insert item
				header("location: ../view/inventory.php?err=i4");

			}
		}
	} else {
		// Error 2 - Can not check duplicate
		header("location: ../view/inventory.php?err=i2");
	}
} else {
	// Error 1 - Can not create a inventory table
	header("location: ../view/inventory.php?err=i1");
}

?>