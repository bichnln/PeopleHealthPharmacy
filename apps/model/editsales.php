<?php  

function get_all_data($conn) {
	$query = "SELECT inv.itemName, s.salesDate, s.qty
				FROM Sales_Record s
				INNER JOIN Inventory_Record inv
				ON s.itemID = inv.itemID";
	$result = mysqli_query($conn, $query);
	if ($result) {
		$data = mysqli_fetch_all($result);
		return $data;
	} else {
		return false;
	}
}

function update_qty($conn, $name, $salesDate, $qty) {
	$query = "SELECT * FROM Inventory_Record WHERE itemName = '$name'";
	$result = mysqli_query($conn, $query);

	if ($result) {
		$itemID = mysqli_fetch_assoc($result)['itemID'];
		$query = "SELECT * FROM Sales_Record WHERE itemID = $itemID AND salesDate='$salesDate'";
		$result = mysqli_query($conn, $query);

		if ($result) {
			$record = mysqli_fetch_assoc($result);
			if ($record != null) {
				$recordQty = $record['qty'];
				$rem = $recordQty - $qty;
				$query = "UPDATE Sales_Record SET qty = $qty WHERE itemID = $itemID AND salesDate = '$salesDate'";
				$result = mysqli_query($conn, $query);

				if ($result) {
					$query = "UPDATE Inventory_Record SET itemStock = itemStock + $rem WHERE itemID = $itemID";
					$result = mysqli_query($conn, $query);

					if ($result) {
						return True;
					} else {
						return False;
					}
				} else {
					return False;
				}
			} else {
				return False;
			}
		} else {
			return False;
		}

	} else {
		return False;
	}
}
?>