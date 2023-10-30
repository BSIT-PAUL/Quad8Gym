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
            <p class="side-big-heading">or continue as</p>
            <p class="primary-bg-text">Login as</p>
            <a href="customer/login.php" class="loginbtn">Customer</a>
            <a href="login.php" class="loginbtn">Admin</a>
        </div>
        <form action="#" class="signup-form-container" method="POST">
            <p class="big-heading">Staff Login</p>
            <div class="social-media-platform">
                <a href="#"><i class='bx bx-sm bxl-facebook' ></i></a>
                <a href="#"><i class='bx bx-sm bxl-twitter' ></i></a>
                <a href="#"><i class='bx bx-sm bxl-github' ></i></a>
            </div>
            <div class="login-form-contents">
                <div class="text-fields username">
                    <label for="username"><i class='bx bx-envelope' ></i></label>
                    <input type="text" name="user" id="username" required placeholder="Enter your username">
                </div>
                <div class="text-fields password">
                    <label for="password"><i class='bx bx-lock-alt' ></i></label>
                    <input type="password" name="pass" id="password" required placeholder="Enter password">
                </div>
            </div>
            <input type="submit" value="Login" class="nextPage" name="login">
            <?php
                if (isset($_POST['login'])) {
                    $username = mysqli_real_escape_string($con, $_POST['user']);
                    $password = mysqli_real_escape_string($con, $_POST['pass']);
                    
                    $password = md5($password);
                    
                    $query = mysqli_query($con, "SELECT * FROM staffs WHERE password='$password' and username='$username'");
                    
                    if (!$query) {
                      // Query failed, handle the error
                      echo "Error: " . mysqli_error($con); // Display the specific MySQL error
                  } else {
                      $num_row = mysqli_num_rows($query);
              
                      if ($num_row > 0) {
                          $row = mysqli_fetch_array($query);
                          $_SESSION['user_id'] = $row['user_id'];
                          header('location:staff-pages/index.php');
                      } else {
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