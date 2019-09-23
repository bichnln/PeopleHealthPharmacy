<?php

require_once ("settings.php");

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
// Evaluate the connection
if (!$conn) {
    echo "<p> Database connection failure </p>";
    exit();
}
?>