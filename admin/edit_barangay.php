<?php
require_once "../includes/db.php";
include "includes/header_sections.php";

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM barangays WHERE id = $id");
$barangay = $result->fetch_assoc();

if (!$barangay) {
  echo "<p style='color:white; padding:2rem;'>Barangay not found.</p>";
  include "includes/footer_sections.php";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  $map_link = trim($_POST['map_link']);

  $stmt = $conn->prepare("UPDATE barangays SET name=?, description=?, map_link=? WHERE id=?");
  $stmt->bind_param("sssi", $name, $description, $map_link, $id);
  $stmt->execute();

  header("Location: manage_barangays.php");
  exit;
}
?>

<style>
  body, html {
    margin: 0;
    padding: 0;
    background-color: #111827; /* gray-900 */
    font-family: 'Segoe UI', sans-serif;
  }

  .form-wrapper {
    width: 100%;
    min-height: 100vh;
    background-color: #111827;
    padding: 2rem;
    box-sizing: border-box;
    color: white;
  }

  .form-container {
    max-width: 800px;
    margin: auto;
    background-color: #1f2937; /* gray-800 */
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
  }

  h2 {
    font-size: 1.75rem;
    font-weight: bold;
    color: #facc15;
    margin-bottom: 1.5rem;
  }

  label {
    display: block;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #d1d5db; /* gray-300 */
  }

  input[type="text"],
  textarea {
    width: 100%;
    padding: 0.75rem;
    border-radius: 0.5rem;
    border: 1px solid #374151; /* gray-700 */
    background-color: #1e293b; /* gray-800 */
    color: white;
    font-size: 0.95rem;
  }

  textarea {
    resize: vertical;
  }

  small {
    display: block;
    color: #9ca3af; /* gray-400 ayuse mo kulay ha */
    font-size: 0.75rem;
    margin-bottom: 0.5rem;
  }

  button[type="submit"] {
    margin-top: 1.5rem;
    background-color: #facc15;
    color: black;
    padding: 0.75rem 1.5rem;
    font-weight: bold;
    border: none;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
    cursor: pointer;
  }

  button[type="submit"]:hover {
    background-color: #fde047;
  }
</style>

<div class="form-wrapper">
  <div class="form-container">
    <h2>Edit Barangay</h2>

    <form method="POST">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" value="<?= htmlspecialchars($barangay['name']) ?>" required>

      <label for="description">Description:</label>
      <textarea name="description" id="description" rows="5" required><?= htmlspecialchars($barangay['description']) ?></textarea>

      <label for="map_link">Google Map Link:</label>
      <small>
        📌 Go to Google Maps → Click Share → Embed a map → <strong>Copy only the URL inside the <code>src=""</code></strong>
      </small>
      <input type="text" name="map_link" id="map_link" value="<?= htmlspecialchars($barangay['map_link']) ?>" placeholder="https://www.google.com/maps/embed?pb=..." required>

      <button type="submit">Update</button>
    </form>
  </div>
</div>

<?php include "includes/footer_sections.php"; ?>
