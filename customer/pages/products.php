<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
}
include 'dbcon.php';


// Assuming you have a database connection established

// Execute the SQL query
$query = "SELECT `item_id`, `item_name`, `flavor`, `brand`, `price`, `quantity_available` FROM `products`";
$result = mysqli_query($con, $query);

// Check for errors in the query
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Fetch data and populate an array
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

// Close the database connection
mysqli_close($con);


?>
 
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gym System</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  <link rel="stylesheet" href="../css/fullcalendar.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/fullcalendar.css" />  <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="../css/fullcalendar.css" />
  <link rel="stylesheet" href="../css/matrix-style.css" />
  <link rel="stylesheet" href="../css/matrix-media.css" />
  <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/jquery.gritter.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>


  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  <style>
    body{
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

  <!-- Header -->
<div id="header">
  <img src="logoo.png" alt="Logo" height="70px" width="170px" />
  <h1><a href="index.php">Quad 8 Gym System</a></h1>
</div>

<!-- Top Header Menu -->
<?php include '../includes/topheader.php' ?>

<!-- Sidebar Menu -->
<?php
$page = "products";
include '../includes/sidebar.php';
?>
<!-- Main Container Part -->
<div id="content">
  <!-- Breadcrumbs -->
  <div id="content-header">
    <div id="breadcrumb">
      <a href="index.php" title="You're right here" class="tip-bottom">
        <i class="icon-home"></i> Home
      </a>
    </div>
  </div>

  <div class="container">
    <h2 class="mt-4 mb-4 text-center">Gym Product Order Form</h2>

    <hr>
<!-- Navigation Pills -->
<div class="container mt-3">
  <ul class="nav nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link active" href="#">
        <i class="fas fa-shopping-cart"></i> Cart
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="checkout.php">
        <i class="fas fa-credit-card"></i> Check Out
      </a>
    </li>
  </ul>
</div>

    <div class="row">
      <!-- Product Table Column -->
      <div class="col-md-8">
        <!-- Order Form -->
        <form method="post" action="" id="orderForm">
          <div class="card">
            <div class="table-responsive">
            <table class="table table-hover shopping-cart-wrap">
            <thead class="thead-light">
              <tr>
                <th scope="col">Product</th>
                <th scope="col" width="120">Quantity</th>
                <th scope="col" width="120">Price</th>
                <th scope="col" width="200" class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>
    <?php foreach ($products as $key => $product) : ?>
        <tr class="cart-item" data-item-name="<?= $product['item_name']; ?>" data-price="<?= $product['price']; ?>">
            <td>
                <div class="img-wrap">
                    <img src="<?= '../img/' .$key . '.png'; ?>" class="img-thumbnail img-sm" alt="Product Image">
                </div>
                <figure class="media">
                    <figcaption class="media-body">
                        <h6 class="title text-truncate"><?= $product['item_name']; ?></h6>
                        <dl class="param param-inline small">
                            <dt>Flavor: </dt>
                            <dd><?= $product['flavor']; ?></dd>
                        </dl>
                        <dl class="param param-inline small">
                            <dt>Brand: </dt>
                            <dd><?= $product['brand']; ?></dd>
                        </dl>
                    </figcaption>
                </figure>
            </td>
            <td>
                <input type="number" class="form-control quantity" name="quantity[<?= $product['product_id']; ?>]" value="1" min="1">
            </td>
            <td>
                <div class="price-wrap">
                    <var class="price"><?= '₱ ' . number_format($product['price'], 2); ?></var>
                    <small class="text-muted">(₱ 10 each)</small>
                </div>
            </td>
            <td class="text-right">
                <button type="button" class="btn btn-primary addToCart">
                    <i class="fas fa-cart-plus"></i> Add to Cart
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

          </table>
            </div> <!-- table-responsive.// -->
          </div> <!-- card.// -->
        </form>
      </div>

<!-- Cart Summary Column -->
<div class="col-md-4">
  <div class="card mt-3">
    <div class="card-body">
      <h5 class="card-title">Cart Summary</h5>
      <ul id="cartList" class="list-group mb-3"></ul>
      <p class="card-text">
        Total Items: <span id="totalItems">0</span><br>
        Total Price: <span id="totalPrice">0.00</span>
      </p>
      <button type="button" class="btn btn-primary btn-block" id="proceedToCheckout">Proceed to Checkout</button>
    </div>
  </div>
</div>

    </div>
  </div>
</div>


    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function () {
    // Event handler for "Add to Cart" button
    $(".addToCart").on("click", function () {
      // Get product information from the clicked row
      var $tr = $(this).closest("tr");
      var itemName = $tr.data("item-name");
      var price = parseFloat($tr.data("price"));
      var quantity = parseInt($tr.find(".quantity").val());

      // Update cart summary
      updateCart(itemName, price, quantity);
    });

    // Function to update the cart summary
    function updateCart(itemName, price, quantity) {
      // Check if the item already exists in the cart
      var $existingItem = $("#cartList").find("li[data-item-name='" + itemName + "']");

      if ($existingItem.length > 0) {
        // Update the quantity of the existing item
        var existingQuantity = parseInt($existingItem.data("quantity"));
        var newQuantity = existingQuantity + quantity;
        $existingItem.data("quantity", newQuantity);
        $existingItem.html("Product: " + itemName + ", Quantity: " + newQuantity);
      } else {
        // Add a new entry to the cart
        $("#cartList").append("<li data-item-name='" + itemName + "' data-quantity='" + quantity + "'>Product: " + itemName + ", Quantity: " + quantity + "</li>");
      }

      // Update total items and price
      var totalItems = calculateTotalItems();
      var totalPrice = calculateTotalPrice();

      $("#totalItems").text(totalItems);
      $("#totalPrice").text(isNaN(totalPrice) ? "₱ 0.00" : "₱ " + totalPrice.toFixed(2));
    }

    // Function to calculate total items in the cart
    function calculateTotalItems() {
      var totalItems = 0;
      $("#cartList li").each(function () {
        totalItems += parseInt($(this).data("quantity"));
      });
      return totalItems;
    }

    // Function to calculate total price of items in the cart
    function calculateTotalPrice() {
      var totalPrice = 0;
      $("#cartList li").each(function () {
        var itemName = $(this).data("item-name");
        var itemPrice = parseFloat($("[data-item-name='" + itemName + "']").data("price"));

        // Check if itemPrice is a valid number
        if (!isNaN(itemPrice)) {
          var quantity = parseInt($(this).data("quantity"));
          totalPrice += itemPrice * quantity;
        }
      });
      return totalPrice;
    }

  // Event handler for "Proceed to Checkout" button
$("#proceedToCheckout").on("click", function () {
    // Get cart data
    var cartItems = [];

    $("#cartList li").each(function () {
        var itemName = $(this).data("item-name");
        var quantity = $(this).data("quantity");
        
        // Set a fixed price (replace this with your actual price logic)
        var price = 10.00;

        cartItems.push({ itemName: itemName, quantity: quantity, price: price });
    });

    // Redirect to checkout PHP page with cart data
    var checkoutUrl = "checkout.php?items=" + encodeURIComponent(JSON.stringify(cartItems));
    window.location.href = checkoutUrl;
});
  });
</script>








      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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