<?php
require '../config.php';
header('Content-Type: application/json');

// Get UID from POST
$card_uid = trim($_POST['card_uid'] ?? '');

if (empty($card_uid)) {
    echo json_encode(['status' => 'error', 'msg' => '❌ Card UID is required']);
    exit;
}

// Check if user exists
$check = $conn->prepare("SELECT id FROM users WHERE card_uid = ?");
$check->bind_param("s", $card_uid);
$check->execute();
$result = $check->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['status' => 'error', 'msg' => '⚠️ No user found with this UID!']);
    exit;
}

// Delete user
$stmt = $conn->prepare("DELETE FROM users WHERE card_uid = ?");
$stmt->bind_param("s", $card_uid);
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'msg' => '✅ User deleted successfully!']);
} else {
    echo json_encode(['status' => 'error', 'msg' => '❌ Failed to delete user.']);
}
?>
