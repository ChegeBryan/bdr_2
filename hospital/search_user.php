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
    <title>Hospital | Search User</title>
  </head>

  <body>
    <?php include 'navbar.php'; ?>


    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

  </body>

</html>
