<?php

$servername = "localhost";
$uname = "root";
$pass = "";
$db = "gymnsb";

$conn = mysqli_connect($servername, $uname, $pass, $db);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

$sql = "SELECT SUM(amount) AS total_amount FROM members";
$amountsum = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row_amountsum = mysqli_fetch_assoc($amountsum);

if ($row_amountsum['total_amount'] !== null) {
    echo "" . $row_amountsum['total_amount'];
} else {
    echo "No data found in 'members' table.";
}

mysqli_close($conn);
?>
