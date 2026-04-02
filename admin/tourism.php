<?php
require_once "../includes/db.php";
include "includes/header_sections.php";

$tourism = $conn->query("SELECT * FROM tourism ORDER BY id DESC");
?>

<style>
  body, html {
    margin: 0;
    padding: 0;
    background-color: #111827;
    font-family: 'Segoe UI', sans-serif;
  }
  .tourism-wrapper {
    min-height: 100vh;
    padding: 2rem;
    background-color: #111827;
  }
  .tourism-container {
    background-color: #1f2937;
    padding: 2rem;
    border-radius: 1rem;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    width: 100%;
  }
  .tourism-container h2 {
    font-size: 1.75rem;
    font-weight: bold;
    color: #facc15;
    margin-bottom: 1rem;
  }
  form label {
    display: block;
    margin-top: 1rem;
  }
  form input[type="text"],
  form textarea,
  form input[type="file"] {
    width: 100%;
    padding: 0.75rem;
    margin-top: 0.25rem;
    border-radius: 0.5rem;
    border: none;
    background-color: #374151;
    color: white;
  }
  button[type="submit"] {
    margin-top: 1.5rem;
    background-color: #1e40af;
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.5rem;
    font-weight: bold;
    transition: background 0.3s;
  }
  button[type="submit"]:hover {
    background-color: #facc15;
    color: black;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 2rem;
    font-size: 0.95rem;
  }
  thead {
    background-color: #1e40af;
    color: white;
  }
  th, td {
    padding: 0.75rem 1rem;
    text-align: left;
  }
  tbody tr {
    background-color: #374151;
    transition: background 0.2s;
  }
  tbody tr:hover {
    background-color: #4b5563;
  }
  .action-links a {
    color: #f87171;
    font-weight: bold;
    text-decoration: none;
  }
  .action-links a:hover {
    text-decoration: underline;
  }
  img {
    border-radius: 0.5rem;
  }
</style>

<div class="tourism-wrapper">
  <div class="tourism-container">
    <h2>Manage Tourism Information</h2>
    <p class="text-sm text-gray-300 mb-4">Add, update, or delete tourist spots that appear on the user side.</p>

    <form method="POST" enctype="multipart/form-data" action="add_tourism.php">
      <label>Name:</label>
      <input type="text" name="name" required>

      <label>Description:</label>
      <textarea name="description" rows="4" required></textarea>

      <label>Image:</label>
      <input type="file" name="image" accept="image/*" required>

      <button type="submit" name="add_tourist">Add Tourist Spot</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Image</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $tourism->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['description']) ?></td>
          <td><img src="../images/tourism/<?= htmlspecialchars($row['image']) ?>" width="100"></td>
          <td class="action-links">
            <a href="delete_tourism.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this tourist spot?')">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal  part -->
<div id="deleteModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:9999; align-items:center; justify-content:center;">
  <div style="background:#1f2937; padding:2rem; border-radius:1rem; color:white; text-align:center; width:90%; max-width:400px;">
    <h3 style="font-size:1.25rem; margin-bottom:1rem;">Are you sure you want to delete this tourist spot?</h3>
    <form id="deleteForm" method="POST" action="delete_tourism.php">
      <input type="hidden" name="id" id="deleteId">
      <button type="submit" style="background:#dc2626; color:white; padding:0.5rem 1rem; border:none; border-radius:5px; margin-right:1rem;">Delete</button>
      <button type="button" onclick="closeDeleteModal()" style="background:#4b5563; color:white; padding:0.5rem 1rem; border:none; border-radius:5px;">Cancel</button>
    </form>
  </div>
</div>

<script>
  function showDeleteModal(id) {
    document.getElementById('deleteId').value = id;
    document.getElementById('deleteModal').style.display = 'flex';
  }

  function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
  }
</script>

<?php include "includes/footer_sections.php"; ?>
