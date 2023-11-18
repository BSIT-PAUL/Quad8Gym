<?php session_start();
include('dbcon.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quad8 Gym Login</title>
    <link rel="stylesheet" href="login/style.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="login-link">
            <div class="logo">
                <img src="img/logoo.png" alt="" height="90%" width="100%">
            </div>
            <p class="side-big-heading">Create your account</p>
            <p class="primary-bg-text">To keep track on your dashboard please login with your personal info</p>
            <a href="register.php" class="loginbtn">Register now</a>
        </div>
        <form action="#" class="signup-form-container" method="POST">
        <br>
            <p class="big-heading">Login</p>
            <div class="social-media-platform">
                <br>
                <br>
                <br>
            </div>
            <div class="login-form-contents">
                <div class="text-fields username">
                    <label for="username"><i class='bx bx-envelope' ></i></label>
                    <input type="text" name="username" id="username" required placeholder="Enter your username">
                </div>
                <div class="text-fields password">
                    <label for="password"><i class='bx bx-lock-alt' ></i></label>
                    <input type="password" name="pass" id="password" required placeholder="Enter password">
                </div>
            </div>
            <input type="submit" value="Login" class="nextPage" name="login">
            <?php
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['pass']);
    $password = md5($password);

    // Check if the user is an admin
    $admin_query = mysqli_query($con, "SELECT * FROM admin WHERE password='$password' and username='$username'");
    $admin_row = mysqli_fetch_array($admin_query);
    $admin_num_row = mysqli_num_rows($admin_query);

    // Check if the user is a staff
    $staff_query = mysqli_query($con, "SELECT * FROM staffs WHERE password='$password' and username='$username'");
    $staff_row = mysqli_fetch_array($staff_query);
    $staff_num_row = mysqli_num_rows($staff_query);

    if ($admin_num_row > 0) {
        // Admin login
        $_SESSION['user_id'] = $admin_row['user_id'];
        header('location: admin/index.php'); // Adjust the path as needed
    } elseif ($staff_num_row > 0) {
        // Staff login
        $_SESSION['user_id'] = $staff_row['user_id'];
        header('location: staff/staff-pages/index.php'); // Adjust the path as needed
    } else {
        // Customer login (assuming it's in the 'members' table)
        $query = mysqli_query($con, "SELECT * FROM members WHERE password='$password' and username='$username' and status='Active'");
        $row = mysqli_fetch_array($query);
        $num_row = mysqli_num_rows($query);

        if ($num_row > 0) {
            // Customer login
            $_SESSION['user_id'] = $row['user_id'];
            header('location: customer/pages/index.php'); // Adjust the path as needed
        } else {
            // Invalid login
            echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                    Invalid Username/Password or Account has been Expired!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
        }
    }
}
?>

            </form>
            <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script> 
        <script src="js/bootstrap.min.js"></script> 
<script src="js/matrix.js"></script>
</body>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</html>