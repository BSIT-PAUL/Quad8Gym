<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
}
include 'dbcon.php ';


?>
<!-- Visit codeastro.com for more projects -->
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
      <h2 class="mt-4 mb-4 text-center">Gym Product Check Out</h2>




      <hr>
      <div class="container mt-3">
    <ul class="nav nav-pills nav-fill mb-4">
        <li class="nav-item">
            <a class="nav-link" href="products.php">
                <i class="fas fa-shopping-cart"></i> Cart
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="checkout.php">
                <i class="fas fa-credit-card"></i> Checkout
            </a>
        </li>
    </ul>
</div>

<div class="container mt-5">
    <h2>Order Summary</h2>
    <hr>

    <?php
    // Check if items parameter is set
    if (isset($_GET['items'])) {
        // Decode the JSON string into an array
        $cartItems = json_decode(urldecode($_GET['items']), true);

        if ($cartItems) {
            echo '<ul class="list-group mb-3">';
            $totalPrice = 0;

            foreach ($cartItems as $item) {
                echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                echo '<div>';
                echo '<h6 class="my-0">' . $item['itemName'] . '</h6>';
                echo '<small class="text-muted">Quantity: ' . $item['quantity'] . '</small>';
                echo '</div>';
                echo '<span class="text-muted">Price: $' . number_format($item['price'], 2) . '</span>';
                echo '</li>';

                // Calculate item total price
                $itemTotal = $item['price'] * $item['quantity'];
                $totalPrice += $itemTotal;
            }

            echo '</ul>';

            // Display total price
            echo '<h5 class="mt-3">Total Price: $' . number_format($totalPrice, 2) . '</h5>';

            // Payment form
            echo '<form method="post" action="#">';
            echo '<div class="form-group">';
            echo '<label for="paymentType">Select Payment Type:</label>';
            echo '<select class="form-control" id="paymentType" name="paymentType">';
            echo '<option value="COD">Cash on Delivery</option>';
            echo '<option value="Gcash">Gcash</option>';
            echo '</select>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary mt-3" name="placeOrder">Place Order</button>';
            echo '</form>';
        } else {
            echo '<div class="alert alert-warning" role="alert">Invalid cart data.</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Cart data not found.</div>';
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['placeOrder'])) {
      // Insert order details into the database
      $userID = $_SESSION['user_id']; // Replace with the actual user ID
      $orderDate = date("Y-m-d H:i:s"); // Current date and time
      $paymentType = $_POST['paymentType'];
  
      foreach ($cartItems as $item) {
          $itemName = $item['itemName']; // Replace with the actual criteria
          $sql = "SELECT item_id, price FROM products WHERE item_name = '$itemName'";
          $result = $con->query($sql);
  
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $itemID = $row['item_id'];
              $itemPrice = $row['price'];
              $quantityOrdered = $item['quantity'];
              $totalPrice = $itemPrice * $quantityOrdered;
  
              // Insert order information into the orders table
              $sqlInsert = "INSERT INTO orders (userID, item_id, quantity_ordered, price, order_date, paymentType) 
                            VALUES ('$userID', '$itemID', '$quantityOrdered', '$totalPrice', '$orderDate', '$paymentType')";
  
              if ($con->query($sqlInsert) !== TRUE) {
                  echo "Error: " . $sqlInsert . "<br>" . $con->error;
              }
          } else {
              echo '<div class="alert alert-warning" role="alert">Item not found: ' . $itemName . '</div>';
          }
      }

        // Redirect to success.php using JavaScript
        echo '<script>window.location.href = "success.php";</script>';
        exit(); // Ensure that no further code is executed after the JavaScript redirection
    }
    ?>
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