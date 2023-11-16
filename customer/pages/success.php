<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
}
include 'dbcon.php ';


?>
 
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gym System</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="../css/fullcalendar.css" />
  <link rel="stylesheet" href="../css/matrix-style.css" />
  <link rel="stylesheet" href="../css/matrix-media.css" />
  <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/jquery.gritter.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  <style>
    body{
      background-color: #1F262D;
    }
    h2 {
      color: #007bff;
    }

    .param {
      margin-bottom: 7px;
      line-height: 1.4;
    }

    .param-inline dt {
      display: inline-block;
    }

    .param dt {
      margin: 0;
      margin-right: 7px;
      font-weight: 600;
    }

    .param-inline dd {
      vertical-align: baseline;
      display: inline-block;
    }

    .param dd {
      margin: 0;
      vertical-align: baseline;
    }

    .shopping-cart-wrap .price {
      color: #007bff;
      font-size: 18px;
      font-weight: bold;
      margin-right: 5px;
      display: block;
    }

    var {
      font-style: normal;
    }

    .media img {
      margin-right: 1rem;
    }

    .img-sm {
      width: 90px;
      max-height: 75px;
      object-fit: cover;
    }
    .container-custom {
            margin-top: 4rem;
        }

        .success-icon {
            color: #28a745;
            font-size: 3rem;
        }
  </style>
</head>

<body>

  <!--Header-part-->
  <div id="header">
    <img src="logoo.png" alt="Logo" height="70px" width="170px" />
    <h1><a href="index.php">Quad 8 Gym System</a></h1>
  </div>
  <!--close-Header-part-->


  <!--top-Header-menu-->
  <?php include '../includes/topheader.php' ?>
  <!--close-top-Header-menu-->
  <!--sidebar-menu-->
  <?php $page = "products";
  include '../includes/sidebar.php' ?>

  <!--sidebar-menu-->

  <!--main-container-part-->
  <div id="content">
  <form method="post" action="#">
    <!--breadcrumbs-->
    <div id="content-header">

      <div id="breadcrumb"> <a href="index.php" title="You're right here" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <div class="container">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Gym Product Check Out</h2>
                <hr>
                <div class="container mt-5">
                <h1 class="success-icon">&#10003; Order Placed Successfully</h1>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="../js/excanvas.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.ui.custom.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.flot.min.js"></script>
    <script src="../js/jquery.flot.resize.min.js"></script>
    <script src="../js/jquery.peity.min.js"></script>
    <script src="../js/fullcalendar.min.js"></script>
    <script src="../js/matrix.js"></script>
    <script src="../js/matrix.dashboard.js"></script>
    <script src="../js/jquery.gritter.min.js"></script>
    <script src="../js/matrix.interface.js"></script>
    <script src="../js/matrix.chat.js"></script>
    <script src="../js/jquery.validate.js"></script>
    <script src="../js/matrix.form_validation.js"></script>
    <script src="../js/jquery.wizard.js"></script>
    <script src="../js/jquery.uniform.js"></script>
    <script src="../js/select2.min.js"></script>
    <script src="../js/matrix.popover.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/matrix.tables.js"></script>

</body>

</html>