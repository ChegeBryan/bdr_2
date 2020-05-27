<?php
session_start();

if (isset($_SESSION["school_logged_In"]) || $_SESSION["school_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

require_once '../includes/config.php';

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include '../head.php'; ?>
    <title>School | View Users</title>
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container py-3" style="width: 1024px">
      <h4 class="text-secondary text-capitalize text-center">Users graduated from this school</h4>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
          <thead class="text-secondary">
            <tr>
              <th scope="col">Reg. No.</th>
              <th scope="col">User Image</th>
              <th scope="col">Full Name</th>
              <th scope="col">Gender</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
          if (isset($_GET["school"])) {
            $sql = "SELECT DISTINCT fullname, gender, pic, userid, user
                    FROM bdr_academics
                    JOIN bdr_users
                    ON bdr_academics.user = bdr_users.id
                    WHERE bdr_academics.school = ?";

            if ($stmt = $conn->prepare($sql)) {
              $stmt->bind_param("i", $sch);

              $sch = $_GET["school"];

              if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_array()) {
                    echo "<tr>";
                    echo "<td>" . $row["userid"] . "</td>";
                    echo "<td><img src='" . $row["pic"] . "' class='img-fluid' height='50px' width='50px'></td>";
                    echo "<td>" . $row['fullname'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td><a href='view_usr.php?school=" . $_GET['school'] . "&user=" . $row['user'] . "' class='btn btn-info btn-sm'>View</a></td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='5'>No users entered yet.</td></tr>";
                }
              }
              $stmt->close();
            }
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>

    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

  </body>

</html>
