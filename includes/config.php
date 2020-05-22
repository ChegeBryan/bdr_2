<?php

$conn = new mysqli("localhost", "root", "", "bdr_system");
if ($conn->connect_error) {
  echo "Database Connection Failed";
}
