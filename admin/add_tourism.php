<?php
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"]);
  $description = trim($_POST["description"]);

  $image = $_FILES['image']['name'] ?? '';
  $tmp = $_FILES['image']['tmp_name'] ?? '';

  $folderPath = "../images/tourism/";
  if (!is_dir($folderPath)) {
    mkdir($folderPath, 0777, true);
  }

  $uploadSuccess = false;
  $newFileName = '';

  if (!empty($tmp) && !empty($image)) {
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $baseName = pathinfo($image, PATHINFO_FILENAME);
    $baseName = preg_replace("/[^A-Za-z0-9_-]/", "", $baseName); // allow only letters, numbers, dash, underscore

    $newFileName = $baseName . "_" . time() . "." . $ext;
    $imagePath = $folderPath . $newFileName;

    $uploadSuccess = move_uploaded_file($tmp, $imagePath);
  }

  if ($uploadSuccess) {
    $stmt = $conn->prepare("INSERT INTO tourism (name, description, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $description, $newFileName);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      header("Location: tourism.php?success=1");
      exit;
    } else {
      header("Location: tourism.php?error=db");
      exit;
    }
  } else {
    header("Location: tourism.php?error=upload");
    exit;
  }
} else {
  header("Location: tourism.php");
  exit;
}
