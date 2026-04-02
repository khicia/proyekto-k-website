<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us | Project K: Kasandigan Hub</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9fafb;
      color: #333;
    }

    header {
      background-color: #003366;
      color: #fff;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    header .logo {
      display: flex;
      align-items: center;
    }

    header .logo img {
      height: 50px;
      margin-right: 15px;
    }

    header nav {
      display: flex;
      gap: 1rem;
    }

    header nav a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    header nav a:hover {
      color: #facc15;
    }

    main {
      padding: 2rem;
      max-width: 1000px;
      margin: auto;
    }

    .about-container {
      background-color: #ffffff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
    }

    .about-container h2 {
      color: #003366;
      margin-bottom: 1rem;
    }

    .about-container p {
      font-size: 1.1rem;
      line-height: 1.7;
      margin-bottom: 1.5rem;
    }

    .creator-info {
      background-color: #f1f5f9;
      border-left: 5px solid #003366;
      padding: 1.5rem;
      border-radius: 8px;
      margin-bottom: 1.5rem;
    }

    .creator-info h3 {
      color: #003366;
      margin-bottom: 1rem;
    }

    .developer {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }

    .developer img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
    }

    .developer div {
      font-size: 1rem;
    }

    .developer strong {
      display: block;
      color: #003366;
    }

    footer {
      margin-top: 3rem;
      padding: 1rem;
      text-align: center;
      background-color: #003366;
      color: white;
    }

    a {
      color: #facc15;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: flex-start;
      }

      header nav {
        margin-top: 0.5rem;
        flex-direction: column;
        width: 100%;
      }

      .developer {
        flex-direction: column;
        text-align: center;
      }

      .developer img {
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>

<header>
  <div class="logo">
    <img src="images/logo.png" alt="Project K Logo">
  </div>
  <nav>
    <a href="index.html">HOME</a>
    <a href="register.php">SIGN UP</a>
    <a href="login.php">LOGIN</a>
  </nav>
</header>

<main>
  <div class="about-container">
    <h2>Who We Are</h2>
    <p>
      <strong>Project K: Kasandigan Hub</strong> is a web platform designed to empower the youth of Calamba City
      by providing access to localized job opportunities, legal information, barangay directories, tourism
      highlights, and mental health support services like KasanggaBot.
    </p>

    <div class="creator-info">
      <h3>Meet the Developers</h3>
      <p>This platform was proudly developed by a team of BSIT students from the <strong>Polytechnic University of the Philippines – Sto. Tomas Branch</strong>.</p>
      <div class="developer">
        <img src="images/akhicia.jpg" alt="Akhicia Mae C. Torreliza">
        <div>
          <strong>Torreliza, Akhicia Mae C.</strong>
          Programmer and UI Designer
        </div>
      </div>
      <div class="developer">
        <img src="images/ellexis.jpg" alt="Ellexis Philip Martinez">
        <div>
          <strong>Martinez, Ellexis Philip</strong>
          Data Manager and System Input
        </div>
      </div>
      <div class="developer">
        <img src="images/allen.jpg" alt="Allen Michael M. Rianzarez">
        <div>
          <strong>Rianzarez, Allen Michael M.</strong>
          Data Manager and System Input
        </div>
      </div>
    </div>

    <p>
      Project K is not just a website—it's a commitment to youth engagement, information access, and digital transformation
      in grassroots communities. It is built for Calambeño youth, by youth.
    </p>

    <p>
      Want to know more or collaborate with us? Reach out through our <a href="#contact">contact section</a> or message us on our official FB page:
      <a href="https://www.facebook.com/KasandiganNgKabataan" target="_blank">Kasandigan ng Kabataan</a>.
    </p>
  </div>
</main>

<footer>
  &copy; 2025 Project K: Kasandigan Hub | Created by PUP Students | All rights reserved
</footer>

</body>
</html>
