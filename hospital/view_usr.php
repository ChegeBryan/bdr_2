<?php
session_start();

if (isset($_SESSION["hospital_logged_In"]) || $_SESSION["hospital_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

require_once '../includes/config.php';

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
        <?php
      if (isset($_GET["user"])) {
        $sql = "SELECT fullname, userid, health, pic, gender, dob FROM bdr_users WHERE id = ?";
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
        <div class="col-sm-12">
          <h4 class="text-center">User Details</h4>
          <div class="media">
            <img src="<?php echo $row['pic']; ?>" class="align-self-center mr-3 img-thumbnail" alt="Profile Image">
            <div class="media-body">
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
      </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>

    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

  </body>

</html>
