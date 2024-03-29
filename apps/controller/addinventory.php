<script type="text/javascript">
    document.getElementById('subBtn').submit(); // SUBMIT FORM
</script>

<?php
// Santitise the input
function sanitise_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// Check if process was triggered by a form submit
if(isset($_POST["itemName"])) {
	$itemName = sanitise_input($_POST["itemName"]);
} else {
	// Redirect to form, if the process not triggered by a form submit
	header("location: ../view/inventory.php");
}
if(isset($_POST["itemPrice"])) {
	$itemPrice = sanitise_input($_POST["itemPrice"]);
} else {
	// Redirect to form, if the process not triggered by a form submit
	header("location: ../view/inventory.php");
}
if(isset($_POST["itemStock"])) {
	$itemStock = sanitise_input($_POST["itemStock"]);
} else {
	// Redirect to form, if the process not triggered by a form submit
	header("location: ../view/inventory.php");
}
if(isset($_POST["itemCate"])) {
	$itemCate = sanitise_input($_POST["itemCate"]);
} else {
	// Redirect to form, if the process not triggered by a form submit
	header("location: ../view/inventory.php");
}

// Validate data
$errMsg = "";

if($itemName == "") {
	$errMsg .= "You must enter the item's name<br/>";
} else if (!preg_match("/^[A-Za-z ]{1,40}$/", $itemName)) {
	$errMsg .= "The item name must contain uppercase or lowercase letters and spaces<br/>";
}
if($itemPrice == "") {
	$errMsg .= "You must enter the item's price<br/>";
} else if (!preg_match("/^([0-9])+(\.[0-9]{1,2})?$/", $itemPrice)) {
	$errMsg .= "The item price must contain only decimal numbers<br/>";
}
if($itemStock == "") {
	$errMsg .= "You must enter the item's quantity<br/>";
} else if (!preg_match("/^([0-9]){1,10}$/", $itemStock)) {
	$errMsg .= "The item quanity must contain only positive numbers<br/>";
}
if($itemCate == "") {
	$errMsg .= "You must enter the item's category<br/>";
} else if (!preg_match("/^([A-Za-z0-9]){1,30}$/", $itemCate)) {
	$errMsg .= "The item category must contain uppercase or lowercase letters without spaces<br/>";
}


if($errMsg != ""){
	echo "<span>". $errMsg ."</span>";
	echo "<a href='../view/inventory.php'>BACK TO APPLY FORM</a>";
} else {
	// Create a hidden form
	echo 
		"<form id='modelForm' action='../model/inventorydb.php' method='POST'>".
			"<input id='itemName' name='itemName' type='hidden' value='". $itemName ."'/>".
			"<input id='itemPrice' name='itemPrice' type='hidden' value='". $itemPrice ."'/>".
			"<input id='itemStock' name='itemStock' type='hidden' value='". $itemStock ."'/>".
			"<input id='itemCate' name='itemCate' type='hidden' value='". $itemCate ."'/>".
			"<button id='subBtn' type='submit' name='subBtn'>Add</button>".
		"</form>".
		"<script type='text/javascript'>
			window.onload = function () {
   				document.getElementById('modelForm').submit();
   			}
		</script>";
}
?>

