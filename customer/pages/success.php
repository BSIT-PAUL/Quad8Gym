<?php
session_start();
//the isset function to check if the username is already logged in and stored in the session
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
  exit();
}
include 'dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gym System</title>
  <!-- Your existing meta tags and stylesheets -->

  <!-- Bootstrap CSS and JavaScript CDN links -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
  <!-- Your existing HTML content -->

  <!-- Add a button/link to trigger the modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open Modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Move the content you want to display in the modal here -->
          <div class='error_ex'>
            <h1>Success</h1>
            <h3>Order has been added!</h3>
            <p>The requested orders are added. Please click the button to go back.</p>
            <a class='btn btn-inverse btn-big' href='products.php'>Go Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Your existing JavaScript and closing body/html tags -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="../js/jquery.slim.min.js"></script>
  <!-- Include other scripts as needed -->
</body>

</html>
