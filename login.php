<?php
session_start();
require_once "includes/db.php";

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user["password"])) {
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["full_name"] = $user["full_name"];

    $user_id = $user["id"];
    $ip = $_SERVER['REMOTE_ADDR'];
    $login_stmt = $conn->prepare("INSERT INTO user_logins (user_id, ip_address) VALUES (?, ?)");
    $login_stmt->bind_param("is", $user_id, $ip);
    $login_stmt->execute();

    header("Location: home.php");
    exit;
  } else {
    $message = "Invalid email or password.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | ProyektoK</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #f0f8ff, #e6f0ff);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .login-wrapper {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }

    .form-container {
      background: #ffffff;
      padding: 2rem 2.5rem;
      border-radius: 12px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      color: #1e3c72;
    }

    .form-container h2 {
      margin-bottom: 1.5rem;
      text-align: center;
      color: #1e3c72;
    }

    .form-container input {
      width: 100%;
      padding: 0.75rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      color: #1e3c72;
    }

    .form-container button {
      width: 100%;
      padding: 0.75rem;
      background-color: #1e3c72;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      font-size: 1rem;
      cursor: pointer;
    }

    .form-container button:hover {
      background-color: #16315e;
    }

    .form-container p {
      text-align: center;
      font-size: 0.95rem;
      color: #333;
    }

    .form-container a {
      color: #1e3c72;
      text-decoration: underline;
    }

    .error {
      color: #cc0000;
      background: #ffe6e6;
      padding: 0.6rem;
      margin-bottom: 1rem;
      border-radius: 6px;
      font-size: 0.95rem;
      text-align: center;
    }
  </style>
</head>
<body>

<!-- Header (Custom, no back button) -->
<header class="site-header" style="background: linear-gradient(90deg, #1e3c72, #2a5298); color: white; padding: 1rem 2rem;">
  <div class="nav-container" style="display: flex; justify-content: space-between; align-items: center;">
    <img src="images/logo.png" alt="Logo" class="logo" style="height: 50px;">
    <nav>
      <a href="index.html" style="color: white; text-decoration: none; margin-left: 1rem;">HOME</a>
      <a href="index.html#about" style="color: white; text-decoration: none; margin-left: 1rem;">ABOUT</a>
      <a href="register.php" style="color: white; text-decoration: none; margin-left: 1rem;">SIGNUP</a>
    </nav>
  </div>
</header>

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

<div class="login-wrapper">
  <div class="form-container">
    <h2>LOGIN TO PROJECT K</h2>
    <?php if ($message): ?>
      <div class="error"><?= $message ?></div>
    <?php endif; ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
      <p>Don't have an account? <a href="register.php">Sign up here</a></p>
    </form>
  </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
