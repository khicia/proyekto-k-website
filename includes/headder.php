<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Project K: Kasandigan Hub</title>
  <link rel="stylesheet" href="css/style.css"> 
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f4f8fb;
    }

    /* Header Style */
    .site-header {
      background: linear-gradient(90deg, #1e3c72, #2a5298);
      color: white;
      padding: 1rem 2rem;
    }

    .nav-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .logo {
      height: 50px;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin-left: 1rem;
      font-weight: 500;
      transition: color 0.3s;
    }

    nav a:hover {
      color: #ffd700;
    }

    /* Back Button Style */
    .back-button-container {
      background-color: #e6f0ff;
      padding: 0.8rem 2rem;
      display: flex;
      justify-content: flex-end;
    }

    .back-button-container button {
      background-color: rgb(239, 227, 13);
      color: #1e3c72;
      border: none;
      padding: 0.6rem 1.2rem;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .back-button-container button:hover {
      background-color: #ffe600;
    }

    @media (max-width: 768px) {
      .nav-container {
        flex-direction: column;
        align-items: flex-start;
      }

      nav {
        margin-top: 0.5rem;
      }

      nav a {
        margin: 0.5rem 0 0 0;
        display: inline-block;
      }

      .back-button-container {
        justify-content: center;
      }
    }
  </style>
</head>
<body>

<!-- Header -->
<header class="site-header">
  <div class="nav-container">
    <!-- Logo -->
    <img src="images/logo.png" alt="Logo" class="logo">

    <!-- Navigation -->
    <nav>
      <?php if (isset($_SESSION["user_id"])): ?>
        <a href="home.php">HOME</a>
        <a href="account.php">ACCOUNT</a>
        <a href="logout.php">LOGOUT</a>
      <?php else: ?>
        <a href="index.html">HOME</a>
        <a href="index.html#about">ABOUT</a>
        <a href="login.php">LOGIN</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<!-- Optional Back Button -->
<div class="back-button-container">
  <button onclick="history.back()">← BACK</button>
</div>

</body>
</html>
