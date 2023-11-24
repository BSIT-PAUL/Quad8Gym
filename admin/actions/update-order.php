<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include 'dbcon.php';

    // Update order status to 'Pick-Up'
    $qry = "UPDATE `orders` SET `status`='Pick-Up' WHERE `order_id`=$id";
    $result = mysqli_query($con, $qry);

    // Update product quantity_available
    $updqty = "UPDATE `products`
               SET `quantity_available` = `quantity_available` - (
                   SELECT `quantity_ordered`
                   FROM `orders`
                   WHERE `orders`.`item_id` = `products`.`item_id`
                   AND `orders`.`order_id` = $id
                   AND `orders`.`status` = 'Pick-Up'
               )
               WHERE EXISTS (
                   SELECT 1
                   FROM `orders`
                   WHERE `orders`.`item_id` = `products`.`item_id`
                   AND `orders`.`order_id` = $id
                   AND `orders`.`status` = 'Pick-Up'
               )";
    $resultupt = mysqli_query($con, $updqty);

    echo "<script>";
    if ($result && $resultupt) {
        echo "alert('Pick-Up Successfully');";
        echo "window.location.href='../orders.php';";
    } else {
        echo "alert('ERROR!!');";
    }
    echo "</script>";
}
?>
