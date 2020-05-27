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
    <title>School | Search User</title>
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
          <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
              <thead class="text-secondary">
                <tr>
                  <th scope="col">Reg. No.</th>
                  <th scope="col">User Image</th>
                  <th scope="col">Full Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody id="results">
                <tr>
                  <td colspan='5' class='text-info'>Type into the search field to look for user.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>

    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <script src="../js/find_usr.js"></script>
  </body>

</html>
