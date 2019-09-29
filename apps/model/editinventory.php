<?php  

function get_all_data($conn) {
	$query = "SELECT * FROM Inventory_Record";
	$result = mysqli_query($conn, $query);
	if ($result) {
		$data = mysqli_fetch_all($result);
		return $data;
	} else {
		return false;
	}

}

function update_qty($conn, $id, $itemStock, $updateOption) {
	$query = "SELECT * FROM Inventory_Record WHERE itemID = $id";
	$result = mysqli_query($conn, $query);

	if ($result) {
		$inQty = mysqli_fetch_assoc($result);

		if ($updateOption == "Add") {
			$total = $inQty['itemStock'] + $itemStock;
			$query = "UPDATE Inventory_Record SET itemStock = $total WHERE itemID = $id";
			$result = mysqli_query($conn, $query);

			if ($result) {
				return True;
			} else {
				return False;
			}
		} else {
			$remain = $inQty['itemStock'] - $itemStock;
			if ($remain > 0) {
				$query = "UPDATE Inventory_Record SET itemStock = $remain WHERE itemID = $id";
				$result = mysqli_query($conn, $query);
				
				if ($result) {
					return True;
				} else {
					return False;
				}
			} else {
				return False;
			}
		}

	} else {
		return False;
	}
}

function update_price($conn, $id, $price) {
	$query = "SELECT * FROM Inventory_Record WHERE itemID = $id";
	$result = mysqli_query($conn, $query);

	if ($result) {
		$query = "UPDATE Inventory_Record SET itemPrice = $price WHERE itemID = $id";
		$result = mysqli_query($conn, $query);

		if ($result) {
			return True;
		} else {
			return False;
		}
	} else {
		return False;
	}
}

?>