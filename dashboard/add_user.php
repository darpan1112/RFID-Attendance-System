<?php
require '../config.php';
header('Content-Type: application/json');

// 🧩 Sanitize Inputs
$card_uid   = trim($_POST['card_uid'] ?? '');
$name       = trim($_POST['name'] ?? '');
$department = trim($_POST['department'] ?? '');

if (empty($card_uid) || empty($name) || empty($department)) {
    echo json_encode(['msg' => '⚠️ Please fill all fields!']);
    exit;
}

// 🧠 Check if user already exists
$check = mysqli_query($conn, "SELECT * FROM users WHERE card_uid='$card_uid'");
if (mysqli_num_rows($check) > 0) {
    // If already exists → update user
    $update = mysqli_query($conn, "UPDATE users SET name='$name', department='$department' WHERE card_uid='$card_uid'");
    if ($update) {
        echo json_encode(['msg' => '✅ User details updated successfully!']);
    } else {
        echo json_encode(['msg' => '❌ Error updating user!']);
    }
} else {
    // Otherwise → insert new user
    $insert = mysqli_query($conn, "INSERT INTO users (card_uid, name, department) VALUES ('$card_uid', '$name', '$department')");
    if ($insert) {
        echo json_encode(['msg' => '✅ New user added successfully!']);
    } else {
        echo json_encode(['msg' => '❌ Error adding user!']);
    }
}
?>
