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
    <title>Hospital | View User</title>
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container py-3" style="width: 1024px">
      <div class="row">
        <div class="col-sm-5">
        </div>
        <div class="col-sm-9">
        </div>
      </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>

    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

  </body>

</html>
