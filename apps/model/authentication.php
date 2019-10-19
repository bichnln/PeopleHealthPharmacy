<?php

function check_user($conn, $user_id, $pwd) {
	$query = "SELECT * FROM Employee WHERE eID = '$user_id' AND ePassword = '$pwd'";
	$result = mysqli_query($conn, $query);

	if ($result) {
		$row = mysqli_fetch_assoc($result);

		if ($row != null) {
			return $row;
		} else {
			return False;
		}
	} else {
		return False;
	}
}		

?>