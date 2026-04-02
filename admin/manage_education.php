<?php
// admin/manage_education.php
session_start();
require_once "../includes/db.php";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM education WHERE id = $id");
    header("Location: manage_education.php");
    exit;
}

$schools = mysqli_query($conn, "SELECT * FROM education ORDER BY date_added DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Education | Admin - ProyektoK</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body { padding: 2rem; font-family: sans-serif; }
    h2 { margin-bottom: 1rem; }
    table { width: 100%; border-collapse: collapse; background: #fff; }
    th, td { border: 1px solid #ccc; padding: 0.5rem; text-align: left; vertical-align: top; }
    th { background: #004080; color: white; }
    a.btn { padding: 0.3rem 0.7rem; border-radius: 5px; text-decoration: none; }
    a.edit { background: #007bff; color: white; }
    a.delete { background: #dc3545; color: white; }
    a.add-btn {
      background: #28a745;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      text-decoration: none;
      margin-bottom: 1rem;
      display: inline-block;
    }
  </style>
</head>
<body>

<h2>Manage Educational Institutions</h2>
<a href="add_education.php" class="add-btn">+ Add New School</a>

<table>
  <thead>
    <tr>
      <th>School Name</th>
      <th>Address</th>
      <th>Programs</th>
      <th>Date Added</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysqli_fetch_assoc($schools)) : ?>
      <tr>
        <td><?= htmlspecialchars($row['school_name']) ?></td>
        <td><?= nl2br(htmlspecialchars($row['address'])) ?></td>
        <td><?= nl2br(htmlspecialchars($row['programs'])) ?></td>
        <td><?= $row['date_added'] ?></td>
        <td>
          <a href="edit_education.php?id=<?= $row['id'] ?>" class="btn edit">Edit</a>
          <a href="manage_education.php?delete=<?= $row['id'] ?>" class="btn delete" onclick="return confirm('Delete this entry?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

</body>
</html>
