<?php

session_start();

if (isset($_SESSION["hospital_logged_In"]) || $_SESSION["hospital_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

require_once '../includes/config.php';
?>

<!DOCTYPE html>
<html>

  <head>
    <?php include '../head.php'; ?>
    <title>Hospital | Update Health Details</title>

  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container d-flex justify-content-center mt-5">
      <div class="card p-4 shadow-lg rounded-lg" style="width: 400px;">
        <h4>Update health Details</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?hospital=' . $_GET['hospital'] . '&user=' . $_GET['user'] . '$record=' . $_GET['record']; ?>"
              class="needs-validation" method="POST" novalidate>
          <div class="form-group">
            <label for="diagnosis" class="text-secondary font-weight-bold">Patient Diagnosis</label>
            <textarea rows="3" class="form-control overflow-hidden" id="diagnosis" placeholder="Patient Diagnosis"
                      name="diagnosis" value="" style="resize: none" required></textarea>
          </div>
          <div class="form-group">
            <label for="medication" class="text-secondary font-weight-bold">Medication Prescribed</label>
            <textarea rows="3" class="form-control overflow-hidden" id="medication" placeholder="Doctor's Prescription"
                      name="medication" value="" style="resize: none" required></textarea>
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
