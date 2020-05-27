<?php

session_start();

if (isset($_SESSION["company_logged_In"]) || $_SESSION["company_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

require_once '../includes/config.php';

$position = $remarks = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_GET['company']) && isset($_GET['user'])) {
    $sql = "INSERT INTO bdr_work_information (company, user, position, remarks, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("iissss", $comp, $usr, $pos, $remarks, $start, $end);

      $comp = $_GET['company'];
      $usr = $_GET['user'];
      $pos = trim($_POST['position']);
      $remarks = trim($_POST['remarks']);
      $start = $_POST['start_date'];
      $end = $_POST['end_date'];

      if ($stmt->execute()) {
        header("location: view_usr.php?company=" . $_GET['company'] . "&user=" . $_GET['user']);
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
    <title>Company | Add Work Details</title>

  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container d-flex justify-content-center mt-5">
      <div class="card p-4 shadow-lg rounded-lg" style="width: 400px;">
        <h4>Add Work Details</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?company=' . $_GET['company'] . '&user=' . $_GET['user']; ?>"
              class="needs-validation" method="POST" novalidate>
          <div class="form-group">
            <label for="position" class="text-secondary font-weight-bold">Position at company</label>
            <input class="form-control" id="position" placeholder="Position worked at" name="position"
                   value="<?php echo $position; ?>" style="resize: none" required>
          </div>
          <div class="form-group">
            <label for="remarks" class="text-secondary font-weight-bold">Company remarks</label>
            <textarea rows="3" class="form-control overflow-hidden" id="remarks"
                      placeholder="Company remarks on position worked at" name="remarks" style="resize: none"
                      required><?php echo $remarks; ?></textarea>
          </div>
          <div class="form-group">
            <label for="start_date">Started on</label>
            <input type="date" class="form-control" id="start_date" name="start_date"
                   max="<?php echo date("Y-m-d", strtotime('yesterday')); ?>" required>
          </div>
          <div class="form-group">
            <label for="end_date">Stopped on</label>
            <input type="date" class="form-control" id="end_date" name="end_date" max="<?php echo date("Y-m-d"); ?>"
                   required>
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
