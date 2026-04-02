<?php
require_once "../includes/db.php";
include "includes\header_sections.php";

$result = $conn->query("SELECT * FROM barangays ORDER BY name ASC");
?>

<style>
  body, html {
    margin: 0;
    padding: 0;
    background-color: #111827; /* bg-gray-900 */
    font-family: 'Segoe UI', sans-serif;
  }

  .table-wrapper {
    width: 100%;
    min-height: 100vh;
    background-color: #111827; /* gray-900 */
    padding: 0;
    margin: 0;
  }

  .table-container {
    width: 100%;
    background-color: #111827; /* gray-800 */
    padding: 2rem 2rem;
    color: #ffffff;
    box-sizing: border-box;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    font-size: 0.95rem;
  }

  thead {
    background-color: #1e40af; /* blue-800 */
    color: white;
  }

  th, td {
    padding: 0.75rem 1rem;
    text-align: left;
  }

  tbody tr {
    background-color: #374151; /* gray-700 */
    transition: background 0.2s;
  }

  tbody tr:hover {
    background-color: ##374151; /* hover darker gray */
  }

  tbody td a {
    color: #facc15; /* yellow-400 */
    font-weight: bold;
    text-decoration: none;
  }

  tbody td a:hover {
    text-decoration: underline;
  }

  .action-links a {
    margin-right: 0.5rem;
  }

  .add-btn {
    background-color: #1e40af;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.2s ease;
  }

  .add-btn:hover {
    background-color: #facc15;
    color: black;
  }

  h2 {
    font-size: 1.75rem;
    font-weight: bold;
    color: #facc15;
    margin-bottom: 1rem;
  }

  .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
  }
</style>

<div class="table-wrapper">
  <div class="table-container">
    <div class="top-bar">
      <h2>Manage Barangay Directory</h2>
      <a href="add_barangay.php" class="add-btn">+ Add Barangay</a>
    </div>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Description</th>
          <th>Map Link</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= substr(htmlspecialchars($row['description']), 0, 50) ?>...</td>
          <td><a href="<?= htmlspecialchars($row['map_link']) ?>" target="_blank">View</a></td>
          <td class="action-links">
            <a href="edit_barangay.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="delete_barangay.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this barangay?')" style="color:#f87171;">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include "includes/footer_sections.php"; ?>
