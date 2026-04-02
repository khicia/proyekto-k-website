<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Legal Ordinances | ProyektoK</title>
  <link rel="stylesheet" href="css/style.css" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f2f6ff;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 900px;
      margin: 2rem auto;
      padding: 1.5rem;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      color: #003366;
    }

    .year-section {
      margin-top: 2rem;
    }

    .year-title {
      font-size: 1.5rem;
      color: #002244;
      border-bottom: 2px solid #0056b3;
      padding-bottom: 0.3rem;
      margin-bottom: 1rem;
    }

    .entry {
      padding: 1rem;
      background: #e9f2ff;
      border-left: 4px solid #007bff;
      margin-bottom: 1rem;
      border-radius: 5px;
    }

    .entry-title {
      font-weight: bold;
      margin-bottom: 0.3rem;
      color: #003366;
    }

    .entry-desc {
      font-size: 0.95rem;
      color: #222;
      line-height: 1.4;
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
      <a href="account.php" style="color: white; text-decoration: none; margin-left: 1rem;">ACCOUNT</a>
      <a href="logout.php" style="color: white; text-decoration: none; margin-left: 1rem;">LOGOUT</a>
    </nav>
  </div>
</header>

<!-- Back Button (Right-Aligned) -->
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

<div class="container">
  <h1>Legal Ordinances & Resolutions</h1>

  <?php
  $legal_infos = [
    "2020" => [
      ["#684 - 2020", "The ordinance that requires the use of face masks and mandatory practice of social distancing in public places (Hospitals/Schools/Etc.)."],
      ["#686 - 2020", "The ordinance that gives financial support to qualified households under the jurisdiction of Calamba City. (P3,000)"],
      ["#695 - 2020", "The ordinance setting the Organic Charter of the City College of Calamba, outlining the Plantilla Positions, providing funds for its operation."],
      ["#696 - 2020", "The ordinance approving the Five-Year Institutional Development Plan of the City College of Calamba for the CY 2021-2025."],
      ["#700 - 2020", "The ordinance converting the Bunggo National High School into an Integrated School to be named and known as 'Bunggo Integrated School', subject to all existing laws, rules & regulations."],
      ["#701 - 2020", "The ordinance merging the Calamba City Science High School and Calamba City Senior High School into Calamba City Science Integrated School, subject to all existing laws, rules & regulations."],
      ["#702 - 2020", "The ordinance renaming the Calamba National High School - Annex to be named and known as 'San Cristobal National High School', subject to all existing laws, rules & regulations."],
    ],
    "2021" => [
      ["#717 - 2021", "The ordinance recognizing the City College of Calamba as one of the Research Arms of the City Government of Calamba and providing funds thereof."],
      ["#721 - 2021", "The ordinance setting the Organic Charter of the City College of Calamba, outlining the Plantilla Positions, providing funds for its operation, thereby expressly repealing earlier ordinances."],
      ["#725 - 2021", "The ordinance prohibiting the falsification and tampering of Covid-19 Vaccination Cards..."],
      ["#729 - 2021", "The ordinance approving the transfer of CCC Accumulated CHED subsidies... (Php17,717,173.00)..."],
      ["#731 - 2021", "The ordinance promulgating Guidelines for the Implementation of Adolescent Health and Developmental Program."],
      ["#738 - 2021", "The ordinance regulating the Mobility of Unvaccinated Persons for COVID 19 in Calamba City."],
    ],
    "2022" => [
      ["#744 - 2022", "The ordinance approving the Revised Implementing Guidelines in the utilization of the Calamba City Livelihood Development Fund (CCLDF)."],
      ["#745 - 2022", "The ordinance enacting the Institutionalization of a Functional Disaster Risk Reduction and Management in Health (DRRM-H) System."],
      ["#747 - 2022", "The ordinance merging the Punta Integrated School and Punta Elementary School into Punta Integrated School."],
    ],
    "2023" => [
      ["#754 - 2023", "The ordinance Establishing a Comprehensive and Sustainable LGU Response and Commitment Towards the Elimination of TB..."],
      ["#755 - 2023", "The ordinance Granting Tax Relief to Private School Institutions by Waiving the Collection of Taxes..."],
      ["#763 - 2023", "The ordinance adopting RA 11310 (Pantawid Pamilyang Pilipino Program) in the City of Calamba."],
      ["#764 - 2023", "The ordinance amending earlier laws and including new activities under the Maternal Newborn and Child Health Program..."],
      ["#766 - 2023", "The Children’s Code that protects the youth from abuse, harassment, and harm."],
      ["#769 - 2023", "The ordinance converting Eduardo Barretto Sr. National High School into an Integrated School..."],
      ["#770 - 2023", "The ordinance mandating pre-emptive or forced evacuation in case of disasters or emergencies."],
      ["#780 - 2023", "The ordinance amending several sections of City Ordinance 314 related to resettlement and housing."],
      ["#782 - 2023", "The ordinance formulating the Child Labor Free Program of the City of Calamba..."],
      ["#787 - 2023", "The ordinance enacting a Responsive and Inclusive Scholarship Program, 'Iskolar ni Rizal'."],
    ],
  ];

  foreach ($legal_infos as $year => $ordinances):
  ?>
    <div class="year-section">
      <div class="year-title"><?= htmlspecialchars($year) ?></div>
      <?php foreach ($ordinances as [$ref, $desc]): ?>
        <div class="entry">
          <div class="entry-title"><?= htmlspecialchars($ref) ?></div>
          <div class="entry-desc"><?= htmlspecialchars($desc) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
