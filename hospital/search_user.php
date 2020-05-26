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


    <div class="container py-3" style="width: 1024px">
      <div class="row">
        <div class="col-sm-4">
          <form>
            <label for="User_reg">User Registration number</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
              </div>
              <input type="text" class="form-control" id="user_reg" name="user_reg" placeholder="Registration number">
            </div>
          </form>
          <p class="text-muted">Enter user registration to search for the user in the users directory.</p>
        </div>
        <div class="col-sm-8">

        </div>
      </div>
    </div>



    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

  </body>

</html>
