<?php

session_start();

if (isset($_SESSION["admin_logged_In"]) || $_SESSION["admin_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

require_once '../includes/config.php';

$schname = $schlocation = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $rnd_sch = "S-" . mt_rand();
  $rnd_psw = mt_rand();

  $sql = "INSERT INTO bdr_school (name, location, level, sch_id, password) VALUES (?, ?, ?, ?, ?)";

  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sssss", $schname, $schlocation, $level, $sch_id, $psw);

    $schname = trim($_POST['schname']);
    $schlocation = trim($_POST['schlocation']);
    $level = $_POST['level'];
    $sch_id = $rnd_sch;

    $psw = password_hash($rnd_psw, PASSWORD_DEFAULT);

    if ($stmt->execute()) {
      $_SESSION['sch_res'] = "Registration Successful!";
      $_SESSION['sch_id'] = "School Id: " . $sch_id;
      $_SESSION['sch_psw'] = "Password : " . $rnd_psw;
      header("location: register_sch.php");
    } else {
      header("location: ../error.php");
    }
    $stmt->close();
  }
}
?>

<!DOCTYPE html>
<html>

  <head>
    <?php include '../head.php'; ?>
    <title>School | Registration</title>
  </head>

  <body>

    <nav class="navbar navbar-expand-sm navbar-bg bg-secondary shadow">

      <a class="navbar-brand text-white" href="../index.php">Biodata System</a>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="logout.php">Logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="dashboard.php">Home</a>
        </li>
      </ul>
    </nav>
    <div class="container d-flex justify-content-center py-4">
      <div class="card p-4 shadow-lg rounded-lg" style="width: 25rem">

        <?php
      if (isset($_SESSION['sch_res']) && !empty($_SESSION['sch_res'])) {
        echo <<<ALERT
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {$_SESSION['sch_res']}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="alert alert-info alert-dismissible fade show" role="alert">
                {$_SESSION['sch_id']}
                <br/>
                {$_SESSION['sch_psw']}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            ALERT;
      }
      ?>
        <h3 class="card-title">School Registration</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation"
              novalidate>
          <div class="form-group">
            <label for="schname">School Name</label>
            <input type="text" class="form-control" placeholder="School name" name="schname" id="schname"
                   value="<?php echo $schname; ?>" required>
          </div>
          <div class="form-group">
            <label for="schlocation">School Location</label>
            <input type="text" class="form-control" placeholder="School location" name="schlocation" id="schlocation"
                   value="<?php echo $schlocation; ?>" required>
          </div>
          <div class="form-group">
            <label for="level">School level</label>
            <select id="level" name="level" class="custom-select">
              <option selected disabled value="">Select school level:</option>
              <option value="Primary">Primary</option>
              <option value="Secondary">Secondary</option>
              <option value="Tertiary College">Tertiary College</option>
              <option value="University">University</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary btn-block mt-3">Register School</button>
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
