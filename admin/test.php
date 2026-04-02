<!DOCTYPE html>
<!-- MAIN MAIN DASHBOARD test.html -->
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard | Project K</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">
  <style>
    .calendar {
      width: 100%;
      background-color: #1f2937;
      color: white;
      padding: 1rem;
      border-radius: 1rem;
    }
    .calendar header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: bold;
      margin-bottom: 1rem;
    }
    .calendar-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 0.5rem;
    }
    .calendar-grid div {
      text-align: center;
      padding: 0.5rem 0;
      border-radius: 0.5rem;
    }
    .calendar-grid .today {
      background-color: #facc15;
      color: black;
      font-weight: bold;
    }
  .calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 0.5rem;
  }
  .calendar-grid div {
    text-align: center;
    padding: 0.5rem 0;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    color: #d1d5db; /* text-gray-300 */
    background-color: #1f2937; /* bg-gray-800 */
  }
  .calendar-grid .today {
    background-color: #facc15; /* yellow-400 */
    color: #000;
    font-weight: bold;
  }
</style>
  
</head>
<body class="bg-gray-950 text-white min-h-screen font-sans">

  <header class="bg-blue-900 text-white px-6 py-4 flex items-center shadow-md">
<img src="assets/logo.png" alt="Kasandigan Hub Logo" class="h-12 w-auto object-contain" />
  </header>

<section class="px-6 py-6 grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
  <!-- Greeting -->
  <div class="bg-gray-800 p-6 rounded-xl shadow-md w-full" id="greetingBox">
    <h2 class="text-2xl font-bold text-yellow-300 mb-1">Good Day, Project K Admin!</h2>
    <p class="text-sm text-gray-300">Welcome to the Admin Dashboard of Project K: Kasandigan Hub.</p>
    <p class="text-sm mt-2 text-blue-200" id="dateText"></p>
    
    <!-- Reflected Notes -->
    <div class="mt-4">
      <h3 class="text-sm font-semibold text-white mb-1"> Here is your to-do list today:</h3>
      <div id="embeddedNotes" class="text-sm bg-gray-900 text-white p-3 rounded border border-gray-700 whitespace-pre-line min-h-[3rem]">
        No notes yet.
      </div>
    </div>
  </div>

  <!-- Calendar -->
  <div class="calendar w-full bg-gray-800 p-6 rounded-xl shadow-md">
    <header>
      <span id="monthYear" class="font-semibold text-yellow-300">Loading...</span>
    </header>
    <div class="calendar-grid grid grid-cols-7 gap-2 text-center mt-2 text-sm text-white" id="calendarDays"></div>
  </div>

  <!-- Admin Notes Editor -->
  <div class="bg-gray-800 p-6 rounded-xl shadow-md w-full">
    <h3 class="text-lg font-bold text-yellow-300 mb-3"><i class="fas fa-sticky-note mr-2"></i>Admin Notes</h3>
    <textarea id="adminNotes" class="w-full h-32 p-3 rounded bg-gray-900 text-white text-sm resize-none border border-gray-700" placeholder="Write your reminders or tasks here..."></textarea>
    <button onclick="saveNotes()" class="mt-3 bg-yellow-400 text-black font-semibold px-4 py-2 rounded hover:bg-yellow-300 transition">Save Notes</button>
    <p id="saveMsg" class="text-green-400 text-sm mt-2 hidden">✔ Notes saved!</p>
  </div>
</section>

<!-- Banner Section -->
<section class="px-6 py-4">
  <div class="bg-gradient-to-r from-yellow-400 via-blue-500 to-blue-800 text-white rounded-xl p-6 shadow-lg flex flex-col md:flex-row justify-between items-center gap-4">
    <div>
      <h2 class="text-2xl font-bold mb-2">Stay Updated!</h2>
      <p class="text-sm text-white/90">Be sure to check all modules regularly for updates, logs, and new submissions.</p>
    </div>
    <div>
      <a href="#mainModules" class="bg-white text-blue-900 px-4 py-2 rounded-full font-semibold shadow hover:bg-yellow-300 transition">
        Dashboard Modules Below
      </a>
    </div>
  </div>
