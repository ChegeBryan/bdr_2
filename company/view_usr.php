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
    <title>Company | View User</title>
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container py-3" style="width: 1024px">

      <?php
    if (isset($_GET["user"])) {
      $sql = "SELECT fullname, userid, pic, gender, dob FROM bdr_users WHERE id = ?";
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
            </table>
          </div>
          <a href="<?php echo 'add_work_info.php?company=' . $_GET['company'] . '&user=' . $_GET['user'] ?>"
             class="btn btn-info">Add work information</a>
          <a href="#" class="btn btn-info">View Academics</a>
        </div>
      </div>
    </div>

    <div class="container" style="width: 1024px">
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
    <script src="../js/clear_form.js"></script>

  </body>

</html>
