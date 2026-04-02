<?php
session_start();
require_once "includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Barangay Directory | ProyektoK</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #f0f8ff, #e6f0ff);
      color: #000; 
    }

    .brgy-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
      padding: 2rem;
    }

    .brgy-card {
      background: #ffffff;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      padding: 1rem;
      transition: transform 0.3s ease;
      border-top: 5px solid #002244;
      position: relative;
    }

    .brgy-card:hover {
      transform: translateY(-5px);
    }

    .brgy-card h3 {
      margin: 0.5rem 0;
      color: #002244;
    }

    .brgy-card p {
      margin: 0.2rem 0;
      font-size: 14px;
      color: #444;
    }

    .brgy-card button {
      margin-top: 1rem;
      background: #ffc107;
      border: none;
      padding: 0.5rem 1rem;
      color: #002244;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .brgy-map {
      display: none;
      margin-top: 1rem;
    }

    .brgy-map iframe {
      width: 100%;
      height: 200px;
      border-radius: 10px;
      border: none;
    }

    .brgy-slideshow {
      max-width: 1000px;
      margin: 2rem auto;
      position: relative;
      overflow: hidden;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .brgy-slideshow .slide {
      display: none;
      width: 100%;
      height: 350px;
    }

    .brgy-slideshow .slide.active {
      display: block;
    }

    .brgy-slideshow img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 15px;
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

<h2 style="text-align: center; margin-top: 2rem;">BARANGAY DIRECTORY</h2>

<section style="text-align: center; margin: 2rem;">
  <h3>Interactive Barangay Map of Calamba</h3>
  <p>This map helps users visualize the locations of the barangays included in our directory. Each marker includes basic information about the barangay and is designed to help users easily navigate the Calamba area.</p>
</section>

<div style="text-align: center;">
  <iframe src="https://www.google.com/maps/d/embed?mid=1Q61-RjI9-R64dJKWHnkSRlj6hC8qIAk&ehbc=2E312F" width="100%" height="480" style="border: 2px solid #002244; border-radius: 10px;"></iframe>
</div>

<div class="brgy-slideshow">
  <div class="slide active"><img src="images/education.jpg" alt="Barangay Image 1"></div>
  <div class="slide"><img src="images/events.jpg" alt="Barangay Image 2"></div>
  <div class="slide"><img src="images/history.JPG" alt="Barangay Image 3"></div>
</div>

<section style="text-align: center; margin: 2rem;">
  <h4>CALAMBA CITY BARANGAY DETAILS</h4>
  <p>Below are the official barangay details stored in our system.</p>
</section>

<div class="brgy-container">
  <?php
  $query = "SELECT name, description, map_link FROM barangays ORDER BY name ASC";
  $result = $conn->query($query);

  if ($result && $result->num_rows > 0) {
    while ($brgy = $result->fetch_assoc()) {
      echo '
      <div class="brgy-card">
        <h3>' . htmlspecialchars($brgy["name"]) . '</h3>
        <p>' . htmlspecialchars($brgy["description"]) . '</p>
        <button onclick="toggleMap(this)">Show Map</button>
        <div class="brgy-map">
          <iframe src="' . htmlspecialchars($brgy["map_link"]) . '" loading="lazy" allowfullscreen></iframe>
        </div>
      </div>';
    }
  } else {
    echo "<p style='text-align:center;'>No barangay records found.</p>";
  }
  ?>
</div>

<script>
function toggleMap(btn) {
  const map = btn.nextElementSibling;
  map.style.display = (map.style.display === "block") ? "none" : "block";
  btn.textContent = (map.style.display === "block") ? "Hide Map" : "Show Map";
}

let currentSlide = 0;
const slides = document.querySelectorAll(".brgy-slideshow .slide");

function showNextSlide() {
  slides[currentSlide].classList.remove("active");
  currentSlide = (currentSlide + 1) % slides.length;
  slides[currentSlide].classList.add("active");
}

setInterval(showNextSlide, 4000);
</script>

<?php include "includes/footer.php"; ?>
</body>
</html>
