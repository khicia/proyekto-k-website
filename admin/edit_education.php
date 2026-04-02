<?php
// admin/edit_education.php
session_start();
require_once "../includes/db.php";

if (!isset($_GET['id'])) {
    header("Location: manage_education.php");
    exit;
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM education WHERE id = $id");

if (mysqli_num_rows($result) === 0) {
    echo "No record found.";
    exit;
}

$school = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $school_name = $_POST['school_name'];
    $address = $_POST['address'];
    $map_link = $_POST['map_link'];
    $programs = $_POST['programs'];

    $stmt = $conn->prepare("UPDATE education SET school_name=?, address=?, map_link=?, programs=? WHERE id=?");
    $stmt->bind_param("ssssi", $school_name, $address, $map_link, $programs, $id);
    $stmt->execute();

    header("Location: manage_education.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit School | Admin - ProyektoK</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body { padding: 2rem; font-family: sans-serif; }
    form { max-width: 600px; margin: auto; background: #fff; padding: 1rem; border-radius: 8px; }
    label { display: block; margin-top: 1rem; }
    input, textarea { width: 100%; padding: 0.5rem; margin-top: 0.3rem; }
    button { margin-top: 1rem; padding: 0.5rem 1rem; background: #004080; color: white; border: none; border-radius: 5px; }
  </style>
</head>
<body>

<h2>Edit School: <?= htmlspecialchars($school['school_name']) ?></h2>

<form method="POST">
  <label>School Name</label>
  <input type="text" name="school_name" value="<?= htmlspecialchars($school['school_name']) ?>" required>

  <label>Address</label>
  <textarea name="address" rows="2" required><?= htmlspecialchars($school['address']) ?></textarea>

  <label>Google Map Link</label>
  <input type="text" name="map_link" value="<?= htmlspecialchars($school['map_link']) ?>" required>

  <label>Programs Offered</label>
  <textarea name="programs" rows="4" required><?= htmlspecialchars($school['programs']) ?></textarea>

  <button type="submit">Update School</button>
</form>

</body>
</html>
