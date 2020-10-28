<?php
session_start();

if (isset($_SESSION["school_logged_In"]) || $_SESSION["school_logged_in"] !== true) {
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include '../head.php'; ?>
    <title>School | Dashboard</title>
  </head>

  <body>

    <?php include 'navbar.php'; ?>

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
              <p class="card-text">Upload academic certificate</p>
              <a href="<?php echo 'search_user.php?school=' . $_SESSION['sch_id'] ?>"
                 class="btn btn-primary stretched-link btn-block">User Directory</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card shadow-lg rounded-lg mb-2">
            <i class="fa fa-5x fa-mortar-board text-center text-primary py-4"></i>
            <div class="card-body text-center">
              <h4 class="card-title">School Directory</h4>
              <h6 class="card-subtitle mb-2 text-muted font-weight-bold">Visit page to:</h6>
              <p class="card-text">View registered users who have recorded their academic information with the school
                before.</p>
              <p class="card-text">View user details</p>
              <a href="<?php echo 'view_users.php?school=' . $_SESSION['sch_id'] ?>"
                 class="btn btn-primary stretched-link btn-block">View Users</a>
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
