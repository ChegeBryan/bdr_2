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
    <title>User | Education</title>
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container py-3" style="width: 1024px">
      <h4 class="text-center text-secondary">User Academics</h4>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
          <thead class="text-secondary">
            <tr>
              <th scope="col">Entered on</th>
              <th scope="col">School Name</th>
              <th scope="col">Level</th>
              <th scope="col">Certificate</th>
            </tr>
          </thead>
          <tbody>
            <?php
          if (isset($_GET["user"])) {
            $sql = "SELECT bdr_academics.id, entered_on, name, level, certificate
                    FROM bdr_academics
                    JOIN bdr_school
                    ON bdr_academics.school=bdr_school.id
                    WHERE bdr_academics.user= ?
                    ORDER BY bdr_academics.id DESC";

            if ($stmt = $conn->prepare($sql)) {
              $stmt->bind_param("i", $user);

              $user = $_GET["user"];

              if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_array()) {
                    echo "<tr>";
                    echo "<td>" . date_format(date_create($row['entered_on']), "d-M-Y") . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["level"] . "</td>";
                    echo "<td><a class='btn btn-info btn-sm' href='" . $row['certificate'] . "' target='_blank'>View</a></td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='4'>No School information entered yet.</td></tr>";
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
    <script src="../js/clear_form.js"></script>

  </body>

</html>
