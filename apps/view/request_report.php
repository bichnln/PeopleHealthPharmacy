<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'/>
    <meta name="description" content="People Health Pharmacy System"/>
    <meta name="keywords" content="DP2"/>
    <meta name="authors" content=""/>
</head>

<body>
    <p>Select date to get sales report within selected date range.</p>
    <p>Select nothing to get report of all sales data existing in the database</p>
    
    <form id="chooseDate" action="../controller/generatereport.php" method="post">
        <label for="from_date">From: </label>
        <input type="date" id="from_date" name="from_date"/> <br>
        <label for="to_date">To: </label>
        <input type="date" id="to_date" name="to_date"/> <br>

        <label>Group by: </label>
        <label for="month">Month</label>
        <input type="radio" name="group_by" value="month" id="month"/> 
        <label for="week">Week</label>
        <input type="radio" name="group_by" value="week" id="week"/> <br>
        
        <input type="submit" value="Get Report"/>
    </form>
    
</body>
</html>