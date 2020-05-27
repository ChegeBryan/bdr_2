<nav class="navbar navbar-expand-sm navbar-bg bg-secondary">
  <a class="navbar-brand text-white" href="../index.php">Biodata Records</a>


  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon text-white"></span>
  </button>

  <!-- Links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="<?php echo 'search_user.php?school=' . $_SESSION['sch_id'] ?>">Search
          User</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="<?php echo 'view_users.php?school=' . $_SESSION['sch_id'] ?>">Users</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
