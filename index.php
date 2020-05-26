<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🗄</text></svg>">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="assets/bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.css">
    <title>Biodata Records System</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-sm navbar-bg bg-secondary">


      <a class="navbar-brand text-white" href="index.php">Biodata Records</a>


      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon text-white"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link text-white" href="hospital/login.php">Hospital</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="school/login.php">School</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="company/login.php">Company</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="user/login.php">User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="admin/login.php">Admin</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container d-flex flex-column flex-md-row justify-content-around py-4">
      <div class="card shadow-lg rounded-lg ml-2 mb-2" style="width: 18rem;">
        <i class="fa fa-5x fa-h-square text-center text-secondary py-4"></i>
        <div class="card-body">
          <h5 class="card-title text-center">Hospital</h5>
          <h6 class="card-subtitle mb-2 text-muted">Functions</h6>
          <p class="card-text">View user health history</p>
          <p class="card-text">Edit user health record</p>
          <p class="card-text">Add user health</p>
          <a href="hospital/login.php" class="btn btn-secondary stretched-link btn-block">Dashboard</a>
        </div>
      </div>
      <div class="card shadow-lg rounded-lg ml-2 mb-2" style="width: 18rem;">
        <i class="fa fa-mortar-board fa-5x text-center text-secondary py-4"></i>
        <div class="card-body">
          <h5 class="card-title text-center">School</h5>
          <h6 class="card-subtitle mb-2 text-muted">Functions</h6>
          <p class="card-text py-2">View user academics</p>
          <p class="card-text py-2">Add user academics</p>
          <a href="school/login.php" class="btn btn-secondary stretched-link btn-block">Dashboard</a>
        </div>
      </div>
      <div class="card shadow-lg rounded-lg ml-2 mb-2" style="width: 18rem;">
        <i class="fa fa-suitcase fa-5x text-center text-secondary py-4"></i>
        <div class="card-body ">
          <h5 class="card-title text-center">Company</h5>
          <h6 class="card-subtitle mb-2 text-muted">Functions</h6>
          <p class="card-text">View user work history</p>
          <p class="card-text">Add user work details</p>
          <p class="card-text">View user academics</p>
          <a href="company/login.php" class="btn btn-secondary stretched-link btn-block">Dashboard</a>
        </div>
      </div>
    </div>


    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

  </body>

</html>
