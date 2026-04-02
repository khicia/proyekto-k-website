    <?php
    // admin/dashboard.php — no login for now
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Project K</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
        --primary: #004080;
        --bg-light: #f4f8fc;
        --bg-white: #fff;
        --shadow: 0 5px 15px rgba(0,0,0,0.07);
        --hover: #e6f0ff;
        }

        body {
        margin: 0;
        font-family: 'Inter', sans-serif;
        background: var(--bg-light);
        color: #222;
        }

        header {
        background: var(--primary);
        color: white;
        padding: 1.5rem 2rem;
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard-container {
        max-width: 1200px;
        margin: 3rem auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 2rem;
        padding: 0 2rem;
        }

        .card {
        background: var(--bg-white);
        border-radius: 15px;
        box-shadow: var(--shadow);
        padding: 2rem 1.5rem;
        text-align: center;
        text-decoration: none;
        color: var(--primary);
        transition: all 0.3s ease;
        position: relative;
        }

        .card:hover {
        background: var(--hover);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }

        .card i {
        font-size: 2.4rem;
        margin-bottom: 0.8rem;
        color: #0055aa;
        }

        .card h3 {
        margin: 0.3rem 0;
        font-size: 1.2rem;
        font-weight: 600;
        }

        .card small {
        color: #555;
        display: block;
        margin-top: 0.4rem;
        font-size: 0.9rem;
        }

        @media (max-width: 600px) {
        header {
            font-size: 1.5rem;
        }
        }
    </style>
    </head>
    <body>
    <?php include "includes/header.php"; ?>

    <h2>Admin Dashboard</h2>
    <p>Use the navigation above to manage various modules of the system.</p>


    <div class="dashboard-container">
        <a href="manage_barangays.php" class="card">
        <i class="bi bi-geo-alt-fill"></i>
        <h3>Barangay Directory</h3>
        <small>Manage barangay info & map</small>
        </a>

    <a href="tourism.php" class="card">
        <i class="bi bi-camera-fill"></i>
        <h3>Tourism</h3>
        <small>Add or update tourist spots</small>
    </a>


        <a href="manage_jobs.php" class="card">
        <i class="bi bi-briefcase-fill"></i>
        <h3>Jobs / Seminars</h3>
        <small>Manage posted opportunities</small>
        </a>

        <a href="manage_users.php" class="card">
        <i class="bi bi-people-fill"></i>
        <h3>User Management</h3>
        <small>Registered youth profiles</small>
        </a>

        <a href="id_records.php" class="card">
        <i class="bi bi-person-vcard-fill"></i>
        <h3>ID Records</h3>
        <small>Generated KK IDs</small>
        </a>

        <a href="login_history.php" class="card">
        <i class="bi bi-clock-history"></i>
        <h3>Login History</h3>
        <small>Track user login activity</small>
        </a>

    </div>
    <?php include "includes/footer.php"; ?>
    </body>
    </html>
