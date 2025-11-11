<?php
require '../config.php';
if(!isset($_SESSION['admin'])) header('Location: ../login.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Live Attendance</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body class="app">
<?php include 'nav.php'; ?>
<main class="content">
  <div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;">
      <h2>📊 Live Attendance</h2>
      <button class="btn danger" onclick="resetAttendance()">Reset Attendance</button>
    </div>

    <table id="attendanceTbl">
      <thead>
        <tr>
          <th>ID</th>
          <th>UID</th>
          <th>Name</th>
          <th>Department</th>
          <th>Status</th>
          <th>Timestamp</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</main>

<script>
async function loadAttendance() {
  try {
    const res = await fetch('fetch_attendance.php');
    const data = await res.json();
    const tbody = document.querySelector('#attendanceTbl tbody');
    tbody.innerHTML = '';

    if (data.length === 0) {
      tbody.innerHTML = `<tr><td colspan="6" style="text-align:center; color:#aaa;">No attendance records for today</td></tr>`;
      return;
    }

    data.forEach(row => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${row.id}</td>
        <td>${row.card_uid}</td>
        <td>${row.name}</td>
        <td>${row.department}</td>
        <td style="color:${row.status === 'present' ? '#00ff80' : '#ff4d4d'};font-weight:bold;">${row.status}</td>
        <td>${row.ts}</td>
      `;
      tbody.appendChild(tr);
    });
  } catch (err) {
    console.error("Error fetching attendance:", err);
  }
}

// ✅ Reset attendance (clear today’s entries)
async function resetAttendance() {
  if (!confirm("⚠️ Are you sure you want to reset today's attendance?")) return;
  const res = await fetch('reset_attendance.php', { method: 'POST' });
  const json = await res.json();
  alert(json.msg);
  loadAttendance();
}

// ✅ Auto-refresh every 5 seconds
setInterval(loadAttendance, 5000);
window.addEventListener('DOMContentLoaded', loadAttendance);
</script>
</body>
</html>
