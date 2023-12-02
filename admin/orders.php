<?php
session_start();
include "dbcon.php";

//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<title>Gym System Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/fullcalendar.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
<img src="logoo.png" alt="Logo" height="70px" width="170px"/>
  <h1><a href="dashboard.html">Quad 8 Gym</a></h1>
</div>
<!--close-Header-part-->  


<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search">
  <input type="hidden" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch-->

<!--sidebar-menu-->
  
<?php $page='list-orders'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="orders.php" class="current">Order List</a> </div>
    <h1 class="text-center">Gym's Orders <i class="fas fa-cogs"></i></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
<!-- Filter Form -->
<div class="row-fluid">
  <div class="span12">
  <form method="post" action="">
  <div class="form-group">
    <label for="statusFilter">Filter by Status:</label>
    <select class="form-control" name="statusFilter" id="statusFilter">
      <option value="">All</option>
      <option value="Pick-up">Pick-up</option>
      <option value="Pending">Pending</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Apply Filter</button>
</form>

  </div>
</div>

      <div class='widget-box'>
    <div class='widget-title'>
        <span class='icon'>
            <i class='fas fa-cogs'></i>
        </span>
        
        <h5>Orders table</h5>
    </div>

    <div class='widget-content nopadding'>
    <?php
    
    // Check if the form is submitted and filter value is set
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['statusFilter'])) {
      $statusFilter = $_POST['statusFilter'];
      $statusFilterCondition = ($statusFilter != "") ? " AND o.`status` = '$statusFilter'" : "";
    } else {
      $statusFilterCondition = "";
    }
  
    $qry = "SELECT m.`fullname` AS `customer_name`, o.`order_id`, p.`item_name`, 
            SUM(o.`quantity_ordered`) AS `total_quantity_ordered`, 
            SUM(o.`Price`) AS `total_price`, MAX(o.`order_date`) AS `latest_order_date`, 
            o.`paymentType`, o.`status`, o.`referencenum`, o.`proofImg`
            FROM `orders` o 
            JOIN `members` m ON o.`userID` = m.`user_id` 
            JOIN `products` p ON o.`item_id` = p.`item_id` 
            WHERE 1 $statusFilterCondition
            GROUP BY m.`fullname`, o.`order_id`, p.`item_name`, o.`paymentType`, o.`status`";
    $cnt = 1;
    $result = mysqli_query($conn, $qry);
  
    if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));
    }
  
    echo "<table class='table table-bordered table-hover'>
          <thead>
            <tr>
              <th>#</th>
              <th>Customer Name</th>
              <th>Order ID</th>
              <th>Product Name</th>
              <th>Quantity Ordered</th>
              <th>Total Price</th>
              <th>Payment Type</th>
              <th>Status</th>
              <th>Reference Number</th>
              <th>Proof</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>";
  
    while ($row = mysqli_fetch_array($result)) {
      // Retrieve and sanitize the image source URL
      $imageSrc = htmlspecialchars($row['proofImg']);
  
      echo "<tr>
          <td><div class='text-center'>" . $cnt . "</div></td>
          <td><div class='text-center'>" . $row['customer_name'] . "</div></td>
          <td><div class='text-center'>" . $row['order_id'] . "</div></td>
          <td><div class='text-center'>" . $row['item_name'] . "</div></td>
          <td><div class='text-center'>" . $row['total_quantity_ordered'] . "</div></td>
          <td><div class='text-center'>₱" . $row['total_price'] . "</div></td>
          <td><div class='text-center'>" . $row['paymentType'] . "</div></td>
          <td><div class='text-center'>" . $row['status'] . "</div></td>
          <td><div class='text-center'>" . $row['referencenum'] . "</div></td>
          <td><div class='text-center'>". $imageSrc ."</div></td>
  
          <td>
            <div class='text-center'>
              <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#viewImageModal" . $row['order_id'] . "'>View Image</button>
              <!-- Modal -->
              <div class='modal fade' id='viewImageModal" . $row['order_id'] . "' tabindex='-1' role='dialog' aria-labelledby='viewImageModalLabel" . $row['order_id'] . "' aria-hidden='true'>
                  <div class='modal-dialog modal-lg' role='document'>
                      <div class='modal-content'>
                          <div class='modal-header'>
                              <h5 class='modal-title' id='viewImageModalLabel" . $row['order_id'] . "'>Proof Image</h5>
                              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                              </button>
                          </div>
                          <div class='modal-body'>
                          <img src='" . $imageSrc . "' alt='Proof Image' style='max-width: 100%;'>
                          </div>
                      </div>
                  </div>
              </div>
              
            </div>
          </td>
          <td><div class='text-center'><a href='actions/update-order.php?id=" . $row['order_id'] . "' style='color: green;'><i class='fas fa-check'></i> Pick-up</a></div></td>
      </tr>";
      $cnt++;
    }
  
    echo "</tbody></table>";
  ?>
  


 
    </div>
</div>

   
		
	
      </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->

  

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
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
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
