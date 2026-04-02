<?php
require_once "../includes/db.php";


if (isset($_POST['confirm_delete']) && isset($_POST['barangay_id'])) {
  $id = (int) $_POST['barangay_id'];
  $conn->query("DELETE FROM barangays WHERE id = $id");
  header("Location: manage_barangays.php");
  exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$result = $conn->query("SELECT * FROM barangays WHERE id = $id");
$barangay = $result->fetch_assoc();

if (!$barangay) {
  echo "<p style='color:white; text-align:center;'>Barangay not found.</p>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirm Delete</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #111827;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: white;
    }
    .modal-box {
      background: linear-gradient(to right, #1e40af, #3b82f6);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      max-width: 500px;
      text-align: center;
    }
    .modal-box h2 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
      color: #facc15;
    }
    .modal-box p {
      margin-bottom: 2rem;
    }
    .modal-box form button {
      padding: 0.5rem 1.2rem;
      margin: 0 0.5rem;
      border: none;
      border-radius: 0.5rem;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn-cancel {
      background-color: #6b7280;
      color: white;
    }
    .btn-cancel:hover {
      background-color: #9ca3af;
    }
    .btn-delete {
      background-color: #ef4444;
      color: white;
    }
    .btn-delete:hover {
      background-color: #dc2626;
    }
  </style>
</head>
<body>
  <div class="modal-box">
    <h2>Confirm Delete</h2>
    <p>Are you sure you want to delete <strong><?= htmlspecialchars($barangay['name']) ?></strong>?</p>
    <form method="POST">
      <input type="hidden" name="barangay_id" value="<?= $barangay['id'] ?>">
      <button type="submit" name="confirm_delete" class="btn-delete">Yes, Delete</button>
      <a href="manage_barangays.php" class="btn-cancel" style="text-decoration:none; padding:0.5rem 1.2rem; display:inline-block;">Cancel</a>
    </form>
  </div>
</body>
</html>
