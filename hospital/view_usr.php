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
