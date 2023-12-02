<?php
session_start();
//the isset function to check username is already logged in and stored on the session
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
}
include 'dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gym System</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  <link rel="stylesheet" href="../css/fullcalendar.css" />
  <link rel="stylesheet" href="../css/matrix-style.css" />
  <link rel="stylesheet" href="../css/matrix-media.css" />
  <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/jquery.gritter.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <style>
    body {
      background-color: rgb(46,54,63);
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
  <form method="post" action="" id="paymentForm" enctype="multipart/form-data">
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
              echo '<form method="post" action="#" id="paymentForm" enctype="multipart/form-data">              ';
              echo '<div class="form-group">';
              echo '<label for="paymentType">Select Payment Type:</label>';
              echo '<select class="form-control" id="paymentType" name="paymentType" onchange="showElements()">';
              echo '<option value="" selected disabled>Select Payment Method</option>';
              echo '<option value="COP">Cash on Pick-Up</option>';
              echo '<option value="Gcash">Gcash</option>';
              echo '</select>';

              // Place Order button
              echo '<button type="submit" class="btn btn-primary mt-3" name="placeOrder" style="display:none;">Place Order</button>';
// Modal for Gcash payment
echo '<div class="modal fade" id="gcashModal" tabindex="-1" role="dialog" aria-labelledby="gcashModalLabel" aria-hidden="true">';
echo '<div class="modal-dialog modal-dialog-centered" role="document">';
echo '<div class="modal-content">';
echo '<div class="modal-header">';
echo '<h5 class="modal-title" id="gcashModalLabel">Gcash Payment</h5>';
echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
echo '<span aria-hidden="true">&times;</span>';
echo '</button>';
echo '</div>';
echo '<div class="modal-body">';
echo '<img src="396680408_318648987698182_9135085152081392236_n.jpg" alt="" height="200px">';echo '<div class="form-group">';
echo '<label for="imageUpload">Upload Image:</label>';
echo '<input type="file" class="form-control-file" id="imageUpload" name="imageUpload">';
echo '</div>';
// Display the uploaded image
echo '<img id="previewImage" src="#" alt="" height="200px" style="display:none;">';
echo '<div class="form-group mt-3">';
echo '<label for="referenceNumber">Reference Number:</label>';
echo '<input type="text" class="form-control" id="referenceNumber" name="referenceNumber">';
echo '</div>';
echo '</div>';
echo '<div class="modal-footer">';
echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
echo '<button type="submit" class="btn btn-primary" name="placeOrder">Place Order</button>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';


              // Script to automatically show the Gcash modal and Place Order button
              echo '<script>';
              echo 'function showElements() {';
              echo '  var paymentType = document.getElementById("paymentType").value;';
              echo '  var placeOrderBtn = document.querySelector("[name=\'placeOrder\']");';
              echo '  if (paymentType === "Gcash") {';
              echo '    $("#gcashModal").modal("show");';
              echo '    placeOrderBtn.style.display = "none";';
              echo '  } else if (paymentType === "COP") {';
              echo '    $("#gcashModal").modal("hide");';
              echo '    placeOrderBtn.style.display = "block";';
              echo '  } else {';
              echo '    $("#gcashModal").modal("hide");';
              echo '    placeOrderBtn.style.display = "none";';
              echo '  }';
              echo '}';
              echo 'document.getElementById("paymentType").addEventListener("change", showElements);';
              echo '</script>';

              echo '</form>';
            } else {
              echo '<div class="alert alert-warning" role="alert">Invalid cart data.</div>';
            }
          } else {
            echo '<div class="alert alert-warning" role="alert">Cart data not found.</div>';
          }
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['placeOrder'])) {
  // Insert order details into the database
  $userID = $_SESSION['user_id']; // Replace with the actual user ID
  $orderDate = date("Y-m-d H:i:s"); // Current date and time
  $paymentType = $_POST['paymentType'];
  $referenceNumber = $_POST['referenceNumber'];

  // Handle file upload
// Handle file upload
$imageUpload = ""; // Placeholder for the image file name

if ($_FILES['imageUpload']['error'] == 0) {
  $imageFileName = $_FILES['imageUpload']['name'];
    $imageTmpName = $_FILES['imageUpload']['tmp_name'];
    $imageUpload = "uploads/" . $imageFileName; // Specify the directory where you want to store uploaded images
    move_uploaded_file($imageTmpName, $imageUpload);
}
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
          $sqlInsert = "INSERT INTO orders (userID, item_id, quantity_ordered, price, order_date, paymentType, referencenum, proofImg) 
                        VALUES ('$userID', '$itemID', '$quantityOrdered', '$totalPrice', '$orderDate', '$paymentType', '$referenceNumber', '$imageUpload')";

if ($con->query($sqlInsert) !== TRUE) {
  echo "Error: " . $sqlInsert . "<br>" . $con->error;
} else {
  // Order inserted successfully, show a modal
  echo '<script>
          // Add your modal display logic here
          alert("Order placed successfully!");
                        window.location.href = "products.php"; // Redirect to products.php
       </script>';
}
  }
  
  // Redirect to success.php using JavaScript

  exit(); // Ensure that no further code is executed after the JavaScript redirection
}}

          ?>
        </div>
      </div>
    </form>

    <script src="../js/excanvas.min.js"></script>
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

    <script>
      // Your custom scripts here
    </script>
  </body>

  </html>
