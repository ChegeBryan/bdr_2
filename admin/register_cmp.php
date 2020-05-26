<?php

session_start();

if (isset($_SESSION["admin_logged_In"]) || $_SESSION["admin_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

require_once '../includes/config.php';

$comp_name = $comp_location = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $rnd_cmp = "C-" . mt_rand();
  $rnd_psw = mt_rand();

  $sql = "INSERT INTO bdr_company (name, location, sector, comp_id, password) VALUES (?, ?, ?, ?, ?)";

  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sssss", $comp_name, $comp_location, $sector, $cmp_id, $psw);

    $comp_name = trim($_POST['comp_name']);
    $comp_location = trim($_POST['comp_location']);
    $sector = $_POST['sector'];
    $cmp_id = $rnd_cmp;
    $psw = password_hash($rnd_psw, PASSWORD_DEFAULT);

    if ($stmt->execute()) {
      $_SESSION['cmp_res'] = "Registration Successful!";
      $_SESSION['cmp_id'] = "Company Id: " . $cmp_id;
      $_SESSION['cmp_psw'] = "Password : " . $rnd_psw;
      header("location: register_cmp.php");
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
    <title>Company | Registration</title>
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
      if (isset($_SESSION['cmp_res']) && !empty($_SESSION['cmp_res'])) {
        echo <<<ALERT
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {$_SESSION['cmp_res']}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="alert alert-info alert-dismissible fade show" role="alert">
                {$_SESSION['cmp_id']}
                <br/>
                {$_SESSION['cmp_psw']}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            ALERT;
      }
      ?>
        <h3 class="card-title">Company Registration</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation"
              novalidate>
          <div class="form-group">
            <label for="comp_name">Company Name</label>
            <input type="text" class="form-control" placeholder="Company name" name="comp_name" id="comp_name"
                   value="<?php echo $comp_name; ?>" required>
          </div>
          <div class="form-group">
            <label for="comp_location">Company Location</label>
            <input type="text" class="form-control" placeholder="Company location" name="comp_location"
                   id="comp_location" value="<?php echo $comp_location; ?>" required>
          </div>
          <div class="form-group">
            <label for="sector">Company sector</label>
            <select id="sector" name="sector" class="custom-select">
              <option selected disabled value="">Select Company Sector:</option>
              <option value="Manufacturing">Manufacturing</option>
              <option value="Mining">Mining</option>
              <option value="Banking">Banking</option>
              <option value="Insurance">Insurance</option>
              <option value="Transport">Transport</option>
              <option value="Telecommunication">Telecommunication</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary btn-block mt-3">Register Company</button>
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
