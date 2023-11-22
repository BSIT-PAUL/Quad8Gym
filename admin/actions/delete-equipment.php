<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit(); // It's good practice to exit after a header redirect
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include 'dbcon.php';

    $qry = "DELETE FROM equipment WHERE id = $id";
    $result = mysqli_query($con, $qry);

    if ($result) {
        // Respond with a success message
        echo json_encode(['status' => 'success']);
        exit();
    } else {
        // Respond with an error message
        echo json_encode(['status' => 'error', 'message' => 'Error deleting equipment.']);
        exit();
    }
}
?>
