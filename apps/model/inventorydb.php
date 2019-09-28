<?php

// Retrieved information
if (isset($_POST["itemID"])) {
	$itemID = $_POST["itemID"];
} else {
	// Error 0 - information hasn't been passed
	header("location: ../controller/addinventory.php?err=i0");
}
if (isset($_POST["itemName"])) {
	$itemName = $_POST["itemName"];
} else {
	// Error 0 - information hasn't been passed
	header("location: ../controller/addinventory.php?err=i0");
}
if (isset($_POST["itemPrice"])) {
	$itemPrice = $_POST["itemPrice"];
} else {
	// Error 0 - information hasn't been passed
	header("location: ../controller/addinventory.php?err=i0");
}
if (isset($_POST["itemStock"])) {
	$itemStock = $_POST["itemStock"];
} else {
	// Error 0 - information hasn't been passed
	header("location: ../controller/addinventory.php?err=i0");
}

require_once("../db_connection.php");
$sql_sales_table = "CREATE TABLE IF NOT EXISTS Inventory_Record(
					itemID int(10) NOT NULL,
					itemName varchar(40) NOT NULL,
					itemPrice decimal(5,2) NOT NULL,
					itemStock int(10),
					PRIMARY KEY(itemID));";

$result = mysqli_query($conn, $sql_sales_table);

// Check if it can create a inventory table
if ($result) {
	// Check duplicate data
	$checkDuplicate = "SELECT * FROM Inventory_Record 
					   WHERE itemName = '$itemName' AND itemPrice = '$itemPrice'";
	$result = mysqli_query($conn, $checkDuplicate);

	if($result) {
		$item = mysqli_fetch_assoc($result);

		if ($item) {
			// IF an item exists
			// Check whether item ID is different or not
			if ($item['itemID'] != $itemID) {
				// IF it is different, changes it back to the correct one
				$itemID = $item['itemID'];
			}
			$total = $item['itemID'] + $itemStock;
			$updateQuery = "UPDATE Inventory_Record SET itemStock = $total WHERE itemID = $itemID";
			$result = mysqli_query($conn, $updateQuery);

			if($result) {
				// Success 1 - Update item successfully
				header("location: ../controller/addinventory.php?suc=i1");
			} else {
				// Error 3 - Can not update inventory
				header("location: ../controller/addinventory.php?err=i3");
			}
		} else {
			// IF an item doesn't exist
			// Check itemID to make sure it a unique key
			$checkID = "SELECT * FROM Inventory_Record WHERE itemID = $itemID";
			$result = mysqli_query($conn, $checkID);

			if ($result) {
				$item = mysqli_fetch_assoc($result);
				
				if ($item) {
					// IF item exists -> Error 5 - item ID is not a unique key.
					header("location: ../controller/addinventory.php?err=i5");
				} else {
					// IF item doesn't exist
					$insertQuery = "INSERT INTO Inventory_Record(itemID, itemName, itemPrice, itemStock) VALUES ($itemID, '$itemName', $itemPrice, $itemStock);";

					$result = mysqli_query($conn, $insertQuery);
					if ($result) {
						// Success 2 - Insert item successfully
						header("location: ../controller/addinventory.php?suc=i2");
					} else {
						// Error 6 - Can not insert item
						header("location: ../controller/addinventory.php?err=i6");
					}
				}
			} else {
				// Error 4 - Can not check item ID
				header("location: ../controller/addinventory.php?err=i4");
			}
		}
	} else {
		// Error 2 - Can not check duplicate
		header("location: ../controller/addinventory.php?err=i2");
	}
} else {
	// Error 1 - Can not create a inventory table
	header("location: ../controller/addinventory.php?err=i1");
}

?>