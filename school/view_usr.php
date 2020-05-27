<?php
session_start();

if (isset($_SESSION["school_logged_In"]) || $_SESSION["school_logged_in"] !== true) {
  header("location: login.php");
  exit;
}

require_once '../includes/config.php';

$uploadOk = 0;
$uploadError = "";

if (isset($_FILES['cert'])) {
  if ($_FILES['cert']['type'] == "application/pdf") {
    $source_file = $_FILES['cert']['tmp_name'];
    $dest_file = "../certificates/" . $_FILES['cert']['name'];

    if (file_exists($dest_file)) {
      $uploadError = "The file name already exists!!";
      $uploadOk = 0;
    } else {
      move_uploaded_file($source_file, $dest_file);
      $uploadOk = 1;
    }
  } else {
    if ($_FILES['cert']['type'] != "application/pdf") {
      $uploadError = "Invalid  file extension, should be pdf !!";
      $uploadOk = 0;
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($uploadOk == 1) {
    $sql = "INSERT INTO bdr_academics (school, user, certificate) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("iis", $sch, $usr, $cert);

      $sch = $_GET['school'];
      $usr = $_GET['user'];
      $cert = $dest_file;

      if ($stmt->execute()) {
        header("location: view_usr.php?school=" . $_GET['school'] . "&user=" . $_GET['user']);
      } else {
        header("location: ../error.php");
      }
      $stmt->close();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include '../head.php'; ?>
    <title>School | View User</title>
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container py-3" style="width: 1024px">

      <?php
    if (isset($_GET["user"])) {
      $sql = "SELECT fullname, userid, pic, gender, dob FROM bdr_users WHERE id = ?";
      if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $id = trim($_GET["user"]);
        if ($stmt->execute()) {
          $result = $stmt->get_result();

          if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
          } else {
            echo "Something went wrong.";
            exit();
          }
        } else {
          header('location: ../error.php');
        }
      }
    }
    ?>
      <h4 class="text-center">User Details</h4>
      <div class="row">
        <div class="col-sm-4">
          <img src="<?php echo $row['pic']; ?>" class="img-fluid img-thumbnail" alt="Profile Image">
        </div>
        <div class="col-sm-8">
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th>Full Name</th>
                <td><?php echo ucwords($row['fullname']); ?>
                </td>
              </tr>
              <tr>
                <th>User Identity</th>
                <td><?php echo $row['userid']; ?>
                </td>
              </tr>
              <tr>
                <th>Gender</th>
                <td><?php echo ucfirst($row['gender']); ?>
                </td>
              </tr>
              <tr>
                <th>Date of Birth</th>
                <td><?php echo $row['dob']; ?>
                </td>
              </tr>
            </table>
          </div>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?school=' . $_GET['school'] . '&user=' . $_GET['user']; ?>"
                method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="custom-file mt-2 <?php echo (!empty($uploadError)) ? 'has-error' : ''; ?>">
              <input type="file" class="custom-file-input" id="cert" name="cert" required>
              <label class="custom-file-label" for="cert">Pick certificate</label>
              <span class="form-text text-warning"><small>NB: Upload PDF files only.</small></span>
              <span class="form-text text-danger"><small><?php echo $uploadError; ?></small></span>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Upload Certificate</button>
          </form>
        </div>
      </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>

    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
      $('input[type="file"]').change(function(e) {
        var filename = e.target.files[0].name;
        $(".custom-file-label").text(filename);
      });
    });
    </script>

  </body>

</html>
