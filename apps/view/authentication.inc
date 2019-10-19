<?php
// Set employee ID if exists
session_start();
if (isset($_SESSION['user_id'])) {
	echo $_SESSION['user_id']['eID'];
} else {
	header("location: login.php?fail=1");
}
?>