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
    <title>User | Work</title>
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container py-3" style="width: 1024px">
      <h4 class="text-center text-secondary">User Work Remarks</h4>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
          <thead class="text-secondary">
            <tr>
              <th scope="col">Entered on</th>
              <th scope="col">Company</th>
              <th scope="col">Position</th>
              <th scope="col">Remarks</th>
              <th scope="col">Started on</th>
              <th scope="col">Ended on</th>
            </tr>
          </thead>
          <tbody>
            <?php
          if (isset($_GET["user"])) {
            $sql = "SELECT entered_on, name, position, remarks, start_date, end_date
                    FROM bdr_work_information
                    JOIN bdr_company
                    ON bdr_work_information.company=bdr_company.id
                    WHERE bdr_work_information.user= ?
                    ORDER BY bdr_work_information.id DESC";

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
                    echo "<td>" . $row["position"] . "</td>";
                    echo "<td>" . $row['remarks'] . "</td>";
                    echo "<td>" . date_format(date_create($row['start_date']), "d-M-Y") . "</td>";
                    echo "<td>" . date_format(date_create($row['end_date']), "d-M-Y") . "</td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='6'>No Work information entered yet.</td></tr>";
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

    <script src="../assets/js/jquery.min.js">
    </script>

    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

  </body>

</html>
