<?php
require_once "../includes/db.php";
include "includes/header_sections.php";

$sql = "SELECT u.full_name, u.email, l.ip_address, l.login_time
        FROM user_logins l
        JOIN users u ON l.user_id = u.id
        ORDER BY l.login_time DESC";
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
  <h2>Login History</h2>

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>IP Address</th>
        <th>Date & Time</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['ip_address']) ?></td>
            <td><?= date("M d, Y h:i A", strtotime($row['login_time'])) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" style="text-align:center; color:gray;">No login records found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</main>

<div style="margin-top: auto;">
  <?php include "includes/footer_sections.php"; ?>
</div>
