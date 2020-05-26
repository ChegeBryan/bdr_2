<?php

session_start();

require_once "../includes/config.php";

$h_id = $password = "";
$h_id_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty(trim($_POST["h_id"]))) {
    $h_id_err = "Please enter hospital id.";
  } else {
    $h_id = trim($_POST["h_id"]);
  }

  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }

  if (empty($h_id_err) && empty($password_err)) {
    $sql = "SELECT id, hosp_id, password
    FROM bdr_hospital
    WHERE hosp_id = ?";

    if ($stmt = $conn->prepare($sql)) {

      $stmt->bind_param("s", $identity);
      $identity = $h_id;
      if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
          $stmt->bind_result($id, $hosp_id, $hashed_password);

          if ($stmt->fetch()) {
            if (password_verify($password, $hashed_password)) {

              $_SESSION["hospital_logged_in"] = true;
              $_SESSION["hosp_id"] = $id;
              $_SESSION["hosp"] = $hosp_id;

              header("location: dashboard.php?hospital=" . $_SESSION['hosp_id']);
            } else {
              $password_err = "The password you entered was not valid.";
            }
          }
        } else {
          $h_id_err = "No account found with that username.";
        }
      } else {
        header("location: ../error.php");
      }
      $stmt->close();
    }
  }
  $conn->close();
}
?>

<!DOCTYPE html>
<html>

  <head>
    <?php include '../head.php'; ?>
    <title>Hospital | Login</title>

  </head>

  <body>

    <nav class="navbar navbar-expand-sm navbar-bg bg-secondary">

      <a class="navbar-brand text-white" href="../index.php">Biodata Records</a>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="../index.php">Home</a>
        </li>
      </ul>
    </nav>

    <div class="container d-flex justify-content-center mt-5">
      <div class="card p-4 shadow-lg rounded-lg" style="width: 400px;">
        <h4>Hospital login</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation" method="POST"
              novalidate>
          <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label for="h_id" class="text-secondary font-weight-bold">Identity</label>
            <input type="text" class="form-control" id="h_id" placeholder="Hospital identity" name="h_id"
                   value="<?php echo $h_id; ?>" required>
            <span class="form-text text-danger"><small><?php echo $username_err; ?></small></span>
          </div>
          <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label for="psw" class="text-secondary font-weight-bold">Password</label>
            <input type="password" class="form-control" id="psw" placeholder="Enter password" name="password" required>
            <span class="form-text text-danger"><small><?php echo $password_err; ?></small></span>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
    </div>


    <script src="../assets/js/jquery.min.js"></script>

    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <script src="../js/form_validation.js"></script>
  </body>

</html>
