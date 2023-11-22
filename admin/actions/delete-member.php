<?php

session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}

if(isset($_GET['id'])){
$id=$_GET['id'];

include 'dbcon.php';


$qry="delete from members where user_id=$id";
$result=mysqli_query($con,$qry);

if($result){
    echo "alert('Member Deleted Successfully');";
    echo "window.location.href='../remove-member.php';";

}else{
    echo "alert('ERROR!!');";

}
}
?>