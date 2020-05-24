<?php


session_start();

if (isset($_SESSION["admin_logged_In"]) || $_SESSION["admin_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include '../head.php' ?>
    <title>Admin - Dashboard</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-sm navbar-bg bg-secondary">


      <a class="navbar-brand text-white" href="index.php">Biodata Records</a>

      <!-- Links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="logout.php">Admin Logout</a>
        </li>
      </ul>
    </nav>

    <div class="container d-flex flex-column flex-md-row justify-content-around my-4">
      <div class="card shadow-lg rounded-lg ml-2 mb-2" style="width: 18rem;">
        <i class="fa fa-5x fa-user text-center text-secondary py-4"></i>
        <div class="card-body">
          <a href="register_user.php" class="btn btn-secondary btn-block stretched-link">Register User</a>
        </div>
      </div>
      <div class="card shadow-lg rounded-lg ml-2 mb-2" style="width: 18rem;">
        <i class="fa fa-5x fa-h-square text-center text-secondary py-4"></i>
        <div class="card-body">
          <a href="register_hosp.php" class="btn btn-secondary btn-block stretched-link">Register Hospital</a>
        </div>
      </div>
    </div>

    <div class="container d-flex flex-column flex-md-row justify-content-around ny-4">
      <div class="card shadow-lg rounded-lg ml-2 mb-2" style="width: 18rem;">
        <i class="fa fa-mortar-board fa-5x text-center text-secondary py-4"></i>
        <div class="card-body">
          <a href="#" class="btn btn-secondary btn-block stretched-link">Register School</a>
        </div>
      </div>
      <div class="card shadow-lg rounded-lg ml-2 mb-2" style="width: 18rem;">
        <i class="fa fa-suitcase fa-5x text-center text-secondary py-4"></i>
        <div class="card-body">
          <a href="#" class="btn btn-secondary btn-block stretched-link">Register Company</a>
        </div>
      </div>
    </div>


    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

  </body>

</html>
