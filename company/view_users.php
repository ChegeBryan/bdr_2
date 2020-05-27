<?php
session_start();

if (isset($_SESSION["company_logged_In"]) || $_SESSION["company_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

require_once '../includes/config.php';

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include '../head.php'; ?>
    <title>Company | View Users</title>
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container py-3" style="width: 1024px">
      <h4 class="text-secondary text-capitalize text-center">Users worked in this company</h4>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
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
          if (isset($_GET["company"])) {
            $sql = "SELECT DISTINCT fullname, gender, pic, userid, user
                    FROM bdr_work_information
                    JOIN bdr_users
                    ON bdr_work_information.user = bdr_users.id
                    WHERE bdr_work_information.company = ?";

            if ($stmt = $conn->prepare($sql)) {
              $stmt->bind_param("i", $comp);

              $comp = $_GET["company"];

              if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_array()) {
                    echo "<tr>";
                    echo "<td>" . $row["userid"] . "</td>";
                    echo "<td><img src='" . $row["pic"] . "' class='img-fluid' height='50px' width='50px'></td>";
                    echo "<td>" . $row['fullname'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td><a href='view_usr.php?company=" . $_GET['company'] . "&user=" . $row['user'] . "' class='btn btn-info btn-sm'>View</a></td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='5'>No work information entered yet.</td></tr>";
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
