<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>ProyektoK</title>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f4f8fb; /* same as the back button section background */
    }

    .site-header {
      background: linear-gradient(90deg, #1e3c72, #2a5298);
      color: white;
      padding: 1rem 2rem;
    }

    .nav-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      height: 50px;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin-left: 1rem;
    }

    .back-button-container {
      background-color: #e6f0ff; /* match body color */
      padding: 1rem 2rem;
      display: flex;
      justify-content: flex-end;
    }

    .back-button-container button {
      background-color: rgb(239, 227, 13);
      color: #1e3c72; /* fix color value */
      border: none;
      padding: 0.5rem 1.2rem;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

        .back-btn-wrapper {
      padding: 1rem 2rem;
      display: flex;
      justify-content: flex-end;
      background: linear-gradient(to right, #f0f8ff, #e6f0ff);
    }

    .back-btn-wrapper button {
      background-color: rgb(239, 227, 13);
      color: #1e3c72;
      border: none;
      padding: 0.6rem 1.2rem;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <header class="site-header">
    <div class="nav-container">

      <img src="images/logo.png" alt="Logo" class="logo">

      <nav>
        <?php if (isset($_SESSION["user_id"])): ?>
          <a href="home.php">HOME</a>
          <a href="account.php">ACCOUNT</a>
          <a href="logout.php">LOGOUT</a>
        <?php else: ?>
          <a href="index.html">HOME</a>
          <a href="index.html#about">ABOUT</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>

  <div class="back-button-container">
    <button onclick="history.back()">← BACK</button>
  </div>

</body>
</html>
