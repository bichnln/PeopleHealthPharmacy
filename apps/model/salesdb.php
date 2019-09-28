<?php

// Retrieved information
$eID = "1";	// Without login feature
if (isset($_POST["itemID"])) {
	$itemID = $_POST["itemID"];
} else {
	// Error 0 - information hasn't been passed
	header("location: ../controller/addsales.php?err=s0");
}
if (isset($_POST["qty"])) {
	$qty = $_POST["qty"];
} else {
	// Error 0 - information hasn't been passed
	header("location: ../controller/addsales.php?err=s0");
}
if (isset($_POST["salesDate"])) {
	$salesDate = $_POST["salesDate"];
} else {
	// Error 0 - information hasn't been passed
	header("location: ../controller/addsales.php?err=s0");
}

require_once("../db_connection.php");
$sql_sales_table = "CREATE TABLE IF NOT EXISTS Sales_Record(
					eID varchar(30) NOT NULL,
					itemID int(10) NOT NULL,
					salesDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					qty int(10),
					PRIMARY KEY(eID, itemID, salesDate),
					FOREIGN KEY (itemID) REFERENCES Inventory_Record(itemID));";

$result = mysqli_query($conn, $sql_sales_table);

// Check if it can create a sales table
if ($result) {
	// Check stock quantity in inventory
	$checkQtyQuery = "SELECT * FROM Inventory_Record WHERE itemID = $itemID";
	$result = mysqli_query($conn, $checkQtyQuery);
	
	if ($result) {
		$inQty = mysqli_fetch_assoc($result);

		// Check input quantity and current quantity in stock
		if ($inQty['itemStock'] >= $qty) {
			$remain = $inQty['itemStock'] - $qty;
			$updateQuery = "UPDATE Inventory_Record SET itemStock = $remain WHERE itemID = $itemID";
			$result = mysqli_query($conn, $updateQuery);

			// Check the update query
			if ($result) {
				$insertQuery = "INSERT INTO Sales_Record(eID, itemID, salesDate, qty) VALUES ($eID, $itemID, '$salesDate', $qty)";
				$result = mysqli_query($conn, $insertQuery);

				// Check the insertion query
				if ($result) {
					header("location: ../controller/addsales.php?suc=s1");
				} else {
					// Error 4 - Cannot insert into sales table
					header("location: ../controller/addsales.php?err=s4");
				}
			} else {
				// Error 3 - Cannot update inventory table
				header("location: ../controller/addsales.php?err=s3");
			}
		} else {
			// Message 1 - Not much item in stock
			header("location: ../controller/addsales.php?msg=s1");
		}
	} else {
		// Error 2 - There is no item with the given ID
		header("location: ../controller/addsales.php?err=s2");
	}
} else {
	// Error 1 - Can not create a sales table
	header("location: ../controller/addsales.php?err=s1");
}

?>