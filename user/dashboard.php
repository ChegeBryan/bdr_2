<?php
session_start();

if (isset($_SESSION["user_logged_In"]) || $_SESSION["user_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

require_once '../includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include '../head.php'; ?>
    <title>User | Dashboard</title>
  </head>

  <body>

    <?php include 'navbar.php'; ?>

    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

  </body>

</html>
