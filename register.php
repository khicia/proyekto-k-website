<?php
require_once "includes/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = isset($_POST["full_name"]) ? trim($_POST["full_name"]) : '';
  $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
  $password = isset($_POST["password"]) ? trim($_POST["password"]) : '';

  $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $message = "<span style='color: red;'>Account already exists. <a href='login.php'>Login here</a></span>";
  } else {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $insert = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
    $insert->bind_param("sss", $name, $email, $hashed);
    if ($insert->execute()) {
      $message = "<span style='color: green;'>Registration successful! <a href='login.php'>Login now</a></span>";
    } else {
      $message = "<span style='color: red;'>Something went wrong. Please try again.</span>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register | ProyektoK</title>
  <link rel="stylesheet" href="css/style.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #f0f8ff, #e6f0ff);
    }

    .register-section {
      min-height: 80vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }

    .form-container {
      background: #ffffff;
      padding: 2.5rem;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 420px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .form-container h2 {
      margin-bottom: 1.2rem;
      color: #1e3c72;
      font-weight: 600;
      text-align: center;
      width: 100%;
    }

    .form-container form {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .form-container input {
      width: 100%;
      padding: 0.75rem;
      margin: 0.6rem 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 0.95rem;
    }

    .form-container button {
      width: 100%;
      padding: 0.9rem;
      background-color: #1e3c72;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 1rem;
      transition: background 0.3s ease;
    }

    .form-container button:hover {
      background-color: #16315e;
    }

    .form-container p {
      margin-top: 1rem;
      font-size: 0.95rem;
      text-align: center;
    }

    .form-container a {
      color: #1e3c72;
      text-decoration: underline;
      font-weight: 500;
    }

    .form-container span {
      display: block;
      font-size: 0.9rem;
      margin-bottom: 1rem;
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
      <a href="home.php" style="color: white; text-decoration: none; margin-left: 1rem;">HOME</a>
      <a href="index.html#about" style="color: white; text-decoration: none; margin-left: 1rem;">ABOUT</a>
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

<section class="register-section">
  <div class="form-container">
    <h2>CREATE YOUR ACCOUNT</h2>
    <?php if ($message): ?>
      <span><?= $message ?></span>
    <?php endif; ?>
    <form method="POST">
      <input type="text" name="full_name" placeholder="Full Name" required />
      <input type="email" name="email" placeholder="Email Address" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Register</button>
      <p style="color: #333;">Already have an account? <a href="login.php" style="color: #1e3c72;">Login</a></p>
    </form>
  </div>
</section>

<?php include "includes/footer.php"; ?>
</body>
</html>
