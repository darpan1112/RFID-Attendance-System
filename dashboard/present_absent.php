<?php require '../config.php'; if(!isset($_SESSION['admin'])) header('Location: ../login.php'); ?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport"content="width=device-width,initial-scale=1"><title>Reports</title>
<link rel="stylesheet" href="../assets/style.css"><script src="https://cdn.jsdelivr.net/npm/chart.js"></script></head><body class="app">
<?php include 'nav.php'; ?>
<main class="content">
  <div class="card"><h2>Present vs Absent</h2><canvas id="pie" width="400" height="200"></canvas></div>
</main>
<script>
async function load(){ const res=await fetch('fetch_attendance.php'); const j=await res.json(); let present=j.filter(x=>x.status==='present').length; let absent=j.filter(x=>x.status==='absent').length; const ctx=document.getElementById('pie'); new Chart(ctx,{type:'pie',data:{labels:['Present','Absent'],datasets:[{data:[present,absent]}]}}); }
window.addEventListener('DOMContentLoaded', load);
</script>
</body></html>