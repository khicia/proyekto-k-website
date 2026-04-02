<?php
session_start();
require_once "includes/db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION["user_id"];
$generated  = false;
$status     = "";
$kk_id      = $full_name = $barangay = $full_address = $user_role = "";
$photoFilename = "id-placeholder.png";

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

$checkStmt = $conn->prepare("SELECT * FROM generated_ids WHERE user_id = ?");
$checkStmt->bind_param("i", $user_id);
$checkStmt->execute();
$existingData = $checkStmt->get_result()->fetch_assoc();
$checkStmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST" && (!$existingData || $existingData['status'] === 'Rejected')) {
  $first_name  = $_POST["first_name"];
  $middle_name = $_POST["middle_name"];
  $last_name   = $_POST["last_name"];
  $barangay    = $_POST["barangay"];
  $house_no    = $_POST["house_no"];
  $street_no   = $_POST["street_no"];
  $street_name = $_POST["street_name"];
  $city        = $_POST["city"];
  $province    = $_POST["province"];
  $zip         = $_POST["zip_code"];
  $user_role   = $_POST["user_role"];

  $full_address = "$house_no $street_no $street_name, $barangay, $city, $province $zip";

  if (!empty($_FILES['userPhoto']['tmp_name'])) {
    $photoName = basename($_FILES['userPhoto']['name']);
    $photoTmp  = $_FILES['userPhoto']['tmp_name'];
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
    move_uploaded_file($photoTmp, $targetDir . $photoName);
    $photoFilename = $photoName;
  }

  $middle_initial = $middle_name ? strtoupper(substr($middle_name,0,1)) . '.' : '';
  $full_name = trim("$first_name $middle_initial $last_name");

  $count     = $conn->query("SELECT COUNT(*) AS total FROM generated_ids")->fetch_assoc()['total'] + 1;
  $formatted = str_pad($count, 4, '0', STR_PAD_LEFT);
  $kk_id     = "KK-2023-$formatted-$barangay";

  if ($existingData) {
    $up = $conn->prepare("
      UPDATE generated_ids
      SET kk_id=?, barangay=?, full_address=?, user_role=?, full_name=?, photo=?, status='Pending'
      WHERE user_id=?
    ");
    $up->bind_param("ssssssi", $kk_id, $barangay, $full_address, $user_role, $full_name, $photoFilename, $user_id);
    $up->execute();
    $up->close();

    $notif = $conn->prepare("
      INSERT INTO notifications (user_id, message)
      VALUES (NULL, ?)
    ");
    $msg = "🔄 {$user['full_name']} has resubmitted their ID request.";
    $notif->bind_param("s", $msg);
    $notif->execute();
    $notif->close();

  } else {
    $in = $conn->prepare("
      INSERT INTO generated_ids
        (user_id, kk_id, barangay, full_address, user_role, full_name, photo, status)
      VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')
    ");
    $in->bind_param("issssss", $user_id, $kk_id, $barangay, $full_address, $user_role, $full_name, $photoFilename);
    $in->execute();
    $in->close();
  }

  $checkStmt = $conn->prepare("SELECT * FROM generated_ids WHERE user_id = ?");
  $checkStmt->bind_param("i", $user_id);
  $checkStmt->execute();
  $existingData = $checkStmt->get_result()->fetch_assoc();
  $checkStmt->close();
}

if ($existingData) {
  $status        = $existingData['status'];
  $kk_id         = $existingData['kk_id'];
  $barangay      = $existingData['barangay'];
  $full_address  = $existingData['full_address'];
  $user_role     = $existingData['user_role'];
  $full_name     = $existingData['full_name'];
  $photoFilename = $existingData['photo'];
  $generated     = ($status === 'Approved');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Generate ID | ProyektoK</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body { margin:0; font-family:'Segoe UI'; background:url('images/banner.jpg') center/cover fixed; color:white; }
    .form-section, .id-wrapper, .status-msg { background:#fff; color:#002244; border-radius:15px; padding:2rem; max-width:600px; margin:2rem auto; box-shadow:0 4px 10px rgba(0,0,0,0.3); }
    input, select { width:100%; padding:0.6rem; margin-bottom:1rem; border-radius:5px; border:1px solid #ccc; }
    button { background:#116530; color:white; padding:0.8rem 1.5rem; border:none; border-radius:5px; font-weight:bold; cursor:pointer; }
    button:hover { background:#0b4724; }
    .id-top { background:#002244; color:#fff; padding:1rem; display:flex; align-items:center; }
    .id-photo img { width:100px; height:120px; object-fit:cover; border:2px solid #002244; border-radius:5px; }
    .download-btn { display:block; margin:2rem auto 0; background:#116530; color:white; padding:0.8rem 1.5rem; border:none; border-radius:5px; font-weight:bold; cursor:pointer; }
    .download-btn:hover { background:#0b4724; }
  </style>
</head>
<body>

<header style="background:linear-gradient(90deg,#1e3c72,#2a5298);padding:1rem 2rem;display:flex;justify-content:space-between;align-items:center;">
  <img src="images/logo.png" alt="Logo" style="height:50px;">
  <nav>
    <a href="home.php" style="color:white;margin-left:1rem;">HOME</a>
    <a href="account.php" style="color:white;margin-left:1rem;">ACCOUNT</a>
    <a href="logout.php" style="color:white;margin-left:1rem;">LOGOUT</a>
  </nav>
</header>
<div style="background:linear-gradient(to right,#f0f8ff,#e6f0ff);padding:0.5rem 1rem;display:flex;justify-content:flex-end;">
  <button onclick="history.back()" style="background:#004080;color:white;border:none;padding:0.5rem 1.2rem;border-radius:5px;font-weight:bold;cursor:pointer;">← Back</button>
</div>

<?php if ($generated): ?>
  <div class="id-wrapper" id="idCardCanvas">
    <div class="id-top">
      <img src="images/logo.png" style="height:50px;margin-right:10px;">
      <span style="font-size:1.5rem;">Kasandigan ng Kabataan</span>
    </div>
    <div style="display:flex;padding:1rem;background:#f4f4f4;">
      <div class="id-photo"><img src="uploads/<?= htmlspecialchars($photoFilename) ?>" alt="User Photo"></div>
      <div style="margin-left:1rem;">
        <h3 style="background:#ffc107;padding:0.5rem;border-radius:5px;"><?= htmlspecialchars($kk_id) ?></h3>
        <p><strong>Name:</strong> <?= htmlspecialchars($full_name) ?></p>
        <p><strong>Role:</strong> <?= htmlspecialchars($user_role) ?></p>
        <p><strong>Barangay:</strong> <?= htmlspecialchars($barangay) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($full_address) ?></p>
      </div>
    </div>
  </div>
  <button class="download-btn" onclick="downloadID()">Download ID as Image</button>

<?php elseif ($status === "Pending"): ?>
  <div class="status-msg">
    <strong>⏳ Your ID request is being processed by the admin.</strong><br>
    Please wait for approval.
  </div>

<?php elseif ($status === "Rejected"): ?>
  <div class="status-msg">
    <strong>❌ Your ID request was rejected.</strong><br>
    Please follow the ID generation guidelines and resubmit.
  </div>
  <div class="form-section">
    <h2>Resubmit Your Digital ID Request</h2>
    <form method="POST" enctype="multipart/form-data">
      <input type="file" name="userPhoto" accept="image/*" required>
      <input type="text" name="first_name" placeholder="First Name" required>
      <input type="text" name="middle_name" placeholder="Middle Name">
      <input type="text" name="last_name" placeholder="Last Name" required>
      <select name="barangay" required>
        <option value="">-- Select Barangay --</option>
        <option>Makiling</option><option>Turbina</option><option>Ulango</option>
        <option>Saimsim</option><option>Banlic</option><option>Canlubang</option>
        <option>Parian</option><option>Halang</option><option>Real</option>
        <option>Lecheria</option><option>Barandal</option><option>Batino</option>
        <option>Mayapa</option><option>Paciano Rizal</option><option>Burol</option>
      </select>
      <input type="text" name="house_no" placeholder="House No." required>
      <input type="text" name="street_no" placeholder="Street No." required>
      <input type="text" name="street_name" placeholder="Street Name" required>
      <input type="text" name="city" value="Calamba" required>
      <input type="text" name="province" value="Laguna" required>
      <input type="text" name="zip_code" value="4027" required>
      <input type="text" name="user_role" value="Member" required>
      <button type="submit">Resubmit ID Request</button>
    </form>
  </div>

<?php else: ?>
  <div class="form-section">
    <h2>Generate Your Digital ID</h2>
    <form method="POST" enctype="multipart/form-data">
      <input type="file" name="userPhoto" accept="image/*" required>
      <input type="text" name="first_name" placeholder="First Name" required>
      <input type="text" name="middle_name" placeholder="Middle Name">
      <input type="text" name="last_name" placeholder="Last Name" required>
      <select name="barangay" required>
        <option value="">-- Select Barangay --</option>
        <option>Makiling</option><option>Turbina</option><option>Ulango</option>
        <option>Saimsim</option><option>Banlic</option><option>Canlubang</option>
        <option>Parian</option><option>Halang</option><option>Real</option>
        <option>Lecheria</option><option>Barandal</option><option>Batino</option>
        <option>Mayapa</option><option>Paciano Rizal</option><option>Burol</option>
      </select>
      <input type="text" name="house_no" placeholder="House No." required>
      <input type="text" name="street_no" placeholder="Street No." required>
      <input type="text" name="street_name" placeholder="Street Name" required>
      <input type="text" name="city" value="Calamba" required>
      <input type="text" name="province" value="Laguna" required>
      <input type="text" name="zip_code" value="4027" required>
      <input type="text" name="user_role" value="Member" required>
      <button type="submit">Submit ID Request</button>
    </form>
  </div>
<?php endif; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
function downloadID() {
  const card = document.getElementById("idCardCanvas");
  html2canvas(card).then(canvas => {
    const link = document.createElement("a");
    link.download = "ProyektoK_ID.png";
    link.href = canvas.toDataURL();
    link.click();
  });
}
</script>

<?php include "includes/footer.php"; ?>
</body>
</html>
