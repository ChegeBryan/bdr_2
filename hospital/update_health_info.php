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
      <?php
    if (isset($_GET["record"])) {
      $sql = "SELECT diagnosis, medication, healed FROM bdr_health_information WHERE id= ?";
      if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $record);
        $record = $_GET["record"];
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
      <div class="card p-4 shadow-lg rounded-lg" style="width: 400px;">
        <h4>Update health Details</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?hospital=' . $_GET['hospital'] . '&user=' . $_GET['user'] . '$record=' . $_GET['record']; ?>"
              class="needs-validation" method="POST" novalidate>
          <div class="form-group">
            <label for="diagnosis" class="text-secondary font-weight-bold">Patient Diagnosis</label>
            <textarea rows="3" class="form-control overflow-hidden" id="diagnosis" placeholder="Patient Diagnosis"
                      name="diagnosis" style="resize: none" required><?php echo $row['diagnosis']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="medication" class="text-secondary font-weight-bold">Medication Prescribed</label>
            <textarea rows="3" class="form-control overflow-hidden" id="medication" placeholder="Doctor's Prescription"
                      name="medication" style=" resize: none" required><?php echo $row['medication']; ?></textarea>
          </div>
          <div class="form-group py-2">
            <p class="text-secondary font-weight-bold">Health Status</p>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="healed" name="status" value="1" class="custom-control-input"
                     <?php echo $row['healed'] == 1 ? "checked" : ""; ?>>
              <label class="custom-control-label" for="healed">Healed</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="not_healed" name="status" value="0" class="custom-control-input"
                     <?php echo $row['healed'] == 0 ? "checked" : ""; ?>>
              <label class="custom-control-label" for="not_healed">Yet to Heal</label>
            </div>
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
