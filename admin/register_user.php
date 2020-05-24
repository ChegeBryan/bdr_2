<?php

session_start();

if (isset($_SESSION["admin_logged_In"]) || $_SESSION["admin_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

require_once '../includes/config.php';

$uploadError = $health = $fullname = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include 'upload_img.php';

  $rnd_usr = "U-" . mt_rand();
  $rnd_psw = mt_rand();

  if ($uploadOk == 1) {
    $sql = "INSERT INTO bdr_users (fullname, dob, health, gender, pic, userid, password) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("sssssss", $fullname, $dob, $health, $gender, $pic, $userid, $psw);

      $fullname = trim($_POST['fullname']);
      $dob = $_POST['dob'];
      $health = trim($_POST['health']);
      $gender = $_POST['gender'];
      $pic = $img;
      $userid = $rnd_usr;
      $psw = password_hash($rnd_psw, PASSWORD_DEFAULT);

      if ($stmt->execute()) {
        $_SESSION['message'] = "Registration Successful!";
        $_SESSION['reg_id'] = "User Id: " . $userid;
        $_SESSION['reg_psw'] = "Password : " . $rnd_psw;
        header("location: register_user.php");
      } else {
        header("location: ../error.php");
      }
      $stmt->close();
    }
  }
}
?>

<!DOCTYPE html>
<html>

  <head>
    <?php include '../head.php'; ?>
    <title>User | Registration</title>
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
      if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
        echo <<<ALERT
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {$_SESSION['message']}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="alert alert-info alert-dismissible fade show" role="alert">
                {$_SESSION['reg_id']}
                <br/>
                {$_SESSION['reg_psw']}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            ALERT;
      }
      ?>
        <h3 class="card-title">User Registration</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data"
              class="needs-validation" novalidate>

          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" placeholder="Enter full name" name="fullname"
                   value="<?php echo $fullname; ?>" required>
          </div>
          <div class="form-group">
            <label for="dob">Birth date</label>
            <input type="date" class="form-control" name="dob" id="dob" max="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <div class="form-group">
            <label for="health">Known Health Conditions</label>
            <textarea class="form-control" rows="3" id="health" name="health" placeholder="Known health conditions"
                      value="<?php echo $health; ?>" required></textarea>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="male" name="gender" class="custom-control-input" value="male" checked>
            <label class="custom-control-label" for="male">Male</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="female" name="gender" class="custom-control-input" value="female">
            <label class="custom-control-label" for="female">Female</label>
          </div>
          <div class="custom-file mt-2 <?php echo (!empty($uploadError)) ? 'has-error' : ''; ?>">
            <input type="file" class="custom-file-input" id="pic" name="pic" required>
            <label class="custom-file-label" for="pic">Pick user photo</label>
            <span class="form-text text-danger"><small><?php echo $uploadError; ?></small></span>
          </div>
          <button type="submit" class="btn btn-primary btn-block mt-3">Register User</button>
        </form>
      </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>

    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <script src="../js/form_validation.js"></script>
    <script src="../js/clear_form.js"></script>

    <script>
    $(document).ready(function() {
      $('input[type="file"]').change(function(e) {
        var filename = e.target.files[0].name;
        $(".custom-file-label").textContent(filename);
      });
    });
    </script>
  </body>

</html>
