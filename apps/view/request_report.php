<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'/>
    <meta name="description" content="People Health Pharmacy System"/>
    <meta name="keywords" content="DP2"/>
    <meta name="authors" content=""/>
</head>

<body>
	<div class="content">
		<?php include_once "header.inc"; ?>
		
		<form id="chooseDate" action="../controller/generatereport.php" method="post">
            <fieldset>
                <legend>Generate Sales Report</legend>
                <p>Select date to get sales report within selected date range.</p>
                <p>Select nothing to get report of all sales data existing in the database.</p>
    			
                <label for="from_date">From: </label>
    			<input type="date" id="from_date" name="from_date"/> <br>
    			<label for="to_date">To: </label>
    			<input type="date" id="to_date" name="to_date"/> <br>

                <h2>Prediction: </h2>
                <label for='week' >Week: </label>
                <input type='text' name='week' value= "<?php echo date('d-m-Y'); ?>" /> <br>

                <label for='month'>Month: </label>
                <input type='text' name='month' value= "<?php echo date('d-m-Y'); ?>" /> <br>
                
                <br>
                <input type="submit" value="Get Report"/>
            </fieldset>
        </form>
        <?php include_once "footer.inc"; ?>
    </div>
</body>
</html>