<?php
// admin/manage_jobs.php
session_start();
require_once "../includes/db.php";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM jobs WHERE id = $id");
    header("Location: manage_jobs.php");
    exit;
}

$jobs = mysqli_query($conn, "SELECT * FROM jobs ORDER BY event_date DESC");
?>

<?php include "includes/header_sections.php"; ?>

<style>
  body, html {
    margin: 0;
    padding: 0;
    background-color: #111827;
    font-family: 'Segoe UI', sans-serif;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
    box-sizing: border-box;
  }

  h2 {
    font-size: 1.75rem;
    font-weight: bold;
    color: #facc15;
    margin-bottom: 1rem;
  }

  .add-btn {
    background-color: #1e40af;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.2s ease;
    display: inline-block;
    margin-bottom: 1.5rem;
  }

  .add-btn:hover {
    background-color: #facc15;
    color: black;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #1f2937;
    font-size: 0.95rem;
    color: #ffffff;
    border-radius: 0.5rem;
    overflow: hidden;
  }

  thead {
    background-color: #1e40af;
  }

  th, td {
    padding: 0.75rem 1rem;
    text-align: left;
    border-bottom: 1px solid #374151;
  }

  tbody tr:hover {
    background-color: #4b5563;
  }

  .btn {
    padding: 0.3rem 0.7rem;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
  }

  .edit {
    background-color: #2563eb;
    color: white;
  }

  .delete {
    background-color: #dc2626;
    color: white;
  }
</style>

<div class="container">
  <h2>Manage Job Opportunities / Seminars</h2>
  <a href="add_job.php" class="add-btn">+ Add New Job/Seminar</a>

  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Organizer</th>
        <th>Date</th>
        <th>Time</th>
        <th>Type</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($job = mysqli_fetch_assoc($jobs)) : ?>
        <tr>
          <td><?= htmlspecialchars($job['title']) ?></td>
          <td><?= htmlspecialchars($job['organizer']) ?></td>
          <td><?= htmlspecialchars($job['event_date']) ?></td>
          <td><?= htmlspecialchars($job['time']) ?></td>
          <td><?= htmlspecialchars($job['type']) ?></td>
          <td><?= htmlspecialchars($job['status']) ?></td>
          <td>
            <a href="edit_job.php?id=<?= $job['id'] ?>" class="btn edit">Edit</a>
            <a href="manage_jobs.php?delete=<?= $job['id'] ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this job/seminar?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include "includes/footer_sections.php"; ?>
