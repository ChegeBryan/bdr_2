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
    <title>User | Health</title>
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container py-3" style="width: 1024px">
      <h4 class="text-center text-secondary">User Health History</h4>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
          <thead class="text-secondary">
            <tr>
              <th scope="col">Entered on</th>
              <th scope="col">Hospital Visited</th>
              <th scope="col">Diagnosis</th>
              <th scope="col">Medication</th>
              <th scope="col">Healed</th>
            </tr>
          </thead>
          <tbody>
            <?php
          if (isset($_GET["user"])) {
            $sql = "SELECT bdr_health_information.id, entered_on, name, diagnosis, medication, healed
                    FROM bdr_health_information
                    JOIN bdr_hospital
                    ON bdr_health_information.hospital=bdr_hospital.id
                    WHERE bdr_health_information.user= ?
                    ORDER BY bdr_health_information.id DESC";

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
                    echo "<td>" . $row["diagnosis"] . "</td>";
                    echo "<td>" . $row['medication'] . "</td>";
                    echo "<td>" . ($row['healed'] == 0 ? "No" : "Yes") . "</td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='5'>No health information entered yet.</td></tr>";
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
