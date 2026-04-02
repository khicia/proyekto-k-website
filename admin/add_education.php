<?php

session_start();
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $school_name = mysqli_real_escape_string($conn, $_POST['school_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $map_link = mysqli_real_escape_string($conn, $_POST['map_link']);
    $programs = mysqli_real_escape_string($conn, $_POST['programs']);

    $sql = "INSERT INTO education (school_name, address, map_link, programs)
            VALUES ('$school_name', '$address', '$map_link', '$programs')";
    mysqli_query($conn, $sql);
    header("Location: manage_education.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add School | Admin - ProyektoK</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body { padding: 2rem; font-family: sans-serif; }
    form { max-width: 600px; margin: auto; background: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    label { display: block; margin-top: 1rem; font-weight: bold; }
    input, textarea { width: 100%; padding: 0.5rem; margin-top: 0.3rem; border: 1px solid #ccc; border-radius: 5px; }
    button { margin-top: 1.5rem; padding: 0.5rem 1rem; background: #004080; color: white; border: none; border-radius: 5px; cursor: pointer; }
  </style>
</head>
<body>

<h2 style="text-align:center;">Add New School / Educational Institution</h2>

<form method="POST">
  <label>School Name</label>
  <input type="text" name="school_name" required>

  <label>Address</label>
  <textarea name="address" required></textarea>

  <label>Google Map Link</label>
  <input type="text" name="map_link" required>

  <label>Programs / Courses Offered</label>
  <textarea name="programs" rows="5" required></textarea>

  <button type="submit">Save School</button>
</form>

</body>
</html>
