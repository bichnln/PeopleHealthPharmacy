
<?php
		require_once "../db_connection.php";
		if ($conn) {
			$username = trim($_POST["username"]);
			$password = trim($_POST["password"]);
			
			$query= mysqli_query($conn, "SELECT eID, ePassWord FROM employee WHERE eID = '$username' AND ePassWord = '$password'");			
			$row = mysqli_fetch_array($query);
		
			if(!empty($row['eID']) AND !empty($row['ePassWord']))
			{
				$_SESSION['eID'] = $row['ePassWord'];
				header("location: homepage.php");
				exit();
			}
			else
				header("location: login.php");
				exit();
		} else
			echo "DB connection error!";
?>