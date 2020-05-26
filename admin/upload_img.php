<?php

$targetDir = "../userImages/";
$targetFile = $targetDir . rand(100, 999) . basename($_FILES["pic"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);

$check = getimagesize($_FILES["pic"]["tmp_name"]);
if ($check !== false) {
  $uploadOk = 1;
} else {
  $uploadOk = 0;
  $uploadError = "Not an image please select an image.";
}

if (file_exists($targetFile)) {
  $uploadError = "Sorry, file already exists.";
  $uploadOk = 0;
}
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
) {
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  $uploadError = $uploadError;
} else {
  if (move_uploaded_file($_FILES["pic"]["tmp_name"], $targetFile)) {
    $img = $targetFile;
  } else {
    $uploadError = "Sorry, there was an error uploading your file.";
  }
}
