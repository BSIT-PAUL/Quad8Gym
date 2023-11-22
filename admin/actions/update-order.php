<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include 'dbcon.php';

    $qry = "UPDATE `orders` SET `status`='Pick-Up' WHERE `order_id`=$id";
    $result = mysqli_query($con, $qry);

    echo "<script>";
    if ($result) {
        echo "alert('Pick-Up Successfully');";
        echo "window.location.href='../orders.php';";
    } else {
        echo "alert('ERROR!!');";
    }
    echo "</script>";
}
?>
