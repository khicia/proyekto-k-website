<?php
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome | ProyektoK</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('images/background.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #000; /* Or #fff if image is dark */
}

    .slideshow-medium {
      width: 100%;
      height: 450px;
      overflow: hidden;
      position: relative;
      margin-bottom: 2rem;
    }

    .slideshow-medium .slide {
      display: none;
      width: 100%;
      height: 450px;
    }

    .slideshow-medium .slide.active {
      display: block;
    }

    .slideshow-medium img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .slideshow-caption {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      text-align: center;
      background-color: rgba(30, 132, 170, 0.5);
      padding: 2rem;
      border-radius: 10px;
      max-width: 700px;
    }

    .slideshow-caption h2,
    .slideshow-caption p {
      margin: 0;
    }

    .slideshow-caption h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .slideshow-caption p {
      font-size: 1.1rem;
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

<section class="video-banner">
  <video autoplay muted loop playsinline>
    <source src="images/banner.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="video-overlay">
  </div>
</section>


<section class="overview-cards">
  <div class="card">
    <img src="images/makiling.jpg" alt="Barangay Directory">
    <h2>Barangay Directory</h2>
    <p>Get to know Calamba’s barangays with detailed descriptions, locations, and interactive maps.</p>
    <a href="barangay_directory.php"><button>View Directory</button></a>
  </div>
</section>

<section class="overview-cards">
  <div class="card">
    <img src="images/calamba-church.JPG" alt="Tourism">
    <h2>Tourism</h2>
    <p>Explore Calamba's rich culture, history, and natural attractions through featured tourist destinations.</p>
    <a href="tourism.php"><button>View Directory</button></a>
  </div>
</section>

<div class="slideshow-medium">
  <div class="slide active">
    <img src="images/education.jpg" alt="Education">
  </div>
  <div class="slide">
    <img src="images/history.JPG" alt="Barangay">
  </div>
  <div class="slide">
    <img src="images/jobs.jpg" alt="Jobs">
  </div>
  <div class="slide">
    <img src="images/calamba-church.JPG" alt="Tourism">
  </div>
  <div class="slideshow-caption">
    <h2>EXPLORE CALAMBA CITY WITH PROJECT K: KASANDIGAN HUB</h2>
    <p><strong>Kasandigan ng Kabataan</strong> is a youth-led, non-governmental organization composed of young leaders from different barangays of Calamba. All their initiatives are volunteer-driven and without compensation, with a strong focus on raising awareness, compassion for others and the environment, and the promotion of peace and progress throughout the city.</p>
  </div>
</div>

<section class="overview-cards">
  <div class="card">
    <img src="images/jobs.jpg" alt="Job">
    <h2>Job</h2>
    <p>Discover local job opportunities, training programs, and seminars to jumpstart or grow your career.</p>
    <a href="jobs.php"><button>View Directory</button></a>
  </div>
</section>

<section class="overview-cards">
  <div class="card">
    <img src="images/legal_info.jpg" alt="Legal Info">
    <h2>Legal Info</h2>
    <p>Stay informed with the latest laws, ordinances, and official resolutions affecting Calamba City and its youth.</p>
    <a href="legal_info.php"><button>View Directory</button></a>
  </div>
</section>

<script>
  let currentSlide = 0;
  const slides = document.querySelectorAll(".slideshow-medium .slide");

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
