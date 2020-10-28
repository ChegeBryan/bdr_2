<?php
session_start();

require_once '../includes/config.php';

if (!empty($_POST["user_reg"])) {
  $sql = "SELECT * FROM bdr_users WHERE userid = '%{$_POST["user_reg"]}%'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo <<<ROW
      <tr>
        <td>{$row["userid"]}</td>
        <td><img src='{$row["pic"]}' class='img-fluid' height='50px' width='50px'></td>
        <td>{$row["fullname"]}</td>
        <td>{$row["gender"]}</td>
        <td><a href="view_usr.php?hospital={$_SESSION['hosp_id']}&user={$row['id']}" class="btn btn-info btn-sm">View</a></td>
      </tr>
      ROW;
    }
  } else {
    echo <<<ROW
      <tr>
        <td colspan='5' class="text-warning">No user found matching the registration number.</td>
      </tr>
      ROW;
  }
} else {
  echo <<<ROW
      <tr>
        <td colspan='5' class='text-info'>Type into the search field to look for user.</td>
      </tr>
      ROW;
}
