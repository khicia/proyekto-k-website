  <?php
  // Optional: Add session check here in the future
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Admin Panel | ProyektoK</title>
    <link rel="stylesheet" href="../css/admin-style.css" />
    <style>
      body {
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        background: #f9fbfd;
        color: #333;
      }

      header.admin-header {
        background-color: #003366;
        color: #fff;
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      }

      .admin-header h1 {
        font-size: 1.5rem;
        margin: 0;
        font-weight: bold;
        letter-spacing: 0.5px;
      }

      .admin-header .logout {
        background: #dc3545;
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.9rem;
      }

      .admin-header .logout:hover {
        background: #b52a36;
      }

      .admin-container {
        padding: 2rem;
        max-width: 1200px;
        margin: auto;
      }
    </style>
  </head>
  <body>

  <header class="admin-header">
    <h1>Project K: Kasandigan Hub</h1>
    <!-- <a href="admin_logout.php" class="logout">Logout</a> -->
  </header>

  <div class="admin-container">
