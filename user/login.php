<?php

session_start();

if (isset($_SESSION["user_logged_in"]) && $_SESSION["user_logged_in"] === true) {
  header("location: dashboard.php?user=" . $_SESSION['user_id']);
  exit;
}

require_once "../includes/config.php";

$user_id = $password = "";
$user_id_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty(trim($_POST["user_id"]))) {
    $user_id_err = "Please enter user id.";
  } else {
    $user_id = trim($_POST["user_id"]);
  }

  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }

  if (empty($comp_id_err) && empty($password_err)) {
    $sql = "SELECT id, userid, password
    FROM bdr_users
    WHERE userid = ?";

    if ($stmt = $conn->prepare($sql)) {

      $stmt->bind_param("s", $identity);
      $identity = $user_id;
      if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
          $stmt->bind_result($id, $user_id, $hashed_password);

          if ($stmt->fetch()) {
            if (password_verify($password, $hashed_password)) {

              $_SESSION["user_logged_in"] = true;
              $_SESSION["user_id"] = $id;
              $_SESSION["user"] = $user_id;

              header("location: dashboard.php?user=" . $_SESSION['user_id']);
            } else {
              $password_err = "The password you entered was not valid.";
            }
          }
        } else {
          $user_id_err = "No account found with that company id found.";
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
    <title>User | Login</title>

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
        <h4>User login</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation" method="POST"
              novalidate>
          <div class="form-group <?php echo (!empty($user_id_err)) ? 'has-error' : ''; ?>">
            <label for="user_id" class="text-secondary font-weight-bold">Identity</label>
            <input type="text" class="form-control" id="user_id" placeholder="User identity" name="user_id"
                   value="<?php echo $user_id; ?>" required>
            <span class="form-text text-danger"><small><?php echo $user_id_err; ?></small></span>
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
