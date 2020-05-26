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
      <h4 class="text-center">User Details</h4>
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
          <a href="<?php echo 'add_health_info.php?hospital=' . $_GET['hospital'] . '&user=' . $_GET['user'] ?>"
             class="btn btn-info">Add
            health information</a>
        </div>
      </div>
    </div>

    <div class="container" style="width: 1024px">
      <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
          <thead class="text-secondary">
            <tr>
              <th scope="col">Entered on</th>
              <th scope="col">Hospital Visited</th>
              <th scope="col">Diagnosis</th>
              <th scope="col">Medication</th>
              <th scope="col">Healed</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
          $sql = "SELECT entered_on, name, diagnosis, medication, healed
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
