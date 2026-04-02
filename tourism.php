<?php
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}
include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Tourism | ProyektoK</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #f0f8ff, #e6f0ff);
      color: #000;
    }

    .tourism-hero {
      width: 100%;
      height: 300px;
      overflow: hidden;
      position: relative;
    }

    .tourism-hero img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      animation: slideFade 15s infinite;
    }

    @keyframes slideFade {
      0%, 100% { opacity: 0; }
      10%, 40% { opacity: 1; }
      50% { opacity: 0; }
    }

    .tourism-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      padding: 2rem;
    }

    .tourism-card {
      background: #ffffff;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.3s ease;
      cursor: pointer;
    }

    .tourism-card:hover {
      transform: translateY(-5px);
    }

    .tourism-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .tourism-card .content {
      padding: 1rem;
    }

    .tourism-card h3 {
      margin: 0;
      color: #002244;
    }

    .tourism-card p {
      font-size: 14px;
      color: #555;
      margin-top: 0.5rem;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 99;
      top: 0;
      left: 0;
      height: 100vh;
      width: 100vw;
      background: rgba(0, 0, 0, 0.7);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: white;
      padding: 2rem;
      max-width: 600px;
      width: 90%;
      border-radius: 10px;
      text-align: center;
    }

    .modal-content img {
      width: 100%;
      height: auto;
      max-height: 300px;
      object-fit: cover;
      margin-bottom: 1rem;
      border-radius: 10px;
    }

    .close-btn {
      background: #dc3545;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      margin-top: 1rem;
      border-radius: 5px;
      cursor: pointer;
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

<div class="tourism-hero">
  <img src="images/calamba-church.JPG" alt="Tourism Hero">
</div>

<h2 style="text-align: center; margin-top: 2rem; color: #002244;">Explore Calamba's Tourist Spots</h2>

<div class="tourism-container">
  <?php
    $result = mysqli_query($conn, "SELECT * FROM tourism ORDER BY created_at DESC");
    while ($row = mysqli_fetch_assoc($result)):
      $imagePath = 'images/tourism/' . $row['image']; // ✅ CORRECTED
      $name = htmlspecialchars($row['name']);
      $desc = htmlspecialchars($row['description']);
  ?>
    <div class="tourism-card" onclick="openModal('<?php echo $imagePath; ?>', '<?php echo $name; ?>', `<?php echo $desc; ?>`)">
      <img src="<?php echo $imagePath; ?>" alt="<?php echo $name; ?>">
      <div class="content">
        <h3><?php echo $name; ?></h3>
        <p><?php echo mb_strimwidth($desc, 0, 80, '...'); ?></p>
      </div>
    </div>
  <?php endwhile; ?>
</div>

<!-- MODAL -->
<div class="modal" id="modal">
  <div class="modal-content">
    <img id="modalImage" src="" alt="">
    <h3 id="modalTitle"></h3>
    <p id="modalDesc"></p>
    <button class="close-btn" onclick="closeModal()">Close</button>
  </div>
</div>

<script>
function openModal(image, title, desc) {
  document.getElementById("modalImage").src = image;
  document.getElementById("modalTitle").textContent = title;
  document.getElementById("modalDesc").textContent = desc;
  document.getElementById("modal").style.display = "flex";
}

function closeModal() {
  document.getElementById("modal").style.display = "none";
}
</script>

<?php include "includes/footer.php"; ?>
</body>
</html>
