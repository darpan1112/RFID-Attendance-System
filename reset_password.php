<?php require 'config.php';
$msg = null;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = $_POST['username'] ?? '';
    $new = $_POST['new_password'] ?? '';
    if($user && $new){
        $stmt = $pdo->prepare('UPDATE admin SET password=? WHERE username=?');
        $stmt->execute([$new, $user]);
        $msg = 'Password updated. Please login.';
    } else $msg = 'Provide username and new password.';
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Reset Password</title>
<link rel="stylesheet" href="assets/style.css"></head><body class="centered-bg">
  <div class="card login-card">
    <div class="logo">RFID Attendance</div>
    <h2>Reset Password</h2>
    <?php if($msg) echo '<div class="toast">'.$msg.'</div>'; ?>
    <form method="POST" class="form">
      <input name="username" placeholder="Username" required>
      <input name="new_password" type="password" placeholder="New Password" required>
      <button class="btn">Reset</button>
    </form>
    <p class="muted"><a href="login.php">Back to login</a></p>
  </div>
</body></html>