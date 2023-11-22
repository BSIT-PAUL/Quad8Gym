<?php
session_start();
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
  
<?php $page='remove-equip'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->
<!-- Add this script to the head of your HTML document -->
<script>
   document.addEventListener('DOMContentLoaded', function () {
    // JavaScript code to handle deletion confirmation
    document.querySelectorAll('[id^=confirmDeleteLink]').forEach(function (link) {
        link.addEventListener('click', function () {
            // Get the data-id attribute from the link that triggered the modal
            var id = link.getAttribute('data-id');

            // Use AJAX to send a request to delete-equipment.php
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'actions/delete-equipment.php?id=' + id, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        window.location.href = 'remove-equipment.php';
                    } else {
                        alert('Error deleting equipment: ' + response.message);
                    }
                } else {
                    alert('Request failed. Please try again later.');
                }
            };

            xhr.send();
        });
    });
});
</script>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="remove-equipment.php" class="current">Remove Equipment</a> </div>
    <h1 class="text-center">Remove Gym's Equipment <i class="fas fa-cogs"></i></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-cogs'></i> </span>
            <h5>Equipment table</h5>
          </div>
          <div class='widget-content nopadding'>
	  
	  <?php

      include "dbcon.php";
      $qry="select * from equipment";
      $cnt = 1;
        $result=mysqli_query($conn,$qry);

        
          echo"<table class='table table-bordered table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Equipment</th>
                  <th>Description</th>
                  <th>Qty</th>
                  <th>Amount</th>
                  <th>Vendor</th>
                  <th>Contact</th>
                  <th>Purchased Date</th>
                  <th>Action</th>
                </tr>
              </thead>";
              
            while($row=mysqli_fetch_array($result)){
            
            echo"<tbody> 
               
                <td><div class='text-center'>".$cnt."</div></td>
                <td><div class='text-center'>".$row['name']."</div></td>
                <td><div class='text-center'>".$row['description']."</div></td>
                <td><div class='text-center'>".$row['quantity']."</div></td>
                <td><div class='text-center'>₱".$row['amount']."</div></td>
                <td><div class='text-center'>".$row['vendor']."</div></td>
                <td><div class='text-center'>".$row['contact']."</div></td>
                <td><div class='text-center'>".$row['date']."</div></td>
                <td>
                <div class='text-center'>
                    <!-- Add the data-id attribute to the link -->
                    <a href='#' style='color:#F66;' data-toggle='modal' data-target='#deleteModal" . $row['id'] . "' data-id='".$row['id']."'>
                        <i class='fas fa-trash'></i> Remove
                    </a>
                </div>
            
                <!-- Delete Modal -->
                <div class='modal fade' id='deleteModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'>Confirmation</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                Are you sure you want to delete this equipment?
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                                <button type='button' class='btn btn-danger' id='confirmDeleteLink" . $row['id'] . "' data-id='" . $row['id'] . "'>
                                <i class='fas fa-trash'></i> Remove
                            </button>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    </a>
                </div>
            </td>
            

            
                  
              </tbody>";
          $cnt++;  }
            ?>

            </table>
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
