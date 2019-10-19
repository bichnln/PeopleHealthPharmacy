<?php
print <<<END
<nav>
	<button class ="dropbtn" onclick="location.href = 'homepage.php'">Home</button>
	
	<div class="dropdown">
		<button class="dropbtn">Sales</button>
		<div class="dropcontent">
			<a href="addsales.php">Add Sale</a>
			<a href="editsales.php">Edit Sale</a>
		</div>
	</div>
	
	<div class="dropdown">
		<button class="dropbtn">Inventory</button>
		<div class="dropcontent">
			<a href="inventory.php">Add Product</a>
			<a href="editInventory.php">Edit Product</a>
		</div>
	</div>
	
	<button class ="dropbtn" onclick="location.href = 'notification.php'">Stock</button>
	
	<button class ="dropbtn" onclick="location.href = 'request_report.php'">Report</button>
</nav>
END;
?>