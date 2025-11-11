<?php 
require '../config.php'; 
if(!isset($_SESSION['admin'])) header('Location: ../login.php'); 
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Home - Dashboard</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="app">
  <?php include 'nav.php'; ?>

  <main class="content">
    <div class="welcome-card">
      <h1>Welcome, Admin</h1>
      <p class="subtitle">RFID Attendance System</p>
      <h3>Created By</h3>
      <p><strong>Darpan Yaduvanshi</strong> & <strong>Anshita Goel</strong></p>
      <p class="quote">"Innovating technology that makes everyday systems smarter and more efficient."</p>
    </div>
  </main>

  <div class="animated-bg"></div>
</body>
</html>
