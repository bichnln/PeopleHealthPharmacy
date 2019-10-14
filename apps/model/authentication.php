<?php

function check_user($conn, $user_id, $pwd) {
	$query = "SELECT eName FROM Employee WHERE eID = '$user_id' AND ePassword = '$pwd'";
	$result = mysqli_query($conn, $query);

	if ($result) {
		$row = mysqli_fetch_all($result);
		echo $pwd;

		if ($row != null) {
			return True;
		} else {
			return False;
		}
	} else {
		return False;
	}
}		

?>