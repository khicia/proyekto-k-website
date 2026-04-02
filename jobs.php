<?php
session_start();
require_once "includes/db.php";

$sql = "SELECT * FROM jobs WHERE status = 'Active' ORDER BY event_date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Opportunities | ProyektoK</title>
  <link rel="stylesheet" href="css/style.css" />
  <style>
    .jobs-container {
      padding: 2rem;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 1.5rem;
    }

    .job-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      padding: 1rem;
      transition: transform 0.3s ease;
      cursor: pointer;
    }

    .job-card:hover {
      transform: translateY(-5px);
    }

    .job-card h3 {
      margin-bottom: 0.3rem;
      color: #002244;
    }

    .job-card small {
      display: block;
      color: #888;
    }

    .job-card p {
      color: #444;
      font-size: 14px;
      margin-top: 0.5rem;
    }

    .filter-container {
      max-width: 960px;
      margin: 2rem auto 1rem auto;
      display: flex;
      gap: 1rem;
      justify-content: center;
      flex-wrap: wrap;
      padding: 0 1rem;
    }

    .filter-container input[type="text"],
    .filter-container select {
      padding: 0.5rem 1rem;
      font-size: 1rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      min-width: 200px;
      max-width: 300px;
    }

    /* Modal styles here (unchanged) */
    .modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100vw; height: 100vh;
      background: rgba(0,0,0,0.7);
      justify-content: center;
      align-items: center;
      z-index: 999;
    }

    .modal-content {
      background: #fff;
      padding: 2rem;
      max-width: 600px;
      width: 95%;
      border-radius: 10px;
      overflow-y: auto;
    }

    .modal-content h3 {
      margin-bottom: 0.5rem;
    }

    .modal-content p {
      font-size: 14px;
      margin-bottom: 0.7rem;
      color: #333;
    }

    .modal-content a {
      color: #007bff;
      text-decoration: underline;
    }

    .close-btn {
      background: #dc3545;
      color: #fff;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      margin-top: 1rem;
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

<h2 style="text-align: center; margin-top: 2rem; color: #000;">Job Opportunities & Seminars</h2>



<div class="filter-container">
  <input
    type="text"
    id="job-search"
    placeholder="Search jobs..."
    oninput="filterJobs()"
    autocomplete="off"
  />

  <select id="job-type-filter" onchange="filterJobs()">
    <option value="">All Types</option>
    <?php
      // Get distinct types from jobs table to populate dropdown dynamically
      $typesResult = $conn->query("SELECT DISTINCT type FROM jobs WHERE status = 'Active' ORDER BY type ASC");
      while ($typeRow = $typesResult->fetch_assoc()) {
          $type = htmlspecialchars($typeRow['type']);
          echo "<option value=\"$type\">$type</option>";
      }
    ?>
  </select>
</div>

<div class="jobs-container" id="jobs-container">
  <?php while ($job = $result->fetch_assoc()): ?>
    <div class="job-card"
      data-type="<?= htmlspecialchars($job['type']) ?>"
      onclick="openModal(
        `<?= addslashes($job['title']) ?>`,
        `<?= addslashes($job['organizer']) ?>`,
        `<?= addslashes($job['event_date']) ?>`,
        `<?= addslashes($job['time']) ?>`,
        `<?= addslashes($job['location']) ?>`,
        `<?= addslashes($job['type']) ?>`,
        `<?= addslashes(nl2br($job['description'])) ?>`,
        `<?= addslashes($job['apply_link']) ?>`
      )">
      <h3 class="job-title"><?= htmlspecialchars($job['title']) ?></h3>
      <small class="job-type"><?= htmlspecialchars($job['type']) ?> by <?= htmlspecialchars($job['organizer']) ?></small>
      <small><?= htmlspecialchars($job['event_date']) ?> @ <?= htmlspecialchars($job['time']) ?></small>
      <p class="job-description"><?= substr(htmlspecialchars($job['description']), 0, 80) ?>...</p>
    </div>
  <?php endwhile; ?>
</div>

<!-- Modal -->
<div class="modal" id="modal">
  <div class="modal-content">
    <h3 id="modalTitle"></h3>
    <p><strong>Organizer:</strong> <span id="modalOrg"></span></p>
    <p><strong>Type:</strong> <span id="modalType"></span></p>
    <p><strong>Date:</strong> <span id="modalDate"></span> at <span id="modalTime"></span></p>
    <p><strong>Location:</strong> <span id="modalLocation"></span></p>
    <p><strong>Description:</strong></p>
    <p id="modalDesc"></p>
    <p id="modalLinkWrapper"></p>
    <button class="close-btn" onclick="closeModal()">Close</button>
  </div>
</div>

<script>
function openModal(title, org, date, time, location, type, desc, link) {
  document.getElementById('modalTitle').innerText = title;
  document.getElementById('modalOrg').innerText = org;
  document.getElementById('modalDate').innerText = date;
  document.getElementById('modalTime').innerText = time;
  document.getElementById('modalLocation').innerText = location;
  document.getElementById('modalType').innerText = type;
  document.getElementById('modalDesc').innerHTML = desc;

  if (link && link !== 'null') {
    document.getElementById('modalLinkWrapper').innerHTML = `<strong>Apply Here:</strong> <a href="${link}" target="_blank">${link}</a>`;
  } else {
    document.getElementById('modalLinkWrapper').innerHTML = '';
  }

  document.getElementById('modal').style.display = 'flex';
}

function closeModal() {
  document.getElementById('modal').style.display = 'none';
}

function filterJobs() {
  const searchValue = document.getElementById('job-search').value.toLowerCase();
  const selectedType = document.getElementById('job-type-filter').value;

  const jobs = document.querySelectorAll('.job-card');

  jobs.forEach(job => {
    const title = job.querySelector('.job-title').innerText.toLowerCase();
    const description = job.querySelector('.job-description').innerText.toLowerCase();
    const type = job.getAttribute('data-type');

    const matchesSearch = title.includes(searchValue) || description.includes(searchValue);
    const matchesType = selectedType === '' || type === selectedType;

    if (matchesSearch && matchesType) {
      job.style.display = 'block';
    } else {
      job.style.display = 'none';
    }
  });
}
</script>

<?php include "includes/footer.php"; ?>

</body>
</html>
