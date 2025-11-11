<?php
session_start();
require 'config.php';

// Redirect if already logged in
if (isset($_SESSION['admin'])) { 
    header('Location: dashboard/home.php'); 
    exit(); 
}

// Logout message
$msg = (isset($_GET['message']) && $_GET['message'] === 'logout_success') 
    ? 'You have logged out successfully!' 
    : null;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - RFID Attendance</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #0d324d, #7f5a83);
      color: #f2f2f2;
    }
    .login-box {
      background: rgba(255, 255, 255, 0.08);
      padding: 35px 45px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
      text-align: center;
      width: 360px;
      animation: fadeIn 1s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    h2 {
      font-size: 22px;
      margin-bottom: 20px;
    }
    h2 span {
      color: #0fb5b8;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    input {
      padding: 10px;
      border: none;
      border-radius: 8px;
      outline: none;
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      font-size: 14px;
    }
    input::placeholder {
      color: #ccc;
    }
    button {
      background: #0fb5b8;
      border: none;
      color: #012;
      font-weight: bold;
      padding: 10px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    button:hover {
      background: #0ca3a5;
      transform: scale(1.05);
    }
    .toast {
      background: #0fb5b8;
      color: #012;
      padding: 8px;
      border-radius: 6px;
      margin-bottom: 10px;
      font-size: 14px;
    }
    .muted {
      color: rgba(255,255,255,0.7);
      font-size: 13px;
      margin-top: 10px;
    }
    .forgot {
      font-size: 13px;
      color: #ccc;
      text-decoration: none;
      text-align: right;
    }
    .forgot:hover {
      text-decoration: underline;
      color: #0fb5b8;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2><span>RFID</span> Attendance</h2>
    <h2>Welcome, Admin</h2>
    <?php if($msg) echo '<div class="toast">'.$msg.'</div>'; ?>
    <form method="POST" action="verify_login.php">
      <input name="username" placeholder="Username" required>
      <input name="password" type="password" placeholder="Password" required>
      <a href="reset_password.php" class="forgot">Forgot password?</a>
      <button type="submit">Login</button>
    </form>
    <p class="muted">Default: <strong>admin / 1234</strong></p>
  </div>
</body>
</html>
