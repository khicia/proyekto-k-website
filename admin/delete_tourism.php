<?php
require_once "../includes/db.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = (int) $_GET['id'];

  $stmt = $conn->prepare("SELECT image FROM tourism WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($image);
  $stmt->fetch();

  if ($stmt->num_rows > 0) {

    $imagePath = "../images/tourism/" . $image;
    if (file_exists($imagePath)) {
      unlink($imagePath);
    }

    $stmt->close();


    $delete = $conn->prepare("DELETE FROM tourism WHERE id = ?");
    $delete->bind_param("i", $id);
    $delete->execute();
    $delete->close();
  }
}

header("Location: tourism.php"); // Go back to admin panel
exit;
?>
