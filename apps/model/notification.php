<?php
function get_low_stock_items($conn) {
	$query = "SELECT itemName, itemStock 
				FROM Inventory_Record 
				WHERE itemStock < 100";
	$result = mysqli_query($conn, $query);

	if ($result) {
		$data = mysqli_fetch_all($result);

		if ($data != null) {
			return $data;
		} else {
			return 2;
		}
	} else {
		return 1;
	}
}

?>