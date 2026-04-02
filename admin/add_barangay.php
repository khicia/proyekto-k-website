<?php
require_once "../includes/db.php";
include "includes/header_sections.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  $map_link = trim($_POST['map_link']);

  $stmt = $conn->prepare("INSERT INTO barangays (name, description, map_link) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $description, $map_link);
  $stmt->execute();

  header("Location: manage_barangays.php");
  exit;
}
?>

<style>
  body, html {
    margin: 0;
    padding: 0;
    background-color: #111827;
    font-family: 'Segoe UI', sans-serif;
  }

  .form-wrapper {
    width: 100%;
    min-height: 100vh;
    background-color: #111827;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 2rem;
  }

  form {
    background-color: #1f2937;
    padding: 2rem 2.5rem;
    border-radius: 1rem;
    width: 100%;
    max-width: 700px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    color: #fff;
  }

  form h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #facc15;
  }

  input, textarea {
    width: 100%;
    padding: 0.75rem;
    border-radius: 0.5rem;
    border: none;
    margin-bottom: 1rem;
    font-size: 1rem;
    background-color: #374151;
    color: #fff;
  }

  input:focus, textarea:focus {
    outline: none;
    background-color: #4b5563;
  }

  small {
    font-size: 13px;
    color: #ccc;
    margin-bottom: 8px;
    display: block;
  }

  button {
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    font-weight: bold;
    background-color: #1e40af;
    color: white;
    border: none;
    border-radius: 0.5rem;
    transition: 0.2s;
    cursor: pointer;
  }

  button:hover {
    background-color: #facc15;
    color: #000;
  }
</style>

<div class="form-wrapper">
  <form method="POST">
    <h2>Add New Barangay</h2>

    <input type="text" name="name" placeholder="Barangay Name" required>

    <textarea name="description" placeholder="Description" rows="4" required></textarea>

    <label for="map_link">Google Map Link:</label>
    <small>
      📌 Go to Google Maps → Click Share → Embed a map → <strong>Copy only the URL inside the <code>src=""</code></strong>, not the entire iframe tag.
    </small>
    <input type="text" id="map_link" name="map_link" placeholder="https://www.google.com/maps/embed?pb=..." required>

    <button type="submit">Save Barangay</button>
  </form>
</div>

<?php include "includes/footer_sections.php"; ?>
