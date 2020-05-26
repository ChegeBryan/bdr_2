<?php

session_start();

if (isset($_SESSION["hospital_logged_In"]) || $_SESSION["hospital_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

require_once '../includes/config.php';

$diagnosis = $diagnosis = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_GET['hospital']) && isset($_GET['user'])) {
    $sql = "INSERT INTO bdr_health_information (hospital, user, diagnosis, medication) VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("iiss", $hospital, $user, $diagnosis, $medication);

      $hospital = $_GET['hospital'];
      $user = $_GET['user'];
      $diagnosis = trim($_POST['diagnosis']);
      $medication = trim($_POST['medication']);

      if ($stmt->execute()) {
        header("location: view_usr.php?hospital=" . $_GET['hospital'] . "&user=" . $_GET['user']);
      } else {
        header("location: ../error.php");
      }
      $stmt->close();
    }
  } else {
    header("location: ../error.php");
  }
}
?>

<!DOCTYPE html>
<html>

  <head>
    <?php include '../head.php'; ?>
    <title>Hospital | Add Health Details</title>

  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container d-flex justify-content-center mt-5">
      <div class="card p-4 shadow-lg rounded-lg" style="width: 400px;">
        <h4>Add health Details</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?hospital=' . $_GET['hospital'] . '&user=' . $_GET['user']; ?>"
              class="needs-validation" method="POST" novalidate>
          <div class="form-group">
            <label for="diagnosis" class="text-secondary font-weight-bold">Patient Diagnosis</label>
            <textarea rows="3" class="form-control overflow-hidden" id="diagnosis" placeholder="Patient Diagnosis"
                      name="diagnosis" value="<?php echo $diagnosis; ?>" style="resize: none" required></textarea>
          </div>
          <div class="form-group">
            <label for="medication" class="text-secondary font-weight-bold">Medication Prescribed</label>
            <textarea rows="3" class="form-control overflow-hidden" id="medication" placeholder="Doctor's Prescription"
                      name="medication" value="<?php echo $medication; ?>" style="resize: none" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
    </div>


    <script src="../assets/js/jquery.min.js"></script>

    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <script src="../js/form_validation.js"></script>
    <script src="../js/clear_form.js"></script>
  </body>

</html>
