<?php
session_start();
require_once "../includes/db.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = "Please enter both username and password.";
    } else {
        $stmt = $conn->prepare("SELECT id, username, password_hash FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password_hash'])) {
                session_regenerate_id(true);

                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Incorrect username or password.";
            }
        } else {
            $error = "Incorrect username or password.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Login | ProyektoK</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f4f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-container {
      background: white;
      padding: 2rem 3rem;
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      width: 320px;
    }
    h2 {
      margin-bottom: 1.5rem;
      color: #004080;
      text-align: center;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 0.6rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 1rem;
    }
    button {
      width: 100%;
      padding: 0.7rem;
      background: #004080;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    button:hover {
      background: #002244;
    }
    .error {
      color: #dc3545;
      margin-bottom: 1rem;
      text-align: center;
      font-weight: 600;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Admin Login</h2>

    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <input type="text" name="username" placeholder="Username" required autofocus />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Log In</button>
    </form>
  </div>

</body>
</html>
