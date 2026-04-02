<?php
session_start();
require_once "includes/db.php";

// Only allow logged-in users
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

// Fetch all education records
$sql = "SELECT * FROM education ORDER BY date_added DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Education Opportunities | ProyektoK</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .edu-container {
      padding: 2rem;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 1.5rem;
    }

    .edu-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      padding: 1.5rem;
    }

    .edu-card h3 {
      margin: 0 0 0.5rem;
      color: #002244;
    }

    .edu-card p {
      font-size: 14px;
      color: #444;
      margin: 0.3rem 0;
    }

    .edu-card a {
      color: #007bff;
      font-size: 14px;
      word-break: break-all;
    }

    .edu-card ul {
      margin: 0.5rem 0 0;
      padding-left: 1.2rem;
    }

    .edu-card ul li {
      font-size: 13px;
      color: #333;
    }
  </style>
</head>
<body>

<header class="site-header" style="background: linear-gradient(90deg, #1e3c72, #2a5298); color: white; padding: 1rem 2rem;">
  <div class="nav-container" style="display: flex; justify-content: space-between; align-items: center;">
    <img src="images/logo.png" alt="Logo" class="logo" style="height: 50px;">
    <nav>
      <a href="home.php" style="color: white; text-decoration: none; margin-left: 1rem;">HOME</a>
      <a href="account.php" style="color: white; text-decoration: none; margin-left: 1rem;">ACCOUNT</a>
      <a href="logout.php" style="color: white; text-decoration: none; margin-left: 1rem;">LOGOUT</a>
    </nav>
  </div>
</header>

<!-- Back Btn (Right-Aligned) -->
<div style="background: linear-gradient(to right, #f0f8ff, #e6f0ff); padding: 0.5rem 1rem; display: flex; justify-content: flex-end;">
  <button onclick="history.back()" style="
    background: #004080;
    color: white;
    border: none;
    padding: 0.5rem 1.2rem;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;">
    ← Back
  </button>
</div>

<h2 style="text-align: center; margin-top: 2rem;">Educational Institutions in Calamba</h2>
<!-- Your existing header and nav layout -->

<!-- Back Btn Section -->
<div style="background-color: #f9f9f9; padding: 0.5rem 1rem; border-bottom: 1px solid #ddd;">
  <button onclick="history.back()" style="background: #004080; color: white; border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer;">
    ← Back
  </button>
</div>


<div class="edu-container">
  <?php while ($school = $result->fetch_assoc()): ?>
    <div class="edu-card">
      <h3><?= htmlspecialchars($school['school_name']) ?></h3>
      <p><strong>Address:</strong> <?= htmlspecialchars($school['address']) ?></p>
      <p><strong>Map:</strong> <a href="<?= htmlspecialchars($school['map_link']) ?>" target="_blank">View on Google Maps</a></p>
      <p><strong>Programs Offered:</strong></p>
      <ul>
        <?php 
        $programs = explode("\n", $school['programs']); 
        foreach ($programs as $prog): ?>
          <li><?= htmlspecialchars(trim($prog)) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endwhile; ?>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
