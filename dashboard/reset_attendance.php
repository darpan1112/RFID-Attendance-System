<?php
require '../config.php';
header('Content-Type: application/json');

// delete only today's attendance
$sql = "DELETE FROM attendance WHERE DATE(ts) = CURDATE()";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["msg" => "✅ Today's attendance has been reset successfully!"]);
} else {
    echo json_encode(["msg" => "❌ Failed to reset attendance!"]);
}
?>
