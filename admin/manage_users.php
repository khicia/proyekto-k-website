<?php
require_once "../includes/db.php";
include "includes/header_sections.php";

// Fetch
$sql = "SELECT id, full_name, email FROM users ORDER BY id DESC";
$result = $conn->query($sql);
?>

<style>
  body, html {
    margin: 0;
    padding: 0;
    background-color: #111827;
    font-family: 'Segoe UI', sans-serif;
    color: white;
  }

  .user-container {
    max-width: 1000px;
    margin: 2rem auto;
    background: #1f2937;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  }

  h2 {
    text-align: center;
    color: #facc15;
    margin-bottom: 1rem;
  }

  p {
    text-align: center;
    margin-bottom: 2rem;
    color: #d1d5db;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background: #374151;
    border-radius: 8px;
    overflow: hidden;
  }

  th, td {
    padding: 1rem;
    border-bottom: 1px solid #4b5563;
    text-align: left;
  }

  th {
    background: #1e40af;
    color: white;
  }

  tr:hover {
    background-color: #4b5563;
  }

  .action-links a {
    color: #facc15;
    text-decoration: none;
    margin-right: 1rem;
    font-weight: 500;
  }

  .action-links a:hover {
    text-decoration: underline;
    color: #fcd34d;
  }
</style>

<div class="user-container">
  <h2>User Management</h2>
  <p>Below is the list of all registered users.</p>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td class="action-links">
              <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" style="text-align:center; color:#9ca3af;">No users found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include "includes/footer_sections.php"; ?>