</section>

  <!-- Dashboard Cards -->
  <main class="px-6 pb-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

      <!-- Use your working card links -->
      <a href="manage_barangays.php" class="block bg-gray-800 p-5 rounded-2xl shadow hover:ring hover:ring-yellow-400 transition duration-300 cursor-pointer">
        <div class="text-yellow-300 text-2xl mb-2"><i class="fas fa-map-marker-alt"></i></div>
        <h3 class="text-lg font-bold">Barangay Directory</h3>
        <p class="text-sm text-gray-300">Manage barangay info & maps</p>
      </a>

      <a href="tourism.php" class="block bg-gray-800 p-5 rounded-2xl shadow hover:ring hover:ring-yellow-400 transition duration-300 cursor-pointer">
        <div class="text-yellow-300 text-2xl mb-2"><i class="fas fa-camera"></i></div>
        <h3 class="text-lg font-bold">Tourism</h3>
        <p class="text-sm text-gray-300">Add or update tourist spots</p>
      </a>

      <a href="manage_jobs.php" class="block bg-gray-800 p-5 rounded-2xl shadow hover:ring hover:ring-yellow-400 transition duration-300 cursor-pointer">
        <div class="text-yellow-300 text-2xl mb-2"><i class="fas fa-briefcase"></i></div>
        <h3 class="text-lg font-bold">Jobs / Seminars</h3>
        <p class="text-sm text-gray-300">Manage posted opportunities</p>
      </a>

      <a href="manage_users.php" class="block bg-gray-800 p-5 rounded-2xl shadow hover:ring hover:ring-yellow-400 transition duration-300 cursor-pointer">
        <div class="text-yellow-300 text-2xl mb-2"><i class="fas fa-users"></i></div>
        <h3 class="text-lg font-bold">User Management</h3>
        <p class="text-sm text-gray-300">Registered youth profiles</p>
      </a>

      <a href="manage_id_records.php" class="block bg-gray-800 p-5 rounded-2xl shadow hover:ring hover:ring-yellow-400 transition duration-300 cursor-pointer">
        <div class="text-yellow-300 text-2xl mb-2"><i class="fas fa-id-card"></i></div>
        <h3 class="text-lg font-bold">ID Records</h3>
        <p class="text-sm text-gray-300">Generated KK IDs</p>
      </a>

      <a href="login_history.php" class="block bg-gray-800 p-5 rounded-2xl shadow hover:ring hover:ring-yellow-400 transition duration-300 cursor-pointer">
        <div class="text-yellow-300 text-2xl mb-2"><i class="fas fa-history"></i></div>
        <h3 class="text-lg font-bold">Login History</h3>
        <p class="text-sm text-gray-300">Track user login activity</p>
      </a>

    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-900 text-center text-xs text-white py-3">
    © 2025 ProyektoK Admin | All rights reserved.
  </footer>

  <!-- Date and Calendar Scripts -->
 <script>
  // Show current date
  const today = new Date();
  const dateStr = today.toLocaleDateString('en-PH', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
  document.getElementById("dateText").innerText = dateStr;

  // Calendar logic
  const monthYear = document.getElementById('monthYear');
  const calendarDays = document.getElementById('calendarDays');
  const now = new Date();

  const renderCalendar = (month, year) => {
    const monthNames = [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];
    monthYear.innerText = `${monthNames[month]} ${year}`;

    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();

    calendarDays.innerHTML = "";

    const weekdays = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    weekdays.forEach(day => {
      const div = document.createElement("div");
      div.className = "font-semibold text-blue-300 text-xs text-center";
      div.innerText = day;
      calendarDays.appendChild(div);
    });

    for (let i = 0; i < firstDay; i++) {
      const emptyCell = document.createElement("div");
      calendarDays.appendChild(emptyCell);
    }

    for (let date = 1; date <= lastDate; date++) {
      const div = document.createElement("div");
      div.innerText = date;
      div.className = "text-center py-1 rounded text-sm " + 
        (date === now.getDate() && month === now.getMonth() && year === now.getFullYear()
          ? "bg-yellow-400 text-black font-bold"
          : "bg-gray-700 text-white");
      calendarDays.appendChild(div);
    }
  };

  renderCalendar(now.getMonth(), now.getFullYear());

  // Admin Notes Logic
  const noteBox = document.getElementById("adminNotes");
  const embeddedNotes = document.getElementById("embeddedNotes");
  const saveMsg = document.getElementById("saveMsg");

  // Load saved note on page load
  window.addEventListener("DOMContentLoaded", () => {
    const savedNote = localStorage.getItem("admin_note");
    if (savedNote && savedNote.trim() !== "") {
      noteBox.value = savedNote;
      embeddedNotes.textContent = savedNote;
    } else {
      embeddedNotes.textContent = "No notes yet.";
    }
  });

  // Save note and reflect immediately
  function saveNotes() {
    const note = noteBox.value.trim();
    localStorage.setItem("admin_note", note);
    embeddedNotes.textContent = note || "No notes yet.";
    saveMsg.classList.remove("hidden");
    setTimeout(() => saveMsg.classList.add("hidden"), 2000);
  }
</script>



</body>
</html>
