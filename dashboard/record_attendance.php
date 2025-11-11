<?php
require '../config.php';
header('Content-Type: text/plain');

// ✅ Check if UID received
if (!isset($_GET['card_uid']) || empty($_GET['card_uid'])) {
    echo "⚠️ No UID received!";
    exit;
}

$uid = trim($_GET['card_uid']);

// ✅ Check if UID exists in users
$userQuery = "SELECT * FROM users WHERE card_uid = '$uid'";
$userResult = mysqli_query($conn, $userQuery);

if (!$userResult || mysqli_num_rows($userResult) === 0) {
    echo "❌ Unknown Card UID!";
    exit;
}

$user = mysqli_fetch_assoc($userResult);
$user_id = $user['id'];

// ✅ Prevent duplicate attendance for same day
$checkQuery = "SELECT * FROM attendance WHERE card_uid = '$uid' AND DATE(ts) = CURDATE()";
$checkResult = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    echo "⚠️ Already marked present today!";
    exit;
}

// ✅ Insert attendance record
$sql = "INSERT INTO attendance (user_id, card_uid, status, ts) 
        VALUES ('$user_id', '$uid', 'present', NOW())";

if (mysqli_query($conn, $sql)) {
    echo "✅ Attendance recorded for UID: $uid";
} else {
    echo "❌ Database Error: " . mysqli_error($conn);
}
?>
