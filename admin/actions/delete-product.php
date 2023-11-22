<?php

session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}

if(isset($_GET['id'])){
$id=$_GET['id'];

include 'dbcon.php';


$qry="delete from products where item_id=$id";
$result=mysqli_query($con,$qry);

if ($result) {
    // Respond with a success message
    echo json_encode(['status' => 'success']);
    exit();
} else {
    // Respond with an error message
    echo json_encode(['status' => 'error', 'message' => 'Error deleting product.']);
    exit();
}
}
?>