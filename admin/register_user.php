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
          <a class="nav-link text-white" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../index.php">Home</a>
        </li>
      </ul>
    </nav>
    <div class="container d-flex justify-content-center py-4">
      <div class="card p-4 shadow-lg rounded-lg" style="width: 25rem">
        <h3 class="card-title">User Registration</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation"
              novalidate>

          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" placeholder="Enter full name" name="full_name"
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
          <div class="custom-file mt-2">
            <input type="file" class="custom-file-input" id="pic" name="pic" required>
            <label class="custom-file-label" for="pic">Pick user photo</label>
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
  </body>

</html>
