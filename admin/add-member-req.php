<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
include 'dbcon.php';

if(isset($_POST['fullname'])){
  $fullname = $_POST["fullname"];    
  $username = $_POST["username"];
  $passwords = $_POST["password"];
  $password = md5($passwords);
  $dor = $_POST["dor"];
  $gender = $_POST["gender"];
  $services = $_POST["services"];
  // $paid_date='$curr_date';
  $amount = $_POST["amount"];
  $p_year = date('Y');
  $paid_date = date("Y-m-d");
  $plan = $_POST["plan"];
  $address = $_POST["address"];
  $contact = $_POST["contact"];

  $password = md5($password);

  $totalamount = $amount * $plan;
 // Use prepared statement to prevent SQL injection
 $qry = $con->prepare("INSERT INTO members(fullname, username, password, dor, gender, services, amount, p_year, paid_date, plan, address, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

 // Bind parameters
 $qry->bind_param("ssssssssssss", $fullname, $username, $password, $dor, $gender, $services, $amount, $p_year, $paid_date, $plan, $address, $contact);

 // Execute the query
 $result = $qry->execute();


if ($result) {
    // Respond with a success message
    echo json_encode(['status' => 'success']);
    exit();
} else {
    // Respond with an error message and log the error
    echo json_encode(['status' => 'error', 'message' => 'Error adding member.']);
    error_log("Error adding member: " . $qry->error);
    exit();
}

}
?>

