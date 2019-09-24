<?php require_once ("../db_connection.php"); ?>

<?php 
if(isset($_POST["submit"]))
{
	$id = $_POST["itemID"];
	$date = $_POST["salesDate"];
	$quantity = $_POST["qty"];

	$query = "SELECT * FROM Sales_Record WHERE itemID = '$id'";

	$result=mysqli_query($conn, $query);

	if(mysqli_num_rows($result)!=1)
	{
		die(mysqli_error($conn));
	}

	else
	{
		$command = "UPDATE Sales_Record SET qty = '$quantity', salesDate = '$date' WHERE itemID = '$id'";
		$sql = mysqli_query($conn, $command);
	}
	exit;
}
?>