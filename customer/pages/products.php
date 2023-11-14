<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
}
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

  <style>


.container {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #007bff;
    }

    form {
      max-width: 400px;
      margin: auto;
    }

    button {
      width: 100%;
    }

    #cartItems {
      padding-top: 20px;
    }

    .card {
      margin-bottom: 10px;
    }

    .list-group-item {
      background-color: #f8f9fa;
      border: none;
    }

    #checkoutSummary {
      margin-top: 20px;
      border-top: 1px solid #ddd;
      padding-top: 10px;
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
    <!--breadcrumbs-->
    <div id="content-header">
      
      <div id="breadcrumb"> <a href="index.php" title="You're right here" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
      <div class="container">
    <h2 class="mt-4 mb-4 text-center">Gym Product Order Form</h2>

    <form id="orderForm">
      <div class="mb-3">
        <label for="productSelect" class="form-label">Select Product:</label>
        <select class="form-select" id="productSelect" required>
          <option value="" disabled selected>Select a product</option>
          <option value="juice">Juice</option>
          <option value="bar">Protein Bar</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="quantityInput" class="form-label">Quantity:</label>
        <input type="number" class="form-control" id="quantityInput" placeholder="Enter quantity" required>
      </div>

      <button type="button" class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
    </form>

    <hr class="mt-4 mb-4">

    <h3 class="text-center">Shopping Cart</h3>
    <div id="cartItems">
      <!-- Cart items will be displayed here -->
    </div>

    <button type="button" class="btn btn-success mt-4" onclick="checkout()">Checkout</button>

    <div id="checkoutSummary" class="text-center">
      <h4>Order Summary</h4>
      <ul id="summaryList" class="list-group">
        <!-- Summary items will be displayed here -->
      </ul>
      <p id="totalAmount" class="mt-3">Total: $0.00</p>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

  <script>
    function addToCart() {
      var productSelect = document.getElementById('productSelect');
      var quantityInput = document.getElementById('quantityInput');

      var product = productSelect.value;
      var quantity = quantityInput.value;

      if (product && quantity > 0) {
        var cartItems = document.getElementById('cartItems');
        var checkoutSummary = document.getElementById('checkoutSummary');
        var summaryList = document.getElementById('summaryList');
        var totalAmount = document.getElementById('totalAmount');

        var card = document.createElement('div');
        card.className = 'card';

        var cardBody = document.createElement('div');
        cardBody.className = 'card-body';

        var cardText = document.createElement('p');
        cardText.className = 'card-text';
        cardText.textContent = product + ' x ' + quantity;

        cardBody.appendChild(cardText);
        card.appendChild(cardBody);

        cartItems.appendChild(card);

        // Update the checkout summary
        var summaryItem = document.createElement('li');
        summaryItem.className = 'list-group-item';
        summaryItem.textContent = product + ' x ' + quantity;
        summaryList.appendChild(summaryItem);

        // Update the total amount
        var currentTotal = parseFloat(totalAmount.textContent.replace('Total: $', ''));
        var itemTotal = getPriceForProduct(product) * quantity;
        var newTotal = currentTotal + itemTotal;
        totalAmount.textContent = 'Total: $' + newTotal.toFixed(2);

        // Clear the form inputs
        productSelect.value = '';
        quantityInput.value = '';
      } else {
        alert('Please select a product and enter a valid quantity.');
      }
    }

    function checkout() {
      var cartItems = document.getElementById('cartItems');
      cartItems.innerHTML = '<p class="text-muted">Cart is empty. Ready for checkout!</p>';

      // Clear the checkout summary
      var summaryList = document.getElementById('summaryList');
      var totalAmount = document.getElementById('totalAmount');
      summaryList.innerHTML = '';
      totalAmount.textContent = 'Total: $0.00';
    }

    function getPriceForProduct(product) {
      // Add logic to retrieve the price for each product
      // For simplicity, we'll return a default value
      switch (product) {
        case 'juice':
          return 2.50;
        case 'bar':
          return 1.75;
        default:
          return 0.00;
      }
    }
  </script>
      <style>
        #footer {
          color: white;
        }
      </style>
    
  </div>
  <!--end-Footer-part-->

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

  <script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage(newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

        // if url is "-", it is this page -- reset the menu:
        if (newURL == "-") {
          resetMenu();
        }
        // else, send page to designated URL            
        else {
          document.location.href = newURL;
        }
      }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
      document.gomenu.selector.selectedIndex = 2;
    }
  </script>
</body>

</html>