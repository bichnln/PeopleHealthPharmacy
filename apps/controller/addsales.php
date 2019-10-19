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
	header("location: ../view/addsales.php");
}
if(isset($_POST["qty"])) {
	$qty = sanitise_input($_POST["qty"]);
} else {
	// Redirect to form, if the process not triggered by a form submit
	header("location: ../view/addsales.php");
}
if(isset($_POST["salesDate"])) {
	$salesDate = sanitise_input($_POST["salesDate"]);
} else {
	// Redirect to form, if the process not triggered by a form submit
	header("location: ../view/addsales.php");
}

// Validate data
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
$errMsg = "";

if($itemName == "") {
	$errMsg .= "You must enter the item's name<br/>";
} else if (!preg_match("/^[A-Za-z ]{1,40}$/", $itemName)) {
	$errMsg .= "The item name must contain uppercase or lowercase letters and spaces<br/>";
}
if($qty == "") {
	$errMsg .= "You must enter the quantity";
} else if (!preg_match("/^[0-9]{1,10}$/", $qty)) {
	$errMsg .= "The item quantity must contain only number from 0 to 9 with the maximum length of 10<br/>";
}
if(!validateDate($salesDate)){
	$errMsg .= "The sales date must match the format (dd/mm/yyyy hh:mm:ss)<br/>";
} else {
	$year = explode("-", $salesDate)[0];

	if ($year > date("Y")) {
		$errMsg .= "The sales year must less than or equal to the current year<br/>";
	}
}

if($errMsg != ""){
	echo "<span>". $errMsg ."</span>";
	echo "<a href='../view/addsales.php'>BACK TO APPLY FORM</a>";
} else {
	// Create a hidden form
	echo 
		"<form id='modelForm' action='../model/salesdb.php' method='POST'>".
			"<input id='itemName' name='itemName' type='hidden' value='". $itemName ."'/>".
			"<input id='qty' name='qty' type='hidden' value='". $qty ."'/>".
			"<input id='salesDate' name='salesDate' type='hidden' value='". $salesDate ."'/>".
			"<button id='subBtn' type='submit' name='subBtn'>Add</button>".
		"</form>".
		"<script type='text/javascript'>
			window.onload = function () {
   				document.getElementById('modelForm').submit();
   			}
		</script>";
}
?>


