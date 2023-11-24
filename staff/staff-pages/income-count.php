<?php

$servername="localhost";
$uname="root";
$pass="";
$db="gymnsb";

$conn=mysqli_connect($servername,$uname,$pass,$db);

if(!$conn){
    die("Connection Failed");
}
// Query for orders
$sql_orders = "SELECT SUM(Price) AS order_sum FROM orders WHERE status='Pick-Up'";
$orders_result = mysqli_query($conn, $sql_orders) or die(mysqli_error($conn));
$row_orders = mysqli_fetch_assoc($orders_result);
$order_sum = $row_orders['order_sum'];

// Query for members
$sql_members = "SELECT SUM(amount) AS member_sum FROM members";
$members_result = mysqli_query($conn, $sql_members) or die(mysqli_error($conn));
$row_members = mysqli_fetch_assoc($members_result);
$member_sum = $row_members['member_sum'];

// Calculate the total sum
$total_sum = $order_sum + $member_sum;

// Display the total sum
echo  $total_sum;

// Close the database connection
mysqli_close($conn);
?> 