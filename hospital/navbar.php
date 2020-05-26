<nav class="navbar navbar-expand-sm navbar-bg bg-secondary">
  <a class="navbar-brand text-white" href="../index.php">Biodata Records</a>


  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon text-white"></span>
  </button>

  <!-- Links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="search_user.php">Search User</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="<?php echo 'view_users.php?hospital=' . $_SESSION['hosp_id'] ?>">View
          users</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
