<?php
session_start();

if (isset($_SESSION["hospital_logged_In"]) || $_SESSION["hospital_logged_in"] !== true) {
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include '../head.php'; ?>
    <title>Hospital | Dashboard</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-sm navbar-bg bg-secondary">
      <a class="navbar-brand text-white" href="../index.php">Biodata Records</a>


      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon text-white"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Search User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">View users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container py-3" style="width: 1024px">
      <div class="row">
        <div class="col-sm-6">
          <div class="card shadow-lg rounded-lg mb-2">
            <i class="fa fa-5x fa fa-search text-center text-primary py-4"></i>
            <div class="card-body text-center">
              <h4 class="card-title">User Directory</h4>
              <h6 class="card-subtitle mb-2 text-muted font-weight-bold">Visit page to:</h6>
              <p class="card-text">Search user using their registration number</p>
              <p class="card-text">View user details</p>
              <p class="card-text">Add user health</p>
              <p class="card-text">Update user health</p>
              <a href="#" class="btn btn-primary stretched-link btn-block">User Directory</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card shadow-lg rounded-lg mb-2">
            <i class="fa fa-5x fa fa-user-md text-center text-primary py-4"></i>
            <div class="card-body text-center">
              <h4 class="card-title">Hospital Directory</h4>
              <h6 class="card-subtitle mb-2 text-muted font-weight-bold">Visit page to:</h6>
              <p class="card-text">View users registered who have had their health information registered with the
                hospital before.</p>
              <p class="card-text">View user details</p>
              <a href="#" class="btn btn-primary stretched-link btn-block">View Users</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

  </body>

</html>
