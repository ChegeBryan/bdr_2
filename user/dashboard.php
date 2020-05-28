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

    <div class="container py-3" style="width: 1024px">

      <?php
    if (isset($_GET["user"])) {
      $sql = "SELECT fullname, userid, pic, gender, health, dob FROM bdr_users WHERE id = ?";
      if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $id = trim($_GET["user"]);
        if ($stmt->execute()) {
          $result = $stmt->get_result();

          if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
          } else {
            echo "Something went wrong.";
            exit();
          }
        } else {
          header('location: ../error.php');
        }
      }
    }
    ?>
      <h4 class="text-center text-secondary">User Details</h4>
      <div class="row">
        <div class="col-sm-4">
          <img src="<?php echo $row['pic']; ?>" class="img-fluid img-thumbnail" alt="Profile Image">
        </div>
        <div class="col-sm-8">
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th>Full Name</th>
                <td><?php echo ucwords($row['fullname']); ?>
                </td>
              </tr>
              <tr>
                <th>User Identity</th>
                <td><?php echo $row['userid']; ?>
                </td>
              </tr>
              <tr>
                <th>Gender</th>
                <td><?php echo ucfirst($row['gender']); ?>
                </td>
              </tr>
              <tr>
                <th>Date of Birth</th>
                <td><?php echo $row['dob']; ?>
                </td>
              </tr>
              <tr>
                <th>Health</th>
                <td><?php echo $row['health']; ?>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

    <hr style="width: 1024px">

    <div class="container py-3" style="width: 1024px">
      <div class="row">
        <div class="col-sm-4">
          <div class="card shadow-lg rounded-lg mb-2">
            <i class="fa fa-5x fa-heartbeat text-center text-primary py-3"></i>
            <div class="card-body text-center">
              <a href="<?php echo 'view_health.php?user=' . $_GET['user'] ?>"
                 class="btn btn-primary stretched-link btn-block">View Health</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card shadow-lg rounded-lg mb-2">
            <i class="fa fa-5x fa-mortar-board text-center text-primary py-3"></i>
            <div class="card-body text-center">
              <a href="<?php echo 'view_health.php?user=' . $_GET['user'] ?>"
                 class="btn btn-primary stretched-link btn-block">View Education</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card shadow-lg rounded-lg mb-2">
            <i class="fa fa-5x fa-briefcase text-center text-primary py-3"></i>
            <div class="card-body text-center">
              <a href="#" class="btn btn-primary stretched-link btn-block">View Work Reviews</a>
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
