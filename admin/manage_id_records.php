<?php
require_once "../includes/db.php";
include "includes/header_sections.php";

// Handle status update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_status"])) {
  $record_id  = $_POST["record_id"];
  $new_status = $_POST["status"];

  // 1) Update the status
  $stmt = $conn->prepare("
    UPDATE generated_ids
    SET status = ?
    WHERE id = ?
  ");
  $stmt->bind_param("si", $new_status, $record_id);
  $stmt->execute();
  $stmt->close();

  // 2) Notify the specific user
  $notifStmt = $conn->prepare("
    INSERT INTO notifications (user_id, message)
    SELECT user_id, CONCAT(
      'Your KK ID request has been ', ?, '.'
    ) FROM generated_ids WHERE id = ?
  ");
  $notifStmt->bind_param("si", $new_status, $record_id);
  $notifStmt->execute();
  $notifStmt->close();
}

// Fetch ID records with timestamps
$sql = "
  SELECT
    g.id,
    g.full_name,
    u.email,
    g.kk_id,
    g.status,
    g.created_at,
    g.updated_at
  FROM generated_ids g
  LEFT JOIN users u ON g.user_id = u.id
  ORDER BY g.created_at DESC
";
$result = $conn->query($sql);
?>

<style>
body {
  font-family: 'Segoe UI', sans-serif;
  background-color: #111827;
  margin: 0; padding: 0;
  color: white; min-height: 100vh;
  display: flex; flex-direction: column;
}
main { flex: 1; padding: 2rem; }
h2 { color: #facc15; }
p { color: #d1d5db; }
table {
  width: 100%; border-collapse: collapse;
  background: #1f2937; box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  border-radius: 8px; overflow: hidden;
}
th, td {
  padding: 1rem; text-align: left;
  border-bottom: 1px solid #374151;
}
th {
  background: #1e40af; color: white;
}
tr:hover { background-color: #374151; }
select, button {
  padding: 0.4rem 0.6rem; border-radius: 5px; font-size: 0.9rem;
}
button {
  background-color: #facc15; color: #111827;
  font-weight: bold; border: none; cursor: pointer;
}
button:hover { background-color: #ffe85c; }
.resubmitted { color: #ff9f1c; font-weight: bold; }
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
        <th>Status</th>
        <th>Requested At</th>
        <th>Last Updated</th>
        <th>Resubmitted?</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <?php
          $created = strtotime($row['created_at']);
          $updated = strtotime($row['updated_at']);
          $resubmitted = $updated > $created;
        ?>
        <tr>
          <td><?= htmlspecialchars($row['full_name']) ?></td>
          <td><?= htmlspecialchars($row['email'] ?? 'N/A') ?></td>
          <td><?= htmlspecialchars($row['kk_id']) ?></td>
          <td><?= htmlspecialchars($row['status']) ?></td>
          <td><?= date("M d, Y h:i A", $created) ?></td>
          <td><?= date("M d, Y h:i A", $updated) ?></td>
          <td class="resubmitted">
            <?= $resubmitted ? 'Yes' : 'No' ?>
          </td>
          <td>
            <form method="POST" style="display:flex; gap:0.5rem;">
              <input type="hidden" name="record_id" value="<?= $row['id'] ?>">
              <select name="status">
                <option value="Pending"  <?= $row['status'] === 'Pending'  ? 'selected' : '' ?>>Pending</option>
                <option value="Approved" <?= $row['status'] === 'Approved' ? 'selected' : '' ?>>Approved</option>
                <option value="Rejected" <?= $row['status'] === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
              </select>
              <button type="submit" name="update_status">Update</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr>
        <td colspan="8" style="text-align:center; color:gray;">No ID records found.</td>
      </tr>
    <?php endif; ?>
    </tbody>
  </table>
</main>

<?php include "includes/footer_sections.php"; ?>
