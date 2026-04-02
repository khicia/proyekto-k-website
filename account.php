<?php
session_start();
require_once "includes/db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$loginDate = date("F j, Y g:i A");

// Fetch latest notifications
$notifResult = false;
$notifStmt = $conn->prepare("SELECT * FROM notifications WHERE user_id IS NULL OR user_id = ? ORDER BY date_created DESC LIMIT 10");
if ($notifStmt) {
  $notifStmt->bind_param("i", $user_id);
  if ($notifStmt->execute()) {
    $notifResult = $notifStmt->get_result();
  }
  $notifStmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Account | ProyektoK</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('images/banner.jpg') no-repeat center center fixed;
      background-size: cover;
      color: white;
    }
    .account-dashboard {
      max-width: 900px;
      margin: 2rem auto;
      padding: 1rem;
    }
    .greeting-card {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: white;
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
      margin-bottom: 2rem;
      text-align: center;
    }
    .greeting-card h2 {
      font-size: 2rem;
      margin-bottom: 0.5rem;
    }
    .greeting-card p {
      margin: 0.3rem 0;
      font-size: 1.1rem;
    }
    .card-options {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 1.5rem;
    }
    .feature-card {
      background: #002244;
      color: white;
      flex: 1 1 30%;
      border-radius: 10px;
      padding: 2rem;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
      text-decoration: none;
    }
    .feature-card:hover {
      transform: scale(1.03);
      box-shadow: 0 6px 12px rgba(0,0,0,0.4);
    }
    .feature-card h3 {
      margin-bottom: 1rem;
      font-size: 1.5rem;
    }
    .feature-card p {
      font-size: 1rem;
    }

    @media (max-width: 768px) {
      .card-options {
        flex-direction: column;
      }
      .feature-card {
        flex: 1 1 100%;
      }
    }

    header a {
      color: white;
      text-decoration: none;
      margin-left: 1rem;
    }

    .back-btn {
      background: #004080;
      color: white;
      border: none;
      padding: 0.5rem 1.2rem;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    .notification-panel {
      position: absolute;
      top: 90px;
      right: 30px;
      background: white;
      color: #002244;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      width: 300px;
      z-index: 999;
    }
    .notification-panel h4 {
      margin: 0;
    }
  </style>
</head>
<body>

<header class="site-header" style="background: linear-gradient(90deg, #1e3c72, #2a5298); padding: 1rem 2rem;">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <img src="images/logo.png" alt="Logo" style="height: 50px;">
    <nav>
      <a href="home.php">HOME</a>
      <a href="account.php">ACCOUNT</a>
      <a href="logout.php">LOGOUT</a>
    </nav>
  </div>
</header>

<!-- Back Btn -->
<div style="background: linear-gradient(to right, #f0f8ff, #e6f0ff); padding: 0.5rem 1rem; display: flex; justify-content: flex-end;">
  <button onclick="history.back()" class="back-btn">← Back</button>
</div>

<div class="account-dashboard">

  <div class="greeting-card">
    <h2>Welcome, <?= htmlspecialchars($user["full_name"]) ?>!</h2>
    <p><strong>Email:</strong> <?= htmlspecialchars($user["email"]) ?></p>
    <p><strong>Login Date:</strong> <?= $loginDate ?></p>
  </div>

  <div class="card-options">
    <a href="generate_id.php" class="feature-card">
      <h3>Digital ID Generator</h3>
      <p>Create your official digital ID and view your KK ID.</p>
    </a>
  </div> 
      
  
  </div>
<?php include "includes/footer.php"; ?>
</body>
</html>
