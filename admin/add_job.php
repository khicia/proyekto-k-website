<?php
session_start();
require_once "../includes/db.php";
include "includes/header_sections.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = $_POST['title'];
  $organizer = $_POST['organizer'];
  $event_date = $_POST['event_date'];
  $time = $_POST['time'];
  $location = $_POST['location'];
  $type = $_POST['type'];
  $description = $_POST['description'];
  $apply_link = $_POST['apply_link'];
  $status = $_POST['status'];

  $stmt = $conn->prepare("INSERT INTO jobs (title, organizer, event_date, time, location, type, description, apply_link, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssssss", $title, $organizer, $event_date, $time, $location, $type, $description, $apply_link, $status);
  $stmt->execute();
  header("Location: manage_jobs.php");
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

  input, textarea, select {
    width: 100%;
    padding: 0.75rem;
    border-radius: 0.5rem;
    border: none;
    margin-bottom: 1rem;
    font-size: 1rem;
    background-color: #374151;
    color: #fff;
  }

  input:focus, textarea:focus, select:focus {
    outline: none;
    background-color: #4b5563;
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
    <h2>Add New Job / Seminar</h2>
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="organizer" placeholder="Organizer" required>
    <input type="date" name="event_date" required>
    <input type="time" name="time" required>
    <input type="text" name="location" placeholder="Location" required>
    <input type="text" name="type" placeholder="Type (Job, Seminar, etc.)" required>
    <textarea name="description" placeholder="Description" rows="4" required></textarea>
    <input type="url" name="apply_link" placeholder="Apply Link (optional)">
    <select name="status">
      <option value="Active" selected>Active</option>
      <option value="Inactive">Inactive</option>
    </select>
    <button type="submit">Add Job</button>
  </form>
</div>

<?php include "includes/footer_sections.php"; ?>
