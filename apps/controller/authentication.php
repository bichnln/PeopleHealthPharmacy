<?php
require_once "../db_connection.php";
require_once "../model/authentication.php";

// Santitise the input
function sanitise_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (isset($_POST["username"])) {
	$user_id = sanitise_input($_POST["username"]);
} else {
	// Uncorrect access
	header("location: ../view/login.php?err=0");
}
if (isset($_POST["password"])) {
	$password = sanitise_input($_POST["password"]);
} else {
	// Uncorrect access
	header("location: ../view/login.php?err=0");
}

if (!preg_match("/^[A-Za-z0-9]{1,30}$/", $user_id)) {
	// Uncorrect pattern input
	header("location: ../view/login.php?err=1");
}
if (!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
	// Uncorrect pattern input
	header("location: ../view/login.php?err=1");
	
}

$auth_result = check_user($conn, $user_id, $password);
if($auth_result) {
	// IF the authenticaton is successful, let the user go to the homepage
	header("location: ../view/homepage.php");
	exit();
} else {
	// IF the authentication is failed, redirect to login page.
	header("location: ../view/login.php?auth=0");
	exit();
}

?>