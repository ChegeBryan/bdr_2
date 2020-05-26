<?php

session_start();

if (isset($_SESSION["hospital_logged_In"]) || $_SESSION["hospital_logged_in"] !== true) {
  header("location: login.php");
  exit;
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation" method="POST"
              novalidate>
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
