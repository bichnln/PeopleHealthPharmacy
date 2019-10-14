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

function update_qty($conn, $name, $itemStock, $updateOption) {
	$query = "SELECT * FROM Inventory_Record WHERE itemName = '$name'";
	$result = mysqli_query($conn, $query);
	$inQty = mysqli_fetch_assoc($result);
	
	if ($result && $inQty != null) {
		if ($updateOption == "Add") {
			$total = $inQty['itemStock'] + $itemStock;
			$query = "UPDATE Inventory_Record SET itemStock = $total WHERE itemName = '$name'";
			$result = mysqli_query($conn, $query);

			if ($result) {
				return True;
			} else {
				return False;
			}
		} else {
			$remain = $inQty['itemStock'] - $itemStock;
			if ($remain > 0) {
				$query = "UPDATE Inventory_Record SET itemStock = $remain WHERE itemName = '$name'";
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

function update_single($conn, $name, $col, $tag) {
	$query = "SELECT * FROM Inventory_Record WHERE itemName = '$name'";
	$result = mysqli_query($conn, $query);
	$item = mysqli_fetch_assoc($result);

	if ($result && $item != null) {
		if ($tag == "price") {
			$query = "UPDATE Inventory_Record SET itemPrice = $col WHERE itemName = '$name'";
			$result = mysqli_query($conn, $query);

			if ($result) {
				return True;
			} else {
				return False;
			}
		} else if ($tag == "cate") {
			$query = "UPDATE Inventory_Record SET category = '$col' WHERE itemName = '$name'";
			$result = mysqli_query($conn, $query);

			if ($result) {
				return True;
			} else {
				return False;
			}
		}
	} else {
		return False;
	}
}

?>