<?php
require_once "../includes/db.php";
include "includes/header_sections.php";

$sql = "SELECT g.full_name, u.email, g.kk_id, g.created_at AS generated_at
        FROM generated_ids g
        LEFT JOIN users u ON g.user_id = u.id
        ORDER BY g.created_at DESC";

$result = $conn->query($sql);
?>

<style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #111827;
    margin: 0;
    padding: 0;
    color: white;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  main {
    flex: 1;
    padding: 2rem;
  }
  h2 {
    color: #facc15;
  }
  p {
    color: #d1d5db;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    background: #1f2937;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    border-radius: 8px;
    overflow: hidden;
  }
  th, td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #374151;
  }
  th {
    background: #1e40af;
    color: white;
  }
  tr:hover {
    background-color: #374151;
  }
</style>

<main>
  <h2>KK ID Records</h2>
  <p>These users have generated their KK ID.</p>

  <table>
    <thead>
      <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>KK ID</th>
        <th>Generated At</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= htmlspecialchars($row['email'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($row['kk_id']) ?></td>
            <td><?= date("M d, Y h:i A", strtotime($row['generated_at'])) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" style="text-align:center; color:gray;">No ID records found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</main>

<?php include "includes/footer_sections.php"; ?>
