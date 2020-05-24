<!DOCTYPE html>
<html>

  <head>
    <?php include '../head.php'; ?>
    <title>Hospital | Registration</title>
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
        <h3 class="card-title">Hospital Registration</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation"
              novalidate>
          <div class="form-group">
            <label for="hospname">Hospital Name</label>
            <input type="text" class="form-control" placeholder="Hospital name" name="hospname" id="hospname"
                   value="<?php echo $hospname; ?>" required>
          </div>
          <div class="form-group">
            <label for="hosplocation">Hospital Location</label>
            <input type="text" class="form-control" placeholder="Hospital location" name="hosplocation"
                   id="hosplocation" value="<?php echo $hosplocation; ?>" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block mt-3">Register Hospital</button>
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
