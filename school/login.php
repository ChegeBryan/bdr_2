<!DOCTYPE html>
<html>

  <head>
    <?php include '../head.php'; ?>
    <title>School | Login</title>

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
        <h4>School login</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation" method="POST"
              novalidate>
          <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label for="sch_id" class="text-secondary font-weight-bold">Identity</label>
            <input type="text" class="form-control" id="sch_id" placeholder="School identity" name="sch_id"
                   value="<?php echo $sch_id; ?>" required>
            <span class="form-text text-danger"><small><?php echo $sch_id_err; ?></small></span>
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
